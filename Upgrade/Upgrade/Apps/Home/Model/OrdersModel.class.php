<?php
namespace Home\Model;
use Think\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单服务类
 */
class OrdersModel extends BaseModel {
	/**
	 * 获以订单列表
	 */
	public function getOrdersList($obj){
		$userId = $obj["userId"];
		$m = M('orders');
		$sql = "SELECT * FROM __PREFIX__orders WHERE orderFlag=1 and userId = $userId AND orderStatus <>-1 order by createTime desc";		
		return $m->pageQuery($sql);
	}
	
	/**
	 * 取消订单记录 
	 */
	public function getcancelOrderList($obj){		
		$userId = $obj["userId"];
		$m = M('orders');
		$sql = "SELECT * FROM __PREFIX__orders WHERE orderFlag=1 and userId = $userId AND orderStatus =-1 order by createTime desc";		
		return $m->pageQuery($sql);
		
	}

	/**
	 * 获取订单详情
	 */
	public function getOrdersDetails($obj){		
		$orderId = $obj["orderId"];
		$sql = "SELECT od.*,sp.shopName 
				FROM __PREFIX__orders od, __PREFIX__shops sp 
				WHERE orderFlag=1 and od.shopId = sp.shopId And orderId = $orderId ";		
		$rs = $this->query($sql);;	
		return $rs;
		
	}
	
	/**
	 * 获取订单商品信息
	 */
	public function getOrdersGoods($obj){	
			
		$orderId = $obj["orderId"];
		$sql = "SELECT g.*,og.goodsNums as ogoodsNums,og.goodsPrice as ogoodsPrice 
				FROM __PREFIX__order_goods og, __PREFIX__goods g 
				WHERE og.orderId = $orderId AND og.goodsId = g.goodsId ";		
		$rs = $this->query($sql);	
		return $rs;
		
	}
	
	/**
	 * 
	 * 获取订单商品详情
	 */
	public function getOrdersGoodsDetails($obj){	
			
		$orderId = $obj["orderId"];
		$sql = "SELECT g.*,og.goodsNums as ogoodsNums,og.goodsPrice as ogoodsPrice ,ga.id as gaId
				FROM __PREFIX__order_goods og, __PREFIX__goods g 
				LEFT JOIN __PREFIX__goods_appraises ga ON g.goodsId = ga.goodsId AND ga.orderId = $orderId
				WHERE og.orderId = $orderId AND og.goodsId = g.goodsId";		
		$rs = $this->query($sql);	
		return $rs;
		
	}
	
	/**
	 *
	 * 获取订单商品详情
	 */
	public function getPayOrders($obj){
		$orderType = (int)$obj["orderType"];
		$orderId = 0;
		$orderunique = 0;
		if($orderType>0){//来在线支付接口
			$uniqueId = $obj["uniqueId"];
			if($orderType==1){
				$orderId = (int)$uniqueId;
			}else{
				$orderunique = WSTAddslashes($uniqueId);
			}
		}else{
			$orderId = (int)$obj["orderId"];
			$orderunique = session("WST_ORDER_UNIQUE");
		}
		
		if($orderId>0){
			$sql = "SELECT o.orderId, o.orderNo, g.goodsId, g.goodsName ,og.goodsAttrName , og.goodsNums ,og.goodsPrice
				FROM __PREFIX__order_goods og, __PREFIX__goods g, __PREFIX__orders o
				WHERE o.orderId = og.orderId AND og.goodsId = g.goodsId AND o.payType=1 AND orderFlag =1 AND o.isPay=0 AND o.needPay>0 AND o.orderStatus = -2 AND o.orderId =$orderId";
		}else{
			$sql = "SELECT o.orderId, o.orderNo, g.goodsId, g.goodsName ,og.goodsAttrName , og.goodsNums ,og.goodsPrice
				FROM __PREFIX__order_goods og, __PREFIX__goods g, __PREFIX__orders o
				WHERE o.orderId = og.orderId AND og.goodsId = g.goodsId AND o.payType=1 AND orderFlag =1 AND o.isPay=0 AND o.needPay>0 AND o.orderStatus = -2 AND o.orderunique ='$orderunique'";
		}
		
		$rslist = $this->query($sql);
		
		$orders = array();
		foreach ($rslist as $key => $order) {
			$orders[$order["orderNo"]][] = $order;
		}
		if($orderId>0){
			$sql = "SELECT SUM(needPay) needPay FROM __PREFIX__orders WHERE orderId = $orderId AND isPay=0 AND payType=1 AND needPay>0 AND orderStatus = -2 AND orderFlag =1";
		}else{
			$sql = "SELECT SUM(needPay) needPay FROM __PREFIX__orders WHERE orderunique = '$orderunique' AND isPay=0 AND payType=1 AND needPay>0 AND orderStatus = -2 AND orderFlag =1";
		}
		$payInfo = self::queryRow($sql);
		$data["orders"] = $orders;
		$data["needPay"] = $payInfo["needPay"];
		return $data;
	
	}
	
