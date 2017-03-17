<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 团购服务类
 */
class GroupsModel extends BaseModel {


    /**
	 * 获取审核中的团购
	 */
	public function queryGroupByPage(){
		$shopId=(int)session('WST_USER.shopId');
		$startDate = I('startDate');
		$endDate = I('endDate');
		$groupName = WSTAddslashes(I('groupName'));
		$sql = "select * from __PREFIX__groups where dataFlag=1 and shopId=".$shopId;
		if($groupName!=""){
			$sql .= " and groupName like '%".$groupName."%'";
		}
		if($startDate!=""){
			$sql .= " and startTime >= '$startDate'";
		}
		if($endDate!=""){
			$sql .= " and endTime <= '$endDate'";
		}
		$rs = $this->pageQuery($sql);
		$now = date("Y-m-d H:i:s");
		for($i=0,$k=count($rs['root']);$i<$k;$i++){
			$startTime = $rs['root'][$i]["startTime"];
			$endTime = $rs['root'][$i]["endTime"];
			$statusTxt = "";
			if($startTime<=$now && $endTime>=$now){
				$statusTxt = "进行中";
			}elseif($startTime>$now){
				$statusTxt = "未开始";
			}elseif($endTime<$now){
				$statusTxt = "已结束";
			}
			$rs['root'][$i]["statusTxt"] = $statusTxt;
		}
		return $rs;
	}
	
	protected $_validate = array(
		 array('groupName','require','请输入团购活动名称!',1),
		 array('startTime','require','请输入团购开始时间!',1),
		 array('endTime','require','请输入团购结束时间!',1)
	);
		
	/**
	 * 新增团购
	 */
	public function insert(){
	 
		$m = D('Groups');
		$rd = $this->checkGroup();
	 	if($rd["status"]==1){
			if ($m->create()){
				$m->shopId = (int)session('WST_USER.shopId');
				$m->dataFlag = 1;
				$m->createTime=date('Y-m-d H:i:s');
				$groupId = $m->add();
				if(false !== $groupId){
					$rd['status']= 1;
				}
			}else{
				$rd['status']= -1;
				$rd['msg'] = $m->getError();
			}
	 	}
		return $rd;
	} 
	 
	/**
	 * 编辑团购信息
	 */
	public function edit(){
		
	 	$groupId = (int)I("groupId",0);
	 	$shopId = (int)session('WST_USER.shopId');
	 	$m = D('Groups');
	 	$rd = $this->checkGroup();
	 	if($rd["status"]==1){
	 		if ($m->create()){
	 			$m->where(array("shopId"=>$shopId,"groupId"=>$groupId))->save();
	 			if(false !== $rs){
	 				$rd['status']= 1;
	 			}else{
	 				$rd['status']= -1;
	 				$rd['msg'] = $m->getError();
	 			}
	 		}else{
	 			$rd['status']= -1;
	 			$rd['msg'] = $m->getError();
	 		}
	 	}
		return $rd;
	}
	
	public function checkGroup(){
		$rd = array('status'=>-1);
		$groupId = (int)I("groupId",0);
		$shopId = (int)session('WST_USER.shopId');
		$startTime = I("startTime");
		$endTime = I("endTime");
		$sql = "select * from __PREFIX__groups where shopId=$shopId and dataFlag=1 and startTime<='$startTime' and endTime>='$startTime'";
		if($groupId>0){
			$sql .= " and groupId<> $groupId";
		}
		$row = $this->queryRow($sql);
		if(!empty($row)){
			$rd["msg"] = "活动时间不能重叠";
		}else{
			$sql = "select * from __PREFIX__groups where shopId=$shopId and dataFlag=1 and startTime<='$endTime' and endTime>='$endTime'";
			if($groupId>0){
				$sql .= " and groupId<> $groupId";
			}
			$row = $this->queryRow($sql);
			if(!empty($row)){
				$rd["msg"] = "活动时间不能重叠";
			}else{
				$rd["status"] = 1;
			}
		}
		return $rd;
	}
	
	/**
	 * 获取团购信息
	 */
	 public function get(){
	 	$where = array();
	 	$where["shopId"] = (int)session('WST_USER.shopId');
	 	$where["groupId"] = (int)I("groupId");
	 	$where["dataFlag"] = 1;
	 	$group = M('groups')->where($where)->find();
	 	$now = date("Y-m-d H:i:s");
	 	$group["editStatus"] = -1;
	 	$startTime = $group["startTime"];
	 	if($startTime>$now){
	 		$group["editStatus"] = 1;
	 	}
	 	return $group;
	 }
	 
