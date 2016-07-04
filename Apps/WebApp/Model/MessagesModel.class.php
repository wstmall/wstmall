<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
class MessagesModel extends BaseModel {
	
	/**
	 * 消息列表
	 */
	public function getMessagesList(){
		$currPage = (int)I("currPage",0);
		$pageSize = ( I('pageSize') ? (int)I('pageSize') : 10 );
		$userId = (int)session('WST_USER.userId');
		$sql = "select id,msgContent,createTime,msgStatus from __PREFIX__messages where receiveUserId=".$userId." and msgFlag=1 order by msgStatus asc,createTime desc";
		$page = $this->pageQuery($sql,$currPage,$pageSize);
		return $page;
	}

	/**
	 * 消息详情
	 */
	public function getMsgDetails(){
		$id = (int)I('id');
		$rs = $this->where("receiveUserId=".(int)session('WST_USER.userId')." and msgFlag=1 and id=".$id)->field("id,msgContent,msgStatus,createTime")->find();
		if( !empty($rs) && $rs['msgStatus'] != 1 ){
			$sql ="update __PREFIX__messages set msgStatus=1 where id=".$id;
			$this->execute($sql);
		}
		return $rs;
	}

	/**
	* 删除消息
	*/
	public function delMsg(){
		$ids = WSTFormatIn(",", WSTAddslashes(I('ids')) );
		$rs = array();
        $rs['status'] = $this->where("id in (".$ids.")")->delete() === false ? -1 : 1;
        return $rs;
	}

	/**
	* 获取未读消息的数量
	*/
	public function getUnreadMsgCount(){
		$sql = "select count(*) counts from __PREFIX__messages where receiveUserId=".(int)session('WST_USER.userId')." and msgFlag=1 and msgStatus=0 ";
		$rs = $this->query($sql);
		return $rs[0]['counts'];
	}

}