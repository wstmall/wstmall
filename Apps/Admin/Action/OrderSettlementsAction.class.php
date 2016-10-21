<?php
 namespace Admin\Action;;
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
	 * 订单结算列表
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('js_00');
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		$rs = array('status'=>1);
		$m = D('Admin/OrderSettlements');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign('areaId1',(int)I('areaId1'));
    	$this->assign('areaId2',(int)I('areaId2'));
    	$this->assign('areaId3',(int)I('areaId3'));
    	$this->assign('settlementNo',I('settlementNo'));
    	$this->assign('isFinish',(int)I('isFinish',-1));
		$this->display("/ordersettlements/list");
	}
	
	/**
	 * 跳去结算页面
	 */
	public function toSettlement(){
		$this->isLogin();
		$this->checkPrivelege('js_04');
		$m = D('Admin/OrderSettlements');
	    if((int)I('id')>0){
			$object = $m->get();
			$this->assign('object',$object);
		}
		$this->display("/ordersettlements/settlement");
	}
	
	/**
	 * 结算
	 */
	public function settlement(){
		$this->isLogin();
		$this->checkPrivelege('js_04');
		$m = D('Admin/OrderSettlements');
		$rs = $m->settlement();
		$this->ajaxReturn($rs);
	}
	
    /**
	 * 跳去结算页面
	 */
	public function toView(){
		$this->isLogin();
		$this->checkPrivelege('js_04');
		$m = D('Admin/OrderSettlements');
	    if((int)I('id')>0){
			$object = $m->getDetail();
			$this->assign('object',$object);
		}
		$this->display("/ordersettlements/view");
	}
	
};
?>