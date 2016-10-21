<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 购物车服务类
 */
class CartModel extends BaseModel {

	/**
	 * 添加[正常]商品到购物车
	 */
	public function addToCart(){
		$rd = array('status'=>-1);
		$m = M('cart');
		//判断一下该商品是否正常	出售
		$userId = (int)session('WST_USER.userId');
		$goodsId = (int)I("goodsId");
		$goodsAttrId = (int)I("goodsAttrId");
        $goods = D('Home/Goods')->getGoodsSimpInfo($goodsId,$goodsAttrId);
        if(empty($goods))return array('status'=>-1,'msg'=>'找不到指定的商品!');
        if($goods['goodsStock']<=0)return array('status'=>-1,'msg'=>'对不起，商品'.$goods['goodsName'].'库存不足!');
		$goodsCnt = ((int)I("gcount")>0)?(int)I("gcount"):1;
		$isCheck = 1;
		$rs = false;
		$sql = "select * from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId and packageId=0";
		$row = $this->queryRow($sql);
		if($row["cartId"]>0){
			$data = array();
			$data["goodsCnt"] = $row["goodsCnt"]+$goodsCnt;
			$rs = $m->where("userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId and packageId=0")->save($data);
			
		}else{
			$data = array();
			$data["userId"] = $userId;
			$data["goodsId"] = $goodsId;
			$data["isCheck"] = $isCheck;
			$data["goodsAttrId"] = $goodsAttrId;
			$data["goodsCnt"] = $goodsCnt;
			$rs = $m->add($data);
		}
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	}
	
	/**
	 * 添加优惠套餐商品到购物车
	 */
	public function addCartPackage(){
		$rd = array('status'=>-1);
		$m = M('cart');
		$status = 1;
		//判断一下该商品是否正常	出售
		$batchNo = time();
		$userId = (int)session('WST_USER.userId');
		$goodsAttrIds = WSTAddslashes(I("goodsAttrIds"));
		$packageId = (int)I("packageId");
		$sql = "select batchNo from __PREFIX__cart where userId=$userId and packageId=$packageId group by batchNo";
		$packages = $this->query($sql);
		
		$vbatchNo = 0;
		$flag = 1;
		$gattrIds = explode("@",$goodsAttrIds);
		if(count($packages)>0){
			for($i=0,$k=count($packages);$i<$k;$i++){
				$vbatchNo = $packages[$i]["batchNo"];
				for($j=0,$v=count($gattrIds);$j<$v;$j++){
					$gIds = explode("_",$gattrIds[$j]);
					$goodsId = (int)$gIds[0];
					$goodsAttrId = (int)$gIds[1];
					$sql = "select cartId from __PREFIX__cart where userId=$userId and packageId=$packageId and batchNo=$vbatchNo and goodsId=$goodsId and goodsAttrId=$goodsAttrId";
					$row = $this->queryRow($sql);
					if(!$row["cartId"]){
						$flag = 0;
					}
				}
				if($flag==1){
					break;
				}
			}
		}else{
			$flag = 0;
		}
		if($flag==0){//添加
			for($i=0,$k=count($gattrIds);$i<$k;$i++){
				$gIds = explode("_",$gattrIds[$i]);
				$goodsId = (int)$gIds[0];
				$goodsAttrId = (int)$gIds[1];
				$goodsCnt = ((int)$gIds[2]>0)?(int)$gIds[2]:1;
			
				$goods = D('Home/Goods')->getGoodsSimpInfo($goodsId,$goodsAttrId);
				if(empty($goods)){
					self::delCartPackage($userId,$packageId,$batchNo);
					return array('status'=>-1,'msg'=>'找不到指定的商品!');
				}
				if($goods['goodsStock']<=$goodsCnt){
					self::delCartPackage($userId,$packageId,$batchNo);
					return array('status'=>-1,'msg'=>'对不起，商品'.$goods['goodsName'].'库存不足!');
				}
				$goodsCnt = ($goodsCnt>0)?$goodsCnt:1;
				$isCheck = 1;
				$data = array();
				$data["userId"] = $userId;
				$data["goodsId"] = $goodsId;
				$data["isCheck"] = $isCheck;
				$data["goodsAttrId"] = $goodsAttrId;
				$data["goodsCnt"] = $goodsCnt;
				$data["packageId"] = $packageId;
				$data["batchNo"] = $batchNo;
				$rs = $m->add($data);
				if(false == $rs){
					self::delCartPackage($userId,$packageId,$batchNo);
					return array('status'=>-1,'msg'=>'加入购物车失败!');
				}
			}
		}else{//修改
			$cartIds = array();
			$cartIds[] = 0;
			for($i=0,$k=count($gattrIds);$i<$k;$i++){
				$gIds = explode("_",$gattrIds[$i]);
				$goodsId = (int)$gIds[0];
				$goodsAttrId = (int)$gIds[1];
				$goodsCnt = ((int)$gIds[2]>0)?(int)$gIds[2]:1;
					
				$goods = D('Home/Goods')->getGoodsSimpInfo($goodsId,$goodsAttrId);
				if(empty($goods)){
					self::updCartPackage($userId, $cartIds, $goodsCnt);
					return array('status'=>-1,'msg'=>'找不到指定的商品!');
				}
				if($goods['goodsStock']<=$goodsCnt){
					self::updCartPackage($userId, $cartIds, $goodsCnt);
					return array('status'=>-1,'msg'=>'对不起，商品'.$goods['goodsName'].'库存不足!');
				}
				
				$sql = "select cartId from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId and packageId=$packageId and batchNo=$vbatchNo";
				$row = $this->queryRow($sql);
				
				$cartId = (int)$row["cartId"];
				$cartIds[] = $cartId;
				$sql = "update __PREFIX__cart set goodsCnt=goodsCnt+$goodsCnt  where cartId=$cartId";
				$this->execute($sql);
			}
		}
		$rd["status"] = 1;
		return $rd;
	}
	
