<?php
/**
 * 获取首页分类及商品
 */
function WSTCatsAndGoods($areaId2){
	$m = M('goods_cats');
	$rs1 = S("WST_CACHE_GOODS_CAT_GOODS_WP_".$areaId2);
	if(!$cats){
		//查询一级分类
		$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = 0 AND isShow =1 AND catFlag = 1 order by catSort asc limit 6";
		$rs1 = $m->query($sql);
		foreach ($rs1 as $key =>$v){
			$ids = array();
			$ids[] = $v['catId'];
			//查询二级分类
			$sql = "select catId from __PREFIX__goods_cats WHERE parentId in(".implode(',',$ids).") AND isShow =1 AND catFlag = 1 order by catSort asc ";
			$rs2 = $m->query($sql);
			$ids = array();
			foreach ($rs2 as $v2){
				$ids[] = $v2['catId'];
			}
			//查询三级分类
			$sql = "select catId from __PREFIX__goods_cats WHERE parentId in(".implode(',',$ids).") AND isShow =1 AND catFlag = 1 order by catSort asc ";
			$rs3 = $m->query($sql);
			$ids = array();
			foreach ($rs3 as $v3){
				$ids[] = $v3['catId'];
			}
			//查询三级分类下的商品
			$sql = "SELECT sp.shopName,sp.shopId , g.goodsCatId1,g.goodsId , g.goodsName,g.goodsThums,g.shopPrice,ga.id goodsAttrId,ga.attrPrice
						FROM __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1,__PREFIX__shops sp
						WHERE g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 
						AND g.goodsStatus = 1 AND g.goodsCatId3 in(".implode(',',$ids).") AND sp.areaId2=$areaId2
						order by g.saleCount desc,g.goodsId desc limit 6";
			$goods = $m->query($sql);
			foreach ($goods as $key2 =>$v){
				$goods[$key2]['goodsThums'] = WSTMoblieImg($v['goodsThums']);
				if($goods[$key2]['goodsAttrId']>0){
					$goods[$key2]['goodsStock'] = $goods[$key2]['attrStock'];
					$goods[$key2]['shopPrice'] = $goods[$key2]['attrPrice'];
					unset($goods['attrStock'],$goods['attrPrice']);
				}else{
					$goods[$key2]['goodsAttrId'] = 0;
				}
			}
			$rs1[$key]['data'] = $goods;
		}
		S("WST_CACHE_GOODS_CAT_GOODS_WP_".$areaId2,$rs1,31536000);
	}
	return $rs1;
}

/**
 * 获取购物车数量
 */
function WSTCartNum(){
	$m = M('cart');
	$userId = session('WST_USER.userId');
	$sql = "select count(*) cnt from __PREFIX__cart where userId=$userId";
	$rows = $m->query($sql);
	$count = $rows[0]["cnt"]?$rows[0]["cnt"]:0;
	return $count;
}

/**
 * 根据网页图片路径替换出手机版图片
 * @param string $picurl 网页版图片领
 */
function WSTMoblieImg($imgurl){
	$img = str_replace('.',C('WST_M_IMG_SUFFIX').'.',$imgurl);
	return ((file_exists(WSTRootPath()."/".$img))?$img:$imgurl);
}

/**
 * 获取当前页面URL(包含URL参数)
 */
function WSTGetPageUrl(){
	$url = WSTRootDomain();
	$url .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : urlencode($_SERVER['PHP_SELF']) . '?' . urlencode($_SERVER['QUERY_STRING']);
	return $url;
}
function WSTOrderScore(){
	$scoreCashRatio = $GLOBALS['CONFIG']["scoreCashRatio"];
	$scoreCash = explode(":",$scoreCashRatio);
	return (int)$scoreCash[0];
}

function WSTScoreMoney(){
	$scoreCashRatio = $GLOBALS['CONFIG']["scoreCashRatio"];
	$scoreCash = explode(":",$scoreCashRatio);
	return (int)$scoreCash[1];
}