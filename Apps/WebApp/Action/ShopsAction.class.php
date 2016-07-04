<?php
namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商家控制器
 */
class ShopsAction extends BaseAction {
	/**
	 * 商家主页
	 */
	public function index(){
	    $shops = D('WebApp/Shops');
	    $shopId = (int)I('shopId', 0);
		//如果沒有传店铺ID进来则取默认自营店铺
		if($shopId == 0){
			$area = $this->getDefaultCity();
			$shopId = $shops->checkSelfShopId($area['areaId2']);
		}
	    $shopInfo = $shops->getShopInfo($shopId);
	   	$this->assign('shopInfo',$shopInfo);
		//获取关注信息
		$m = D('WebApp/Favorites');
		$this->assign("favoriteId",$m->checkFavorite($shopId, 1));
	 	$this->display("default/shops_home");

	}
	
	/**
     * 商家列表主页
     */
	public function goToShops(){
		$this->assign("searchKey", WSTAddslashes(I('key')));
		$this->display("default/shops_list");
	}

	/**
     * 商家列表
     */
	public function getShopsList(){
		$shops = D('WebApp/Shops');
		$shopsList = $shops->getShopsList();
		$this->ajaxReturn($shopsList);
	}

	/**
     * 商家商品列表
     */
	public function getShopGoodsList(){
		$shops = D('WebApp/Shops');
		$shopGoodsList = $shops->getShopGoodsList();
		$this->ajaxReturn($shopGoodsList);
	}

}