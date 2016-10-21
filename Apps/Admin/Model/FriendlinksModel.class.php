<?php
namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 社区服务类
 */
class FriendlinksModel extends BaseModel {
    /**
     * 获取分页记录
     */
	public function queryPage(){
		$sql = "select * from __PREFIX__friendlinks order by friendlinkSort asc,friendlinkId asc";
		$rs = $this->pageQuery($sql);
		return $rs;
	}
	/**
	 * 新增
	 */
	public function insert(){
		$rd = array('status'=>-1);
		$data = array();
		$data['friendlinkIco'] = I('friendlinkIco');
		$data['friendlinkName'] = I('friendlinkName');
		$data['friendlinkUrl'] = I('friendlinkUrl');
		$data['friendlinkSort'] = I('friendlinkSort',0);
		if($this->checkEmpty($data)){
			$rs = $this->add($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	}
	/**
	 * 编辑
	 */
    public function edit(){
    	$rd = array('status'=>-1);
		$data = array();
		$data["friendlinkIco"] = I('friendlinkIco');
		$data["friendlinkName"] = I('friendlinkName');
		$data["friendlinkUrl"] = I('friendlinkUrl');
		$data["friendlinkSort"] = (int)I('friendlinkSort',0);
		if($this->checkEmpty($data)){
			$rs = $this->where("friendlinkId=".(int)I('id'))->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	}
	/**
	 * 获取
	 */
	public function get(){
		return $this->where("friendlinkId=".(int)I('id'))->find();
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
}