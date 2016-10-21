<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
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
		$rm = D('Home/UserRanks');
		$USER["userRank"] = $rm->getUserRank();
		session('WST_USER',$USER);
		//获取订单列表
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$orderList = $morders->queryByPage($obj);
		$statusList = $morders->getUserOrderStatusCount($obj);
		$um = D('Home/Users');
		$user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
		$this->assign("userScore",$user['userScore']);
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
		self::WSTAssigns();
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
		self::WSTAssigns();
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
		self::WSTAssigns();
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
		self::WSTAssigns();
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
		self::WSTAssigns();
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
    	self::WSTAssigns();
    	$obj["userId"] = (int)$USER['userId'];
		$appraiseOrders = $morders->queryAppraiseByPage($obj);
		$this->assign("umark","queryAppraiseByPage");
		$this->assign("appraiseOrders",$appraiseOrders);
		$this->display("default/users/orders/list_appraise");
	} 
	
	/**
	 * 获取待评价订单
	 */
	public function queryCompleteOrders(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		self::WSTAssigns();
		$obj["userId"] = (int)$USER['userId'];
		$appraiseOrders = $morders->queryCompleteOrders($obj);
		$this->assign("umark","queryCompleteOrders");
		$this->assign("appraiseOrders",$appraiseOrders);
		$this->display("default/users/orders/list_complete");
	}
	
	/**
	 * 订单詳情-买家专用
	 */
	public function getOrderInfo(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$obj["orderId"] = (int)I("orderId");
		$rs = $morders->getOrderDetails($obj);
		$data["orderInfo"] = $rs;
		$this->assign("orderInfo",$rs);
		$this->display("default/order_details");
	}
	
	/**
	 * 取消订单
	 */
    public function orderCancel(){
    	$this->isUserLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->orderCancel($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 用户确认收货订单
	 */
    public function orderConfirm(){
    	$this->isUserLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["orderId"] = (int)I("orderId");
    	$obj["type"] = (int)I("type");
		$rs = $morders->orderConfirm($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 核对订单信息
	 */
	public function checkOrderInfo(){
		$this->isUserLogin();
		$maddress = D('Home/UserAddress');
		$mcart = D('Home/Cart');
		$rdata = $mcart->getPayCart();	
	    if($rdata["cartnull"]==1){
			$this->assign("fail_msg",'不能提交空商品的订单!');
			$this->display('default/order_fail');
			exit();
		}
		$catgoods = $rdata["cartgoods"];
		$shopColleges = $rdata["shopColleges"];
		$distributAll = $rdata["distributAll"]; 
		$startTime = $rdata["startTime"];
		$endTime = $rdata["endTime"];
		$gtotalMoney = $rdata["gtotalMoney"];//商品总价（去除配送费）
		$totalMoney = $rdata["totalMoney"];//商品总价（含配送费）
		$totalCnt = $rdata["totalCnt"];

		$userId = session('WST_USER.userId');
		//获取地址列表
        $areaId2 = $this->getDefaultCity();
		$addressList = $maddress->queryByUserAndCity($userId,$areaId2);
		$this->assign("addressList",$addressList);
		$this->assign("areaId2",$areaId2);
		//支付方式
		$pm = D('Home/Payments');
		$payments = $pm->getList();
		$this->assign("payments",$payments);
		
		//获取当前市的县区
		$m = D('Home/Areas');
		$provinces = $m->getProvinceList();
		$this->assign("provinces",$provinces);
		
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
		$baseScore = WSTOrderScore();
		$baseMoney = WSTScoreMoney();
		$this->assign("startTime",$cstartTime);
		$this->assign("endTime",$cendTime);
		$this->assign("shopColleges",$shopColleges);
		$this->assign("distributAll",$distributAll);
		$this->assign("catgoods",$catgoods);
		$this->assign("gtotalMoney",$gtotalMoney);
		$this->assign("totalMoney",$totalMoney);
		$um = D('Home/Users');
		$user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
		$this->assign("userScore",$user['userScore']);
		$useScore = $baseScore*floor($user["userScore"]/$baseScore);
		$scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
		if($totalMoney<$scoreMoney){//订单金额小于积分金额
			$useScore = $baseScore*floor($totalMoney/$baseMoney);
			$scoreMoney = $baseMoney*floor($totalMoney/$baseMoney);
		}
		$this->assign("canUserScore",$useScore);
		$this->assign("scoreMoney",$scoreMoney);
		$this->display('default/check_order');
	}
	
	
	public function checkUseScore(){
		$mcart = D('Home/Cart');
		$rdata = $mcart->getPayCart();
		if((int)I("isself")){
			$totalMoney = $rdata["gtotalMoney"];//商品总价（去除配送费）
		}else{
			$totalMoney = $rdata["totalMoney"];//商品总价（含配送费）
		}
		
		$baseScore = WSTOrderScore();
		$baseMoney = WSTScoreMoney();
		$um = D('Home/Users');
		$user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
		$useScore = $baseScore*floor($user["userScore"]/$baseScore);
		$scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
		if($totalMoney<$scoreMoney){//订单金额小于积分金额
			$useScore = $baseScore*floor($totalMoney/$baseMoney);
			$scoreMoney = $baseMoney*floor($totalMoney/$baseMoney);
		}
		$rs["canUserScore"] = $useScore;
		$rs["scoreMoney"] = $scoreMoney;
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 提交订单信息
	 * 
	 */
	public function submitOrder(){	
		$this->isUserLogin();
		session("WST_ORDER_UNIQUE",null);
		$morders = D('Home/Orders');
		$rs = $morders->submitOrder();
		$this->ajaxReturn($rs);
	}
	/**
	 * 显示下单结果
	 */
	public function orderSuccess(){
		$this->isUserLogin();
		$morders = D('Home/Orders');
		$this->assign("orderInfos",$morders->getOrderListByIds());
		$this->display('default/order_success');
	}
	
	/**
	 * 检查是否已支付
	 */
	public function checkOrderPay(){
		$morders = D('Home/Orders');
		$USER = session('WST_USER');
		$obj["userId"] = (int)$USER['userId'];
		$rs = $morders->checkOrderPay($obj);
		$this->ajaxReturn($rs);
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
		$obj["orderId"] = (int)I("orderId");
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
		$this->isShopLogin();
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
    	$this->isShopLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderAccept($obj);
		$this->ajaxReturn($rs);
	} 
    /**
	 * 商家批量受理订单
	 */
    public function batchShopOrderAccept(){
    	$this->isShopLogin();
    	$morders = D('Home/Orders');
		$rs = $morders->batchShopOrderAccept($obj);
		$this->ajaxReturn($rs);
	}
	/**
	 * 商家生产订单
	 */
    public function shopOrderProduce(){
    	$this->isShopLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderProduce($obj);
		$this->ajaxReturn($rs);
	} 
	public function batchShopOrderProduce(){
    	$this->isShopLogin();
    	$morders = D('Home/Orders');
		$rs = $morders->batchShopOrderProduce($obj);
		$this->ajaxReturn($rs);
	} 
	/**
	 * 商家发货配送订单
	 */
    public function shopOrderDelivery(){
    	$this->isShopLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderDelivery($obj);
		$this->ajaxReturn($rs);
	} 
	
    /**
	 * 商家发货配送订单
	 */
    public function batchShopOrderDelivery(){
    	$this->isShopLogin();
    	$morders = D('Home/Orders');
		$rs = $morders->batchShopOrderDelivery($obj);
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 商家确认收货订单
	 */
    public function shopOrderReceipt(){
    	$this->isShopLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderReceipt($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 商家同意拒收/不同意拒收
	 */
	public function shopOrderRefund(){
		$this->isShopLogin();
		$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderRefund($obj);
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 获取用户订单消息提示
	 */
	public function getUserMsgTips(){
		$this->isUserLogin();
		$morders = D('Home/Orders');
		$USER = session('WST_USER');
		$obj["userId"] = (int)$USER['userId'];
		$statusList = $morders->getUserOrderStatusCount($obj);
		$this->ajaxReturn($statusList);
	}
	
	/**
	 * 获取店铺订单消息提示
	 */
	public function getShopMsgTips(){
		$this->isShopLogin();
		$morders = D('Home/Orders');
		$USER = session('WST_USER');
		$obj["shopId"] = (int)$USER['shopId'];
		$obj["userId"] = (int)$USER['userId'];
		$statusList = $morders->getShopOrderStatusCount($obj);
		$this->ajaxReturn($statusList);
	}
	
}