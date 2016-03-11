<?php
 namespace Admin\Model;
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
	 * 获取订单详细信息
	 */
	 public function getDetail(){
	 	$id = (int)I('id');
	 	$sql = "select oc.*,u.userName from __PREFIX__order_complains oc,__PREFIX__users u where oc.complainTargetId=u.userId and oc.complainId=".$id;
	 	$data = $this->queryRow($sql);
	 	if($data){
	 		if($data['complainAnnex']!='')$data['complainAnnex'] = explode(',',$data['complainAnnex']);
	 		if($data['respondAnnex']!='')$data['respondAnnex'] = explode(',',$data['respondAnnex']);
			$sql = "select o.*,s.shopName from __PREFIX__orders o
		 	         left join __PREFIX__shops s on o.shopId=s.shopId 
		 	         where o.orderFlag=1 and o.orderId=".$data['orderId'];
			$rs = $this->queryRow($sql);
			//获取用户详细地址
			$sql = 'select communityName,a1.areaName areaName1,a2.areaName areaName2,a3.areaName areaName3 from __PREFIX__communitys c 
			        left join __PREFIX__areas a1 on a1.areaId=c.areaId1 
			        left join __PREFIX__areas a2 on a2.areaId=c.areaId2
			        left join __PREFIX__areas a3 on a3.areaId=c.areaId3
			        where c.communityId='.$rs['communityId'];
			$cRs = $this->queryRow($sql);
			$rs['userAddress'] = $cRs['areaName1'].$cRs['areaName2'].$cRs['areaName3'].$cRs['communityName'].$rs['userAddress'];
			//获取日志信息
			$m = M('log_orders');
			$sql = "select lo.*,u.loginName,u.userType,s.shopName from __PREFIX__log_orders lo
			         left join __PREFIX__users u on lo.logUserId = u.userId
			         left join __PREFIX__shops s on u.userType!=0 and s.userId=u.userId
			         where orderId=".$data['orderId'];
			$rs['log'] = $this->query($sql);
			//获取相关商品
			$sql = "select og.*,g.goodsThums,g.goodsName,g.goodsId from __PREFIX__order_goods og
				        left join __PREFIX__goods g on og.goodsId=g.goodsId
				        where og.orderId = ".$data['orderId'];
			$rs['goodslist'] = $this->query($sql);
			$data['order'] = $rs;
	 	}
		return $data;
	 }
	 
	 /**
	  * 获取订单投诉列表
	  */
    public function queryByPage(){
        $shopName = WSTAddslashes(I('shopName'));
     	$orderNo = WSTAddslashes(I('orderNo'));
     	$complainStatus = (int)I('complainStatus',-1);
     	$areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
     	$areaId3 = (int)I('areaId3',0);
	 	$sql = "select oc.complainId,o.orderId,o.orderNo,s.shopName,o.userName,oc.complainTime,oc.complainStatus,oc.complainType
	 	         from __PREFIX__orders o left join __PREFIX__shops s on o.shopId=s.shopId
	 	         ,__PREFIX__order_complains oc where oc.orderId=o.orderId and o.orderFlag=1 and o.orderStatus in (-5,-4,-3,4) ";
	 	if($areaId1>0)$sql.=" and s.areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and s.areaId2=".$areaId2;
	 	if($areaId3>0)$sql.=" and s.areaId3=".$areaId3;
	 	if($complainStatus>-1)$sql.=" and oc.complainStatus=".$complainStatus;
	 	if($orderNo!='')$sql.=" and o.orderNo like '%".$orderNo."%' ";
	 	$sql.=" order by complainId desc";  
		$page = $this->pageQuery($sql);
		return $page;
	 }
	 /**
	  * 仲裁
	  */
	 public function finalHandle(){
	 	$rd = array('status'=>-1,'msg'=>'无效的投诉信息');
	 	$id = (int)I('id');
	 	if($id==0)return $rd;
	 	//判断是否已经处理过了
	 	$sql = "select oc.complainStatus,p.userId shopUserId,o.userId,o.orderNo,o.orderId 
	 	        from __PREFIX__order_complains oc,__PREFIX__orders o left join __PREFIX__shops p on o.shopId=p.shopId
	 	        where oc.orderId=o.orderId and complainId=".$id;
	 	$rs = $this->queryRow($sql);
	 	if($rs['complainStatus']!=4){
	 		$data = array();
	 		$data['finalHandleStaffId'] = session('WST_STAFF.staffId');
	 		$data['complainStatus'] = 4;
	 		$data['finalResult'] = I('finalResult');
	 		$data['finalResultTime'] = date('Y-m-d H:i:s');
	 	    $ers = $this->where('complainId='.$id)->save($data);
	 	    if($ers!==false){
	 	    	$rd['status'] = 1;
	 	    	$rd['msg'] = '操作成功!';
		 	    //发站内商家信息提醒
		 	    $messsage = array(
						'msgType' => 0,
						'sendUserId' => session('WST_STAFF.staffId'),
						'receiveUserId' => $rs['shopUserId'],
						'msgContent' => "您的被投诉订单【".$rs['orderNo']."】已仲裁，请查看订单投诉详情。",
						'createTime' => date('Y-m-d H:i:s'),
						'msgStatus' => 0,
						'msgFlag' => 1,
				);
				M('messages')->add($messsage);
				//发站内用户信息提醒
		 	    $messsage = array(
						'msgType' => 0,
						'sendUserId' => session('WST_STAFF.staffId'),
						'receiveUserId' => $rs['userId'],
						'msgContent' => "您的订单投诉【".$rs['orderNo']."】已仲裁，请查看订单投诉详情。",
						'createTime' => date('Y-m-d H:i:s'),
						'msgStatus' => 0,
						'msgFlag' => 1,
				);
				M('messages')->add($messsage);
	 	    }
	 	}else{
	 	    $rd['msg'] = '操作失败，该投诉状态已发生改变，请刷新后重试!';
	 	}
	 	return $rd;
	 }
	 
	 /**
	  * 转交给应诉人应诉
	  */
	 public function deliverRespond(){
	 	$rd = array('status'=>-1,'msg'=>'无效的投诉信息');
	 	$id = (int)I('id');
	 	if($id==0)return $rd;
	 	//判断是否已经处理过了
	 	$sql = "select oc.complainStatus,oc.respondTargetId,o.orderNo from __PREFIX__order_complains oc,__PREFIX__orders o 
	 	        where oc.orderId=o.orderId and complainId=".$id;
	 	$rs = $this->queryRow($sql);
	 	if($rs['complainStatus']==0){
	 		$data = array();
	 		$data['needRespond'] = 1;
	 		$data['complainStatus'] = 1;
	 		$data['deliverRespondTime'] = date('Y-m-d H:i:s');
	 	    $ers = $this->where('complainId='.$id)->save($data);
	 	    if($ers!==false){
	 	    	$rd['status'] = 1;
	 	    	$rd['msg'] = '操作成功!';
		 	    //发站内信息提醒
		 	    $messsage = array(
						'msgType' => 0,
						'sendUserId' => session('WST_STAFF.staffId'),
						'receiveUserId' => $rs['respondTargetId'],
						'msgContent' => "您有新的被投诉订单【".$rs['orderNo']."】，请及时回应以免影响您的店铺评分。",
						'createTime' => date('Y-m-d H:i:s'),
						'msgStatus' => 0,
						'msgFlag' => 1,
				);
				M('messages')->add($messsage);
	 	    }
	 	}else{
	 	    $rd['msg'] = '操作失败，该投诉状态已发生改变，请刷新后重试!';
	 	}
	 	return $rd;
	 }
};
?>