	/**
	 * 下单
	 */
	public function submitOrder(){
		$rd = array('status'=>-1);
		$USER = session('WST_USER');
		$goodsmodel = D('Home/Goods');
		$morders = D('Home/Orders');
		$totalMoney = 0;
		$totalCnt = 0;
		$userId = (int)session('WST_USER.userId');
		
		$consigneeId = (int)I("consigneeId");
		$payway = (int)I("payway");
		$isself = (int)I("isself");
		$needreceipt = (int)I("needreceipt");
		$orderunique = WSTGetMillisecond().$userId;

		
		$sql = "select count(cartId) cnt from __PREFIX__cart where userId = $userId and isCheck=1 and goodsCnt>0";
		$rcnt = $this->queryRow($sql);
		
		$cartgoods = array();	
		$order = array();
		if($rcnt['cnt']==0){
			$rd['msg'] = '购物车为空!';
			return $rd;
		}else{
			
			$sql = "select * from __PREFIX__cart where userId = $userId and packageId>0 group by batchNo";
			$shopcart = $this->query($sql);
			$batchNos = array();
			for($i=0;$i<count($shopcart);$i++){
				$cgoods = $shopcart[$i];
				$package = array();
				$batchNo = $cgoods["batchNo"];
				$package["batchNo"] = $batchNo;
				$batchNos[] = $batchNo;
				$pkgShopPrice = 0;
				$pckMinStock = 0;
				$sql = "select * from __PREFIX__cart where userId = $userId and batchNo=$batchNo";
				$pkgList = $this->query($sql);
				for($j=0;$j<count($pkgList);$j++){
					$pgoods = $pkgList[$j];
					$packageId = $pgoods["packageId"];
					$goodsId = (int)$pgoods["goodsId"];
					$package["packageId"] = $packageId;
					$package["goodsCnt"] = (int)$pgoods["goodsCnt"];
			
					$sql = "select p.shopId, p.packageName, gp.diffPrice from __PREFIX__goods_packages gp, __PREFIX__packages p where p.packageId =$packageId and gp.packageId=p.packageId and gp.goodsId = $goodsId";
					$pkg = $this->queryRow($sql);
			
					$diffPrice = (float)$pkg["diffPrice"];
					if($pkg["shopId"]>0){
						$package["packageName"] = $pkg["packageName"];
						$package["shopId"] = $pkg["shopId"];
					}
					$goodsAttrId = (int)$pgoods["goodsAttrId"];
					$goods = $goodsmodel->getGoodsSimpInfo($goodsId,$goodsAttrId);
					
					//核对商品是否符合购买要求
					if(empty($goods)){
						$rd['msg'] = '找不到指定的商品!';
						return $rd;
					}
					if($goods['goodsStock']<$package["goodsCnt"]){
						$rd['msg'] = '对不起，商品'.$goods['goodsName'].'库存不足!';
						return $rd;
					}
					if($goods['isSale']!=1){
						$rd['msg'] = '对不起，商品库'.$goods['goodsName'].'已下架!';
						return $rd;
					}
			
					$goods['oshopPrice'] = $goods['shopPrice'];
					$goods['shopPrice'] = ($goods['shopPrice']>$diffPrice)?($goods['shopPrice']-$diffPrice):$goods['shopPrice'];
					$pckMinStock = ($pckMinStock==0 || $goods['goodsStock']<$pckMinStock)?$goods['goodsStock']:$pckMinStock;
					$pkgShopPrice += $goods['shopPrice'];
			
			
					$goods["cnt"] = $pgoods["goodsCnt"];
					$goods["ischk"] = $pgoods["isCheck"];
					$totalMoney += $goods["cnt"]*$goods["shopPrice"];
					$cartgoods[$goods["shopId"]]["ischk"] = 1;
					$package["goods"][] = $goods;
			
					$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
					$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
					$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cgoods["goodsCnt"];
					$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
				}

				$package["goodsStock"] = $pckMinStock;
				$package["shopPrice"] = $pkgShopPrice;
				$cartgoods[$goods["shopId"]]["packages"][] = $package;
			}
			
			$sql = "select * from __PREFIX__cart where userId = $userId and isCheck=1 and goodsCnt>0 and packageId=0";
			$shopcart = $this->query($sql);
			//整理及核对购物车数据
			$cartIds = array();
			for($i=0;$i<count($shopcart);$i++){
				$cgoods = $shopcart[$i];
				$goodsId = (int)$cgoods["goodsId"];
				$goodsAttrId = (int)$cgoods["goodsAttrId"];
				
				$goods = $goodsmodel->getGoodsSimpInfo($goodsId,$goodsAttrId);
				//核对商品是否符合购买要求
				if(empty($goods)){
					$rd['msg'] = '找不到指定的商品!';
					return $rd;
				}
				if($goods['goodsStock']<=0){
					$rd['msg'] = '对不起，商品'.$goods['goodsName'].'库存不足!';
					return $rd;
				}
				if($goods['isSale']!=1){
					$rd['msg'] = '对不起，商品库'.$goods['goodsName'].'已下架!';
					return $rd;
				}
				$goods["cnt"] = $cgoods["goodsCnt"];
				$cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
				$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
				$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺免运费最低金额
				$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cgoods["goodsCnt"];
				$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
				$cartIds[] = $cgoods["cartId"];
				
			}
			M()->startTrans();	
			try{
				$couponIds = WSTFormatIn(",", I("couponIds"));
				$where = array();
				$now = date("Y-m-d");
				$where["validStartTime"] = array("elt",$now);
				$where["validEndTime"] = array("egt",$now);
				$where["c.dataFlag"] = 1;
				$where["cu.couponStatus"] = 1;
				$where["cu.dataFlag"] = 1;
				$where["cu.userId"] = $userId;
				$where["cu.id"] = array("in",$couponIds);
				$rs = M("coupons c")->join("__COUPONS_USERS__ cu on cu.couponId=c.couponId")->where($where)
					->field("cu.id,c.couponId,couponName,shopId,couponMoney,spendMoney,validStartTime,validEndTime")
					->select();
				$coupons = array();
				for($i=0,$k=count($rs);$i<$k;$i++){
					$coupons[$rs[$i]['shopId']] = $rs[$i];
				}
				$ordersInfo = self::addOrders($userId,$consigneeId,$payway,$needreceipt,$cartgoods,$orderunique,$isself,$coupons);
				if($ordersInfo["status"]==1){
					if(count($cartIds)>0){
						$sql = "delete from __PREFIX__cart where userId = $userId and cartId in (".implode(",",$cartIds).")";
						$this->execute($sql);
					}
					if(count($batchNos)>0){
						$sql = "delete from __PREFIX__cart where userId = $userId and batchNo in (".implode(",",$batchNos).")";
						$this->execute($sql);
					}
					$rd['orderIds'] = implode(",",$ordersInfo["orderIds"]);
					$rd['isPay'] = $ordersInfo["isPay"];
					$rd['status'] = 1;
					session("WST_ORDER_UNIQUE",$orderunique);
					M()->commit();
				}else{
					M()->rollback();
					$rd['msg'] = '用户帐户余额不足，请选择其他支付方式!';
				}
			}catch(Exception $e){
				M()->rollback();
				$rd['msg'] = '下单出错，请联系管理员!';
			}
			return $rd;
		}		
	}
	
