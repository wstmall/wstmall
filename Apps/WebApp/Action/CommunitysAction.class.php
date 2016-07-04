<?php
 namespace WebApp\Action;;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 社区控制器
 */
class CommunitysAction extends BaseAction {
	
	/**
	 * 通过县区获取社区列表
	 */
	public function getByDistrict(){
		$this->isLogin();
		$m = D('WebApp/Communitys');
		$list = $m->getByDistrict( (int)I('areaId3') );
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
};
?>