<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 订单控制器
 */
class OrdersAction extends BaseAction {
	/**
	 * 获取待付款的订单列表
	 */
	public function queryByPage(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		session('WST_USER.loginTarget','User');
		//判断会员等级
		$morders = D('Home/UserRanks');
		session('WST_USER.userRank',$morders->checkUserRank($USER['userScore']));
		//获取订单列表
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$orderList = $morders->queryByPage($obj);
		$statusList = $morders->getOrderStatusCount($obj);
		$this->assign("umark","queryByPage");
		$this->assign("orderList",$orderList);
		$this->assign("statusList",$statusList);
		$this->display("default/users/orders/list");
	}
	/**
	 * 获取待付款的订单列表
	 */
	public function queryPayByPage(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$payOrders = $morders->queryPayByPage($obj);
		$this->assign("umark","queryPayByPage");
		$this->assign("payOrders",$payOrders);
		$this->display("default/users/orders/list_pay");
	}
    /**
	 * 获取待发货的订单列表
	 */
	public function queryDeliveryByPage(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$deliveryOrders = $morders->queryDeliveryByPage($obj);
		$this->assign("umark","queryDeliveryByPage");
		$this->assign("receiveOrders",$deliveryOrders);
		$this->display("default/users/orders/list_delivery");
	}
    /**
	 * 获取退款订单列表
	 */
	public function queryRefundByPage(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$refundOrders = $morders->queryRefundByPage($obj);
		$this->assign("umark","queryRefundByPage");
		$this->assign("receiveOrders",$refundOrders);
		$this->display("default/users/orders/list_refund");
	}
    /**
	 * 获取收货的订单列表
	 */
	public function queryReceiveByPage(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$receiveOrders = $morders->queryReceiveByPage($obj);
		$this->assign("umark","queryReceiveByPage");
		$this->assign("receiveOrders",$receiveOrders);
		$this->display("default/users/orders/list_receive");
	}
	
	/**
	 * 获取已取消订单
	 */
	public function queryCancelOrders(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$receiveOrders = $morders->queryCancelOrders($obj);
		$this->assign("umark","queryCancelOrders");
		$this->assign("receiveOrders",$receiveOrders);
		$this->display("default/users/orders/list_cancel");
	}
    
	/**
	 * 获取待评价订单
	 */
    public function queryAppraiseByPage(){
    	$this->isUserLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
		$appraiseOrders = $morders->queryAppraiseByPage($obj);
		$this->assign("umark","queryAppraiseByPage");
		$this->assign("appraiseOrders",$appraiseOrders);
		$this->display("default/users/orders/list_appraise");
	} 
	
	
	/**
	 * 订单詳情-买家专用
	 */
	public function getOrderInfo(){
		$this->isUserLogin();
		self::getBaseInfo();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$obj["orderId"] = I("orderId");
		$rs = $morders->getOrderDetails($obj);
		$data["orderInfo"] = $rs;
		$this->assign("orderInfo",$rs);
		$this->display("default/order_details");
	}
	
