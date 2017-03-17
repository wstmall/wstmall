<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 微信被动回复消息服务类
 */
class WxPassiveReplysModel extends BaseModel {
	// 允许新增的字段
	protected $insertFields = 'title,keyword,description,dataFlag,msgType,createTime,picUrl,url,content';
	// 允许更新的字段
	protected $updateFields = 'id,title,keyword,description,dataFlag,msgType,picUrl,url,content';
    /**
	  * 新增文本消息
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
		$data = array();
		$data["keyword"] = I("keyword");
		$data["dataFlag"] = 1;
		$data["content"] = I("content");
		$data["msgType"] = "text";
		$data["createTime"] = date('Y-m-d H:i:s');
		if($this->checkEmpty($data,true)){
			$rs = $this->add($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
     /**
	  * 修改文本消息
	  */
	 public function edit(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data["id"] = (int)I("id");
		$data["keyword"] = I("keyword");
		$data['content'] = I('content');
		if($this->checkEmpty($data)){	
			$rs = $this->where("id=".(int)I('id'))->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
	 /**
	  * 文本消息分页列表
	  */
     public function textPageQuery(){
     	$sql = "select * from __PREFIX__wx_passive_replys where dataFlag=1 and msgType='text'";
     	$rs = $this->pageQuery($sql);
		return $rs;
	 }




	 /****************************** 图文消息 *********************************/
	 /**
	  * 图文消息分页列表
	  */
     public function newsPageQuery(){
     	$sql = "select * from __PREFIX__wx_passive_replys where dataFlag=1 and msgType='news'";
     	$rs = $this->pageQuery($sql);
		return $rs;
	 }
	 /**
	  * 新增文本消息
	  */
	 public function newsInsert(){
	 	$rd = array('status'=>-1);
		$data = array();
	 	$data = I('post.');
		$data["dataFlag"] = 1;
		$data["msgType"] = "news";
		$data["createTime"] = date('Y-m-d H:i:s');

		if($this->checkEmpty($data,true)){
			$rs = $this->add($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
     /**
	  * 修改文本消息
	  */
	 public function newsEdit(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = I('post.');
		if($this->checkEmpty($data)){	
			$rs = $this->where("id=".(int)I('id'))->save($data);
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
		return $this->find((int)I('id'));
	 }
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
		$rs = $this->delete((int)I('id'));
		if($rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
};
?>