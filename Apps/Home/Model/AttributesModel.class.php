<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品属性类
 */
class AttributesModel extends BaseModel { 
    
     /**
      * 保存属性记录
      */
	 function edit(){
	 	$m = M('attributes');
	 	$rd = array('status'=>-1);
	 	$no = (int)I('no');
	 	$catId = (int)I('catId');
	 	$shopId = (int)session('WST_USER.shopId');
	 	//获取该类型下的价格属性
	 	$sql = "select attrId from __PREFIX__attributes where catId=".$catId." and isPriceAttr = 1 and attrFlag=1 and shopId=".$shopId;
	 	$priceRs = $m->query($sql);
	 	$priceAttrId = (int)$priceRs[0]['attrId'];
	 	$newPriceAttrId = 0;
	 	for($i=0;$i<=$no;$i++){
	 		$attrName = trim(I('attrName_'.$i));
	 		if($attrName=='')continue;
	 		$data = array();
	 		$data['shopId'] = $shopId;
	 		$data['catId'] = $catId;
	 		$id = (int)I('id_'.$i);
	 		if($id>0){
	 			$data['attrName'] = $attrName;
	 			$data['isPriceAttr'] = (int)I('isPriceAttr_'.$i);
	 			$data['attrType'] = (int)I('attrType_'.$i);
	 			if($data['attrType']==1 || $data['attrType']==2)$data['attrContent'] = trim(I('attrContent_'.$i));
	 			$data['attrSort'] = (int)I('attrSort_'.$i);
	 			$m->where('shopId='.$shopId.' and catId='.$catId.' and attrId='.$id)->save($data);
	 			if($data['isPriceAttr']==1)$newPriceAttrId = $id;
	 		}else{
	 			$data['attrName'] = $attrName;
	 			$data['isPriceAttr'] = (int)I('isPriceAttr_'.$i);
	 			$data['attrType'] = (int)I('attrType_'.$i);
	 			if($data['attrType']==1 || $data['attrType']==2)$data['attrContent'] = trim(I('attrContent_'.$i));
	 			$data['attrSort'] = (int)I('attrSort_'.$i);
	 			$data['attrFlag'] = 1;
			    $data['createTime'] = date('Y-m-d H:i:s');
	 			$rs = $m->add($data);
	 			if($data['isPriceAttr']==1)$newPriceAttrId = $id;
	 		}
	 	}
	 	//做价格属性的删除工作
	 	if(($priceAttrId>0 && $newPriceAttrId==0) || ($priceAttrId>0 && $newPriceAttrId>0 && $priceAttrId !=$newPriceAttrId )){
	 		//修改前一條记录状态
			$m->execute("update __PREFIX__attributes set isPriceAttr=0 where attrId=".$priceAttrId);
			$m = M('goods_attributes');
			//删除相关商品的属性
			$m->where("shopId=".$shopId." and attrId = ".$priceAttrId)->delete();
	 	}
	 	$rd['status']= 1;
	 	return $rd;
	 }
	 /**
	  * 获取指定对象
	  */
     public function get(){
     	$shopId = (int)session('WST_USER.shopId');
     	$m = M('attributes');
		return $m->where("shopId=".$shopId." and attrId=".I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
     	 $catId = (int)I('catId');
     	 $m = M('attributes');
     	 $shopId = (int)session('WST_USER.shopId');
		 return $m->where('shopId='.$shopId.' and attrFlag=1 and catId='.$catId)->order('attrSort asc,attrId asc')->select();
	 }
	 
	 /**
	  * 下拉列表
	  */
     public function queryByList(){
     	 $catId = (int)I('catId');
     	 $m = M('attributes');
     	 $shopId = (int)session('WST_USER.shopId');
		 return $m->where('shopId='.$shopId.' and attrFlag=1 and catId='.$catId)->order('attrSort asc,attrId asc')->select();
	 }
	 
     /**
	  * 下拉列表2
	  */
     public function queryByListForGoods(){
     	 $catId = (int)I('catId');
     	 $m = M('attributes');
     	 $shopId = (int)session('WST_USER.shopId');
		 $rs = $m->where('shopId='.$shopId.' and attrFlag=1 and catId='.$catId)->order('attrSort asc,attrId asc')->select();
         foreach ($rs as $key => $v){
		     //分解下拉和多选的选项
		     if($rs[$key]['attrType']==1 || $rs[$key]['attrType']==2){
				$rs[$key]['opts']['txt'] = explode(',',$rs[$key]['attrContent']);
		     }
		     
		}
		return $rs;
	 }
	 
	 /**
	  * 删除
	  */
	 public function del(){
	    $rd = array('status'=>-1);
	    $id = (int)I('id');
	    if($id==0)return $rd;
	    $shopId = (int)session('WST_USER.shopId');
	    $m = M('goods_attributes');
		//删除相关商品的属性
		$m->where("shopId=".$shopId." and attrId=$id")->delete();
	    //删除属性
	    $m = M('attributes');
	    $rs = $m->execute("update __PREFIX__attributes set attrFlag=-1 where shopId=".$shopId." and attrId=".$id);
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
};
?>