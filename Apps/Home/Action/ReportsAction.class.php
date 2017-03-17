<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.netstatSales
 * 联系QQ:707563272
 * ============================================================================
 * 报表控制器
 */
class ReportsAction extends BaseAction {
	/**
	 * 商品销售排行
	 */
	public function topSaleGoods(){
		$this->isShopLogin();
		$this->assign("startDate",date('Y-m-d',strtotime("-1month")));
		$this->assign("endDate",date('Y-m-d'));
		$this->assign("umark","topSaleGoods");
		$this->display('shops/reports/sale_goods');
	}
	
	public function getTopSaleGoods(){
		$this->isShopLogin();
		$m = D('Home/Reports');
		$rs = $m->getTopSaleGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 获取销售额
	 */
	public function statSales(){
		$this->isShopLogin();
		$this->assign("startDate",date('Y-m-d',strtotime("-1month")));
		$this->assign("endDate",date('Y-m-d'));
		$this->assign("umark","statSales");
		$this->display('shops/reports/stat_sales');
	}
	public function getStatSales(){
		$this->isShopLogin();
		$m = D('Home/Reports');
		$rs = $m->getStatSales();
		$this->ajaxReturn($rs);
	}
	
	
	/**
	 * 获取销售订单统计
	 */
	public function statOrders(){
		$this->isShopLogin();
		$this->assign("startDate",date('Y-m-d',strtotime("-1month")));
		$this->assign("endDate",date('Y-m-d'));
		$this->assign("umark","statOrders");
		$this->display('shops/reports/stat_orders');
	}
	public function getStatOrders(){
		$this->isShopLogin();
		$m = D('Home/Reports');
		$rs = $m->getStatOrders();
		$this->ajaxReturn($rs);
	}
}