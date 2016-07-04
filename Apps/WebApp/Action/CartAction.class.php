<?php
namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 购物车
 */
class CartAction extends BaseAction {

	/**
	 * 购物车列表
	 */
  public function index(){
    $this->isLogin();
    $cart = D('WebApp/Cart');
    $cartInfo = $cart->getCartInfo();
    $this->assign('cartInfo',$cartInfo);
    $this->display("default/cart");
  }

  /**
   * 添加商品到购物车(ajax)
   */
  public function addToCartAjax(){
    $this->isLogin();
    $m = D('WebApp/Cart');
    $res = $m->addToCart();
    $rs = array('status'=>1);
    $this->ajaxReturn($rs);
  }

  /**
   * 获取购物车信息
   * 
   */
  public function getCartInfo() {
    $this->isLogin();
    $m = D('WebApp/Cart');
    $cartInfo = $m->getCartInfo();
    $this->ajaxReturn($cartInfo);
  }

  /**
   * 获取购物车商品数量
   */
  public function getCartGoodCnt(){
    $this->isLogin();
    $this->ajaxReturn( array("goodscnt" => WSTCartNum()) );
  }
  
  /**
   * 删除购物车中的商品
   * 
   */
  public function delCartGoods(){ 
    $this->isLogin();
    $m = D('WebApp/Cart');  
    $res = $m->delCartGoods();
    $rs = array('status'=>1);
    $this->ajaxReturn($rs);
  }

  /**
   * 修改购物车中的商品数量
   * 
   */
  public function changeCartGoodsNum(){
    $this->isLogin();
    $m = D('WebApp/Cart');
    $rs = $m->changeCartGoodsnum();
    $this->ajaxReturn($rs);
  }

  /**
   * 结算-获取商品分组列表
   */
  public function settlement(){
    $this->isLogin();
    $m = D('WebApp/Cart');  
    $rs = $m->groupGoodsForOrder();
    $this->assign('rs', $rs);

    //获取收货地址
    $defaultAddress = D('WebApp/UsersAddress')->getUserAddressForOrder();
    $this->assign('defaultAddress', $defaultAddress);

    //获取支付方式
    $payTypes = D('WebApp/Payments')->getPayType();
    $this->assign('payTypes', $payTypes);
    
    $user = D('WebApp/Users')->getUserInfo(session('WST_USER.userId'));
    $this->assign("userScore", $user['userScore']);
    $baseScore = WSTOrderScore();
    $baseMoney = WSTScoreMoney();
    $userScoreCanUse = $baseScore * floor($user["userScore"]/$baseScore);
    $scoreMoney = $baseMoney * floor($user["userScore"]/$baseScore);
    $totalMoney = $rs['goodsTotalMoney'] + $rs['deliveryTotalMoney'];//订单总金额
    if( $totalMoney < $scoreMoney ){//订单金额小于积分金额
      $userScoreCanUse = $baseScore*floor($totalMoney/$baseMoney);
      $scoreMoney = $baseMoney*floor($totalMoney/$baseMoney);
    }
    $this->assign("userScoreCanUse",$userScoreCanUse);
    $this->assign("scoreMoney",$scoreMoney);
    $this->display("default/settlement");
  }

}