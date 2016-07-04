<?php
namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 基础控制器
 */
class UsersAction extends BaseAction {

	/**
	 * 登录页
	 */
  public function index(){
    $users = D('WebApp/Users');
    $userId = (int)session('WST_USER.userId');
    if($userId){
      //各种状态的订单的数量
      $orderCount = D('WebApp/Orders')->getOrderCount();
      $this->assign('orderCount', $orderCount);
      //商城未读消息的数量
      $msgCount = D('WebApp/Messages')->getUnreadMsgCount();
      $this->assign('msgCount', $msgCount);
      $this->display("default/users/users");
    }else{
    	$this->assign('qqBackUrl',urlencode(WSTDomain()."/Wstapi/thridLogin/qqlogin2.php"));
    	$this->display("default/login");
     	
    }
  }

  /**
   * 修改密码
   */
  public function editPwd(){
    $this->isLogin();
    $users = D('WebApp/Users');
    $rs = $users->editPwd();
    $this->ajaxReturn($rs);
  }

  /**
   * 个人信息页面
   */
  public function toUserInfo(){
    $this->isLogin();
    $user = session('WST_USER');
    $this->assign('user', $user);
    $this->display("default/users/userinfo");
  }

  /**
   * 登录
   */
  public function login(){
    $users = D('WebApp/Users');
    $rs = $users->login();
    $this->ajaxReturn($rs);
  }

  /**
   * 登出
   */
  public function logout(){
    session('WST_USER', null);
    setcookie("loginPwd", null);
    session('originalUrl',null);
    $this->ajaxReturn('1');
  }

  /**
   * 用户注册
   */
  public function register(){
    $users = D('WebApp/Users');
    $rs = $users->register();
    $this->ajaxReturn($rs);
  }

  /**
   * 修改个人资料
   */
  public function editUserInfo(){
    $this->isLogin();
    $users = D('WebApp/Users');
    $rs = $users->editUserInfo();
    $this->ajaxReturn($rs);
  }
  
  /**
   * 查询登录名是否存在
   */
  public function checkLoginKey(){
    $users = D('WebApp/Users');
    $rs = array('status'=>-2);
    if (!$this->checkCodeVerify(false)) {
      $this->ajaxReturn($rs);
    }
    $rs = $users->checkLoginName();
    if($rs['status'] == 1){//将要找回密码的用户信息记录到session里
      session('userToFindPwd', $rs['user']);
    }
    $this->ajaxReturn($rs);
  }

  /**
   * 找回密码：找回方式
   */
  public function findPassword(){
    $users = D('WebApp/Users');
    $userInfo = session('userToFindPwd');
    if($userInfo['userPhone']!=''){
      $userInfo['userPhone'] = WSTStrReplace($userInfo['userPhone'],'*',3);
    }
    if($userInfo['userEmail']!=''){
      $userInfo['userEmail'] = WSTStrReplace($userInfo['userEmail'],'*',2,'@');
    }
    $this->assign('userInfo', $userInfo);
    $this->display("default/find_password");
  }

  /**
   * 找回密码：发送短信验证码
   */
  public function sendSmsCode(){
    $rs = array('status'=>-1);
    if(session('userToFindPwd.userPhone')==''){
      $rs['status'] = -2;
      $rs['msg'] = '非法操作';
      $this->ajaxReturn($rs);
    }
    $phoneVerify = mt_rand(100000,999999);
    $USER = session('userToFindPwd');
    $USER['phoneVerify'] = $phoneVerify;
    session('userToFindPwd',$USER);
    $msg = "您正在重置登录密码，验证码为:".$phoneVerify."，请在30分钟内输入。【".$GLOBALS['CONFIG']['mallName']."】";
    $rv = D('WebApp/LogSms')->sendSMS(0,session('userToFindPwd.userPhone'),$msg,'sendSmsCode',$phoneVerify);
    $this->ajaxReturn($rv);
  }

