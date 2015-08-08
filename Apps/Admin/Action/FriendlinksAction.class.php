<?php
namespace Admin\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 友情连接控制器
 */
class FriendlinksAction extends BaseAction {
	/**
	 * 分页列表
	 */
    public function index(){
    	$this->isLogin();
    	$this->checkPrivelege('yqlj_00');
    	$m = D('Admin/Friendlinks');
    	$page = $m->queryPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
        $this->display("/friendlinks/list");
    }

    /**
     * 跳到新增/编辑
     */
    public function toEdit(){
    	$this->isLogin();
    	$m = D('Admin/Friendlinks');
    	$object = array();
    	if(I('id')>0){
    		$this->checkPrivelege('yqlj_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('yqlj_03');
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
    	$this->display("/friendlinks/edit");
    }
    
    /**
     * 新增/修改
     */
    public function edit(){
    	$this->isAjaxLogin();
    	$m = D('Admin/Friendlinks');
    	$rs = array();
    	if(I('id')>0){
    		$this->checkAjaxPrivelege('yqlj_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('yqlj_03');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
    }
    
    /**
     * 删除
     */
    public function del(){
    	$this->isAjaxLogin();
    	$this->checkAjaxPrivelege('yqlj_03');
    	$m = D('Admin/Friendlinks');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
    }
}