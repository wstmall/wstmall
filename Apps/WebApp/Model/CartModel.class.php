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
		$userId = (int)session('WST_USER.userId');
		$totalMoney = 0;
		$cartgoods = array();
		$sql = "select * from __PREFIX__cart where userId = $userId";
		$shopcart = $this->query($sql);
		for($i=0; $i<count($shopcart); $i++){
			$cgoods = $shopcart[$i];
			$goodsId = $cgoods["goodsId"];
			$goodsAttrId = $cgoods["goodsAttrId"];
			$sql = "SELECT  g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,g.shopPrice,g.attrCatId,g.goodsSpec,shop.shopName,shop.deliveryType,shop.shopAtive,
					shop.shopTel,shop.shopAddress,shop.deliveryTime,shop.isInvoice, shop.deliveryStartMoney,
					shop.deliveryFreeMoney,shop.deliveryMoney ,g.goodsSn,shop.serviceStartTime,shop.serviceEndTime
					FROM __PREFIX__goods g, __PREFIX__shops shop
					WHERE g.goodsId = $goodsId AND g.shopId = shop.shopId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1 ";
			$goods = self::queryRow($sql);
		    //如果商品有价格属性的话则获取其价格属性
		    if(!empty($goods) && $goods['attrCatId']>0){
			    $sql = "select ga.id,ga.attrPrice,ga.attrStock,a.attrName,ga.attrVal,ga.attrId from __PREFIX__attributes a,__PREFIX__goods_attributes ga
			             where a.attrId=ga.attrId and a.catId=".$goods['attrCatId']." and a.isPriceAttr=1 
			             and ga.goodsId=".$goodsId." and ga.id=".$goodsAttrId;
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
			$goods["cartId"] = $cgoods["cartId"];
			$goods["cnt"] = $cgoods["goodsCnt"];
			$goods["isCheck"] = $cgoods["isCheck"];
			if($cgoods["isCheck"]==1){
				$totalMoney += $goods["cnt"]*$goods["shopPrice"];
			}

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
			if($cgoods["isCheck"]==1){
				$cartgoods[$goods["shopId"]]["totalMoney"] += $goods["cnt"] * $goods["shopPrice"];
				$cartgoods[$goods["shopId"]]["isCheckTotal"] += 1;
			}
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
		$rd = array('status'=>-1);
		$goodsId = (int)I("goodsId");
		$goodsAttrId = (int)I("goodsAttrId");

		//判断一下该商品是否正常出售
		$goodsInfo = self::getGoodsInfo($goodsId, $goodsAttrId);
		if($goodsInfo['goodsId'] == ''){
			return $rd;
		}

		$m = M('cart');
		$userId = (int)session('WST_USER.userId');
		$goodsCnt = ((int)I("gcount")>0)?(int)I("gcount"):1;
		$rs = false;
		$sql = "select * from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId";
		$row = $this->queryRow($sql);
		if($row["cartId"] > 0){
			$data = array();
			$data["goodsCnt"] = $row["goodsCnt"]+$goodsCnt;
			$rs = $m->where("userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId")->save($data);
		}else{
			$data = array();
			$data["userId"] = $userId;
			$data["goodsId"] = $goodsId;
			$data["isCheck"] = 1;
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
	public function delCartGoods($cartIds){
		$rd = array('status'=>-1);
		$cartIds = ($cartIds != '') ? $cartIds : I("cartIds");
		$cartIds = explode('#', WSTFormatIn("#", $cartIds));
		$cartIds = array_filter($cartIds);
		$userId = (int)session('WST_USER.userId');
		$sql = "delete from __PREFIX__cart where userId=$userId and cartId in(".implode(',', $cartIds).")";
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
	public function changeCartGoodsnum(){
		$rd = array('status'=>-1);
		$m = M('cart');
		$userId = (int)session('WST_USER.userId');
		$goodsId = (int)I("goodsId");
		$goodsAttrId = (int)I("goodsAttrId", 0);
		$goodsCnt = abs((int)I("num", 1));
		$isCheck = (int)I("isCheck", -1);
		if( $isCheck >= 0){
			$isCheck = ($isCheck == 1) ? 1 : 0;
		}

		if($isCheck == 1){
			//查询商品库存
			$goods = D('WebApp/Goods');
			$rv = $goods->getGoodsStock();
			if( $rv['goodsStock'] < $goodsCnt ){//库存不足
				$rd['status'] = -2;
				$rd['goodsStock'] = $rv['goodsStock'];
				return $rd;
			}
		}
		
		$sql = "select * from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId";
		$row = $this->queryRow($sql);
		if($row["cartId"] > 0){
			$data = array();
			$data["goodsCnt"] = $goodsCnt;
			if( $isCheck == 0 || $isCheck == 1 ){
				$data["isCheck"] = $isCheck;
			}
			$rs = $m->where("userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId")->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	}

	/**
	 * 结算-获取商品分组列表
	 */
	public function groupGoodsForOrder(){
		$userId = (int)session('WST_USER.userId');
		$sql = "select * from __PREFIX__cart where userId = $userId and isCheck=1 and goodsCnt>0";
		$shopcart = $this->query($sql);
		if(empty($shopcart)){
			$rdata['msg'] = '购物车为空!';
			return $rdata;
		}

		$shopIds = array();
		$shopGoodsMap = array();
		//获取商品信息
		foreach ($shopcart as $v){
			$goodsId = $v['goodsId'];
			$goodsAttrId = $v['goodsAttrId'];
            $goodsCnt= $v['goodsCnt'];
			$sql = "SELECT g.shopId,g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,g.goodsSpec,
			            ga.id goodsAttrId,ga.attrPrice,ga.attrStock,ga.attrVal,a.attrName ,g.goodsSn
				        FROM __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.id=".$goodsAttrId."
						left join __PREFIX__attributes a on a.attrId=ga.attrId
						WHERE g.goodsId = $goodsId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1";
			$goods =$this->queryRow($sql); 

            $goods['goodsThums'] = WSTMoblieImg($goods['goodsThums']);
            $goods['goodsCnt'] = $goodsCnt;
			if(empty($goods))continue;
			if($goods['goodsAttrId']>0){
				$goods['shopPrice'] = $goods['attrPrice'];
				$goods['goodsStock'] = $goods['attrStock'];
				$goods['goodsName'] = $goods['goodsName']."【".$goods['attrName'].":".$goods['attrVal']."】";
			}
			unset($goods['goodsAttrId'],$goods['attrPrice'],$goods['attrStock']);
			if( !in_array($goods['shopId'], $shopIds) ){
				$shopIds[] = $goods['shopId'];
			}
			$shopGoodsMap[$goods['shopId']][] = $goods;
		}
		if(empty($shopGoodsMap)){
			return array();
		}

		$goodsTotalMoney = 0;//商品总金额
		$shopGoodsTotalMoney = array();//各个店铺的商品总金额
		foreach($shopGoodsMap as $shop){
			foreach($shop as $v){
				$goodsMoney = $v['shopPrice']*$v['goodsCnt'];
				$goodsTotalMoney += $goodsMoney;
				if( isset($shopGoodsTotalMoney[$v['shopId']]) ){
					$shopGoodsTotalMoney[$v['shopId']]['goodsTotalMoney'] += $goodsMoney;
				}else{
					$shopGoodsTotalMoney[$v['shopId']]['goodsTotalMoney'] = $goodsMoney;
				}
			}
		}

		//获取店铺数据
		$sql ="select shopId,shopName,deliveryType,shopAtive,deliveryTime,isInvoice,deliveryMoney,deliveryFreeMoney,deliveryStartMoney,serviceStartTime,serviceEndTime from __PREFIX__shops where shopStatus=1 and shopFlag=1 and shopId in(".implode(',',$shopIds).")";
		$shopRs = $this->query($sql);

		//组合数据
		$shops = array();
		foreach ($shopRs as $v){
			$shops[$v['shopId']]['shopInfo'] = $v;
            $shops[$v['shopId']]['shopInfo']['deliveryTotalMoney'] = 0;
            if( $shopGoodsTotalMoney[$v['shopId']]['goodsTotalMoney'] < $v['deliveryFreeMoney'] ){
              $shops[$v['shopId']]['shopInfo']['deliveryTotalMoney'] = $v['deliveryMoney'];
            }

			$shops[$v['shopId']]['goods'] = $shopGoodsMap[$v['shopId']];
			if(strpos($v["serviceStartTime"],'.5')) $shops[$v['shopId']]['shopInfo']['serviceStartTime'] = str_replace('.5',':30',$v["serviceStartTime"]);
			if(strpos($v["serviceStartTime"],'.0')) $shops[$v['shopId']]['shopInfo']['serviceStartTime'] = str_replace('.0',':00',$v["serviceStartTime"]);
			if(strpos($v["serviceEndTime"],'.5')) $shops[$v['shopId']]['shopInfo']['serviceEndTime'] = str_replace('.5',':30',$v["serviceEndTime"]);
			if(strpos($v["serviceEndTime"],'.0')) $shops[$v['shopId']]['shopInfo']['serviceEndTime'] = str_replace('.0',':00',$v["serviceEndTime"]);
		}

		$deliveryTotalMoney = 0;//运费总金额
		foreach ($shops as $v){
			$deliveryTotalMoney += $v['shopInfo']['deliveryTotalMoney'];
		}
		return array(
			'shopGoods' => $shops,
			'goodsTotalMoney' => $goodsTotalMoney,
			'deliveryTotalMoney' => $deliveryTotalMoney
		);
	}
}