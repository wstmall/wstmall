<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 银行控制器
 */
class PaymentsAction extends BaseAction{
	/**
	 * 跳到编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
		$this->checkPrivelege('zfgl_01');
	    $m = D('Admin/Payments');
	    $payCode = I("payCode");
    	$object = array();

    	$object = $m->get();
    	
    	$this->assign('object',$object);
		$this->view->display('/payments/pay_'.$payCode);
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isAjaxLogin();
		$m = D('Admin/Payments');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('zfgl_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkPrivelege('zfgl_01');
    		$rs = $m->add();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isAjaxLogin();
		$this->checkPrivelege('zfgl_03');
		$m = D('Admin/Payments');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
   
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('zfgl_00');
		$m = D('Admin/Payments');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
        $this->display("/payments/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/Payments');
		$list = $m->queryByList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
};
?>