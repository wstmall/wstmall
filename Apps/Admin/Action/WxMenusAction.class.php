<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 微信自定义列表控制器
 */
class WxMenusAction extends BaseAction{
	/**
	 * 列表页
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('zdycd_00');
		$m = D('Admin/WxMenus');
		$list = $m->queryByList(I('parentId',0));
		$this->assign('List',$list);
		$this->view->display('/wxmenus/list');   	
	}
	
	/**
	 * 列表查询
	 */
	public function queryByList(){
		$this->isLogin();
		$m = D('Admin/WxMenus');
		$list = $m->queryByList(I('id',0));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 获取列表
	 */
	public function listQuery(){
		$this->isLogin();
		$this->checkPrivelege('zdycd_00');
		$m = D('Admin/WxMenus');
		$rs = $m->listQuery();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 与微信菜单同步
	 */
	public function synchroWx(){
		$this->isLogin();
		$this->checkPrivelege('zdycd_04');
		$m = D('Admin/WxMenus');
		$rs = $m->synchroWx();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 同步到微信菜单
	 */
	public function synchroAd(){
		$this->isLogin();
		$this->checkPrivelege('zdycd_05');
		$m = D('Admin/WxMenus');
		$rs = $m->synchroAd();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
		$m = D('Admin/WxMenus');
		$object = array();
		if(I('id',0)>0){
			$this->checkPrivelege('zdycd_02');
			$object = $m->get();
		}else{
			$this->checkPrivelege('zdycd_01');
			$object = $m->getModel();
			$object['parentId'] = I('parentId',0);
		}
		$this->assign('object',$object);
		$this->view->display('/wxmenus/edit');
	}
	
	/**
	 * 修改名称
	 */
	public function editName(){
		$this->isLogin();
		$this->checkPrivelege('zdycd_02');
		$m = D('Admin/WxMenus');
		$rs = array('status'=>-1);
		if(I('id',0)>0){
			$rs = $m->editName();
		}
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isLogin();
		$m = D('Admin/WxMenus');
		$rs = array();
		if(I('id',0)>0){
			$this->checkPrivelege('zdycd_02');
			$rs = $m->edit();
		}else{
			$this->checkPrivelege('zdycd_01');
			$rs = $m->insert();
		}
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isLogin();
		$this->checkPrivelege('zdycd_03');
		$m = D('Admin/WxMenus');
		$rs = $m->del();
		$this->ajaxReturn($rs);
	}
};
?>