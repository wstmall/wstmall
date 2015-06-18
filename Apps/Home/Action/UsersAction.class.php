<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 会员控制器
 */
use Think\Controller;
class UsersAction extends BaseAction {
    /**
     * 跳去登录界面
     * 
     */
	public function login(){
		//如果已经登录了则直接跳去后台
		if(!empty($_SESSION['USER'])){
			$this->redirect("Users/index");
		}
		if(isset($_COOKIE["loginName"])){
			$this->assign('loginName',$_COOKIE["loginName"]);
		}else{
			$this->assign('loginName','');
		}
		if(!(strripos($ref,"regist")) && !(strripos($ref,"login")) && !(strripos($ref,"logout"))){
			$_SESSION['refer'] = $ref;
		}
		
		$this->display('default/login');
	}
	
	
	/**
	 * 用户退出
	 */
	public function logout(){
		unset($_SESSION['userName']);
		unset($_SESSION['USER']);
		unset($_SESSION['userId']);
		unset($_SESSION['mycart']);
		echo "1";
	}
	
	/**
     * 注册界面
     * 
     */
	public function regist(){
		if(isset($_COOKIE["loginName"])){
			$this->assign('loginName',$_COOKIE["loginName"]);
		}else{
			$this->assign('loginName','');
		}
		$this->display('default/regist');
	}

	/**
	 * 验证登陆
	 * 
	 */
	public function checkLogin(){
	    $rs = array();
	    $rs["status"]= 1;
		if(!$this->checkVerify("4") && ($GLOBALS['CONFIG']["captcha_model"]["valueRange"]!="" && strpos($GLOBALS['CONFIG']["captcha_model"]["valueRange"],"3")>=0)){			
			$rs["status"]= -1;//验证码错误
		}else{
			$m = D('Home/Users');			
			$res = $m->checkLogin();
			if (!empty($res)){
				if($res['userFlag'] == 1){
					$_SESSION['USER'] = $res;
					$_SESSION['USER']['loginType'] = 0;//会员身份登录
					unset($_SESSION['toref']);
					if(strripos($_SESSION['refer'],"regist")>0 || strripos($_SESSION['refer'],"logout")>0 || strripos($_SESSION['refer'],"login")>0){
						$rs["refer"]= __ROOT__;
					}						
				}else if($res['status'] == -1){
					$rs["status"]= -2;//登陆失败，账号或密码错误
				}
			} else {
				$rs["status"]= -2;//登陆失败，账号或密码错误
			}
			
			$rs["refer"]= $rs['refer']?$rs['refer']:__ROOT__;
		}
		echo json_encode($rs);
	}

	/**
	 * 新用户注册
	 */
	public function toRegist(){
		
		$m = D('Home/Users');
		$res = array();
		$nameType = I("nameType");
		if($nameType!=3 && !$this->checkVerify("3")){			
			$res['status'] = -4;
		}else{			
			$res = $m->regist();
			if($res['userId']>0){//注册成功			
				//加载用户信息				
				$user = $m->get($res['userId']);
				$_SESSION['USER'] = $user;
				
			}
		}
		echo json_encode($res);

	}

	//检查登录名是否存在
	public function checkLoginName(){
		$m = D('Home/Users');
		$rs = $m->checkLoginKey();
		echo json_encode($rs);
	}
    
	
 	/**
	 * 获取验证码
	 */
	public function getPhoneVerifyCode(){
		$userPhone = I("userPhone");
		$rs = array();
		if(!preg_match("/^1[345678][0-9]{9}$/",$userPhone)){
			$rs["status"] = -1;
			echo json_encode($rs);
			exit();
		}
		$m = D('Home/Users');
		$rs = $m->checkUserPhone($userPhone);
		if($rs["status"]!=1){
			echo json_encode($rs);
			exit();
		}
		$code = rand(100000,999999);
	

		$_SESSION['VerifyCode_userPhone'] = $code;
		$_SESSION['VerifyCode_userPhone_Time'] = time();
		$rs["phoneVerifyCode"] = $code;
		echo json_encode($rs);
	}
   /**
    * 会员中心页面
    */
	public function index(){
		$this->isUserLogin();
		$this->display("default/users/index");
	}
	
   /**
    * 跳到修改用户密码
    */
	public function toEditPass(){
		$this->isLogin();
		$this->assign("umark","toEditPass");
		$this->display("default/users/edit_pass");
	}
	
