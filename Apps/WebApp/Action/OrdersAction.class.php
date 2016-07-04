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
class OrdersAction extends BaseAction {

	/**
	 * 订单管理
	 */
  public function index(){
    $this->isLogin();
    $this->assign('status', (int)I('status'));
    $this->display("default/orders/orders_list");
  }

  /**
   * 订单列表
   */
  public function getOrderList(){
    $this->isLogin();
    $orders = D('WebApp/Orders');
    $ordersList = $orders->getOrderList();
    $this->ajaxReturn($ordersList);
  }

  /**
   * 结算-下单
   */
  public function addOrder(){
    $this->isLogin();
    $orders = D('WebApp/Orders');
    $rs = $orders->addOrder();
    return $this->ajaxReturn($rs);
  }

  /**
   * 取消订单
   */
    public function cancelOrder(){
      $this->isLogin();
      $USER = session('WST_USER');
      $morders = D('WebApp/Orders');
      $obj["userId"] = (int)$USER['userId'];
      $obj["orderId"] = (int)I("orderId");
      $rs = $morders->cancelOrder($obj);
      $this->ajaxReturn($rs);
  } 

  /**
   * 获取取消或拒收的订单
   */
    public function getBadOrders(){
      $this->isLogin();
      $USER = session('WST_USER');
      $morders = D('WebApp/Orders');
      $obj["userId"] = (int)$USER['userId'];
      $obj["orderId"] = (int)I("orderId");
      $ordersList = $morders->getOrderList($obj);
      $this->assign('ordersList',$ordersList);
      $this->display("default/orders/orders_bad");
  } 

  /**
   * 确认/拒收订单
   */
    public function confirmOrder(){
      $this->isLogin();
      $morders = D('WebApp/Orders');
      $rs = $morders->confirmOrder();
      $this->ajaxReturn($rs);
  } 
  
  /**
   * 订单詳情
   */
  public function getOrderDetails(){
    $this->isLogin();
    $orders = D('WebApp/Orders');
    $rs = $orders->getOrderDetails();
    $this->ajaxReturn($rs);
  }

  /**
   * 获取待评价订单中的商品
   */
  public function getNoAppraiseOrderGoods(){
    $this->isLogin();
    $orders = D('WebApp/Goods');
    $rs = $orders->getNoAppraiseOrderGoods();
    $this->ajaxReturn($rs);
  }
}