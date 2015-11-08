<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 社区服务类
 */
class CommunitysModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["areaId1"] = (int)I("areaId1");
		$data["areaId2"] = (int)I("areaId2");
		$data["areaId3"] = (int)I("areaId3");
		$data["isService"] = I("isService");
		$data["communityName"] = I("communityName");
		$data["communitySort"] = I("communitySort",0);
		$data["communityFlag"] = 1;
	    if($this->checkEmpty($data)){
	    	$data["communityKey"] = I("communityKey");
			$m = M('communitys');
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
	 	$id = I("id",0);
		$data = array();
		$data["areaId1"] = (int)I("areaId1");
		$data["areaId2"] = (int)I("areaId2");
		$data["areaId3"] = (int)I("areaId3");
		$data["isService"] = I("isService");
		$data["communityName"] = I("communityName");
		$data["communitySort"] = (int)I("communitySort",0);
	    if($this->checkEmpty($data)){	
	    	$data["communityKey"] = I("communityKey");
			$m = M('communitys');
		    $rs = $m->where("communityId=".(int)I('id',0))->save($data);
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
	 	$m = M('communitys');
		return $m->where("communityId=".(int)I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
        $m = M('communitys');
        $areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
     	$areaId3 = (int)I('areaId3',0);
	 	$sql = "select c.*,a1.areaName areaName1,a2.areaName areaName2,a3.areaName areaName3 
	 	        from __PREFIX__communitys c ,__PREFIX__areas a1 ,__PREFIX__areas a2,__PREFIX__areas a3
	 	        where a1.areaId=c.areaId1 and a2.areaId=c.areaId2 and a3.areaId=c.areaId3 and communityFlag=1";
	 	if($areaId1>0)$sql.=" and c.areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and c.areaId2=".$areaId2;
	 	if($areaId3>0)$sql.=" and c.areaId3=".$areaId3;
	 	$sql.=" order by communityId desc";
		return $m->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $m = M('communitys');
	     $sql = "select * from __PREFIX__communitys order by communityId desc";
		 return $m->select($sql);
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	$m = M('communitys');
	 	$data = array();
		$data["communityFlag"] = -1;
	 	$rs = $m->where("communityId=".(int)I('id'))->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
	 /**
	  * 显示分类是否显示/隐藏
	  */
	 public function editiIsShow(){
	 	$rd = array('status'=>-1);
	 	if(I('id',0)==0)return $rd;
	 	$m = M('communitys');
	 	$m->isShow = ((int)I('isShow')==1)?1:0;
	 	$rs = $m->where("communityId=".(int)I('id',0))->save();
	    if(false !== $rs){
			$rd['status']= 1;
		}
	 	return $rd;
	 }
};
?>