  /**
   * 找回密码：发送邮箱验证码
   */
  public function sendEmailCode(){
    $rs = array('status'=>-1);
    if(!$this->checkCodeVerify(false)) {
      $rs['status'] = -2;
      $this->ajaxReturn($rs);
    }
    $keyFactory = new \Think\Crypt();
    $key = $keyFactory->encrypt("0_".session('userToFindPwd.userId')."_".time(),C('SESSION_PREFIX'),30*60);
    $url = WSTRootDomain().U('WebApp/Users/toResetPass',array('key'=>$key));

    $html = "您好，会员 ".session('userToFindPwd.loginName')."：<br>
    您在".date('Y-m-d H:i:s')."发出了重置密码的请求,请点击以下链接进行密码重置:<br>
    <a href='".$url."' target='_blank'>".$url."</a><br>
    <br>如果您的邮箱不支持链接点击，请将以上链接地址拷贝到你的浏览器地址栏中。<br>
    该验证邮件有效期为30分钟，超时请重新发送邮件。<br>
    <br><br>*此邮件为系统自动发出的，请勿直接回复。";

    $sendRs = WSTSendMail(session('userToFindPwd.userEmail'),'密码重置',$html);
    if($sendRs['status']==1){
      $rs['status'] = 1;
    }else{
      $rs['msg'] = $sendRs['msg'];
    }
    $this->ajaxReturn($rs);
  }

  /**
   * 手机验证码检测
   * -1 错误，1正确
   */
  public function checkPhoneVerify(){
    $phoneVerify = I('phoneVerify');
    $rs = array('status'=>-1);
    if (session('userToFindPwd.phoneVerify') == $phoneVerify ) {
      if( session('userToFindPwd.userId') > 0 ){
        $rs['status'] = 1;
        $keyFactory = new \Think\Crypt();
        $key = $keyFactory->encrypt("0_".session('userToFindPwd.userId')."_".time(),C('SESSION_PREFIX'),30*60);
        $rs['url'] = WSTRootDomain().U('WebApp/Users/toResetPass',array('key'=>$key));
      }
    }
    $this->ajaxReturn($rs);
  }

  /**
  * 跳到重置密码
  */
  public function toResetPass(){
    $key = I('key');
    $keyFactory = new \Think\Crypt();
    $key = $keyFactory->decrypt($key,C('SESSION_PREFIX'));
    $key = explode('_',$key);
    if(time()>floatval($key[2])+30*60)$this->error('连接已失效！');
    if(intval($key[1])==0)$this->error('无效的用户！');
    session('REST_userId',$key[1]);
    session('REST_Time',$key[2]);
    session('REST_success','1');
    $this->display('default/reset_password');
  }

  /**
   * 重置密码
   */
  public function resetPass(){
    $resetPass = session('REST_success');
    $rs = array('status'=>-1);
    if($resetPass != 1){
      $rs['msg'] = '非法操作';
      $this->ajaxReturn($rs);
    }
    $rs = D('WebApp/Users')->resetPass();
    $this->ajaxReturn($rs);
  }
  
