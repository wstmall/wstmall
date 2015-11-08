<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 文章分类服务类
 */
class ArticleCatsModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["parentId"] = (int)I("parentId");
		$data["catType"] = (int)I("catType",0);
		$data["isShow"] = (int)I("isShow",1);
		$data["catName"] = I("catName");
		$data["catSort"] = (int)I("catSort",0);
		$data["catFlag"] = 1;
	    if($this->checkEmpty($data,true)){
			$m = M('article_cats');
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
	 	$id = (int)I("id",0);
		$data = array();
		$data["isShow"] = (int)I("isShow");
		$data["catName"] = I("catName");
		$data["catSort"] = (int)I("catSort");
	    if($this->checkEmpty($data)){	
			$m = M('article_cats');
		    $rs = $m->where("catId=".(int)I('id',0))->save($data);
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
	 	$id = (int)I("id",0);
		$data = array();
		$data["catName"] = I("catName");
	    if($this->checkEmpty($data)){
	    	$m = M('article_cats');
			$rs = $m->where("catFlag=1 and catId=".(int)I('id'))->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 }
	 /**
	  * 获取指定对象
	  */
     public function get(){
	 	$m = M('article_cats');
		return $m->where("catId=".(int)I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
        $m = M('article_cats');
	 	$sql = "select * from __PREFIX__article_cats order by catSort asc";
		return $m->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList($pid){
	     $m = M('article_cats');
	     return $m->where('catFlag=1 and parentId='.$pid)->order('catSort asc,catId asc')->select(); 
	  }
	 /**
	  * 迭代获取下级
	  */
	 public function getChild($ids = array(),$pids = array()){
	 	$m = M('article_cats');
	 	$sql = "select catId from __PREFIX__article_cats where catFlag=1 and parentId in(".implode(',',$pids).")";
	 	$rs = $m->query($sql);
	 	if(count($rs)>0){
	 		$cids = array();
		 	foreach ($rs as $key =>$v){
		 		$cids[] = $v['catId'];
		 	}
		 	$ids = array_merge($ids,$cids);
		 	return $this->getChild($ids,$cids);
		 	
	 	}else{
	 		return $ids;
	 	}
	 }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	//获取子集
	 	$ids = array();
		$ids[] = (int)I('id');
	 	$ids = $this->getChild($ids,$ids);
	 	$m = M('article_cats');
	 	$m->catFlag = -1;
		$rs = $m->where(" catId in(".implode(',',$ids).")")->save();
	    if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
	 /**
	  * 显示商品是否显示/隐藏
	  */
	 public function editiIsShow(){
	 	$rd = array('status'=>-1);
	 	if(I('id',0)==0)return $rd;
	 	//获取子集
	 	$ids = array();
		$ids[] = (int)I('id');
	 	$ids = $this->getChild($ids,$ids);
	 	$m = M('article_cats');
	 	$m->isShow = (I('isShow')==1)?1:0;
	 	$rs = $m->where("catId in(".implode(',',$ids).")")->save();
	    if(false !== $rs){
			$rd['status']= 1;
		}
	 	return $rd;
	 }

	 /**
	  * 获取所有的类别，并且添加层级
	  */
	 public function getCatLists(){	
	 	$sql = "select * from __PREFIX__article_cats where catFlag = 1 order by catSort asc";
	 	$catList = $this->query($sql);

	 	if ($catList !== false) {	 		
	 		$catList = self::unlimitedForLevel($catList);	 		
	 	}
	 	return $catList;
	 }

	 Static Public function unlimitedForLevel($cate,$html='&nbsp;&nbsp;',$parentId=0,$level=0){
		$arr = array();
		foreach ($cate as $v) {
			if ($v['parentId'] == $parentId) {
				$v['level'] = $level + 1;
				$html2 = $level==0 ? '' : '|--';//生成目录|--
				$v['html'] = str_repeat($html,$level).$html2;
				$v['catName'] = $v['html'].$v['catName'];
				$arr[]=$v;
				$arr = array_merge($arr,self::unlimitedForLevel($cate,$html,$v['catId'],$level + 1));
			}
		}
		return $arr;
	}
};
?>