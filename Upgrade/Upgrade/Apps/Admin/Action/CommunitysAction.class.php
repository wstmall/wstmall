<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 社区控制器
 */
class CommunitysAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
	    $m = D('Admin/Communitys');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('sqlb_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('sqlb_01');
    		$object = $m->getModel();
    	}
    	$a = D('Admin/Areas');
    	$this->assign('areaList',$a->queryShowByList(0));
    	$this->assign('object',$object);
		$this->view->display('/communitys/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isAjaxLogin();
		$m = D('Admin/Communitys');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('sqlb_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('sqlb_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isAjaxLogin();
		$this->checkAjaxPrivelege('sqlb_03');
		$m = D('Admin/Communitys');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('sqlb_00');
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		$m = D('Admin/Communitys');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign('areaId1',I('areaId1',0));
    	$this->assign('areaId2',I('areaId2',0));
    	$this->assign('areaId3',I('areaId3',0));
        $this->display("/communitys/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/Communitys');
		$list = $m->queryList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
    /**
	 * 显示商品是否显示/隐藏
	 */
	 public function editiIsShow(){
	 	$this->isAjaxLogin();
	 	$this->checkAjaxPrivelege('sqlb_02');
	 	$m = D('Admin/Communitys');
		$rs = $m->editiIsShow();
		$this->ajaxReturn($rs);
	 }
};
?>