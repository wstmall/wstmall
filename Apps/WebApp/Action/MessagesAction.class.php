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
class MessagesAction extends BaseAction {

  /**
   * 消息
   */
  public function index(){
    $this->isLogin();
    $this->display('default/users/messages_list');
  }

  /**
   * 消息列表
   */
  public function getMessagesList(){
    $this->isLogin();
    $msg = D('WebApp/Messages');
    $messagesList = $msg->getMessagesList();
    $this->ajaxReturn($messagesList);
  }

  /**
   * 消息详情
   */
  public function getMsgDetails(){
    $this->isLogin();
    $msg = D('WebApp/Messages');
    $rs = $msg->getMsgDetails();
    $this->ajaxReturn($rs);
  }

  /**
   * 删除消息
   */
  public function delMsg(){
    $this->isLogin();
    $msg = D('WebApp/Messages');
    $rs = $msg->delMsg();
    $this->ajaxReturn($rs);
  }
}