<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 区域服务类
 */
use Think\Model;
class AreasModel extends BaseModel {
	/**
	 * 查询所有城市
	 */
	public function getCitys(){
		$sql ="SELECT * FROM ".$this->tablePrefix."areas WHERE isShow=1 AND areaFlag = 1 AND areaType=1 ORDER BY parentId, areaSort";
		$rslist = $this->query($sql);
		foreach ($rslist as $key =>$row){
			$rs[$row["areaId"]] = $row;
		}
		return $rs;
	}
	
	/**
	 * 商品列表
	 */
	public function getAreasList($obj){
		$areaId2 = $obj["areaId2"];
		$keyWords = I("keyWords");
		$sql = "SELECT goodsId,goodsSn,goodsName,goodsThums,g.shopId,marketPrice,shopPrice,p.shopName 
				FROM ".$this->tablePrefix."goods g, ".$this->tablePrefix."shops p
				WHERE g.shopId = p.shopId AND p.areaId2 = $areaId2 AND g.goodsStatus=2 AND g.goodsFlag = 1";
		if($keyWords==""){
			$sql .= " AND goodsName LIKE '%$keyWords%'";
		}
		return $this->pageQuery($sql);
	}
	
	/**
	  * 获取门店的服务城市 
	  */ 
	public function getShopCity($obj){
		$shopId = $obj["shopId"];
	 	$sql = "SELECT ar.areaId , ar.areaName, sa.shopId 
			 	FROM ".$this->tablePrefix."areas ar , ".$this->tablePrefix."shops_communitys sa 
			 	WHERE  ar.areaId = sa.areaId2 AND sa.shopId = $shopId AND sa.communityId>0 GROUP BY areaId";
	 	return $this->query($sql);
	 }
	
	/**
	  * 获取门店的社区
	  */
 	public function getShopCommunitys($obj){
 		$shopId = $obj["shopId"];
 		$areaId2 = $obj["areaId2"];
	 	$sql = "SELECT c.communityId id, c.communityName name
	 			FROM ".$this->tablePrefix."communitys c , ".$this->tablePrefix."shops_communitys sa 
	 			WHERE  c.communityId = sa.communityId AND sa.shopId = $shopId AND sa.communityId>0 Order by communitySort";
	 	$communitys = array();
	 	$communitys[$areaId2] = $this->query($sql);
	 	return $communitys;
	 }
	 
	 /**
	  * 获取列表[带社区]
	  */
	  public function queryAreaAndCommunitysByList($parentId){
	     $m = M('areas');
		 $rs = $m->where('areaFlag=1 and parentId='.$parentId)->select();
		 if(count($rs)>0){
		 	$m = M('communitys');
		 	foreach ($rs as $key =>$v){
		 		$r = $m->where('communityFlag=1 and areaId3='.$v['areaId'])->select();
		 		if(!empty($r))$rs[$key]['communitys'] = $r;
		 	}
		 }
		 return $rs;
	  }
	  
	/**
	  * 获取城市下的区
	  */
	  public function getDistricts($parentId){
	     $m = M('areas');
		 $sql = "SELECT * from __PREFIX__areas WHERE areaFlag=1 and isShow=1 and parentId=".$parentId;
		 return $this->query($sql);
	  }
	  
	 /**
	  * 获取列表
	  */
	  public function queryByList($parentId){
	     $m = M('areas');
		 return $m->where('areaFlag=1 and isShow=1 and parentId='.$parentId)->select();
	  }
	  
	  /**
	   * 获取区域信息
	   */
	  public function getArea($areaId){
	  	  $m = M('areas');
		  return $m->where('areaFlag=1 and isShow=1 and areaId='.$areaId)->find();
	  }
	  
	  
	  /**
	   * 获取省份列表
	   */
	  public function getProvinceList(){
	  	$sql ="SELECT * FROM ".$this->tablePrefix."areas WHERE isShow=1 AND areaFlag = 1 AND areaType=0 ORDER BY parentId, areaSort";
	  	$rslist = $this->query($sql);
	  	foreach ($rslist as $key =>$row){
	  		$rs[$row["areaId"]] = $row;
	  	}
	  	return $rs;
	  }
	  
	  /**
	   * 获取所有城市
	   */
	  public function getCityList(){
	  
	  	$sql ="SELECT * FROM ".$this->tablePrefix."areas WHERE isShow=1 AND areaFlag = 1 AND areaType=1 ORDER BY areaKey, areaSort";
	  	$rslist = $this->query($sql);
	  	foreach ($rslist as $key =>$row){
	  		$rs[$row["areaKey"]][] = $row;
	  	}
	  	return $rs;
	  }
	  
	  /**
	   * 通过省份获取城市列表
	   */
	  public function getCityListByProvince(){
	  	$provinceId = I('provinceId',0);
	  	$sql ="SELECT * FROM ".$this->tablePrefix."areas WHERE isShow=1 AND areaFlag = 1 AND areaType=1 AND parentId=$provinceId ORDER BY parentId, areaSort";
	  	$rslist = $this->query($sql);
	  	foreach ($rslist as $key =>$row){
	  		$rs[] = $row;
	  	}
	  	return $rs;
	  }
}