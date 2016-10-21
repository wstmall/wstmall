<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
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
		$data = array();
		$data["positionType"] = (int)I("positionType");
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
			$data["areaId3"] = I("areaId3");
			$data["communityId"] = I("communityId");
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
			$data["areaId3"] = I("areaId3");
			$data["communityId"] = I("communityId");
		    $rs = $this->where("adId=".$id)->save($data);
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
		return $this->where("adId=".(int)I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
     	$adPositionId = I('adPositionId');
     	$adDateRange = I('adDateRange');
     	$adName = WSTAddslashes(I('adName'));
	 	$sql = "select a.*,a1.areaName areaName1,a2.areaName areaName2,a3.areaName areaName3,c.communityName 
	 	        from __PREFIX__ads a left join __PREFIX__areas a1 on a.areaId1=a1.areaId 
	 	        left join __PREFIX__areas a2 on a.areaId2 = a2.areaId 
	 	        left join __PREFIX__areas a3 on a.areaId3 = a3.areaId 
	 	        left join __PREFIX__communitys c on a.communityId = c.communityId where 1=1 ";
	 	if($adPositionId!="")$sql.="  and adPositionId=".(int)$adPositionId;
	 	$sql.=' order by adId desc';
		$rs = $this->pageQuery($sql);
		if(count($rs[root])>0){
			//获取广告位置
			$sql = "select positionId,positionName from __PREFIX__ad_positions where positionFlag=1";
			$p = $this->query($sql);
			$ps = array();
			foreach ($p as $key =>$v){
				$ps["-".$v['positionId']] = $v['positionName'];
			}
			foreach ($rs['root'] as $key =>$v){
				$rs['root'][$key]['positionName'] = $ps[$v['adPositionId']];
			}
		}
		return $rs;
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $sql = "select * from __PREFIX__ads order by adId desc";
		 return $this->find($sql);
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