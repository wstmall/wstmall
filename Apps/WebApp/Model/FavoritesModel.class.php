<?php
namespace WebApp\Model;
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
	 * 获取关注的商品列表
	 */
	public function getFavoritesGoodsList(){
		$currPage = (int)I("currPage", 0);
		$key = WSTAddslashes( I('favoriteKey') );
		$pageSize = ( I('pageSize') ? (int)I('pageSize') : 10 );
		$sql = "select f.favoriteId,g.goodsId,g.goodsThums favoriteImg,g.goodsName favoriteName,g.isSale,g.shopPrice,g.saleCount,ga.id goodsAttrId,ga.attrPrice 
			from __PREFIX__favorites f ,__PREFIX__goods g left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1
			where f.targetId = g.goodsId and g.goodsStatus=1 and g.goodsFlag=1 
			and f.favoriteType=0 and f.userId=".(int)session('WST_USER.userId');
		if($key!='')$sql .= " and g.goodsName like '%".$key."%'";
		$sql .= ' order by f.favoriteId desc';
	    $page = $this->pageQuery($sql,$currPage,$pageSize);

		if(count($page['root']) > 0){
			foreach ($page['root'] as $key =>$v){
				$page['root'][$key]['favoriteImg'] = WSTMoblieImg($v['favoriteImg']);
				if($page['root'][$key]['goodsAttrId']>0){
					$page['root'][$key]['shopPrice'] = $v['attrPrice'];
				}else{
					$page['root'][$key]['goodsAttrId'] = 0;
				}
			}
		}
		return $page;
	}
	
    /**
	 * 获取关注的店铺列表
	 */
	public function getFavoritesShopsList(){
		$currPage = (int)I("currPage", 0);
		$key = WSTAddslashes( I('favoriteKey') );
		$pageSize = ( I('pageSize') ? (int)I('pageSize') : 10 );
		$sql = "select f.favoriteId,p.shopId,p.isSelf,p.shopName favoriteName,p.shopImg favoriteImg
			from __PREFIX__favorites f ,__PREFIX__shops p
			where f.targetId = p.shopId and p.shopStatus=1 and p.shopFlag=1 
			and f.favoriteType=1 and f.userId=".(int)session('WST_USER.userId');
		if($key!='')$sql .= " and p.shopName like '%".$key."%'";
		$sql .= " order by f.favoriteId desc";
	    $page = $this->pageQuery($sql,$currPage,$pageSize);
	    if(count($page['root']) > 0){
			foreach ($page['root'] as $key => $v){
				$page['root'][$key]['favoriteImg'] = WSTMoblieImg($v['favoriteImg']);
			}
		}
	    return $page;
	}

	/**
	 * 关注商品或店铺
	 */
	public function favorite(){
		$rd = array('status'=>-1);
		$rs = array();
		$targetId = (int)I('targetId');
		$favoriteType = (int)I('favoriteType', 0);
		//检测商品或店铺是否存在
		if( $favoriteType == 1 ){
			$sql = "select shopId from __PREFIX__shops where shopFlag=1 and shopStatus=1 and shopId=".$targetId;
		}else{
			$sql = "select goodsId from __PREFIX__goods where goodsFlag=1 and isSale=1 and goodsStatus=1 and goodsId=".$targetId;
		}
		$rs = $this->query($sql);
		if( !empty($rs) ){
			$data = array();
			$data['userId'] = (int)session('WST_USER.userId');
			$data['favoriteType'] = $favoriteType;
			$data['targetId'] = $targetId;
			$data['createTime'] = date('Y-m-d H:i:s');
			if( $this->checkEmpty($data) ){
				$rs = $this->add($data);
			    if(false !== $rs){
					$rd['status'] = 1;
				}
			}
		}
		return $rd;
	}
	
	/**
	 * 检查是否已关注
	 */
	public function checkFavorite($id, $type){
		$sql = "select favoriteId from __PREFIX__favorites where favoriteType=".$type." and targetId=".$id." and userId=".(int)session('WST_USER.userId');
	    $rs = $this->queryRow($sql);
	    return empty($rs) ? 0 : $rs['favoriteId'];
	}

	/**
	 * 取消关注
	 */
	public function cancelFavorite(){
		$rs = array('status'=>-1);
		$favoriteId = (int)I('favoriteId');
		$rd = $this->where("favoriteId=".$favoriteId." and userId=".(int)session('WST_USER.userId'))->delete();
		if(false !== $rs){
			$rs['status']= 1;
		}
		return $rs;
	}
}