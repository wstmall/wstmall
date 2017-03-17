<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 优惠券控制器
 */
class CouponsAction extends BaseAction {
	
	
   /**
	* 分页查询
	*/
	public function queryCouponByPage(){
		$this->isShopLogin();
		$m = D('Home/Coupons');
    	$page = $m->queryCouponByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('couponName',I("couponName"));
    	$this->assign('startDate',I("startDate"));
    	$this->assign('endDate',I("endDate"));
    	$this->assign('Page',$page);
    	$this->assign("umark","queryCouponByPage");
        $this->display("shops/coupons/list");
	}
	/**
	 * 跳到新增/编辑优惠券
	 */
    public function toEdit(){
		$this->isShopLogin();
		$m = D('Home/Coupons');
		$object = array();
		$couponId = (int)I('id',0);
    	if($couponId>0){
    		$object = $m->get();
    	}else{
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
    	$this->assign("umark",I('umark'));
        $this->display("shops/coupons/edit");
	}
	/**
	 * 新增优惠券
	 */
	public function edit(){
		$this->isShopLogin();
		$m = D('Home/Coupons');
    	$rs = array();
    	if((int)I('id',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除优惠券
	 */
	public function del(){
		$this->isShopLogin();
		$m = D('Home/Coupons');
		$rs = $m->del();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 跳到新增/编辑优惠券
	 */
	public function mineCoupons(){
		$this->isUserLogin();
		$m = D('Home/Coupons');
		$coupons = $m->getMyCoupons();
		$this->assign('coupons',$coupons);
		$this->assign("umark","mineCoupons");
		$this->display("users/coupons/list");
	}
	
	public function toReceiveCoupon(){
		$this->isUserLogin();
		$m = D('Home/Coupons');
		$coupon = $m->getCouponInfo();
		$this->assign("coupon",$coupon);
		$this->display("users/coupons/receive");
	}
	
	
	public function showReceiveResult(){
		$this->isUserLogin();
		$m = D('Home/Coupons');
		$coupon = $m->getCouponInfo();
		$this->assign("coupon",$coupon);
		$this->assign("result",(int)I("result"));
		$this->display("users/coupons/receive_result");
	}
	
	/**
	 * 领取优惠券
	 */
	public function receiveCoupon(){
		$this->isUserLogin();
		$m = D('Home/Coupons');
		$rs = $m->receiveCoupon();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除优惠券
	 */
	public function delByUser(){
		$this->isUserLogin();
		$m = D('Home/Coupons');
		$rs = $m->delByUser();
		$this->ajaxReturn($rs);
	}
	
	public function getShopCoupons(){
		$this->isUserLogin();
		$m = D('Home/Coupons');
		$shopId = (int)I("shopId");
		$rs = $m->getShopCoupons($shopId);
		$this->ajaxReturn($rs);
	}
}