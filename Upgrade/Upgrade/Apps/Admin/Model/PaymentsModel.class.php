<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 支付类
 */
class PaymentsModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function add(){
	 	$rd = array('status'=>-1);
		$data = array();
		$data["payCode"] = I("payCode");
		$data["payName"] = I("payName");
		$data["payDesc"] = I("payDesc");
		;
		if($this->checkEmpty($data,true)){
			
			$data["payOrder"] = (int)I("payOrder",0);
			$data["payConfig"] = I("payConfig");
			$data["enabled"] = (int)I("enabled");
			$data["isOnline"] = (int)I("isOnline");
			
			$m = M('Payments');
			$rs = $m->add($data);
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
	    
		$m = M('Payments');
		$data["payName"] = I("payName");
		$data["payDesc"] = I("payDesc");
		$data["payOrder"] = (int)I("payOrder");
		$data["payConfig"] = json_encode(I("payConfig")) ;
		$data["enabled"] = 1;
		if($this->checkEmpty($data)){	
			$rs = $m->where("id=".(int)I('id'))->save($data);
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
	 	$m = M('Payments');
		$payment = $m->where("id=".(int)I('id'))->find();
		$payConfig = json_decode($payment["payConfig"]) ;
		foreach ($payConfig as $key => $value) {
			$payment[$key] = $value;
		}
		return $payment;
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
        $m = M('Payments');
	 	$sql = "select * from __PREFIX__payments order by payOrder asc";
		$rs = $m->pageQuery($sql);
		
		foreach ($rs["root"] as $key => $value) {
			
			 $rs["root"][$key]["payDesc"] = htmlspecialchars_decode($value["payDesc"]) ;
		
		}
		return $rs;
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $m = M('Payments');
		 $rs = $m->select();
		 return $rs;
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
		$m = M('Payments');
		$data["enabled"] = 0;
		$rs = $m->where("id=".(int)I('id'))->save($data);
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
	 

};
?>