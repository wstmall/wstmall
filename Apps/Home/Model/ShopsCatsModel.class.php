<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 店铺分类服务类
 */
class ShopsCatsModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	$id = I("id",0);
		$data = array();
		$data["shopId"] = session('WST_USER.shopId');
		$data["isShow"] = I("isShow",0);
		$data["catName"] = I("catName");
		$data["catSort"] = I("catSort",0);
		$data["catFlag"] = 1;
		if($this->checkEmpty($data,true)){	
			$data["parentId"] = I("parentId",0);
			$m = M('shops_cats');
			$rs = $m->add($data);
			if(false !== $rs){
				$rd['status']= 1;
				S("WST_CACHE_SHOP_CAT_".session('WST_USER.shopId'),null);
			}
		}
		return $rd;
	 } 
     /**
	  * 修改
	  */
	 public function edit(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["isShow"] = (int)I("isShow",0);
		$data["catName"] = I("catName");
		$data["catSort"] = (int)I("catSort",0);
		$shopId = (int)session('WST_USER.shopId');
		$m = M('shops_cats');
		if($this->checkEmpty($data,true)){	
			if($data["isShow"]!=1){
				//把相关的商品下架了
				$sql = "update __PREFIX__goods set isSale=0 where shopId=".$shopId." and shopCatId1 = ".$id;
				$m->query($sql);
				$sql = "update __PREFIX__goods set isSale=0 where shopId=".$shopId." and shopCatId2 = ".$id;
				$m->query($sql);
			}
			$rs = $m->where("catId=".I('id')." and shopId=".$shopId)->save($data);
			if(false !== $rs){
				$rd['status']= 1;
				S("WST_CACHE_SHOP_CAT_".session('WST_USER.shopId'),null);
			}
		}
		return $rd;
	 } 
	 /**
	  * 修改名称
	  */
	 public function editName(){
	 	$rd = array('status'=>-1);
	 	$id = I("id",0);
		$data = array();
		$data["catName"] = I("catName");
		$shopId = (int)session('WST_USER.shopId');
		if($this->checkEmpty($data,true)){	
			$m = M('shops_cats');
			$rs = $m->where("catId=".I('id')." and shopId=".$shopId)->save($data);
			if(false !== $rs){
				$rd['status']= 1;
				S("WST_CACHE_SHOP_CAT_".session('WST_USER.shopId'),null);
			}
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get($id){
	 	$m = M('shops_cats');
		return $m->where("catId=".$id)->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage($shopId){
        $m = M('shops_cats');
	 	$sql = "select * from __PREFIX__shops_cats where shopId=".$shopId." and catFlag=1 order by catSort asc";
		return $m->pageQuery($sql);
	 }
	 /**
	  * 获取树形分类
	  */
	 public function getCatAndChild($shopId){
	 	 //获取第一级分类
	 	 $m = M('shops_cats');
	 	 $rs1 = $m->where('shopId='.$shopId.' and catFlag=1 and parentId=0')->order('catSort asc')->select();
	 	 if(count($rs1)>0){
	 	 	$ids = array();
	 	 	foreach ($rs1 as $key => $v){
	 	 		$ids[] = $v['catId'];
	 	 	}
	 	 	$rs2 = $m->where('shopId='.$shopId.' and catFlag=1 and parentId in('.implode(',',$ids).')')->order('catSort asc')->select();
	 	 	if(count($rs2)>0){
	 	 		$tmpArr = array();
	 	 		foreach ($rs2 as $key => $v){
	 	 			$tmpArr[$v['parentId']][] = $v;
	 	 		}
	 	 		foreach ($rs1 as $key => $v){
	 	 			$rs1[$key]['child'] = $tmpArr[$v['catId']];
	 	 			$rs1[$key]['childNum'] = count($tmpArr[$v['catId']]);
	 	 		}
	 	 	}
	 	 }
	 	 return $rs1;
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList($shopId,$parentId){
	     $m = M('shops_cats');
		 return $m->where('shopId='.$shopId.' and catFlag=1 and parentId='.$parentId." and shopId=".$shopId)->order('catSort asc')->select();
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	$m = M('shops_cats');
	 	$id = (int)I('id');
	 	if($id==0)return $rd;
		$shopId = (int)session('WST_USER.shopId');
		//把相关的商品下架了
		$sql = "update __PREFIX__goods set isSale=0 where shopId=".$shopId." and shopCatId1 = ".$id;
		$m->query($sql);
		$sql = "update __PREFIX__goods set isSale=0 where shopId=".$shopId." and shopCatId2 = ".$id;
		$m->query($sql);
		//删除商品分类
		$data = array();
		$data["catFlag"] = -1;
	 	$rs = $m->where("(catId=".I('id')." or parentId=".I('id').") and shopId=".$shopId)->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
			S("WST_CACHE_SHOP_CAT_".session('WST_USER.shopId'),null);
		}
		return $rd;
	 }
	 
	 
	/**
	  * 获取门店商品分类列表
	*/
    public function getShopCateList($shopId = 0){
		$shopId = ($shopId>0)?$shopId:(int)I("shopId");
		$data = S("WST_CACHE_SHOP_CAT_".$shopId);
		if(!$data){
			$m = M('shops_cats');
			$sql = "select catId,parentId,catName,shopId from __PREFIX__shops_cats where shopId=".$shopId." and parentId =0 and isShow=1 and catFlag=1 order by catSort asc";
			$data = $this->query($sql);
			if(count($data)>0){
				$ids = array();
				foreach ($data as $v){
					$ids[] = $v['catId'];
				}
				$sql = "select catId,parentId,catName,shopId from __PREFIX__shops_cats where shopId=".$shopId." and parentId in(".implode(',',$ids).") and isShow=1 and catFlag=1 order by catSort asc";
				$crs = $this->query($sql);
				$ids = array();
			    foreach ($crs as $v){
					$ids[$v['parentId']][] = $v;
				}
				foreach ($data as $key =>$v){
					if($ids[$v['catId']])$data[$key]['children'] = $ids[$v['catId']];
				}
			}
			S("WST_CACHE_SHOP_CAT_".$shopId,$data,86400);
	    }
		return $data;
	}
	 
};
?>