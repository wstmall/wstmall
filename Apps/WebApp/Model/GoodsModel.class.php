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
class GoodsModel extends BaseModel {
	
	/**
	 * 商品列表
	 */
	public function getGoodsList(){
        $areaId2 = (int)session('areaId2');
		$goodsCatId1 = (int)I('goodsCatId1', 0);
		$goodsCatId2 = (int)I('goodsCatId2', 0);
		$goodsCatId3 = (int)I('goodsCatId3', 0);
		$currPage = (int)I("currPage", 1);
		$key = WSTAddslashes(I('key'));
		$brandId = (int)I('brandId', 0);
		$pageSize = I('pageSize') ? (int)I('pageSize') : 10;
		$sortArr = array('desc'=>array('shopPrice','saleCount','totalScore'),'descType'=>array('asc','desc'));
		$latitude = session('wstRealLatitude');
		$latitude = ($latitude!='') ? $latitude : 0;
		$longitude = session('wstRealLongitude');
		$longitude = ($longitude!='') ? $longitude : 0;
		$words = array();
	    if($key!=""){
			$words = explode(" ",$key);
		}
		$sql = "select s.shopName,s.shopId,g.goodsId,g.goodsName,g.goodsThums,g.shopPrice,fn_getDistance(s.longitude,s.latitude,".$longitude.",".$latitude.") as userDistance,gs.totalScore,gs.totalUsers,
		        g.goodsStock,s.deliveryStartMoney,ga.id goodsAttrId,ga.attrStock,ga.attrPrice 
		        from __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1
		        left join __PREFIX__goods_scores gs on gs.goodsId=g.goodsId ,__PREFIX__shops s
	 	           where g.shopId=s.shopId and s.shopFlag=1 and s.shopStatus=1 and s.areaId2=".$areaId2." and g.goodsStatus=1 and g.goodsFlag=1 and g.isSale=1 ";
	    if(!empty($words)){
			$sarr = array();
			foreach ($words as $key => $word) {
				if($word!=""){
					$sarr[] = "g.goodsName LIKE '%$word%'";
				}
			}
			$sql .= " AND (".implode(" or ", $sarr).") ";
		}
		if($goodsCatId1>0) $sql .= " and g.goodsCatId1=".$goodsCatId1;
		if($goodsCatId2>0) $sql .= " and g.goodsCatId2=".$goodsCatId2;
		if($goodsCatId3>0) $sql .= " and g.goodsCatId3=".$goodsCatId3;
		if($brandId>0)$sql.=" and g.brandId=".$brandId;
		$sql .= " order by ".$sortArr['desc'][(int)I('desc')]." ".$sortArr['descType'][(int)I('descType')];
		$page = $this->pageQuery($sql,$currPage,$pageSize);
		if(count($page['root'])>0){
			foreach ($page['root'] as $key =>$v){
				$page['root'][$key]['goodsThums'] = WSTMoblieImg($v['goodsThums']);
				$page['root'][$key]['score'] = round($v['totalScore']/$v['totalUsers'],1);
				if($page['root'][$key]['goodsAttrId']>0){
					$page['root'][$key]['goodsStock'] = $v['attrStock'];
					$page['root'][$key]['shopPrice'] = $v['attrPrice'];
				}else{
					$page['root'][$key]['goodsAttrId'] = 0;
				}
				unset($page['root'][$key]['attrStock'],$page['root'][$key]['attrPrice'],$page['root'][$key]['totalScore'],$page['root'][$key]['totalUsers']);
			}
		}
		return $page;
	}
	/**
	 * 获取商品详情
	 */
	public function getGoodsDetails(){
		$goodsId = (int)I('goodsId');
		$sql = "select g.goodsId,g.goodsName,g.goodsImg goodsThums,g.shopPrice,g.goodsSpec,g.goodsStock,g.goodsDesc,g.isSale,s.deliveryStartMoney,gs.totalScore as score,s.shopName,s.shopId,s.isSelf,ga.id goodsAttrId,ga.attrStock,ga.attrPrice,g.attrCatId,s.deliveryFreeMoney
		         from __PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1
		         left join __PREFIX__goods_scores gs on g.goodsId=gs.goodsId and g.shopId=gs.shopId, __PREFIX__shops s
		         where g.shopId=s.shopId and s.shopFlag=1 and s.shopStatus=1 and g.goodsStatus=1 and g.goodsFlag=1 and g.goodsId=".$goodsId;
		$goods = $this->query($sql);
		if(!empty($goods)){
			$goods = $goods[0];
			$shopId = $goods['shopId'];
			$goods['goodsDesc'] = htmlspecialchars_decode($goods['goodsDesc']);
			if($goods['goodsAttrId']>0){
				$goods['goodsStock'] = $goods['attrStock'];
				$goods['shopPrice'] = $goods['attrPrice'];
				unset($goods['attrStock'],$goods['attrPrice']);
			}
			//获取商品评论
			$sql = "select count(*) counts from __PREFIX__goods_appraises where isShow=1 and goodsId=".$goodsId;
			$rs = $this->query($sql);
			$goods['appraiseNum'] = $rs[0]['counts'];
			
			//获取规格属性
			$sql = "select ga.id,ga.attrVal,ga.attrPrice,ga.attrStock,a.attrId,a.attrName,a.isPriceAttr
			            ,ga.isRecomm from __PREFIX__attributes a 
			            left join __PREFIX__goods_attributes ga on ga.attrId=a.attrId and ga.goodsId=".$goodsId." where  
						a.attrFlag=1 and a.catId=".$goods['attrCatId']." and a.shopId=".$shopId." order by a.attrSort, a.attrId";
			$attrRs = $this->query($sql);

			if(!empty($attrRs)){
				$priceAttr = array();
				$attrs = array();
				foreach ($attrRs as $key =>$v){
					if($v['isPriceAttr']==1){
						$goods['priceAttrName'] = $v['attrName'];
						unset($v['isPriceAttr'],$v['attrId']);
						$priceAttr[] = $v;
					}else{
						unset($v['isPriceAttr'],$v['attrId']);
						$attrs[] = $v;
					}
				}
				$goods['priceAttrs'] = $priceAttr;
				$goods['attrs'] = $attrs;
			}
		}
		return $goods;
	}

