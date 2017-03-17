<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 微信被动回复控制器
 */
class WxPassiveReplyAction extends BaseAction{
	/**
	 * 文本消息
	 */
	public function text(){
		$this->isLogin();

		// 验证权限
		$this->checkPrivelege('wxzdhf_00');
		
		$m = D('Admin/WxPassiveReplys');
    	$page = $m->textPageQuery();

    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);

		$this->display('/wxpassivereply/text');
	}
	
	/**
	 * 跳到新增/编辑页面【文本消息】
	 */
	public function toEdit(){
		$this->isLogin();
	    $m = D('Admin/WxPassiveReplys');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('wxzdhf_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('wxzdhf_01');
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
		$this->view->display('wxpassivereply/edit');
	}
	/**
	 * 新增/修改操作【文本消息】
	 */
	public function edit(){
		$this->isLogin();
		$m = D('Admin/WxPassiveReplys');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('wxzdhf_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkPrivelege('wxzdhf_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}


	
   
	/**
	 * 图文消息
	 */
	public function news(){
		$this->isLogin();

		// 验证权限
		$this->checkPrivelege('wxzdhf_00');
		
		$m = D('Admin/WxPassiveReplys');
    	$page = $m->newsPageQuery();

    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);

		$this->display('wxpassivereply/news');
	}
	/**
	 * 跳到新增/编辑页面【图文消息】
	 */
	public function toNewsEdit(){
		$this->isLogin();
	    $m = D('Admin/WxPassiveReplys');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('wxzdhf_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('wxzdhf_01');
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
		$this->view->display('wxpassivereply/news_edit');
	}
	/**
	 * 新增/修改操作【图文消息】
	 */
	public function newsEdit(){
		$this->isLogin();
		$m = D('Admin/WxPassiveReplys');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('wxzdhf_02');
    		$rs = $m->newsEdit();
    	}else{
    		$this->checkPrivelege('wxzdhf_01');
    		$rs = $m->newsInsert();
    	}
    	$this->ajaxReturn($rs);
	}





	/**
	 * 删除操作
	 */
	public function del(){
		$this->isLogin();
		$this->checkPrivelege('wxzdhf_03');
		$m = D('Admin/WxPassiveReplys');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
};
?>