	/**
	 * 生成订单
	 */
	public function addOrders($userId,$consigneeId,$payway,$needreceipt,$catgoods,$orderunique,$isself,$coupons){
		
		$orderInfos = array();
		$orderIds = array();
		$orderNos = array();
		$remarks = I("remarks");
		
		$addressInfo = UserAddressModel::getAddressDetails($consigneeId);
        
		$isPay = 1;
		foreach ($catgoods as $key=> $shopgoods){
			$m = M('orderids');
			//生成订单ID
			$orderSrcNo = $m->add(array('rnd'=>time()));
			$orderNo = $orderSrcNo."".(fmod($orderSrcNo,7));
			//创建订单信息
			$data = array();
			$packages = $shopgoods["packages"];
			$deliverType = intval($packages[0]["deliveryType"]);
			
			$pshopgoods = $shopgoods["shopgoods"];
			$shopId = $pshopgoods[0]["shopId"];
			
			$sql = "select isDistribut,distributType,distributOrderRate,promoterRate,buyerRate from __PREFIX__shop_configs where shopId= $shopId";
			$shops = $this->queryRow($sql);
			
			$coupon = $coupons[$shopId];
			$couponMoney = 0;
			if(!empty($coupon)){
				$couponMoney = $coupon["couponMoney"];
				$cd = array();
				$cd["couponStatus"] = 0;
				M("coupons_users")->where(array("id"=>$coupon["id"],"userId"=>$userId))->save($cd);
			}
			
			$data["orderNo"] = $orderNo;
			$data["shopId"] = $shopId;	
			$deliverType = ($deliverType>0)?$deliverType:intval($pshopgoods[0]["deliveryType"]);
			$data["userId"] = $userId;	
				
			$data["orderFlag"] = 1;
			$data["totalMoney"] = $shopgoods["totalMoney"];
			if($isself==1){//自提
				$deliverMoney = 0;
			}else{
				$deliverMoney = ($shopgoods["totalMoney"]<$shopgoods["deliveryFreeMoney"])?$shopgoods["deliveryMoney"]:0;
			}
			$data["deliverMoney"] = $deliverMoney;
			$data["payType"] = $payway;
			$data["deliverType"] = $deliverType;
			$data["userName"] = $addressInfo["userName"];
			$data["areaId1"] = $addressInfo["areaId1"];
			$data["areaId2"] = $addressInfo["areaId2"];
			$data["areaId3"] = $addressInfo["areaId3"];
			$data["communityId"] = $addressInfo["communityId"];
			$data["userAddress"] = $addressInfo["paddress"]." ".$addressInfo["address"];
			$data["userTel"] = $addressInfo["userTel"];
			$data["userPhone"] = $addressInfo["userPhone"];
			
			$data['orderScore'] = floor($data["totalMoney"]);
			$data["isInvoice"] = $needreceipt;		
			$data["orderRemarks"] = $remarks;
			$data["requireTime"] = I("requireTime");
			$data["invoiceClient"] = I("invoiceClient");
			$data["isAppraises"] = 0;
			$data["isSelf"] = $isself;
			
			$duser = M("distribut_users")->where(array("buyerId"=>$userId))->find();
			//分销
			if($GLOBALS['CONFIG']['isDistribut']==1 && $shops['isDistribut']==1  && !empty($duser)){
				$data["distributType"] = $shops['distributType'];
				$data["distributOrderRate"] = $shops['distributOrderRate'];
				$data["promoterRate"] = $shops['promoterRate'];
				$data["buyerRate"] = $shops['buyerRate'];
				//总佣金
				if($shops['distributType']==1){
					$totalCommission = 0;
					foreach ($packages as $key=> $package){
						foreach ($package['goods'] as $key2=> $sgoods){
							$totalCommission = $totalCommission + round($sgoods["cnt"]*$sgoods["commission"],2);
						}
					}
					foreach ($pshopgoods as $key=> $sgoods){
						$totalCommission = $totalCommission + round($sgoods["cnt"]*$sgoods["commission"],2);
					}
					$data["totalCommission"] = $totalCommission;
				}else if($shops['distributType']==2){
					$data["totalCommission"] = round($shopgoods["totalMoney"]*$shops["distributOrderRate"]/100,2);
				}
			}else{
				$data["distributType"] = 0;
				$data["totalCommission"] = 0;
			}
			
			//积分
			$isScorePay = (int)I("isScorePay",0);
			$scoreMoney = 0;
			$useScore = 0;

			if($GLOBALS['CONFIG']['poundageRate']>0){
				$data["poundageRate"] = (float)$GLOBALS['CONFIG']['poundageRate'];
				$data["poundageMoney"] = WSTBCMoney($data["totalMoney"] * $data["poundageRate"] / 100,0,2);
			}else{
				$data["poundageRate"] = 0;
				$data["poundageMoney"] = 0;
			}
			if($GLOBALS['CONFIG']['isOpenScorePay']==1 && $isScorePay==1){//积分支付
				$baseScore = WSTOrderScore();
				$baseMoney = WSTScoreMoney();
				$sql = "select userId,userScore from __PREFIX__users where userId=$userId";
				$user = $this->queryRow($sql);
				$useScore = $baseScore*floor($user["userScore"]/$baseScore);
				$scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
				$orderTotalMoney = $shopgoods["totalMoney"]+$deliverMoney;
				if($orderTotalMoney<$scoreMoney){//订单金额小于积分金额
					$useScore = $baseScore*floor($orderTotalMoney/$baseMoney);
					$scoreMoney = $baseMoney*floor($orderTotalMoney/$baseMoney);
				}
				$data["useScore"] = $useScore;
				$data["scoreMoney"] = $scoreMoney;
			}
			$data["realTotalMoney"] = $shopgoods["totalMoney"] + $deliverMoney - $scoreMoney - $couponMoney;
			$needPay = $data["realTotalMoney"];
			$data["needPay"] = $data["realTotalMoney"];
			$data["couponMoney"] = $couponMoney;
			$data["createTime"] = date("Y-m-d H:i:s");
			if($payway==1){
				$data["orderStatus"] = -2;
			}else{
				$data["orderStatus"] = 0;
			}
			
			$data["orderunique"] = $orderunique;
			$data["isPay"] = 0;
			if($data["needPay"]==0){
				$data["isPay"] = 1;
				$data["orderStatus"] = 0;
			}else{
				$isPay = 0;
			}
			
			$morders = M('orders');
			$orderId = $morders->add($data);	
			
			//订单创建成功则建立相关记录
			if($orderId>0){
				
				if($GLOBALS['CONFIG']['isOpenScorePay']==1 && $isScorePay==1 && $useScore>0){//积分支付
					$sql = "UPDATE __PREFIX__users set userScore=userScore-".$useScore." WHERE userId=".$userId;
					$rs = $this->execute($sql);
				
					$data = array();
					$m = M('user_score');
					$data["userId"] = $userId;
					$data["score"] = $useScore;
					$data["dataSrc"] = 1;
					$data["dataId"] = $orderId;
					$data["dataRemarks"] = "订单支付-扣积分";
					$data["scoreType"] = 2;
					$data["createTime"] = date('Y-m-d H:i:s');
					$m->add($data);
				}
				
				$orderIds[] = $orderId;
				//建立订单商品记录表
				$mog = M('order_goods');
				foreach ($packages as $key=> $package){
					foreach ($package['goods'] as $key2=> $sgoods){
						$data = array();
						$data["orderId"] = $orderId;
						$data["goodsId"] = $sgoods["goodsId"];
						$data["goodsAttrId"] = (int)$sgoods["goodsAttrId"];
						if($sgoods["attrVal"]!='')$data["goodsAttrName"] = $sgoods["attrName"].":".$sgoods["attrVal"];
						$data["goodsNums"] = $sgoods["cnt"];
						$data["goodsPrice"] = $sgoods["shopPrice"];
						$data["goodsName"] = $sgoods["goodsName"];
						$data["goodsThums"] = $sgoods["goodsThums"];
						$data["commission"] = ($sgoods["commission"]<$sgoods["shopPrice"])?$sgoods["commission"]:0;
						$mog->add($data);
					}
				}
				
				foreach ($pshopgoods as $key=> $sgoods){
					$data = array();
					$data["orderId"] = $orderId;
					$data["goodsId"] = $sgoods["goodsId"];
					$data["goodsAttrId"] = (int)$sgoods["goodsAttrId"];
					if($sgoods["attrVal"]!='')$data["goodsAttrName"] = $sgoods["attrName"].":".$sgoods["attrVal"];
					$data["goodsNums"] = $sgoods["cnt"];
					$data["goodsPrice"] = $sgoods["shopPrice"];
					$data["goodsName"] = $sgoods["goodsName"];
					$data["goodsThums"] = $sgoods["goodsThums"];
					$data["commission"] = ($sgoods["commission"]<$sgoods["shopPrice"])?$sgoods["commission"]:0;
					$mog->add($data);
				}
			
				if($payway==1){
					$content = "订单已提交，等待支付";
					WSTOrderLog($orderId, $content, $userId,0);
				}else{
					
					//建立订单记录
					$content = ($deliverType==0)? "下单成功":"下单成功等待审核";
					WSTOrderLog($orderId, $content, $userId,0);
					//建立订单提醒
					$sql ="SELECT userId,shopId,shopName FROM __PREFIX__shops WHERE shopId=$shopId AND shopFlag=1  ";
					$users = $this->query($sql);
					$morm = M('order_reminds');
					for($i=0;$i<count($users);$i++){
						$data = array();
						$data["orderId"] = $orderId;
						$data["shopId"] = $shopId;
						$data["userId"] = $users[$i]["userId"];
						$data["userType"] = 0;
						$data["remindType"] = 0;
						$data["createTime"] = date("Y-m-d H:i:s");
						$morm->add($data);
					}
						
					//修改库存
					foreach ($packages as $key=> $package){
						foreach ($package['goods'] as $key2=> $sgoods){
							$sql="update __PREFIX__goods set goodsStock=goodsStock-".$sgoods['cnt']." where goodsId=".$sgoods["goodsId"];
							$this->execute($sql);
							if((int)$sgoods["goodsAttrId"]>0){
								$sql="update __PREFIX__goods_attributes set attrStock=attrStock-".$sgoods['cnt']." where id=".$sgoods["goodsAttrId"];
								$this->execute($sql);
							}
						}
					}
						
					foreach ($pshopgoods as $key=> $sgoods){
						$sql="update __PREFIX__goods set goodsStock=goodsStock-".$sgoods['cnt']." where goodsId=".$sgoods["goodsId"];
						$this->execute($sql);
						if((int)$sgoods["goodsAttrId"]>0){
							$sql="update __PREFIX__goods_attributes set attrStock=attrStock-".$sgoods['cnt']." where id=".$sgoods["goodsAttrId"];
							$this->execute($sql);
						}
					}
				}
			}
		}
		
		return array("orderIds"=>$orderIds,"isPay"=>$isPay,"status"=>1);
		
	}
	
