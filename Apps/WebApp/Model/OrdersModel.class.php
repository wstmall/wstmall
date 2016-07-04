<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
class OrdersModel extends BaseModel {
	/**
	 * 获取当前用户的订单列表
	 */
	public function getOrderList(){
		$userId = (int)session('WST_USER.userId');
		$currPage = (int)I("currPage", 1);
		$pageSize = I('pageSize') ? (int)I('pageSize') : 10;
		$m = M('orders');
		$status = (int)I('status', -999);
		$sql = "select o.payType,o.isPay,o.isRefund,o.orderId,o.orderNo,o.orderStatus,o.isAppraises,o.needPay,o.createTime,o.totalMoney+o.deliverMoney totalMoney,s.shopName,s.shopId,o.realTotalMoney 
		    from __PREFIX__orders o,__PREFIX__shops s WHERE o.shopId=s.shopId and o.userId=$userId AND o.orderFlag=1 ";
		if($status != -999){
			if($status == 1)$sql.=" and o.orderStatus=-2 ";//待付款
			if($status == 2)$sql.=" and o.orderStatus=0 ";//待受理
			if($status == 3)$sql.=" and o.orderStatus in(1,2,3) ";//待收货
			if($status == 4)$sql.=" and o.orderStatus=4";//已收货
			if($status == 5)$sql.=" and o.orderStatus=4 and o.isAppraises=0 ";//待评价
			if($status == 6)$sql.=" and o.orderStatus in (-1,-3,-4,-5,-6,-7) ";//取消或拒收
		}
		$sql .= " order by o.orderId desc";
		$rs = $m->pageQuery($sql,$currPage,$pageSize);

		if(count($rs['root'])>0){
			$ids = $idsCanComplains = $ogrs = $ocs = array();
			$statusCanComplains = array(-5,-4,-3,4);//可进行投诉订单状态
			foreach ($rs['root'] as $v){
				$ids[] = $v['orderId'];
				if( in_array($v['orderStatus'], $statusCanComplains) ){
					$idsCanComplains[] = $v['orderId'];
				}
			}
			//获取这些订单下的商品信息
			$sql = "select goodsThums,goodsId,goodsName,orderId,goodsNums,goodsPrice
			    from __PREFIX__order_goods where orderId in(".implode(',',$ids).") ";
			$grs = $m->query($sql);
			if(!empty($grs)){
				foreach ($grs as $v){
					$v['goodsThums'] = WSTMoblieImg($v['goodsThums']);
					$ogrs[$v['orderId']][] = $v;
				}
			}
			//获取投诉订单
			if( !empty($idsCanComplains) ){
				$sql = "select complainId,orderId from __PREFIX__order_complains where orderId in(".implode(',',$idsCanComplains).") ";
				$oc = $m->query($sql);
				if(!empty($oc)){
					foreach ($oc as $v){
						$ocs[$v['orderId']]['complainId'] = $v['complainId'];
					}
				}
			}
			//合并数据
			foreach ($rs['root'] as $key =>$v){
				$rs['root'][$key]['data'] = $ogrs[$v['orderId']];//商品信息
				$rs['root'][$key]['noComplains'] = ($ocs[$v['orderId']]['complainId']>0) ? 0 : 1;//订单投诉信息
			}
		}
		return $rs;
	}

	/**
	 * 获取当前用户各状态订单的数量
	 */
	public function getOrderCount(){
		$userId = (int)session('WST_USER.userId');
		$m = M('orders');
		$sql = "select orderStatus,isAppraises from __PREFIX__orders WHERE userId=$userId AND orderFlag=1 order by orderId desc";
		$data = $m->query($sql);
		$rs = array('payCount'=>0,'receiptCount'=>0,'receiptedCount'=>0,'appraisesCount'=>0,'cancelCount'=>0);
		$receiptStatus = array(1,2,3);//待收货的订单状态
		if($data){
			//计算各状态订单的数量
			foreach($data as $k=>$v){
				if($v['orderStatus']==-2) $rs['payCount']++;//待付款
				if(in_array($v['orderStatus'],$receiptStatus)) $rs['receiptCount']++;//待收货
				if($v['orderStatus']==4) $rs['receiptedCount']++;//已收货
				if($v['orderStatus']==4 && $v['isAppraises']==0) $rs['appraisesCount']++;//待评价
			}
		}
		return $rs;
	}

