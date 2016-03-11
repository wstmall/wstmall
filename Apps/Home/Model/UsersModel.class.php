<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 会员服务类
 */
class UsersModel extends BaseModel {
	
     /**
	  * 获取用户信息
	  */
     public function get($userId=0){
	 	$m = M('users');
	 	$userId = $userId?$userId:(int)I('id',0);
		$user = $m->where("userId=".$userId)->find();
		if(!empty($user) && $user['userType']==1){
			//加载商家信息
		 	$s = M('shops');
		 	$shops = $s->where('userId='.$user['userId']." and shopFlag=1")->find();
		 	if(!empty($shops))$user = array_merge($shops,$user);
		}
		return $user;
	 }
	 
	/**
	  * 获取用户信息
	  */
     public function getUserInfo($loginName,$loginPwd){
	 	$m = M('users');
		$loginPwd = md5($loginPwd);
	 	$rs = $m->where(" loginName ='%s' AND loginPwd ='%s' ",array($loginName,$loginPwd))->find();
	    return $rs;
	 }
	 
	/**
	  * 获取用户信息
	  */
     public function getUserById($obj){
	 	$m = M('users');
		$userId = (int)$obj["userId"];
	 	$rs = $m->where(" userId ='%s' ",array($userId))->find();
	 	
	    return $rs;
	 }
	 
 	/**
	  * 查询登录名是否存在
	  */
	 public function checkLoginKey($loginName,$id = 0,$isCheckKeys = true){
	 	$loginName = ($loginName!='')?$loginName:I('loginName');
	 	$rd = array('status'=>-1);
	 	if($loginName=='')return $rd;
	 	if($isCheckKeys){
		 	if(!WSTCheckFilterWords($loginName,$GLOBALS['CONFIG']['limitAccountKeys'])){
		 		$rd['status'] = -2;
		 		return $rd;
		 	}
	 	}
	 	$sql = " (loginName ='%s' or userPhone ='%s' or userEmail='%s') and userFlag=1 ";
	 	$m = M('users');
	    if($id>0){
	 		$sql.=" and userId!=".$id;
	 	}
	 	$rs = $m->where($sql,array($loginName,$loginName,$loginName))->count();
	    if($rs==0){
	    	$rd['status'] = 1;
	    }
	    return $rd;
	 }
	 
	 /**
	  * 查询并加载用户资料
	  */
	 public function checkAndGetLoginInfo($key){
	 	if($key=='')return array();
	 	$sql = " (loginName ='%s' or userPhone ='%s' or userEmail='%s') and userFlag=1 and userStatus=1 ";
	 	$keyArr = array($key,$key,$key);
	 	$m = M('users');
	 	$rs = $m->where($sql,$keyArr)->find();
	    return $rs;
	 }
	 
