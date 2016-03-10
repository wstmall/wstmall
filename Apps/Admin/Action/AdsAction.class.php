<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 广告控制器
 */
class AdsAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		//获取商品分类
		$m = D('Admin/GoodsCats');
		$this->assign('goodsCatList',$m->queryByList(0));
	    $m = D('Admin/Ads');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('gggl_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('gggl_01');
    		$object = $m->getModel();
    		$object['adStartDate'] = date('Y-m-d');
    		$object['adEndDate'] = date('Y-m-d');
    	}
    	$this->assign('object',$object);
		$this->view->display('/ads/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isAjaxLogin();
		$m = D('Admin/Ads');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('gggl_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('gggl_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isAjaxLogin();
		$this->checkAjaxPrivelege('gggl_03');
		$m = D('Admin/Ads');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkAjaxPrivelege('gggl_00');
		self::WSTAssigns();
		//获取商品分类
		$m = D('Admin/GoodsCats');
		$this->assign('goodsCatList',$m->queryByList(0));
		$m = D('Admin/Ads');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());
    	$pager->setConfig('header','个会员');
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
        $this->display("/ads/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isAjaxLogin();
		$m = D('Admin/Ads');
		$list = $m->queryByList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
};
?>