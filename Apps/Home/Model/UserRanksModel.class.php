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
};
?>