<?php
namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 分销佣金记录服务类
 */
class DistributsModel extends BaseModel {
	
	/**
	 * 分销商家列表
	 */
	public function queryShops(){
		$areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
	 	$sql = "select s.shopId,shopImg,shopSn,shopName,u.userName,shopAtive,shopStatus,gc.catName,sc.distributType,sc.distributOrderRate,sc.promoterRate,sc.buyerRate from __PREFIX__shops s,__PREFIX__users u ,__PREFIX__goods_cats gc, __PREFIX__shop_configs sc
	 	     	where s.shopId=sc.shopId and gc.catId=s.goodsCatId1 and s.userId=u.userId and shopStatus=1 and shopFlag=1 and sc.isDistribut=1 ";
	 	if(I('shopName')!='')$sql.=" and shopName like '%".WSTAddslashes(I('shopName'))."%'";
	 	if(I('shopSn')!='')$sql.=" and shopSn like '%".WSTAddslashes(I('shopSn'))."%'";
	 	if($areaId1>0)$sql.=" and areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and areaId2=".$areaId2;
	 	$sql.=" order by s.shopId desc";
		$page = $this->pageQuery($sql);
		return $page;
	}
	
	/**
	 * 分销商品列表
	 */
	public function queryGoods(){
		$shopName = WSTAddslashes(I('shopName'));
     	$goodsName = WSTAddslashes(I('goodsName'));
     	$areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
     	$goodsCatId1 = (int)I('goodsCatId1',0);
     	$goodsCatId2 = (int)I('goodsCatId2',0);
     	$goodsCatId3 = (int)I('goodsCatId3',0);
     	$isAdminBest = (int)I('isAdminBest',-1);
     	$isAdminRecom = (int)I('isAdminRecom',-1);
	 	$sql = "select g.*,gc.catName,sc.catName shopCatName,p.shopName,scg.distributType,scg.distributOrderRate from __PREFIX__goods g 
	 	      left join __PREFIX__goods_cats gc on g.goodsCatId3=gc.catId 
	 	      left join __PREFIX__shops_cats sc on sc.catId=g.shopCatId2,__PREFIX__shops p ,__PREFIX__shop_configs scg
	 	      where p.shopId=scg.shopId and goodsStatus=1 and goodsFlag=1 and p.shopId=g.shopId and g.isSale=1 and scg.isDistribut=1 and g.scg.isDistribut=1 ";
	 	if($areaId1>0)$sql.=" and p.areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and p.areaId2=".$areaId2;
	 	if($goodsCatId1>0)$sql.=" and g.goodsCatId1=".$goodsCatId1;
	 	if($goodsCatId2>0)$sql.=" and g.goodsCatId2=".$goodsCatId2;
	 	if($goodsCatId3>0)$sql.=" and g.goodsCatId3=".$goodsCatId3;
	 	if($isAdminBest>=0)$sql.=" and g.isAdminBest=".$isAdminBest;
	 	if($isAdminRecom>=0)$sql.=" and g.isAdminRecom=".$isAdminRecom;
	 	if($shopName!='')$sql.=" and (p.shopName like '%".$shopName."%' or p.shopSn like '%".$shopName."%')";
	 	if($goodsName!='')$sql.=" and (g.goodsName like '%".$goodsName."%' or g.goodsSn like '%".$goodsName."%')";
	 	$sql.="  order by goodsId desc";   
		$page = $this->pageQuery($sql);
		return $page;
	}
	
	/**
	 * 佣金分成列表
	 */
	public function queryMoneys(){
		$userId = session('WST_USER.userId');
		$userName = WSTAddslashes(I("userName"));
		$orderNo = WSTAddslashes(I("orderNo"));
		$startDate = WSTAddslashes(I("startDate"));
		$settlementId = (int)I("settlementId",-999);
		$endDate = WSTAddslashes(I("endDate"));
		$sql = "select m.*, o.orderNo, o.settlementId , u.userName, u.loginName from __PREFIX__distribut_moneys m, __PREFIX__users u, __PREFIX__orders o
				where o.orderId=m.orderId and u.userId=m.userId ";
		if($userName!="") $sql .= " and (u.userName like '%".$userName."%' or u.loginName like '%".$userName."%') ";
		if($orderNo!="") $sql .= " and o.orderNo like '%".$orderNo."%'";
		if($settlementId>=0)  $sql .= " and o.settlementId = $settlementId";
		if($startDate!=""){
			$sql .= " and m.createTime >='".$startDate."'";
		}
		if($endDate!=""){
			$sql .= " and m.createTime <='".$endDate."'";
		}
		$sql .= " order by m.createTime";
		$pages = $this->pageQuery($sql);
		return $pages;
	}
	
	/**
	 * 推广用户列表
	 */
	public function queryUsers(){
		$map = array();
	 	$sql = "select u.*, count(d.userId) userCnt from __PREFIX__users u, __PREFIX__distribut_users d where u.userFlag=1 and u.userId=d.userId ";
	 	if(I('loginName')!='')$sql.=" and loginName LIKE '%".WSTAddslashes(I('loginName'))."%'";
	 	if(I('userPhone')!='')$sql.=" and userPhone LIKE '%".WSTAddslashes(I('userPhone'))."%'";
	 	if(I('userEmail')!='')$sql.=" and userEmail LIKE '%".WSTAddslashes(I('userEmail'))."%'";
	 	if(I('userType',-1)!=-1)$sql.=" and userType=".I('userType',-1);
	 	$sql.=" group by u.userId order by userId desc";
		$rs = $this->pageQuery($sql);
		//计算等级
		if(count($rs)>0){
			$m = M('user_ranks');
			$urs = $m->select();
			foreach ($rs['root'] as $key=>$v){
				foreach ($urs as $rkey=>$rv){
					if($v['userTotalScore']>=$rv['startScore'] && $v['userTotalScore']<$rv['endScore']){
					   $rs['root'][$key]['userRank'] = $rv['rankName'];
					}
				}
			}
		}
		return $rs;
	}
	
	public function getDistributUsers(){
		$userId = (int)I("userId");
		$sql = "select u.* from __PREFIX__users u, __PREFIX__distribut_users d where d.userId=$userId and u.userFlag=1 and u.userId=d.buyerId order by d.createTime desc";
		$pages = $this->pageQuery($sql);
		return $pages;
	}
	
}