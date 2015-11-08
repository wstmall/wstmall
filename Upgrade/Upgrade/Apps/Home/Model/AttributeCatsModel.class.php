<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品类型服务类
 */
class AttributeCatsModel extends BaseModel { 
    /**
	  * 新增
	  */
	 public function insert(){
	 	$m = M('attribute_cats');
	 	$rd = array('status'=>-1);
		$data = array();
		$data['catName'] = I('catName');
		$data["shopId"] = (int)session('WST_USER.shopId');
		if($this->checkEmpty($data)){
			$data['catFlag'] = 1;
			$data['createTime'] = date('Y-m-d H:i:s');
			$rs = $m->add($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
     /**
	  * 修改
	  */
	 public function edit(){
	 	$m = M('attribute_cats');
	 	$rd = array('status'=>-1);
	 	$shopId = (int)session('WST_USER.shopId');
	 	$data = array();
	 	$data['catName'] = I('catName');
		if($this->checkEmpty($data)){
			$catId = (int)I('id',0);
			$rs = $m->where("shopId=".$shopId." and catId=".$catId)->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get($catId = 0){
     	$id = $catId>0?$catId:(int)I('id');
     	$m = M('attribute_cats');
     	$shopId = (int)session('WST_USER.shopId');
		return $m->where("shopId=".$shopId." and catId=".$id)->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
     	 $m = M('attribute_cats');
     	 $shopId = (int)session('WST_USER.shopId');
		 return $m->where('shopId='.$shopId.' and catFlag=1')->field('catId,catName')->order('catId asc')->select();
	 }
	 
     /**
	  * 分页列表
	  */
     public function queryByList(){
     	 $m = M('attribute_cats');
     	 $shopId = (int)session('WST_USER.shopId');
		 return $m->where('shopId='.$shopId.' and catFlag=1')->field('catId,catName')->order('catId asc')->select();
	 }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	    $rd = array('status'=>-1);
	    $id = (int)I('id');
	    if($id==0)return $rd;
	    $m = M('attributes');
	    $shopId = (int)session('WST_USER.shopId');
	    //找出其下的属性
	    $sql = "select attrId from __PREFIX__attributes where shopId=".$shopId." and catId=".$id;
	    $attrRs = $m->query($sql);
	    if(count($attrRs)>0){
	    	$ids = array();
	    	foreach ($attrRs as $v){
	    		$ids[] = $v['attrId'];
	    	}
	    	$data = array();
	    	$data['attrFlag'] = -1;
	    	//作废属性
	    	$m->where("shopId=".$shopId." and attrId in(".implode(',',$ids).")")->save($data);
	    	$m = M('goods_attributes');
		    //删除相关商品的属性
		    $m->where("shopId=".$shopId." and attrId in(".implode(',',$ids).")")->delete();
	    }
	    //删除商品中的引用
	    $rs = $m->execute("update __PREFIX__goods set attrCatId=0 where shopId=".$shopId." and attrCatId=".$id);
	    //删除属性
	    $m = M('attribute_cats');
	    $rs = $m->execute("update __PREFIX__attribute_cats set catFlag=-1 where shopId=".$shopId." and catId=".$id);
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
};
?>