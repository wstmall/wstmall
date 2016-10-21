<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 商品分类服务类
 */
class GoodsCatsModel extends BaseModel {
   /**
	* 获取列表
	*/
	public function queryByList($pid = 0){
	    $m = M('goods_cats');
	    $rs = $m->where('catFlag=1 and parentId='.$pid)->select(); 
		return $rs;
	}
    /**
     * 获取商品分类及商品
     */
	public function getGoodsCatsAndGoodsForIndex($areaId2){
		$cats = S("WST_CACHE_GOODS_CAT_GOODS_WEB_".$areaId2);
		if(!$cats){
			//取出前十个被推荐的一级分类,上限10层,可通过修改排序来调整顺序
			$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = 0 AND isShow =1 AND isFloor = 1 AND catFlag = 1 order by catSort asc limit 10";
			$rs1 = $this->query($sql);
			$cats = array();
			//取出所有一级分类下对应的被推荐的二级分类,上限8个
			for ($i = 0; $i < count($rs1); $i++) {
				$cat1Id = $rs1[$i]["catId"];
				$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = $cat1Id AND isShow =1 AND isFloor = 1 AND catFlag = 1 order by catSort asc limit 8";
				$rs2 = $this->query($sql);
				$cats2 = array();
				for ($j = 0; $j < count($rs2); $j++) {
					//取出二级分类下对应的被推荐的三级分类的前10个,可通过修改排序来调整顺序
					$cat2Id = $rs2[$j]["catId"];
					$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = $cat2Id AND isShow =1  AND isFloor = 1 AND catFlag = 1 order by catSort asc";
					$rs3 = $this->query($sql);
					$cats3 = array();
					for ($k = 0; $k < count($rs3); $k++) {
						$cats3[] = $rs3[$k];
					}
					$rs2[$j]["catChildren"] = $cats3;
			
					//查询二级分类下的商品
					$sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsThums,g.shopPrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice
							FROM __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
							WHERE g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId2 = $cat2Id AND (sp.areaId2=$areaId2 or sp.isDistributAll=1)
							ORDER BY g.saleCount desc limit 8";
					$grs = $this->query($sql);
				
					foreach ($grs as $gkey => $v){
						if(intval($v['goodsAttrId'])>0)$grs[$gkey]['shopPrice'] = $v['attrPrice'];
					}
					$rs2[$j]["goods"] = $grs;
					$cats2[] = $rs2[$j];
				}
			
				//查询二级分类下的商品
				$sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsThums,g.shopPrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice
						FROM __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
						WHERE g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId1 = $cat1Id AND (sp.areaId2=$areaId2 or sp.isDistributAll=1)
						ORDER BY g.saleCount desc limit 8";
				$jgrs = $this->query($sql);
			    foreach ($jgrs as $gkey => $v){
					if(intval($v['goodsAttrId'])>0)$jgrs[$gkey]['shopPrice'] = $v['attrPrice'];
				}
				$rs1[$i]["jpgoods"] = $jgrs;
				$rs1[$i]["catChildren"] = $cats2;
				$cats[] = $rs1[$i];
			}
			S("WST_CACHE_GOODS_CAT_GOODS_WEB_".$areaId2,$cats,31536000);
		}
		//获取每个分类推荐的店铺
		if($cats){
			$recommendShops = S("WST_CACHE_RECOMM_SHOP_".$areaId2);
		    if(!$recommendShops){
		    	$recommendShops = array();
				//获取楼层推荐商店
				foreach ($cats as $key =>$v){
					$obj["areaId2"] = $areaId2;
					$obj["goodsCatId1"] = $v['catId'];
					$rs = self::getRecommendShops($obj);
					$recommendShops[$obj["goodsCatId1"]] =$rs;
				}
				S("WST_CACHE_RECOMM_SHOP_".$areaId2,$recommendShops,86400);
		    }
		    foreach ($cats as $key =>$v){
		    	$cats[$key]['recommendShops'] = $recommendShops[$v['catId']];
		    }
		}
		return $cats;
	}
	
    /**
	 * 获取每个楼层推荐的商店
	 *
	 */
	public function getRecommendShops($obj){
		$areaId2 = $obj["areaId2"];
		$goodsCatId1 = $obj["goodsCatId1"];
		$sql = "SELECT  COUNT(odr.orderId) as shopcnt, shop.shopId,shop.shopName,shop.shopImg FROM __PREFIX__shops shop
					LEFT JOIN __PREFIX__orders odr ON shop.shopId = odr.shopId
					WHERE shop.goodsCatId1 = $goodsCatId1 AND shopFlag = 1 AND shopStatus = 1 AND shopAtive = 1 AND (shop.areaId2=$areaId2 or shop.isDistributAll=1)
					GROUP BY shop.shopId ORDER BY shopcnt DESC limit 4 ";
		$recommendShops = $this->query($sql);
		return $recommendShops;
	}
};
?>