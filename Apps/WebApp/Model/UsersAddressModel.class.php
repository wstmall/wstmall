<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
class UsersAddressModel extends BaseModel {
	
	/**
	 * 获取用户的个人地址
	 */
	public function getUserAddress(){
		$userId = (int)session('WST_USER.userId');
		$sql ='select addressId,userName,userPhone,userTel,a1.areaName areaName1,a2.areaName areaName2,a3.areaName areaName3,
		      a.address,a.isDefault,c.communityName,a.areaId1,a.areaId2,a.areaId3,a.communityId
		      from __PREFIX__user_address a,__PREFIX__areas a1, __PREFIX__areas a2,__PREFIX__areas a3,__PREFIX__communitys c
		      where a.areaId1=a1.areaId and a.areaId2=a2.areaId and a.areaId3=a3.areaId 
		      and a.communityId=c.communityId and a.addressFlag=1 and a1.areaFlag=1 and a2.areaFlag=1 and a3.areaFlag=1 
		      and a1.isShow=1 and a2.isShow=1 and a3.isShow=1 and userId='.$userId." order by a.isDefault desc,a.addressId asc ";
		$rs = $this->query($sql);
		if(count($rs)>0){
			foreach ($rs as $key =>$v){
				$rs[$key]['areaName'] = $v['areaName1'].$v['areaName2'].$v['areaName3'].$v['communityName'];
				unset($rs[$key]['areaName1'],$rs[$key]['areaName2'],$rs[$key]['areaName3'],$rs[$key]['communityName']);
			}
		}
		return $rs;
	}

	/**
	 * 通过id获取收货地址
	 */
	public function getAddressById(){
		$addressId = (int)I('addressId', 0);
		$sql ='select addressId,userName,userPhone,userTel,a1.areaName areaName1,a2.areaName areaName2,a3.areaName areaName3,
		      a.address,a.isDefault,c.communityName,a.areaId1,a.areaId2,a.areaId3,a.communityId
		      from __PREFIX__user_address a,__PREFIX__areas a1, __PREFIX__areas a2,__PREFIX__areas a3,__PREFIX__communitys c
		      where a.areaId1=a1.areaId and a.areaId2=a2.areaId and a.areaId3=a3.areaId 
		      and a.communityId=c.communityId and a.addressFlag=1 and a1.areaFlag=1 and a2.areaFlag=1 and a3.areaFlag=1 
		      and a1.isShow=1 and a2.isShow=1 and a3.isShow=1 and addressId='.$addressId;
		$rs = $this->query($sql);
		return $rs[0];
	}

