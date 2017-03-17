<?php
 namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 资金流水控制器
 */
class LogMoneysAction extends BaseAction{
	/**
	 * 商家资金管理
	 */
	public function toShopMoneys(){
		$this->isShopLogin();
		$spm = D('Home/Shops');
		$shopInfo = $spm->loadShopInfo(session('WST_USER.userId'));
		$this->assign('shopInfo',$shopInfo);
		$this->assign("umark","toShopMoneys");
		$this->display("shops/moneys/moneys");
	}
	
  /**
	 * 用户资金管理
	 */
	public function toUserMoneys(){
		$this->isUserLogin();
		$um = D('Home/Users');
		$user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
		$this->assign("user",$user);
		$this->assign("umark","toUserMoneys");
		$this->display("users/moneys/moneys");
	}
	
	/**
	 * 获取流水记录
	 */
	public function loadMoneys(){
		$this->isShopLogin();
		$page = D('Home/LogMoneys')->loadMoneys(1);
		$this->ajaxReturn($page);
	}
    /**
	 * 获取流水记录
	 */
	public function loadUserMoneys(){
		$this->isUserLogin();
		$page = D('Home/LogMoneys')->loadMoneys(0);
		$this->ajaxReturn($page);
	}
	
    public function getShopMoneys(){
		$this->isShopLogin();
		$rs = D('Home/LogMoneys')->getShopMoneys();
		$this->ajaxReturn($rs);
	}
	
    public function getUserMoneys(){
		$this->isShopLogin();
		$rs = D('Home/LogMoneys')->getUserMoneys();
		$this->ajaxReturn($rs);
	}

};
?>