    /**
	 * 用户登录验证
	 */
	public function checkLogin(){
		$rv = array('status'=>-1);
		$loginName = I('loginName');
		$userPwd = I('loginPwd');
		$rememberPwd = I('rememberPwd');
		$sql ="SELECT * FROM __PREFIX__users WHERE (loginName='".$loginName."' OR userEmail='".$loginName."' OR userPhone='".$loginName."') AND userFlag=1 and userStatus=1 ";
		$rss = $this->query($sql);
		if(!empty($rss)){
			$rs = $rss[0];
			if($rs['loginPwd']!=md5($userPwd.$rs['loginSecret']))return $rv;
			if($rs['userFlag'] == 1 && $rs['userStatus']==1){
				$data = array();
				$data['lastTime'] = date('Y-m-d H:i:s');
				$data['lastIP'] = get_client_ip();
				$m = M('users');
		    	$m->where(" userId=".$rs['userId'])->data($data)->save();
		    	//如果是店铺则加载店铺信息
		    	if($rs['userType']>=1){
		    		$s = M('shops');
			 		  $shops = $s->where('userId='.$rs['userId']." and shopFlag=1")->find();
			 		  if(!empty($shops))$rs = array_merge($shops,$rs);
		    	}
		    	//记录登录日志
				$data = array();
				$data["userId"] = $rs['userId'];
				$data["loginTime"] = date('Y-m-d H:i:s');
				$data["loginIp"] = get_client_ip();
				M('log_user_logins')->add($data);
			}
			$rv = $rs;
			setcookie("loginName", $loginName, time()+3600*24*60);
			if($rememberPwd == "on"){			
				setcookie("loginPwd", $userPwd, time()+3600*24*60);
			}else{		
				setcookie("loginPwd", "", time()-3600);
			}
		}
		return $rv;
	}
	
	 
	/**
	 * 会员注册
	 */
    public function regist(){
    	$m = M('users');
    	$rd = array('status'=>-1);	   
    	
    	$data = array();
    	$data['loginName'] = I('loginName','');
    	$data['loginPwd'] = I("loginPwd");
    	$data['reUserPwd'] = I("reUserPwd");
    	$data['protocol'] = I("protocol");
    	$loginName = $data['loginName'];
        //检测账号是否存在
        $crs = $this->checkLoginKey($loginName);
        if($crs['status']!=1){
	    	$rd['status'] = -2;
	    	$rd['msg'] = ($crs['status']==-2)?"不能使用该账号":"该账号已存在";
	    	return $rd;
	    }
    	if($data['loginPwd']!=$data['reUserPwd']){
    		$rd['status'] = -3;
    		$rd['msg'] = '两次输入密码不一致!';
    		return $rd;
    	}
    	if($data['protocol']!=1){
    		$rd['status'] = -6;
    		$rd['msg'] = '必须同意使用协议才允许注册!';
    		return $rd;
    	}
    	foreach ($data as $v){
    		if($v ==''){
    			$rd['status'] = -7;
    			$rd['msg'] = '注册信息不完整!';
    			return $rd;
    		}
    	}
	    $nameType = I("nameType");
	    $mobileCode = I("mobileCode");
		if($nameType==3 && $GLOBALS['CONFIG']['phoneVerfy']==1){//手机号码
			$verify = session('VerifyCode_userPhone');
			$startTime = (int)session('VerifyCode_userPhone_Time');
			if((time()-$startTime)>120){
				$rd['status'] = -5;
				$rd['msg'] = '验证码已超过有效期!';
				return $rd;
			}
			if($mobileCode=="" || $verify != $mobileCode){
				$rd['status'] = -4;
				$rd['msg'] = '验证码错误!';
				return $rd;
			}
			$loginName = $this->randomLoginName($loginName);
		}else if($nameType==1){//邮箱注册
			$unames = explode("@",$loginName);
			$loginName = $this->randomLoginName($unames[0]);
		}
		if($loginName=='')return $rd;//分派不了登录名
		$data['loginName'] = $loginName;
	    unset($data['reUserPwd']);
	    unset($data['protocol']);
	    //检测账号，邮箱，手机是否存在
	    $data["loginSecret"] = rand(1000,9999);
	    $data['loginPwd'] = md5(I('loginPwd').$data['loginSecret']);
	    $data['userType'] = 0;
	    $data['userName'] = I('userName');
	    $data['userQQ'] = I('userQQ');
	    $data['userPhone'] = I('userPhone');
	    $data['userScore'] = I('userScore');
		$data['userEmail'] = I("userEmail");
	    $data['createTime'] = date('Y-m-d H:i:s');
	    $data['userFlag'] = 1;
	    
	   
		$rs = $m->add($data);
		if(false !== $rs){
			$rd['status']= 1;
			$rd['userId']= $rs;
		}
	   
	    if($rd['status']>0){
	    	$data = array();
	    	$data['lastTime'] = date('Y-m-d H:i:s');
	    	$data['lastIP'] = get_client_ip();
	    	$m->where(" userId=".$rs['userId'])->data($data)->save();	 		
	    	//记录登录日志
		 	$data = array();
			$data["userId"] = $rd['userId'];
			$data["loginTime"] = date('Y-m-d H:i:s');
			$data["loginIp"] = get_client_ip();
			$m = M('log_user_logins');
			$m->add($data);
	    	
	    } 
		return $rd;
	}
	