	/**
     * 获取订单详情
     */
	public function getOrderDetails(){
		$USER = session('WST_USER');
		$userId = (int)$USER['userId'];
		$shopId = (int)$USER['shopId'];
		$orderId = (int)I("orderId");
		$data = array();
		$morders = D('WebApp/Orders');
		$sql = "SELECT * FROM __PREFIX__orders WHERE orderId = $orderId and (userId=".$userId." or shopId=".$shopId.")";	
		$order = $this->queryRow($sql);
		if(empty($order))return $data;
		$data["order"] = $order;

		$sql = "select og.orderId, og.goodsId ,g.goodsSn, og.goodsNums, og.goodsName , og.goodsPrice shopPrice,og.goodsThums,og.goodsAttrName,og.goodsAttrName 
				from __PREFIX__goods g , __PREFIX__order_goods og 
				WHERE g.goodsId = og.goodsId AND og.orderId = $orderId";
		$goods = $this->query($sql);
		if(!empty($goods)){
			foreach($goods as $k=>$v){
				$goods[$k]['goodsThums'] = WSTMoblieImg($v['goodsThums']);
				$goods[$k]['money'] = $v['goodsNums']*$v['shopPrice'];
			}
		}
		$data["goodsList"] = $goods;
		
		for($i=0;$i<count($ogoodsList);$i++){
			$sgoods = $ogoodsList[$i];
			$sql="update __PREFIX__goods set goodsStock=goodsStock+".$sgoods['goodsNums']." where goodsId=".$sgoods["goodsId"];
			$this->execute($sql);
		}
		
		$sql = "SELECT * FROM __PREFIX__log_orders WHERE orderId = $orderId ";	
		$logs = $this->query($sql);
		$data["logs"] = $logs;
		
		return $data;
		
	}

