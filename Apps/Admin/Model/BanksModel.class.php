<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 银行服务类
 */
class BanksModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
		$data = array();
		$data["bankName"] = I("bankName");
		$data["bankFlag"] = 1;
		if($this->checkEmpty($data,true)){
			$rs = $this->add($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
     /**
	  * 修改
	  */
	 public function edit(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data["bankId"] = (int)I("id");
		$data["bankName"] = I("bankName");
		if($this->checkEmpty($data)){	
			$rs = $this->where("bankId=".(int)I('id'))->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get(){
		return $this->where("bankId=".(int)I('id'))->find();
	 }
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
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
		$rs = $this->delete((int)I('id'));
		if($rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
};
?>