<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 社区服务类
 */
use Think\Model;
class CommunitysModel extends BaseModel {
     /**
	  * 获取列表
	  */
	  public function queryByList($obj){
		 $m = M('communitys');
		 $areaId2 = $obj["areaId2"];
		 $areaId3 = $obj["areaId3"];
		 $sql = "SELECT * FROM ".$this->tablePrefix."communitys WHERE areaId2=$areaId2 AND communityFlag=1 AND isShow = 1 ";
		 if($areaId3>0){
	  		$sql .= " AND areaId3=$areaId3 ";
	  	 }
		 $sql .= " ORDER BY areaId3, communitySort";
		 return $rs = $this->query($sql);
	  }
	  
	/**
	  * 根据城市获取社区列表
	  */
	public function getCommunityList($areaId2){
	    $m = M('communitys');
	    $sql = "SELECT * FROM ".$this->tablePrefix."communitys WHERE areaId2=$areaId2 AND communityFlag=1 AND isShow = 1 AND isService=1 ORDER BY areaId3, communitySort";
	    $rs = $this->query($sql);
		return $rs;
	}
	
    /**
	 * 获取列表
	 */
	public function queryByListByArea($areaId3){
	    $m = M('communitys');
		return $m->where('areaId3='.$areaId3)->select();
	}
};
?>