	/**
	 * 获取订单参数
	 */
	public function getOrderListByIds(){
		 $orderunique = session("WST_ORDER_UNIQUE");
		 $orderInfos = array('totalMoney'=>0,'isMoreOrder'=>0,'list'=>array());
		 $sql = "select orderId,orderNo,totalMoney,deliverMoney,realTotalMoney,payType
		         from __PREFIX__orders where userId=".(int)session('WST_USER.userId')." 
		         and orderunique='".$orderunique."' and orderFlag=1 ";
	     $rs = $this->query($sql);
	     if(!empty($rs)){
	     	$totalMoney = 0;
	     	$realTotalMoney = 0;
	     	$realTotalMoney = 0;
	     	$payType = 0;
	     	foreach ($rs as $key =>$v){
	     		$orderInfos['list'][] = array('orderId'=>$v['orderId'],'orderNo'=>$v['orderNo']);
	     		$totalMoney += $v['totalMoney'] + $v['deliverMoney'];
	     		$realTotalMoney += $v['realTotalMoney'];
	     	}
	     	$orderInfos['payType'] = $rs[0]["payType"];
	     	$orderInfos['totalMoney'] = $totalMoney;
	     	$orderInfos['realTotalMoney'] = $realTotalMoney;
	     	$orderInfos['isMoreOrder'] = (count($rs)>0)?1:0;
	     }
	     return $orderInfos;
	}
	
	/**
	 * 获取待付款订单
	 */
	public function queryByPage($obj){
		$userId = $obj["userId"];
		$pcurr = (int)I("pcurr",0);
		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,o.realTotalMoney,o.deliverMoney,qqNo,
				o.createTime,o.payType,o.isPay,o.isRefund,o.isAppraises,sp.shopName,orderFrom,orderFromId
				FROM __PREFIX__orders o,__PREFIX__shops sp
				WHERE o.orderFlag=1 and o.userId = $userId AND o.shopId=sp.shopId order by orderId desc ";
		
		
		
		$pages = $this->pageQuery($sql,$pcurr);	
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";	
	        $glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
		return $pages;
	}

	/**
	 * 获取待付款订单
	 */
	public function queryPayByPage($obj){
		$userId = (int)$obj["userId"];
		$orderNo = WSTAddslashes(I("orderNo"));
		$orderStatus = (int)I("orderStatus",0);
		$goodsName = WSTAddslashes(I("goodsName"));
		$shopName = WSTAddslashes(I("shopName"));
		$userName = WSTAddslashes(I("userName"));
		$pcurr = (int)I("pcurr",0);
		
		//检测【团购，抢购】状态
		$sql = "select og.orderId,og.goodsId,og.goodsNums,orderFrom,orderFromId from __PREFIX__order_goods og, __PREFIX__orders o where o.userId=$userId and og.orderId = o.orderId and o.payType = 1 and o.needPay > 0 and o.orderFlag=1 and o.orderStatus=-2";
		$list = $this->query($sql);
		for($i=0,$k=count($list);$i<$k;$i++){
			$order = $list[$i];
			$orderId = $order["orderId"];
			$orderFrom = $order["orderFrom"];
			$orderFromId = $order["orderFromId"];
			$goodsNums = $order["goodsNums"];
			$gpRd = array("status"=>1);
			if($orderFrom==2){//团购
				$gm = D("Common/Groups");
				$gpRd = $gm->checkGroupPay($orderFromId,$goodsNums);
			}else if($orderFrom==3){//抢购
				$pm = D("Common/Panics");
				$gpRd = $pm->checkPanicPay($orderFromId,$goodsNums);
			}
			if($gpRd["status"]==-1){
				WSTSendMsg($userId, "订单【".$orderNos."】".$groupRd["msg"]);
				$content = "订单已关闭";
				WSTOrderLog($orderId, $content, $userId,0);
				M('orders')->where("orderId = $orderId and payType = 1 and needPay > 0 and orderFlag=1 and orderStatus=-2")->save(array("orderStatus"=>-11));
			}
		}

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,o.realTotalMoney,o.deliverMoney,qqNo,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName,orderFrom,orderFromId 
		        FROM __PREFIX__orders o,__PREFIX__shops sp 
		        WHERE o.orderFlag=1 and o.userId = $userId AND o.orderStatus in (-2,-11) AND o.isPay = 0 AND o.payType = 1 AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		$sql .= " order by o.orderId desc";
		$pages = $this->pageQuery($sql,$pcurr);	
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";	
			$glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
		return $pages;
	}
	
	
	