	/**
	 * 结算-下单
	 */
	public function addOrder(){
		$rdata =array('status'=>-1);
		$userId = (int)session('WST_USER.userId');

		$sql = "select * from __PREFIX__cart where userId = $userId and isCheck=1 and goodsCnt>0";
		$shopcart = $this->query($sql);
		if(empty($shopcart)){
			$rdata['msg'] = '购物车为空!';
			return $rdata;
		}

		$cartIds = '';
		$shopIds = $shopGoodsMap = array();
		//获取商品信息
		foreach ($shopcart as $v){
			$cartIds .= $v['cartId'] . '#';
			$goodsId = $v['goodsId'];
			$goodsAttrId = $v['goodsAttrId'];
            $goodsCnt= $v['goodsCnt'];
            if($goodsId==0)continue;
            if($goodsCnt==0)$goodsCnt = 1;
			$sql = "SELECT g.shopId,g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,ga.id goodsAttrId,ga.attrPrice,ga.attrStock,ga.attrVal,a.attrName ,g.goodsSn
				        FROM __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.id=".$goodsAttrId."
						left join __PREFIX__attributes a on a.attrId=ga.attrId 
						WHERE g.goodsId = $goodsId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1 ";
			$goods =$this->queryRow($sql);
			if(empty($goods)){
				$rdata['msg'] = '下单失败，部分商品信息已过期~';
				return $rdata;
			}
			if($goods['goodsAttrId']>0){
				$goods['shopPrice'] = $goods['attrPrice'];
				$goods['goodsStock'] = $goods['attrStock'];
				$goods['goodsName'] = $goods['goodsName']."【".$goods['attrName'].":".$goods['attrVal']."】";
			    if($goodsCnt>$goods['goodsStock']){
					$rdata['msg'] = '下单失败，'.$goods['goodsName'].'库存只剩'.$goods['goodsStock']."件!";
					return $rdata;
				}
			}
			$goods['cnt'] = $goodsCnt;
			unset($goods['attrPrice'],$goods['attrStock']);
			//获取涉及的店铺
			if(!in_array($goods['shopId'],$shopIds)){
				$shopIds[] = $goods['shopId'];
			}
			//存放店铺商品
			$shopGoodsMap[$goods['shopId']]['goods'][] = $goods;
			//合计总价格
			$shopGoodsMap[$goods['shopId']]['totalMoney'] = $shopGoodsMap[$goods['shopId']]['totalMoney'] + $goods['shopPrice'] * $goodsCnt;
		}
		if(empty($shopGoodsMap)){
			$rdata['msg'] = '下单失败，商品信息已过期~';
			return $rdata;
		}
		//获取店铺数据
		$sql ="select userId,shopId,shopName,deliveryType,shopAtive,deliveryTime,isInvoice,deliveryFreeMoney,deliveryMoney,
		       deliveryStartMoney,serviceStartTime from __PREFIX__shops where shopStatus=1 and shopFlag=1 and shopId in(".implode(',',$shopIds).")";
		$shopRs = $this->query($sql);
		foreach ($shopRs as $v){
			$shops[$v['shopId']] = $v;
		}
		//检查订单金额是否达到店铺的起送价格
		foreach ($shops as $k=>$v){
			if( (float)$v['deliveryStartMoney'] > $shopGoodsMap[$k]['totalMoney'] ){
				$rdata['msg'] = '订单金额未达到起送价格¥'.$v['deliveryStartMoney'].'元';
				return $rdata;
			}
		}
		//获取店铺配送的社区
		$sql = "select shopId,communityId from __PREFIX__shops_communitys where shopId in(".implode(',',$shopIds).")";
		$communityRs = $this->query($sql);
		$shopCommunityRs = array();
		foreach ($communityRs as $v){
			$shopCommunityRs[$v['shopId']][] = $v['communityId'];
		}
		//核对店铺是否有设置配送的社区
		foreach ($shopIds as $v){
			if(empty($shopCommunityRs[$v])){
				$rdata['msg'] = '下单失败，店铺'.$shops[$v].'没有指定配送区域~';
				return $rdata;
			}
		}
	    //获取收货地区
		$addressInfo = $this->queryRow("select * from __PREFIX__user_address where addressFlag=1 and userId=".$userId." and addressId=".(int)I('addressId'));
		if(empty($addressInfo)){
			$rdata['msg'] = '下单失败，会员收货地址已过期~';
			return $rdata;
		}
		//核对是否符合配送区域
		foreach ($shopCommunityRs as $key =>$v){
			$isService = false;
			foreach ($v as $vc){
				if($vc==$addressInfo['communityId']){
					$isService = true;
					break;
				}
			}
			if(!$isService){
				$rdata['msg'] = '下单失败，店铺'.$shops[$v].'不在配送的区域内~';
			    return $rdata;
			}
		}

		//开始插入订单
		$orderunique = time().rand(100000,999999);
		$m = M('orderids');
		$addressDetails = UsersAddressModel::getAddressDetails();
		foreach ($shopRs as $key=> $shops){
			//生成订单ID
			$orderSrcNo = $m->add(array('rnd'=>microtime(true)));
			$orderNo = $orderSrcNo."".(fmod($orderSrcNo,7));
			//创建订单信息
			$data = array();
			$isSelf = (int)I('isSelf');
			$shopId = $shops['shopId'];
			$data["orderNo"] = $orderNo;
			$data["shopId"] = $shopId;	
			$deliverType = intval($shops["deliveryType"]);
			$data["userId"] = $userId;
			$data["orderFlag"] = 1;
			if( $isSelf == 1 ){//自提
				$deliverMoney = 0;
			}else{
				$deliverMoney = ($shopGoodsMap[$shops['shopId']]["totalMoney"]<$shops["deliveryFreeMoney"])?$shops["deliveryMoney"]:0;
			}
			$data["deliverMoney"] = $deliverMoney;
			$data["totalMoney"] = $shopGoodsMap[$shops['shopId']]["totalMoney"];
			$data["payType"] = intval(I('payType'));
			$data["deliverType"] = $deliverType;
			$data["userName"] = $addressInfo["userName"];
			$data["areaId1"] = $addressInfo["areaId1"];
			$data["areaId2"] = $addressInfo["areaId2"];
			$data["areaId3"] = $addressInfo["areaId3"];
			$data["communityId"] = $addressInfo["communityId"];
			$data["userAddress"] = $addressDetails["paddress"]." ".$addressInfo["address"];
			$data["userTel"] = $addressInfo["userTel"];
			$data["userPhone"] = $addressInfo["userPhone"];
			$data["userPostCode"] = $addressInfo["postCode"];
			$data['orderScore'] = floor($data["totalMoney"]);
			if( I("invoiceClient") != '' ){
				$data["isInvoice"] = 1;	
				$data["invoiceClient"] = I("invoiceClient");
			}
			$data["orderRemarks"] = I('orderRemarks');
			$data["requireTime"] = I("requireTime");
			$data["isAppraises"] = 0;
			$data["isSelf"] = ($isSelf == 1) ? 1 :0;
			//计算佣金
		    if($GLOBALS['CONFIG']['poundageRate']>0){
				$data["poundageRate"] = (float)$GLOBALS['CONFIG']['poundageRate'];
				$data["poundageMoney"] = WSTBCMoney($data["totalMoney"] * $data["poundageRate"] / 100,0,2);
			}else{
				$data["poundageRate"] = 0;
				$data["poundageMoney"] = 0;
			}
			//积分支付
			$isScorePay = (int)I("isScorePay",0);
			$scoreMoney = 0;
			$useScore = 0;
			if($GLOBALS['CONFIG']['isOpenScorePay']==1 && $isScorePay==1){//积分支付
				$baseScore = WSTOrderScore();
				$baseMoney = WSTScoreMoney();
				$sql = "select userId,userScore from __PREFIX__users where userId=$userId";
				$user = $this->queryRow($sql);
				$useScore = $baseScore*floor($user["userScore"]/$baseScore);
				$scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
				$orderTotalMoney = $data["totalMoney"]+$deliverMoney;
				if($orderTotalMoney < $scoreMoney){//订单金额小于积分金额
					$useScore = $baseScore*floor($orderTotalMoney/$baseMoney);
					$scoreMoney = $baseMoney*floor($orderTotalMoney/$baseMoney);
				}
				$data["useScore"] = $useScore;
				$data["scoreMoney"] = $scoreMoney;
			}
			$data["realTotalMoney"] = $data["totalMoney"] + $deliverMoney - $scoreMoney;
			$data["needPay"] = $data["realTotalMoney"];
			$data["createTime"] = date("Y-m-d H:i:s");
			$data["orderSrc"] = 2;
			if($data["payType"]==1){
				$data["orderStatus"] = -2;
			}else{
				$data["orderStatus"] = 0;
			}
			$data["orderunique"] = $orderunique;
			$data["isPay"] = ($data["needPay"]==0) ? 1 : 0;

			$morders = M('orders');
			$orderId = $morders->add($data);	
			//订单创建成功则建立相关记录
			if($orderId!==false){
				$orderIds[] = $orderId;
				$goods = $shopGoodsMap[$shops['shopId']]['goods'];
				//建立订单商品记录表
				$mog = M('order_goods');
				foreach ($goods as $key=> $sgoods){
					$data = array();
					$data["orderId"] = $orderId;
					$data["goodsId"] = $sgoods["goodsId"];
					$data["goodsAttrId"] = (int)$sgoods["goodsAttrId"];
					if($sgoods["attrVal"]!='')$data["goodsAttrName"] = $sgoods["attrName"].":".$sgoods["attrVal"];
					$data["goodsNums"] = $sgoods["cnt"];
					$data["goodsThums"] = $sgoods["goodsThums"];
					$data["goodsName"] = $sgoods["goodsName"];
					$data["goodsPrice"] = $sgoods["shopPrice"];
					$mog->add($data);
					//修改订单库存
				    $sql="update __PREFIX__goods set goodsStock=goodsStock-".$sgoods['cnt']." where goodsId=".$sgoods["goodsId"];
					$this->execute($sql);
					if((int)$sgoods["goodsAttrId"]>0){
						$sql="update __PREFIX__goods_attributes set attrStock=attrStock-".$sgoods['cnt']." where id=".$sgoods["goodsAttrId"];
					}
				}
				//进行积分支付并创建积分记录
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
				if($payway==0){
					//建立订单提醒
					$morm = M('order_reminds');
					$data = array();
					$data["orderId"] = $orderId;
					$data["shopId"] = $shopId;
					$data["userId"] = $shopRs[$shopId]["userId"];
					$data["userType"] = 0;
					$data["remindType"] = 0;
					$data["createTime"] = date("Y-m-d H:i:s");
					$morm->add($data);
				}
				//建立订单记录
				$data = array();
				$data["orderId"] = $orderId;
				if($payway==0){
				     $data["logContent"] = ($deliverType==0)? "下单成功":"下单成功等待审核";
				}else{
					 $data["logContent"] = "订单已提交，等待支付";
				}
				$data["logUserId"] = $userId;
				$data["logType"] = 0;
				$data["logTime"] = date('Y-m-d H:i:s');
				$mlogo = M('log_orders');
				$mlogo->add($data);
			}
		}
		$rdata['orderIds'] = $orderIds;
		$rdata['status'] = 1;
		$rdata['msg'] = '下单成功~';
		
		//删除购物车中的相关数据
		D('cart')->delCartGoods($cartIds);

		return $rdata;
	}
	
