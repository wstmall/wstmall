<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 区域服务类
 */
class AreasModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$areaType = 0;
	 	$parentId = (int)I("parentId",0);
	 	if($parentId>0){
		 	$prs = $this->get($parentId);
		 	$areaType = $prs['areaType']+1;
		}
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["parentId"] = $parentId;
		$data["areaName"] = I("areaName");
		$data["isShow"] = (int)I("isShow",1);
		$data["areaSort"] = (int)I("areaSort",0);
		$data["areaKey"] = strtoupper(I("areaKey"));
		$data["areaType"] = $areaType;
		$data["areaFlag"] = 1;
	    if($this->checkEmpty($data,true)){
			$rs = $this->add($data);
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
		$data["areaName"] = I("areaName");
		$data["isShow"] = (int)I("isShow",1);
		$data["areaSort"] = (int)I("areaSort",0);
		$data["areaKey"] = strtoupper(I("areaKey"));
		if($this->checkEmpty($data,true)){
		    $rs = $this->where("areaId=".$id)->save($data);
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
	 	$id = (I('id')!='')?I('id'):$id;
		return $this->where("areaId=".(int)$id)->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
        $parentId = (int)I("parentId",0);
	 	$sql = "select * from __PREFIX__areas where parentId=".$parentId." and areaFlag=1 order by areaSort asc,areaId asc";
		return $this->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList($parentId){
		 return $this->where('areaFlag=1 and parentId='.(int)$parentId)->select();
	  }
     /**
	  * 获取列表[获取启用的区域信息]
	  */
	  public function queryShowByList($parentId){
		 return $this->where('areaFlag=1 and isShow = 1 and parentId='.(int)$parentId)->select();
	  }
     /**
	  * 获取列表[带社区]
	  */
	  public function queryAreaAndCommunitysByList($parentId){
		 $rs = $this->where('areaFlag=1 and parentId='.(int)$parentId)->select();
		 if(count($rs)>0){
		 	$m = M('communitys');
		 	foreach ($rs as $key =>$v){
		 		$r = $m->where('communityFlag=1 and areaId3='.$v['areaId'])->select();
		 		if(!empty($r))$rs[$key]['communitys'] = $r;
		 	}
		 }
		 return $rs;
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	if(I('id',0)==0)return $rd;
        //获取子集
		$ids = array();
		$ids[] = (int)I('id');
		$ids = $this->getChild($ids,$ids);
	 	$data = array();
		$data["areaFlag"] = -1;
	    $rs = $this->where("areaId in(".implode(',',$ids).")")->save($data);
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
	 /**
	  * 迭代获取下级
	  */
	 public function getChild($ids = array(),$pids = array()){
	 	$sql = "select areaId from __PREFIX__areas where areaFlag=1 and parentId in(".implode(',',$pids).")";
	 	$rs = $this->query($sql);
	 	if(count($rs)>0){
	 		$cids = array();
		 	foreach ($rs as $key =>$v){
		 		$cids[] = $v['areaId'];
		 	}
		 	$ids = array_merge($ids,$cids);
		 	return $this->getChild($ids,$cids);
		 	
	 	}else{
	 		return $ids;
	 	}
	 }
	 /**
	  * 显示分类是否显示/隐藏
	  */
	 public function editiIsShow(){
	 	$rd = array('status'=>-1);
	 	if(I('id',0)==0)return $rd;
	 	//获取子集
		$ids = array();
		$ids[] = (int)I('id');
		$ids = $this->getChild($ids,$ids);
	 	$this->isShow = ((int)I('isShow')==1)?1:0;
	 	$rs = $this->where("areaId in(".implode(',',$ids).")")->save();
	    if(false !== $rs){
			$rd['status']= 1;
		}
	 	return $rd;
	 }
};
?>