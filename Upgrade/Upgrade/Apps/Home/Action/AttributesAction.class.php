<?php
 namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 属性控制器
 */
class AttributesAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isShopLogin();
		
	    $m = D('Home/Attributes');
    	$object = array();
    	if((int)I('id',0)>0){
    		$object = $m->get();
    	}else{
    		$object = $m->getModel();
    		$object['catId'] = (int)I('catId');
    	}
    	$m = D('Home/AttributeCats');
		$this->assign('cat',$m->get((int)$object['catId']));
    	$this->assign('object',$object);
    	$this->assign('umark',"AttributeCats");
		$this->view->display('default/shops/attributes/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isShopAjaxLogin();
		$m = D('Home/Attributes');
    	$rs = array();
    	$rs = $m->edit();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isShopAjaxLogin();
		$m = D('Home/Attributes');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isShopLogin();
		$m = D('Home/AttributeCats');
		$this->assign('cat',$m->get((int)I('catId')));
		$this->assign('catList',$m->queryByList());
		$m = D('Home/Attributes');
    	$list = $m->queryByPage();
    	$this->assign('List',$list);
    	$this->assign('umark',"AttributeCats");
        $this->display("default/shops/attributes/list");
	}
	
	/**
	 * 获取列表
	 */
	public function getAttributes(){
		$m = D('Home/Attributes');
    	$list = $m->queryByListForGoods();
    	$rs = array('status'=>1,'list'=>$list);
    	$this->ajaxReturn($rs);
	}
};
?>