	/**
	 * 取消订单
	 */
	public function cancelOrder($obj){		
		$userId = $obj["userId"];
		$orderId = $obj["orderId"];
		$rsdata = array('status'=>-1);
		//判断订单状态，只有符合状态的订单才允许改变
		$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId and orderFlag = 1 and userId=".$userId;		
		$rsv = $this->queryRow($sql);
		$cancelStatus = array(0,1,2,-2);//未受理,已受理,打包中,待付款订单
		if(!in_array($rsv["orderStatus"], $cancelStatus))return $rsdata;
		//如果是未受理和待付款的订单直接改为"用户取消【受理前】"，已受理和打包中的则要改成"用户取消【受理后-商家未知】"，后者要给商家知道有这么一回事，然后再改成"用户取消【受理后-商家已知】"的状态
		$orderStatus = -6;//取对商家影响最小的状态
		if($rsv["orderStatus"]==0 || $rsv["orderStatus"]==-2)$orderStatus = -1;
		if($orderStatus==-6 && I('rejectionRemarks')=='')return $rsdata;//如果是受理后取消需要有原因
		$sql = "UPDATE __PREFIX__orders set orderStatus = ".$orderStatus." WHERE orderId = $orderId and userId=".$userId;	
		$rs = $this->execute($sql);		
		
		$sql = "select ord.deliverType, ord.orderId, og.goodsId ,og.goodsId, og.goodsNums 
				from __PREFIX__orders ord , __PREFIX__order_goods og 
				WHERE ord.orderId = og.orderId AND ord.orderId = $orderId";
		$ogoodsList = $this->query($sql);
		//获取商品库存
		for($i=0;$i<count($ogoodsList);$i++){
			$sgoods = $ogoodsList[$i];
			$sql="update __PREFIX__goods set goodsStock=goodsStock+".$sgoods['goodsNums']." where goodsId=".$sgoods["goodsId"];
			$this->execute($sql);
		}
		$sql="Delete From __PREFIX__order_reminds where orderId=".$orderId." AND remindType=0";
		$this->execute($sql);
		
		$data = array();
		$m = M('log_orders');
		$data["orderId"] = $orderId;
		$data["logContent"] = "用户已取消订单".(($orderStatus==-6)?"：".I('rejectionRemarks'):"");
		$data["logUserId"] = $userId;
		$data["logType"] = 0;
		$data["logTime"] = date('Y-m-d H:i:s');
		$ra = $m->add($data);
		$rsdata["status"] = $ra;
		return $rsdata;
		
	}

