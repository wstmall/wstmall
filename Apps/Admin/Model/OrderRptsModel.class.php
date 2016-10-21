<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单统计服务类
 */
class OrderRptsModel extends BaseModel {
	/**
	 * 按月/日进行订单统计
	 */
	public function queryByMonthAndDays(){
		$statType = (int)I('statType');
	 	$startDate = date('Y-m-d',strtotime(I('startDate')));
	 	$endDate = date('Y-m-d',strtotime(I('endDate')));
	 	$areaId1 = (int)I('areaId1');
	 	$areaId2 = (int)I('areaId2');
	 	$areaId3 = (int)I('areaId3');
	 	$rs = array();
	 	if($statType==0){
	 		$sql = "select left(createTime,10) createTime,count(orderId) counts from __PREFIX__orders where orderStatus>=0 
	 		        and createTime >='".$startDate." 00:00:00' and createTime<='".$endDate." 23:59:59'  ";
	 		if($areaId1>0)$sql.=" and areaId1=".$areaId1;
	 		if($areaId2>0)$sql.=" and areaId2=".$areaId2;
	 		if($areaId3>0)$sql.=" and areaId3=".$areaId3;
	 		$sql.=" group by left(createTime,10)";
	 		
	 	}else{
	 		$sql = "select left(createTime,7) createTime,count(orderId) counts from __PREFIX__orders where orderStatus>=0 
	 		        and createTime >='".$startDate." 00:00:00' and createTime<='".$endDate." 23:59:59' ";
	 		if($areaId1>0)$sql.=" and areaId1=".$areaId1;
	 		if($areaId2>0)$sql.=" and areaId2=".$areaId2;
	 		if($areaId3>0)$sql.=" and areaId3=".$areaId3;
	 		$sql.="  group by left(createTime,7)";
	 	}
	 	$rs = $this->query($sql);
	 	$data = array('status'=>1);
	    foreach ($rs as $key =>$v){
	 		$data['list'][$v['createTime']]["o_0"] = $v['counts'];
	 	}
	 	return $data;
	}
};
?>