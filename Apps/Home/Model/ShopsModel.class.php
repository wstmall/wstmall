<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 店铺服务类
 */
class ShopsModel extends BaseModel {
     /**
	  * 查询登录关键字
	  */
	 public function checkLoginKey($val,$id = 0){
	 	$sql = " (loginName ='%s' or userPhone ='%s' or userEmail='%s') ";
	 	$keyArr = array($val,$val,$val);
	 	if($id>0)$sql.=" and userId!=".$id;
	 	$m = M('users');
	 	$rs = $m->where($sql,$keyArr)->count();
	    if($rs==0)return 1;
	    return 0;
	 }
   /**
    * 商家登录验证
    */
	public function login(){
		$rd = array('status'=>-1);
	 	$m = M('users');
	 	$users = $m->where('(loginName="'.I('loginName').'" or userPhone="'.I('loginName').'" or userEmail="'.I('loginName').'") and userFlag=1 and userStatus=1')->find();
	 	if($users['loginPwd']==md5(I('loginPwd').$users['loginSecret']) && $users['userType']>=1){
	 		//加载商家信息
	 		$s = M('shops');
	 		$shops = $s->where('userId='.$users['userId']." and shopFlag=1")->find();
	 		$users = array_merge($shops,$users);
	 		$rd['shop'] = $users;
	 		$rd['status'] = 1;
	 		$m->lastTime = date('Y-m-d H:i:s');
	 		$m->lastIP = get_client_ip();
	 		$m->where(' userId='.$shops['userId'])->save();
	 		//记录登录日志
			$data = array();
			$data["userId"] = $shops['userId'];
			$data["loginTime"] = date('Y-m-d H:i:s');
			$data["loginIp"] = get_client_ip();
			M('log_user_logins')->add($data);
	 		
	 	}
	 	return $rd;
	}
	
	/**
	  * 游客开店
	  */
	 public function addByVisitor(){
	 	$rd = array('status'=>-1);
	 	//检测账号是否存在
	 	$hasLoginName = self::checkLoginKey(I("loginName"));
	    if($hasLoginName==0){
	 		$rd = array('status'=>-2);
	 		return $rd;
	 	}
	 	$hasUserPhone = self::checkLoginKey(I("userPhone"));
	 	if($hasUserPhone==0){
	 		$rd = array('status'=>-7);
	 		return $rd;
	 	}
	 	//新注册账号
	 	$data = array();
	 	$data["loginName"] = I("loginName");
		$data["loginSecret"] = rand(1000,9999);
		$data["loginPwd"] = md5(I('loginPwd').$data['loginSecret']);
		$data["userName"] = I("userName");
		$data["userPhone"] = I("userPhone");
		if($this->checkEmpty($data,true)){ 
			$data["userStatus"] = 1;
			$data["userType"] = 0;
		    $data["userFlag"] = 1;
		    $data["createTime"] = date('Y-m-d H:i:s');
			$m = M('users');
			$userId = $m->add($data);
			if(false !== $userId){
				$data = array();
				$data["userId"] = $userId;
				$data["areaId1"] = I("areaId1");
				$data["areaId2"] = I("areaId2");
				$data["areaId3"] = I("areaId3");
				$data["goodsCatId1"] = I("goodsCatId1");
				//$data["goodsCatId2"] = I("goodsCatId2");
				//$data["goodsCatId3"] = I("goodsCatId3");
				$data["shopName"] = I("shopName");
				$data["shopCompany"] = I("shopCompany");
				$data["shopImg"] = I("shopImg");
				$data["shopAddress"] = I("shopAddress");
				$data["shopStatus"] = 0;
				$data["shopAtive"] = I("shopAtive",1);
				$data["shopFlag"] = 1;
				$data["createTime"] = date('Y-m-d H:i:s');
			    if($this->checkEmpty($data,true)){
			    	$data["shopTel"] = I("shopTel");
					$m = M('shops');
					$rs = $m->add($data);
				    if(false !== $rs){
						$rd['status']= 1;
						$rd['userId']= $userId;
						//记录登录日志
						$data = array();
						$data["userId"] = $userId;
						$data["loginTime"] = date('Y-m-d H:i:s');
						$data["loginIp"] = get_client_ip();
						M('log_user_logins')->add($data);
					}
				}
				
			}
			
		}
		
		return $rd;
	 } 
	
