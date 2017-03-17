<?php
 namespace Admin\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 风格控制器
 */
class StylesAction extends BaseAction{
	/**
	 * 跳去风格管理
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('fggl_00');
		$styles = D('Admin/Styles')->queryByList();
    	$this->assign('Style',$styles);
        $this->display("styles/list");
	}
	/**
	 * 列表查询
	 */
    public function changeStyle(){
    	$this->isLogin();
		$m = D('Admin/Styles');
		$rs = $m->changeStyle();
		$this->ajaxReturn($rs);
	}
};
?>