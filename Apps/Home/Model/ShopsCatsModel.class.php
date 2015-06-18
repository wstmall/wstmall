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
use Think\Model;
class ShopsCatsModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function add(){
	 	$rd = array('status'=>-1);
	 	$id = I("id",0);
		$data = array();
		$data["shopId"] = $_SESSION['USER']['shopId'];
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
			}
		}
		return $rd;
	 } 
     /**
	  * 修改
	  */
	 public function edit(){
	 	$rd = array('status'=>-1);
	 	$id = I("id",0);
		$data = array();
		$data["isShow"] = I("isShow",0);
		$data["catName"] = I("catName");
		$data["catSort"] = I("catSort",0);
		$shopId = (int)$_SESSION['USER']['shopId'];
		if($this->checkEmpty($data,true)){	
			$m = M('shops_cats');
			$rs = $m->where("catId=".I('id')." and shopId=".$shopId)->save($data);
			if(false !== $rs){
				$rd['status']= 1;
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
		$shopId = (int)$_SESSION['USER']['shopId'];
		if($this->checkEmpty($data,true)){	
			$m = M('shops_cats');
			$rs = $m->where("catId=".I('id')." and shopId=".$shopId)->save($data);
			if(false !== $rs){
				$rd['status']= 1;
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
	 	$data = array();
		$data["catFlag"] = -1;
		$shopId = (int)$_SESSION['USER']['shopId'];
	 	$rs = $m->where("catId=".I('id')." and shopId=".$shopId)->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
	 
	 
	/**
	  * 获取门店商品分类列表
	*/
	public function getShopCateList(){
		$shopId = I("shopId",0);
		$m = M('shops_cats');
		$sql = "select * from __PREFIX__shops_cats where shopId=".$shopId." and parentId =0 and catFlag=1 order by catSort asc";
		$rs = $this->query($sql);
		$cats = array();
		for ($i = 0; $i < count($rs); $i++) {
			$catId = $rs[$i]["catId"];
			$sql2 = "select * from __PREFIX__shops_cats where shopId=".$shopId." and parentId =$catId and catFlag=1 order by catSort asc";
			$rs2 = $this->query($sql2);
			$rs[$i]["children"] = $rs2;
			
		}
		
		return $rs;
	}
	 
};
?>