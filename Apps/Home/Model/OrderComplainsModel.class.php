<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 订单投诉服务类
 */
class OrderComplainsModel extends BaseModel {
    /**
	  * 获取用户投诉列表
	  */
	public function queryUserComplainByPage(){
		$userId = (int)session('WST_USER.userId');
		$orderNo = WSTAddslashes(I('orderNo'));
		$sql = "select oc.complainId,o.orderId,o.orderNo,p.shopId,p.shopName,oc.complainContent,oc.complainStatus,oc.complainTime
		        from __PREFIX__order_complains oc left join __PREFIX__shops p on oc.respondTargetId=p.shopId,
		        __PREFIX__orders o where oc.orderId=o.orderId and o.orderFlag=1 and o.userId=".$userId;
		if($orderNo!='')$sql.=" and o.orderNo like '%".$orderNo."%'";
		$sql.=" order by oc.complainId desc";
		return  $this->pageQuery($sql,(int)I('p'),30);
	}
	
     /**
	  * 获取商家被投诉列表
	  */
	public function queryShopComplainByPage(){
		$shopId = (int)session('WST_USER.shopId');
		$orderNo = WSTAddslashes(I('orderNo'));
		$sql = "select oc.complainId,o.orderId,o.orderNo,u.userName,u.loginName,oc.complainContent,oc.complainStatus,oc.complainTime
		        from __PREFIX__order_complains oc left join __PREFIX__users u on oc.complainTargetId=u.userId,
		        __PREFIX__orders o where oc.needRespond=1 and oc.orderId=o.orderId and o.orderFlag=1 and oc.respondTargetId=".$shopId;
		if($orderNo!='')$sql.=" and o.orderNo like '%".$orderNo."%'";
		$sql.=" order by oc.complainId desc";
		return  $this->pageQuery($sql,(int)I('p'),30);
	}
	
	/**
	 * 获取订单信息
	 */
	public function getOrderInfo(){
		$userId = (int)session('WST_USER.userId');
		$orderId = (int)I('orderId');
		//判断是否提交过投诉
		$sql = "select complainId from __PREFIX__order_complains where orderId=".$orderId." and complainTargetId=".$userId;
		$rs = $this->queryRow($sql);
		$data = array('complainStatus'=>1);
		if($rs['complainId']==''){
			//获取订单信息
			$sql = "select o.realTotalMoney,o.orderNo,o.orderId,o.createTime,o.deliverMoney,o.requireTime,p.shopName,p.shopId 
			        from __PREFIX__orders o left join __PREFIX__shops p on o.shopId=p.shopId where o.orderId=".$orderId." and o.userId=".$userId;
			$order = $this->queryRow($sql);
			if($order){
				//获取相关商品
				$sql = "select og.orderId, og.goodsId ,g.goodsSn, og.goodsNums, og.goodsName , og.goodsPrice shopPrice,og.goodsThums,og.goodsAttrName,og.goodsAttrName 
						from __PREFIX__goods g , __PREFIX__order_goods og 
						WHERE g.goodsId = og.goodsId AND og.orderId = $orderId";
				$goods = $this->query($sql);
				$order["goodsList"] = $goods;
			}
			$data['order'] = $order;
			$data['complainStatus'] = 0;
		}
        return $data;
	}
	