  /**
   * QQ登录回调方法
   */
  public function qqLoginCallback(){
  	header ( "Content-type: text/html; charset=utf-8" );
  	vendor ( 'ThirdLogin.QqLogin' );
  
  	$appId = $GLOBALS['CONFIG']["qqAppId"];
  	$appKey = $GLOBALS['CONFIG']["qqAppKey"];
  	//回调接口，接受QQ服务器返回的信息的脚本
  	$callbackUrl = WSTDomain()."/Wstapi/thridLogin/qqlogin2.php";
  	//实例化qq登陆类，传入上面三个参数
  	$qq = new \QqLogin($appId,$appKey,$callbackUrl);
  	//得到access_token验证值
  	$accessToken = $qq->getToken();
  	if(!$accessToken){
  		$this->redirect("WebApp/Users/login");
  	}
  	//得到用户的openid(登陆用户的识别码)和Client_id
  	$arr = $qq->getClientId($accessToken);
  	if(isset($arr['client_id'])){
  		$clientId = $arr['client_id'];
  		$openId = $arr['openid'];
  		$um = D('WebApp/Users');
  		//已注册，则直接登录
  		if($um->checkThirdIsReg(1,$openId)){
  			$obj["openId"] = $openId;
  			$obj["userFrom"] = 1;
  			$rd = $um->thirdLogin($obj);
  			if($rd["status"]==1){
  				$this->redirect("WebApp/Index/index");
  			}else{
  				$this->redirect("WebApp/Users/login");
  			}
  		}else{
  			//未注册，则先注册
  			$arr = $qq->getUserInfo($clientId,$openId,$accessToken);
  			$obj["userName"] = $arr["nickname"];
  			$obj["openId"] = $openId;
  			$obj["userFrom"] = 1;
  			$obj["userPhoto"] = $arr["figureurl_2"];
  			$um->thirdRegist($obj);
  			$this->redirect("WebApp/Index/index");
  		}
  	}else{
  		$this->redirect("WebApp/Users/login");
  	}
  }
  
  /**
   * 微信登录回调方法
   */
  public function wxLoginCallback(){
  	header ( "Content-type: text/html; charset=utf-8" );
  	vendor ( 'ThirdLogin.WxLogin' );
  
  	//$appId = $GLOBALS['CONFIG']["wxAppId"];
  	//$appKey = $GLOBALS['CONFIG']["wxAppKey"];
  	$appId = "wx77cecc5f4c943912";
  	$appKey = "2ddb745bdcfa79a400c726acbf64a1e4";
  
  	$wx = new \WxLogin($appId,$appKey);
  	//得到access_token验证值
  	$accessToken = $wx->getToken();
  	 
  	if(!$accessToken){
  		$this->redirect("WebApp/Users/login");
  	}
  	//得到用户的openid(登陆用户的识别码)和Client_id
  	$openId = $wx->getOpenId();
  	if($openId!=""){
  		$um = D('WebApp/Users');
  		//已注册，则直接登录
  		if($um->checkThirdIsReg(2,$openId)){
  			$obj["openId"] = $openId;
  			$obj["userFrom"] = 2;
  			$rd = $um->thirdLogin($obj);
  			if($rd["status"]==1){
  				$this->redirect("WebApp/Index/index");
  			}else{
  				$this->redirect("WebApp/Users/login");
  			}
  		}else{
  			//未注册，则先注册
  			$arr = $wx->getUserInfo($openId,$accessToken);
  			$obj["userName"] = $arr["nickname"];
  			$obj["openId"] = $openId;
  			$obj["userFrom"] = 2;
  			$obj["userPhoto"] = $arr["headimgurl"];
  			$um->thirdRegist($obj);
  			$this->redirect("WebApp/Index/index");
  		}
  	}else{
  		$this->redirect("WebApp/Users/login");
  	}
  }
  

  /**
   * 去绑定邮箱
   */
  public function toBindEmail(){
    $this->isLogin();
    $this->display("default/users/bind_email");
  }

  /**
   * 绑定邮箱：发送邮箱验证码
   */
  public function sendEmailCodeToBind(){
    $this->isLogin();
    $rs = array('status'=>-1);
    if( !$this->checkCodeVerify(false) ) {
      $rs['status'] = -2;
      $this->ajaxReturn($rs);
    }
    
    $userEmail = I('userEmail');
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if ( !preg_match( $pattern, $userEmail ) ){
      $rs['status'] = -3;
      $this->ajaxReturn($rs);
    }
    if ( $userEmail == session('WST_USER.userEmail') ){
      $rs['status'] = -4;
      $this->ajaxReturn($rs);
    }

    $emailCode = mt_rand(100000, 999999);
    session('userToBindEmailCode', $emailCode, time()+30*60);
    session('userToBindEmail', $userEmail, time()+30*60);

    $html = "您好，会员 ".session('WST_USER.loginName')."：<br>
    您的验证码为:<br>
    该验证码有效期为30分钟，超时请重新发送邮件。<br>
    <br><br>*此邮件为系统自动发出的，请勿直接回复。";

    $sendRs = WSTSendMail($userEmail, '绑定邮箱', $html);
    if($sendRs['status'] == 1){
      $rs['status'] = 1;
    }else{
      $rs['msg'] = $sendRs['msg'];
    }
    $this->ajaxReturn($rs);
  }