	public function delCartPackage($userId,$packageId,$batchNo){
		$sql = "delete from __PREFIX__cart where userId=$userId and packageId=$packageId and batchNo=$batchNo";
		$this->execute($sql);
	}
	
	public function updCartPackage($userId, $cartIds, $goodsCnt){
		
		$cartIds = implode(",",$cartIds);
		$sql = "update __PREFIX__cart set goodsCnt=goodsCnt-$goodsCnt where userId=$userId and cartId in ($cartIds) ";
		$this->execute($sql);
	}
	
	/**
	 * 获取商品信息
	 */
	public function getGoodsInfo($goodsId,$goodsAttrId = 0){
		$sql = "SELECT g.attrCatId,g.goodsId,g.goodsSn,g.goodsName,g.goodsThums,g.shopId,g.marketPrice,g.shopPrice,g.goodsStock,g.bookQuantity,g.isBook,sp.shopName,sp.shopAtive
				FROM __PREFIX__goods g ,__PREFIX__shops sp WHERE g.shopId=sp.shopId AND goodsFlag=1 and isSale=1 and goodsStatus=1 and g.goodsId = $goodsId";
		$goodslist = $this->queryRow($sql);
		//如果商品有价格属性的话则获取其价格属性
		if(!empty($goodslist) && $goodslist['attrCatId']>0){
			$sql = "select ga.id,ga.attrPrice,ga.attrStock,a.attrName,ga.attrVal,ga.attrId from __PREFIX__attributes a,__PREFIX__goods_attributes ga
			        where a.attrId=ga.attrId and a.catId=".$goodslist['attrCatId']." and a.isPriceAttr=1 
			        and ga.goodsId=".$goodslist['goodsId']." and id=".$goodsAttrId;
			$priceAttrs = $this->queryRow($sql);
			if(!empty($priceAttrs)){
				$goodslist['attrId'] = $priceAttrs['attrId'];
				$goodslist['goodsAttrId'] = $priceAttrs['id'];
				$goodslist['attrName'] = $priceAttrs['attrName'];
				$goodslist['attrVal'] = $priceAttrs['attrVal'];
				$goodslist['shopPrice'] = $priceAttrs['attrPrice'];
				$goodslist['goodsStock'] = $priceAttrs['attrStock'];
			}
		}
		$goodslist['goodsAttrId'] = (int)$goodslist['goodsAttrId'];
		return $goodslist;
	}
	
