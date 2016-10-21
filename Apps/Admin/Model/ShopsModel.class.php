<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 店铺服务类
 */
class ShopsModel extends BaseModel {
	
	/**
	 * 查询店铺关键字
	 */
	public function checkShopName($val,$id = 0){
		$rd = array('status'=>-1);
		$sql = " shopName ='%s' and shopFlag=1 ";
		$keyArr = array($val);
		if($id>0)$sql.=" and shopId!=".$id;
		$rs = $this->where($sql,$keyArr)->count();
		if($rs==0){
			$rd['status'] = 1;
		}
		return $rd;
	}
	
     /**
	  * 查询登录关键字
	  */
	 public function checkLoginKey($val,$id = 0){
	 	$sql = " (loginName ='%s' or userPhone ='%s' or userEmail='%s') and userFlag=1";
	 	$keyArr = array($val,$val,$val);
	 	if($id>0)$sql.=" and userId!=".(int)$id;
	 	$m = M('users');
	 	$rs = $m->where($sql,$keyArr)->count();
	    if($rs==0)return 1;
	    return 0;
	 }
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	//先建立账号
	 	$hasLoginName = self::checkLoginKey(I("loginName"));
	 	$hasUserPhone = self::checkLoginKey(I("userPhone"));
	 	if($hasLoginName==0 || $hasUserPhone==0){
	 		$rd = array('status'=>-2);
	 		return $rd;
	 	}
	 	//用户资料
	 	$data = array();
	 	$data["loginName"] = I("loginName");
		$data["loginSecret"] = rand(1000,9999);
		$data["loginPwd"] = md5(I('loginPwd').$data['loginSecret']);
		$data["userName"] = I("userName");
		$data["userPhone"] = I("userPhone");
		//店铺资料
		$sdata = array();
		$sdata["shopSn"] = I("shopSn");
		$sdata["areaId1"] = (int)I("areaId1");
		$sdata["areaId2"] = (int)I("areaId2");
		$sdata["areaId3"] = (int)I("areaId3");
		$sdata["goodsCatId1"] = (int)I("goodsCatId1");
		$sdata["shopName"] = I("shopName");
		$sdata["shopCompany"] = I("shopCompany");
		$sdata["shopImg"] = I("shopImg");
		$sdata["shopAddress"] = I("shopAddress");
		$sdata["bankId"] = (int)I("bankId");
		$sdata["bankNo"] = I("bankNo");
		$sdata["bankUserName"] = I("bankUserName");
		$sdata["serviceStartTime"] = I("serviceStartTime");
		$sdata["serviceEndTime"] = I("serviceEndTime");
		$sdata["shopTel"] = I("shopTel");
		if($this->checkEmpty($data,true) && $this->checkEmpty($sdata,true)){ 
			$data["userStatus"] = (int)I("userStatus",1);
			$data["userType"] = (int)I("userType",1);
			$data["userEmail"] = I("userEmail");
			$data["userQQ"] = I("userQQ");
			$data["userScore"] = I("userScore",0);
		    $data["userTotalScore"] = I("userTotalScore",0);
		    $data["userFlag"] = 1;
		    $data["createTime"] = date('Y-m-d H:i:s');
			$m = M('users');
			$userId = $m->add($data);
			if(false !== $userId){
				$sdata["userId"] = $userId;
				$sdata["isSelf"] = (int)I("isSelf",0);
				if($sdata["isSelf"]==1){
					$sdata["deliveryType"] = 1;
				}else{
					$sdata["deliveryType"] = 0;
				}
				$sdata["deliveryStartMoney"] = I("deliveryStartMoney",0);
		        $sdata["deliveryCostTime"] = I("deliveryCostTime",0);
				$sdata["deliveryFreeMoney"] = I("deliveryFreeMoney",0);
		        $sdata["deliveryMoney"] = I("deliveryMoney",0);
				$sdata["avgeCostMoney"] = I("avgeCostMoney",0);
				$sdata["longitude"] = (float)I("longitude");
				$sdata["latitude"] = (float)I("latitude");
				$sdata["mapLevel"] = (int)I("mapLevel",13);
				$sdata["isInvoice"] = (int)I("isInvoice",1);
				$sdata["shopStatus"] = (int)I("shopStatus",1);
				$sdata["shopAtive"] = (int)I("shopAtive",1);
				$sdata["isDistributAll"] = (int)I("isDistributAll",0);
				$sdata["shopFlag"] = 1;
				$sdata["createTime"] = date('Y-m-d H:i:s');
			    $sdata['statusRemarks'] = I('statusRemarks');
			    $sdata['qqNo'] = I('qqNo');
			    $sdata["invoiceRemarks"] = I("invoiceRemarks");
				$m = M('shops');
				$shopId = $m->add($sdata);
				if(false !== $shopId){
					$rd['status']= 1;
					//增加商家评分记录
				    $data = array();
				    $data['shopId'] = $shopId;
				    $m = M('shop_scores');
				    $m->add($data);
					//建立店铺和社区的关系
				    if($sdata["isDistributAll"]==0){
						$relateArea = self::formatIn(",", I('relateAreaId'));
						$relateCommunity = self::formatIn(",", I('relateCommunityId'));
						if($relateArea!=''){
							$m = M('shops_communitys');
							$relateAreas = explode(',',$relateArea);
							foreach ($relateAreas as $v){
								if($v=='' || $v=='0')continue;
								$tmp = array();
								$tmp['shopId'] = $shopId;
								$tmp['areaId1'] = (int)I("areaId1");
								$tmp['areaId2'] = (int)I("areaId2");
								$tmp['areaId3'] = $v;
								$tmp['communityId'] = 0;
								$ra = $m->add($tmp);
							}
						}
					    if($relateCommunity!=''){
					        $m = M('communitys');
					        $lc = $m->where('communityFlag=1 and (communityId in(0,'.$relateCommunity.") or areaId3 in(0,".$relateArea."))")->select();
					        if(count($lc)>0){
					        	$m = M('shops_communitys');
								foreach ($lc as $key => $v){
									$tmp = array();
									$tmp['shopId'] = $shopId;
									$tmp['areaId1'] = $v['areaId1'];
									$tmp['areaId2'] = $v['areaId2'];
									$tmp['areaId3'] = $v['areaId3'];
									$tmp['communityId'] = $v['communityId'];
									$ra = $m->add($tmp);
								}
							}
						}
				    }
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
	 	$shopId = (int)I('id',0);
	 	if($shopId==0)return rd;
	 	$m = M('shops');
	 	//获取店铺资料
	 	$shops = $m->where("shopId=".$shopId)->find();
	    //检测手机号码是否存在
	 	if(I("userPhone")!=''){
	 		$hasUserPhone = self::checkLoginKey(I("userPhone"),$shops['userId']);
	 		if($hasUserPhone==0){
	 			$rd = array('status'=>-2);
	 		    return $rd;
	 		}
	 	}
	    $data = array();
		$data["shopSn"] = I("shopSn");
		$data["areaId1"] = (int)I("areaId1");
		$data["areaId2"] = (int)I("areaId2");
		$data["areaId3"] = (int)I("areaId3");
		$data["goodsCatId1"] = (int)I("goodsCatId1");
		$data["isSelf"] = (int)I("isSelf",0);
		if($data["isSelf"]==1){
			$data["deliveryType"] = 1;
		}else{
			$data["deliveryType"] = 0;
		}
		$data["shopName"] = I("shopName");
		$data["shopCompany"] = I("shopCompany");
		$data["shopImg"] = I("shopImg");
		$data["shopAddress"] = I("shopAddress");
		$data["deliveryStartMoney"] = I("deliveryStartMoney",0);
		$data["deliveryCostTime"] = I("deliveryCostTime",0);
		$data["deliveryFreeMoney"] = I("deliveryFreeMoney",0);
		$data["deliveryMoney"] = I("deliveryMoney",0);
		$data["avgeCostMoney"] = I("avgeCostMoney",0);
		$data["bankId"] = I("bankId");
		$data["bankNo"] = I("bankNo");
		$data["bankUserName"] = I("bankUserName");
		$data["longitude"] = (float)I("longitude");
		$data["latitude"] = (float)I("latitude");
		$data["mapLevel"] = (int)I("mapLevel",13);
		$data["isInvoice"] = I("isInvoice",1);
		$data["serviceStartTime"] = I("serviceStartTime");
		$data["serviceEndTime"] = I("serviceEndTime");
		$data["shopStatus"] = (int)I("shopStatus",0);
		$data["shopAtive"] = (int)I("shopAtive",1);
		$isDistributAll = (int)I("isDistributAll",0);
		$data["isDistributAll"] = $isDistributAll;
		$data["shopTel"] = I("shopTel");
		
		if($this->checkEmpty($data,true)){
			$data['qqNo'] = I('qqNo');
			$data["invoiceRemarks"] = I("invoiceRemarks");
			$rs = $m->where("shopId=".$shopId)->save($data);
		    if(false !== $rs){
		    	$shopMessage = '';
		    	//如果[已通过的店铺]被改为未审核的话也要停止了该店铺的商品
		    	if($shops['shopStatus']!=$data['shopStatus']){
					if($data['shopStatus']!=1){
						$sql = "update __PREFIX__goods set isSale=0,goodsStatus=0 where shopId=".$shopId;
			 	        $m->execute($sql);
			 	        $shopMessage = "您的店铺状态已被改为“未审核”状态，如有疑问请与商场管理员联系。";
					}
					if($shops['shopStatus']!=1 && $data['shopStatus']==1){
						$shopMessage = "您的店铺状态已被改为“已审核”状态，您可以出售自己的商品啦~";
					}
					$yj_data = array(
						'msgType' => 0,
						'sendUserId' => session('WST_STAFF.staffId'),
						'receiveUserId' => $shops['userId'],
						'msgContent' => $shopMessage,
						'createTime' => date('Y-m-d H:i:s'),
						'msgStatus' => 0,
						'msgFlag' => 1,
					);
					M('messages')->add($yj_data);
		    	}
		    	//检查用户类型
		    	$m = M('users');
		    	$userType = $m->where('userId='.$shops['userId'])->getField('userType');
		    	
		    	//保存用户资料		    	
		    	$data = array();
		    	$data["userName"] = I("userName");
		        $data["userPhone"] = I("userPhone");
		       
		        //如果是普通用户则提升为店铺会员
		        if($userType==0){
		        	$data["userType"] = 1;
		        }
		        $urs = $m->where("userId=".$shops['userId'])->save($data);
				$rd['status']= 1;
				
				$scm = M('shops_communitys');
				$cm = M('communitys');
				if($isDistributAll==0){
			        //建立店铺和社区的关系
					$relateArea = self::formatIn(",", I('relateAreaId'));
					$relateCommunity = self::formatIn(",", I('relateCommunityId'));
					
					$scm->where('shopId='.$shopId)->delete();
					if($relateArea!=''){
						$relateAreas = explode(',',$relateArea);
						foreach ($relateAreas as $v){
							if($v=='' || $v=='0')continue;
							    $tmp = array();
								$tmp['shopId'] = $shopId;
								$tmp['areaId1'] = (int)I("areaId1");
								$tmp['areaId2'] = (int)I("areaId2");
								$tmp['areaId3'] = $v;
								$tmp['communityId'] = 0;
								$ra = $scm->add($tmp);
						}
					}
					if($relateCommunity!=''){
					    $lc = $cm->where('communityFlag=1 and (communityId in(0,'.$relateCommunity.") or areaId3 in(0,".$relateArea."))")->select();
					    if(count($lc)>0){
							foreach ($lc as $key => $v){
								$tmp = array();
								$tmp['shopId'] = $shopId;
								$tmp['areaId1'] = $v['areaId1'];
								$tmp['areaId2'] = $v['areaId2'];
								$tmp['areaId3'] = $v['areaId3'];
								$tmp['communityId'] = $v['communityId'];
								$ra = $scm->add($tmp);
							}
						}
					}
				}else{//全国配送
			    	 $scm->where('shopId='.$shopId)->delete();
			    }
			}
		}
	
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get(){
	 	$m = M('shops');
		$rs = $m->where("shopId=".(int)I('id'))->find();
		$m = M('users');
		$us = $m->where("userId=".$rs['userId'])->find();
		$rs['userName'] = $us['userName'];
		$rs['userPhone'] = $us['userPhone'];
		//获取店铺社区关系
		$m = M('shops_communitys');
		$rc = $m->where('shopId='.(int)I('id'))->select();
		$relateArea = array();
		$relateCommunity = array();
		if(count($rc)>0){
			foreach ($rc as $v){
				if($v['communityId']==0 && !in_array($v['areaId3'],$relateArea))$relateArea[] = $v['areaId3'];
				if(!in_array($v['communityId'],$relateCommunity))$relateCommunity[] = $v['communityId'];
			}
		}
		$rs['relateArea'] = implode(',',$relateArea);
		$rs['relateCommunity'] = implode(',',$relateCommunity);
		return $rs;
	 }
	 /**
	  * 停止或者拒绝店铺
	  */
	 public function reject(){
	 	$rd = array('status'=>-1);
	 	$shopId = I('id',0);
	 	if($shopId==0)return rd;
	 	$m = M('shops');
	 	//获取店铺资料
	 	$shops = $m->where("shopId=".$shopId)->find();
	 	$data = array();
	 	$data['shopStatus'] = (int)I('shopStatus',-1);
	 	$data['statusRemarks'] = I('statusRemarks');
	 	if($this->checkEmpty($data,true)){
		 	$rs = $m->where("shopId=".$shopId)->save($data);
			if(false !== $rs){
				//如果[已通过的店铺]被改为停止或者拒绝的话也要停止了该店铺的商品
				if($shops['shopStatus']!=$data['shopStatus']){
					$shopMessage = '';
					if($data['shopStatus']!=1){
						$sql = "update __PREFIX__goods set isSale=0,goodsStatus=0 where shopId=".$shopId;
			 	        $m->execute($sql);
			 	        if($data['shopStatus']==0){
			 	        	$shopMessage = "您的店铺状态已被改为“未审核”状态，如有疑问请与商场管理员联系。";
			 	        }else{
			 	        	$shopMessage = I('statusRemarks');
			 	        }
					}
					$yj_data = array(
						'msgType' => 0,
						'sendUserId' => session('WST_STAFF.staffId'),
						'receiveUserId' => $shops['userId'],
						'msgContent' => I('statusRemarks'),
						'createTime' => date('Y-m-d H:i:s'),
						'msgStatus' => 0,
						'msgFlag' => 1,
					);
					M('messages')->add($yj_data);
				}
				$rd['status'] = 1;
			}
			
	 	}
		return $rd;
	 }
	 
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
        $areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
	 	$sql = "select shopId,shopSn,shopName,u.userName,shopAtive,shopStatus,gc.catName from __PREFIX__shops s,__PREFIX__users u ,__PREFIX__goods_cats gc 
	 	     where gc.catId=s.goodsCatId1 and s.userId=u.userId and shopStatus=1 and shopFlag=1 ";
	 	if(I('shopName')!='')$sql.=" and shopName like '%".WSTAddslashes(I('shopName'))."%'";
	 	if(I('shopSn')!='')$sql.=" and shopSn like '%".WSTAddslashes(I('shopSn'))."%'";
	 	if($areaId1>0)$sql.=" and areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and areaId2=".$areaId2;
	 	$sql.=" order by shopId desc";
		return $this->pageQuery($sql);
	 }
     /**
	  * 分页列表[待审核列表]
	  */
     public function queryPeddingByPage(){
        $areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
	 	$sql = "select shopId,shopSn,shopName,u.userName,shopAtive,shopStatus,gc.catName from __PREFIX__shops s,__PREFIX__users u ,__PREFIX__goods_cats gc 
	 	     where gc.catId=s.goodsCatId1 and s.userId=u.userId and shopStatus<=0 and shopFlag=1";
	 	if(I('shopName')!='')$sql.=" and shopName like '%".WSTAddslashes(I('shopName'))."%'";
	 	if(I('shopSn')!='')$sql.=" and shopSn like '%".WSTAddslashes(I('shopSn'))."%'";
	 	if(I('shopStatus',-999)!=-999)$sql.=" and shopStatus =".(int)I('shopStatus');
	 	if($areaId1>0)$sql.=" and areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and areaId2=".$areaId2;
	 	$sql.=" order by shopId desc";
		return $this->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $sql = "select * from __PREFIX__shops order by shopId desc";
		 $rs = $this->find($sql);
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$shopId = (int)I('id');
	    $rd = array('status'=>-1);
	    //下架所有商品
	    $sql = "update __PREFIX__goods set isSale=0,goodsStatus=-1 where shopId=".$shopId;
		$this->execute($sql);
		$sql = "select userId from __PREFIX__shops where shopId=".$shopId;
		$shop = $this->queryRow($sql);
		//删除登录账号
		$sql = "update __PREFIX__users set userFlag=-1 where userId=".$shop['userId'];
		$this->execute($sql);
		
		$scm = M('shops_communitys');
		$scm->where('shopId='.$shopId)->delete();
		
		//标记店铺删除状态
	    $data = array();
		$data["shopFlag"] = -1;
		$data["shopStatus"] = -2;
	 	$rs = $this->where("shopId=".$shopId)->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
     /**
	  * 获取待审核的店铺数量
	  */
	 public function queryPenddingShopsNum(){
	 	$rd = array('status'=>-1);
	 	$sql="select count(*) counts from __PREFIX__shops where shopStatus=0 and shopFlag=1";
	 	$rs = $this->query($sql);
	 	$rd['num'] = $rs[0]['counts'];
	 	return $rd;
	 }
};
?>