  /**
   * 绑定邮箱
   */
  public function bindEmail(){
    $this->isLogin();
    $rs = array('status'=>-1);
    $emailCode = I('emailCode');
    if( $emailCode == '' ) {
      $rs['msg'] = '请输入邮箱验证码';
      $this->ajaxReturn($rs);
    }
    if( !session('userToBindEmail') || !session('userToBindEmailCode') ){
      $rs['msg'] = '请先发送邮件获取验证码';
      $this->ajaxReturn($rs);
    }
    if( session('userToBindEmailCode') != $emailCode ){
      $rs['msg'] = '邮箱验证码不正确';
      $this->ajaxReturn($rs);
    }
    session('userToBindEmailCode', null);
    session('userToBindEmail', null);

    $userInfo = array();
    $userInfo['userEmail'] = session('userToBindEmail');
    D('WebApp/Users')->editUserInfo($userInfo);

    $rs['status'] = 1;
    $this->ajaxReturn($rs);
  }

  /**
   * 去绑定手机
   */
  public function toBindPhone(){
    $this->isLogin();
    $this->display("default/users/bind_phone");
  }

  /**
   * 绑定手机：发送手机验证码
   */
  public function sendPhoneCodeToBind(){
    $this->isLogin();
    $rs = array('status'=>-1);
    if( !$this->checkCodeVerify(false) ) {
      $rs['status'] = -2;
      $this->ajaxReturn($rs);
    }
    
    $userPhone = I('userPhone');
    $pattern = "/^1[34578]\d{9}$/";
    if ( !preg_match( $pattern, $userPhone ) ){
      $rs['status'] = -3;
      $this->ajaxReturn($rs);
    }
    if ( $userPhone == session('WST_USER.userPhone') ){
      $rs['status'] = -4;
      $this->ajaxReturn($rs);
    }

    $phoneCode = mt_rand(100000, 999999);
    session('userToBindPhoneCode', $phoneCode, time()+30*60);
    session('userToBindPhone', $userPhone, time()+30*60);

    $msg = "您的验证码为:".$phoneCode."，请在30分钟内输入。【".$GLOBALS['CONFIG']['mallName']."】";
    $rv = D('WebApp/LogSms')->sendSMS(0, $userPhone, $msg, 'sendPhoneCodeToBind', $phoneCode);
    $this->ajaxReturn($rv);
  }

  /**
   * 绑定手机
   */
  public function bindPhone(){
    $this->isLogin();
    $rs = array('status'=>-1);
    $phoneCode = I('phoneCode');
    if( $phoneCode == '' ) {
      $rs['msg'] = '请输入短信验证码';
      $this->ajaxReturn($rs);
    }
    if( !session('userToBindPhone') || !session('userToBindPhoneCode') ){
      $rs['msg'] = '请先发送短信获取验证码';
      $this->ajaxReturn($rs);
    }
    if( session('userToBindPhoneCode') != $phoneCode ){
      $rs['msg'] = '短信验证码不正确';
      $this->ajaxReturn($rs);
    }
    session('userToBindPhoneCode', null);
    session('userToBindPhone', null);

    $userInfo = array();
    $userInfo['userPhone'] = session('userToBindPhone');
    D('WebApp/Users')->editUserInfo($userInfo);

    $rs['status'] = 1;
    $this->ajaxReturn($rs);
  }

}