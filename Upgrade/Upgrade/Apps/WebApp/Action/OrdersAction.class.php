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
class OrdersAction extends BaseAction {

	/**
	 * 订单管理
	 */
  public function index(){
    $orders = D('WebApp/Orders');
    $ordersList = $orders->getOrderList();
    // echo '<pre>';
    // var_dump($ordersList);
    // exit;
    $this->assign('ordersList',$ordersList);
    $this->display("default/orders_management");
  }

}