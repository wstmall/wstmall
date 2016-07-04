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
class GoodsAction extends BaseAction {

	/**
	 * 商品列表主页
	 */
    public function index(){
		$this->assign("goodsCatId1", (int)I('goodsCatId1'));
		$this->assign("goodsCatId2", (int)I('goodsCatId2'));
		$this->assign("goodsCatId3", (int)I('goodsCatId3'));
		$this->assign("searchKey", WSTAddslashes(I('key')));
		$this->assign("brandId", (int)I('brandId'));
    	$this->display('default/goods_list');
    }

    /**
	 * 获取商品库存
	 */
	public function getGoodsStock(){
		$goods = D('WebApp/Goods');
		$goodsStock = $goods->getGoodsStock();
		$this->ajaxReturn($goodsStock);
	}

	/**
	 * 获取商品分类
	 */
	public function getGoodsCats(){	
		$areaId2 = $this->getDefaultCity();
		$m = D('WebApp/GoodsCats');
		$catList = $m->getGoodsCats($areaId2);
		$this->assign('catList',$catList);
   		$this->display("default/categories");
	}

	/**
	 * 商品详情
	 * 
	 */
	public function goodsDetails(){
		$goods = D('WebApp/Goods');
		$goodsId = (int)I("goodsId");
		$goodsDetails = $goods->getGoodsDetails();
		$this->assign('goodsDetails',$goodsDetails);
		//获取关注信息
		$m = D('WebApp/Favorites');
		$this->assign("favoriteId",$m->checkFavorite($goodsId, 0));
   		$this->display("default/goods_details");
	}

    /**
	 * 商品列表
	 */
    public function getGoodsList(){
		$goods = D('WebApp/Goods');
		$goodsList = $goods->getGoodsList();
		$this->ajaxReturn($goodsList);
    }

	/**
	 * 通过商品ID查询商品详细介绍
	 * 
	 */
	public function getGoodsDescByGoodsId(){
		$goods = D('WebApp/Goods');
		$goodsDesc = $goods->getGoodsDescByGoodsId();
		$this->ajaxReturn($goodsDesc);
	}

	/**
	 * 提交商品评论
	 * 
	 */
	public function addAppraises(){
    	$this->isLogin();
		$goods = D('WebApp/Goods');
		$rs = $goods->addAppraises();
		$this->ajaxReturn($rs);
	}

	/**
	 * 通过id获取商品评价
	*/
    public function getAppraiseById(){
		$goods = D('WebApp/Goods');
		$rs = $goods->getAppraiseById();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 商品评价页
	 */
    public function toGoodsAppraise(){
		$goods = D('WebApp/Goods');
		$appraisesList = $goods->getAppraisesList();
		$this->assign("appraisesList", $appraisesList);
		$this->assign("goodsId", (int)I("goodsId"));
	    $this->display('default/appraise_list');
    }

	/**
	 * 获取商品评价列表
	 */
    public function getAppraisesList(){
		$goods = D('WebApp/Goods');
		$appraisesList = $goods->getAppraisesList();
		$this->ajaxReturn($appraisesList);
    }

    /**
	 * 查询商品属性价格及库存
	 */
    public function getPriceAttrInfo(){
    	$goods = D('WebApp/Goods');
		$rs = $goods->getPriceAttrInfo();
		$this->ajaxReturn($rs);
    }
}