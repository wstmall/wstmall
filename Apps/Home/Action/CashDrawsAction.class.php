<?php
 namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 申请提现控制器
 */
class CashDrawsAction extends BaseAction{
	
	/**
	 * 申请提现
	 */
	public function drawsCash(){
		$this->isLogin();
		$rs = D('Home/CashDraws')->insert();
		$this->ajaxReturn($rs);
	}
	/**
	 * 用户申请提现
	 */
    public function drawsCashByUser(){
		$this->isLogin();
		$rs = D('Home/CashDraws')->insertByUser();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 获取提现记录列表
	 */
	public function queryByPage(){
		$this->isShopLogin();
		$page = D('Home/CashDraws')->queryByPage(1);
		$this->ajaxReturn($page);
	}
	
    /**
	 * 获取提现记录列表
	 */
	public function queryByUserPage(){
		$this->isUserLogin();
		$page = D('Home/CashDraws')->queryByPage(0);
		$this->ajaxReturn($page);
	}

};
?>