	/**
	 * 保存订单投诉信息
	 */
	public function saveComplain(){
		$rd = array('status'=>-1);
		$userId = (int)session('WST_USER.userId');
		$rules = array(
		     array('orderId','integer','无效的订单！',1),
		     array('complainType',array(1,2,3,4),'无效的投诉类型！',1,'in'),
		     array('complainContent','require','投诉内容不能为空！',1)
		);
	    if($this->validate($rules)->create()){
	        //判断订单是否该用户的
			$sql = "select o.orderId,o.shopId from __PREFIX__orders o
			        where o.orderId=".$this->orderId." and o.userId=".$userId;
			$order = $this->queryRow($sql);
			if(!$order){
				$rd['msg'] = "无效的订单信息";
			    return $rd;
			}
			//判断是否提交过投诉
			$sql = "select complainId from __PREFIX__order_complains where orderId=".$this->orderId." and complainTargetId=".$userId;
			$rs = $this->queryRow($sql);
			if((int)$rs['complainId']>0){
				$rd['msg'] = "该订单已进行了投诉,请勿重提提交投诉信息";
			    return $rd;
			}
			
			$this->complainTargetId = $userId;
			$this->respondTargetId = $order['shopId'];
			$this->complainStatus = 0;
			$this->complainTime = date('Y-m-d H:i:s');
			if(I('complainAnnex')!='')$this->complainAnnex = I('complainAnnex');
			$rs = $this->add();
			if($rs !==false){
				$rd['status'] = 1;
			}else{
				$rd['msg'] = '提交订单投诉信息失败';
			}
		}else{
			$rd['msg'] = $this->getError();
		}
		return $rd;
	}
	
	/**
	 * 获取投诉详情
	 */
	public function getComplainDetail($userType = 0){
		$userId = (int)session('WST_USER.userId');
		$shopId = (int)session('WST_USER.shopId');
		$id = (int)I('id');
		//获取订单信息
		$sql = "select oc.*,o.realTotalMoney,o.orderNo,o.orderId,o.createTime,o.deliverMoney,o.requireTime,p.shopName,p.shopId 
			        from __PREFIX__order_complains oc,__PREFIX__orders o left join __PREFIX__shops p on o.shopId=p.shopId 
			        where oc.orderId=o.orderId and oc.complainId=".$id;
		if($userType==0){
			$sql.=" and oc.complainTargetId=".$userId;
		}else{
			$sql.=" and oc.needRespond=1 and oc.respondTargetId=".$shopId;
		}
		$rs = $this->queryRow($sql);
		if($rs){
			if($rs['complainAnnex']!='')$rs['complainAnnex'] = explode(',',$rs['complainAnnex']);
			if($rs['respondAnnex']!='')$rs['respondAnnex'] = explode(',',$rs['respondAnnex']);
			//获取相关商品
			$sql = "select og.orderId, og.goodsId ,g.goodsSn, og.goodsNums, og.goodsName , og.goodsPrice shopPrice,og.goodsThums,og.goodsAttrName,og.goodsAttrName 
						from __PREFIX__goods g , __PREFIX__order_goods og 
						WHERE g.goodsId = og.goodsId AND og.orderId =".$rs['orderId'];
			$goods = $this->query($sql);
			$rs["goodsList"] = $goods;
		}
        return $rs;
	}
	
    /**
	 * 保存订单商家应诉信息
	 */
	public function saveRespond(){
		$rd = array('status'=>-1);
		$shopId = (int)session('WST_USER.shopId');
		$complainId = (int)I('complainId');
		$rules = array(
		     array('respondContent','require','应诉内容不能为空！',1)
		);
	    if($this->validate($rules)->create()){
			//判断是否提交过应诉和是否有效的投诉信息
			$sql = "select needRespond,complainStatus from __PREFIX__order_complains where complainId=".$complainId." and respondTargetId=".$shopId;
			$rs = $this->queryRow($sql);
	        if((int)$rs['needRespond']!=1){
				$rd['msg'] = "无效的投诉信息";
			    return $rd;
			}
			if((int)$rs['complainStatus']!=1){
				$rd['msg'] = "该投诉订单已进行了应诉,请勿重复提交应诉信息";
			    return $rd;
			}
			$this->complainStatus = 3;
			$this->respondTime = date('Y-m-d H:i:s');
			if(I('respondAnnex')!='')$this->respondAnnex = I('respondAnnex');
			$rs = $this->where('complainId='.$complainId)->save();
			if($rs !==false){
				$rd['status'] = 1;
			}else{
				$rd['msg'] = '提交订单应诉信息失败';
			}
		}else{
			$rd['msg'] = $this->getError();
		}
		return $rd;
	}
}