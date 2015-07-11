<?php
 namespace Home\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 店铺分类控制器
 */
class ShopsCatsAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isShopLogin();
	    $m = D('Home/ShopsCats');
    	$object = array();
    	if(I('id',0)>0){
    		$object = $m->get(I('id',0));
    		
    	}else{
    	    if(I('parentId',0)>0){
    		   $object = $m->get(I('parentId',0));
    		   $object['parentId'] = $object['catId'];
    		   $object['catName'] = '';
    		   $object['catSort'] = 0;
    		   $object['catId'] = 0;
    		}else{
    		   $object = $m->getModel();
    		}
    	}
    	$this->assign('object',$object);
		$this->view->display('default/shops/shopscats/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isShopLogin();
		$m = D('Home/ShopsCats');
    	$rs = array();
    	if(I('id',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->add();
    	}
    	$this->ajaxReturn($rs);
	}
	
	/**
	 * 修改名称
	 */
    public function editName(){
    	$this->isShopLogin();
		$m = D('Home/ShopsCats');
    	$rs = array();
    	if(I('id',0)>0){
    		$rs = $m->editName();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isShopLogin();
		$m = D('Home/ShopsCats');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		$m = D('Home/ShopsCats');
      	$List = $m->getCatAndChild($USER['shopId'],I('parentId',0));
    	$this->assign('List',$List);
    	$this->assign("umark","index");
        $this->display("default/shops/shopscats/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
		$m = D('Home/ShopsCats');
		$USER = session('WST_USER');
		$list = $m->queryByList($USER['shopId'],I('id',0));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
};
?>