<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 会员等级服务类
 */
class UserRanksModel extends BaseModel {
	 /**
	  * 获取列表
	  */
	  public function checkUserRank($score){
	     $m = M('user_ranks');
		 return $rs = $m->where($score.' between  startScore and endScore ')->find();
	  }
	  
	  /**
	   * 获取用户等级
	   */
	  function getUserRank(){
	  	$userId = (int)session('WST_USER.userId');
	  	$sql = "select userId,userScore,userTotalScore from __PREFIX__users WHERE userId=$userId ";
	  	$user = $this ->queryRow($sql);
	  	
	  	$rank = array();
	  	if($user["userId"]>0){
	  		$userTotalScore = (int)$user["userTotalScore"];
	  		$sql = "select * from __PREFIX__user_ranks where startScore<=$userTotalScore and endScore>$userTotalScore";
	  		$rank = $this->queryRow($sql);
	  	}
	  	return $rank;
	  }
};
?>