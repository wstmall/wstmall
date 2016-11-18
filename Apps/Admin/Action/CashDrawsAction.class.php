<?php
 namespace Admin\Action;
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
	 * 跳去提现页面
	 */
	public function toHandle(){
		$this->isLogin();
		$this->checkPrivelege('txgl_04');
		$rs = D('Admin/CashDraws')->get();
		$this->assign('object',$rs);
		$this->view->display('/moneys/handle');
	}
	
	/**
	 * 申请提现
	 */
	public function handle(){
		$this->isLogin();
		$this->checkPrivelege('txgl_04');
		$rs = D('Admin/CashDraws')->handle();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 获取提现记录列表
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('txgl_00');
		$page = D('Admin/CashDraws')->queryByPage();
		$this->assign('Page',$page);
		$this->assign('targetType',(int)I('targetType',-1));
		$this->assign('startDate',I('startDate'));
		$this->assign('endDate',I('endDate'));
		$this->view->display('/moneys/list_draws');
	}

};
?>