	/**
	 * 获取待确认收货
	 */
	public function queryReceiveByPage($obj){
		$userId = (int)$obj["userId"];
		$orderNo = WSTAddslashes(I("orderNo"));
		$orderStatus = (int)I("orderStatus",0);
		$goodsName = WSTAddslashes(I("goodsName"));
		$shopName = WSTAddslashes(I("shopName"));
		$userName = WSTAddslashes(I("userName"));
		$pcurr = (int)I("pcurr",0);

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,o.realTotalMoney,o.deliverMoney,qqNo,o.isSelf,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName ,orderFrom,orderFromId
		        FROM __PREFIX__orders o,__PREFIX__shops sp WHERE o.orderFlag=1 and o.userId = $userId AND o.orderStatus =3 AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		$sql .= " order by o.orderId desc";
		$pages = $this->pageQuery($sql,$pcurr);	
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";	
			$glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
		return $pages;
	}
    /**
	 * 获取待发货订单
	 */
	public function queryDeliveryByPage($obj){
		$userId = (int)$obj["userId"];
		$orderNo = WSTAddslashes(I("orderNo"));
		$orderStatus = (int)I("orderStatus",0);
		$goodsName = WSTAddslashes(I("goodsName"));
		$shopName = WSTAddslashes(I("shopName"));
		$userName = WSTAddslashes(I("userName"));
		$pcurr = (int)I("pcurr",0);

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,o.realTotalMoney,o.deliverMoney,qqNo,o.isSelf,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName ,orderFrom,orderFromId
		        FROM __PREFIX__orders o,__PREFIX__shops sp 
		        WHERE o.orderFlag=1 and o.userId = $userId AND o.orderStatus in ( 0,1,2 ) AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		$sql .= " order by o.orderId desc";
		$pages = $this->pageQuery($sql,$pcurr);
       	
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";	
			$glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
		return $pages;
	}
    /**
	 * 获取退款
	 */
	public function queryRefundByPage($obj){
		$userId = (int)$obj["userId"];
		$orderNo = WSTAddslashes(I("orderNo"));
		$orderStatus = (int)I("orderStatus",0);
		$goodsName = WSTAddslashes(I("goodsName"));
		$shopName = WSTAddslashes(I("shopName"));
		$userName = WSTAddslashes(I("userName"));
		$sdate = WSTAddslashes(I("sdate"));
		$edate = WSTAddslashes(I("edate"));
		$pcurr = (int)I("pcurr",0);
		//必须是在线支付的才允许退款

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,o.realTotalMoney,o.deliverMoney,qqNo,o.isSelf,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName ,oc.complainId,orderFrom,orderFromId
		        FROM __PREFIX__orders o left join __PREFIX__order_complains oc on oc.orderId=o.orderId,__PREFIX__shops sp 
		        WHERE o.orderFlag=1 and o.userId = $userId AND (o.orderStatus in (-1,-3,-4,-5,-6,-7,-8,-9,10) and payType =1 AND o.isPay =1) AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		$sql .= " order by o.orderId desc";
		$pages = $this->pageQuery($sql,$pcurr);	
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";	
			$glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
		return $pages;
	}
	
	/**
	 * 获取取消的订单
	 */
	public function queryCancelOrders($obj){
		$userId = (int)$obj["userId"];
		$orderNo = WSTAddslashes(I("orderNo"));
		$orderStatus = (int)I("orderStatus",0);
		$goodsName = WSTAddslashes(I("goodsName"));
		$shopName = WSTAddslashes(I("shopName"));
		$userName = WSTAddslashes(I("userName"));
		$pcurr = (int)I("pcurr",0);

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,o.realTotalMoney,o.deliverMoney,qqNo,o.isSelf,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName ,orderFrom,orderFromId
		        FROM __PREFIX__orders o,__PREFIX__shops sp 
		        WHERE o.orderFlag=1 and o.userId = $userId AND o.orderStatus in (-1,-6,-7) AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		$sql .= " order by o.orderId desc";
		$pages = $this->pageQuery($sql,$pcurr);	
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";	
			$glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
		return $pages;
	}
	
	/**
	 * 获取待评价交易
	 */
	public function queryAppraiseByPage($obj){
		$userId = (int)$obj["userId"];
		$orderNo = WSTAddslashes(I("orderNo"));
		$goodsName = WSTAddslashes(I("goodsName"));
		$shopName = WSTAddslashes(I("shopName"));
		$userName = WSTAddslashes(I("userName"));
		$pcurr = (int)I("pcurr",0);
		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,o.realTotalMoney,o.deliverMoney,qqNo,o.isSelf,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName ,oc.complainId,orderFrom,orderFromId
		        FROM __PREFIX__orders o left join __PREFIX__order_complains oc on oc.orderId=o.orderId,__PREFIX__shops sp WHERE o.orderFlag=1 and o.isAppraises=0 and o.userId = $userId AND o.shopId=sp.shopId ";	
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		$sql .= " AND o.orderStatus = 4";
		$sql .= " order by o.orderId desc";
		$pages = $this->pageQuery($sql,$pcurr);	
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";	
			$glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
		return $pages;
	}
	
