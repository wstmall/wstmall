<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 抢购服务类
 */
class PanicsModel extends BaseModel {


    /**
	 * 获取审核中的抢购
	 */
	public function queryPanicByPage(){
		$shopId=(int)session('WST_USER.shopId');
		$startDate = I('startDate');
		$endDate = I('endDate');
		$panicName = WSTAddslashes(I('panicName'));
		$sql = "select * from __PREFIX__panics where dataFlag=1 and shopId=".$shopId;
		if($panicName!=""){
			$sql .= " and panicName like '%".$panicName."%'";
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
		 array('panicName','require','请输入抢购活动名称!',1),
		 array('startTime','require','请输入抢购开始时间!',1),
		 array('endTime','require','请输入抢购结束时间!',1)
	);
		
	/**
	 * 新增抢购
	 */
	public function insert(){
	 
		$m = D('panics');
		$rd = $this->checkPanic();
	 	if($rd["status"]==1){
			if ($m->create()){
				$m->shopId = (int)session('WST_USER.shopId');
				$m->dataFlag = 1;
				$m->createTime=date('Y-m-d H:i:s');
				$panicId = $m->add();
				if(false !== $panicId){
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
	 * 编辑抢购信息
	 */
	public function edit(){
		
	 	$panicId = (int)I("panicId",0);
	 	$shopId = (int)session('WST_USER.shopId');
	 	$m = D('Panics');
	 	$rd = $this->checkPanic();
	 	if($rd["status"]==1){
	 		if ($m->create()){
	 			$m->where(array("shopId"=>$shopId,"panicId"=>$panicId))->save();
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
	
	public function checkPanic(){
		$rd = array('status'=>-1);
		$panicId = (int)I("panicId",0);
		$shopId = (int)session('WST_USER.shopId');
		$startTime = I("startTime");
		$endTime = I("endTime");
		$sql = "select * from __PREFIX__panics where shopId=$shopId and dataFlag=1 and startTime<='$startTime' and endTime>='$startTime'";
		if($panicId>0){
			$sql .= " and panicId<> $panicId";
		}
		$row = $this->queryRow($sql);
		if(!empty($row)){
			$rd["msg"] = "活动时间不能重叠";
		}else{
			$sql = "select * from __PREFIX__panics where shopId=$shopId and dataFlag=1 and startTime<='$endTime' and endTime>='$endTime'";
			if($panicId>0){
				$sql .= " and panicId<> $panicId";
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
	 * 获取抢购信息
	 */
	 public function get(){
	 	$where = array();
	 	$where["shopId"] = (int)session('WST_USER.shopId');
	 	$where["panicId"] = (int)I("panicId");
	 	$where["dataFlag"] = 1;
	 	$panic = M('panics')->where($where)->find();
	 	$now = date("Y-m-d H:i:s");
	 	$panic["editStatus"] = -1;
	 	$startTime = $panic["startTime"];
	 	if($startTime>$now){
	 		$panic["editStatus"] = 1;
	 	}
	 	return $panic;
	 }
	 
	 /**
	  * 删除抢购
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	$panicId = (int)I('id');
	 	$shopId = (int)session('WST_USER.shopId');
	 	$data = array();
		$data["dataFlag"] = -1;
		$rs = $this->where(array("shopId"=>$shopId,"panicId"=>$panicId))->save($data);
	    if(false !== $rs){
	    	M('panics_goods')->where(array("shopId"=>$shopId,"panicId"=>$panicId))->save($data);
			$rd['status']= 1;
		}
		return $rd;
	 }
	 
	 /**
	  * 获取审核中的抢购商品
	  */
	 public function queryPanicGoodsByPage(){
	 	$shopId=(int)session('WST_USER.shopId');
	 	$panicId = (int)I('panicId');
	 	$pcurr = (int)I("pcurr",0);
	 	$goodsName = I('goodsName');
	 	$sql = "select g.goodsName,g.goodsThums,g.shopPrice,p.* from __PREFIX__panics_goods p, __PREFIX__goods g 
	 			where p.panicId=$panicId and p.goodsId=g.goodsId and g.goodsFlag=1 and p.dataFlag=1 and p.shopId=".$shopId;
	 	if($goodsName!=""){
	 		$sql .= " and g.goodsName like '%".$goodsName."%'";
	 	}
	 	$rs = $this->pageQuery($sql,$pcurr);
	 	return $rs;
	 }
	 
	 /**
	  * 
	  */
	 public function getPanicGoodsByCat(){
	 	$shopId = (int)session('WST_USER.shopId');
	 	$catId = (int)I("catId");
	 	$panicId = (int)I("panicId");
	 	
	 	$pgoods = M('panics_goods')->where(array("shopId"=>$shopId,"panicId"=>$panicId,"dataFlag"=>1))->getField("goodsId",true);
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
	  * 添加抢购商品
	  */
	 public function addPanicGoods(){
	 	$rd = array('status'=>-1);
	 	$shopId = (int)session('WST_USER.shopId');
	 	$panicId = (int)I("panicId");
	 	$goodsIds = I("goodsIds");
	 	$ids = explode(",",$goodsIds);
	 	for($i=0,$k=count($ids);$i<$k;$i++){
	 		$goodsId = (int)$ids[$i];
	 		$data = array();
	 		$data["panicId"] = $panicId;
	 		$data["shopId"] = $shopId;
	 		$data["goodsId"] = $goodsId;
	 		$data["goodsStatus"] = 0;
	 		$data["dataFlag"] = 1;
	 		$data["createTime"] = date("Y-m-d H:i:s");
	 		M("panics_goods")->add($data);
	 	}
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 

	 /**
	  * 审核抢购商品
	  */
	 public function auditPanicGoods(){
	 	$rd = array('status'=>-1);
	 	$where = array();
	 	$where["shopId"] = (int)session('WST_USER.shopId');
	 	$where["id"] = (int)I("id");
	 	$data = array();
	 	$data["goodsStatus"] = 1;//审核通过
	 	$data["panicMoney"] = (float)I("panicMoney");
	 	$data["goodsStock"] = (int)I("goodsStock");
	 	$data["virtualBuyCnt"] = (int)I("virtualBuyCnt");
	 	M("panics_goods")->where($where)->save($data);
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 
	 /**
	  * 删除抢购商品
	  */
	 public function delPanicGoods(){
	 	$rd = array('status'=>-1);
	 	$where = array();
	 	$where["shopId"] = (int)session('WST_USER.shopId');
	 	$where["id"] = (int)I("id");
	 	$data = array();
	 	$data["dataFlag"] = -1;//删除
	 	M("panics_goods")->where($where)->save($data);
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 
	 /**
	  * 获取抢购首页列表
	  */
	 public function getPanicGoodsHome(){
	 	$areas= D('Home/Areas');
	 	$areaId2 = $areas->getDefaultCity();
	 	$now = date("Y-m-d H:i:s");
	 	$data = array();
	 	//进行中的商品
	 	$sql = "select gp.id,g.goodsId,g.goodsName,gp.panicMoney,gp.goodsStock,gp.saleCnt,gp.virtualBuyCnt,g.goodsThums,g.shopPrice,p.startTime,p.endTime from __PREFIX__panics p, __PREFIX__panics_goods gp, __PREFIX__goods g, __PREFIX__shops sp
	 			where (sp.areaId2=$areaId2 or sp.isDistributAll=1) and sp.shopId=p.shopId and gp.panicId = p.panicId and g.goodsId=gp.goodsId and p.startTime<='$now' and p.endTime>='$now' and gp.goodsStatus=2 and gp.dataFlag=1  and g.goodsFlag = 1 and g.isSale=1
	 			order by gp.sortNo , p.startTime limit 20 ";
	 	$rs = $this->query($sql);
	 	$data["inlist"] = $rs;
	 	//即将开始的商品
	 	$sql = "select gp.id,g.goodsId,g.goodsName,gp.panicMoney,gp.goodsStock,gp.saleCnt,gp.virtualBuyCnt,g.goodsThums,g.shopPrice,p.startTime,p.endTime from __PREFIX__panics p, __PREFIX__panics_goods gp, __PREFIX__goods g, __PREFIX__shops sp
			 	where (sp.areaId2=$areaId2 or sp.isDistributAll=1) and sp.shopId=p.shopId and gp.panicId = p.panicId and g.goodsId=gp.goodsId and p.startTime>'$now' and gp.goodsStatus=2 and gp.dataFlag=1 and g.goodsFlag = 1 and g.isSale=1
			 	order by gp.sortNo , p.startTime limit 20 ";
	 	$rs = $this->query($sql);
	 	$data["nextlist"] = $rs;
	 	return $data;
	 }
	 
	 /**
	  * 获取抢购首页列表
	  */
	 public function getPanicGoodsByPage(){
	 	$areas= D('Home/Areas');
	 	$areaId2 = $areas->getDefaultCity();
	 	$pcurr = (int)I("pcurr",0);
	 	$catId1 = (int)I("catId1",0);
	 	$catId2 = (int)I("catId2",0);
	 	$panicType = (int)I("panicType",1);
	 	$now = date("Y-m-d H:i:s");
	 	$sql = "select gp.id,g.goodsId,g.goodsName,gp.panicMoney,gp.goodsStock,gp.saleCnt,gp.virtualBuyCnt,g.goodsThums,g.shopPrice,p.startTime,p.endTime from __PREFIX__panics p, __PREFIX__panics_goods gp, __PREFIX__goods g, __PREFIX__shops sp
	 			where (sp.areaId2=$areaId2 or sp.isDistributAll=1) and sp.shopId=p.shopId and gp.panicId = p.panicId and g.goodsId=gp.goodsId and gp.goodsStatus=2 and gp.dataFlag=1 and g.goodsFlag = 1 and g.isSale=1 ";
	 	if($panicType==2){
	 		$sql .= " and p.startTime>'$now' ";
	 	}else{
	 		$sql .= " and p.startTime<='$now' and p.endTime>='$now'  ";
	 	}
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
	 
	 
	 public function getPanicInfo(){
	 
	 	$mgoods = D('Home/Goods');
	 	$userId = (int)session('WST_USER.userId');
	 	$totalMoney = 0;
	 	$cartgoods = array();
	 	$id = (int)session("WST_panic_id");
	 	$cnt = (int)session("WST_panic_cnt");
	 	
	 	$sql = "select * from  __PREFIX__panics_goods where id=$id and goodsStatus=2 and dataFlag=1 ";
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
	 		
	 		$totalMoney = $goods["cnt"]*$cgoods["panicMoney"];
	 		$cartgoods[$goods["shopId"]]["ischk"] = 1;
	 		$goods["shopPrice"] = $cgoods["panicMoney"];
	 	
	 
	 		$cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
	 		$cartgoods[$goods["shopId"]]["shopId"] = $goods["shopId"];//店铺ID
	 		$cartgoods[$goods["shopId"]]["shopName"] = $goods["shopName"];//店铺名
	 		$cartgoods[$goods["shopId"]]["qqNo"] = $goods["qqNo"];//店铺名
	 		$cartgoods[$goods["shopId"]]["shopAtive"] = $goods["shopAtive"];
	 		$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
	 		$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
	 		$cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
	 		$cartgoods[$goods["shopId"]]["totalCnt"] = 1;
	 		$cartgoods[$goods["shopId"]]["totalMoney"] = $cgoods["panicMoney"];
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