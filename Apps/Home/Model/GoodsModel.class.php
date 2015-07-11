<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
class GoodsModel extends BaseModel {
	
	/**
	 * 商品列表
	 */
	public function getGoodsList($obj){
		$areaId2 = $obj["areaId2"];
		$areaId3 = $obj["areaId3"];
		$communityId = I("communityId");
		$c1Id = I("c1Id",0);
		$c2Id = I("c2Id");
		$c3Id = I("c3Id");
		$pcurr = I("pcurr");
		$msort = I("msort",1);//排序标识
		$prices = I("prices");
		if($prices != ""){
			$pricelist = explode("_",$prices);
		}
		$brandId = I("brandId",0);
		
		$keyWords = I("keyWords");
		
		$sql = "SELECT  goodsId,goodsSn,goodsName,goodsThums,goodsStock,g.saleCount,p.shopId,marketPrice,shopPrice 
				FROM __PREFIX__goods g, __PREFIX__shops p ";
	    if($communityId>0){
			$sql .=" , __PREFIX__shops_communitys sc ";
		}
		
		if($brandId>0){
			$sql .=" , __PREFIX__brands bd ";
		}
		$sql .= "WHERE p.areaId2 = $areaId2 AND g.shopId = p.shopId AND  g.goodsStatus=1 AND g.goodsFlag = 1 and g.isSale=1 ";
		if($communityId>0){
			$sql .= " AND sc.shopId=p.shopId AND sc.communityId = $communityId ";
		}
		if($brandId>0){
			$sql .=" AND bd.brandId=g.brandId AND g.brandId = $brandId ";
		}
		if($c1Id>0){
			$sql .= " AND g.goodsCatId1 = $c1Id";
		}
		if($c2Id>0){
			$sql .= " AND g.goodsCatId2 = $c2Id";
		}
		if($c3Id>0){
			$sql .= " AND g.goodsCatId3 = $c3Id";
		}
		
		if($areaId3>0){
			$sql .= " AND p.areaId3 = $areaId3";
		}
		if($keyWords!=""){
			$sql .= " AND g.goodsName LIKE '%$keyWords%'";
		}
		$glist = $this->query($sql);
		$shops = array();
		$maxPrice = 0;
		for($i=0;$i<count($glist);$i++){
			$goods = $glist[$i];
			if($goods["shopPrice"]>$maxPrice){
				$maxPrice = $goods["shopPrice"];
			}
		}
	    if($prices != "" && $pricelist[0]>=0 && $pricelist[1]>=0){
			$sql .= " AND (g.shopPrice BETWEEN  ".(int)$pricelist[0]." AND ".(int)$pricelist[1].") ";
		}
	   
		if($msort==1){//综合
			$sql .= " ORDER BY g.saleCount DESC ";
		}else if($msort==6){//人气
			$sql .= " ORDER BY g.saleCount DESC ";
		}else if($msort==7){//销量
			$sql .= " ORDER BY g.saleCount DESC ";
		}else if($msort==8){//价格
			$sql .= " ORDER BY g.shopPrice ASC ";
		}else if($msort==9){//价格
			$sql .= " ORDER BY g.shopPrice DESC ";
		}else if($msort==10){//好评
				
		}else if($msort==11){//上架时间
			$sql .= " ORDER BY g.saleTime DESC ";
		}

		$pages = $this->pageQuery($sql,$pcurr,30);
		$rs["maxPrice"] = $maxPrice;
		$brands = array();
		$sql = "SELECT b.brandId, b.brandName FROM wst_brands b, wst_goods_cat_brands cb WHERE b.brandId = cb.brandId AND b.brandFlag=1 ";
		if($c1Id>0){
			$sql .= " AND cb.catId = $c1Id";
		}
		$sql .= " GROUP BY b.brandId";
		$blist = $this->query($sql);
		for($i=0;$i<count($blist);$i++){
			$brand = $blist[$i];
			$brands[$brand["brandId"]] = array('brandId'=>$brand["brandId"],'brandName'=>$brand["brandName"]);
		}
		$rs["brands"] = $brands;
		$rs["pages"] = $pages;
		$gcats["goodsCatId1"] = $c1Id;
		$gcats["goodsCatId2"] = $c2Id;
		$gcats["goodsCatId3"] = $c3Id;
		$rs["goodsNav"] = self::getGoodsNav($gcats);
		return $rs;
	}
	
	
	/**
	 * 商品列表
	 */
	public function getMaxPrice($obj){
		$areaId2 = $obj["areaId2"];

		$c1Id = I("c1Id");
		$c2Id = I("c2Id");
		$c3Id = I("c3Id");
		
		$keyWords = I("keyWords");
		
		$sql = "SELECT bd.brandId,bd.brandName, goodsId,goodsSn,goodsName,goodsThums,g.saleCount,p.shopId,marketPrice,shopPrice,p.shopName 
				FROM __PREFIX__goods g , __PREFIX__brands bd, __PREFIX__shops p ";
		$sql .= "WHERE p.areaId2 = $areaId2 AND g.shopId = p.shopId AND bd.brandId=p.brandId AND  g.goodsStatus=1 AND g.goodsFlag = 1";
		
		if($c1Id>0){
			$sql .= " AND g.goodsCatId1 = $c1Id";
		}
		if($c2Id>0){
			$sql .= " AND g.goodsCatId2 = $c2Id";
		}
		if($c3Id>0){
			$sql .= " AND g.goodsCatId3 = $c3Id";
		}
		if($keyWords!=""){
			$sql .= " AND g.goodsName LIKE '%$keyWords%'";
		}
		$sql .= " ORDER BY g.saleCount DESC";
		$glist = $this->query($sql);
		
		$maxPrice = 0;
		for($i=0;$i<count($glist);$i++){
			$goods = $glist[$i];
			if($goods["shopPrice"]>$maxPrice){
				$maxPrice = $goods["shopPrice"];
			}
		}

		return $maxPrice;
	}
	

