<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
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
		$sql = "SELECT * FROM __PREFIX__orders WHERE userId = $userId AND orderStatus <>-1 order by createTime desc";		
		return $m->pageQuery($sql);
	}
	
	/**
	 * 取消订单记录 
	 */
	public function getcancelOrderList($obj){		
		$userId = $obj["userId"];
		$m = M('orders');
		$sql = "SELECT * FROM __PREFIX__orders WHERE userId = $userId AND orderStatus =-1 order by createTime desc";		
		return $m->pageQuery($sql);
		
	}

	/**
	 * 获取订单详情
	 */
	public function getOrdersDetails($obj){		
		$orderId = $obj["orderId"];
		$sql = "SELECT od.*,sp.shopName 
				FROM __PREFIX__orders od, __PREFIX__shops sp 
				WHERE od.shopId = sp.shopId And orderId = $orderId ";		
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
			
		$orderIds = $obj["orderIds"];
		$sql = "SELECT o.orderId, o.orderNo, g.goodsId, g.goodsName ,og.goodsAttrName , og.goodsNums ,og.goodsPrice 
				FROM __PREFIX__order_goods og, __PREFIX__goods g, __PREFIX__orders o
				WHERE o.orderId = og.orderId AND og.goodsId = g.goodsId AND o.payType=1 AND orderFlag =1 AND o.isPay=0 AND o.needPay>0 AND o.orderStatus = -2 AND og.orderId in ($orderIds)";
		$rslist = $this->query($sql);
		$orders = array();
		foreach ($rslist as $key => $order) {
			$orders[$order["orderNo"]][] = $order;
		}
		$sql = "SELECT SUM(needPay) needPay FROM __PREFIX__orders WHERE orderId IN ($orderIds) AND isPay=0 AND payType=1 AND needPay>0 AND orderStatus = -2 AND orderFlag =1";
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
		$userId = (int)$USER['userId'];
		
		$consigneeId = (int)I("consigneeId");
		$payway = (int)I("payway");
		$isself = (int)I("isself");
		$needreceipt = (int)I("needreceipt");
		$orderunique = WSTAddslashes(I("orderunique"));
		$shopcat = session("WST_CART")?session("WST_CART"):array();	
		
		$catgoods = array();	
		$order = array();
		if(empty($shopcat)){
			$rd['msg'] = '购物车为空!';
			return $rd;
		}else{
			//整理及核对购物车数据
			$paygoods = session('WST_PAY_GOODS');
			foreach($shopcat as $key=>$cgoods){
				if($cgoods['ischk']==0)continue;//跳过未选中的商品
				$temp = explode('_',$key);
				$goodsId = (int)$temp[0];
				$goodsAttrId = (int)$temp[1];
				if(in_array($goodsId, $paygoods)){
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
					$goods["cnt"] = $cgoods["cnt"];
					$totalCnt += $cgoods["cnt"];
					$totalMoney += $goods["cnt"]*$goods["shopPrice"];
					$catgoods[$goods["shopId"]]["shopgoods"][] = $goods;
					$catgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
					$catgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺免运费最低金额
					$catgoods[$goods["shopId"]]["totalCnt"] = $catgoods[$goods["shopId"]]["totalCnt"]+$cgoods["cnt"];
					$catgoods[$goods["shopId"]]["totalMoney"] = $catgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
				}
			}
			foreach($catgoods as $key=> $cshop){
				if($cshop["totalMoney"]<$cshop["deliveryFreeMoney"]){
					if($isself==0){
						$totalMoney = $totalMoney + $cshop["deliveryMoney"];
					}
				}
			}
			$morders->startTrans();	
			try{
				$ordersInfo = $morders->addOrders($userId,$consigneeId,$payway,$needreceipt,$catgoods,$orderunique,$isself);
				$newcart = array();
				foreach($shopcat as $key=>$cgoods){
					if(!in_array($key, $paygoods)){
						$newcart[$key] = $cgoods;
					}
				}
				$morders->commit();	
				session("WST_CART",empty($newcart)?null:$newcart);
				$rd['orderIds'] = implode(",",$ordersInfo["orderIds"]);
				$rd['status'] = 1;
				
			}catch(Exception $e){
				$morders->rollback();
				$rd['msg'] = '下单出错，请联系管理员!';
			}
			return $rd;
		}		
	}
	
	/**
	 * 生成订单
	 */
	public function addOrders($userId,$consigneeId,$payway,$needreceipt,$catgoods,$orderunique,$isself){	
		
		$orderInfos = array();
		$orderIds = array();
		$orderNos = array();
		$remarks = I("remarks");
		
		$addressInfo = UserAddressModel::getAddressDetails($consigneeId);
        $m = M('orderids');
        
		foreach ($catgoods as $key=> $shopgoods){
			//生成订单ID
			$orderSrcNo = $m->add(array('rnd'=>microtime(true)));
			$orderNo = $orderSrcNo."".(fmod($orderSrcNo,7));
			//创建订单信息
			$data = array();
			$pshopgoods = $shopgoods["shopgoods"];
			$shopId = $pshopgoods[0]["shopId"];
			$data["orderNo"] = $orderNo;
			$data["shopId"] = $shopId;	
			$deliverType = intval($pshopgoods[0]["deliveryType"]);
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
			
			$data['orderScore'] = round($data["totalMoney"]+$data["deliverMoney"],0);
			$data["isInvoice"] = $needreceipt;		
			$data["orderRemarks"] = $remarks;
			$data["requireTime"] = I("requireTime");
			$data["invoiceClient"] = I("invoiceClient");
			$data["isAppraises"] = 0;
			$data["isSelf"] = $isself;
			$data["needPay"] = $shopgoods["totalMoney"]+$deliverMoney;

			$data["createTime"] = date("Y-m-d H:i:s");
			
			if($payway==1){
				$data["orderStatus"] = -2;
			}else{
				$data["orderStatus"] = 0;
			}
			
			$data["orderunique"] = $orderunique;
			$data["isPay"] = 0;
			$morders = M('orders');
			$orderId = $morders->add($data);	

			//订单创建成功则建立相关记录
			if($orderId>0){
				$orderIds[] = $orderId;
				//建立订单商品记录表
				$mog = M('order_goods');
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
					
					$mog->add($data);
					
				}
			
				if($payway==0){
					//建立订单记录
					$data = array();
					$data["orderId"] = $orderId;
					$data["logContent"] = ($pshopgoods[0]["deliverType"]==0)? "下单成功":"下单成功等待审核";
					$data["logUserId"] = $userId;
					$data["logType"] = 0;
					$data["logTime"] = date('Y-m-d H:i:s');
					$mlogo = M('log_orders');
					$mlogo->add($data);
					
					
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
					foreach ($pshopgoods as $key=> $sgoods){
						$sql="update __PREFIX__goods set goodsStock=goodsStock-".$sgoods['cnt']." where goodsId=".$sgoods["goodsId"];
						$this->execute($sql);
						if((int)$sgoods["goodsAttrId"]>0){
							$sql="update __PREFIX__goods_attributes set attrStock=attrStock-".$sgoods['cnt']." where id=".$sgoods["goodsAttrId"];
							$this->execute($sql);
						}
					}
				}else{
					$data = array();
					$data["orderId"] = $orderId;
					$data["logContent"] = "订单已提交，等待支付";
					$data["logUserId"] = $userId;
					$data["logType"] = 0;
					$data["logTime"] = date('Y-m-d H:i:s');
					$mlogo = M('log_orders');
					$mlogo->add($data);
				}
			}
		}
		
		return array("orderIds"=>$orderIds);
		
	}
	
	/**
	 * 获取订单参数
	 */
	public function getOrderListByIds(){
		 $ids = explode(',',I('orderIds'));
		 $id = array();
		 foreach ($ids as $v) {
		 	if(trim($v)!='')$id[] = $v;
		 }
		 $orderInfos = array('totalMoney'=>0,'isMoreOrder'=>0,'list'=>array());
		 if(empty($id))return $orderInfos;
		 $sql = "select orderId,orderNo,totalMoney,deliverMoney 
		         from __PREFIX__orders where userId=".(int)session('WST_USER.userId')." 
		         and orderunique='".I('orderunique')."' and orderId in (".implode(',',$id).") and orderFlag=1 ";
	     $rs = $this->query($sql);
	     
	     if(!empty($rs)){
	     	$totalMoney = 0;
	     	foreach ($rs as $key =>$v){
	     		$orderInfos['list'][] = array('orderId'=>$v['orderId'],'orderNo'=>$v['orderNo']);
	     		$totalMoney = $v['totalMoney'] + $v['deliverMoney'];
	     	}
	     	$orderInfos['totalMoney'] = $totalMoney;
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
		$sql = "SELECT o.* FROM __PREFIX__orders o
				WHERE userId = $userId AND orderFlag=1 order by orderId desc";
		$pages = $this->pageQuery($sql,$pcurr);	
		$orderList = $pages["root"];
		if(count($orderList)>0){
			$orderIds = array();
			for($i=0;$i<count($orderList);$i++){
				$order = $orderList[$i];
				$orderIds[] = $order["orderId"];
			}
			//获取涉及的商品
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId FROM __PREFIX__order_goods og
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
		$sdate = I("sdate");
		$edate = I("edate");
		$pcurr = (int)I("pcurr",0);
		
		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName 
		        FROM __PREFIX__orders o,__PREFIX__shops sp 
		        WHERE o.userId = $userId AND o.orderStatus =-2 AND o.isPay = 0 AND needPay >0 AND o.payType = 1 AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		if($sdate!=""){
			$sql .= " AND o.createTime >= $sdate";
		}
		if($edate!=""){
			$sql .= " AND o.createTime <= $edate";
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
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId FROM __PREFIX__order_goods og
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
		$sdate = WSTAddslashes(I("sdate"));
		$edate = WSTAddslashes(I("edate"));
		$pcurr = (int)I("pcurr",0);

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName 
		        FROM __PREFIX__orders o,__PREFIX__shops sp WHERE o.userId = $userId AND o.orderStatus =3 AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		if($sdate!=""){
			$sql .= " AND o.createTime >= $sdate";
		}
		if($edate!=""){
			$sql .= " AND o.createTime <= $edate";
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
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId FROM __PREFIX__order_goods og
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
		$sdate = WSTAddslashes(I("sdate"));
		$edate = WSTAddslashes(I("edate"));
		$pcurr = (int)I("pcurr",0);

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName 
		        FROM __PREFIX__orders o,__PREFIX__shops sp 
		        WHERE o.userId = $userId AND o.orderStatus in ( 0,1,2 ) AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		if($sdate!=""){
			$sql .= " AND o.createTime >= $sdate";
		}
		if($edate!=""){
			$sql .= " AND o.createTime <= $edate";
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
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId FROM __PREFIX__order_goods og
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

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName ,oc.complainId
		        FROM __PREFIX__orders o left join __PREFIX__order_complains oc on oc.orderId=o.orderId,__PREFIX__shops sp 
		        WHERE o.userId = $userId AND (o.orderStatus in (-3,-4,-5) or (o.orderStatus in (-1,-4,-6,-7) and payType =1 AND o.isPay =1)) AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		if($sdate!=""){
			$sql .= " AND o.createTime >= $sdate";
		}
		if($edate!=""){
			$sql .= " AND o.createTime <= $edate";
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
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId FROM __PREFIX__order_goods og
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
		$sdate = WSTAddslashes(I("sdate"));
		$edate = WSTAddslashes(I("edate"));
		$pcurr = (int)I("pcurr",0);

		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName 
		        FROM __PREFIX__orders o,__PREFIX__shops sp 
		        WHERE o.userId = $userId AND o.orderStatus in (-1,-6,-7) AND o.shopId=sp.shopId ";
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		if($sdate!=""){
			$sql .= " AND o.createTime >= $sdate";
		}
		if($edate!=""){
			$sql .= " AND o.createTime <= $edate";
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
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId FROM __PREFIX__order_goods og
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
		$sdate = WSTAddslashes(I("sdate"));
		$edate = WSTAddslashes(I("edate"));
		$pcurr = (int)I("pcurr",0);
		$sql = "SELECT o.orderId,o.orderNo,o.shopId,o.orderStatus,o.userName,o.totalMoney,
		        o.createTime,o.payType,o.isRefund,o.isAppraises,sp.shopName ,oc.complainId
		        FROM __PREFIX__orders o left join __PREFIX__order_complains oc on oc.orderId=o.orderId,__PREFIX__shops sp WHERE o.userId = $userId AND o.shopId=sp.shopId ";	
		if($orderNo!=""){
			$sql .= " AND o.orderNo like '%$orderNo%'";
		}
		if($userName!=""){
			$sql .= " AND o.userName like '%$userName%'";
		}
		if($shopName!=""){
			$sql .= " AND sp.shopName like '%$shopName%'";
		}
		if($sdate!=""){
			$sql .= " AND o.createTime >= $sdate";
		}
		if($edate!=""){
			$sql .= " AND o.createTime <= $edate";
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
	        $sql = "SELECT og.goodsId,og.goodsName,og.goodsThums,og.orderId FROM __PREFIX__order_goods og
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
	 * 取消订单
	 */
	public function orderCancel($obj){		
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
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
	 * 用户确认收货
	 */
	public function orderConfirm ($obj){		
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
		$type = (int)$obj["type"];
		$rsdata = array();
		$sql = "SELECT orderId,orderNo,orderScore,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId and userId=".$userId;		
		$rsv = $this->queryRow($sql);
		if($rsv["orderStatus"]!=3){
			$rsdata["status"] = -1;
			return $rsdata;
		}		
        //收货则给用户增加积分
        if($type==1){
        	$sql = "UPDATE __PREFIX__orders set orderStatus = 4 WHERE orderId = $orderId and userId=".$userId;			
        	$rs = $this->execute($sql);
        	
        	//修改商品销量
        	$sql = "UPDATE __PREFIX__goods g, __PREFIX__order_goods og, __PREFIX__orders o SET g.saleCount=g.saleCount+og.goodsNums WHERE g.goodsId= og.goodsId AND og.orderId = o.orderId AND o.orderId=$orderId AND o.userId=".$userId;
        	$rs = $this->execute($sql);
        	
        	$sql = "UPDATE __PREFIX__users set userScore=userScore+".$rsv["orderScore"]." WHERE userId=".$userId;
        	$rs = $this->execute($sql);
        }else{
        	if(I('rejectionRemarks')=='')return $rsdata;//如果是拒收的话需要填写原因
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
		$rsdata["status"] = $ra;;
		return $rsdata;
	}
	
    /**
     * 获取订单详情
     */
	public function getOrderDetails($obj){
		$userId = (int)$obj["userId"];
		$shopId = (int)$obj["shopId"];
		$orderId = (int)$obj["orderId"];
		$data = array();
		$sql = "SELECT * FROM __PREFIX__orders WHERE orderId = $orderId and (userId=".$userId." or shopId=".$shopId.")";	
		$order = $this->queryRow($sql);
		if(empty($order))return $data;
		$data["order"] = $order;

		$sql = "select og.orderId, og.goodsId ,g.goodsSn, og.goodsNums, og.goodsName , og.goodsPrice shopPrice,og.goodsThums,og.goodsAttrName,og.goodsAttrName 
				from __PREFIX__goods g , __PREFIX__order_goods og 
				WHERE g.goodsId = og.goodsId AND og.orderId = $orderId";
		$goods = $this->query($sql);
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
		$sql = "SELECT COUNT(*) cnt FROM __PREFIX__orders WHERE shopId = $shopId AND orderStatus = 0 ";
		$olist = $this->queryRow($sql);
		$rsdata[0] = $olist['cnt'];
		
		//取消-商家未知的 / 拒收订单
		$sql = "SELECT COUNT(*) cnt FROM __PREFIX__orders WHERE shopId = $shopId AND orderStatus in (-3,-6)";
		$olist = $this->queryRow($sql);
		$rsdata[5] = $olist['cnt'];
		$rsdata[100] = $rsdata[0]+$rsdata[5];
		
		//获取商城信息
		$sql = "select count(*) cnt from __PREFIX__messages WHERE  receiveUserId=".(int)$obj["userId"]." and msgStatus=0 and msgFlag=1 ";
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
		$sql = "SELECT orderNo,orderId,userId,userName,userAddress,totalMoney,orderStatus,createTime FROM __PREFIX__orders WHERE shopId = $shopId ";
		if($orderStatus==5){
			$sql.=" AND orderStatus in (-3,-4,-5,-6,-7)";
		}else{
			$sql.=" AND orderStatus = $orderStatus ";	
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
		$data = $this->pageQuery($sql,$pcurr);
		//获取取消/拒收原因
		$orderIds = array();
		$noReadrderIds = array();
		foreach ($data['root'] as $key => $v){	
			if($v['orderStatus']==-6)$noReadrderIds[] = $v['orderId'];
			$sql = "select logContent from __PREFIX__log_orders where orderId =".$v['orderId']." and logType=0 and logUserId=".$v['userId']." order by logId desc limit 1";
			$ors = $this->query($sql);
			$data['root'][$key]['rejectionRemarks'] = $ors[0]['logContent'];
		}
		
		//要对用户取消【-6】的状态进行处理,表示这一条取消信息商家已经知道了
		if($orderStatus==5 && count($noReadrderIds)>0){
			$sql = "UPDATE __PREFIX__orders set orderStatus=-7 WHERE shopId = $shopId AND orderId in (".implode(',',$noReadrderIds).")AND orderStatus = -6 ";
			$this->execute($sql);
		}
		return $data;
	}
	
	/**
	 * 商家受理订单-只能受理【未受理】的订单
	 */
	public function shopOrderAccept ($obj){		
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
		$shopId = (int)$obj["shopId"];
		$rsdata = array();
		$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId AND orderFlag=1 and shopId=".$shopId;		
		$rsv = $this->queryRow($sql);
		if($rsv["orderStatus"]!=0){
			$rsdata["status"] = -1;
			return $rsdata;
		}

		$sql = "UPDATE __PREFIX__orders set orderStatus = 1 WHERE orderId = $orderId and shopId=".$shopId;		
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
		$orderIds = I("orderIds");
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
			$sql = "UPDATE __PREFIX__orders set orderStatus = 1 WHERE orderId = $orderId and shopId=".$shopId;		
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

		$sql = "UPDATE __PREFIX__orders set orderStatus = 2 WHERE orderId = $orderId and shopId=".$shopId;		
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
		$orderIds = I("orderIds");
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
	
			$sql = "UPDATE __PREFIX__orders set orderStatus = 2 WHERE orderId = $orderId and shopId=".$shopId;		
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

		$sql = "UPDATE __PREFIX__orders set orderStatus = 3 WHERE orderId = $orderId and shopId=".$shopId;		
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
		$orderIds = I("orderIds");
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
	
			$sql = "UPDATE __PREFIX__orders set orderStatus = 3 WHERE orderId = $orderId and shopId=".$shopId;		
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

		$sql = "UPDATE __PREFIX__orders set orderStatus = 5 WHERE orderId = $orderId and shopId=".$shopId;		
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
	 * 商家确认拒收/不同意拒收
	 */
	public function shopOrderRefund ($obj){		
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
		$shopId = (int)$obj["shopId"];
		$type = (int)I('type');
		$rsdata = array();
		$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE orderId = $orderId AND orderFlag = 1 and shopId=".$shopId;		
		$rsv = $this->queryRow($sql);
		if($rsv["orderStatus"]!= -3){
			$rsdata["status"] = -1;
			return $rsdata;
		}
		//同意拒收
        if($type==1){
			$sql = "UPDATE __PREFIX__orders set orderStatus = -4 WHERE orderId = $orderId and shopId=".$shopId;		
			$rs = $this->execute($sql);
			//加回库存
			if($rs>0){
				$sql = "SELECT goodsId,goodsNums,goodsAttrId from __PREFIX__order_goods WHERE orderId = $orderId";
				$oglist = $this->query($sql);
				foreach ($oglist as $key => $ogoods) {
					$goodsId = $ogoods["goodsId"];
					$goodsNums = $ogoods["goodsNums"];
					$goodsAttrId = $ogoods["goodsAttrId"];
					$sql = "UPDATE __PREFIX__goods set goodsStock = goodsStock+$goodsNums WHERE goodsId = $goodsId";
					$this->execute($sql);
					if($goodsAttrId>0){
						$sql = "UPDATE __PREFIX__goods_attributes set attrStock = attrStock+$goodsNums WHERE id = $goodsAttrId";
						$this->execute($sql);
					}
				}
			}	
        }else{//不同意拒收
        	if(I('rejectionRemarks')=='')return $rsdata;//不同意拒收必须填写原因
        	$sql = "UPDATE __PREFIX__orders set orderStatus = -5 WHERE orderId = $orderId and shopId=".$shopId;		
			$rs = $this->execute($sql);
        }
		$data = array();
		$m = M('log_orders');
		$data["orderId"] = $orderId;
		$data["logContent"] = ($type==1)?"商家同意拒收":"商家不同意拒收：".I('rejectionRemarks');
		$data["logUserId"] = $userId;
		$data["logType"] = 0;
		$data["logTime"] = date('Y-m-d H:i:s');
		$ra = $m->add($data);
		$rsdata["status"] = $ra;;
		return $rsdata;
	}
	
	/**
	 * 检查订单是否已支付
	 */
	public function checkOrderPay ($obj){
		$userId = (int)$obj["userId"];
		$orderIds = self::formatIn(",", $obj["orderIds"]);
		$sql = "SELECT count(orderId) counts FROM __PREFIX__orders WHERE userId = $userId AND orderId in ($orderIds) AND orderFlag = 1 AND orderStatus = -2 AND isPay = 0 AND payType = 1";
		$rsv = $this->query($sql);
		$ocnt = count(explode(",",$orderIds));
		$data = array();
		
		if($ocnt==$rsv[0]['counts']){
			
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
			$data["status"] = -1;
		}
		
		
		return $data;
	}
	
	
	
	
}