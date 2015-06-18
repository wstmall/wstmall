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
use Think\Model;
class UsersModel extends BaseModel {
	
     /**
	  * 获取用户信息
	  */
     public function get($userId=0){
	 	$m = M('users');
	 	$userId = $userId?$userId:I('id');
		return $m->where("userId=".$userId)->find();
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
		$userId = $obj["userId"];
	 	$rs = $m->where(" userId ='%s' ",array($userId))->find();
	 	
	    return $rs;
	 }
	 
 	/**
	  * 查询登录名是否存在
	  */
	 public function checkLoginKey(){
	 	$rd = array('status'=>-1);
	 	if(I('loginName')=='')return $rd;
	 	$m = M('users');
	 	$rs = $m->where(" loginName ='%s' or userPhone ='%s' or userEmail='%s' ",array(I('loginName'),I('loginName'),I('loginName')))->count();
	    if($rs==0)$rd['status'] = 1;
	    return $rd;
	 }
	 
     /**
	  * 查询登录关键字
	  */
	 public function checkLoginKey2(){
	 	$rd = array('status'=>-1);
	 	$key = I('clientid');
	 	$id = $_SESSION['USER']['userId'];
	 	if($key!=''  && I($key)=='')return $rd;
	 	$sql = " (loginName ='%s' or userPhone ='%s' or userEmail='%s') ";
	 	$keyArr = array(I($key),I($key),I($key));
	 	if($id>0){
	 		$sql.=" and userId!=".$id;
	 		$keyArr[] = $id;
	 	}
	 	$m = M('users');
	 	$rs = $m->where($sql,$keyArr)->count();
	    if($rs==0)$rd['status'] = 1;
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
		$sql ="SELECT * FROM ".$this->tablePrefix."users WHERE (loginName='".$loginName."' OR userEmail='".$loginName."' OR userPhone='".$loginName."') AND userFlag=1 and userStatus=1 ";
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
    	$chars = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    	$data = array();
    	
    	$data['loginPwd'] = I("loginPwd");
    	$data['reUserPwd'] = I("reUserPwd");
    	$data['protocol'] = I("protocol");
    	$mobileCode = I("mobileCode");
    	
    	if($data['loginPwd']!=$data['reUserPwd']){
    		$rd['status'] = -3;
    		return $rd;
    	}
    	if($data['protocol']!=1){
    		$rd['status'] = -6;
    		return $rd;
    	}
    	foreach ($data as $v){
    		if($v ==''){
    			$rd['status'] = -2;
    			return $rd;
    		}
    	}
    	$nameType = I("nameType");
    	$loginName = I('loginName','');
    	
		if($nameType==3){
			
			$verify = $_SESSION['VerifyCode_userPhone'];
			$startTime = (int)$_SESSION['VerifyCode_userPhone_Time'];
			if((time()-$startTime)>120){
				$rd['status'] = -5;
				return $rd;
			}
			if($mobileCode=="" || $verify != $mobileCode){
				$rd['status'] = -4;
				return $rd;
			}
			$loginName = $loginName ."_". $chars[mt_rand(0,25)];
		}else if($nameType==1){
		
			$unames = explode("@",$loginName);
			$loginName = $unames[0] ."_". $chars[mt_rand(0, 25)];
		}
		$data['loginName'] = $loginName;
	    unset($data['reUserPwd']);
	    unset($data['protocol']);
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
	
	    if($this->checkLoginKey($loginName)==1){
	    	$rd['status'] = -1;
	    	return $rd;
	    }
	   
		$rs = $m->add($data);
		if($rs){
			$rd['status']= 1;
			$rd['userId']= $rs;
		}
	   
	    if($rd['status']>0){
	    	$data = array();
	    	$data['lastTime'] = date('Y-m-d H:i:s');
	    	$data['lastIP'] = get_client_ip();
	    	$m->where(" userId=".$rs['userId'])->data($data)->save();
	    } 
		return $rd;
	}
	
	/**
	 * 查询用户手机是否存在
	 */
    public function checkUserPhone($userPhone){
    	$userId = I("userId");
    	
    	$rd = array('status'=>-2);
	 	
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
		$m = M('users');
		$data = array();
		$userId = $obj["userId"];
		$data["userName"] = I("userName");
		$data["userQQ"] = I("userQQ");
		$data["userPhone"] = I("userPhone");
		$data["userSex"] = I("userSex",0);
		$data["userEmail"] = I("userEmail");
		$data["userPhoto"] = I("userPhoto");
		$rs = $m->where(" userId=".$userId)->data($data)->save();
	    if(false !== $rs){
			$rd['status']= 1;
			$_SESSION['USER']['userName'] = $data["userName"];
			$_SESSION['USER']["userQQ"] = $data["userQQ"];
			$_SESSION['USER']["userSex"] = $data["userSex"];
			$_SESSION['USER']["userPhone"] = $data["userPhone"];
			$_SESSION['USER']["userEmail"] = $data["userEmail"];
			$_SESSION['USER']["userPhoto"] = $data["userPhoto"];
		}
		return $rd;
	}
}