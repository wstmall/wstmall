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
   		
   		if((int)cookie("bstreesAreaId3")){
   			$obj["areaId3"] = (int)cookie("bstreesAreaId3");
   		}else{
   			$obj["areaId3"] = ((int)I('areaId3')>0)?(int)I('areaId3'):$areaList[0]['areaId'];
   			cookie("bstreesAreaId3",$obj["areaId3"]);
   		}
   		$this->assign('areaId3',$obj["areaId3"]);
   		//广告
   		$ads = D('Home/Ads');
   		$ads = $ads->getAds($areaId2,-2);
   		$this->assign('ads',$ads);
		$m = D('Home/Brands');
		$this->display("default/brands_list");
	}
	
	/**
	 * 列表查询
	 */
    public function getBrands(){
		$m = D('Home/Brands');
		$brandslist = $m->queryBrandsByDistrict();
		cookie("bstreesAreaId3",I("areaId3"));
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