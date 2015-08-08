<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 会员等级控制器
 */
class UserRanksAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
	    $m = D('Admin/UserRanks');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('hydj_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('hydj_01');
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
		$this->view->display('/userranks/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isAjaxLogin();
		$m = D('Admin/UserRanks');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('hydj_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('hydj_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isAjaxLogin();
		$this->checkAjaxPrivelege('hydj_03');
		$m = D('Admin/UserRanks');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('hydj_00');
		$m = D('Admin/UserRanks');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
        $this->display("/userranks/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/UserRanks');
		$list = $m->queryByList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
};
?>