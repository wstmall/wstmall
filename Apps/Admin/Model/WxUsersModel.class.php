<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 微信自定义列表服务类
 */
class WxUsersModel extends BaseModel {	  
	  /**
	   * 分页列表
	   */
	  public function queryByPage(){
	  	$sql = "select * from __PREFIX__wx_users where userFill=1";
	  	if(I('userName')!='')$sql.=" and userName LIKE '%".WSTAddslashes(I('userName'))."%'";
	  	$sql.="  order by subscribeTime desc";
	  	$rs = $this->pageQuery($sql);
	  	return $rs;
	  }
	  
	  /**
	   * 获取指定对象
	   */
	  public function get($userId){
	  	return $this->where("userFill = 1 and userId=".$userId)->find();
	  }
	  
	  /**
	   * 与微信用户管理同步
	   */
	  public function synchroWx(){
	  	$rd = array('status'=>-1,'msg'=>'与微信同步失败,请清除缓存重试');
	  	$this->where('userId>0')->delete();
	  	$wx = WXAdmin();
	  	$data = $wx->wxUserGet();
	  	if(isset($data['errcode'])){
	  		if($data['errcode']!=0)return $rd;
	  	}
	  	if(isset($data['data']) && count($data['data']['openid'])>0){
	  		$dataList = array();
	  		foreach($data['data']['openid'] as $key=>$v){
	  			$datas = array();
	  			$datas['openId'] = $v;
	  			$datas['userFill'] = -1;
	  			$dataList[] = $datas;
	  		}
	  		$this->addAll($dataList);
	  		$rd['msg']= '共'.$data['total'].'个用户需同步';
	  		$rd['data']= $dataList;
	  		$rd['status']= 1;
	  	}
	  	return $rd;
	  }
	  
	  public function wxLoad(){
	  	$rd = array('status'=>-1,'msg'=>'与微信同步失败,请清除缓存重试');
	  	$openId = I('id');
	  	$wx = WXAdmin();
	  	$userInfo = $wx->wxUserInfo($openId);
	  	if(isset($userInfo['errcode'])){
	  		if($userInfo['errcode']!=0)return $rd;
	  	}
	  	$data = array();
	  	$data['userName'] = $userInfo['nickname'];
	  	$data['userSex'] = $userInfo['sex'];
	  	$data['userAreas'] = $userInfo['country'].$userInfo['province'].$userInfo['city'];
	  	$data['userPhoto'] = $userInfo['headimgurl'];
	  	$data['userRemark'] = $userInfo['remark'];
	  	$data['subscribeTime'] = date('Y-m-d H:i:s',$userInfo['subscribe_time']);
	  	$data['groupId'] = $userInfo['groupid'];
	  	$data['openId'] = $userInfo['openid'];
	  	$data['userFill'] = 1;
	  	$result = $this->where(array('userFill'=>-1,'openId'=>$openId))->save($data);
	  	if(false !== $result){
	  		$rd['status']= 1;
	  	}
	  	return $rd;
	  }
	  
	  /**
	   * 修改备注
	   */
	  public function editName(){
	  	$rd = array('status'=>-1);
	  	$id = (int)I("id",0);
	  	$data = array();
	  	$data["userRemark"] = I("userRemark");
  		$rs = $this->where("userFill=1 and userId=".$id)->save($data);
  		if(false !== $rs){
  			$info = $this->get($id);
  			$wdata = array();
  			$wdata["openid"] = $info["openId"];
  			$wdata["remark"] = $info["userRemark"];
  			$wdata = json_encode($wdata,JSON_UNESCAPED_UNICODE);
  			$wx = WXAdmin();
  			$data = $wx->wxUpdateremark($wdata);
  			$rd['status']= 1;
  		}
	  	return $rd;
	  }
};
?>