	 /**
	  * 会员注册开通店铺
	  */
	 public function addByUser($userId){
	 	$rd = array('status'=>-1);
	 	//新注册账号
	 	$data = array();
		$data["userName"] = I("userName");
		if($this->checkEmpty($data,true)){ 
			$m = M('users');
			$rs = $m->where('userId='.$userId)->save($data);
			if(false !== $rs){
				$data = array();
				$data["userId"] = $userId;
				$data["areaId1"] = I("areaId1");
				$data["areaId2"] = I("areaId2");
				$data["areaId3"] = I("areaId3");
				$data["goodsCatId1"] = I("goodsCatId1");
				//$data["goodsCatId2"] = I("goodsCatId2");
				//$data["goodsCatId3"] = I("goodsCatId3");
				$data["isSelf"] = I("isSelf",0);
				$data["shopName"] = I("shopName");
				$data["shopCompany"] = I("shopCompany");
				$data["shopImg"] = I("shopImg");
				$data["shopAddress"] = I("shopAddress");
				$data["deliveryFreeMoney"] = I("deliveryFreeMoney",0);
		        $data["deliveryMoney"] = I("deliveryMoney",0);
				$data["avgeCostMoney"] = I("avgeCostMoney",0);
				$data["bankId"] = I("bankId");
				$data["bankNo"] = I("bankNo");
				$data["isInvoice"] = I("isInvoice",1);
				$data["serviceStartTime"] = I("serviceStartTime");
				$data["serviceEndTime"] = I("serviceEndTime");
				$data["shopStatus"] = 0;
				$data["shopAtive"] = I("shopAtive",1);
				$data["shopFlag"] = 1;
				$data["createTime"] = date('Y-m-d H:i:s');
			    if($this->checkEmpty($data,true)){
			    	$data["shopTel"] = I("shopTel");
			    	$data["invoiceRemarks"] = I("invoiceRemarks");
					$m = M('shops');
					$shopId = $m->add($data);
				    if(false !== $shopId){
						$rd['status']= 1;
						//建立门店和社区的关系
						$relateArea = I('relateAreaId');
						$relateCommunity = I('relateCommunityId');
						if($relateArea!=''){
							$m = M('shops_communitys');
							$relateAreas = explode(',',$relateArea);
							foreach ($relateAreas as $v){
								if($v=='' || $v=='0')continue;
								$tmp = array();
								$tmp['shopId'] = $shopId;
								$tmp['areaId1'] = I("areaId1");
								$tmp['areaId2'] = I("areaId2");
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
	 public function edit($shopId){
	 	$rd = array('status'=>-1);
	 	if($shopId==0)return rd;
	 	$m = M('shops');
	 	//加载商店信息
	 	$shops = $m->where('shopId='.$shopId)->find();
	    $data = array();
		$data["shopName"] = I("shopName");
		$data["shopCompany"] = I("shopCompany");
		$data["shopImg"] = I("shopImg");
		$data["shopAddress"] = I("shopAddress");
		$data["deliveryStartMoney"] = I("deliveryStartMoney",0);
		$data["deliveryCostTime"] = I("deliveryCostTime",0);
		$data["deliveryFreeMoney"] = I("deliveryFreeMoney",0);
		$data["deliveryMoney"] = I("deliveryMoney",0);
		$data["avgeCostMoney"] = I("avgeCostMoney",0);
		$data["isInvoice"] = I("isInvoice",1);
		$data["serviceStartTime"] = I("serviceStartTime");
		$data["serviceEndTime"] = I("serviceEndTime");
		$data["shopAtive"] = I("shopAtive",1);
		if($this->checkEmpty($data,true)){
			$data["shopTel"] = I("shopTel");
			$data["invoiceRemarks"] = I("invoiceRemarks");
			$rs = $m->where("shopId=".$shopId)->save($data);
		    if(false !== $rs){
		    	S('WST_CACHE_RECOMM_SHOP_'.$shops['areaId2'],null);
		    	$USER = session('WST_USER');
		    	session('WST_USER',array_merge($USER,$data));
				$rd['status']= 1;
				//修改用户资料
				$m = M('users');
				$data = array();
				$data[userName] = I("userName");
				$m->where("userId=".$shops['userId'])->save($data);
				if($shops['isSelf']==0){
			        //建立门店和社区的关系
					$relateArea = I('relateAreaId');
					$relateCommunity = I('relateCommunityId');
					$m = M('shops_communitys');
					$m->where('shopId='.$shopId)->delete();
					if($relateArea!=''){
						$relateAreas = explode(',',$relateArea);
						foreach ($relateAreas as $v){
							if($v=='' || $v=='0')continue;
							    $tmp = array();
								$tmp['shopId'] = $shopId;
								$tmp['areaId1'] = I("areaId1");
								$tmp['areaId2'] = I("areaId2");
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
		return $rd;
	 } 
	 
	 
	 /**
	  * 修改店铺设置
	  */
	 public function editShopCfg($shopId){
	 	
	 	$mc = M('shop_configs');
	 	//加载商店信息
	 	$shopcg = $mc->where('shopId='.$shopId)->find();
	 	
	 	$scdata = array();
	 	$scdata["shopId"] =  $shopId;
	 	$scdata["shopTitle"] =  I("shopTitle");
	 	$scdata["shopKeywords"] =  I("shopKeywords");
	 	$scdata["shopBanner"] =  I("shopBanner");
	 	$scdata["shopDesc"] =  I("shopDesc");
	 	$scdata["shopAds"] =  I("shopAds");
	 	$scdata["shopAdsUrl"] =  I("shopAdsUrl");
	 	if($shopcg["configId"]>0){
	 		$rs = $mc->where("shopId=".$shopId)->save($scdata);
	 	}else{
	 		$mc->add($scdata);
	 	}
	 	S('WST_CACHE_RECOMM_SHOP_'.$shopcg['areaId2'],null);
	 	$rd['status']= 1;
	 	return $rd;
	 }
	 
    /**
	 * 获取指定对象
	 */
     public function get($id){
	 	$m = M('shops');
		$rs = $m->where("shopId=".$id)->find();
		$m = M('users');
		$us = $m->where("userId=".$rs['userId'])->find();
		$rs['userName'] = $us['userName'];
		$rs['userPhone'] = $us['userPhone'];
		//获取门店社区关系
		$m = M('shops_communitys');
		$rc = $m->where('shopId='.$id)->select();
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
	  * 获取指定对象
	  */
	 public function getShopCfg($id){
	 	
	 	$mc = M('shop_configs');
	 	$rs = $mc->where("shopId=".$id)->find();
	 	$shopAds = array();
	 	if($rs["shopAds"]!=''){
		 	$shopAdsImg = explode('#@#',$rs["shopAds"]);
		 	$shopAdsUrl = explode('#@#',$rs["shopAdsUrl"]);
		 	for($i=0;$i<count($shopAdsImg);$i++){
		 		$adsImg = $shopAdsImg[$i];
		 		$shopAds[$i]["adImg"] = $adsImg;
		 		$imgpaths= explode('.',$adsImg);
		 		$shopAds[$i]["adImg_thumb"] = $imgpaths[0]."_thumb.".$imgpaths[1];
		 		$shopAds[$i]["adUrl"] = $shopAdsUrl[$i];
		 	}
	 	}
	 	$rs['shopAds'] = $shopAds;
	 	
	 	return $rs;
	 }
	/**
	 * 获取店铺信息
	 */
	public function getShopInfo(){
		$m = M('shops');
		$shopId = I("shopId",0);
		$rs = $m->where("shopStatus=1 and shopId=".$shopId)->find();
		if(empty($rs))return array();
		$mc = M('shop_configs');
		$spc = $mc->where("shopId=".$shopId)->find();
		$shopAds = array();
		if($spc["shopAds"]!=''){
			$shopAdsImg = explode('#@#',$spc["shopAds"]);
			$shopAdsUrl = explode('#@#',$spc["shopAdsUrl"]);
			for($i=0;$i<count($shopAdsImg);$i++){
				$adsImg = $shopAdsImg[$i];
				$shopAds[$i]["adImg"] = $adsImg;
				$imgpaths= explode('.',$adsImg);
				$shopAds[$i]["adImg_thumb"] = $imgpaths[0]."_thumb.".$imgpaths[1];
				$shopAds[$i]["adUrl"] = $shopAdsUrl[$i];
			}
		}
		$rs['shopAds'] = $shopAds;
		$rs['shopTitle'] = $spc["shopTitle"];
		$rs['shopDesc'] = $spc["shopDesc"];
		$rs['shopKeywords'] = $spc["shopKeywords"];
		$rs['shopBanner'] = $spc["shopBanner"];

		//热销排名
		$sql = "SELECT sp.shopName, SUM(og.goodsNums) totalnum, sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsThums,g.shopPrice,g.marketPrice, g.goodsSn 
						FROM __PREFIX__goods g
						LEFT JOIN __PREFIX__order_goods og ON g.goodsId = og.goodsId,
						__PREFIX__shops sp 
						WHERE g.shopId = sp.shopId AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND sp.shopId = $shopId
						GROUP BY g.goodsId ORDER BY SUM(og.goodsNums) desc limit 5";	
		$hotgoods = $this->query($sql);
		$rs["hotgoods"] = $hotgoods;
		
		return $rs; 
	}
	
	
	/**
	  * 统计附近的商铺
	  */
	public function getDistrictsShops($obj){
		$m = M('areas');
		$areaId3 = $obj["areaId3"];
		$shopName = $obj["shopName"];
		$keyWords = I("keyWords");
   		$deliveryStartMoney = $obj["deliveryStartMoney"];
   		if($deliveryStartMoney != -1){
   			$deliverys = explode("-",$deliveryStartMoney);
   			$deliveryStart = intval($deliverys[0]);
   			$deliveryEnd = intval($deliverys[1]);
   		}
   		
   		$deliveryMoney = $obj["deliveryMoney"];
		if($deliveryMoney != -1){
   			$mdeliverys = explode("-",$deliveryMoney);
   			$mdeliveryStart = intval($mdeliverys[0]);
   			$mdeliveryEnd = intval($mdeliverys[1]);
   		}
   		
   		$shopAtive = $obj["shopAtive"];
   		
		$dsplist = array();
		$sql = "SELECT communityId,communityName from __PREFIX__communitys WHERE communityFlag=1 AND isShow = 1 AND areaId3=".$areaId3;
		$ctlist = $this->query($sql);
		$ctsplist = array();
		for($k=0;$k<count($ctlist);$k++){
			$community = $ctlist[$k];
			$communityId = $community["communityId"];
			$sql = "SELECT count(*) as spcnt from __PREFIX__shops_communitys sc,__PREFIX__shops sp WHERE sc.shopId = sp.shopId AND communityId=".$communityId;
			if($keyWords!="" && $shopName!=""){
				$sql .= " AND (sp.shopName like '%$keyWords%' OR shopName like '%$shopName%')";
			}else{
				if($keyWords!=""){
					$sql .= " AND sp.shopName like '%$keyWords%'";
				}
				if($shopName!=""){
					$sql .= " AND sp.shopName like '%$shopName%'";
				}
			}
			if($deliveryStart!="" && $deliveryStart>=0){
				$sql .= " AND deliveryStartMoney >= $deliveryStart";
			}
			if($deliveryEnd!="" && $deliveryEnd>0){
				$sql .= " AND deliveryStartMoney < $deliveryEnd";
			}
				
			if($mdeliveryStart!="" && $mdeliveryStart>=0){
				$sql .= " AND deliveryMoney >= $mdeliveryStart";
			}
			if($mdeliveryEnd!="" && $mdeliveryEnd>0){
				$sql .= " AND deliveryMoney < $mdeliveryEnd";
			}
				
			if($shopAtive!="" && $shopAtive >=0){
				$sql .= " AND shopAtive = $shopAtive";
			}
			
			$splist = $this->query($sql);
			$spcnt = $splist[0]["spcnt"];
			$community["spcnt"] = $spcnt;
			if($spcnt>0)$ctsplist[] = $community;
		}
		$districts["ctlist"] = $ctsplist;
		if(count($ctsplist)>0)$dsplist[] = $districts;
		return $dsplist;
	}
	
	/**
	  * 统计附近的商铺
	  */
	public function getShopByCommunitys($obj){
		
		$communityId = $obj["communityId"];
		$shopName = $obj["shopName"];
		$keyWords = I("keyWords");
		$deliveryStartMoney = $obj["deliveryStartMoney"];
		if($deliveryStartMoney != -1){
			$deliverys = explode("-",$deliveryStartMoney);
			$deliveryStart = intval($deliverys[0]);
			$deliveryEnd = intval($deliverys[1]);
		}
		 
		$deliveryMoney = $obj["deliveryMoney"];
		if($deliveryMoney != -1){
			$mdeliverys = explode("-",$deliveryMoney);
			$mdeliveryStart = intval($mdeliverys[0]);
			$mdeliveryEnd = intval($mdeliverys[1]);
		}
		 
		$shopAtive = $obj["shopAtive"];
		$dsplist = array();
		$sql = "SELECT sp.shopId,sp.shopName,sp.shopAddress,sp.deliveryStartMoney,sp.shopAtive,sp.deliveryMoney,sp.shopImg,sp.deliveryCostTime,sp.deliveryFreeMoney
		   ,sp.avgeCostMoney from __PREFIX__shops_communitys sc,__PREFIX__shops sp WHERE sc.shopId = sp.shopId AND sc.communityId=".$communityId;
		
		if($keyWords!="" && $shopName!=""){
			$sql .= " AND (sp.shopName like '%$keyWords%' OR shopName like '%$shopName%')";
		}else{
			if($keyWords!=""){
				$sql .= " AND sp.shopName like '%$keyWords%'";
			}
			if($shopName!=""){
				$sql .= " AND sp.shopName like '%$shopName%'";
			}
		}
		
		if($deliveryStart!="" && $deliveryStart>=0){
			$sql .= " AND deliveryStartMoney >= $deliveryStart";
		}
		if($deliveryEnd!="" && $deliveryEnd>0){
			$sql .= " AND deliveryStartMoney < $deliveryEnd";
		}
		
		if($mdeliveryStart!="" && $mdeliveryStart>=0){
			$sql .= " AND deliveryMoney >= $mdeliveryStart";
		}
		if($mdeliveryEnd!="" && $mdeliveryEnd>0){
			$sql .= " AND deliveryMoney < $mdeliveryEnd";
		}
		
		if($shopAtive!="" && $shopAtive >=0){
			$sql .= " AND shopAtive = $shopAtive";
		}
		$dslist = $this->query($sql);
		
		return $dslist;
	}
	
	/**
	  * 统计店铺信息
	  */
	public function getShopDetails($obj){
		
		$shopId = $obj["shopId"];
		$dsplist = array();
		$sql = "SELECT SUM(totalScore) totalScore,SUM(totalUsers) totalScore ,
				       SUM(goodsScore) goodsScore,SUM(goodsUsers) goodsUsers,
				       SUM(serviceScore) serviceScore,SUM(serviceUsers) serviceUsers,
					   SUM(timeScore) timeScore,SUM(timeUsers) timeUsers
				FROM wst_goods_scores WHERE shopId = $shopId";
		$scores = $this->queryRow($sql);
		$data = array();
		$goodsScore = $scores["goodsUsers"]?round($scores["goodsScore"]/$scores["goodsUsers"]):0;
		$timeScore = $scores["timeUsers"]?round($scores["timeScore"]/$scores["timeUsers"]):0;
		$serviceScore = $scores["serviceUsers"]?round($scores["serviceScore"]/$scores["serviceUsers"]):0;
		$data["goodsScore"] = $goodsScore;
		$data["timeScore"] = $timeScore;
		$data["serviceScore"] = $serviceScore;
		//待审核商品
		$sql = "SELECT count(*) cnt FROM wst_goods WHERE goodsStatus = 0 and goodsFlag=1 and isSale=1 and shopId = $shopId";
		$goods = $this->queryRow($sql);
		$data["waitGoodsCnt"] = $goods["cnt"];
		//仓库中商品
		$sql = "SELECT count(*) cnt FROM wst_goods WHERE isSale = 0 and goodsFlag=1 AND shopId = $shopId";
		$goods = $this->queryRow($sql);
		$data["waitSaleGoodsCnt"] = $goods["cnt"];
		//出售中的商品
		$sql = "SELECT count(*) cnt FROM wst_goods WHERE isSale = 1 AND goodsStatus = 1 and goodsFlag=1 AND shopId = $shopId";
		$goods = $this->queryRow($sql);
		$data["onSaleGoodsCnt"] = $goods["cnt"];
		//买家留言
		$sql = "SELECT count(*) cnt FROM wst_goods_appraises WHERE shopId = $shopId";
		$appraises = $this->queryRow($sql);
		$data["appraisesCnt"] = $appraises["cnt"];
		//待受理订单
		$sql = "SELECT count(*) cnt FROM wst_orders WHERE shopId = $shopId AND orderStatus = 0 and orderFlag=1";
		$orders = $this->queryRow($sql);
		$data["waitHandleOrderCnt"] = $orders["cnt"];
		//待发货订单
		$sql = "SELECT count(*) cnt FROM wst_orders WHERE shopId = $shopId AND orderStatus in (1,2) and orderFlag=1";
		$orders = $this->queryRow($sql);
		$data["waitSendOrderCnt"] = $orders["cnt"];
		
		//待结束
		$sql = "SELECT count(*) cnt FROM wst_orders WHERE shopId = $shopId AND orderStatus = 4 and orderFlag=1";
		$appOrders = $this->queryRow($sql);
		$data["appraisesOrderCnt"] = $appOrders["cnt"];
		
		//周订单量
		$wdate=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
		$sql = "SELECT count(*) cnt, sum(totalMoney) totalMoney FROM wst_orders WHERE shopId = $shopId AND createTime >='$wdate' and orderFlag=1 ";
		$orders = $this->queryRow($sql);
		$data["weekOrderCnt"] = $orders["cnt"];
		$data["weekOrderMoney"] = $orders["totalMoney"]?$orders["totalMoney"]:0;
		
		
		//一个月订单量
		$mdate=date("Y-m-d",mktime(0,0,0,date("m")-1,date("d"),date("Y")));
		$sql = "SELECT count(*) cnt, sum(totalMoney) totalMoney FROM wst_orders WHERE shopId = $shopId AND createTime >='$mdate' and orderFlag=1 ";
		$orders = $this->queryRow($sql);
		$data["monthOrderCnt"] = $orders["cnt"];
		$data["monthOrderMoney"] = $orders["totalMoney"]?$orders["totalMoney"]:0;
		
		return $data;
	}
	/**
	 * 获取店铺评分
	 */
	public function getShopScores($obj){
	
		$shopId = $obj["shopId"];
		
		$sql = "SELECT SUM(totalScore) totalScore,SUM(totalUsers) totalScore ,
				       SUM(goodsScore) goodsScore,SUM(goodsUsers) goodsUsers,
				       SUM(serviceScore) serviceScore,SUM(serviceUsers) serviceUsers,
					   SUM(timeScore) timeScore,SUM(timeUsers) timeUsers
				FROM wst_goods_scores WHERE shopId = $shopId";
		$scores = $this->queryRow($sql);
		$data = array();
		$goodsScore = $scores["goodsUsers"]?sprintf('%.1f',$scores["goodsScore"]/$scores["goodsUsers"]):0;
		$timeScore = $scores["timeUsers"]?sprintf('%.1f',$scores["timeScore"]/$scores["timeUsers"]):0;
		$serviceScore = $scores["serviceUsers"]?sprintf('%.1f',$scores["serviceScore"]/$scores["serviceUsers"]):0;
		$data["goodsScore"] = $goodsScore;
		$data["timeScore"] = $timeScore;
		$data["serviceScore"] = $serviceScore;
		return $data;
	}
	
	/**
	 * 检查用户是否正在申请开店
	 */
	public function checkOpenShopStatus($userId){
		$m = M('shops');
		return $m->where('userId='.$userId." and shopFlag=1 ")->getField('shopStatus',true);
	}
	
	
	/**
	 * 获取自营门店
	 */
	public function getSelfShop($areaId2){
		$m = M('shops');
		$sql = "select * from wst_shops where areaId2=".$areaId2." and isSelf=1 and shopFlag=1 and shopStatus = 1";
		$shop = $this->queryRow($sql);
		return $shop;
	}
	 
}