	/**
	 * 获取已完成交易
	 */
	public function queryCompleteOrders($obj){
		$userId = (int)$obj["userId"];
		$orderNo = WSTAddslashes(I("orderNo"));
		$goodsName = WSTAddslashes(I("goodsName"));
		$shopName = WSTAddslashes(I("shopName"));
		$userName = WSTAddslashes(I("userName"));
		$pcurr = (int)I("pcurr",0);
		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,o.realTotalMoney,o.deliverMoney,qqNo,o.isSelf,
				o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName ,oc.complainId,orderFrom,orderFromId
				FROM __PREFIX__orders o left join __PREFIX__order_complains oc on oc.orderId=o.orderId,__PREFIX__shops sp WHERE o.orderFlag=1 and o.isAppraises=1 and o.userId = $userId AND o.shopId=sp.shopId ";
		if($orderNo!=""){
		$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		$sql .= " AND o.orderStatus = 4";
		$sql .= " order by o.orderId desc";
		$pages = $this->pageQuery($sql,$pcurr);
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
			$sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";
			$glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
		return $pages;
	}
	
	
	
	/**
	 * 获取订单价格
	 */
	public function getMoneyByOrder($orderId = 0){
		$orderId = ($orderId>0)?$orderId:(int)I("orderId");
		$rs = $this->where(array('orderId'=>$orderId))->field('orderId,orderNo,deliverMoney,totalMoney,realTotalMoney,backMoney,useScore')->find();
		return $rs;
	}
	
	/**
	 * 商家标记取消订单已读
	 */
	public function orderRead(){
		$rd = array("status"=>-1);
		$orderId = (int)I("orderId");
		$shopId = (int)session("WST_USER.shopId");
		$sql = "SELECT orderId,orderStatus,payType FROM __PREFIX__orders WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;
		$rs = $this->queryRow($sql);
		$list = array(-1,-3,-6,-9);
		$status = array("-1"=>-8,"-3"=>-4,"-6"=>-7,"-9"=>-10);
		if($rs["payType"]==0 && in_array($rs["orderStatus"], $list)){
			$where = array();
			$where["orderFlag"] = 1;
			$where["orderId"] = $orderId;
			$where["shopId"] = $shopId;
			$where["orderStatus"] = $rs["orderStatus"];
			$flag = $this->where($where)->save(array("orderStatus"=>$status[$rs["orderStatus"]]));
			if($flag!==false){
				$rd["status"] = 1;
				$rd["msg"] = "操作成功";
			}else{
				$rd["msg"] = "操作失败，订单状态已发生改变，请刷新后再重试 !";
			}
			return $rd;
		}else{
			$rd["msg"] = "操作失败，订单状态已发生改变，请刷新后再重试 !";
			return $rd;
		}
	}
	
	
	
	
	
	
    /**
     * 获取订单详情
     */
	public function getOrderDetails($obj){
		$userId = (int)$obj["userId"];
		$shopId = (int)$obj["shopId"];
		$orderId = (int)$obj["orderId"];
		$data = array();
		$sql = "SELECT * FROM __PREFIX__orders WHERE orderFlag=1 and orderId = $orderId and (userId=".$userId." or shopId=".$shopId.")";	
		$order = $this->queryRow($sql);
		if(empty($order))return $data;
		$data["order"] = $order;
		$sql = "select og.orderId, og.goodsId ,g.goodsSn, og.goodsNums, og.goodsName , og.goodsPrice shopPrice,og.goodsThums,og.goodsAttrName,og.goodsAttrName 
				from __PREFIX__goods g , __PREFIX__order_goods og 
				WHERE g.goodsId = og.goodsId AND og.orderId = $orderId";
		$goods = $this->query($sql);
		$data["goodsList"] = $goods;

		$sql = "SELECT * FROM __PREFIX__log_orders WHERE orderId = $orderId ";	
		$logs = $this->query($sql);
		$data["logs"] = $logs;
		
		return $data;
		
	}
	
	/**
	 * 获取打印的订单
	 */
	public function getPrintOrders(){
		$shopId = session('WST_USER.shopId');
		$orderIds = self::formatIn(",",I("orderIds"));
		$list = array();
		$where = array("orderFlag"=>1,"shopId"=>$shopId,"orderId"=>array("in",$orderIds));
		$orders = $this->where($where)->select();
		for($i=0,$k=count($orders);$i<$k;$i++){
			$data = array();
			$order = $orders[$i];
			$orderId = $order["orderId"];
			$sql = "select og.orderId, og.goodsId ,g.goodsSn, og.goodsNums, og.goodsName , og.goodsPrice shopPrice,og.goodsThums,og.goodsAttrName,og.goodsAttrName 
					from __PREFIX__goods g , __PREFIX__order_goods og 
					WHERE g.goodsId = og.goodsId AND og.orderId = $orderId";
			$goods = $this->query($sql);
			$logs = M('log_orders')->where(array("orderId"=>$orderId))->select();

			$data["order"] = $order;
			$data["goodsList"] = $goods;
			$data["logs"] = $logs;
			$list[] = $data;
		}
		
		return $list;
	}
	
	/**
	 * 获取用户指定状态的订单数目
	 */
	public function getUserOrderStatusCount($obj){
		$userId = (int)$obj["userId"];
		$data = array();
		$sql = "select orderStatus,COUNT(*) cnt from __PREFIX__orders WHERE orderStatus in (0,1,2,3) and orderFlag=1 and userId = $userId GROUP BY orderStatus";
		$olist = $this->query($sql);
		$data = array('-3'=>0,'-2'=>0,'2'=>0,'3'=>0,'4'=>0);
		for($i=0;$i<count($olist);$i++){
			$row = $olist[$i];
			if($row["orderStatus"]==0 || $row["orderStatus"]==1 || $row["orderStatus"]==2){
				$row["orderStatus"] = 2;
			}
			$data[$row["orderStatus"]] = $data[$row["orderStatus"]]+$row["cnt"];
		}
		//获取未支付订单
		$sql = "select COUNT(*) cnt from __PREFIX__orders WHERE orderStatus = -2 and isRefund=0 and payType=1 and orderFlag=1 and isPay = 0 and needPay >0 and userId = $userId";
		$olist = $this->query($sql);
		$data[-2] = $olist[0]['cnt'];
		
		//获取退款订单
		$sql = "select COUNT(*) cnt from __PREFIX__orders WHERE orderStatus in (-3,-4,-6,-7) and isRefund=0 and payType=1 and orderFlag=1 and userId = $userId";
		$olist = $this->query($sql);
		$data[-3] = $olist[0]['cnt'];
		//获取待评价订单
		$sql = "select COUNT(*) cnt from __PREFIX__orders WHERE orderStatus =4 and isAppraises=0 and orderFlag=1 and userId = $userId";
		$olist = $this->query($sql);
		$data[4] = $olist[0]['cnt'];
		
		//获取商城信息
		$sql = "select count(*) cnt from __PREFIX__messages WHERE  receiveUserId=".$userId." and msgStatus=0 and msgFlag=1 ";
		$olist = $this->query($sql);
		$data[100000] = empty($olist)?0:$olist[0]['cnt'];
		
		return $data;
		
	}
	
	/**
	 * 获取用户指定状态的订单数目
	 */
	public function getShopOrderStatusCount($obj){
		$shopId = (int)$obj["shopId"];
		$rsdata = array();
		//待受理订单
		$sql = "SELECT COUNT(*) cnt FROM __PREFIX__orders WHERE orderFlag=1 and shopId = $shopId AND orderStatus = 0 ";
		$olist = $this->queryRow($sql);
		$rsdata[0] = $olist['cnt'];
		
		//取消-商家未知的 / 拒收订单
		$sql = "SELECT COUNT(*) cnt FROM __PREFIX__orders WHERE orderFlag=1 and shopId = $shopId AND orderStatus in (-3,-6)";
		$olist = $this->queryRow($sql);
		$rsdata[5] = $olist['cnt'];
		$rsdata[100] = $rsdata[0]+$rsdata[5];
		
		//获取商城信息
		$sql = "select count(*) cnt from __PREFIX__messages WHERE receiveUserId=".(int)$obj["userId"]." and msgStatus=0 and msgFlag=1 ";
		$olist = $this->query($sql);
		$rsdata[100000] = empty($olist)?0:$olist[0]['cnt'];
		
		return $rsdata;
	
	}
	
	
	/**
	 * 获取商家订单列表
	 */
	public function queryShopOrders($obj){
		$userId = (int)$obj["userId"];
		$shopId = (int)$obj["shopId"];
		$pcurr = (int)I("pcurr",0);
		$orderStatus = (int)I("statusMark");
		
		$orderNo = WSTAddslashes(I("orderNo"));
		$userName = WSTAddslashes(I("userName"));
		$userAddress = WSTAddslashes(I("userAddress"));
		$rsdata = array();
		$sql = "SELECT payType,orderNo,orderId,userId,userName,userAddress,totalMoney,realTotalMoney,orderStatus,createTime,refundRemark,orderFrom,orderFromId FROM __PREFIX__orders WHERE  orderFlag=1 and shopId = $shopId ";
		if($orderStatus==0){//待受理
			$sql.=" AND ((orderStatus=-1) or orderStatus=0)";
		}else if($orderStatus==1){//已受理
			$sql.=" AND (orderStatus=-6 or orderStatus=1)";
		}else if($orderStatus==2){//打包中
			$sql.=" AND (orderStatus=-9 or orderStatus=2)";
		}else if($orderStatus==3){//配送中
			$sql.=" AND (orderStatus=-3 or orderStatus=3)";
		}else if($orderStatus==4){//已收货
			$sql.=" AND orderStatus=4";
		}else{//取消/退款
			$sql.=" AND (orderStatus in (-3,-4,-5,-6,-7,-8,-9,-10) or (orderStatus=-1 and payType=0))";
		}
		
		if($orderNo!=""){
			$sql .= " AND orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND userName like '%$userName%'";
		}
		if($userAddress!=""){
			$sql .= " AND userAddress like '%$userAddress%'";
		}
		$sql.=" order by orderId desc ";
		$pages = $this->pageQuery($sql,$pcurr);
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
			$sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId,goodsNums,goodsPrice,goodsAttrName FROM __PREFIX__order_goods og
					WHERE og.orderId in (".implode(',',$orderIds).")";
			$glist = $this->query($sql);
			$goodslist = array();
			for($i=0;$i<count($glist);$i++){
				$goods = $glist[$i];
				$goodslist[$goods["orderId"]][] = $goods;
			}
			//放回分页数据里
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$order["goodslist"] = $goodslist[$order['orderId']];
				$pages["root"][$i] = $order;
			}
		}
	
