<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 区域服务类
 */
class AreasModel extends BaseModel {
	/**
	  * 获取店铺的服务县区 
	  */ 
	public function getDistrictsByShop($obj){
		$shopId = $obj["shopId"];
	 	$sql = "SELECT ar.areaId , ar.areaName, sa.shopId 
			 	FROM __PREFIX__areas ar , __PREFIX__shops_communitys sa 
			 	WHERE  ar.areaId = sa.areaId3 AND sa.shopId = $shopId AND sa.communityId>0 GROUP BY areaId";
	 	return $this->query($sql);
	 }
	
	/**
	  * 获取店铺的社区
	  */
 	public function getShopCommunitys($obj){
 		$shopId = $obj["shopId"];
 		$areaId2 = $obj["areaId2"];
	 	$sql = "SELECT c.communityId id, c.communityName name
	 			FROM __PREFIX__communitys c , __PREFIX__shops_communitys sa 
	 			WHERE  c.communityId = sa.communityId AND sa.shopId = $shopId AND sa.communityId>0 Order by communitySort";
	 	$communitys = array();
	 	$communitys[$areaId2] = $this->query($sql);
	 	return $communitys;
	}
	 
	 /**
	  * 获取列表[带社区]
	  */
	 public function queryAreaAndCommunitysByList($parentId){

		 $rs = $this->where('areaFlag=1 and parentId='.$parentId)->field('areaId,areaName')->select();
		 if(count($rs)>0){
		 	$m = M('communitys');
		 	foreach ($rs as $key =>$v){
		 		$r = $m->where('communityFlag=1 and areaId3='.$v['areaId'])->field('communityId,communityName')->select();
		 		if(!empty($r))$rs[$key]['communitys'] = $r;
		 	}
		 }
		 return $rs;
	 }
	 /**
	  * 根据父ID获取子数据
	  */
	 public function queryByList($parentId){
		return $this->where('areaFlag=1 and isShow=1 and parentId='.$parentId)->field('areaId,areaName')->select();
	 }
     /**
	 * 获取区域信息
	 */
	 public function getArea($areaId){
		 return $this->where('areaFlag=1 and isShow=1 and areaId='.$areaId)->find();
	 }
	  
	/**
	  * 获取城市下的区
	  */
	  public function getDistricts($parentId){
		 return $this->cache('WST_CACHE_CITY_003_'.$parentId,31536000)->where('areaFlag=1 and isShow=1 and parentId='.$parentId)->field('areaId,areaName')->order('parentId, areaSort')->select();
	  }
	    
	  /**
	   * 获取省份列表
	   */
	  public function getProvinceList(){
	  	$rs = array();
	  	$rslist = $this->cache('WST_CACHE_CITY_001',31536000)->where('isShow=1 AND areaFlag = 1 AND areaType=0')->field('areaId,areaName')->order('parentId, areaSort')->select();
	  	foreach ($rslist as $key =>$row){
	  		$rs[$row["areaId"]] = $row;
	  	}
	  	return $rs;
	  }
	  /**
	   * 获取列表[获取启用的区域信息]
	   */
	  public function queryShowByList($parentId){
	  	return $this->where('areaFlag=1 and isShow = 1 and parentId='.(int)$parentId)->select();
	  }
	  /**
	   * 获取所有城市-根据字母分类
	   */
	  public function getCityGroupByKey(){
	  	$rs = array();
	  	$rslist = $this->cache('WST_CACHE_CITY_000',31536000)->where('isShow=1 AND areaFlag = 1 AND areaType=1')->field('areaId,areaName,areaKey')->order('areaKey, areaSort')->select();
	  	foreach ($rslist as $key =>$row){
	  		$rs[$row["areaKey"]][] = $row;
	  	}
	  	return $rs;
	  }
	  /**
	   * 获取所在省份的ID
	   */
	  public function getCurrentProvinceId($areaId2){
	  	$m = M('WeChat/Areas');
	  	$sql = 'SELECT parentId FROM __PREFIX__areas WHERE areaId='.$areaId2;
	  	$rs = $m->query($sql);
	  	$provinceId = $rs[0]['parentId'];
	  	return $provinceId;
	  }
	  /**
	   * 通过省份获取城市列表
	   */
	  public function getCityListByProvince($provinceId = 0){
	  	$rs = array();
	  	$rslist = $this->cache('WST_CACHE_CITY_002_'.$provinceId,31536000)->where('isShow=1 AND areaFlag = 1 AND areaType=1 AND parentId='.$provinceId)->field('areaId,areaName')->order('parentId, areaSort')->select();
	  	foreach ($rslist as $key =>$row){
	  		$rs[] = $row;
	  	}
	  	return $rs;
	  }
	  
