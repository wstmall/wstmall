<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 地区控制器
 */
class AreasAction extends BaseAction{
/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
	    $m = D('Admin/Areas');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('dqlb_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('dqlb_01');
    		$object = $m->getModel();
    		$object['parentId'] = I('parentId',0);
    	}
    	$this->assign('object',$object);
		$this->view->display('/areas/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isAjaxLogin();
		$m = D('Admin/Areas');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('dqlb_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('dqlb_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isAjaxLogin();
		$this->checkAjaxPrivelege('dqlb_03');
		$m = D('Admin/Areas');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('dqlb_00');
		$m = D('Admin/Areas');
		$pArea = array('areaId'=>0,'areaName'=>'');
		if(I('parentId',0)>0){
			$pArea = $m->get(I('parentId',0));
		}
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign('pArea',$pArea);
        $this->display("/areas/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/Areas');
		$list = $m->queryByList(I('parentId'));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	/**
	 * 列表查询[获取启用的区域信息]
	 */
    public function queryShowByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/Areas');
		$list = $m->queryShowByList(I('parentId'));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
    /**
	 * 列表查询[带社区]
	 */
    public function queryAreaAndCommunitysByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/Areas');
		$list = $m->queryAreaAndCommunitysByList(I('areaId'));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
    /**
	 * 设置地区是否显示/隐藏
	 */
	 public function editiIsShow(){
	 	$this->isAjaxLogin();
	 	$this->checkPrivelege('dqlb_02');
	 	$m = D('Admin/Areas');
		$rs = $m->editiIsShow();
		$this->ajaxReturn($rs);
	 }
};
?>