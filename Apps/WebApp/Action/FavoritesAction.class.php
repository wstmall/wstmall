<?php
 namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 收藏夹控制器
 */
class FavoritesAction extends BaseAction{
	/**
	 * 我的关注
	 */
	public function index(){
		$this->isLogin();
      	$this->assign('favoriteKey', I('favoriteKey'));
		$this->display("default/users/favorites");
	}

	/**
	 * 我的关注列表
	 */
	public function getFavoritesList(){
		$this->isLogin();
		$rs = array();
		$m = D('WebApp/Favorites');
		if( (int)I('favoriteType') == 1 ){
			$rs = $m->getFavoritesShopsList();
		}else{
			$rs = $m->getFavoritesGoodsList();
		}
		$this->ajaxReturn($rs);
	}
	
    /**
     * 关注商品或店铺
     */
    public function favorite(){
    	$this->isLogin();
    	$rs = D('WebApp/Favorites')->favorite();
    	$this->ajaxReturn($rs);
    }
    
    /**
     * 取消关注
     */
    public function cancelFavorite(){
    	$this->isLogin();
    	$rs = D('WebApp/Favorites')->cancelFavorite();
    	$this->ajaxReturn($rs);
    }
};
?>