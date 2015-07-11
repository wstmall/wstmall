<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 登陆日志服务类
 */
use Think\Model;
class LogLoginsModel extends BaseModel {
     /**
	  * 新增
	  */
	 public function add(){
	 	$rd = array('status'=>-1);
	 	$id = I("id",0);
		$data = array();
		$data["loginId"] = I("loginId");
		$data["staffId"] = I("staffId");
		$data["loginTime"] = date('Y-m-d H:i:s');
		$data["loginIp"] = get_client_ip();;
		foreach ($data as $key=>$v){
			if(trim($v)==''){
				$rd['status'] = -2;
				return $rs;
			}
		}
		$m = M('log_staff_logins');
		$rs = $m->add($data);
		if($rs){
			$rd['status']= 1;
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get(){
	 	$m = M('log_staff_logins');
		return $m->where("loginId=".I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
        $m = M('log_logins');
	 	$sql = "select loginName,staffName,loginTime,loginIp from __PREFIX__log_staff_logins l,__PREFIX__staffs s where l.staffId=s.staffId 
	 	        and loginTime between'".I('startDate',date('Y-m-d'))." 00:00:00' and '".I('endDate',date('Y-m-d'))." 23:59:59'
	 	        order by loginId desc";
		return $m->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	    $m = M('log_logins');
	     $sql = "select * from __PREFIX__log_logins order by loginId desc";
		 return $m->find($sql);
	  }
};
?>