<?php
 namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 区域控制器
 */
class AreasAction extends BaseAction{
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$cityId = I('parentId',0);
    	//如果是游客注册开店则取当前城市
    	if(empty($_SESSION['USER']) && $cityId==0){
    		$cityId = $this->getDefaultCity();
    	}
		$m = D('Home/Areas');
		$list = $m->queryByList($cityId);
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
    /**
	 * 列表查询[带社区]
	 */
    public function queryAreaAndCommunitysByList(){
    	$this->isLogin();
		$m = D('Home/Areas');
		$list = $m->queryAreaAndCommunitysByList(I('areaId'));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
	
	/**
	 * 通过省份获取城市列表
	 */
	public function getCityListByProvince(){
		$m = D('Home/Areas');
		$cityList = $m->getCityListByProvince();
		$this->ajaxReturn($cityList);
	}
};
?>