	/**
	* 获取待评价订单中的商品
	*/
	public function getNoAppraiseOrderGoods(){
		$userId = (int)session('WST_USER.userId');
		$orderId = (int)I("orderId");
		$data = array();
		//订单和店铺信息
		$sql = "SELECT o.orderId,o.createTime,sp.shopId,sp.shopName FROM __PREFIX__orders o,__PREFIX__shops sp WHERE o.orderStatus in (4,5) and o.shopId=sp.shopId AND o.orderId = $orderId ";		
		$order = $this->queryRow($sql);
		$shopId = $order['shopId'];	
		$data['order'] = $order;
		//该订单下的商品信息
		$sql = 'SELECT g.goodsId,og.goodsAttrId,og.goodsName,g.goodsThums FROM __PREFIX__order_goods og LEFT JOIN __PREFIX__goods g ON g.goodsId=og.goodsId WHERE og.orderId='.$orderId;	
		$goodslist = $this->query($sql);
		//该订单下商品的评价信息
		$sql = 'SELECT id,goodsId,goodsAttrId FROM __PREFIX__goods_appraises WHERE isShow=1 AND orderId='.$orderId.' AND shopId='.$shopId.' AND userId='.$userId;
		$appraises = $this->query($sql);

		$temp = array();
		foreach($goodslist as $k=>$v){
			if(!empty($appraises)){
				foreach($appraises as $v1){
					if( in_array($v['goodsId'], $v1) && $v['goodsAttrId'] == $v1['goodsAttrId'] ){//该商品已评价
						$goodslist[$k]['isAppraises'] = 1;
						$goodslist[$k]['id'] = $v1['id'];
						if( !in_array($v['goodsId'], $temp) ){
							$temp[] = $v['goodsId'];
						}
					}else{
						if( !in_array($v['goodsId'], $temp) ){
							$goodslist[$k]['isAppraises'] = 0;
						}
					}
				}
			}else{//该订单下所有商品都还没评价
				$goodslist[$k]['isAppraises'] = 0;
			}
		}
		$data['goodslist'] = $goodslist;
		return $data;
	}

