<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 优惠券服务类
 */
class CouponsModel extends BaseModel {


    /**
	 * 获取审核中的优惠券
	 */
	public function queryCouponByPage(){
		$shopId=(int)session('WST_USER.shopId');
		$startDate = I('startDate');
		$endDate = I('endDate');
		$couponName = WSTAddslashes(I('couponName'));
		$sql = "select * from __PREFIX__coupons where dataFlag=1 and shopId=".$shopId;
		if($couponName!=""){
			$sql .= " and couponName like '%".$couponName."%'";
		}
		if($startDate!=""){
			$sql .= " and validStartTime >= '$startDate'";
		}
		if($endDate!=""){
			$sql .= " and validEndTime <= '$endDate'";
		}
		$rs = $this->pageQuery($sql);
		return $rs;
	}
	
	protected $_validate = array(
		 array('couponName','require','请输入优惠活动名称!',1),
		 array('couponMoney',array(1,999999999),'请输入优惠券面额!',1,"between"),
		 array('spendMoney',array(1,999999999),'请输入最低消费金额!',1,"between"),
		 array('sendNum','require','请输入发放数量!',1),
		 array('sendStartTime','require','请输入发放开始时间!',1),
		 array('sendEndTime','require','请输入发放结束时间!',1),
		 array('validStartTime','require','请输入活动开始时间!',1),
		 array('validEndTime','require','请输入活动结束时间!',1)
	);
		
	/**
	 * 新增优惠券
	 */
	public function insert(){
	 	$rd = array('status'=>-1);
		$m = D('coupons');
		if ($m->create()){
			$m->shopId = (int)session('WST_USER.shopId');
			$m->dataFlag = 1;
			$m->createTime=date('Y-m-d H:i:s');
			$couponId = $m->add();
			if(false !== $couponId){
				$rd['status']= 1;
			}
		}else{
			$rd['msg'] = $m->getError();
		}
		return $rd;
	} 
	 
	/**
	 * 编辑优惠券信息
	 */
	public function edit(){
		$rd = array('status'=>-1);
	 	$couponId = (int)I("id",0);
	 	$shopId = (int)session('WST_USER.shopId');
	 	$m = D('coupons');
	 	if ($m->create()){
			$m->where(array("shopId"=>$shopId,"couponId"=>$couponId))->save();
			if(false !== $rs){
				$rd['status']= 1;
			}else{
				$rd['msg'] = $m->getError();
			}
		}else{
			$rd['msg'] = $m->getError();
		}
		return $rd;
	}
	/**
	 * 获取优惠券信息
	 */
	 public function get(){
	 	$m = M('coupons');
	 	$couponId = (int)I('id',0);
	 	$shopId = (int)session('WST_USER.shopId');
		$coupon = $m->where(array("shopId"=>$shopId,"couponId"=>$couponId))->find();
		return $coupon;
	 }
	 /**
	  * 删除优惠券
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	$couponId = (int)I('id');
	 	$shopId = (int)session('WST_USER.shopId');
	 	$data = array();
		$data["dataFlag"] = -1;
		$rs = $this->where(array("shopId"=>$shopId,"couponId"=>$couponId))->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
	 
	 /**
	  * 领取优惠券
	  */
	 public function receiveCoupon(){
	 	$rd = array('status'=>-1);
	 	$userId = (int)session('WST_USER.userId');
	 	$couponId = (int)I('id');
	 	$now = date("Y-m-d");
		$coupon = $this->where(array("couponId"=>$couponId))->field("sendNum,receiveNum,sendStartTime,sendEndTime")->find();
		if(!empty($coupon)){
			if($coupon["sendStartTime"]>$now){
				$rd["msg"] = "该优惠券尚未发放";
				return $rd;
			}else if($coupon["sendEndTime"]<$now){
				$rd["msg"] = "该优惠券已停止发放";
				return $rd;
			}else if($coupon["sendNum"]>0 && $coupon["sendNum"]<=$coupon["receiveNum"]){
				$rd["msg"] = "该优惠券已领完";
				return $rd;
			}
			
			$cnt = M("coupons_users")->where(array("couponId"=>$couponId,"dataFlag"=>1,"couponStatus"=>1,"userId"=>$userId))->count();
			
			if($cnt>0){
				$rd["msg"] = "您已领取该优惠券";
				return $rd;
			}
			$m = M("coupons_users");
			$data = array();
			$data["couponId"] = $couponId;
			$data["userId"] = $userId;
			$data["receiveTime"] = date("Y-m-d H:i:s");
			$data["couponStatus"] = 1;
			$rs = $m->add($data);
			if($rs!==false){
				$this->where(array("couponId"=>$couponId))->setInc("receiveNum",1);
				$rd["msg"] = "领取成功";
				$rd["status"] = 1;
			}
		}else{
			$rd["msg"] = "该优惠券无效";
		}
	 	
	 	return $rd;
	 }
	 