	/**
	 * 取消订单
	 */
    public function orderCancel(){
    	$this->isUserAjaxLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["orderId"] = I("orderId");
		$rs = $morders->orderCancel($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 用户确认收货订单
	 */
    public function orderConfirm(){
    	$this->isUserAjaxLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["orderId"] = I("orderId");
    	$obj["type"] = I("type");
		$rs = $morders->orderConfirm($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 核对订单信息
	 */
	public function checkOrderInfo(){
		$this->isUserLogin();
		self::getBaseInfo();
		$mareas = D('Home/Areas');
		$morders = D('Home/Orders');
		$mgoods = D('Home/Goods');
		$maddress = D('Home/UserAddress');
		$gtotalMoney = 0;//商品总价（去除配送费）
		$totalMoney = 0;//商品总价（含配送费）
		$totalCnt = 0;
		$shopcat = session("WST_CART")?session("WST_CART"):array();	
		$catgoods = array();
	
		$shopColleges = array();
		$startTime = 0;
		$endTime = 24;
	    if(empty($shopcat)){
			$this->assign("fail_msg",'不能提交空商品的订单!');
			$this->display('default/order_fail');
			exit();
		}
		foreach($shopcat as $key=>$cgoods){		
			$obj["goodsId"] = $key;	
			$goods = $mgoods->getGoodsDetails($obj);
			if($goods["isBook"]==1){
				$goods["goodsStock"] = $goods["goodsStock"]+$goods["bookQuantity"];
			}
			$goods["cnt"] = $cgoods["cnt"];
			$totalCnt += $cgoods["cnt"];
			$totalMoney += $goods["cnt"]*$goods["shopPrice"];
			$gtotalMoney += $goods["cnt"]*$goods["shopPrice"];
			$ommunitysId = $maddress->getShopCommunitysId($goods["shopId"]);
			$shopColleges[$goods["shopId"]] = $ommunitysId;			
			if($startTime<$goods["startTime"]){
				$startTime = $goods["startTime"];
			}
			if($endTime>$goods["endTime"]){
				$endTime = $goods["endTime"];
			}

			$catgoods[$goods["shopId"]]["shopgoods"][] = $goods;
			$catgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//门店免运费最低金额
			$catgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//门店配送费
			$catgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//门店配送费
			$catgoods[$goods["shopId"]]["totalCnt"] = $catgoods[$goods["shopId"]]["totalCnt"]+$cgoods["cnt"];
			$catgoods[$goods["shopId"]]["totalMoney"] = $catgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
		}
		
		foreach($catgoods as $key=> $cshop){
			if($cshop["totalMoney"]<$cshop["deliveryFreeMoney"]){
				$totalMoney = $totalMoney + $cshop["deliveryMoney"];
			}
		}
		$USER = session('WST_USER');
		//获取地址列表
        $areaId2 = $this->getDefaultCity();
		$addressList = $maddress->queryByUserAndCity($USER['userId'],$areaId2);
		$this->assign("addressList",$addressList);
		$this->assign("areaId2",$areaId2);
		//获取当前市的县区
		$m = D('Home/Areas');
		$areaList2 = $m->getDistricts($areaId2);
		$this->assign("areaList2",$areaList2);
		if($endTime==0){
			$endTime = 24;
			$cstartTime = (floor($startTime))*4;
			$cendTime = (floor($endTime))*4;
		}else{
			$cstartTime = (floor($startTime)+1)*4;
			$cendTime = (floor($endTime)+1)*4;
		}
		if(floor($startTime)<$startTime){
			$cstartTime = $cstartTime + 2;
		}
		if(floor($endTime)<$endTime){
			$cendTime = $cendTime + 2;
		}

		$this->assign("startTime",$cstartTime);
		$this->assign("endTime",$cendTime);
		$this->assign("shopColleges",$shopColleges);
		$this->assign("catgoods",$catgoods);
		$this->assign("gtotalMoney",$gtotalMoney);
		$this->assign("totalMoney",$totalMoney);
		$this->display('default/check_order');
	}
	
	/**
	 * 提交订单信息
	 * 
	 */
	public function submitOrder(){	
		$this->isUserLogin();
		self::getBaseInfo();
		$USER = session('WST_USER');
		$goodsmodel = D('Home/Goods');
		$morders = D('Home/Orders');
		$totalMoney = 0;
		$totalCnt = 0;
		$userId = (int)$USER['userId'];
		
		$consigneeId = I("consigneeId");
		$payway = I("payway");
		$isself = I("isself");
		$needreceipt = I("needreceipt");
		$orderunique = I("orderunique");
		$shopcat = session("WST_CART")?session("WST_CART"):array();	
		
		$catgoods = array();	
		$order = array();
		if(empty($order)){
			if(empty($shopcat)){
				$this->display('default/order_success');
			}else{
				//整理及核对购物车数据
				foreach($shopcat as $key=>$cgoods){
					$goods = $goodsmodel->getGoodsSimpInfo($key);
					//核对商品是否符合购买要求
					if($goods['goodsStock']<=0){
						$this->assign("fail_msg",'对不起，商品'.$goods['goodsName'].'库存不足!');
						$this->display('default/order_fail');
						exit();
					}
					if($goods['isSale']!=1){
						$this->assign("fail_msg",'对不起，商品库'.$goods['goodsName'].'已下架!');
						$this->display('default/order_fail');
						exit();
					}
					$goods["cnt"] = $cgoods["cnt"];
					$totalCnt += $cgoods["cnt"];
					$totalMoney += $goods["cnt"]*$goods["shopPrice"];
					$catgoods[$goods["shopId"]]["shopgoods"][] = $goods;
					$catgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//门店免运费最低金额
					$catgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//门店免运费最低金额
					$catgoods[$goods["shopId"]]["totalCnt"] = $catgoods[$goods["shopId"]]["totalCnt"]+$cgoods["cnt"];
					$catgoods[$goods["shopId"]]["totalMoney"] = $catgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
					
				}
				foreach($catgoods as $key=> $cshop){
					if($cshop["totalMoney"]<$cshop["deliveryFreeMoney"]){
						if($isself==0){
							$totalMoney = $totalMoney + $cshop["deliveryMoney"];
						}
					}
				}
				
				$ordersInfo = $morders->addOrders($userId,$consigneeId,$payway,$needreceipt,$catgoods,$orderunique,$isself);
				session("WST_CART",null);
				$orderNos = $ordersInfo["orderNos"];
				$this->assign("torderIds",implode(",",$ordersInfo["orderIds"]));
				$this->assign("orderInfos",$ordersInfo["orderInfos"]);
				$this->assign("isMoreOrder",(count($ordersInfo["orderInfos"])>0)?1:0);
				$this->assign("orderNos",implode(",",$orderNos));
				$this->assign("totalMoney",$totalMoney);
				//if($payway==0){
					$this->display('default/order_success');	
				//}else{
					//$this->display('default/paystep1');	
				//}
			}
		}else{
			$this->display('default/check_order');		
		}		
	}
	
	/**
	 * 订单詳情
	 */
	public function getOrderDetails(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$obj["shopId"] = (int)$USER['shopId'];
		$obj["orderId"] = I("orderId");
		$rs = $morders->getOrderDetails($obj);
		$data["orderInfo"] = $rs;
		$this->assign("orderInfo",$rs);
		$this->display("default/users/orders/details");
	}
	
	/*************************************************************************/
	/********************************商家訂單管理*****************************/
	/*************************************************************************/
	/**
	 * 跳转到商家订单列表
	*/
	public function toShopOrdersList(){
		$this->isShopLogin();
		$morders = D('Home/Orders');
		$this->assign("umark","toShopOrdersList");		
		$this->display("default/shops/orders/list");
	}
	/**
	 * 获取商家订单列表
	*/
	public function queryShopOrders(){
		$this->isShopAjaxLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["shopId"] = (int)$USER["shopId"];
		$obj["userId"] = (int)$USER['userId'];
		$orders = $morders->queryShopOrders($obj);
		
		$this->ajaxReturn($orders);
	}
	/**
	 * 商家受理订单
	 */
    public function shopOrderAccept(){
    	$this->isShopAjaxLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = I("orderId");
		$rs = $morders->shopOrderAccept($obj);
		$this->ajaxReturn($rs);
	} 
	/**
	 * 商家生产订单
	 */
    public function shopOrderProduce(){
    	$this->isShopAjaxLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = I("orderId");
		$rs = $morders->shopOrderProduce($obj);
		$this->ajaxReturn($rs);
	} 
	/**
	 * 商家发货配送订单
	 */
    public function shopOrderDelivery(){
    	$this->isShopAjaxLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = I("orderId");
		$rs = $morders->shopOrderDelivery($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 商家确认收货订单
	 */
    public function shopOrderReceipt(){
    	$this->isShopAjaxLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = I("orderId");
		$rs = $morders->shopOrderReceipt($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 商家同意拒收
	 */
	public function shopOrderRefund(){
		$this->isShopAjaxLogin();
		$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = I("orderId");
		$rs = $morders->shopOrderRefund($obj);
		$this->ajaxReturn($rs);
	}
}