	/**
	 * 提交商品评论
	 */
	public function addAppraises(){
		$userId = (int)session('WST_USER.userId');
		$orderId = (int)I("orderId");
		$goodsId = (int)I("goodsId");
		$goodsAttrId = (int)I("goodsAttrId");
		$goodsScore = (int)I("goodsScore");
		$goodsScore = $goodsScore>5?5:$goodsScore;
		$goodsScore = $goodsScore<1?1:$goodsScore;
		$timeScore = (int)I("timeScore");
		$timeScore = $timeScore>5?5:$timeScore;
		$timeScore = $timeScore<1?1:$timeScore;
		$serviceScore = (int)I("serviceScore");
		$serviceScore = $serviceScore>5?5:$serviceScore;
		$serviceScore = $serviceScore<1?1:$serviceScore;

		$m = M('goods_appraises');
		//检查订单是否存在
		$sql = 'select shopId from __PREFIX__orders where orderId='.$orderId;
		$rs = $m->query($sql);
		if(empty($rs))return array('status'=>-1);//该订单不存在
		$shopId = $rs[0]['shopId'];
		//检查该订单下该商品是否已评论
		$sql = 'select * from __PREFIX__goods_appraises where goodsId='.$goodsId.' and goodsAttrId='.$goodsAttrId.' and orderId='.$orderId.' and shopId='.$shopId.' and userId='.$userId;
		$rs = $m->query($sql);
		if(!empty($rs))return array('status'=>-2);//该商品已评价过
        if($orderId==0 || $goodsId==0 || $goodsScore==0 || $timeScore==0 || $serviceScore==0)return array('status'=>-1);
		//新增评价记录
		$data = array();
		$data["goodsId"] = $goodsId;
		$data["goodsAttrId"] = $goodsAttrId;
		$data["shopId"] = $shopId;
		$data["userId"] = $userId;
		
		if($goodsScore==0 || $timeScore==0 || $serviceScore==0)return array('status'=>-1);

		$data["goodsScore"] = $goodsScore;
		$data["timeScore"] = $timeScore;
		$data["serviceScore"] = $serviceScore;
		$data["content"] = I("content");
		$data["isShow"] = 1;
		$data["createTime"] = date('Y-m-d H:i:s');
		$data["orderId"] = $orderId;
		$result = $m->add($data);
		if(false !== $rs){
			$data["totalScore"] = $data["goodsScore"]+$data["timeScore"]+$data["serviceScore"];
			
			$sql ="SELECT * FROM __PREFIX__goods_scores WHERE goodsId=$goodsId";
			$goodsScores = $this->queryRow($sql);
			
			if($goodsScores["goodsId"]>0){
				$sql = "UPDATE __PREFIX__goods_scores set 
						totalUsers = totalUsers +1 , totalScore = totalScore +".$data["totalScore"]."
						,goodsUsers = goodsUsers +1 , goodsScore = goodsScore +".$data["goodsScore"]."
						,timeUsers = timeUsers +1 , timeScore = timeScore +".$data["timeScore"]."
						,serviceUsers = serviceUsers +1 , serviceScore = serviceScore +".$data["serviceScore"]."
						WHERE goodsId = ".$goodsId;		
				$this->execute($sql);		
			}else{
				$data = array();
				$gm = M('goods_scores');
	
				$data["goodsId"] = $goodsId;
				$data["shopId"] = $shopId;
				
				$data["goodsScore"] = $goodsScore;
				$data["goodsUsers"] = 1;
				
				$data["timeScore"] = $timeScore;
				$data["timeUsers"] = 1;
				
				$data["serviceScore"] = $serviceScore;
				$data["serviceUsers"] = 1;
				
				$data["totalScore"] = (int)$data["goodsScore"]+$data["timeScore"]+$data["serviceScore"];
				$data["totalUsers"] = 1;
				
				$rs = $gm->add($data);
			}
			//检查下是不是订单的所有商品都评论完了
			$sql = "SELECT og.goodsId,ga.id as gaId
					FROM __PREFIX__order_goods og left join __PREFIX__goods_appraises ga on og.goodsAttrId=ga.goodsAttrId
					AND og.goodsId = ga.goodsId and ga.orderId=$orderId
					WHERE og.orderId = $orderId ";
			$goodslist = $this->query($sql);
			$gmark = 1;
			for($i=0;$i<count($goodslist);$i++){
				$goods = $goodslist[$i];
				if(!$goods["gaId"]) $gmark =0;
			}
			if($gmark==1){
				$sql="update __PREFIX__orders set isAppraises=1 where orderId=".$orderId;
				$this->execute($sql);
				//修改积分
				$appraisesScore = (int)$GLOBALS['CONFIG']['appraisesScore'];
				if((int)$GLOBALS['CONFIG']['isAppraisesScore']==1 && $appraisesScore>0){
	
					$sql = "UPDATE __PREFIX__users set userScore=userScore+".$appraisesScore.",userTotalScore=userTotalScore+".$appraisesScore." WHERE userId=".$userId;
					$rs = $this->execute($sql);
					
					$data = array();
					$m = M('user_score');
					$data["userId"] = $userId;
					$data["score"] = $appraisesScore;
					$data["dataSrc"] = 2;
					$data["dataId"] = $orderId;
					$data["dataRemarks"] = "订单评价获得";
					$data["scoreType"] = 1;
					$data["createTime"] = date('Y-m-d H:i:s');
					$m->add($data);
				}
			}
		}
		return array('status'=>1,'id'=>$result);
	}

