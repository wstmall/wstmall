<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 首页控制器
 */
use Think\Controller;
class IndexAction extends BaseAction {
	/**
	 * 获取首页信息
	 * 
	 */
    public function index(){
   		$ads = D('Home/Ads');
   		$areaId2 = 0;
   		if(I('city',0)>0){
   			$_SESSION['areaId2'] = I('city',0);
   			$this->setDefaultCity(I('city',0));
   			$areaId2 = I('city',0);
   			$this->assign('areaId2',$areaId2);
   		}else{
   			$areaId2 = $this->getDefaultCity();
   		}

   		//首页主广告
   		$indexAds = $ads->getAds($areaId2,-1);
   		$this->assign('indexAds',$indexAds);
   		//分类广告
   		$catAds = $ads->getAdsByCat($areaId2);
   		$this->assign('catAds',$catAds);
   		//城市列表
   		$areas= D('Home/Areas');
   		$areaList = $areas->getCitys();
   		//$_SESSION['refer'] = $_SERVER['HTTP_REFERER'];
   		if(I("changeCity")){
   			echo $_SERVER['HTTP_REFERER'];
   		}else{
   			$this->display("default/index");
   		}
		
    }
    /**
     * 广告记数
     */
    public function access(){
    	$ads = D('Home/Ads');
    	$ads->statistics(I('id'));
    	header("Location: ".I('url')); 
    }
    
    public function changecity(){
    	$areaId2 = $this->getDefaultCity();
    	
    	$m = D('Home/Areas');
    	$areaId2 = $this->getDefaultCity();
    	$provinceList = $m->getProvinceList();
    	$cityList = $m->getCityList();
    	$area = $m->getArea($areaId2);
    	$this->assign('provinceList',$provinceList);
    	$this->assign('cityList',$cityList);
    	$this->assign('area',$area);
    	$this->assign('areaId2',$areaId2);
    	
    	$this->display("default/changecity");
    }
}