<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 区域服务类
 */
class AreasModel extends BaseModel {
	/**
	  * 获取门店的服务县区 
	  */ 
	public function getDistrictsByShop($obj){
		$shopId = $obj["shopId"];
	 	$sql = "SELECT ar.areaId , ar.areaName, sa.shopId 
			 	FROM __PREFIX__areas ar , __PREFIX__shops_communitys sa 
			 	WHERE  ar.areaId = sa.areaId3 AND sa.shopId = $shopId AND sa.communityId>0 GROUP BY areaId";
	 	return $this->query($sql);
	 }
	
	/**
	  * 获取门店的社区
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
	     $m = M('areas');
		 $rs = $m->where('areaFlag=1 and parentId='.$parentId)->field('areaId,areaName')->select();
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
	  * 获取城市下的区
	  */
	  public function getDistricts($parentId){
		 return $this->cache('WST_CACHE_CITY_003_'.$parentId,31536000)->where('areaFlag=1 and isShow=1 and parentId='.$parentId)->field('areaId,areaName')->order('parentId, areaSort')->select();
	  }
	    
	  /**
	   * 获取省份列表
	   */
	  public function getProvinceList(){
	  	$rslist = $this->cache('WST_CACHE_CITY_001',31536000)->where('isShow=1 AND areaFlag = 1 AND areaType=0')->field('areaId,areaName')->order('parentId, areaSort')->select();
	  	foreach ($rslist as $key =>$row){
	  		$rs[$row["areaId"]] = $row;
	  	}
	  	return $rs;
	  }
	  
	  /**
	   * 获取所有城市-根据字母分类
	   */
	  public function getCityGroupByKey(){
	  	$rslist = $this->cache('WST_CACHE_CITY_000',31536000)->where('isShow=1 AND areaFlag = 1 AND areaType=1')->field('areaId,areaName,areaKey')->order('areaKey, areaSort')->select();
	  	foreach ($rslist as $key =>$row){
	  		$rs[$row["areaKey"]][] = $row;
	  	}
	  	return $rs;
	  }
	  
	  /**
	   * 通过省份获取城市列表
	   */
	  public function getCityListByProvince($provinceId = 0){
	  	$rslist = $this->cache('WST_CACHE_CITY_002_'.$provinceId,31536000)->where('isShow=1 AND areaFlag = 1 AND areaType=1 AND parentId='.$provinceId)->field('areaId,areaName')->order('parentId, areaSort')->select();
	  	foreach ($rslist as $key =>$row){
	  		$rs[] = $row;
	  	}
	  	return $rs;
	  }
	  
	  /**
	   * 获取默认城市
	   */
	  public function getDefaultCity(){
	  	//先判断是否有默认城市
	  	$areaId2 = (int)session('areaId2');
	  	$m = D('WebApp/Areas');
	  	//检验城市有效性
	  	if($areaId2>0){
	  		$sql ="SELECT areaId FROM __PREFIX__areas WHERE isShow=1 AND areaFlag = 1 AND areaType=1 AND areaId=".$areaId2;
	  		$rs = $m->query($sql);
	  		if($rs[0]['areaId']=='')$areaId2 = 0;
	  	}else{
	  		$areaId2 = (int)cookie('areaId2');
	  	}
	  	//获取默认城市
	  	if($areaId2==0){
	  		//IP定位
	  		$iparea = WSTIPAddress();
	  		if(!empty($iparea)){
	  			$where = array();
	  			$where['areaName'] = array('like', '%'.$iparea['city'].'%');
	  			$where['isShow'] = 1;
	  			$where['areaFlag'] = 1;
	  			$where['areaType'] = 1;
	  			$rs = $m->where($where)->getField('areaId');
	  			if(intval($rs)>0){
	  				$areaId2 = intval($rs);
	  			}else{
	  				$areaId2 = (int)$GLOBALS['CONFIG']['defaultCity'];
	  			}
	  		}else{
	  			$areaId2 = (int)$GLOBALS['CONFIG']['defaultCity'];
	  		}
	  	}
	  	//获取城市
	  	$m = D('WebApp/Areas');
	  	$sql = "SELECT areaId areaId2,areaName areaName2 FROM __PREFIX__areas WHERE isShow=1 AND areaFlag = 1 AND areaType=1 AND areaId=".(int)$areaId2;
	  	$rs = $this->queryRow($sql);
	  	return $rs;
	  }

	  /**
	   * 获取所在省份的ID
	   */
	  public function getCurrentProvinceId(){
  		$m = M('WebApp/Areas');
  		$sql = 'SELECT parentId FROM __PREFIX__areas WHERE areaId='.(int)session('areaId2');
  		$rs = $m->query($sql);
  		$provinceId = $rs[0]['parentId'];
	  	return $provinceId;
	  }
}