	 /**
	  * 我的优惠券
	  */
	 public function getMyCoupons(){
	 	$userId = (int)session('WST_USER.userId');
	 	$where = array();
	 	$where["cu.couponStatus"] = 1;
	 	$where["cu.userId"] = $userId;
	 	$where["cu.dataFlag"] = 1;
	 	$coupons = M("coupons c")->join("__COUPONS_USERS__ cu on c.couponId=cu.couponId")->join("__SHOPS__ s on s.shopId=c.shopId")->where($where)
	 		->field("s.shopId,s.shopName,shopImg,cu.id,c.couponId,couponName,couponType,couponMoney,spendMoney,validStartTime,validEndTime,receiveTime,couponStatus")
	 		->order("cu.receiveTime desc")
	 		->select();
	 	return $coupons;
	 }
	 
	 /**
	  * 我的领取优惠券
	  */
	 public function getMyCouponsByShopId(){
	 	$userId = (int)session('WST_USER.userId');
	 	$shopId = (int)I("shopId");
	 	$now = date("Y-m-d");
	 	$where = array();
	 	$where["c.shopId"] = $shopId;
	 	$where["validStartTime"] = array("elt",$now);
	 	$where["validEndTime"] = array("egt",$now);
	 	$where["c.dataFlag"] = 1;
	 	$where["cu.userId"] = $userId;
	 	$where["cu.couponStatus"] = 1;
	 	$where["cu.dataFlag"] = 1;
	 	$coupons = M("coupons c")->join("__COUPONS_USERS__ cu on cu.couponId=c.couponId")->where($where)
	 		->field("c.couponId,couponName,couponType,couponMoney,spendMoney,validStartTime,validEndTime")
	 		->select();
	 	return $coupons;
	 }
	 
	 /**
	  * 店铺优惠券
	  */
	 public function getCouponsByShopId($shopId){
	 	
	 	$now = date("Y-m-d");
	 	$where = array();
	 	$where["shopId"] = $shopId;
	 	$where["dataFlag"] = 1;
	 	$where["sendStartTime"] = array("elt",$now);
	 	$where["sendEndTime"] = array("egt",$now);
	 	$coupons = M("coupons")->where($where)
	 		->field("couponId,couponName,couponType,couponMoney,spendMoney,validStartTime,validEndTime")
	 		->select();
	 	return $coupons;
	 }
	 
	 /**
	  * 用户删除优惠券
	  */
	 public function delByUser(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I('id');
	 	$userId = (int)session('WST_USER.userId');
	 	$cuser = M("coupons_users")->where(array("userId"=>$userId,"id"=>$id))->find();
	 	$data = array();
	 	$data["dataFlag"] = -1;
	 	$rs = M("coupons_users")->where(array("userId"=>$userId,"id"=>$id))->save($data);
	 	if(false !== $rs){
	 		$rd['status']= 1;
	 		if($cuser["couponStatus"]==1){
	 			$couponId = $cuser["couponId"];
	 			$this->where(array("couponId"=>$couponId))->setDec("receiveNum",1);
	 		}
	 	}
	 	return $rd;
	 }
	 
	 /**
	  * 获取优惠券信息
	  */
	 public function getCouponInfo(){
	 	$m = M('coupons');
	 	$userId = (int)session('WST_USER.userId');
	 	$couponId = (int)I('couponId',0);
	 	$coupon = M('coupons c')->join("__SHOPS__ s on c.shopId=s.shopId")->where(array("couponId"=>$couponId))
	 			->field("c.shopId,shopName,shopImg,couponId,couponName,couponType,couponMoney,spendMoney,validStartTime,validEndTime")
	 			->find();
	 	$now = date("Y-m-d");
	 	if(!empty($coupon)){
	 		if($coupon["sendStartTime"]>$now){
	 			$coupon["msg"] = "该优惠券尚未发放";
	 		}else if($coupon["sendEndTime"]<$now){
	 			$coupon["msg"] = "该优惠券已停止发放";
	 		}else if($coupon["sendNum"]>0 && $coupon["sendNum"]<=$coupon["receiveNum"]){
	 			$coupon["msg"] = "该优惠券已领完";
	 		}
	 		$cnt = M("coupons_users")->where(array("couponId"=>$couponId,"dataFlag"=>1,"couponStatus"=>1,"userId"=>$userId))->count();
	 		if($cnt>0){
	 			$coupon["msg"] = "您已领取该优惠券";
	 		}
	 	}
	 	return $coupon;
	 }
	 
	 /**
	  * 店铺优惠券
	  */
	 public function getShopCoupons(){
	 	$shopId = (int)I("shopId");
	 	$now = date("Y-m-d");
	 	$where = array();
	 	$where["shopId"] = $shopId;
	 	$where["c.dataFlag"] = 1;
	 	$where["sendStartTime"] = array("elt",$now);
	 	$where["sendEndTime"] = array("egt",$now);
	 	$coupons = M("coupons c")->join("__COUPONS_USERS__ cu on c.couponId=cu.couponId and cu.dataFlag=1 and cu.couponStatus = 1 ","left")->where($where)
		 	->field("c.couponId,couponName,cu.id,couponMoney,spendMoney,validStartTime,validEndTime")
		 	->select();
	 	return $coupons;
	 }
}