	/**
	 * 获取购物车信息
	 */
	public function getCartInfo(){
		
		$mgoods = D('Home/Goods');
		$userId = (int)session('WST_USER.userId');
		$totalMoney = 0;
		$cartgoods = array();
		
		$sql = "select * from __PREFIX__cart where userId = $userId and packageId>0 group by batchNo";
		$shopcart = $this->query($sql);
		for($i=0;$i<count($shopcart);$i++){
			$cgoods = $shopcart[$i];
			$package = array();
			$batchNo = $cgoods["batchNo"];
			$package["batchNo"] = $batchNo;
			$pkgShopPrice = 0;
			$pckMinStock = 0;
			$ischk = 0;
			$sql = "select * from __PREFIX__cart where userId = $userId and batchNo=$batchNo";
			$pkgList = $this->query($sql);
			for($i=0;$i<count($pkgList);$i++){
				$pgoods = $pkgList[$i];
				$packageId = $pgoods["packageId"];
				$goodsId = (int)$pgoods["goodsId"];
				$package["packageId"] = $packageId;
				$package["goodsCnt"] = (int)$pgoods["goodsCnt"];
				
				$sql = "select p.shopId, p.packageName, gp.diffPrice from __PREFIX__goods_packages gp, __PREFIX__packages p where p.packageId =$packageId and gp.packageId=p.packageId and gp.goodsId = $goodsId";
				$pkg = $this->queryRow($sql);
				
				$diffPrice = (float)$pkg["diffPrice"];
				if($pkg["shopId"]>0){
					$package["packageName"] = $pkg["packageName"];
					$package["shopId"] = $pkg["shopId"];
				}
				$goodsAttrId = (int)$pgoods["goodsAttrId"];
				$sql = "SELECT  g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,g.shopPrice,g.attrCatId,shop.shopName,shop.qqNo,shop.deliveryType,shop.shopAtive,
						shop.shopTel,shop.shopAddress,shop.deliveryTime,shop.isInvoice, shop.deliveryStartMoney,
						shop.deliveryFreeMoney,shop.deliveryMoney ,g.goodsSn,shop.serviceStartTime,shop.serviceEndTime
						FROM __PREFIX__goods g, __PREFIX__shops shop
						WHERE g.goodsId = $goodsId AND g.shopId = shop.shopId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1 ";
				$goods = $this->queryRow($sql);
				if($goods==null)continue;
				//如果商品有价格属性的话则获取其价格属性
				if(!empty($goods) && $goods['attrCatId']>0){
						
					$sql = "select ga.id,ga.attrPrice,ga.attrStock,a.attrName,ga.attrVal,ga.attrId from __PREFIX__attributes a,__PREFIX__goods_attributes ga
				         	where a.attrId=ga.attrId and a.catId=".$goods['attrCatId']." and a.isPriceAttr=1
				          	and ga.goodsId=".$goodsId." and id=".$goodsAttrId;
					$priceAttrs = $this->queryRow($sql);
					if(!empty($priceAttrs)){
						$goods['goodsAttrId'] = $priceAttrs['id'];
						$goods['attrName'] = $priceAttrs['attrName'];
						$goods['attrVal'] = $priceAttrs['attrVal'];
						$goods['oshopPrice'] = $priceAttrs['attrPrice'];
						$goods['shopPrice'] = ($priceAttrs['attrPrice']>$diffPrice)?($priceAttrs['attrPrice']-$diffPrice):$priceAttrs['attrPrice'];
						$goods['goodsStock'] = $priceAttrs['attrStock'];
						$pckMinStock = ($pckMinStock==0 || $goods['goodsStock']<$pckMinStock)?$goods['goodsStock']:$pckMinStock;
						$pkgShopPrice += $goods['shopPrice'];
					}
				}else{
					$goods['oshopPrice'] = $goods['shopPrice'];
					$goods['shopPrice'] = ($goods['shopPrice']>$diffPrice)?($goods['shopPrice']-$diffPrice):$goods['shopPrice'];
					$pckMinStock = ($pckMinStock==0 || $goods['goodsStock']<$pckMinStock)?$goods['goodsStock']:$pckMinStock;
					$pkgShopPrice += $goods['shopPrice'];
				}
				$goods['goodsAttrId'] = (int)$goods['goodsAttrId'];
				
				$goods["cnt"] = $pgoods["goodsCnt"];
				
				$goods["ischk"] = $pgoods["isCheck"];
				if($goods["ischk"]==1){
					$ischk = 1;
					$totalMoney += $goods["cnt"]*$goods["shopPrice"];
					$cartgoods[$goods["shopId"]]["ischk"] = 1;
				}
				
				$package["goods"][] = $goods;
				$cartgoods[$goods["shopId"]]["shopId"] = $goods["shopId"];//店铺ID
				$cartgoods[$goods["shopId"]]["shopName"] = $goods["shopName"];//店铺名
				$cartgoods[$goods["shopId"]]["qqNo"] = $goods["qqNo"];//店铺名
				$cartgoods[$goods["shopId"]]["shopAtive"] = $goods["shopAtive"];
				$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
				$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
				$cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
				$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cgoods["goodsCnt"];
				$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+(($goods["ischk"]==1)?$goods["cnt"]*$goods["shopPrice"]:0);
			}
			$package["goodsStock"] = $pckMinStock;
			$package["shopPrice"] = $pkgShopPrice;
			$package["ischk"] = $ischk;
			$cartgoods[$goods["shopId"]]["packages"][] = $package;
			
		}
		
		$sql = "select * from __PREFIX__cart where userId = $userId and packageId=0";
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
		    //如果商品有价格属性的话则获取其价格属性
		    if(!empty($goods) && $goods['attrCatId']>0){
		    	
			    $sql = "select ga.id,ga.attrPrice,ga.attrStock,a.attrName,ga.attrVal,ga.attrId from __PREFIX__attributes a,__PREFIX__goods_attributes ga
			             where a.attrId=ga.attrId and a.catId=".$goods['attrCatId']." and a.isPriceAttr=1 
			             and ga.goodsId=".$goodsId." and id=".$goodsAttrId;
				$priceAttrs = $this->queryRow($sql);
				if(!empty($priceAttrs)){
					$goods['goodsAttrId'] = $priceAttrs['id'];
					$goods['attrName'] = $priceAttrs['attrName'];
					$goods['attrVal'] = $priceAttrs['attrVal'];
					$goods['shopPrice'] = $priceAttrs['attrPrice'];
					$goods['goodsStock'] = $priceAttrs['attrStock'];
				}
			}
			$goods['goodsAttrId'] = (int)$goods['goodsAttrId'];
			
			if($goods["isBook"]==1){
				$goods["goodsStock"] = $goods["goodsStock"]+$goods["bookQuantity"];
			}
			$goods["cnt"] = $cgoods["goodsCnt"];
			$goods["ischk"] = $cgoods["isCheck"];
			if($goods["ischk"]==1){
				$totalMoney += $goods["cnt"]*$goods["shopPrice"];
				$cartgoods[$goods["shopId"]]["ischk"] = 1;
			}

			$cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
			$cartgoods[$goods["shopId"]]["shopId"] = $goods["shopId"];//店铺ID
			$cartgoods[$goods["shopId"]]["shopName"] = $goods["shopName"];//店铺名
			$cartgoods[$goods["shopId"]]["qqNo"] = $goods["qqNo"];//店铺名
			$cartgoods[$goods["shopId"]]["shopAtive"] = $goods["shopAtive"];
			$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
			$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
			$cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
			$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cgoods["goodsCnt"];
			$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+(($goods["ischk"]==1)?$goods["cnt"]*$goods["shopPrice"]:0);
		}

