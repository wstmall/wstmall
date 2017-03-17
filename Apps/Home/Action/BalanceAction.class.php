<?php

namespace Home\Action;

use Think\Controller;

/**
 * 余额支付
 */
class BalanceAction extends BaseAction {
	
	
	public function payment() {
		$this->isUserLogin();
		$m = D('Home/Users');
		$user = $m->getUserById(array("userId"=>session('WST_USER.userId')));
		
		$pkey = base64_decode ( I ( "pkey" ) );
		$pkeys = explode ( "@", $pkey );
		
		$morders = D ( 'Home/Orders' );
		$obj ["uniqueId"] = $pkeys [1];
		$obj ["orderType"] = $pkeys [2];
		$data = $morders->getPayOrders ( $obj );
		$orders = $data ["orders"];
		$needPay = $data ["needPay"];
		
		$this->assign("userMoney",$user["userMoney"]);
		$this->assign("needPay",$needPay);
		$this->assign("pkey",I("pkey"));
		$this->display ( "payment/balance/pay" );
	}
	
	public function balancePay(){
		
		$this->isUserLogin();
		$m = D ( 'Home/Users' );
		$rd = $m->checkPaypwd();
		if($rd["status"]==1){
			$pkey = base64_decode ( I ( "pkey" ) );
			$pkeys = explode ( "@", $pkey );
			$userId = session('WST_USER.userId');
			$morders = D ( 'Home/Orders' );
			$obj ["userId"] = $userId;
			$obj ["orderId"] = $pkeys [1];
			$obj ["orderType"] = $pkeys [2];
			
			$m = D ( 'Common/Payments' );
			$rd = $m->balancePay($obj);
		}
		
		$this->ajaxReturn($rd);
		
	}
}