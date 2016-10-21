<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
class GoodsModel extends BaseModel {
    
	/**
	 * 获取商品信息
	 */
	 public function get(){
	 	$m = M('goods');
	 	$id = (int)I('id',0);
		$goods = $this->where("goodsId=".$id)->find();
		//相册
		$m = M('goods_gallerys');
		$goods['gallery'] = $m->where('goodsId='.$id)->select();
		//商城分类
		$sql = "select c1.catName goodsName1,c2.catName goodsName2,c3.catName goodsName3
		        from __PREFIX__goods_cats c3 , __PREFIX__goods_cats c2,__PREFIX__goods_cats c1
		        where c3.parentId=c2.catId and c2.parentId=c1.catId and c3.catId=".$goods['goodsCatId3'];
		$rs = $this->query($sql);
		$goods['goodsCats'] = $rs[0];
		//店铺分类
		$sql = "select c1.catName goodsName1,c2.catName goodsName2
		        from __PREFIX__shops_cats c2 ,__PREFIX__shops_cats c1
		        where c2.parentId=c1.catId and c2.catId=".$goods['shopCatId2'];
		$rs = $this->query($sql);
		$goods['shopCats'] = $rs[0];
		//属性
		if($goods['attrCatId']>0){
			$sql = "select catName from __PREFIX__attribute_cats where catId=".$goods['attrCatId'];
			$rs = $this->query($sql);
		    $goods['attrCatName'] = $rs[0]['catName'];
		    
			//获取规格属性
			$sql = "select ga.attrVal,ga.attrPrice,ga.attrStock,a.attrId,a.attrName,a.isPriceAttr,ga.isRecomm
			            ,ga.isRecomm from __PREFIX__attributes a 
			            left join __PREFIX__goods_attributes ga on ga.attrId=a.attrId and ga.goodsId=".$id." where  
						a.attrFlag=1 and a.catId=".$goods['attrCatId']." and a.shopId=".$goods['shopId'];
			$attrRs = $this->query($sql);
			if(!empty($attrRs)){
				$priceAttr = array();
				$attrs = array();
				foreach ($attrRs as $key =>$v){
					if($v['isPriceAttr']==1){
						$goods['priceAttrName'] = $v['attrName'];
						$priceAttr[] = $v;
					}else{
						$v['attrContent'] = $v['attrVal'];
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
	  * 分页列表[获取待审核列表]
	  */
     public function queryPenddingByPage(){
        $shopName = WSTAddslashes(I('shopName'));
     	$goodsName = WSTAddslashes(I('goodsName'));
     	$areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
     	$goodsCatId1 = (int)I('goodsCatId1',0);
     	$goodsCatId2 = (int)I('goodsCatId2',0);
     	$goodsCatId3 = (int)I('goodsCatId3',0);
	 	$sql = "select g.*,gc.catName,sc.catName shopCatName,p.shopName from __PREFIX__goods g 
	 	      left join __PREFIX__goods_cats gc on g.goodsCatId3=gc.catId 
	 	      left join __PREFIX__shops_cats sc on sc.catId=g.shopCatId2,__PREFIX__shops p 
	 	      where goodsStatus=0 and goodsFlag=1 and p.shopId=g.shopId and g.isSale=1";
	 	if($areaId1>0)$sql.=" and p.areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and p.areaId2=".$areaId2;
	 	if($goodsCatId1>0)$sql.=" and g.goodsCatId1=".$goodsCatId1;
	 	if($goodsCatId2>0)$sql.=" and g.goodsCatId2=".$goodsCatId2;
	 	if($goodsCatId3>0)$sql.=" and g.goodsCatId3=".$goodsCatId3;
	 	if($shopName!='')$sql.=" and (p.shopName like '%".$shopName."%' or p.shopSn like '%".$shopName."%')";
	 	if($goodsName!='')$sql.=" and (g.goodsName like '%".$goodsName."%' or g.goodsSn like '%".$goodsName."%')";
	 	$sql.="  order by goodsId desc";
		return $this->pageQuery($sql);
	 }
	 /**
	  * 分页列表[获取已审核列表]
	  */
     public function queryByPage(){
        $shopName = WSTAddslashes(I('shopName'));
     	$goodsName = WSTAddslashes(I('goodsName'));
     	$areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
     	$goodsCatId1 = (int)I('goodsCatId1',0);
     	$goodsCatId2 = (int)I('goodsCatId2',0);
     	$goodsCatId3 = (int)I('goodsCatId3',0);
     	$isAdminBest = (int)I('isAdminBest',-1);
     	$isAdminRecom = (int)I('isAdminRecom',-1);
	 	$sql = "select g.*,gc.catName,sc.catName shopCatName,p.shopName from __PREFIX__goods g 
	 	      left join __PREFIX__goods_cats gc on g.goodsCatId3=gc.catId 
	 	      left join __PREFIX__shops_cats sc on sc.catId=g.shopCatId2,__PREFIX__shops p 
	 	      where goodsStatus=1 and goodsFlag=1 and p.shopId=g.shopId and g.isSale=1";
	 	if($areaId1>0)$sql.=" and p.areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and p.areaId2=".$areaId2;
	 	if($goodsCatId1>0)$sql.=" and g.goodsCatId1=".$goodsCatId1;
	 	if($goodsCatId2>0)$sql.=" and g.goodsCatId2=".$goodsCatId2;
	 	if($goodsCatId3>0)$sql.=" and g.goodsCatId3=".$goodsCatId3;
	 	if($isAdminBest>=0)$sql.=" and g.isAdminBest=".$isAdminBest;
	 	if($isAdminRecom>=0)$sql.=" and g.isAdminRecom=".$isAdminRecom;
	 	if($shopName!='')$sql.=" and (p.shopName like '%".$shopName."%' or p.shopSn like '%".$shopName."%')";
	 	if($goodsName!='')$sql.=" and (g.goodsName like '%".$goodsName."%' or g.goodsSn like '%".$goodsName."%')";
	 	$sql.="  order by goodsId desc";   
		return $this->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $sql = "select * from __PREFIX__goods order by goodsId desc";
		 return $this->find($sql);
	  }
	 /**
	  * 修改商品状态
	  */
	 public function changeGoodsStatus(){
	 	$rd = array('status'=>-1);
	 	$ids = I('id',0);
	 	$ids = explode(',',$ids);
	 	foreach($ids as $k=>$id)
	 	{
		 	$this->goodsStatus = (int)I('status',0);
			$rs = $this->where('goodsId='.$id)->save();
			if(false !== $rs){
				$sql = "select goodsName,userId from __PREFIX__goods g,__PREFIX__shops s where g.shopId=s.shopId and g.goodsId=".$id;
				$goods = $this->query($sql);
				$msg = "";
				if(I('status',0)==0){
					$msg = "商品[".$goods[0]['goodsName']."]已被商城下架";
				}else{
					$msg = "商品[".$goods[0]['goodsName']."]已通过审核";
				}
				$yj_data = array(
					'msgType' => 0,
					'sendUserId' => session('WST_STAFF.staffId'),
					'receiveUserId' => $goods[0]['userId'],
					'msgContent' => $msg,
					'createTime' => date('Y-m-d H:i:s'),
					'msgStatus' => 0,
					'msgFlag' => 1,
				);
				M('messages')->add($yj_data);
				$rd['status'] = 1;
	 		}
		}

		return $rd;
	 }
	 /**
	  * 获取待审核的商品数量
	  */
	 public function queryPenddingGoodsNum(){
	 	$rd = array('status'=>-1);
	 	$sql="select count(*) counts from __PREFIX__goods where goodsStatus=0 and goodsFlag=1 and isSale=1";
	 	$rs = $this->query($sql);
	 	$rd['num'] = $rs[0]['counts'];
	 	return $rd;
	 }
	 /**
	  * 批量修改精品状态
	  */
	 public function changeBestStatus(){
	 	$rd = array('status'=>-1);
	 	$id = I('id',0);
	 	$id = self::formatIn(",", $id);
	 	$this->isAdminBest = (int)I('status',0);
		$rs = $this->where('goodsId in('.$id.")")->save();
		if(false !== $rs){
			$rd['status'] = 1;
		}
		return $rd;
	 }
     /**
	  * 批量修改推荐状态
	  */
	 public function changeRecomStatus(){
	 	$rd = array('status'=>-1);
	 	$id = I('id',0);
	 	$id = self::formatIn(",", $id);
	 	$this->isAdminRecom = (int)I('status',0);
		$rs = $this->where('goodsId in('.$id.")")->save();
		if(false !== $rs){
			$rd['status'] = 1;
		}
		return $rd;
	 }
	 
	 
};
?>