	/**
	 * 获取指定商品评价
	*/
    public function getAppraiseById(){
	 	$m = M('goods_appraises');
	 	$id = (int)I('id');
	 	$sql = 'select goodsScore,timeScore,serviceScore,content from __PREFIX__goods_appraises where id='.$id;
		return $this->queryRow($sql);
	}

	/**
	 * 获取商品评论
	 */
	public function getAppraisesList(){
		$goodsId = (int)I('goodsId');
		$type = (int)I('type', 0);
		$currPage = (int)I("currPage", 1);
		$pageSize = I('pageSize') ? (int)I('pageSize') : 5;
		$sql = "select u.loginName,u.userName,u.userPhoto,gp.goodsScore,gp.serviceScore,gp.timeScore,gp.content,gp.createTime
		       from __PREFIX__goods_appraises gp left join __PREFIX__users u on gp.userId=u.userId
		       where isShow=1 and goodsId=".$goodsId;
		if($type>0){
			//差评
			if($type==1)$sql.=" and (gp.goodsScore+gp.serviceScore+gp.timeScore) <=6 ";
			//中评
			if($type==2)$sql.=" and (gp.goodsScore+gp.serviceScore+gp.timeScore) >6 and  (gp.goodsScore+gp.serviceScore+gp.timeScore)<10 ";
			//好评
			if($type==3)$sql.=" and (gp.goodsScore+gp.serviceScore+gp.timeScore) >=10 ";
		}

		$page =  $this->pageQuery($sql,$currPage,$pageSize);
		if( empty($page) ){
			return array();
		}
		foreach($page['root'] as $k=>$v){
			if( $v['userName'] == ''){
				$uName = substr_replace($v['loginName'], '****', 3, 4);
			}else{
				$uName = $v['userName'];
			}
			$page['root'][$k]['userName'] = $uName;
			unset($page['root'][$k]['loginName']);
		}

		//获取评价数量
		if($type==0){
			$sql = "select count(gp.id) counts
		       from __PREFIX__goods_appraises gp left join __PREFIX__users u on gp.userId=u.userId
		       where isShow=1 and goodsId=".$goodsId;
			$rs = $this->query($sql);
			$page['type']['all'] = (int)$rs[0]['counts'];
			//差评
			$sql2 = " and (gp.goodsScore+gp.serviceScore+gp.timeScore) <=6 ";
			$rs = $this->query($sql.$sql2);
			$page['type']['bad'] = (int)$rs[0]['counts'];
			//中评
			$sql2 = " and (gp.goodsScore+gp.serviceScore+gp.timeScore) >6 and  (gp.goodsScore+gp.serviceScore+gp.timeScore)<10 ";
			$rs = $this->query($sql.$sql2);
			$page['type']['middle'] = (int)$rs[0]['counts'];
			//好评
			$sql2 = " and (gp.goodsScore+gp.serviceScore+gp.timeScore) >=10 ";
			$rs = $this->query($sql.$sql2);
			$page['type']['good'] = (int)$rs[0]['counts'];
		}
		return $page;
	}

	/**
	 * 查询商品属性价格及库存
	 */
	public function getPriceAttrInfo(){
		$goodsId = (int)I("goodsId");
		$id = (int)I("id");
		$sql = "select id,attrPrice,attrStock from  __PREFIX__goods_attributes where goodsId=".$goodsId." and id=".$id;
		$rs = $this->query($sql);
		return $rs[0];
	}

	/**
	 * 获取商品库存
	 */
	public function getGoodsStock(){
		$goodsId = (int)I("goodsId");
		$goodsAttrId = (int)I("goodsAttrId");
		$isBook = (int)I("isBook");
		if($isBook==1){
			$sql = "select goodsId,(goodsStock+bookQuantity) as goodsStock from __PREFIX__goods where isSale=1 and goodsFlag=1 and goodsStatus=1 and goodsId=".$goodsId;
		}else{
			$sql = "select goodsId,goodsStock,attrCatId from __PREFIX__goods where isSale=1 and goodsFlag=1 and goodsStatus=1 and goodsId=".$goodsId;
		}
		$goods = $this->query($sql);
	 	if($goods[0]['attrCatId']>0){
	 		$sql = "select ga.id,ga.attrStock from __PREFIX__goods_attributes ga where ga.goodsId=".$goodsId." and id=".$goodsAttrId;
			$priceAttrs = $this->query($sql);
			if(!empty($priceAttrs))$goods[0]['goodsStock'] = $priceAttrs[0]['attrStock'];
	 	}
	 	if(empty($goods))return array();
	 	return $goods[0];
	 }
}