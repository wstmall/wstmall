<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
class ShopsModel extends BaseModel {

	/**
	 * 获取商家信息
	 */
	public function getShopInfo($shopId){
		$shop = array();
		$sql = "select s.shopId,s.shopName,s.shopAddress,s.shopImg,s.shopTel,goodsScore,goodsUsers,serviceScore,serviceUsers,timeScore,timeUsers
			from __PREFIX__shops s left join __PREFIX__shop_scores ss on s.shopId=ss.shopId
			where shopStatus=1 and shopFlag=1  and s.shopId=".$shopId;
			$shop = $this->queryRow($sql);
		if(!empty($shop)){
			$shop['shopImg'] = WSTMoblieImg($shop['shopImg']);
			$shop['goodsScore'] = round($shop['goodsScore']/$shop['goodsUsers'],1);
			$shop['serviceScore'] = round($shop['serviceScore']/$shop['goodsUsers'],1);
			$shop['timeScore'] = round($shop['timeScore']/$shop['goodsUsers'],1);
			unset($shop['goodsUsers'],$shop['goodsUsers'],$shop['goodsUsers']);
		}
		return $shop;
	}

	/**
	 * 获取商家列表
	 */
	public function getShopsList(){
		$areaId2 = (int)session('areaId2');
		$latitude = session('wstRealLatitude');
		$latitude = ($latitude!='') ? $latitude : 0;
		$longitude = session('wstRealLongitude');
		$longitude = ($longitude!='') ? $longitude : 0;
		$currPage = (int)I("currPage",0);
		$pageSize = I('pageSize') ? (int)I('pageSize') : 10;
		$key = WSTAddslashes(I('key'));
		$sortArr = array('code'=>array('fn_getDistance(s.longitude,s.latitude,'.$longitude.','.$latitude.')','deliveryMoney','totalScore'),'desc'=>array('asc','desc'));
		$sql = "select s.shopName,s.shopId,gc.catName,s.shopAddress,s.isSelf,s.shopImg,s.deliveryStartMoney, fn_getDistance(s.longitude,s.latitude,".$longitude.",".$latitude.") as userDistance,totalScore,totalUsers
		        from __PREFIX__shops s left join __PREFIX__goods_cats gc on s.goodsCatId1=gc.catId
		        left join __PREFIX__shop_scores ss on ss.shopId=s.shopId
		        where s.areaId2=".$areaId2." and s.shopFlag=1 and s.shopStatus=1 ";
		if($key!='') $sql .= " and s.shopName like '%".$key."%' ";
		$sql .= " order by ".$sortArr['code'][(int)I('desc')]." ".$sortArr['desc'][(int)I('descType')];
		$page =  $this->pageQuery($sql,$currPage,$pageSize);
		if(count($page['root'])>0){
			foreach ($page['root'] as $key => $v){
				$page['root'][$key]['shopImg'] = WSTMoblieImg($v['shopImg']);
				$page['root'][$key]['score'] = round($v['totalScore']/$v['totalUsers']);
				unset($page['root'][$key]['totalUsers']);
			}
		}
		return $page;
	}
	
	/**
	 * 获取商家商品列表
	 */
	public function getShopGoodsList($shopId){
		$shopId = (int)I('shopId', 0);
		$startPrice = (float)I('startPrice', 0);
		$endPrice = (float)I('endPrice', 0);
		$currPage = (int)I("currPage", 1);
		$pageSize = (int)( I('pageSize') ? I('pageSize') : 10 );
		$desc = (I('desc')!='') ? (int)I('desc') : 1;
		$descType = (I('descType')!='') ? (int)I('descType') : 1;
		$sortArr = array('code'=>array('saleCount','shopPrice','totalScore'),'descType'=>array('asc','desc'));
		$sql = "select g.goodsId,g.goodsName,g.goodsThums,g.shopPrice,g.shopId,g.goodsStock,ga.id goodsAttrId,ga.attrStock,ga.attrPrice,sum(gs.totalScore)/sum(gs.totalUsers) as totalScore
		        from __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1
	 	        left join __PREFIX__goods_scores gs on g.goodsId=gs.goodsId and g.shopId=gs.shopId
	 	        where g.goodsStatus=1 and g.goodsFlag=1 and isSale=1 and g.shopId=".$shopId;
		if($startPrice>0)$sql.=" and g.shopPrice>=".$startPrice;
		if($endPrice>0)$sql.=" and g.shopPrice<=".$endPrice;
		$sql .= " GROUP BY g.goodsId";
		$sql .= " order by ".$sortArr['code'][$desc]." ".$sortArr['descType'][$descType];
		$page =  $this->pageQuery($sql,$currPage,$pageSize);
		if(count($page['root'])>0){
			foreach ($page['root'] as $key =>$v){
				$page['root'][$key]['goodsThums'] = WSTMoblieImg($v['goodsThums']);
				$page['root'][$key]['totalScore'] = round($v['totalScore']/$v['totalUsers'],1);
				if($page['root'][$key]['goodsAttrId']>0){
					$page['root'][$key]['goodsStock'] = $v['attrStock'];
					$page['root'][$key]['shopPrice'] = $v['attrPrice'];
				}else{
					$page['root'][$key]['goodsAttrId'] = 0;
				}
				unset($page['root'][$key]['attrStock'],$page['root'][$key]['attrPrice'],$page['root'][$key]['totalUsers']);
			}
		}
		return $page;
	}

	/**
	 * 检测自营店铺ID
	 */
	function checkSelfShopId($areaId2){
		$m = M('shops');
		$sql = "select shopId from __PREFIX__shops where areaId2=".$areaId2." and isSelf=1 and shopFlag=1 and shopStatus = 1";
		$shop = $this->queryRow($sql);
		return (int)$shop['shopId'];
	}
}