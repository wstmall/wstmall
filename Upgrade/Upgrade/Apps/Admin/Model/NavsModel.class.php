<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 导航服务类
 */
class NavsModel extends BaseModel {
	protected $_auto = array ( 
         array('navType',0),
         array('areaId1',0) ,
         array('areaId2',0), 
         array('navTitle'), 
         array('navUrl'),
         array('isShow',0),
         array('isOpen',0),
         array('navSort',0)
    );
	protected $_validate = array(     
		array('navType',array(0,1),'导航类型不对!',self::MODEL_BOTH,'in'),
		array('navTitle','1,50','导航名称长度不正确!',self::MODEL_BOTH,'length'),
		array('navUrl','1,100','导航链接长度不正确!',self::MODEL_BOTH,'length'),
		array('isShow',array(0,1),'是否显示类型不对!',self::MODEL_BOTH,'in'),
		array('isOpen',array(0,1),'是否打开新窗口类型不对!',self::MODEL_BOTH,'in'),
	);
	
    /**
	  * 新增
	  */
	 public function insert(){
	 	$m = M('navs');
	 	$rd = array('status'=>-1);
		$data = $m->create();
		if(!$data){
			$rd['msg'] = $m->getError();
			return $rd;
		}
		$data['createTime'] = date('Y-m-d H:i:s');
		$rs = $m->add($data);
		if(false !== $rs){
			$rd['status']= 1;
			WSTDelDir(C('WST_RUNTIME_PATH')."/Data/navigation");
		}else{
			echo $m->getDbError();
		}
		return $rd;
	 } 
     /**
	  * 修改
	  */
	 public function edit(){
	 	$m = M('navs');
	 	$rd = array('status'=>-1);
	    $data = $m->create();
		if(!$data){
			$rd['msg'] = $m->getError();
			return $rd;
		}
		$rs = $m->where("id=".(int)I('id',0))->save($data);
		if(false !== $rs){
			$rd['status']= 1;
			WSTDelDir(C('WST_RUNTIME_PATH')."/Data/navigation");
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get(){
	 	$m = M('navs');
		return $m->where("id=".I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
     	$navType = (int)I('navType');
     	$areaId1 = (int)I('areaId1');
     	$areaId2 = (int)I('areaId2');
	 	$sql = "select * from __PREFIX__navs where 1=1 ";
	 	if($navType>0)$sql.="  and navType=".$navType;
	 	if($areaId1>0)$sql.="  and (areaId1=0 or areaId1=".$areaId1.") ";
	 	if($areaId2>0)$sql.="  and (areaId2=0 or areaId2=".$areaId2.") ";
	 	$sql.=' order by navType asc,navSort asc,id asc';
		return $this->pageQuery($sql);
	 }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	    $rd = array('status'=>-1);
	    $m = M('navs');
	    $rs = $m->delete((int)I('id'));
		if(false !== $rs){
		   $rd['status']= 1;
		   WSTDelDir(C('WST_RUNTIME_PATH')."/Data/navigation");
		}
		return $rd;
	 }
	 
     /**
	  * 是否显示/隐藏
	  */
	 public function editiIsShow(){
	 	$rd = array('status'=>-1);
	 	if(I('id',0)==0)return $rd;
	 	$m = M('navs');
	 	$m->isShow = (I('isShow')==1)?1:0;
	 	$rs = $m->where("id = ".(int)I('id',0))->save();
	    if(false !== $rs){
			$rd['status']= 1;
			WSTDelDir(C('WST_RUNTIME_PATH')."/Data/navigation");
		}
	 	return $rd;
	 }
	 
     /**
 	  * 是否新窗口打开
	  */
	 public function editiIsOpen(){
	 	$rd = array('status'=>-1);
	 	if(I('id',0)==0)return $rd;
	 	$m = M('navs');
	 	$m->isOpen = (I('isOpen')==1)?1:0;
	 	$rs = $m->where("id = ".(int)I('id',0))->save();
	    if(false !== $rs){
			$rd['status']= 1;
			WSTDelDir(C('WST_RUNTIME_PATH')."/Data/navigation");
		}
	 	return $rd;
	 }
};
?>