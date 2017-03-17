<?php
namespace Common\Model;
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
	  * 获取抢购首页列表
	  */
	 public function getPanicGoodsByPage(){
	 	$areas= D('Home/Areas');
	 	$areaId2 = $areas->getDefaultCity();
	 	$pcurr = (int)I("pcurr",0);
	 	$catId1 = (int)I("catId1",0);
	 	$catId2 = (int)I("catId2",0);
	 	$now = date("Y-m-d H:i:s");
	 	$sql = "select gp.id,g.goodsId,g.goodsName,gp.panicMoney,gp.goodsStock,gp.virtualBuyCnt,g.goodsThums,g.shopPrice,p.startTime,p.endTime from __PREFIX__panics p, __PREFIX__panics_goods gp, __PREFIX__goods g, __PREFIX__shops sp
	 			where (sp.areaId2=$areaId2 or sp.isDistributAll=1) and sp.shopId=p.shopId and gp.panicId = p.panicId and g.goodsId=gp.goodsId and p.startTime<='$now' and p.endTime>='$now' and gp.goodsStatus=2 and gp.dataFlag=1 and g.goodsFlag = 1 and g.isSale=1 ";
	 	if($catId1>0){
	 		$sql .= " and g.goodsCatId1= $catId1 ";
	 	}
	 	if($catId2>0){
	 		$sql .= " and g.goodsCatId2= $catId2 ";
	 	}
	 	$sql .= " order by gp.sortNo , p.startTime  ";
	 	$rs = $this->pageQuery($sql,$pcurr,8);
	 	return $rs;
	 }
	 
	 public function getPanicGoods(){
	 	$id = (int)I("id",0);
	 	$sql = "select gp.id,gp.goodsId,gp.panicMoney,gp.goodsStock,gp.saleCnt,gp.virtualBuyCnt,p.startTime,p.endTime,panicDes from __PREFIX__panics p, __PREFIX__panics_goods gp 
	 			where gp.id = $id and gp.panicId = p.panicId";
	 	$panic = $this->queryRow($sql);
	 	$now = date("Y-m-d H:i:s");
	 	if(!empty($panic)){
	 		if($panic["startTime"]>$now){
	 			$panic["buyStatus"] = -1;
	 		}else if($panic["endTime"]<$now){
	 			$panic["buyStatus"] = -2;
	 		}else if($panic["goodsStock"]<=$panic["saleCnt"]){
	 			$panic["buyStatus"] = -3;
	 		}else{
	 			$panic["buyStatus"] = 1;
	 		}
	 	}
	 	return $panic;
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
	 
	 
	/**
	 * 检测抢购商品能不能购买
	 */
	public function checkPanicGoods($id=0,$cnt=0){
		$rd = array('status'=>-1);
		$now = date("Y-m-d H:i:s");
		$id = ($id>0)?$id:(int)I("id");
		$cnt = ($cnt>0)?$cnt:(int)I("cnt",1);
		$sql = "select gp.id,gp.goodsId,gp.panicMoney,gp.goodsStock,gp.saleCnt,gp.virtualBuyCnt,p.startTime,p.endTime from __PREFIX__panics p, __PREFIX__panics_goods gp,__PREFIX__goods g
				where gp.id = $id and gp.panicId = p.panicId and gp.goodsId = g.goodsId and gp.goodsStatus=2 and gp.dataFlag = 1 and g.goodsFlag = 1 and g.isSale=1 ";
		$panic = $this->queryRow($sql);
		if(!empty($panic)){
			if($panic["startTime"]>$now){
				$rd["msg"] = "Sorry,该抢购活动未开始，请耐心等待！";
			}else if($panic["endTime"]<$now){
				$rd["msg"] = "Sorry,该抢购活动已结束！";
			}else if($panic["goodsStock"]==0){
				$rd["msg"] = "Sorry,该抢购商品已被抢购完！";
			}else if(($panic["goodsStock"])<$cnt){
				$rd["msg"] = "Sorry,该抢购商品仅剩".$panic["goodsStock"]."件，库存不足！";
			}else{
				$rd["status"] = 1;
			}
		}else{
			$rd["msg"] = "Sorry,抢购商品不存在！";
		}
		return $rd;
	}
	
	/**
	 * 支付时检测抢购商品能不能购买
	 */
	public function checkPanicPay($id,$cnt){
		$rd = array('status'=>-1);
		$now = date("Y-m-d H:i:s");
		$sql = "select gp.id,gp.goodsId,gp.panicMoney,gp.goodsStock,gp.saleCnt,gp.virtualBuyCnt,p.startTime,p.endTime from __PREFIX__panics p, __PREFIX__panics_goods gp,__PREFIX__goods g
				where gp.id = $id and gp.panicId = p.panicId and gp.goodsId = g.goodsId and gp.goodsStatus=2 and gp.dataFlag = 1 and g.goodsFlag = 1 and g.isSale=1 ";
		$panic = $this->queryRow($sql);
		if(!empty($panic)){
			if($panic["startTime"]>$now){
				$rd["msg"] = "抢购失败，支付的金额已返回您的钱包！";
			}else if($panic["endTime"]<$now){
				$rd["msg"] = "抢购失败，该活动已结束，支付的金额已返回您的钱包！";
			}else if($panic["goodsStock"]==0){
				$rd["msg"] = "抢购失败，商品库存不足，支付的金额已返回您的钱包！";
			}else if(($panic["goodsStock"])<$cnt){
				$rd["msg"] = "抢购失败，商品库存不足，支付的金额已返回您的钱包！";
			}else{
				$rd["status"] = 1;
			}
		}else{
			$rd["msg"] = "抢购失败，支付的金额已返回您的钱包！";
		}
		return $rd;
	}
	
	/**
	 * 核对商品信息
	 */
	public function checkPanicStock(){
		$id = (int)session("WST_panic_id");
		$cnt = (int)session("WST_panic_cnt");
		$mgoods = D('Home/Goods');
		$goodsStock = array();
		$sql = "select * from __PREFIX__panics_goods where id = $id and goodsStatus=2 and dataFlag = 1";
		$panic = $this->queryRow($sql);
		$goodsId = $panic["goodsId"];
		$goods = $mgoods->getGoodsInfo($goodsId,0);
		$goods["cnt"] = $cnt;
		$goods["goodsStock"] = $panic["goodsStock"];
		$goodsStock[] = $goods;
	
		return $goodsStock;
	}
	 
}