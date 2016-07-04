<?php
 namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 社区服务类
 */
class CommunitysModel extends BaseModel {
     /**
	  * 根据县区获取社区列表
	  */
	  public function getByDistrict($areaId3 = 0){
	  	 $w = " communityFlag=1 AND isShow = 1 AND areaId3=$areaId3 ";
		 $rs=  $this->cache('WST_CACHE_CITY_004_'.$areaId3,31536000)->where($w)->field('communityId,communityName')->order('communitySort asc')->select();
		 return $rs;
	  }
	  
};
?>