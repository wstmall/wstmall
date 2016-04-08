<?php
 namespace Home\Action;
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
	 * 分页查询
	 */
	public function queryByPage(){
		$this->isLogin();
		$m = D('Home/Favorites');
    	$this->assign("umark","queryFavoritesByPage");
    	$this->display("default/users/favorites");
	}
	/**
	 * 获取商品关注
	 */
	public function queryGoodsByPage(){
		$this->isLogin();
		$m = D('Home/Favorites');
		$page = $m->queryGoodsByPage();
		$rs = array();
		$rs['status'] = 1;
		$rs['data'] = $page;
		$this->ajaxReturn($rs);
	}
    /**
	 * 获取店铺关注
	 */
	public function queryShopsByPage(){
		$this->isLogin();
		$m = D('Home/Favorites');
		$page = $m->queryShopsByPage();
		$rs = array();
		$rs['status'] = 1;
		$rs['data'] = $page;
		$this->ajaxReturn($rs);
	}
	
    /**
     * 关注商品
     */
    public function favoriteGoods(){
    	$this->isLogin();
    	$m = D('Home/Favorites');
    	$rs = $m->favoriteGoods();
    	$this->ajaxReturn($rs);
    }
    /**
     * 关注商品
     */
    public function favoriteShops(){
    	$this->isLogin();
    	$m = D('Home/Favorites');
    	$rs = $m->favoriteShops();
    	$this->ajaxReturn($rs);
    }
    
    /**
     * 取消关注
     */
    public function cancelFavorite(){
    	$this->isLogin();
    	$m = D('Home/Favorites');
    	$rs = $m->cancelFavorite();
    	$this->ajaxReturn($rs);
    }
};
?>