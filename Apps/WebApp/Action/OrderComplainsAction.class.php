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
class OrderComplainsAction extends BaseAction {

	/**
	 * 投诉订单列表
	 */
  public function index(){
    $this->isLogin();
    $complainsList = D('WebApp/OrderComplains')->getOrderComplainsList();
    if((int)I('byAjax')==1){
      $this->ajaxReturn($complainsList);
    }else{
      $this->assign('complainsList',$complainsList);
      $this->display("default/orders/complains_list");
    }
  }

  /**
   * 跳转到投诉页面
   */
  public function toComplains(){
    $this->isLogin();
    $data = D('WebApp/OrderComplains')->getOrderInfo();
    $this->assign("data",$data);
    $this->assign("orderId", (int)I('orderId'));
    $this->display("default/orders/complains_edit");
  }

  /**
   * 保存订单投诉信息
   */
  public function saveComplain(){
    $this->isLogin();
    $rs = array();
    $rs = D('WebApp/OrderComplains')->saveComplain();
    $this->ajaxReturn($rs);
  }

  /**
   * 获取投诉详情
   */
  public function getComplainDetails(){
    $this->isLogin();
    $rs = array();
    $rs = D('WebApp/OrderComplains')->getComplainDetails();
    $this->ajaxReturn($rs);
  }
  
}