	/**
	 * 确认/拒收订单
	 */
    public function confirmOrder(){	
      	$USER = session('WST_USER');
      	$userId = (int)$USER['userId'];	
		$orderId = (int)I("orderId");
		$type = (int)I("type");
		$sql = "SELECT orderId,orderNo,shopId,orderScore,useScore,scoreMoney,poundageRate,poundageMoney,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId and userId=".$userId;		
		$rsv = $this->queryRow($sql);
		if($rsv["orderStatus"]!=3)return -1;
		
        //收货则给用户增加积分
        if($type==1){
        	$sql = "UPDATE __PREFIX__orders set orderStatus = 4,receiveTime='".date('Y-m-d H:i:s')."' WHERE orderId = $orderId and userId=".$userId;			
        	$rs = $this->execute($sql);
        	
        	//修改商品销量
        	$sql = "UPDATE __PREFIX__goods g, __PREFIX__order_goods og, __PREFIX__orders o SET g.saleCount=g.saleCount+og.goodsNums WHERE g.goodsId= og.goodsId AND og.orderId = o.orderId AND o.orderId=$orderId AND o.userId=".$userId;
        	$rs = $this->execute($sql);
        	
            //修改积分
        	if((int)$GLOBALS['CONFIG']['isOrderScore']==1){
	        	$sql = "UPDATE __PREFIX__users set userScore=userScore+".$rsv["orderScore"].",userTotalScore=userTotalScore+".$rsv["orderScore"]." WHERE userId=".$userId;
	        	$rs = $this->execute($sql);
	        	
	        	$data = array();
	        	$m = M('user_score');
	        	$data["userId"] = $userId;
	        	$data["score"] = $rsv["orderScore"];
	        	$data["dataSrc"] = 1;
	        	$data["dataId"] = $orderId;
	        	$data["dataRemarks"] = "交易获得";
	        	$data["scoreType"] = 1;
	        	$data["createTime"] = date('Y-m-d H:i:s');
	        	$m->add($data);
        	}
        	//积分支付支出
        	if($rsv["scoreMoney"]>0){
        		$data = array();
        		$m = M('log_sys_moneys');
        		$data["targetType"] = 0;
        		$data["targetId"] = $userId;
        		$data["dataSrc"] = 2;
        		$data["dataId"] = $orderId;
        		$data["moneyRemark"] = "订单【".$rsv["orderNo"]."】支付 ".$rsv["useScore"]." 个积分，支出 ￥".$rsv["scoreMoney"];
        		$data["moneyType"] = 2;
        		$data["money"] = $rsv["scoreMoney"];
        		$data["createTime"] = date('Y-m-d H:i:s');
        		$data["dataFlag"] = 1;
        		$m->add($data);
        	}
        	//收取订单佣金
        	if($rsv["poundageMoney"]>0){
        		$data = array();
        		$m = M('log_sys_moneys');
        		$data["targetType"] = 1;
        		$data["targetId"] = $rsv["shopId"];
        		$data["dataSrc"] = 1;
        		$data["dataId"] = $orderId;
        		$data["moneyRemark"] = "收取订单【".$rsv["orderNo"]."】".$rsv["poundageRate"]."%的佣金 ￥".$rsv["poundageMoney"];
        		$data["moneyType"] = 1;
        		$data["money"] = $rsv["poundageMoney"];
        		$data["createTime"] = date('Y-m-d H:i:s');
        		$data["dataFlag"] = 1;
        		$m->add($data);
        	}
        }else{
        	if(I('rejectionRemarks')=='')return -2;//如果是拒收的话需要填写原因
        	$sql = "UPDATE __PREFIX__orders set orderStatus = -3 WHERE orderId = $orderId and userId=".$userId;			
        	$rs = $this->execute($sql);
        }
        //增加记录
		$data = array();
		$m = M('log_orders');
		$data["orderId"] = $orderId;
		$data["logContent"] = ($type==1)?"用户已收货":"用户拒收：".I('rejectionRemarks');
		$data["logUserId"] = $userId;
		$data["logType"] = 0;
		$data["logTime"] = date('Y-m-d H:i:s');
		$ra = $m->add($data);
		$rs = array('status'=>1);
		return $rs;
	}
}