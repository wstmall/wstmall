<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 文章分类控制器
 */
class ArticleCatsAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
	    $m = D('Admin/ArticleCats');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('wzfl_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('wzfl_01');
    		$object = $m->getModel();
    		$object['parentId'] = I('parentId',0);
    	}
    	$this->assign('object',$object);
		$this->view->display('/articlecats/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isAjaxLogin();
		$m = D('Admin/ArticleCats');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('wzfl_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('wzfl_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 修改名称
	 */
	public function editName(){
		$this->isAjaxLogin();
		$m = D('Admin/ArticleCats');
    	$rs = array('status'=>-1);
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('wzfl_02');
    		$rs = $m->editName();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isAjaxLogin();
		$this->checkAjaxPrivelege('wzfl_03');
		$m = D('Admin/ArticleCats');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('wzfl_00');
		$m = D('Admin/ArticleCats');
    	$list = $m->queryByList(I('parentId',0));
    	$this->assign('List',$list);
        $this->display("/articlecats/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/ArticleCats');
		$list = $m->queryByList(I('id',0));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
    /**
	 * 显示分类是否显示/隐藏
	 */
	 public function editiIsShow(){
	 	$this->isAjaxLogin();
	 	$this->checkAjaxPrivelege('wzfl_02');
	 	$m = D('Admin/ArticleCats');
		$rs = $m->editiIsShow();
		$this->ajaxReturn($rs);
	 }

};
?>