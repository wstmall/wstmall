<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 会员地址服务类
 */
class UserAddressModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["userId"] = (int)session('WST_USER.userId');
		$data["userName"] = I("userName");
		$data["areaId2"] = (int)I("areaId2");
		if(I("areaId1")){
			$data["areaId1"] = (int)I("areaId1");
		}else{
			$sql ="SELECT parentId FROM __PREFIX__areas WHERE areaId='".$data["areaId2"]."' AND areaFlag=1";
			$ars = $this->queryRow($sql);
			$data["areaId1"] = $ars["parentId"];
		}
		
		$data["areaId3"] = (int)I("areaId3");
		$data["communityId"] = (int)I("communityId");
		if(I("userPhone")!=''){
			$data["userPhone"] = I("userPhone");
		}else{
		    $data["userTel"] = I("userTel");
		}
		
		$data["address"] = I("address");
		$data["isDefault"] = (int)I("isDefault",0);
		$data["addressFlag"] = 1;
		$data["createTime"] = date('Y-m-d H:i:s');
	    if($this->checkEmpty($data,true)){	
	    	$data["userPhone"] = I("userPhone");
	    	$data["userTel"] = I("userTel");
			$m = M('user_address');
			$rs = $m->add($data);
			if(false !== $rs){
				$rd['status']= $rs;
				if((int)I("isDefault")==1){
					//修改所有的地址为非默认
					$m->isDefault = 0;
					$m->where('userId='.(int)session('WST_USER.userId')." and addressId!=".$rs)->save();
				}
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
		$data = array();
		$data["userName"] = I("userName");
		//$data["userPhone"] = I("userPhone");
	    if(I("userPhone")!=''){
			$data["userPhone"] = I("userPhone");
		}else{
		    $data["userTel"] = I("userTel");
		}
		$data["areaId2"] = (int)I("areaId2");
		$data["areaId3"] = (int)I("areaId3");
		$data["communityId"] = (int)I("communityId");
		$data["address"] = I("address");
		
		if($this->checkEmpty($data,true)){	
			$m = M('user_address');
			$data["userPhone"] = I("userPhone");
			$data["userTel"] = I("userTel");
			$data["isDefault"] = (int)I("isDefault");
			$rs = $m->where("userId=".(int)session('WST_USER.userId')." and addressId=".$id)->save($data);
			if(false !== $rs){
				$rd['status']= 1;
				if((int)I("isDefault")==1){
					//修改所有的地址为非默认
					$m->isDefault = 0;
					$m->where('userId='.(int)session('WST_USER.userId')." and addressId!=".$id)->save();
				}
			}
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get(){
	 	$m = M('user_address');
		return $m->where("addressId=".(int)I('id')." and userId=".(int)session('WST_USER.userId'))->find();
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList($userId){
	     $sql = "select ua.*,a1.areaName areaName1,a2.areaName areaName2,a3.areaName areaName3,c.communityName
	              from __PREFIX__user_address ua 
	              left join __PREFIX__areas a1 on a1.areaId=ua.areaId1 and a1.isShow=1 and a1.areaFlag=1
	              left join __PREFIX__areas a2 on a2.areaId=ua.areaId2 and a2.isShow=1 and a2.areaFlag=1
	              left join __PREFIX__areas a3 on a3.areaId=ua.areaId3 and a3.isShow=1 and a3.areaFlag=1
	              left join __PREFIX__communitys c on c.communityId=ua.communityId and c.isShow=1
	              where ua.userId=".(int)$userId;
		 return $this->query($sql);
	  }
	  
     /**
	  * 根据用户以及所在城市获取列表
	  */
	  public function queryByUserAndCity($userId,$cityId){
	     $sql = "select ua.*,a1.areaName areaName1,a2.areaName areaName2,a3.areaName areaName3,c.communityName
	              from __PREFIX__user_address ua 
	              left join __PREFIX__areas a1 on a1.areaId=ua.areaId1 and a1.isShow=1 and a1.areaFlag=1
	              left join __PREFIX__areas a2 on a2.areaId=ua.areaId2 and a2.isShow=1 and a2.areaFlag=1
	              left join __PREFIX__areas a3 on a3.areaId=ua.areaId3 and a3.isShow=1 and a3.areaFlag=1
	              left join __PREFIX__communitys c on c.communityId=ua.communityId and c.isShow=1
	              where ua.userId=".(int)$userId." and a2.areaId=".$cityId." order by isDefault desc";
		 return $this->query($sql);
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	    $m = M('user_address');
	    $rs = $m->where("userId=".(int)session('WST_USER.userId')." and addressId=".(int)I('id'))->delete();
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
	/**
	 * 购物过程中获取用户地址
	 */
	public function getUserAddressInfo(){
		$addressId = (int)I("addressId");
		$sql ="SELECT ad.*, a.areaName FROM __PREFIX__user_address ad
			  left join __PREFIX__areas a ON ad.areaId2 = a.areaId
		      WHERE ad.addressId=$addressId AND ad.addressFlag=1 and ad.userId=".(int)session('WST_USER.userId');
	
		$rs = $this->queryRow($sql);
		if(empty($rs))return array();
		
		$area3List = self::getDistricts($rs["areaId2"]);
		$rs["area3List"] = $area3List;
		
		$collegesList = self::getCommunitys($rs["areaId3"]);
		$rs["communitysList"] = $collegesList;
		return $rs;
	}
	

	public function getAllCitys(){
		$sql = "SELECT * FROM __PREFIX__areas WHERE areaType = 1 AND areaFlag = 1 AND isShow =1";		
		$rs = $this->query($sql);		
		return $rs;
	}	
	
	
	public function getDistricts($cityId){
		$sql = "SELECT * FROM __PREFIX__areas WHERE parentId=$cityId  AND areaFlag = 1 AND areaType = 2 AND isShow =1";		
		$rs = $this->query($sql);		
		return $rs;
		
	}	
	
	public function getCommunitys($districtId){	
		$sql = "SELECT * FROM __PREFIX__communitys WHERE areaId3=$districtId  AND isShow =1 ORDER BY communitySort";		
		$rs = $this->query($sql);		
		return $rs;
	}	
	
	/**
	 * 获取店铺服务社区
	 * 
	 * @param unknown_type $countryId
	 * @param unknown_type $shopId
	 */
	public function getServiceCommunitys($communityId,$shopId){
		$sql = "SELECT c.collegeId,c.collegeName from __PREFIX__communitys c, __PREFIX__shops_communitys sc 
				WHERE c.communityId=sc.communityId AND sc.communityId>0 AND sc.areaId3 = '$communityId' AND sc.shopId = $shopId AND communityFlag = 1 
				GROUP BY sc.communityId ORDER BY communitySort";
		$rs = $this->query($sql);	
		return $rs;
		
	}
	
	/**
	 * 获取店铺配送区
	 * 
	 * @param unknown_type $shopId
	 */
	public function getShopCommunitysId($shopId){
	 	$sql = "SELECT communityId FROM __PREFIX__shops_communitys WHERE shopId = $shopId ";
		$communitys = $this->query($sql);
		$communitysId = array();
		for($i=0;$i<count($communitys);$i++){
			$communitysId[] = $communitys[$i]["communityId"];
		}
		return implode(",",$communitysId) ;
	}
	
	
	public function getDistrictsOption($cityId){
		$sql = "SELECT areaId as id,areaName as name FROM __PREFIX__areas WHERE parentId=$cityId  AND areaFlag = 1 AND areaType = 2 AND isShow =1 ORDER BY areaSort";		
		$rs = $this->query($sql);		
		return $rs;
		
	}	
	
	public function getCommunitysOption($districtId){	
		$sql = "SELECT communityId as id,communityName as name FROM __PREFIX__communitys WHERE areaId3=$districtId AND isShow =1 ORDER BY communitySort";		
		$rs = $this->query($sql);
		return $rs;
		
	}
	
	
	public function getShopDistricts($cityId,$shopId){
		$sql = "SELECT a.areaId as id,a.areaName as name FROM __PREFIX__areas a
				WHERE a.parentId=$cityId AND a.areaId in (select sc.areaId3 from __PREFIX__shops_communitys sc where sc.shopId=$shopId AND sc.areaId2 = $cityId )  AND a.areaFlag = 1 AND a.areaType = 2 AND a.isShow =1 GROUP BY a.areaId ORDER BY a.areaSort";
		$rs = $this->query($sql);
		
		return $rs;
	
	}
	
	public function getShopCommunitys($districtId,$shopId){
		$sql = "SELECT c.communityId as id,c.communityName as name FROM __PREFIX__communitys c
				WHERE c.areaId3=$districtId AND c.communityId in (select sc.communityId from __PREFIX__shops_communitys sc where sc.shopId=$shopId AND sc.areaId3 = $districtId ) AND c.isShow =1 GROUP BY c.communityId ORDER BY communitySort";
		$rs = $this->query($sql);
		
		return $rs;
	}
	
	/**
	 * 获取地址详情
	 */
	public function getAddressDetails($addressId){
		$addressId = $addressId?$addressId:(int)I("addressId");
		$sql ="SELECT * FROM __PREFIX__user_address WHERE addressId=$addressId AND addressFlag=1 and userId=".(int)session('WST_USER.userId');
		$address = $this->queryRow($sql);
		if(empty($address))return array();
		
		$areaId2 = $address["areaId2"];
		$areaId3 = $address["areaId3"];
		$communityId = $address["communityId"];
		
		$sql = "SELECT areaId ,areaName FROM __PREFIX__areas WHERE areaId=$areaId2  AND areaFlag = 1 AND isShow =1";		
		$rs = $this->queryRow($sql);
		$cityName = $rs["areaName"];//市
		
		$sql = "SELECT areaId ,areaName FROM __PREFIX__areas WHERE areaId=$areaId3  AND areaFlag = 1 AND isShow =1";
		$rs = $this->queryRow($sql);
		$districtsName = $rs["areaName"];//区
		
		$sql = "SELECT communityId ,communityName FROM __PREFIX__communitys WHERE communityId=$communityId  AND isShow =1";		
		$rs = $this->queryRow($sql);
		$communityName = $rs["communityName"];//社区
		
		$address["paddress"] = $cityName ." ". $districtsName ." ". $communityName;
		return $address ;
	}
	
};
?>