	 /**
	  * 删除团购
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	$groupId = (int)I('id');
	 	$shopId = (int)session('WST_USER.shopId');
	 	$data = array();
		$data["dataFlag"] = -1;
		$rs = $this->where(array("shopId"=>$shopId,"groupId"=>$groupId))->save($data);
	    if(false !== $rs){
	    	M('groups_goods')->where(array("shopId"=>$shopId,"groupId"=>$groupId))->save($data);
			$rd['status']= 1;
		}
		return $rd;
	 }
	 
	 /**
	  * 获取审核中的团购商品
	  */
	 public function queryGroupGoodsByPage(){
	 	$shopId=(int)session('WST_USER.shopId');
	 	$groupId = (int)I('groupId');
	 	$pcurr = (int)I("pcurr",0);
	 	$goodsName = I('goodsName');
	 	$sql = "select g.goodsName,g.goodsThums,g.shopPrice,p.* from __PREFIX__groups_goods p, __PREFIX__goods g 
	 			where p.groupId=$groupId and p.goodsId=g.goodsId and g.goodsFlag=1 and p.dataFlag=1 and p.shopId=".$shopId;
	 	if($goodsName!=""){
	 		$sql .= " and g.goodsName like '%".$goodsName."%'";
	 	}
	 	$rs = $this->pageQuery($sql,$pcurr);
	 	return $rs;
	 }
	 
	 /**
	  * 
	  */
	 public function getGroupGoodsByCat(){
	 	$shopId = (int)session('WST_USER.shopId');
	 	$catId = (int)I("catId");
	 	$groupId = (int)I("groupId");
	 	
	 	$pgoods = M('groups_goods')->where(array("shopId"=>$shopId,"groupId"=>$groupId,"dataFlag"=>1))->getField("goodsId",true);
	 	$agoods = M('goods_attributes')->where(array("shopId"=>$shopId,"isRecomm"=>1))->getField("goodsId",true);
	 	$mgoods = array_merge($pgoods,$agoods);
	 	$goodsIds = implode(",",$mgoods);
	 	$sql = "select goodsId,goodsName,shopPrice from __PREFIX__goods 
	 			where shopId=$shopId and goodsFlag = 1 AND isSale = 1 AND goodsStatus = 1 ";
	 	if(!empty($mgoods)){
	 		$sql .= " and goodsId not in (".$goodsIds.") ";
	 	}
	 	if($catId>0){
	 		$sql .= " and (shopCatId1=$catId or shopCatId2=$catId) ";
	 	}
	 	$rs = $this->query($sql);
	 	return $rs;
	 }
	 
