<?php
 namespace Home\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 订单投诉控制器
 */
class OrderComplainsAction extends BaseAction{
	
	/**
	 * 获取用户投诉列表
	 */
    public function queryUserComplainByPage(){
    	$this->isUserLogin();  	
    	self::WSTAssigns();
		$Page = D('Home/OrderComplains')->queryUserComplainByPage($obj);
		$this->assign("umark","queryUserComplainByPage");
		$this->assign("Page",$Page);
		$this->display("default/users/orders/list_complain");
	}
	
	/**
	 * 订单投诉
	 */
	public function complain(){
		$this->isUserLogin();
		$data = D('Home/OrderComplains')->getOrderInfo();
		$this->assign("data",$data);
		$this->display("default/users/orders/complain");
	}
	
	/**
	 * 保存订单投诉信息
	 */
	public function saveComplain(){
		$this->isUserLogin();
		$rs = D('Home/OrderComplains')->saveComplain();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 用户查投诉详情
	 */
	public function getUserComplainDetail(){
		$this->isUserLogin();
		$data = D('Home/OrderComplains')->getComplainDetail(0);
		$this->assign("data",$data);
		$this->assign("umark","queryUserComplainByPage");
		$this->display("default/users/orders/complain_detail");
	}
	
	/**
	 * 获取商家被投诉订单
	 */
    public function queryShopComplainByPage(){
    	$this->isUserLogin();  	
    	self::WSTAssigns();
		$Page = D('Home/OrderComplains')->queryShopComplainByPage($obj);
		$this->assign("umark","queryShopComplainByPage");
		$this->assign("Page",$Page);
		$this->display("default/shops/orders/list_complain");
	}
    /**
	 * 订单投诉
	 */
	public function respond(){
		$this->isUserLogin();
		$data = D('Home/OrderComplains')->getComplainDetail(1);
		$this->assign("data",$data);
		$this->display("default/shops/orders/respond");
	}
	/**
	 * 订单投诉
	 */
	public function saveRespond(){
		$this->isShopLogin();
		$rs = D('Home/OrderComplains')->saveRespond();
		$this->ajaxReturn($rs);
	}
	
    /**
	 * 查投诉详情
	 */
	public function getShopComplainDetail(){
		$this->isUserLogin();
		$data = D('Home/OrderComplains')->getComplainDetail(1);
		$this->assign("data",$data);
		$this->display("default/shops/orders/complain_detail");
	}
};
?>