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
class GoodsCatAction extends BaseAction {
	/**
	 * 获取商品分类
	 */
    public function index(){
      $goodsCat = D('WebApp/GoodsCat');
      $goodsCatList = $goodsCat->getGoodsCats();
   	  $this->assign('goodsCatList',$goodsCatList);
   	  $this->display("default/goods_category");
    }

}