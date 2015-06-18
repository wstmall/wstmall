<?php
 namespace Home\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 品牌控制器
 */
class BrandsAction extends BaseAction{
	
	/**
	 * 列表查询
	 */
    public function index(){
    	$areas= D('Home/Areas');
    	$areaId2 = $this->getDefaultCity();
   		$areaList = $areas->getDistricts($areaId2);
   		$this->assign('areaList',$areaList);
   		//广告
   		$ads = D('Home/Ads');
   		$ads = $ads->getAds($areaId2,-2);
   		$this->assign('ads',$ads);
		$m = D('Home/Brands');
		$this->assign('nvg_mk',"brands");
		$brandslist = $m->queryBrandsByCity();
		$this->assign('brandslist',$brandslist);
		$this->display("default/brands_list");
	}
	
	/**
	 * 列表查询
	 */
    public function getBrands(){
		$m = D('Home/Brands');
		$brandslist = $m->queryBrandsByCity();
		$this->ajaxReturn($brandslist);
	}
	
	/**
	 * 获取品牌列表
	 */
    public function queryBrandsByCat(){
		$m = D('Home/Brands');
		$brandslist = $m->queryBrandsByCat((int)I('catId'));
		$this->ajaxReturn($brandslist);
	}
	
};
?>