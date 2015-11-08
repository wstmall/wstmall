<?php
 namespace Home\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 社区控制器
 */
class CommunitysAction extends BaseAction{
	/**
	 * 社区列表查询
	 */
    public function queryByList(){
    	$this->isLogin();
		$m = D('Home/Communitys');
		$common= D('Home/Common');
   		$areaId2 = $common->getCity();
		$obj["areaId2"] = $areaId2; 
		$obj["areaId3"] = (int)I('areaId'); 
		$list = $m->getByDistrict($obj);
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 通过县区获取社区列表
	 */
	public function getByDistrict(){
		$this->isLogin();
		$m = D('Home/Communitys');
		$list = $m->getByDistrict((int)I('areaId3'));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
};
?>