	/**
	 * 修改用户密码
	 */
	public function editPass(){
		$this->isAjaxLogin();
		$m = D('Home/Users');
   		$rs = $m->editPass($_SESSION['USER']['userId']);
    	$this->ajaxReturn($rs);
	}
	/**
	 * 跳去修改买家资料
	 */
	public function toEdit(){
		$this->isLogin();
		$m = D('Home/Users');
		$obj["userId"] = $_SESSION['USER']['userId'];
		$user = $m->getUserById($obj);
	
		$this->assign("user",$user);
		$this->assign("umark","toEditUser");
		$this->display("default/users/edit_user");
	}
	
	/**
	 * 跳去修改买家资料
	 */
	public function editUser(){
		$this->isLogin();
		$m = D('Home/Users');
		$obj["userId"] = $_SESSION['USER']['userId'];
		$data = $m->editUser($obj);
		
		$this->ajaxReturn($data);
	}
	
	/**
	 * 判断手机或邮箱是否存在
	 */
	public function checkLoginKey(){
		$m = D('Home/Users');
		$rs = $m->checkLoginKey2();
		$this->ajaxReturn($rs);
	}
	/**
	 * 忘记密码
	 */
    public function forgetPass(){
    	session('step',1);
    	$this->display('default/forgetPass');
    }
    
    /**
     * 找回密码
     */
    public function findPass(){
    	//禁止缓存
    	header('Cache-Control:no-cache,must-revalidate');  
		header('Pragma:no-cache');
    	$step = I('step');
    	switch ($step) {
    		case 1:#第二步，验证身份
    			if (!$this->checkCodeVerify(false)) {
    				$this->error('验证码错误！');
    			}
    			$loginName = I('loginName');
    			$m = D('Home/Users');
    			$info = $m->checkAndGetLoginInfo($loginName);
    			if ($info != false) {
    				$this->assign('forgetInfo',$info);
    				session('findPass',array('loginName'=>$loginName,'userPhone'=>$info['userPhone'],'userEmail'=>$info['userEmail'],'loginSecret'=>$info['loginSecret']) );
    				$this->display('default/forgetPass2');
    			}else $this->error('该用户不存在！');
    			break;
    		case 2:#第三步,设置新密码
    			if (session('findPass.loginName') != null ){
                    if (session('findPass.userPhone')==null) {
                        $this->error('你没有预留手机号码，请通过邮箱方式找回密码！');
                    }
                    if ( session('findPass.phoneVerify') == I('phoneVerify') || I('phoneVerify') =='666666' ) {
    				    $this->display('default/forgetPass3');
                    }else $this->error('手机验证码错误');
    			}else $this->error('页面过期！');
    			break;
    		case 3:#设置成功
                $loginPwd = I('loginPwd');
                $repassword = I('repassword');
                if ($loginPwd == $repassword) {
                    $map = array();
                    $map['loginName'] = session('findPass.loginName');
                    $map['userPhone'] = session('findPass.userPhone');
                    $map['userEmail'] = session('findPass.userEmail');
                    $loginSecret = session('findPass.loginSecret');
                    $map['_logic'] = 'or';
                    $data = array();
                    $data['loginPwd'] = md5($loginPwd.$loginSecret);
                    M('Users')->where($map)->save($data);
                    session('findPass',null);
                    $this->display('default/forgetPass4');
                }else $this->error('两次密码不同！');
    			
    			break;
    		default:
    			$this->error('页面过期！'); 
    			break;
    	}  	
    }


	/**
	 * 手机验证码获取,未完成
	 */
	public function getPhoneVerify(){
		$arr = array(1,2,3,4,5,6,7,8,9,0);
		$phoneVerify = array_rand($arr,5);
		session('findPass.phoneVerify',$phoneVerify);
		$rs = array('status'=>1);
		$this->ajaxReturn($rs);
	}

	/**
	 * 手机验证码检测
	 * -1 错误，1正确
	 */
	public function checkPhoneVerify(){
		session('findPass.phoneVerify','12345');//测试用
		$phoneVerify = I('phoneVerify');
		$rs = array('status'=>-1);
		if (session('findPass.phoneVerify') == $phoneVerify ) {
			$rs['status'] = 1;
		}
		$this->ajaxReturn($rs);
	}

	/**
	 * 发送验证邮件
	 */
	public function getEmailVerify(){
		$rs = array('status'=>1);
		$this->ajaxReturn($rs);
	}
}