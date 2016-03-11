<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 关注商品/店铺服务类
 */
class FavoritesModel extends BaseModel {
	/**
	 * 关注商品
	 */
	public function favoriteGoods(){
		$rd = array('status'=>-1);
		$id = (int)I('id');
		//检测商品是否存在
		$sql = "select goodsId from __PREFIX__goods where goodsFlag=1 and isSale=1 and goodsStatus=1 and goodsId=".$id;
		$rs = $this->query($sql);
		if(!empty($sql)){
			$data = array();
			$data['userId'] = (int)session('WST_USER.userId');
			$data['favoriteType'] = 0;
			$data['targetId'] = $id;
			$data['createTime'] = date('Y-m-d H:i:s');
			if($this->checkEmpty($data)){
				$m = M('favorites');
				$rs = $m->add($data);
			    if(false !== $rs){
					$rd['status']= 1;
					$rd['id']= $rs;
				}
			}
		}
		return $rd;
	}
	
    /**
	 * 关注店铺
	 */
	public function favoriteShops(){
		$rd = array('status'=>-1);
		$id = (int)I('id');
		//检测商品是否存在
		$sql = "select shopId from __PREFIX__shops where shopFlag=1 and shopStatus=1 and shopId=".$id;
		$rs = $this->query($sql);
		if(!empty($sql)){
			$data = array();
			$data['userId'] = (int)session('WST_USER.userId');
			$data['favoriteType'] = 1;
			$data['targetId'] = $id;
			$data['createTime'] = date('Y-m-d H:i:s');
			if($this->checkEmpty($data)){
				$m = M('favorites');
				$rs = $m->add($data);
			    if(false !== $rs){
					$rd['status']= 1;
					$rd['id']= $rs;
				}
			}
		}
		return $rd;
	}
	
	/**
	 * 判断是否已关注
	 */
	public function checkFavorite($id,$type){
		//检测商品是否存在
		$sql = "select favoriteId from __PREFIX__favorites where favoriteType=".$type." and targetId=".$id." and userId=".(int)session('WST_USER.userId');
	    $rs = $this->queryRow($sql);
	    return empty($rs)?0:$rs['favoriteId'];
	}
	/**
	 * 取消关注
	 */
	public function cancelFavorite(){
		$rd = array('status'=>-1);
		$id = (int)I('id');
		$type = (int)I('type');
		$m = M('favorites');
		$rs = $m->where('favoriteType='.$type." and favoriteId=".$id." and userId=".(int)session('WST_USER.userId'))->delete();
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	}
	
	/**
	 * 获取关注列表
	 */
	public function queryGoodsByPage(){
		$key = WSTAddslashes(I('key'));
		$sql = "select f.favoriteId,g.goodsId,g.goodsThums,g.goodsName,g.isSale,g.shopPrice,g.saleCount,ga.id goodsAttrId 
			from __PREFIX__favorites f ,__PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1
			where f.targetId = g.goodsId and g.goodsStatus=1 and g.goodsFlag=1 
			and favoriteType=0 and userId=".(int)session('WST_USER.userId');
		if($key!='')$sql.=" and g.goodsName like '%".$key."%'";
		$sql.=" order by f.favoriteId desc";
	    return $this->pageQuery($sql);
	}
	
    /**
	 * 获取关注列表
	 */
	public function queryShopsByPage(){
		$key = WSTAddslashes(I('key'));
		$sql = "select f.favoriteId,p.shopId,p.shopName,p.shopImg
			from __PREFIX__favorites f ,__PREFIX__shops p
			where f.targetId = p.shopId and p.shopStatus=1 and p.shopFlag=1 
			and favoriteType=1 and f.userId=".(int)session('WST_USER.userId');
		if($key!='')$sql.=" and p.shopName like '%".$key."%'";
		$sql.=" order by f.favoriteId desc";
	    return $this->pageQuery($sql);
	}
}