	/**
	 * 新增地址
	 */
	public function addAddress(){
		$userId = (int)session('WST_USER.userId');
		$rd = array('status'=>-1);
		$rules = array(
		     array('userName','require','收货人姓名不能为空！',1),
		     array('areaId2','require','请选择所在城市！',1),
		     array('areaId3','require','请选择所在区域！',1),
		     array('communityId','require','请选择所在社区！',1),
		     array('address','require','请输入详细地址！',1)
		);

		$u = M('user_address');
		$data = $u->validate($rules)->create();
		if($data){
			$data['userId'] = $userId;
			if((int)I("areaId1")){
				$data['areaId1'] = (int)I("areaId1");
			}else{
				$sql ="SELECT parentId FROM __PREFIX__areas WHERE areaId='".$u->areaId2."' AND areaFlag=1";
			 	$ars = $this->queryRow($sql);
			    $data['areaId1'] = $ars["parentId"];
			}
		    if(I("userPhone")!=''){
				$data['userPhone'] = I("userPhone");
			}else{
			    $data['userTel'] = I("userTel");
			}
			if($data['userPhone']=='' && $data['userTel']==''){
				$rd['msg'] = "收货人手机号码和固定电话至少填1个!";
				return $rd;
			}
			$data['isDefault'] = (int)I("isDefault",0);
			$data['addressFlag'] = 1;
			$data['createTime'] = date('Y-m-d H:i:s');
			$rs = $u->add($data);
			if(false !== $rs){
				$rd['status']= $rs;
				if((int)I("isDefault")==1){
					//修改所有的地址为非默认
					$data = array();
					$data['isDefault'] = 0;
					$u->where('userId='.$userId." and addressId!=".$rs)->save($data);
				}
			}else{
				$rd['msg'] = $u->getDbError();
			    return $rd;
			}
		}else{
			$rd['msg'] = $u->getError();
			return $rd;
		}
		return $rd;
	}
	/**
	 * 修改地址
	 */
	public function editAddress(){
		$userId = (int)session('WST_USER.userId');
		$rd = array('status'=>-1);
		$id = (int)I('addressId');
		$rules = array(
		     array('userName','require','收货人姓名不能为空！',1),
		     array('areaId2','require','请选择所在城市！',1,'',1),
		     array('areaId3','require','请选择所在区域！',1,'',1),
		     array('communityId','require','请选择所在社区！',1),
		     array('address','require','请输入详细地址！',1)
		);

		$u = M('user_address');
		$u->userId = $userId;
		if((int)I("areaId1")){
			$u->areaId1 = (int)I("areaId1");
		}else{
			$sql ="SELECT parentId FROM __PREFIX__areas WHERE areaId='".$u->areaId2."' AND areaFlag=1";
		 	$ars = $this->queryRow($sql);
		    $u->areaId1 = $ars["parentId"];
		}
	    if(I("userPhone")!=''){
			$u->userPhone = I("userPhone");
		}else{
		    $u->userTel = I("userTel");
		}
		if($u->userPhone=='' && $u->userTel==''){
			$rd['msg'] = "收货人手机号码和固定电话至少填1个!";
			return $rd;
		}
		$u->isDefault = (int)I("isDefault",0);
		$u->addressFlag = 1;
		$u->createTime = date('Y-m-d H:i:s');
		if($u->validate($rules)->create()){
			$rs = $u->where("userId=".$userId." and addressId=".$id)->save();
			if(false !== $rs){
				$rd['status']= $rs;
				if((int)I("isDefault")==1){
					//修改所有的地址为非默认
					$data = array();
					$data['isDefault'] = 0;
					$u->where('userId='.$userId." and addressId!=".$id)->save($data);
				}
			}else{
				$rd['msg'] = $u->getDbError();
			    return $rd;
			}
		}else{
			$rd['msg'] = $u->getError();
			return $rd;
		}
		return $rd;
	}

	/**
	 * 删除用户地址
	 */
	public function delAddress(){
		$userId = (int)session('WST_USER.userId');
		$rd = array('status'=>-1);
		$m = M('user_address');
		$rs = $m->where("userId=".$userId." and addressId=".(int)I('addressId'))->delete();
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	}

	/**
	 * 结算-获取指定地区的收货人地址
	 */
	public function getUserAddressForOrder(){
		$userId = (int)session('WST_USER.userId');
    	$areaId2 = (int)session('areaId2');
		$isDefault = (int)I("isDefault");
		$sql ='select addressId,userName,userPhone,userTel,a1.areaName areaName1,a2.areaName areaName2,a3.areaName areaName3,
		      a.address,a.isDefault,c.communityName,a.areaId1,a.areaId2,a.areaId3,a.communityId
		      from __PREFIX__user_address a,__PREFIX__areas a1, __PREFIX__areas a2,__PREFIX__areas a3,__PREFIX__communitys c
		      where a.areaId1=a1.areaId and a.areaId2=a2.areaId and a.areaId3=a3.areaId 
		      and a.communityId=c.communityId and a.addressFlag=1 and a1.areaFlag=1 and a2.areaFlag=1 and a3.areaFlag=1 
		      and a1.isShow=1 and a2.isShow=1 and a3.isShow=1 and a.userId='.$userId.' and a2.areaId='.$areaId2.' order by a.isDefault desc,a.addressId asc ';
		if($isDefault==1) $sql.=" limit 1";
		$rs = $this->query($sql);
		if(!empty($rs)){
			if($isDefault==1) {//只获取默认收货地址
				$rs[0]['areaName'] = $rs[0]['areaName1'].$rs[0]['areaName2'].$rs[0]['areaName3'].$rs[0]['communityName'];
				unset($rs[0]['areaName1'],$rs[0]['areaName2'],$rs[0]['areaName3'],$rs[0]['communityName']);
			}else{//获取收货地址列表
				foreach ($rs as $k => $v) {
					$rs[$k]['areaName'] = $rs[$k]['areaName1'].$rs[$k]['areaName2'].$rs[$k]['areaName3'].$rs[$k]['communityName'];
					unset($rs[$k]['areaName1'],$rs[$k]['areaName2'],$rs[$k]['areaName3'],$rs[$k]['communityName']);
				}
			}
		}
		if($isDefault==1) {
			return $rs[0];
		}else{
			return $rs;
		}
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
	
}