	/**
	 * 随机生成一个账号
	 */
	public function randomLoginName($loginName){
		$chars = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		//简单的派字母
		foreach ($chars as $key =>$c){
			$crs = $this->checkLoginKey($loginName."_".$c);
			if($crs['status']==1)return $loginName."_".$c;
		}
		//随机派三位数值
		for($i=0;$i<1000;$i++){
			$crs = $this->checkLoginKey($loginName."_".$i);
			if($crs['status']==1)return $loginName."_".$i;
		}
		return '';
	}
	
	/**
	 * 查询用户手机是否存在
	 */
    public function checkUserPhone($userPhone,$userId = 0){
    	$userId = $userId>0?$userId:(int)I("userId");
    	$rd = array('status'=>-3);
	 	$m = M('users');
		$sql =" userFlag=1 and userPhone='".$userPhone."'";
		if($userId>0){
			$sql .= " AND userId <> $userId";
		}
		$rs = $m->where($sql)->count();
	
	    if($rs==0)$rd['status'] = 1;
	    return $rd;
	}
	
	/**
	 * 修改用户密码
	 */
	public function editPass($id){
		$rd = array('status'=>-1);
		$m = M('users');
		$data = array();
		$data["loginPwd"] = I("newPass");
		if($this->checkEmpty($data,true)){
			$rs = $m->where('userId='.$id)->find();
			//核对密码
			if($rs['loginPwd']==md5(I("oldPass").$rs['loginSecret'])){
				$data["loginPwd"] = md5(I("newPass").$rs['loginSecret']);
				$rs = $m->where("userId=".$id)->save($data);
				if(false !== $rs){
					$rd['status']= 1;
				}
			}else{
				$rd['status']= -2;
			}
		}
		return $rd;
	}
	
	/**
	 * 修改用户资料
	 */
	public function editUser($obj){
		$rd = array('status'=>-1);
		$userPhone = I("userPhone");
		$userEmail = I("userEmail");
		$userId = (int)$obj["userId"];
	    //检测账号是否存在
        $crs = $this->checkLoginKey($userPhone,$userId,false);
        if($crs['status']!=1){
	    	$rd['status'] = -2;
	    	return $rd;
	    }
	    //检测邮箱是否存在
        $crs = $this->checkLoginKey($userEmail,$userId,false);
        if($crs['status']!=1){
	    	$rd['status'] = -3;
	    	return $rd;
	    }
		$m = M('users');
		$data = array();
		
		$data["userName"] = I("userName");
		$data["userQQ"] = I("userQQ");
		$data["userPhone"] = $userPhone;
		$data["userSex"] = (int)I("userSex",0);
		$data["userEmail"] = $userEmail;
		$data["userPhoto"] = I("userPhoto");
		$rs = $m->where(" userId=".$userId)->data($data)->save();
	    if(false !== $rs){
			$rd['status']= 1;
			$WST_USER = session('WST_USER');
			$WST_USER['userName'] = $data["userName"];
			$WST_USER['userQQ'] = $data["userQQ"];
			$WST_USER['userSex'] = $data["userSex"];
			$WST_USER['userPhone'] = $data["userPhone"];
			$WST_USER['userEmail'] = $data["userEmail"];
			$WST_USER['userPhoto'] = $data["userPhoto"];
			session('WST_USER',$WST_USER);
		}
		return $rd;
	}
	
	/**
	 * 重置用户密码
	 */
	public function resetPass(){
		$rs = array('status'=>-1);
    	$reset_userId = (int)session('REST_userId');
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
    	$loginPwd = I('loginPwd');
    	if(trim($loginPwd)==''){
    		$rs['msg'] = '无效的密码！';
    		return $rs;
    	}
    	$data['loginPwd'] = md5($loginPwd.$user["loginSecret"]);
    	$rc = $m->where("userId=".$reset_userId)->save($data);
    	if(false !== $rc){
    	    $rs['status'] =1;
    	}
    	session('REST_userId',null);
    	session('REST_Time',null);
    	session('REST_success',null);
    	session('findPass',null);
    	return $rs;
	}
}