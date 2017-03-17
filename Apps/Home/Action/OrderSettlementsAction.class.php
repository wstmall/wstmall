<?php
 namespace Home\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单结算控制器
 */
class OrderSettlementsAction extends BaseAction{
	
	/**
	 * 跳去订单结算页面
	 */
    public function toSettlementIndex(){
    	$this->isShopLogin();  	
    	$this->assign("umark","toSettlementIndex");
		$this->display("shops/orders/settlements");
	}
	/**
	 * 订单结算列表
	 */
	public function querySettlementsByPage(){
		$this->isShopLogin();
		$rs = array('status'=>1);
		$rs['data'] = D('Home/OrderSettlements')->querySettlementsByPage();
		$this->ajaxReturn($rs);
	}
	/**
	 * 未结算订单
	 */
    public function queryUnSettlementOrdersByPage(){
		$this->isShopLogin();
		$rs = array('status'=>1);
		$rs['data'] = D('Home/OrderSettlements')->queryUnSettlementOrdersByPage();
		$this->ajaxReturn($rs);
	}
	/**
	 * 获取已结算的订单列表
	 */
	public function querySettlementsOrdersByPage(){
		$this->isShopLogin();
		$rs = array('status'=>1);
		$rs['data'] = D('Home/OrderSettlements')->querySettlementsOrdersByPage();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 订单结算申请
	 */
	public function settlement(){
		$this->isShopLogin();
		$rs = D('Home/OrderSettlements')->settlement();
		$this->ajaxReturn($rs);
	}
	
};
?>