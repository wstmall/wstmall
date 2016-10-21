<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 会员服务类
 */
class UserScoreModel extends BaseModel {
	
     /**
	  * 获取用户积分列表
	  */
     public function getScoreList(){
		$scoreType = (int)I("scoreType",0);
	 	$userId=(int)session('WST_USER.userId');
	 	$sql = "select us.scoreId,us.userId,us.score,us.dataSrc,us.dataId,us.scoreType,us.createTime,us.dataRemarks,o.orderNo from __PREFIX__user_score us, __PREFIX__orders o  
	 			where us.dataId=o.orderId and us.userId=".$userId;
	 	if($scoreType>0){
	 		$sql.=" and us.scoreType= $scoreType";
	 	}
	 	$sql.=" order by us.createTime desc ";
	 	$rs = $this->pageQuery($sql);
	 	return $rs;
	 }
	
}