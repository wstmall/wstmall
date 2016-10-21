<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 商城信息服务类
 */
class MessagesModel extends BaseModel {
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	    $map = array('id'=>(int)I('id'),'receiveUserId'=>(int)session('WST_USER.userId'));
	    $rs = $this->where($map)->delete();
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
	/**
	 * 获取分页列表
	 */
	 public function queryByPage(){
	 	$userId=(int)session('WST_USER.userId');
		$sql = "select * from __PREFIX__messages m where receiveUserId=".$userId;
		$sql.=" order by msgStatus asc,createTime desc ";
		return $this->pageQuery($sql);
	 }
	
	/**
	 * 获取消息
	 */
	public function get(){
		$id = (int)I('id');
        $map = array('id'=>$id,'receiveUserId'=>(int)session('WST_USER.userId'));
        $info = $this->where($map)->find();
        if (!empty($info)) {
            if ($info['msgStatus'] == 0) {
                $this->where("id=".$id." and receiveUserId=".(int)session('WST_USER.userId'))->save(array('msgStatus'=>1));
            }
        }
        return $info;
	}

	public function batchDel(){
		$ids = self::formatIn(",", I('ids'));
		$re = array();
        $map = array('id'=>array('in',$ids),'receiveUserId'=>(int)session('WST_USER.userId'));
        $re['status'] = $this->where($map)->delete() === false ? -1 : 1 ;
        return $re;
	}
};
?>