		$cartInfo = array();
		$cartInfo["gtotalMoney"] = $totalMoney;
		
		foreach($cartgoods as $key=> $cshop){
			if($cshop["totalMoney"]<$cshop["deliveryFreeMoney"] && $cshop["ischk"]==1){
				$totalMoney = $totalMoney + $cshop["deliveryMoney"];
			}
		}
		
		$cartInfo["totalMoney"] = $totalMoney;
		$cartInfo["cartgoods"] = $cartgoods;
		//print_r($cartInfo);
		return $cartInfo;
		
	}
   
	public function getPayCart(){
		
		$userId = (int)session('WST_USER.userId');
		$mgoods = D('Home/Goods');
		$maddress = D('Home/UserAddress');
		
		$cartgoods = array();
		
		$shopColleges = array();
		$distributAll = array();
		$startTime = 0;
		$endTime = 24;
		
		$gtotalMoney = 0;//商品总价（去除配送费）
		$totalMoney = 0;//商品总价（含配送费）
		$totalCnt = 0;
		
		$sql = "select * from __PREFIX__cart where userId = $userId and packageId>0 group by batchNo";
		$shopcart = $this->query($sql);
		for($i=0;$i<count($shopcart);$i++){
			$cgoods = $shopcart[$i];
			$package = array();
			$batchNo = $cgoods["batchNo"];
			$package["batchNo"] = $batchNo;
			$pkgShopPrice = 0;
			$pckMinStock = 0;
			$ischk = 0;
			$sql = "select * from __PREFIX__cart where userId = $userId and batchNo=$batchNo";
			$pkgList = $this->query($sql);
			for($i=0;$i<count($pkgList);$i++){
				$pgoods = $pkgList[$i];
				$packageId = $pgoods["packageId"];
				$goodsId = (int)$pgoods["goodsId"];
				$package["packageId"] = $packageId;
				$package["goodsCnt"] = (int)$pgoods["goodsCnt"];
		
				$sql = "select p.shopId, p.packageName, gp.diffPrice from __PREFIX__goods_packages gp, __PREFIX__packages p where p.packageId =$packageId and gp.packageId=p.packageId and gp.goodsId = $goodsId";
				$pkg = $this->queryRow($sql);
		
				$diffPrice = (float)$pkg["diffPrice"];
				if($pkg["shopId"]>0){
					$package["packageName"] = $pkg["packageName"];
					$package["shopId"] = $pkg["shopId"];
				}
				$goodsAttrId = (int)$pgoods["goodsAttrId"];
				$obj["goodsId"] = $goodsId;
				$obj["goodsAttrId"] = $goodsAttrId;
				$goods = $mgoods->getGoodsForCheck($obj);
				
				$goods['oshopPrice'] = $goods['shopPrice'];
				$goods['shopPrice'] = ($goods['shopPrice']>$diffPrice)?($goods['shopPrice']-$diffPrice):$goods['shopPrice'];
				$pckMinStock = ($pckMinStock==0 || $goods['goodsStock']<$pckMinStock)?$goods['goodsStock']:$pckMinStock;
				$pkgShopPrice += $goods['shopPrice'];
				

				$goods["cnt"] = $pgoods["goodsCnt"];
				$goods["ischk"] = $pgoods["isCheck"];
				$totalMoney += $goods["cnt"]*$goods["shopPrice"];
				$cartgoods[$goods["shopId"]]["ischk"] = 1;
				$package["goods"][] = $goods;
		
				$distributAll[$package["shopId"]] = $goods["isDistributAll"];
				
				$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
				$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
				$cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
				$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cgoods["goodsCnt"];
				$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
			}
			
			$ommunitysId = $maddress->getShopCommunitysId($package["shopId"]);
			$shopColleges[$package["shopId"]] = $ommunitysId;
					
			$package["goodsStock"] = $pckMinStock;
			$package["shopPrice"] = $pkgShopPrice;
			$cartgoods[$goods["shopId"]]["packages"][] = $package;
				
		}
		
		$sql = "select * from __PREFIX__cart where userId = $userId and isCheck=1 and goodsCnt>0 and packageId=0";
		$shopcart = $this->query($sql);
		
		for($i=0;$i<count($shopcart);$i++){
			$cgoods = $shopcart[$i];
			$obj["goodsId"] = (int)$cgoods["goodsId"];
			$obj["goodsAttrId"] = (int)$cgoods["goodsAttrId"];
			
			$goods = $mgoods->getGoodsForCheck($obj);
			if($goods["isBook"]==1){
				$goods["goodsStock"] = $goods["goodsStock"]+$goods["bookQuantity"];
			}
			$goods["ischk"] = $cgoods["isCheck"];
			$goods["cnt"] = $cgoods["goodsCnt"];
			$totalCnt += $cgoods["goodsCnt"];
			$totalMoney += $goods["cnt"]*$goods["shopPrice"];
			$gtotalMoney += $goods["cnt"]*$goods["shopPrice"];
			$ommunitysId = $maddress->getShopCommunitysId($goods["shopId"]);
			$shopColleges[$goods["shopId"]] = $ommunitysId;
			$distributAll[$goods["shopId"]] = $goods["isDistributAll"];
			if($startTime<$goods["startTime"]){
				$startTime = $goods["startTime"];
			}
			if($endTime>$goods["endTime"]){
				$endTime = $goods["endTime"];
			}
		
			$cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
			$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
			$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
			$cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
			$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cgoods["goodsCnt"];
			$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
			
		}
		
		foreach($cartgoods as $key=> $cshop){
			if($cshop["totalMoney"]<$cshop["deliveryFreeMoney"]){
				$totalMoney = $totalMoney + $cshop["deliveryMoney"];
			}
		}
		
		if(empty($cartgoods)){
			$rdata["cartnull"] = 1;
			return $rdata;
		}
		$rdata["totalMoney"] = $totalMoney;
		$rdata["totalCnt"] = $totalCnt;
		$rdata["gtotalMoney"] = $gtotalMoney;
		$rdata["cartgoods"] = $cartgoods;
		$rdata["distributAll"] = $distributAll;
		$rdata["shopColleges"] = $shopColleges;
		$rdata["startTime"] = $startTime;
		$rdata["endTime"] = $endTime;
		return $rdata;
	}
	/**
	 * 检测购物车中商品库存
	 */
	public function checkCatGoodsStock(){

		$mgoods = D('Home/Goods');
		$userId = (int)session('WST_USER.userId');
		$cartgoods = array();
		$sql = "select * from __PREFIX__cart where userId = $userId";
		$shopcart = $this->query($sql);
		
		for($i=0;$i<count($shopcart);$i++){
			$cgoods = $shopcart[$i];
			$goodsId = (int)$cgoods["goodsId"];
			$goodsAttrId = (int)$cgoods["goodsAttrId"];
			
			$obj = array();
			$obj["goodsId"] = $goodsId;
			$obj["goodsAttrId"] = $goodsAttrId;
			$goods = $mgoods->getGoodsStock($obj);
			if($goods["isBook"]==1){
				$goods["goodsStock"] = $goods["goodsStock"]+$goods["bookQuantity"];
			}
			$goods['goodsAttrId'] = $goodsAttrId;
			$goods["cnt"] = $cgoods["goodsCnt"];
			$goods["stockStatus"] = ($goods["goodsStock"]>=$goods["cnt"])?1:0;		
			$cartgoods[] = $goods;
		}

		return $cartgoods;
		
	}
	
	/**
	 * 核对商品信息
	 */
	public function checkGoodsStock(){
	
		$mgoods = D('Home/Goods');
		$userId = (int)session('WST_USER.userId');
		$cartgoods = array();
		$sql = "select * from __PREFIX__cart where userId = $userId and isCheck=1 ";
		$shopcart = $this->query($sql);
	
		for($i=0;$i<count($shopcart);$i++){
			$cgoods = $shopcart[$i];
			$goodsId = (int)$cgoods["goodsId"];
			$goodsAttrId = (int)$cgoods["goodsAttrId"];
				
			$goods = $mgoods->getGoodsInfo($goodsId,$goodsAttrId);
			if($goods["isBook"]==1){
				$goods["goodsStock"] = $goods["goodsStock"]+$goods["bookQuantity"];
			}
			$goods['goodsAttrId'] = $goodsAttrId;
			$goods["cnt"] = $cgoods["goodsCnt"];
			$cartgoods[] = $goods;
		}
	
		return $cartgoods;
	
	}
	
	
	
	
	
	/**
	 * 删除购物车中的商品
	 */
	public function delCartGoods(){
		$rd = array('status'=>-1);
		$userId = (int)session('WST_USER.userId');
		$goodsId = (int)I("goodsId");
		$goodsAttrId = (int)I("goodsAttrId");
		$sql = "delete from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId and packageId=0";
		$rs = $this->execute($sql);
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	}
	
	/**
	 * 删除购物车中的商品
	 */
	public function delPckCatGoods(){
		$rd = array('status'=>-1);
		$userId = (int)session('WST_USER.userId');
		$packageId = (int)I("packageId");
		$batchNo = (int)I("batchNo");
		$sql = "delete from __PREFIX__cart where userId=$userId and packageId=$packageId and batchNo=$batchNo";
		$rs = $this->execute($sql);
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	}
	
	/**
	 * 修改购物车中的商品数量
	 * 
	 */
	public function changeCartGoodsnum($goodsCnt){
		
		$rd = array('status'=>-1);
		$m = M('cart');
		//判断一下该商品是否正常	出售
		$userId = (int)session('WST_USER.userId');
		$goodsId = (int)I("goodsId");
		$goodsAttrId = (int)I("goodsAttrId");

		//$goodsCnt = abs((int)I("num"));
		$isCheck = (int)I("ischk",0);
		$sql = "select * from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId and packageId=0 ";
		$row = $this->queryRow($sql);
		if($row["cartId"]>0){
			$data = array();
			$data["isCheck"] = $isCheck;
			$data["goodsCnt"] = $goodsCnt;
			$rs = $m->where("userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId and packageId=0 ")->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	}
	
	/**
	 * 修改购物车中的商品数量(套餐)
	 *
	 */
	public function changePkgCartGoodsNum($goodsCnt){
	
		$rd = array('status'=>-1);
		$m = M('cart');
		//判断一下该商品是否正常	出售
		$userId = (int)session('WST_USER.userId');
		$packageId = (int)I('packageId');
		$batchNo = (int)I('batchNo');
		$isCheck = (int)I("ischk",0);
		
		$data = array();
		$data["isCheck"] = $isCheck;
		$data["goodsCnt"] = $goodsCnt;
		$rs = $m->where("userId=$userId and packageId=$packageId and batchNo=$batchNo")->save($data);
		if(false !== $rs){
			$rd['status']= 1;
		}
		
		return $rd;
	}
	
}