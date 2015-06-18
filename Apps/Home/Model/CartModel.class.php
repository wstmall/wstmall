<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 购物车服务类
 */
use Think\Model;
class CartModel extends BaseModel {
	
	/**
	 * 添加[正常]商品到购物车
	 */
	public function addToCart(){
		//判断一下该商品是否正常	出售
		$goodsInfo = self::getGoodsInfo((int)I("goodsId"));
		if($goodsInfo['goodsId']=='')return array();
		$goodsInfo["cnt"] = ((int)I("gcount")>0)?(int)I("gcount"):1;
		$cartgoods = array();
		$totalMoney = 0;
		//如果 购物车为空则放入购物车中
		if(empty($_SESSION["mycart"])){
			$shopcat = array();
			$shopcat[$goodsInfo["goodsId"]] = $goodsInfo;
			$totalMoney += $goodsInfo["cnt"]*$goodsInfo["shopPrice"];
			$cartgoods[] = $goodsInfo;		
			$_SESSION["mycart"] = $shopcat;
		}else{
			//如果购物车不为空则要看下该商品是否原来就存在了。
			$shopcat = $_SESSION["mycart"];
			//如果已经存在则要把数量相加
			if(!empty($shopcat[$goodsInfo['goodsId']])){
				$goodsInfo["cnt"]=$_SESSION["mycart"][$goodsInfo["goodsId"]]["cnt"]+$goodsInfo["cnt"];
			}			
			$shopcat[$goodsInfo["goodsId"]] = $goodsInfo;				
            //重新把购物车内的数据拿到外边
			foreach($shopcat as $key=>$cgoods){	
				$goods = self::getGoodsInfo($key);
				$goods["cnt"] = $cgoods["cnt"];
				$totalMoney += $goods["cnt"]*$goods["shopPrice"];
				$cartgoods[] = $goods;
			}		
			$_SESSION["mycart"] = $shopcat;
		}
		$cartInfo = array();
		$cartInfo["cartgoods"] = $cartgoods;
		$cartInfo["totalMoney"] = $totalMoney;
		return $cartInfo;
	}
	
	/**
	 * 获取商品信息
	 */
	public function getGoodsInfo($goodsId){
		$sql = "SELECT g.goodsId,g.goodsSn,g.goodsName,g.goodsThums,g.shopId,g.marketPrice,g.shopPrice,g.goodsStock,g.bookQuantity,g.isBook,sp.shopName
				FROM ".$this->tablePrefix."goods g,".$this->tablePrefix."shops sp 
				WHERE g.shopId=sp.shopId AND goodsFlag=1 and isSale=1 and goodsStatus=1 and g.goodsId = $goodsId";
		$goodslist = $this->query($sql);
		return $goodslist[0];
	}
	
	/**
	 * 获取购物车信息
	 */
	public function getCartInfo(){
		$mgoods = D('Home/Goods');
		$totalMoney = 0;
		$shopcart = $_SESSION["mycart"]?$_SESSION["mycart"]:array();	
		$cartgoods = array();		
		foreach($shopcart as $key=>$cgoods){				
			$obj["goodsId"] = $key;		
			$goods = $mgoods->getGoodsDetails($obj);
			$goods["cnt"] = ($cgoods["cnt"]<=0)?1:$cgoods["cnt"];
			$totalMoney += $goods["cnt"]*$goods["shopPrice"];
			$cartgoods[] = $goods;
		}
		$cartInfo = array();
		$cartInfo["totalMoney"] = $totalMoney;
		$cartInfo["cartgoods"] = $cartgoods;
		return $cartInfo;
		
	}
   
	/**
	 * 检测购物车中商品库存
	 */
	public function checkCatGoodsStock($goodsId){
		
		//$totalMoney = 0;
		$shopcart = $_SESSION["mycart"]?$_SESSION["mycart"]:array();	
		$mgoods = D('Home/Goods');
		$cartgoods = array();		
		foreach($shopcart as $key=>$cgoods){
			$obj["goodsId"] = $key;		
			$goods = $mgoods->getGoodsDetails($obj);
			if($goods["isBook"]==1){
				$goods["goodsStock"] = $goods["goodsStock"]+$goods["bookQuantity"];
			}
			$goods["cnt"] = $cgoods["cnt"];
			$goods["stockStatus"] = ($goods["goodsStock"]>=$goods["cnt"])?1:0;
			//$totalMoney += $goods["cnt"]*$goods["shopPrice"];			
			$cartgoods[] = $goods;
		}
		
		return $cartgoods;
		
	}
	
	/**
	 * 删除购物车中的商品
	 */
	public function delCartGoods(){
		
		$goodsId = I("goodsId");
		$shopcart = $_SESSION["mycart"]?$_SESSION["mycart"]:array();
		unset($_SESSION["mycat"]);
		$newShopcat = array();
		foreach($shopcart as $key=>$cgoods){	
			if($goodsId != $key){
				$newShopcat[$key] = $shopcat[$key];
			}			
		}
		$_SESSION["mycart"] = $newShopcat;
		
		return 1;
		
	}
	
	/**
	 * 修改购物车中的商品数量
	 * 
	 */
	public function changeCartGoodsnum(){
		
		$goodsId = I("goodsId");
		$num = I("num");
		$shopcart = $_SESSION["mycart"]?$_SESSION["mycart"]:array();
		unset($_SESSION["mycart"]);
		$newShopcart = array();
		foreach($shopcart as $key=>$cgoods){	
			$cartgoods = $shopcart[$key];
			if($goodsId == $key){
				$cartgoods["cnt"] = $num;
			}
			$newShopcart[$key] = $cartgoods;	
		}
		$_SESSION["mycart"] = $newShopcart;
		
		return 1;
		
	}
	
}