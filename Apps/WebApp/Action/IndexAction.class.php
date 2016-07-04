<?php
namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
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
 		$areaId2 = (int)session('areaId2');
    $ads = D('WebApp/Ads');
	  $indexAds = $ads->getAds($areaId2, -1);//首页主广告
	  $this->assign('indexAds', $indexAds);      
	  $shops = D('WebApp/Shops');
    $selfShopId = $shops->checkSelfShopId($areaId2);//自营超市
 		$this->assign('selfShopId', $selfShopId);
 		$this->display("default/index");
  }
    
  /**
   * 获取城市列表
   */
  public function getCitys(){
    $index = D('WebApp/Index');
    $cityList = $index->getCitys();
    $this->ajaxReturn($cityList);
  }

  /**
   * 设置跟位置信息有关的session
   */
  public function setLocationSession(){
    $areaId2 = (int)I('areaId2');
    $areaName2 = I('areaName2');
    $wstLatitude = (float)I('wstLatitude');
    $wstLongitude = (float)I('wstLongitude');
    session('areaId2', $areaId2);
    session('areaName2', $areaName2);
    session('wstLatitude', $wstLatitude);
    session('wstLongitude', $wstLongitude);
    $this->ajaxReturn( array('status'=>1) );
  }

  /**
   * 设置真实位置信息session
   */
  public function setRealLocationSession(){
    $wstRealLatitude = (float)I('wstRealLatitude');
    $wstRealLongitude = (float)I('wstRealLongitude');
    session('wstRealLatitude', $wstRealLatitude);
    session('wstRealLongitude', $wstRealLongitude);
    $this->ajaxReturn( array('status'=>1) );
  }

  /**
   * 设置访问PC版的相关session
   */
  public function setPcSession(){
    session('WST_VIEW', 'PC');
    $this->ajaxReturn(1);
  }
}