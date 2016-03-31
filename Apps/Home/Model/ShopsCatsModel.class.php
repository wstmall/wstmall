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
	 * 批量保存商品分类
	 */
	public function batchSaveShopCats(){
		$rd = array('status'=>-1);
		$shopId = (int)session('WST_USER.shopId');
		$m = M('shops_cats');
		//先保存了已经有父级的分类
		$otherNo = (int)I('otherNo');
		for($i=0;$i<$otherNo;$i++){
			$data = array();
			$data['catName'] = I('catName_o_'.$i);
			if($data['catName']=='')continue;
			$data['shopId'] = $shopId;
			$data['parentId'] = (int)I('catId_o_'.$i);
			$data['catSort'] = (int)I('catSort_o_'.$i);
			$data['isShow'] = (int)I('catShow_o_'.$i);
			$sql = "select catId from __PREFIX__shops_cats where catFlag=1 and shopId=".$shopId." and catId=".$data['parentId'];
			$rs = $this->query($sql);
			if(empty($rs))continue;
			$m->add($data);
		}
		//保存没有父级分类的
		$fristNo = (int)I('fristNo');
	    for($i=0;$i<$fristNo;$i++){
			$data = array();
			$data['catName'] = I('catName_'.$i);
			if($data['catName']=='')continue;
			$data['parentId'] = 0;
			$data['shopId'] = $shopId;
			$data['catSort'] = (int)I('catSort_'.$i);
			$data['isShow'] = (int)I('catShow_'.$i);
			$parentId = $m->add($data);
			if(false !== $parentId){
				//新增子类
				$catSecondNo = (int)I('catSecondNo_'.$i);
		        for($j=0;$j<$catSecondNo;$j++){
					$data = array();
					$data['catName'] = I('catName_'.$i."_".$j);
					if($data['catName']=='')continue;
					$data['shopId'] = $shopId;
					$data['parentId'] = $parentId;
					$data['catSort'] = (int)I('catSort_'.$i."_".$j);
					$data['isShow'] = (int)I('catShow_'.$i."_".$j);
					
					$m->add($data);
			    }
			}
		}
		$rd['status'] = 1;
		return $rd;
	}
	
	 /**
	  * 修改名称
	  */
	 public function editName(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["catName"] = I("catName");
		$shopId = (int)session('WST_USER.shopId');
		if($this->checkEmpty($data,true)){	
			$m = M('shops_cats');
			$rs = $m->where("catId=".$id." and shopId=".$shopId)->save($data);
			if(false !== $rs){
				$rd['status']= 1;
				S("WST_CACHE_SHOP_CAT_".session('WST_USER.shopId'),null);
			}
		}
		return $rd;
	 } 
	 /**
	  * 修改排序号
	  */
	 public function editSort(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["catSort"] = (int)I("catSort");
		$shopId = (int)session('WST_USER.shopId');
		$m = M('shops_cats');
		$rs = $m->where("catId=".$id." and shopId=".$shopId)->save($data);
		if(false !== $rs){
			$rd['status']= 1;
			S("WST_CACHE_SHOP_CAT_".session('WST_USER.shopId'),null);
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get($id){
	 	$m = M('shops_cats');
		return $m->where("catId=".(int)$id)->find();
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
	 	 	$rs2 = $m->where('shopId='.$shopId.' and catFlag=1 and parentId in('.implode(',',$ids).')')->order('catSort asc,catId asc')->select();
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
		$m->execute($sql);
		$sql = "update __PREFIX__goods set isSale=0 where shopId=".$shopId." and shopCatId2 = ".$id;
		$m->execute($sql);
		//删除商品分类
		$data = array();
		$data["catFlag"] = -1;
	 	$rs = $m->where("(catId=".$id." or parentId=".$id.") and shopId=".$shopId)->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
			S("WST_CACHE_SHOP_CAT_".session('WST_USER.shopId'),null);
		}
		return $rd;
	 }
	 
	 
	/**
	  * 获取店铺商品分类列表
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
	
	/**
	 * 显示状态
	 */
	public function changeCatStatus(){
		$rd = array('status'=>-1);
		$id = (int)I("id",0);
		$isShow = (int)I("isShow",0);
		$parentId = (int)I("pid",0);
		$data = array();
		$data["isShow"] = (int)I("isShow");
		$shopId = (int)session('WST_USER.shopId');
		if($this->checkEmpty($data,true)){
			$m = M('shops_cats');
			$m->where("catId=".$id." and shopId=".$shopId)->save($data);
			$m->where("parentId=".$id." and shopId=".$shopId)->save($data);
			if($parentId>0 && $isShow==1){
				$m->where("catId=".$parentId." and shopId=".$shopId)->save($data);
			}
			S("WST_CACHE_SHOP_CAT_".session('WST_USER.shopId'),null);
		}
		return $rd;
	}
	 
};
?>