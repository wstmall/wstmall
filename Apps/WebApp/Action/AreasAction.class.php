<?php
 namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 区域控制器
 */
class AreasAction extends BaseAction {
	/**
	 * 列表查询
	 */
    public function getProvinceList(){
		$m = D('WebApp/Areas');
		$list = $m->getProvinceList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
    /**
	 * 列表查询[带社区]
	 */
    public function getAreaAndCommunitysByList(){
		$m = D('WebApp/Areas');
		$list = $m->queryAreaAndCommunitysByList( (int)I('areaId') );
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 通过省份获取城市列表
	 */
	public function getCityListByProvince(){
		$m = D('WebApp/Areas');
		$cityList = $m->getCityListByProvince( (int)I('provinceId') );
		$this->ajaxReturn($cityList);
	}

	/**
	 * 根据城市获取区县列表
	 */
	public function getDistricts(){
		$m = D('WebApp/Areas');
		$districtsList = $m->getDistricts( (int)I('cityId') );
		$this->ajaxReturn($districtsList);
	}

	/**
	 * 根据区县获取社区列表
	 */
	public function getCommunity(){
		$m = D('WebApp/Areas');
		$community = $m->queryAreaAndCommunitysByList( (int)I('parentId') );
		$this->ajaxReturn($community);
	}
	
};
?>