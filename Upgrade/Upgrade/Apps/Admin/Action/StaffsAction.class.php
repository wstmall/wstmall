<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 职员控制器
 */
class StaffsAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isLogin();
	    $m = D('Admin/Staffs');
	    $r = D('Admin/Roles');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('zylb_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('zylb_03');
    		$object = $m->getModel();
    		$object['staffStatus'] = 1;
    	}
    	$this->assign('roleList',$r->queryByList());
    	$this->assign('object',$object);
		$this->view->display('/staffs/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		$this->isAjaxLogin();
		$m = D('Admin/Staffs');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('zylb_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('zylb_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isAjaxLogin();
		$this->checkAjaxPrivelege('zylb_03');
		$m = D('Admin/Staffs');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
   /**
	 * 查看
	 */
	public function toView(){
		$this->isLogin();
		$this->checkPrivelege('zylb_00');
		$m = D('Admin/Staffs');
		if(I('id')>0){
			$object = $m->get();
			$this->assign('object',$object);
		}
		$this->view->display('/staffs/view');
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('zylb_00');
		$m = D('Admin/Staffs');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign('loginUserId',1);
    	$this->assign('staffName',I('staffName'));
    	$this->assign('loginName',I('loginName'));
        $this->display("/staffs/list");
	}
	/**
	 * 查询用户账号
	 */
	public function checkLoginKey(){
		$this->isAjaxLogin();
		$m = D('Admin/Staffs');
		$rs = $m->checkLoginKey();
		$this->ajaxReturn($rs);
	}
    /**
	 * 显示职员账号是否启用/停用
	 */
	 public function editStatus(){
	 	$this->isAjaxLogin();
	 	$this->checkAjaxPrivelege('zylb_03');
	 	$m = D('Admin/Staffs');
		$rs = $m->editStatus();
		$this->ajaxReturn($rs);
	 }
   /**
    * 跳到修改职员密码
    */
	public function toEditPass(){
		$this->isLogin();
        $this->display("/edit_pass");
	}
	
	/**
	 * 修改职员密码
	 */
	public function editPass(){
		$this->isAjaxLogin();
		$m = D('Admin/Staffs');
   		$rs = $m->editPass(session('WST_STAFF.staffId'));
    	$this->ajaxReturn($rs);
	}

};
?>