		return $pages;
	}
	
	/**
	 * 商家受理订单-只能受理【未受理】的订单
	 */
	public function shopOrderAccept ($obj){		
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
		$shopId = (int)$obj["shopId"];
		$rsdata = array();
		$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderFlag=1 and orderId = $orderId AND orderFlag=1 and shopId=".$shopId;		
		$rsv = $this->queryRow($sql);
		if($rsv["orderStatus"]!=0){
			$rsdata["status"] = -1;
			return $rsdata;
		}

		$sql = "UPDATE __PREFIX__orders set orderStatus = 1 WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
		$rs = $this->execute($sql);		

		$data = array();
		$m = M('log_orders');
		$data["orderId"] = $orderId;
		$data["logContent"] = "商家已受理订单";
		$data["logUserId"] = $userId;
		$data["logType"] = 0;
		$data["logTime"] = date('Y-m-d H:i:s');
		$ra = $m->add($data);
		$rsdata["status"] = $ra;
		return $rsdata;
	}
	
    /**
	 * 商家批量受理订单-只能受理【未受理】的订单
	 */
	public function batchShopOrderAccept(){		
		$USER = session('WST_USER');
		$userId = (int)$USER["userId"];
		$orderIds = self::formatIn(",", I("orderIds"));
		$shopId = (int)$USER["shopId"];
		if($orderIds=='')return array('status'=>-2);
		$orderIds = explode(',',$orderIds);
		$orderNum = count($orderIds);
		$editOrderNum = 0;
		foreach ($orderIds as $orderId){
			if($orderId=='')continue;//订单号为空则跳过
			$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId AND orderFlag=1 and shopId=".$shopId;		
			$rsv = $this->queryRow($sql);
			if($rsv["orderStatus"]!=0)continue;//订单状态不符合则跳过
			$sql = "UPDATE __PREFIX__orders set orderStatus = 1 WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
			$rs = $this->execute($sql);		
	
			$data = array();
			$m = M('log_orders');
			$data["orderId"] = $orderId;
			$data["logContent"] = "商家已受理订单";
			$data["logUserId"] = $userId;
			$data["logType"] = 0;
			$data["logTime"] = date('Y-m-d H:i:s');
			$ra = $m->add($data);
			$editOrderNum++;
		}
		if($editOrderNum==0)return array('status'=>-1);//没有符合条件的执行操作
		if($editOrderNum<$orderNum)return array('status'=>-2);//只有部分订单符合操作
		return array('status'=>1);
	}
	
	/**
	 * 商家打包订单-只能处理[受理]的订单
	 */
	public function shopOrderProduce ($obj){		
		$userId = (int)$obj["userId"];
		$shopId = (int)$obj["shopId"];
		$orderId = (int)$obj["orderId"];
		$rsdata = array();
		$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId AND orderFlag =1 and shopId=".$shopId;		
		$rsv = $this->queryRow($sql);
		if($rsv["orderStatus"]!=1){
			$rsdata["status"] = -1;
			return $rsdata;
		}

		$sql = "UPDATE __PREFIX__orders set orderStatus = 2 WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
		$rs = $this->execute($sql);		
		$data = array();
		$m = M('log_orders');
		$data["orderId"] = $orderId;
		$data["logContent"] = "订单打包中";
		$data["logUserId"] = $userId;
		$data["logType"] = 0;
		$data["logTime"] = date('Y-m-d H:i:s');
		$ra = $m->add($data);
		$rsdata["status"] = $ra;;
		return $rsdata;
	}
	
    /**
	 * 商家批量打包订单-只能处理[受理]的订单
	 */
	public function batchShopOrderProduce (){		
		$USER = session('WST_USER');
		$userId = (int)$USER["userId"];
		$orderIds = self::formatIn(",", I("orderIds"));
		$shopId = (int)$USER["shopId"];
		if($orderIds=='')return array('status'=>-2);
		$orderIds = explode(',',$orderIds);
		$orderNum = count($orderIds);
		$editOrderNum = 0;
		foreach ($orderIds as $orderId){
			if($orderId=='')continue;//订单号为空则跳过
			$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId AND orderFlag =1 and shopId=".$shopId;		
			$rsv = $this->queryRow($sql);
			if($rsv["orderStatus"]!=1)continue;//订单状态不符合则跳过
	
			$sql = "UPDATE __PREFIX__orders set orderStatus = 2 WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
			$rs = $this->execute($sql);		
			$data = array();
			$m = M('log_orders');
			$data["orderId"] = $orderId;
			$data["logContent"] = "订单打包中";
			$data["logUserId"] = $userId;
			$data["logType"] = 0;
			$data["logTime"] = date('Y-m-d H:i:s');
			$ra = $m->add($data);
			$editOrderNum++;
		}
		if($editOrderNum==0)return array('status'=>-1);//没有符合条件的执行操作
		if($editOrderNum<$orderNum)return array('status'=>-2);//只有部分订单符合操作
		return array('status'=>1);
	}
	
	/**
	 * 商家发货配送订单
	 */
	public function shopOrderDelivery ($obj){		
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
		$shopId = (int)$obj["shopId"];
		$rsdata = array();
		$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId AND orderFlag =1 and shopId=".$shopId;		
		$rsv = $this->queryRow($sql);
		if($rsv["orderStatus"]!=2){
			$rsdata["status"] = -1;
			return $rsdata;
		}

		$sql = "UPDATE __PREFIX__orders set orderStatus = 3,deliveryTime='".date('Y-m-d H:i:s')."' WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
		$rs = $this->execute($sql);		

		$data = array();
		$m = M('log_orders');
		$data["orderId"] = $orderId;
		$data["logContent"] = "商家已发货";
		$data["logUserId"] = $userId;
		$data["logType"] = 0;
		$data["logTime"] = date('Y-m-d H:i:s');
		$ra = $m->add($data);
		$rsdata["status"] = $ra;;
		return $rsdata;
	}
	
    /**
	 * 商家发货配送订单
	 */
	public function batchShopOrderDelivery ($obj){		
		$USER = session('WST_USER');
		$userId = (int)$USER["userId"];
		$orderIds = self::formatIn(",",I("orderIds"));
		$shopId = (int)$USER["shopId"];
		if($orderIds=='')return array('status'=>-2);
		$orderIds = explode(',',$orderIds);
		$orderNum = count($orderIds);
		$editOrderNum = 0;
		foreach ($orderIds as $orderId){
			if($orderId=='')continue;//订单号为空则跳过
			$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId AND orderFlag =1 and shopId=".$shopId;		
			$rsv = $this->queryRow($sql);
			if($rsv["orderStatus"]!=2)continue;//状态不符合则跳过
	
			$sql = "UPDATE __PREFIX__orders set orderStatus = 3,deliveryTime='".date('Y-m-d H:i:s')."' WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
			$rs = $this->execute($sql);		
	
			$data = array();
			$m = M('log_orders');
			$data["orderId"] = $orderId;
			$data["logContent"] = "商家已发货";
			$data["logUserId"] = $userId;
			$data["logType"] = 0;
			$data["logTime"] = date('Y-m-d H:i:s');
			$ra = $m->add($data);
		    $editOrderNum++;
		}
		if($editOrderNum==0)return array('status'=>-1);//没有符合条件的执行操作
		if($editOrderNum<$orderNum)return array('status'=>-2);//只有部分订单符合操作
		return array('status'=>1);
	}
	
	/**
	 * 商家确认收货
	 */
	public function shopOrderReceipt ($obj){		
		$userId = (int)$obj["userId"];
		$shopId = (int)$obj["shopId"];
		$orderId = (int)$obj["orderId"];
		$rsdata = array();
		$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId AND orderFlag =1 and shopId=".$shopId;		
		$rsv = $this->queryRow($sql);
		if($rsv["orderStatus"]!=4){
			$rsdata["status"] = -1;
			return $rsdata;
		}

		$sql = "UPDATE __PREFIX__orders set orderStatus = 5 WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
		$rs = $this->execute($sql);		

		$data = array();
		$m = M('log_orders');
		$data["orderId"] = $orderId;
		$data["logContent"] = "商家确认已收货，订单完成";
		$data["logUserId"] = $userId;
		$data["logType"] = 0;
		$data["logTime"] = date('Y-m-d H:i:s');
		$ra = $m->add($data);
		$rsdata["status"] = $ra;;
		return $rsdata;
	}
	/**
	 * 商家退款
	 */
	public function shopOrderRefund ($obj){
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
		$shopId = (int)$obj["shopId"];
		$type = (int)I('refundStatus');
		$rd = array("status"=>-1);
		$status = array(-1,-3,-6,-9);
		$order = $this->where(array("orderId" => $orderId, "orderFlag" => 1, "shopId"=>$shopId))->field("shopId,orderId,orderNo,orderStatus,useScore,backMoney,realTotalMoney,userId")->find();
		if(!in_array($order["orderStatus"],$status)){
			$rd["msg"] = "操作失败，请检查订单状态是否已改变";
			return $rd;
		}
		//同意退款
        if($type==1){
        	if($order["backMoney"]==0 && $order["realTotalMoney"]>0){
        		$rd["msg"] = "操作失败，退款金额不能为0";
        		return $rd;
        	}
        	if($order["backMoney"]>$order["realTotalMoney"]){
        		$rd["msg"] = "操作失败，退款金额不能大于实支付金额";
        		return $rd;
        	}
        	
			$sql = "UPDATE __PREFIX__orders set orderStatus = -4,isRefund=1 WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
			$rs = $this->execute($sql);
			//加回库存
			if($rs>0){
				$oglist = M("order_goods")->where(array("orderId"=>$orderId))->field("goodsId,goodsNums,goodsAttrId")->select();
				foreach ($oglist as $key => $ogoods) {
					$goodsId = $ogoods["goodsId"];
					$goodsNums = $ogoods["goodsNums"];
					$goodsAttrId = $ogoods["goodsAttrId"];
					M("goods")->where(array("goodsId"=>$goodsId))->setInc("goodsStock",$goodsNums);
					if($goodsAttrId>0){
						M("goods_attributes")->where(array("id"=>$goodsAttrId))->setInc("attrStock",$goodsNums);
					}
				}
				
				//退款给用户
				if($order["backMoney"]>0){
					$data = array();
					$data["userMoney"] = array("exp", "userMoney+".$order["backMoney"]);
					$data["userScore"] = array("exp", "userScore+".$order["useScore"]);
					M("users")->where(array("userId"=>$order["userId"]))->save($data);
					$moneyRemark = "订单【".$order["orderNo"]."】退款";
					WSTMoneyLog(0,$order["userId"],$moneyRemark,6,$orderId,$order["backMoney"],0,0,1);
					WSTSendMsg($order["userId"], "您的订单【".$order["orderNo"]."】已退款，请注意查收！");
				}
				//余款退回给商家
				$balanceMoney = $order["realTotalMoney"] - $order["backMoney"];
				if($balanceMoney>0){
					$data = array();
					$spUserId = M("shops")->where(array("shopId"=>$order['shopId']))->getField("userId");
					$data["userMoney"] = array("exp", "userMoney+".$balanceMoney);
					M("users")->where(array("userId"=>$spUserId))->save($data);
					$moneyRemark = "订单【".$order["orderNo"]."】退款";
					WSTMoneyLog(0,$spUserId,$moneyRemark,6,$orderId,$balanceMoney,0,0,1);
					WSTSendMsg($spUserId, "店铺订单【".$order["orderNo"]."】余款已退回您的钱包，请注意查收！");
				}
				
				if($order["useScore"]>0){//退回积分
					
					$sql = "UPDATE __PREFIX__users set userScore=userScore+".$order["useScore"]." WHERE userId=".$order["userId"];
					$this->execute($sql);
					
					$data = array();
					$m = M('user_score');
					$data["userId"] = $order["userId"];
					$data["score"] = $order["useScore"];
					$data["dataSrc"] = 4;
					$data["dataId"] = $orderId;
					$data["dataRemarks"] = "取消订单返还";
					$data["scoreType"] = 1;
					$data["createTime"] = date('Y-m-d H:i:s');
					$m->add($data);
				}
				
			}	
        }else{//不同意拒收
        	if(I('content')==''){
        		$rd["msg"] = "请输入不同意退款原因";
        		return $rd;
        	}
        	$sql = "UPDATE __PREFIX__orders set orderStatus = -5 WHERE orderFlag=1 and orderId = $orderId and shopId=".$shopId;		
			$rs = $this->execute($sql);
        }
		
		$content = ($type==1)?"订单已退款":"商家不同意退款，原因【".I('content')."】";
		WSTOrderLog($orderId, $content, $userId,0);
		
		$rd["status"] = 1;
		$rd["msg"] = "操作成功";
		return $rd;
	}
	
	/**
	 * 检查订单是否已支付
	 */
	public function checkOrderPay (){
		$userId = (int)session('WST_USER.userId');
		$orderId = (int)I("orderId");
		$condition = "";
		if($orderId>0){
			$condition = " AND orderId = $orderId  ";
		}else{
			$orderunique = session("WST_ORDER_UNIQUE");
			$condition = " AND orderunique = '$orderunique' ";
		}
		$sql = "SELECT orderId,orderNo,orderFrom,orderFromId FROM __PREFIX__orders WHERE userId = $userId ".$condition." AND orderFlag = 1 AND orderStatus = -2 AND isPay = 0 AND payType = 1";
		$rsv = $this->query($sql);
		$oIds = array();
		for($i=0;$i<count($rsv);$i++){
			$oIds[] = $rsv[$i]["orderId"];
		}
		$orderIds = implode(",",$oIds);
		$data = array("status"=>-1);
		if(count($rsv)>0){
			if($rsv[0]["orderFrom"]<=1){
				$sql = "SELECT og.goodsId,og.goodsName,og.goodsAttrName,g.goodsStock,og.goodsNums, og.goodsAttrId, ga.attrStock FROM  __PREFIX__goods g ,__PREFIX__order_goods og
						left join __PREFIX__goods_attributes ga on ga.goodsId=og.goodsId and og.goodsAttrId=ga.id
						WHERE og.goodsId = g.goodsId and og.orderId in($orderIds)";
				$glist = $this->query($sql);
				if(count($glist)>0){
					$rlist = array();
					foreach ($glist as $goods) {
						if($goods["goodsAttrId"]>0){
							if($goods["attrStock"]<$goods["goodsNums"]){
								$rlist[] = $goods;
							}
						}else{
							if($goods["goodsStock"]<$goods["goodsNums"]){
								$rlist[] = $goods;
							}
						}
					}
					if(count($rlist)>0){
						$data["status"] = -2;
						$data["rlist"] = $rlist;
					}else{
						$data["status"] = 1;
					}
				}else{
					$data["status"] = 1;
				}
			}else{
				$data["status"] = 1;
			}
		}
		return $data;
	}
}