	/**
	 * 查询商品信息
	 */
	public function getGoodsDetails($obj){		
		$goodsId = $obj["goodsId"];
		$sql = "SELECT sc.catName,sc2.catName as pCatName, g.*,shop.shopName,shop.deliveryType,shop.shopAtive,
				shop.shopTel,shop.shopAddress,shop.deliveryTime,shop.isInvoice, shop.deliveryStartMoney, 
				shop.deliveryFreeMoney,shop.deliveryMoney ,g.goodsSn,shop.serviceStartTime,shop.serviceEndTime
				FROM __PREFIX__goods g, __PREFIX__shops shop, __PREFIX__shops_cats sc 
				LEFT JOIN __PREFIX__shops_cats sc2 ON sc.parentId = sc2.catId
				WHERE g.goodsId = $goodsId AND shop.shopId=sc.shopId AND sc.catId=g.shopCatId1 AND g.shopId = shop.shopId AND g.goodsFlag = 1 ";		
		$rs = $this->query($sql);
		return $rs[0];
		
	}
	
	
	/**
	 * 获取商品相册
	 */
	public function getGoodsImgs(){
		
		$goodsId = I("goodsId");
	
		$sql = "SELECT img.* FROM __PREFIX__goods_gallerys img WHERE img.goodsId = $goodsId ";		
		$rs = $this->query($sql);
		//print_r($rs);
		return $rs;
		
	}
	
	
	/**
	 * 获取关联商品
	 */
	public function getRelatedGoods(){
		
		$goodsId = I("goodsId");
		$sql = "SELECT g.* FROM __PREFIX__goods g, ".DB_PRE."goods_relateds gr WHERE g.goodsId = gr.relatedGoodsId AND g.goodsStock>0 AND g.goodsStatus = 1 AND gr.goodsId =$goodsId";
		$rs = $this->query($sql);
		return $rs;
		
	}
	