	  /**
	   * 定位所在城市
	   */
	  public function getDefaultCity(){
	  	$areaId2 = (int)I('city',0);
	  	if($areaId2==0){
	  		$areaId2 = (int)session('areaId2');
	  	}
	  	//检验城市有效性
	  	if($areaId2>0){
	  		$sql ="SELECT areaId FROM __PREFIX__areas WHERE isShow=1 AND areaFlag = 1 AND areaType=1 AND areaId=".$areaId2;
	  		$rs = $this->query($sql);
	  		if($rs[0]['areaId']=='')$areaId2 = 0;
	  	}else{
	  		$areaId2 = (int)$_COOKIE['areaId2'];
	  	}
	  	//定位城市
	  	if($areaId2==0){
	  		//IP定位
	  		$iparea = WSTIPAddress();
	  		if(!empty($iparea)){
	  			$where = array();
	  			$where['areaName'] = array('like', '%'.$iparea['city'].'%');
	  			$where['isShow'] = 1;
	  			$where['areaFlag'] = 1;
	  			$where['areaType'] = 1;
	  			$rs = $this->where($where)->getField('areaId');
	  			if(intval($rs)>0){
	  				$areaId2 = intval($rs);
	  			}else{
	  				$areaId2 = $GLOBALS['CONFIG']['defaultCity'];
	  			}
	  		}else{
	  			$areaId2 = $GLOBALS['CONFIG']['defaultCity'];
	  		}
	  	}
	  	session('areaId2',$areaId2);
	  	setcookie("areaId2", $areaId2, time()+3600*24*90);
	  	return $areaId2;
	  
	  }
	  
	  public function getAreasByParentId($parentId){
	  	$sql = "SELECT * FROM __PREFIX__areas WHERE parentId=$parentId  AND areaFlag = 1 AND isShow =1";
	  	$rs = $this->query($sql);
	  	return $rs;
	  
	  }
	  
	  public function getAreasByExp($parentId){
	  	
	  	$sql = "select areaId from wst_areas where areaType = 0";
	  	$rs1 = $this->query($sql);
	  	$m = M('communitys');
	  	$t = count($rs1);
	  	for($j=0;$j<$t;$j++){
	  		$areaId1 = $rs1[$j]['areaId'];
	  		$sql = "SELECT a3.*,a2.parentId areaId2,a1.parentId areaId1 FROM wst_areas a3,wst_areas a2,wst_areas a1 WHERE a3.areaType = 3 and a3.parentId = a2.areaId and a2.parentId = a1.areaId and a1.parentId=".$areaId1;
	  		$rs = $this->query($sql);
	  		
	  		$k=count($rs);
	  		$dataAll = array();
	  		for($i=0;$i<$k;$i++){
	  			$area = $rs[$i];
	  			$data = array();
	  			$data["areaId1"] = $area["areaId1"];
	  			$data["areaId2"] = $area["areaId2"];
	  			$data["areaId3"] = $area["parentId"];
	  			$data["isShow"] =1;
	  			$data["isService"] = 1;
	  			$data["communityName"] = $area["areaName"];
	  			$data["communitySort"] = $area["areaKey"];
	  			$data["communityKey"] = "";
	  			$data["communityFlag"] = 1;
	  			$data["latitude"] = 0;
	  			$data["longitude"] = 0;
	  			$data["mapLevel"] = 10;
	  			$dataAll[] = $data;
	  		}
	  		$m->addAll($dataAll);
	  	}
	  	
	  	
	  	return 1;
	  	 
	  }
	   
}