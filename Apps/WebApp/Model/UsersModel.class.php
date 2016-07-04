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
		$sql = "select * from __PREFIX__users where (loginName='".$loginName."' or userPhone='".$loginName."' or userEmail='".$loginName."')
	 	    and userFlag=1 ";
		$urs = $this->query($sql);
		$urs = $urs[0];
		if(empty($urs))return $rv;//账号不存在!
		if($urs['userStatus']==0)array('status'=>-2,msg=>'账号不存在!');//账号已被停用!
		if(md5($loginPwd.$urs['loginSecret'])!=$urs['loginPwd'])return array('status'=>-3,msg=>'账号或密码不正确!');//账号或密码不正确!
		$rv['status'] = 1;
		$rv['msg'] = '登录成功~';
		$rv['data'] = $urs;
		//记录登录信息
		$data = array();
		$data["userId"] = $urs['userId'];
		$data["loginTime"] = date('Y-m-d H:i:s');
		$data["loginIp"] = get_client_ip();
		$data["loginSrc"] = 1;
		$data["loginRemark"] = I('loginRemark');
		$m = M('log_user_logins');
		M('log_user_logins')->add($data);
		
		//记住密码
	    $rememberPwd = I('rememberPwd');
		setcookie("loginName", $loginName, time()+3600*24*90);
		if($rememberPwd == "on"){
			$datakey = md5($urs['loginName'])."_".md5($urs['loginPwd']);
			$key = C('COOKIE_PREFIX')."_".$urs['loginSecret'];
			//加密
			$base64 = new \Think\Crypt\Driver\Base64();
			$loginKey = $base64->encrypt($datakey, $key);		
			setcookie("loginPwd", $loginKey, time()+3600*24*90);
		}else{		
			setcookie("loginPwd", null);
		}
		unset($urs['loginSecret'],$urs['loginPwd'],$urs['userStatus']);
		session('WST_USER',$urs);

		//成功登录后跳转到来源URL页面，除非来源URL页是登录页
		$originalUrl = session('originalUrl');
	    if( $originalUrl != '' && CONTROLLER_NAME != 'users' && ACTION_NAME != 'index' ){
	      $rv['originalUrl'] = $originalUrl;
	    }
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
				$data['userId'] = $rs;
				session('WST_USER', $data);//注册成功后登录

				$data = array();
				$data["userId"] = $rs;
				$data["loginTime"] = date('Y-m-d H:i:s');
				$data["loginIp"] = get_client_ip();
				$data["loginSrc"] = 1;
				$data["loginRemark"] = I('loginRemark');
				M('log_user_logins')->add($data);
				$rv['status']= 1;
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
	 * 查询用户名是否存在
	 */
	public function checkLoginName(){
		$loginName = I('loginName');
		$rd = array('status'=>-1);
		$rs = array();
		if($loginName=='') return $rd;
		$m = M('users');
		$rs = $m->where("loginName='".$loginName."'")->field("userId,loginName,userPhone,userEmail")->find();
		if(!empty($rs)){
			$rd['status'] = 1;
			$rd['user'] = $rs;
		}
		return $rd;
	}

	/**
	 * 修改用户密码
	 */
	public function editPwd(){
		$userId = (int)session('WST_USER.userId');
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
	public function editUserInfo( $userInfo = array() ){
		$userId = (int)session('WST_USER.userId');
		$data = array();
		$userPhoto = I('userPhoto');
		$userName = I('userName');
		$userSex = I('userSex');
		$userEmail = isset($userInfo['userEmail']) ? $userInfo['userEmail'] : I('userEmail');
		$userPhone = isset($userInfo['userPhone']) ? $userInfo['userPhone'] : I('userPhone');
		if($userPhoto != '') $data['userPhoto'] = $userPhoto;
		if($userName != '') $data['userName'] = $userName;
		if($userSex != '') $data['userSex'] = $userSex;
		if($userEmail != '') $data['userEmail'] = $userEmail;
		if($userPhone != '') $data['userPhone'] = $userPhone;
		M('users')->where('userId='.$userId)->save($data);
		$WST_USER = session('WST_USER');
		if($userPhoto != '') {
			$WST_USER['userPhoto'] = $userPhoto;
		}
		if($userName != '') {
			$WST_USER['userName'] = $userName;
		}
		if($userSex != '') {
			$WST_USER['userSex'] = $userSex;
		}
		if($userEmail != '') {
			$WST_USER['userEmail'] = $userEmail;
		}
		if($userPhone != '') {
			$WST_USER['userPhone'] = $userPhone;
		}
		session('WST_USER', $WST_USER);
		return 1;
	}

	/**
	 * 重置用户密码
	 */
	public function resetPass(){
		$rs = array('status'=>-1);
    	$reset_userId = (int)session('REST_userId');
    	$loginPwd = I('loginPwd');
    	$loginPwd2 = I('loginPwd2');
    	if( $loginPwd != $loginPwd2 ){
    		$rs['msg'] = '两次输入的密码不一致';
    		return $rs;
    	}
    	if(trim($loginPwd)==''){
    		$rs['msg'] = '无效的密码！';
    		return $rs;
    	}
    	if($reset_userId==0){
    		$rs['msg'] = '无效的用户！';
    		return $rs;
    	}
    	$m = M('Users');
    	$user = $m->where("userId=".$reset_userId." and userFlag=1 and userStatus=1")->find();
    	if(empty($user)){
    		$rs['msg'] = '无效的用户！';
    		return $rs;
    	}
    	$data['loginPwd'] = md5($loginPwd.$user["loginSecret"]);
    	$rc = $m->where("userId=".$reset_userId)->save($data);
    	if(false !== $rc){
    	    $rs['status'] = 1;
    	}
    	session('REST_userId',null);
    	session('REST_Time',null);
    	session('REST_success',null);
    	session('userToFindPwd',null);
    	return $rs;
	}
	
	/**
	 * 检测第三方帐号是否已注册
	 */
	public function checkThirdIsReg($userFrom,$openId){
		$openId = WSTAddslashes($openId);
		$sql = "select userId, userName from __PREFIX__users where userFrom=$userFrom and openId='$openId'";
		$row = $this->queryRow($sql);
		if($row["userId"]>0){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 第三方注册
	 */
	public function thirdRegist($obj){
		$rd = array('status'=>-1);
		 
		$data = array();
		$data['loginName'] = $this->randomLoginName(time());
		$data["loginSecret"] = rand(1000,9999);
		$data['loginPwd'] = "";
		$data['userType'] = 0;
		$data['userName'] = WSTAddslashes($obj["userName"]);
		$data['userQQ'] = "";
		$data['userPhoto'] = $obj["userPhoto"];
		$data['createTime'] = date('Y-m-d H:i:s');
		$data['userFlag'] = 1;
		$data['userFrom'] = $obj["userFrom"];
		$data['openId'] = WSTAddslashes($obj["openId"]);
	
		$rs = $this->add($data);
		if(false !== $rs){
			$rd['status']= 1;
			$rd['userId']= $rs;
		}
	
		if($rd['status']>0){
			$data = array();
			$data['lastTime'] = date('Y-m-d H:i:s');
			$data['lastIP'] = get_client_ip();
			$this->where(" userId=".$rd['userId'])->data($data)->save();
			//记录登录日志
			$data = array();
			$data["userId"] = $rd['userId'];
			$data["loginTime"] = date('Y-m-d H:i:s');
			$data["loginIp"] = get_client_ip();
			$m = M('log_user_logins');
			$m->add($data);
			
			$user = $this->where(" userId ='%s' ",array($rd['userId']))->find();
			if(!empty($user))session('WST_USER',$user);
		}
		return $rd;
	}
	
	
	
	/**
	 * 第三方登录
	 */
	public function thirdLogin($obj){
		$rd = array('status'=>-1);
		$openId = WSTAddslashes($obj['openId']);
		$sql = "select * from __PREFIX__users where userStatus=1 and userFlag=1 and userFrom=".$obj['userFrom']." and openId='".$openId."'";
		$row = $this->queryRow($sql);
		if($row["userId"]>0){
			session('WST_USER',$row);
			$rd["status"] = 1;
		}
		return $rd;
	}
}