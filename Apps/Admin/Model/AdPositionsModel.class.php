<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 广告位置服务类
 */
class AdPositionsModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
		$data = array();
		$data["positionType"] = (int)I("positionType");
		$data["positionWidth"] = (int)I("positionWidth");
		$data["positionHeight"] = (int)I("positionHeight");
		$data["positionName"] = I("positionName");
		$data["positionFlag"] = 1;
		if($this->checkEmpty($data,true) || $data["positionWidth"]<=0 || $data["positionHeight"]<=0){
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
		$data["positionType"] = (int)I("positionType");
		$data["positionWidth"] = (int)I("positionWidth");
		$data["positionHeight"] = (int)I("positionHeight");
		$data["positionName"] = I("positionName");
	    if($this->checkEmpty($data,true) || $data["positionWidth"]==0 || $data["positionHeight"]==0){	
		    $rs = $this->where("positionId=".$id)->save($data);
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
		return $this->where("positionId=".(int)I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
     	$positionType = (int)I('positionType',-1);
     	$positionName = WSTAddslashes(I('positionName'));
	 	$sql = "select * from __PREFIX__ad_positions a where 1=1 ";
	 	if($positionType!=-1)$sql.="  and positionType=".$positionType;
	 	if($positionName!=""){
	 		$sql.="  and a.positionName like '%$positionName%'";
	 	}
	 	$sql.=' order by positionId desc';
		return $this->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $sql = "select * from __PREFIX__ad_positions where positionType=".(int)I('positionType')." order by positionId desc";
		 return $this->query($sql);
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	    $rd = array('status'=>-1);
	    $rs = $this->delete((int)I('id'));
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
};
?>