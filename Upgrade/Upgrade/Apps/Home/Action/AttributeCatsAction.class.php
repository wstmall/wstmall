<?php
 namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 属性类型控制器
 */
class AttributeCatsAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isShopLogin();
	    $m = D('Home/AttributeCats');
    	$object = array();
    	if((int)I('id',0)>0){
    		$object = $m->get();
    	}else{
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
    	$this->assign('umark',"AttributeCats");
		$this->view->display('default/shops/attributecats/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isShopAjaxLogin();
		$m = D('Home/AttributeCats');
    	$rs = array();
    	if((int)I('id',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isShopAjaxLogin();
		$m = D('Home/AttributeCats');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isShopLogin();
		$m = D('Home/AttributeCats');
		$list = $m->queryByList();
    	$this->assign('List',$list);
    	$this->assign('umark',"AttributeCats");
        $this->display("default/shops/attributecats/list");
	}
	
	/**
	 * 获取属性分类列表
	 */
	public function queryByList(){
		//获取商品属性分类信息
		$m = D('Home/AttributeCats');
		$list = $m->queryByList();
		$rs = array('status'=>1,'list'=>$list);
    	$this->ajaxReturn($rs);
	}
};
?>