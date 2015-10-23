<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
use Think\Model;
class UsersModel extends BaseModel {
	
	/**
	 * 登录验证
	 * loginKey 64位加密传过来，密匙是今天的日期例如:base64(base64(账号)._.base64(账号))
	 * loginRemark:标记是android还是ios
	 *
	 * status:-1:账号不存在!  -2:账号已被停用! -3:账号或密码不正确! 1:登录成功~
	 * msg:登录信息
	 * user:{userId,loginName,userName,userPhoto}
	 */
	public function login(){
		$rv = array('status'=>-1,'msg'=>'账号不存在!');
		$loginName = I('username');
		$loginPwd = I('password');
		if($loginName=='' || $loginPwd=='')return $rv;
		$m = M('users');
		$sql = "select userId,loginName,loginSecret,loginPwd,userName,userSex,userPhoto,userStatus,userScore,userType
	 	    from __PREFIX__users where (loginName='".$loginName."' or userPhone='".$loginName."' or userEmail='".$loginName."')
	 	    and userFlag=1 ";
		$urs = $this->query($sql);
		$urs = $urs[0];
		if(empty($urs))return $rv;//账号不存在!
		if($urs['userStatus']==0)array('status'=>-2,msg=>'账号不存在!');//账号已被停用!
		if(md5($loginPwd.$urs['loginSecret'])!=$urs['loginPwd'])return array('status'=>-3,msg=>'账号或密码不正确!');//账号或密码不正确!
		unset($urs['loginSecret'],$urs['loginPwd'],$urs['userStatus']);
		$rv['status'] = 1;
		$rv['msg'] = '登录成功~';
		$rv['data'] = $urs;
		//记录登录信息
		$data = array();
		$data["userId"] = $urs['userId'];
		$data["loginTime"] = date('Y-m-d H:i:s');
		$data["loginIp"] = get_client_ip();
		$data["loginSrc"] = 2;
		$data["loginRemark"] = I('loginRemark');
		$m = M('log_user_logins');
		M('log_user_logins')->add($data);
		//记录tokenId
		$m = M('app_session');
		$key = sprintf('%011d',$urs['userId']);
		$tokenId = to_guid_string($key.time());
		$data = array();
		$data['userId'] = $urs['userId'];
		$data['tokenId'] = $tokenId;
		$data['startTime'] = date('Y-m-d H:i:s');
		$data['deviceId'] = I('deviceId');
		$m->add($data);
		$rv['data']['tokenId'] = $tokenId;
		//删除上一条登录记录
		$m->where('tokenId!="'.$tokenId.'" and userId='.$urs['userId'])->delete();
		session('WST_USER',$urs);
		return $rv;
	}

	/**
	 * 用户注册
	 */
	public function register(){
		$rv = array('status'=>-1,'msg'=>'账号已存在!');
		$loginName = I('username');
		$loginPwd = I('password');
		$rs = $this->checkLoginKey($loginName);
		if($rs['status']==1){
			$m = M('users');
			$data = array();
			$data['loginName'] = $loginName;
			$data["loginSecret"] = rand(1000,9999);
			$data['loginPwd'] = md5($loginPwd.$data['loginSecret']);
			$data['userType'] = 0;
			$data['createTime'] = date('Y-m-d H:i:s');
			$data['userFlag'] = 1;
			$rs = $m->add($data);
			if(false !== $rs){
				$data = array();
				$data["userId"] = $rs;
				$data["loginTime"] = date('Y-m-d H:i:s');
				$data["loginIp"] = get_client_ip();
				$data["loginSrc"] = 2;
				$data["loginRemark"] = I('loginRemark');
				M('log_user_logins')->add($data);
				//记录tokenId
				$data = array();
				$key = sprintf('%011d',$urs['userId']);
				$tokenId = to_guid_string($key.time());
				$rv['status']= 1;
				$data['userId'] = $rs;
				$data['tokenId'] = $tokenId;
				$data['startTime'] = date('Y-m-d H:i:s');
				$data['deviceId'] = I('deviceId');
				M('app_session')->add($data);
				$rv['data'] = $this->getUserInfo($rs);
				$rv['data']['tokenId'] = $tokenId;
				self::login();//注册成功后登录
			}
		}
		return $rv;
	}
	
	/**
	 * 查询登录名是否存在
	 */
	public function checkLoginKey($loginName,$id = 0){
		$loginName = ($loginName!='')?$loginName:I('loginName');
		$rd = array('status'=>-1);
		if($loginName=='')return $rd;
		$sql = " (loginName ='%s' or userPhone ='%s' or userEmail='%s') ";
		$m = M('users');
		if($id>0){
			$sql.=" and userId!=".$id;
		}
		$rs = $m->where($sql,array($loginName,$loginName,$loginName))->count();
		if($rs==0)$rd['status'] = 1;
		return $rd;
	}

	/**
	 * 获取指定对象的资料
	 */
	public function getUserInfo($userId){
		$m = M('users');
		$rs = $m->where("userId=".$userId)->field("userId,loginName,userName,userSex,userType,userPhoto,userScore")->find();
		return $rs;
	}

	/**
	 * 修改用户密码
	 */
	public function editPwd(){
		$userId = $this->getUserId();
		$oldPwd = trim(I('oldPwd'));
		$newPwd = trim(I('newPwd'));
		$m = M('users');
		$sql = "select userId,loginSecret,loginPwd from __PREFIX__users where userFlag=1 and userId=".$userId;
		$rs = $m->query($sql);
		if(empty($rs))return -1;
		if(md5($oldPwd.$rs[0]['loginSecret'])!=$rs[0]['loginPwd'])return -2;
		$data = array();
		$data['loginPwd'] = md5($newPwd.$rs[0]['loginSecret']);
		$m->where('userId='.$userId)->save($data);
		return 1;
	}
	
	/**
	 * 修改个人资料
	 */
	public function editUserInfo(){
		$userId = $this->getUserId();
		$data = array();
		$data['userName'] = I('userName');
		$data['userSex'] = I('userSex',3);
		M('users')->where('userId='.$userId)->save($data);
	}
}