	/**
	 * 获取上架中的商品
	 */
	public function queryOnSaleByPage(){
		$shopId=(int)session('WST_USER.shopId');
		$shopCatId1 = I('shopCatId1',0);
		$shopCatId2 = I('shopCatId2',0);
		$goodsName = I('goodsName');
		$sql = "select goodsId,goodsSn,goodsName,goodsImg,goodsThums,shopPrice,goodsStock,isSale,isRecomm,isHot,isBest,isNew from __PREFIX__goods where goodsFlag=1 
		     and shopId=".$shopId." and goodsStatus=1 and isSale=1 ";
		if($shopCatId1>0)$sql.=" and shopCatId1=".$shopCatId1;
		if($shopCatId2>0)$sql.=" and shopCatId2=".$shopCatId2;
		if($goodsName!='')$sql.=" and (goodsName like '%".$goodsName."%' or goodsSn like '%".$goodsName."%') ";
		$sql.=" order by goodsId desc";
		return $this->pageQuery($sql);
	}
    /**
	 * 获取下架的商品
	 */
	public function queryUnSaleByPage(){
		$shopId=(int)session('WST_USER.shopId');
		$shopCatId1 = I('shopCatId1',0);
		$shopCatId2 = I('shopCatId2',0);
		$goodsName = I('goodsName');
		$sql = "select goodsId,goodsSn,goodsName,goodsImg,goodsThums,shopPrice,goodsStock,isSale,isRecomm,isHot,isBest,isNew from __PREFIX__goods where goodsFlag=1 
		      and shopId=".$shopId." and isSale=0 ";
		if($shopCatId1>0)$sql.=" and shopCatId1=".$shopCatId1;
		if($shopCatId2>0)$sql.=" and shopCatId2=".$shopCatId2;
		if($goodsName!='')$sql.=" and (goodsName like '%".$goodsName."%' or goodsSn like '%".$goodsName."%') ";
		$sql.=" order by goodsId desc";
		return $this->pageQuery($sql);
	}
    /**
	 * 获取审核中的商品
	 */
	public function queryPenddingByPage(){
		$shopId=(int)session('WST_USER.shopId');
		$shopCatId1 = I('shopCatId1',0);
		$shopCatId2 = I('shopCatId2',0);
		$goodsName = I('goodsName');
		$sql = "select goodsId,goodsSn,goodsName,goodsImg,goodsThums,shopPrice,goodsStock,isSale,isRecomm,isHot,isBest,isNew from __PREFIX__goods where goodsFlag=1 
		     and shopId=".$shopId." and goodsStatus=0 and isSale=1 ";
		if($shopCatId1>0)$sql.=" and shopCatId1=".$shopCatId1;
		if($shopCatId2>0)$sql.=" and shopCatId2=".$shopCatId2;
		if($goodsName!='')$sql.=" and (goodsName like '%".$goodsName."%' or goodsSn like '%".$goodsName."%') ";
		$sql.=" order by goodsId desc";
		return $this->pageQuery($sql);
	}
	/**
	 * 新增商品
	 */
	public function add(){
	 	$rd = array('status'=>-1);
	 	$id = I("id",0);
		$data = array();
		$data["goodsSn"] = I("goodsSn");
		$data["goodsName"] = I("goodsName");
		$data["goodsImg"] = I("goodsImg");
		$data["goodsThums"] = I("goodsThumbs");
		$data["shopId"] = session('WST_USER.shopId');
		$data["marketPrice"] = I("marketPrice",0);
		$data["shopPrice"] = I("shopPrice",0);
		$data["goodsStock"] = I("goodsStock",0);
		$data["isBook"] = I("isBook",0);
		$data["bookQuantity"] = I("bookQuantity",0);
		$data["warnStock"] = I("warnStock",0);
		$data["goodsUnit"] = I("goodsUnit");
		$data["isBest"] = I("isBest",0);
		$data["isRecomm"] = I("isRecomm",0);
		$data["isNew"] = I("isNew",0);
		$data["isHot"] = I("isHot",0);
		$data["isSale"] = I("isSale",0);
		$data["goodsCatId1"] = I("goodsCatId1");
		$data["goodsCatId2"] = I("goodsCatId2");
		$data["goodsCatId3"] = I("goodsCatId3");
		$data["shopCatId1"] = I("shopCatId1");
		$data["shopCatId2"] = I("shopCatId2");
		$data["goodsDesc"] = I("goodsDesc");
		$data["isShopRecomm"] = 0;
		$data["isIndexRecomm"] = 0;
		$data["isActivityRecomm"] = 0;
		$data["isInnerRecomm"] = 0;
		$data["goodsStatus"] = ($GLOBALS['CONFIG']['isGoodsVerify']==1)?0:1;
		$data["goodsFlag"] = 1;
		$data["createTime"] = date('Y-m-d H:i:s');
		if($this->checkEmpty($data,true)){
			$data["brandId"] = I("brandId",0);
			$data["goodsSpec"] = I("goodsSpec");
			$m = M('goods');
			$rs = $m->add($data);
			if(false !== $rs){
				$rd['status']= 1;
				//保存相册
				$gallery = I("gallery");
				if($gallery!=''){
					$str = explode(',',$gallery);
					foreach ($str as $k => $v){
						if($v=='')continue;
						$str1 = explode('@',$v);
						$data = array();
						$data['shopId'] = session('WST_USER.shopId');
						$data['goodsId'] = $rs;
						$data['goodsImg'] = $str1[0];
						$data['goodsThumbs'] = $str1[1];
						$m = M('goods_gallerys');
						$m->add($data);
					}
				}
			}
		}
		return $rd;
	} 
	 
