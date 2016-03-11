<?php
 namespace Home\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 支付控制器
 */
class PaymentsAction extends BaseAction{
	
	/**
	 * 获取支付宝URL
	 */
    public function getAlipayURL(){
    	$this->isUserLogin();
    	$morders = D('Home/Orders');
		$USER = session('WST_USER');
		$obj["userId"] = (int)$USER['userId'];
		$obj["orderIds"] = I("orderIds");
		$data = $morders->checkOrderPay($obj);
    	if($data["status"]==1){
    		$m = D('Home/Payments');
    		$url =  $m->getAlipayUrl();
    		$data["url"] = $url;
    	}
		$this->ajaxReturn($data);
	}

	public function getWeixinURL(){
		$this->isUserLogin();
		$morders = D('Home/Orders');
		$USER = session('WST_USER');
		$obj["userId"] = (int)$USER['userId'];
		$obj["orderIds"] = I("orderIds");
		$data = $morders->checkOrderPay($obj);
		if($data["status"]==1){
			$m = D('Home/Payments');
			$pkey = $obj["userId"]."@".$obj["orderIds"];
			$data["url"] = U('Home/WxPay/createQrcode',array("pkey"=>base64_encode($pkey)));
		}
		$this->ajaxReturn($data);
	}
	
	/**
	 * 支付
	 */
	public function toPay(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		//支付方式
		$pm = D('Home/Payments');
		$payments = $pm->getList();
		$this->assign("payments",$payments["onlines"]);
		$orderIds = I("orderIds");
		$obj["orderIds"] = $orderIds;
		$data = $morders->getPayOrders($obj);
		$orders = $data["orders"];
		$needPay = $data["needPay"];
		$this->assign("orderIds",$orderIds);
		$this->assign("orders",$orders);
		$this->assign("needPay",$needPay);
		$this->assign("orderCnt",count($orders));
		$this->display('default/payment/order_pay');
	}
	
	/**
	 * 支付结果同步回调
	 */
	function response(){
		$request = $_GET;
		unset($request['_URL_']);
		$pay_res = D('Payments')->notify($request);
		if($pay_res['status']){
			header('Location:../../index.php?m=Home&c=Orders&a=queryByPage',false);
			//支付成功业务逻辑
		}else{
			$this->error('支付失败');
		}
	}
	
	/**
	 * 支付结果异步回调
	 */
	function notify(){
		$pm = D('Home/Payments');
		$request = $_POST;
		$pay_res = $pm->notify($request);
		if($pay_res['status']){
			//商户订单号
			$obj = array();
			$obj["trade_no"] = $_POST['trade_no'];
			$obj["out_trade_no"] = $_POST['out_trade_no'];
			$obj["total_fee"] = $_POST['total_fee'];
			$obj["userId"] = $_POST['extra_common_param'];
			//支付成功业务逻辑
			$payments = $pm->complatePay($obj);
			echo 'success';
		}else{
			echo 'fail';
		}
	}
};
?>