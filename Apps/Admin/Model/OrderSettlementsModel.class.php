<?php
namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单结算服务类
 */
class OrderSettlementsModel extends BaseModel {
	/**
	 * 获取结算列表
	 */
	public function queryByPage(){
		$settlementNo = WSTAddslashes(I('settlementNo'));
		$isFinish = (int)I('isFinish',-1);
		$areaId1 = (int)I('areaId1');
		$areaId2 = (int)I('areaId2');
		$areaId3 = (int)I('areaId3');
		$sql = "select os.*,p.shopName from __PREFIX__order_settlements os, __PREFIX__shops p where os.shopId=p.shopId ";
		if($areaId1>0)$sql.=" and p.areaId1=".$areaId1;
		if($areaId2>0)$sql.=" and p.areaId2=".$areaId2;
		if($areaId3>0)$sql.=" and p.areaId3=".$areaId3;
		if($settlementNo!='')$sql.=" and settlementNo like '%".$settlementNo."%'";
		if($isFinish>-1)$sql.=" and isFinish=".$isFinish;
		$sql.=" order by settlementId desc";
		return  $this->pageQuery($sql,(int)I('p'),30);
	}
	
	/**
	 * 获取订单结算信息
	 */
	public function get(){
		$id = (int)I('id');
		return $this->where('settlementId='.$id)->find();
	}
	/**
	 * 获取结算详情
	 */
	public function getDetail(){
		$id = (int)I('id');
		$sql = "select os.*,p.shopName from __PREFIX__order_settlements os,__PREFIX__shops p where os.shopId=p.shopId and os.settlementId=".$id;
		$rs =  $this->queryRow($sql);
		//获取订单列表
		$sql = "select orderId,orderNo,userName,realTotalMoney,poundageRate,poundageMoney from __PREFIX__orders where settlementId=".$id;
		$rs['List'] = $this->query($sql);
		return $rs;
	}
	
	/**
	 * 结算
	 */
	public function settlement(){
		$id = (int)I('id');
		$rd = array('status'=>-1);
	 	$rs = $this->where('isFinish=0 and settlementId='.$id)->find();
	 	if($rs['settlementId']!=''){
	 		$data = array();
	 		$data['isFinish'] = 1;
	 		$data['finishTime'] = date('Y-m-d H:i:s');
	 		$data['remarks'] = I('content');
	 	    $rss = $this->where("settlementId=".$id)->save($data);
			if(false !== $rss){
				$rd['status']= 1;
			}
	 	}
	 	return $rd;
	}
}