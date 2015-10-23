<?php
namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城
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
    $usersId = $users->getUserId();
    if($usersId){
      $USER = session('WST_USER');
      $this->assign('loginName', $USER['loginName']);
      $this->assign('userScore', $USER['userScore']);
      $this->display("default/users");
    }else{
      $this->display("default/login");
    }
  }

  /**
   * 账号安全页面
   */
  public function toEditPwd(){
    $this->display("default/edit_pwd");
  }

  /**
   * 修改密码
   */
  public function editPwd(){
    $users = D('WebApp/Users');
    $rs = $users->editPwd();
    $this->ajaxReturn($rs);
  }

  /**
   * 个人信息页面
   */
  public function toUserInfo(){
    $users = D('WebApp/Users');
    $USER = session('WST_USER');
    $this->assign('loginName', $USER['loginName']);
    $this->assign('userName', $USER['userName']);
    $this->assign('userSex', $USER['userSex']);
    $this->display("default/userinfo");
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
    session('WST_USER',null);
    session("WST_CART",null);
    $this->ajaxReturn('1');
  }

  /**
   * 去注册
   */
  public function toRegister(){
    $rs = array();
    $this->ajaxReturn($rs);
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
    $users = D('WebApp/Users');
    $rs = $users->editUserInfo();
    $this->ajaxReturn(1);
  }
}