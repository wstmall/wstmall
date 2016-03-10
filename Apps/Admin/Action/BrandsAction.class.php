<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 品牌控制器
 */
class BrandsAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
		//获取品牌
		$m = D('Admin/GoodsCats');
    	$cats = $m->queryByList(0);
    	$this->assign('cats',$cats);
	    $m = D('Admin/Brands');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('ppgl_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('ppgl_01');
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
		$this->view->display('/brands/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isAjaxLogin();
		$m = D('Admin/Brands');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('ppgl_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('ppgl_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isAjaxLogin();
		$this->checkAjaxPrivelege('ppgl_03');
		$m = D('Admin/Brands');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('ppgl_00');
		
		$m = D('Admin/GoodsCats');
		$cats = $m->queryByList(0);
		$this->assign('cats',$cats);
		self::WSTAssigns();
		$m = D('Admin/Brands');
    	$page = $m->queryByPage();
    	foreach ($page['root'] as &$value) {
    		$value['brandDesc'] = html_entity_decode(stripslashes($value['brandDesc']));
    	}
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
        $this->view->display("/brands/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/Brands');
		$list = $m->queryList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
};
?>