	/**
	 * 编辑商品信息
	 */
	public function edit(){
		$rd = array('status'=>-1);
	 	$id = I("id",0);
	 	$shopId = (int)session('WST_USER.shopId');
	 	//加载商品信息
	 	$m = M('goods');
	 	$goods = $m->where('goodsId='.$id." and shopId=".$shopId)->find();
	 	if(empty($goods))return array();
		$data = array();
		$data["goodsSn"] = I("goodsSn");
		$data["goodsName"] = I("goodsName");
		$data["goodsImg"] = I("goodsImg");
		$data["goodsThums"] = I("goodsThumbs");
		$data["marketPrice"] = I("marketPrice",0);
		$data["shopPrice"] = I("shopPrice",0);
		$data["goodsStock"] = I("goodsStock",0);
		$data["isBook"] = I("isBook",0);
		$data["bookQuantity"] = I("bookQuantity",0);
		$data["warnStock"] = I("warnStock",0);
		$data["goodsUnit"] = I("goodsUnit");
		$data["isBest"] = I("isBest",0);
		$data["isRecomm"] = I("isRecomm",0);
		$data["isNew"] = I("isNew",0);
		$data["isHot"] = I("isHot",0);
		$data["isSale"] = I("isSale",0);
		$data["goodsCatId1"] = I("goodsCatId1");
		$data["goodsCatId2"] = I("goodsCatId2");
		$data["goodsCatId3"] = I("goodsCatId3");
		$data["shopCatId1"] = I("shopCatId1");
		$data["shopCatId2"] = I("shopCatId2");
		$data["goodsDesc"] = I("goodsDesc");
		$data["goodsStatus"] = ($GLOBALS['CONFIG']['isGoodsVerify']['fieldValue']==1)?0:1;
		if($this->checkEmpty($data,true)){
			$data["brandId"] = I("brandId",0);
			$data["goodsSpec"] = I("goodsSpec");
			$rs = $m->where('goodsId='.$goods['goodsId'])->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			    //保存相册
				$gallery = I("gallery");
				if($gallery!=''){
					$str = explode(',',$gallery);
					$m = M('goods_gallerys');
					//删除相册信息
					$m->where('goodsId='.$goods['goodsId'])->delete();
					//保存相册信息
					foreach ($str as $k => $v){
						if($v=='')continue;
						$str1 = explode('@',$v);
						$data = array();
						$data['shopId'] = $goods['shopId'];
						$data['goodsId'] = $goods['goodsId'];
						$data['goodsImg'] = $str1[0];
						$data['goodsThumbs'] = $str1[1];
						$m->add($data);
					}
				}
			}
		}
		return $rd;
	}
	/**
	 * 获取商品信息
	 */
	 public function get(){
	 	$m = M('goods');
	 	$id = I('id',0);
	 	$shopId = (int)session('WST_USER.shopId');
		$goods = $m->where("goodsId=".$id." and shopId=".$shopId)->find();
		if(empty($goods))return array();
		$m = M('goods_gallerys');
		$goods['gallery'] = $m->where('goodsId='.$id)->select();
		return $goods;
	 }
	 /**
	  * 删除商品
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	$m = M('goods');
	 	$shopId = (int)session('WST_USER.shopId');
	 	$data = array();
		$data["goodsFlag"] = -1;
	 	$rs = $m->where("shopId=".$shopId." and goodsId=".I('id'))->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
	 
	 /**
	  * 批量删除商品
	  */
	 public function batchDel(){
	 	$rd = array('status'=>-1);
	 	$m = M('goods');
	 	$shopId = (int)session('WST_USER.shopId');
	 	$data = array();
		$data["goodsFlag"] = -1;
	 	$rs = $m->where("shopId=".$shopId." and goodsId in(".I('ids').")")->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
	 /**
	  * 批量修改商品状态
	  */
	 public function goodsSet(){
	 	$rd = array('status'=>-1);
	 	$code = I('code');
	 	$codeArr = array('isBest','isNew','isHot','isRecomm');
	 	if(in_array($code,$codeArr)){
		 	$m = M('goods');
		 	$shopId = (int)session('WST_USER.shopId');
		 	$data = array();
			$data[$code] = 1;
		 	$rs = $m->where("shopId=".$shopId." and goodsId in(".I('ids').")")->save($data);
		    if(false !== $rs){
				$rd['status']= 1;
			}
	 	}
		return $rd;
	 }
     /**
	  * 批量上架/下架商品
	  */
	 public function sale(){
	 	$rd = array('status'=>-1);
	 	$m = M('goods');
	 	$shopId = (int)session('WST_USER.shopId');
	 	$data = array();
		$data["isSale"] = I('isSale');
	 	$rs = $m->where("shopId=".$shopId." and goodsId in(".I('ids').")")->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
	 
	/**
	 * 获取门店商品列表
	 */
	public function getShopsGoods(){
		
		$shopId = I("shopId",0);
		$ct1 = I("ct1",0);
		$ct2 = I("ct2",0);
		$msort = I("msort",0);//排序標識		
		
		$sprice = I("sprice");//开始价格
		$eprice = I("eprice");//结束价格
		$goodsName = I("goodsName");//搜索店鋪名
		$sql = "SELECT sp.shopName, SUM(og.goodsNums) totalnum, sp.shopId ,g.goodsStock, g.goodsId , g.goodsName,g.goodsImg, g.goodsThums,g.shopPrice,g.marketPrice, g.goodsSn 
						FROM __PREFIX__goods g
						LEFT JOIN __PREFIX__order_goods og ON g.goodsId = og.goodsId,
						__PREFIX__shops sp 
						WHERE g.shopId = sp.shopId AND g.goodsFlag = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.shopId = $shopId";
		
		if($ct1>0){
			$sql .= " AND g.shopCatId1 = $ct1 ";
		}
		if($ct2>0){
			$sql .= " AND g.shopCatId2 = $ct2 ";
		}
		if($sprice!=""){
			$sql .= " AND g.shopPrice >= '$sprice' ";
		}
		if($eprice!=""){
			$sql .= " AND g.shopPrice <= '$eprice' ";
		}
		if($goodsName!=""){
			$sql .= " AND g.goodsName like '%$goodsName%' ";
		}
		$sql .= " GROUP BY g.goodsId ";
		if($msort==1){//综合
			$sql .= " ORDER BY SUM(og.goodsNums) DESC ";
		}else if($msort==2){//人气
			$sql .= " ORDER BY SUM(og.goodsNums) DESC ";
		}else if($msort==3){//销量
			$sql .= " ORDER BY SUM(og.goodsNums) DESC ";
		}else if($msort==4){//价格
			$sql .= " ORDER BY g.shopPrice ASC ";
		}else if($msort==5){//价格
			$sql .= " ORDER BY g.shopPrice DESC ";
		}else if($msort==6){//好评
			
		}else if($msort==7){//上架时间
			$sql .= " ORDER BY g.saleTime DESC ";
		}
		$rs = $this->query($sql);
		return $rs;
		
	}
	
	
	/**
	 * 获取门店商品列表
	 */
	public function getHotGoods($shopId){
		//热销排名
		$sql = "SELECT sp.shopName, SUM(og.goodsNums) totalnum, sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsThums,g.shopPrice,g.marketPrice, g.goodsSn 
						FROM __PREFIX__goods g
						LEFT JOIN __PREFIX__order_goods og ON g.goodsId = og.goodsId,
						__PREFIX__shops sp 
						WHERE g.shopId = sp.shopId AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND sp.shopId = $shopId
						GROUP BY g.goodsId ORDER BY SUM(og.goodsNums) desc limit 5";
				
		$hotgoods = $this->query($sql);
		return  $hotgoods;
	}
	
	/**
	 * 獲取商品庫存
	 */
	public function getGoodsStock(){
	 	$id = ('goodsId');
		$isBook = ('isBook');
		if($isBook==1){
			$sql = "select goodsId,(goodsStock+bookQuantity) as goodsStock from __PREFIX__goods where goodsId=".$id;
		}else{
			$sql = "select goodsId,goodsStock from __PREFIX__goods where goodsId=".$id;
		}
	 	$goods = $this->query($sql);
	 	return $goods[0];
	 }
	 
	 
	/**
	 * 查询商品简单信息
	 */
	public function getGoodsInfo($goodsId){		
		$sql = "SELECT g.goodsId,g.goodsName,g.goodsStock,g.bookQuantity,g.isBook,g.isSale FROM __PREFIX__goods g WHERE g.goodsId = $goodsId AND g.goodsFlag = 1 AND g.goodsStatus = 1";		
		$rs = $this->queryRow($sql);

		return $rs;
		
	}
	
	/**
	 * 查询商品简单信息
	 */
	public function getGoodsSimpInfo($goodsId){		
		
		$sql = "SELECT g.*,sp.shopId,sp.shopName,sp.deliveryFreeMoney,sp.deliveryMoney,sp.deliveryStartMoney,sp.isInvoice,sp.serviceStartTime startTime,sp.serviceEndTime endTime,sp.deliveryType 
				FROM __PREFIX__goods g, __PREFIX__shops sp 
				WHERE g.shopId = sp.shopId AND g.goodsId = $goodsId AND g.goodsFlag = 1 AND g.goodsStatus = 1";
		$rs = $this->queryRow($sql);
		return $rs;
		
	}
	

	/**
	 * 查询商品评价
	 */
	public function getGoodsAppraises(){		
		$goodsId = I("goodsId");
		$pcurr = I("pcurr",0);
		$pageSize = 20;
		$sql = "SELECT ga.*, u.userName,u.loginName, od.createTime as ocreateTIme 
				FROM __PREFIX__goods_appraises ga , __PREFIX__orders od , __PREFIX__users u 
				WHERE ga.userId = u.userId AND ga.orderId = od.orderId AND ga.goodsId = $goodsId AND ga.isShow =1";		
		$data = $this->pageQuery($sql,$pcurr,$pageSize);	
		return $data;

	}
	
	/**
	 * 获取商品类别导航
	 */
	public function getGoodsNav($obj=array()){
		
		$goodsId = I("goodsId");
		if($goodsId>0){
			$sql = "SELECT goodsCatId1,goodsCatId2,goodsCatId3 FROM __PREFIX__goods WHERE goodsId = $goodsId";
			$rs = $this->queryRow($sql);
		}else{
			$rs = $obj;
		}
		$gclist = M('goods_cats')->cache('WST_CACHE_GOODS_CATES_000',31536000)->where('isShow = 1')->field('catId,catName')->order('catId')->select();
		$catslist = array();
		foreach ($gclist as $key => $gcat) {
			$catslist[$gcat["catId"]] = $gcat;
		}
		
		$data[] = $catslist[$rs["goodsCatId1"]];
		$data[] = $catslist[$rs["goodsCatId2"]];
		$data[] = $catslist[$rs["goodsCatId3"]];
		return $data;
	}
}