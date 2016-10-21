<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 角色服务类
 */
class RolesModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
		$data = array();
		$data["roleName"] = I("roleName");
		$data["grant"] = I("grant");
		$data["createTime"] = date('Y-m-d H:i:s');
		$data["roleFlag"] = 1;
	    if($this->checkEmpty($data)){
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
		$this->roleName = I("roleName");
		$this->grant = I("grant");
	    if($this->checkEmpty($data)){
			$rs = $this->where("roleId=".$id)->save();
			if(false !== $rs){
				$rd['status']= 1;
				//实时更新当前用户权限
				if(session('WST_STAFF.staffRoleId')==$id){
					$WST_STAFF = session('WST_STAFF');
					$WST_STAFF['grant'] = explode(',',I("grant"));
					session('WST_STAFF',$WST_STAFF);
				}
			}
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get(){
		return $this->where("roleId=".(int)I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
	 	$sql = "select * from __PREFIX__roles order by roleId desc";
		return $this->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
		 return $this->select();
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	    $rs = $this->delete((int)I('id'));
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
};
?>