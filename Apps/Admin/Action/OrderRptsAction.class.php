<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单报表控制器
 */
class OrderRptsAction extends BaseAction{
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('dttj_00');
		$this->assign('startDate',date('Y-m-d',strtotime("-31 day")));
		$this->assign('endDate',date('Y-m-d'));
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
        $this->display("/reports/orders");
	}
	
	/**
	 * 按月/日统计订单
	 */
	public function queryByMonthAndDays(){
		$this->isLogin();
		$this->checkPrivelege('dttj_00');
		$rs = D('Admin/OrderRpts')->queryByMonthAndDays();
		$this->ajaxReturn($rs);
	}
};
?>