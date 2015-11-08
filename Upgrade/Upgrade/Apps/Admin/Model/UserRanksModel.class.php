<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 会员服务类
 */
class UserRanksModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	$id = I("id",0);
		$data = array();
		$data["rankName"] = I("rankName");
		$data["startScore"] = I("startScore");
		$data["endScore"] = I("endScore");
		$data["rebate"] = I("rebate");
		$data["createTime"] = date('Y-m-d H:i:s');
		if($this->checkEmpty($data)){
			$m = M('user_ranks');
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
		$m = M('user_ranks');
		$data = array();
		$data['rankName'] = I("rankName");
		$data['startScore'] = I("startScore");
		$data['endScore'] = I("endScore");
		$data['rebate'] = I("rebate");
		if($this->checkEmpty($data)){
			$rs = $m->where("rankId=".(int)I('id'))->save($data);
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
	 	$m = M('user_ranks');
		return $m->where("rankId=".(int)I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
        $m = M('user_ranks');
	 	$sql = "select * from __PREFIX__user_ranks order by rankId desc";
		$rs = $m->pageQuery($sql);
		return $rs;
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	    $m = M('user_ranks');
	     $sql = "select * from __PREFIX__user_ranks order by rankId desc";
		 $rs = $m->find($sql);
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
		$m = M('user_ranks');
	    $rs = $m->delete((int)I('id'));
		if($rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
};
?>