<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 购物车
 */
class CartModel extends BaseModel {
	
	/**
	 * 获取购物车信息
	 */
	public function getCartInfo(){
		$mgoods = D('WebApp/Goods');
		$totalMoney = 0;
		$shopcart = session("WST_CART")?session("WST_CART"):array();
		$cartgoods = array();
		foreach($shopcart as $goodsId=>$cgoods){
			$temp = explode('_',$goodsId);
			$goodsId = (int)$temp[0];
			$goodsAttrId = (int)$temp[1];
			$sql = "SELECT  g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,g.shopPrice,g.goodsSpec,shop.shopName,shop.deliveryType,shop.shopAtive,
					shop.shopTel,shop.shopAddress,shop.deliveryTime,shop.isInvoice, shop.deliveryStartMoney,
					shop.deliveryFreeMoney,shop.deliveryMoney ,g.goodsSn,shop.serviceStartTime,shop.serviceEndTime
					FROM __PREFIX__goods g, __PREFIX__shops shop
					WHERE g.goodsId = $goodsId AND g.shopId = shop.shopId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1 ";
			$goods = self::queryRow($sql);
		    //如果商品有价格属性的话则获取其价格属性
		    if(!empty($goods) && $cgoods['attrCatId']>0){
			    $sql = "select a.isPriceAttr,ga.id,ga.attrPrice,ga.attrStock,a.attrName,ga.attrVal,ga.attrId from __PREFIX__attributes a,__PREFIX__goods_attributes ga
			             where a.attrId=ga.attrId and a.catId=".$cgoods['attrCatId']." and a.isPriceAttr=1 and ga.attrId=".$cgoods['attrId']." 
			             and ga.goodsId=".$goodsId." and id=".$goodsAttrId;
				$priceAttrs = $this->queryRow($sql);
				if(!empty($priceAttrs)){
					$goods['isPriceAttr'] = $priceAttrs['isPriceAttr'];
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
			$goods["goodsThums"] = WSTMoblieImg($goods["goodsThums"]);
			$goods["cnt"] = $cgoods["cnt"];
			$goods["ischk"] = $cgoods["ischk"];
			$totalCnt += $cgoods["cnt"];
			$totalMoney += $goods["cnt"]*$goods["shopPrice"];
			$gtotalMoney += $goods["cnt"]*$goods["shopPrice"];

			if($startTime<$goods["startTime"]){
				$startTime = $goods["startTime"];
			}
			if($endTime>$goods["endTime"]){
				$endTime = $goods["endTime"];
			}
		
			$cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
			$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//门店免运费最低金额
			$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//门店配送费
			$cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//门店配送费
			$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cgoods["cnt"];
			$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
		}
		
		foreach($catgoods as $key=> $cshop){
			if($cshop["totalMoney"]<$cshop["deliveryFreeMoney"]){
				$totalMoney = $totalMoney + $cshop["deliveryMoney"];
			}
		}
		
		$cartInfo = array();
		$cartInfo["totalMoney"] = $totalMoney;
		$cartInfo["cartgoods"] = $cartgoods;
		return $cartInfo;
		
	}
	/**
	 * 添加[正常]商品到购物车
	 */
	public function addToCart(){
		//判断一下该商品是否正常	出售
		$goodsInfo = self::getGoodsInfo((int)I("goodsId"),(int)I("goodsAttrId"));
		if($goodsInfo['goodsId']=='')return array();
		$goodsInfo["cnt"] = ((int)I("gcount")>0)?(int)I("gcount"):1;
		$goodsInfo["ischk"] = 1;
		$cartgoods = array();
		$totalMoney = 0;
		$WST_CART = session("WST_CART");
		//如果 购物车为空则放入购物车中
		if(empty($WST_CART)){
			$shopcat = array();
			$shopcat[$goodsInfo["goodsId"]."_".$goodsInfo["goodsAttrId"]] = $goodsInfo;
			$totalMoney += $goodsInfo["cnt"]*$goodsInfo["shopPrice"];
			$cartgoods[] = $goodsInfo;		
			session("WST_CART",$shopcat);
		}else{
			//如果购物车不为空则要看下该商品是否原来就存在了。
			$shopcat = $WST_CART;
			//如果已经存在则要把数量相加
			if(!empty($shopcat[$goodsInfo['goodsId']."_".$goodsInfo["goodsAttrId"]])){
				$goodsInfo["cnt"]=$WST_CART[$goodsInfo["goodsId"]."_".$goodsInfo["goodsAttrId"]]["cnt"]+$goodsInfo["cnt"];
			}			
			$shopcat[$goodsInfo["goodsId"]."_".$goodsInfo["goodsAttrId"]] = $goodsInfo;				
            //重新把购物车内的数据拿到外边
			foreach($shopcat as $key=>$cgoods){	
				$totalMoney += $cgoods["cnt"]*$cgoods["shopPrice"];
				$cartgoods[] = $cgoods;
			}		
			session("WST_CART",$shopcat);
		}
		$cartInfo = array();
		$cartInfo["cartgoods"] = $cartgoods;
		$cartInfo["totalMoney"] = $totalMoney;
		return $cartInfo;
	}

	/**
	 * 获取商品信息
	 */
	public function getGoodsInfo($goodsId,$goodsAttrId = 0){
		$sql = "SELECT g.attrCatId,g.goodsId,g.goodsSn,g.goodsName,g.goodsThums,g.shopId,g.marketPrice,g.shopPrice,g.goodsStock,g.bookQuantity,g.isBook,sp.shopName
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
	 * 删除购物车中的商品
	 */
	public function delCartGoods(){
		$goodsIds = explode('#', I("goodsIds"));
		$shopcart = session("WST_CART")?session("WST_CART"):array();
		session("WST_CART");
		$newShopcat = array();
		foreach($shopcart as $key=>$cgoods){	
			if( !in_array($cgoods['goodsId'], $goodsIds) ){
				$newShopcat[$key] = $cgoods;
			}			
		}
		session("WST_CART",$newShopcat);
		return 1;
	}
	/**
	 * 修改购物车中的商品数量
	 * 
	 */
	public function changeCartGoodsnum(){
		$rs = array('status'=>-1);
		$goodsId = (int)I("goodsId");
		$num = abs((int)I("num"));
		//查询商品库存
		$goods = D('WebApp/Goods');
		$rv = $goods->getGoodsStock();
		if( $rv['goodsStock'] < $num ){//库存不足
			$rs['status'] = -2;
			$rs['goodsStock'] = $rv['goodsStock'];
			return $rs;
		}
		$shopcart = session("WST_CART")?session("WST_CART"):array();
		session("WST_CART",null);
		$newShopcart = array();
		foreach($shopcart as $key=>$cgoods){	
			$cartgoods = $shopcart[$key];
			if($goodsId == $key){
				$cartgoods["cnt"] = $num;
			}
			$newShopcart[$key] = $cartgoods;	
		}
		session("WST_CART",$newShopcart);
		$rs['status'] = 1;
		return $rs;
	}

	/**
	 * 结算-获取商品分组列表
	 */
	public function groupGoodsForOrder(){
		$userId = $this->getUserId();
		$goodsIds = trim(I('goodsIds'));
		if($goodsIds=='')return array();
		$goodsIds = explode(';',$goodsIds);
		$shopIds = array();
		$shopGoodsMap = array();
		//获取商品信息
		foreach ($goodsIds as $v){
			$tmp = explode('_',$v);
			$goodsId = (int)$tmp[0];
			$goodsAttrId = (int)$tmp[1];
            $goodsNum= (int)$tmp[2];
			$sql = "SELECT g.shopId,g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,g.goodsSpec,
			            ga.id goodsAttrId,ga.attrPrice,ga.attrStock,ga.attrVal,a.attrName ,g.goodsSn
				        FROM __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.id=".$goodsAttrId."
						left join __PREFIX__attributes a on a.attrId=ga.attrId
						WHERE g.goodsId = $goodsId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1";
			$goods =$this->queryRow($sql); 

            $goods['goodsThums'] = WSTMoblieImg($goods['goodsThums']);
            $goods['goodsNum'] = $goodsNum;
			if(empty($goods))continue;
			if($goods['goodsAttrId']>0){
				$goods['shopPrice'] = $goods['attrPrice'];
				$goods['goodsStock'] = $goods['attrStock'];
				$goods['goodsName'] = $goods['goodsName']."【".$goods['attrName'].":".$goods['attrVal']."】";
			}
			unset($goods['goodsAttrId'],$goods['attrPrice'],$goods['attrStock']);
			if(!in_array($goods['shopId'],$shopIds))$shopIds[] = $goods['shopId'];
			$shopGoodsMap[$goods['shopId']][] = $goods;
		}

		if(empty($shopGoodsMap))return array();
		//获取店铺数据
		$sql ="select shopId,shopName,deliveryType,shopAtive,deliveryTime,isInvoice,deliveryMoney,deliveryFreeMoney,
		       deliveryStartMoney,serviceStartTime,serviceEndTime from __PREFIX__shops where shopStatus=1 and shopFlag=1 and shopId in(".implode(',',$shopIds).")";
		      
		$shopRs = $this->query($sql);
				
		//获取店铺配送的社区
		$sql = "select shopId,communityId from __PREFIX__shops_communitys where shopId in(".implode(',',$shopIds).")";
		$communityRs = $this->query($sql);
		$shopCommunityRs = array();
		foreach ($communityRs as $v){
			$shopCommunityRs[$v['shopId']][] = $v['communityId'];
		}
		//组合数据
		$shops = array();
		$reachStartTime = $reachEndTime = array();
		foreach ($shopRs as $v){
			$shops[$v['shopId']]['shopInfo'] = $v;
			$shops[$v['shopId']]['goods'] = $shopGoodsMap[$v['shopId']];
			$shops[$v['shopId']]['communitys'] = $shopCommunityRs[$v['shopId']];
			if(strpos($v["serviceStartTime"],'.5')) $shops[$v['shopId']]['shopInfo']['serviceStartTime'] = str_replace('.5',':30',$v["serviceStartTime"]);
			if(strpos($v["serviceStartTime"],'.0')) $shops[$v['shopId']]['shopInfo']['serviceStartTime'] = str_replace('.0',':00',$v["serviceStartTime"]);
			if(strpos($v["serviceEndTime"],'.5')) $shops[$v['shopId']]['shopInfo']['serviceEndTime'] = str_replace('.5',':30',$v["serviceEndTime"]);
			if(strpos($v["serviceEndTime"],'.0')) $shops[$v['shopId']]['shopInfo']['serviceEndTime'] = str_replace('.0',':00',$v["serviceEndTime"]);
			$reachStartTime[] = $v['serviceStartTime'];
			$reachEndTime[] = $v['serviceEndTime'];
		}	
		//再取出组合
	    $rshops = array();
		foreach ($shops as $v){
			$rshops[] = $v;
		}
		rsort($reachStartTime);
		sort($reachEndTime);
		$reachTime = array($reachStartTime[0], $reachEndTime[0]);//各店铺营业时间的交集，用来确定订单的期望送达时间的范围
		return array('cartInfo'=>$rshops, 'reachTime'=>$reachTime);
	}
}