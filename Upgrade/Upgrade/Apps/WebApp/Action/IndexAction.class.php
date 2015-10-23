<?php
namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 基础控制器
 */
class IndexAction extends BaseAction {
	/**
	 * 获取首页信息
	 */
    public function index(){
      $ads = D('WebApp/Ads');
   		$areaId2 = 0;
   		if(I('city',0)>0){
   			$_SESSION['areaId2'] = I('city',0);
   			$this->setDefaultCity(I('city',0));
   			$areaId2 = I('city',0);
   			$this->assign('areaId2',$areaId2);
   		}else{
   			 $areas = D('WebApp/Areas');
   		   $areaId2 = $areas->getDefaultCity();
   		}
   		//首页主广告
   		$indexAds = $ads->getAds($areaId2,-1);
   		$this->assign('indexAds',$indexAds);
   		if(I("changeCity")){
   			echo $_SERVER['HTTP_REFERER'];
   		}else{
   			$this->display("default/index");
   		}
    }
  /**
   * 获取城市列表
   */
    public function getCitys(){
      $index = D('WebApp/Index');
      $cityList = $index->getCitys();
      $this->ajaxReturn($cityList);
    }
    public function test(){
        $this->display("default/test");
    }
}