	 /**
	  * 添加团购商品
	  */
	 public function addGroupGoods(){
	 	$rd = array('status'=>-1);
	 	$shopId = (int)session('WST_USER.shopId');
	 	$groupId = (int)I("groupId");
	 	$goodsIds = I("goodsIds");
	 	$ids = explode(",",$goodsIds);
	 	for($i=0,$k=count($ids);$i<$k;$i++){
	 		$goodsId = (int)$ids[$i];
	 		$data = array();
	 		$data["groupId"] = $groupId;
	 		$data["shopId"] = $shopId;
	 		$data["goodsId"] = $goodsId;
	 		$data["goodsStatus"] = 0;
	 		$data["dataFlag"] = 1;
	 		$data["createTime"] = date("Y-m-d H:i:s");
	 		M("groups_goods")->add($data);
	 	}
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 

	 /**
	  * 审核团购商品
	  */
	 public function auditGroupGoods(){
	 	$rd = array('status'=>-1);
	 	$where = array();
	 	$where["shopId"] = (int)session('WST_USER.shopId');
	 	$where["id"] = (int)I("id");
	 	$data = array();
	 	$data["goodsStatus"] = 1;//审核通过
	 	$data["groupMoney"] = (float)I("groupMoney");
	 	$data["goodsStock"] = (int)I("goodsStock");
	 	$data["virtualBuyCnt"] = (int)I("virtualBuyCnt");
	 	M("groups_goods")->where($where)->save($data);
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 
	 /**
	  * 删除团购商品
	  */
	 public function delGroupGoods(){
	 	$rd = array('status'=>-1);
	 	$where = array();
	 	$where["shopId"] = (int)session('WST_USER.shopId');
	 	$where["id"] = (int)I("id");
	 	$data = array();
	 	$data["dataFlag"] = -1;//删除
	 	M("groups_goods")->where($where)->save($data);
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 
	 /**
	  * 获取团购首页列表
	  */
	 public function getGroupGoodsByPage(){
	 	$areas= D('Home/Areas');
	 	$areaId2 = $areas->getDefaultCity();
	 	$pcurr = (int)I("pcurr",0);
	 	$catId1 = (int)I("catId1",0);
	 	$catId2 = (int)I("catId2",0);
	 	$now = date("Y-m-d H:i:s");
	 	$sql = "select gp.id,g.goodsId,g.goodsName,gp.groupMoney,gp.goodsStock,gp.virtualBuyCnt,g.goodsThums,g.shopPrice,p.startTime,p.endTime from __PREFIX__groups p, __PREFIX__groups_goods gp, __PREFIX__goods g, __PREFIX__shops sp
	 			where (sp.areaId2=$areaId2 or sp.isDistributAll=1) and sp.shopId=p.shopId and gp.groupId = p.groupId and g.goodsId=gp.goodsId and p.startTime<='$now' and p.endTime>='$now' and gp.goodsStatus=2 and gp.dataFlag=1 and g.goodsFlag = 1 and g.isSale=1 ";
	 	if($catId1>0){
	 		$sql .= " and g.goodsCatId1= $catId1 ";
	 	}
	 	if($catId2>0){
	 		$sql .= " and g.goodsCatId2= $catId2 ";
	 	}
	 	$sql .= " order by gp.sortNo , p.startTime  ";
	 	$rs = $this->pageQuery($sql,$pcurr,20);
	 	return $rs;
	 }
	 
	 
	 
	 
	 public function getGroupInfo(){
	 
	 	$mgoods = D('Home/Goods');
	 	$userId = (int)session('WST_USER.userId');
	 	$totalMoney = 0;
	 	$cartgoods = array();
	 	$id = (int)session("WST_group_id");
	 	$cnt = (int)session("WST_group_cnt");
	 	
	 	$sql = "select * from  __PREFIX__groups_goods where id=$id and goodsStatus=2 and dataFlag=1 ";
	 	$shopcart = $this->query($sql);
	 	for($i=0;$i<count($shopcart);$i++){
	 		$cgoods = $shopcart[$i];
	 		$goodsId = (int)$cgoods["goodsId"];
	 		$goodsAttrId = (int)$cgoods["goodsAttrId"];
	 		$sql = "SELECT  g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,g.shopPrice,g.attrCatId,shop.shopName,shop.qqNo,shop.deliveryType,shop.shopAtive,
			 		shop.shopTel,shop.shopAddress,shop.deliveryTime,shop.isInvoice, shop.deliveryStartMoney,
			 		shop.deliveryFreeMoney,shop.deliveryMoney ,g.goodsSn,shop.serviceStartTime,shop.serviceEndTime
			 		FROM __PREFIX__goods g, __PREFIX__shops shop
			 		WHERE g.goodsId = $goodsId AND g.shopId = shop.shopId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1 ";
	 		$goods = $this->queryRow($sql);
	 		if($goods==null)continue;
	 		
	 		$goods['goodsAttrId'] = 0;
	 			
	 		$goods["goodsStock"] = $cgoods["goodsStock"];
	 		$goods["cnt"] = $cnt;
	 		$goods["ischk"] = 1;
	 		
	 		$totalMoney = $goods["cnt"]*$cgoods["groupMoney"];
	 		$cartgoods[$goods["shopId"]]["ischk"] = 1;
	 		$goods["shopPrice"] = $cgoods["groupMoney"];
	 	
	 
	 		$cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
	 		$cartgoods[$goods["shopId"]]["shopId"] = $goods["shopId"];//店铺ID
	 		$cartgoods[$goods["shopId"]]["shopName"] = $goods["shopName"];//店铺名
	 		$cartgoods[$goods["shopId"]]["qqNo"] = $goods["qqNo"];//店铺名
	 		$cartgoods[$goods["shopId"]]["shopAtive"] = $goods["shopAtive"];
	 		$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
	 		$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
	 		$cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
	 		$cartgoods[$goods["shopId"]]["totalCnt"] = 1;
	 		$cartgoods[$goods["shopId"]]["totalMoney"] = $cgoods["groupMoney"];
	 	}
	 
	 	$cartInfo = array();
	 	$cartInfo["gtotalMoney"] = $totalMoney;
	 	$now = date("Y-m-d H:i:s");
	 	foreach($cartgoods as $key=> $cshop){
	 		$shopId = $cshop["shopId"];
	 		$cartgoods[$shopId]["hasConpon"] = 0;
	 		if($cshop["totalMoney"]<$cshop["deliveryFreeMoney"]){
	 			$totalMoney = $totalMoney + $cshop["deliveryMoney"];
	 		}
	 	}
	 
	 	$cartInfo["totalMoney"] = $totalMoney;
	 	$cartInfo["cartgoods"] = $cartgoods;
	 	return $cartInfo;
	 
	 }
	
	 
}