<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 广告服务类
 */
class AdsModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["adPositionId"] = (int)I("adPositionId");
		$data["adFile"] = I("adFile");
		$data["adStartDate"] = I("adStartDate");
		$data["adEndDate"] = I("adEndDate");
		$data["adSort"] = I("adSort",0);
		if($this->checkEmpty($data,true)){
			$data["adName"] = I("adName");
		    $data["adURL"] = I("adURL");
			$data["areaId1"] = I("areaId1");
			$data["areaId2"] = I("areaId2");
		    $m = M('ads');
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
		$data["adPositionId"] = (int)I("adPositionId");
		$data["adFile"] = I("adFile");
		$data["adStartDate"] = I("adStartDate");
		$data["adEndDate"] = I("adEndDate");
		$data["adSort"] = (int)I("adSort",0);
	    if($this->checkEmpty($data,true)){	
	    	$data["adName"] = I("adName");
			$data["adURL"] = I("adURL");
	    	$data["areaId1"] = (int)I("areaId1");
			$data["areaId2"] = (int)I("areaId2");
			$m = M('ads');
		    $rs = $m->where("adId=".(int)I('id',0))->save($data);
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
	 	$m = M('ads');
		return $m->where("adId=".(int)I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
     	$adPositionId = (int)I('adPositionId');
     	$adDateRange = I('adDateRange');
     	$adName = I('adName');
        $m = M('ads');
	 	$sql = "select a.*,a1.areaName areaName1,a2.areaName areaName2
	 	        from __PREFIX__ads a left join __PREFIX__areas a1 on a.areaId1=a1.areaId 
	 	        left join __PREFIX__areas a2 on a.areaId2 = a2.areaId where 1=1 ";
	 	if($adPositionId!="")$sql.="  and adPositionId=".$adPositionId;
	 	if($adName!=""){
	 		$sql.="  and a.adName like '%$adName%'";
	 	}
	 	$sql.=' order by adId desc';

		return $m->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	    $m = M('ads');
	     $sql = "select * from __PREFIX__ads order by adId desc";
		 return $m->find($sql);
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	    $rd = array('status'=>-1);
	    $m = M('ads');
	    $rs = $m->delete((int)I('id'));
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
};
?>