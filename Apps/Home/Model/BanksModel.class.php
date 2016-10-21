<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 银行服务类
 */
use Think\Model;
class BanksModel extends BaseModel {
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
	 	$sql = "select * from __PREFIX__banks where bankFlag=1 order by bankId desc";
		$rs = $this->pageQuery($sql);
		return $rs;
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
		 $rs = $this->where('bankFlag=1')->select();
		 return $rs;
	  }
};
?>