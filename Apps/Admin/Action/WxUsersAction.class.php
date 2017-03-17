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
class WxUsersAction extends BaseAction{
	/**
	 * 列表页
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('wyhgl_00');
		$m = D('Admin/WxUsers');
		$page = $m->queryByPage();
		$pager = new \Think\Page($page['total'],$page['pageSize'],I());
		$page['pager'] = $pager->show();
		$this->assign('userName',I('userName'));
		$this->assign('Page',$page);
		$this->display("/wxusers/list");
	}
	
	/**
	 * 与微信用户管理同步
	 */
	public function synchroWx(){
		$this->isLogin();
		$this->checkPrivelege('wyhgl_04');
		$m = D('Admin/WxUsers');
		$rs = $m->synchroWx();
		$this->ajaxReturn($rs);
	}
	public function wxLoad(){
		$m = D('Admin/WxUsers');
		$rs = $m->wxLoad();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 修改备注
	 */
	public function editName(){
		$this->isLogin();
		$this->checkPrivelege('wyhgl_02');
		$m = D('Admin/WxUsers');
		$rs = array('status'=>-1);
		if(I('id',0)>0){
			$rs = $m->editName();
		}
		$this->ajaxReturn($rs);
	}
};
?>