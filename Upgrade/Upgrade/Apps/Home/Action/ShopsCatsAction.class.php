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
	 * 修改名称
	 */
    public function editName(){
    	$this->isShopLogin();
		$m = D('Home/ShopsCats');
    	$rs = array();
    	if((int)I('id',0)>0){
    		$rs = $m->editName();
    	}
    	$this->ajaxReturn($rs);
	}
    /**
	 * 修改排序
	 */
    public function editSort(){
    	$this->isShopLogin();
		$m = D('Home/ShopsCats');
    	$rs = array();
    	if((int)I('id',0)>0){
    		$rs = $m->editSort();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 批量保存商品分类
	 */
	public function batchSaveShopCats(){
		$this->isShopAjaxLogin();
		$m = D('Home/ShopsCats');
		$rs = $m->batchSaveShopCats();
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
	 * 列表
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
	
	public function changeCatStatus(){
		$m = D('Home/ShopsCats');
		$rs = $m->changeCatStatus($USER['shopId']);
		$this->ajaxReturn($rs);
	}
};
?>