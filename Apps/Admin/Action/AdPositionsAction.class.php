<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 广告位置控制器
 */
class AdPositionsAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
	    $m = D('Admin/AdPositions');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('ggwzgl_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('ggwzgl_01');
    		$object = $m->getModel();
    	}
    	
    	$this->assign('object',$object);
		$this->view->display('/adpositions/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isLogin();
		$m = D('Admin/AdPositions');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('ggwzgl_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkPrivelege('ggwzgl_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isLogin();
		$this->checkPrivelege('ggwzgl_03');
		$m = D('Admin/AdPositions');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('ggwzgl_00');
		self::WSTAssigns();
		$m = D('Admin/AdPositions');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign('positionType',(int)I('positionType',-1));
    	$this->assign('positionName',I('positionName'));
        $this->display("/adpositions/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isLogin();
		$m = D('Admin/AdPositions');
		$list = $m->queryByList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
};
?>