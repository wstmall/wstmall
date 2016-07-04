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
class UsersAddressAction extends BaseAction {

	/**
	 * 收货地址列表
	 */
  public function index(){
    $this->isLogin();
    $userAddress = D('WebApp/UsersAddress');
    $addressList = $userAddress->getUserAddress();
    $this->assign('addressList', $addressList);
    $areas = D('WebApp/Areas');
    $provinceId = $areas->getCurrentProvinceId();//获取所在省份的ID
    $this->assign('provinceId', $provinceId);
    $this->display('default/address');
  }

  /**
   * 通过id获取收货地址
   */
  public function getAddressById(){
    $this->isLogin();
    $userAddress = D('WebApp/UsersAddress');
    $addressList = $userAddress->getAddressById();
    $this->ajaxReturn($addressList);
  }

  /**
   * 新增/编辑收货地址
   */
  public function editAddress(){
    $this->isLogin();
    $userAddress = D('WebApp/UsersAddress');
    $rs = array();
    if( (int)I('addressId') ){
      $rs = $userAddress->editAddress();
    }else{
      $rs = $userAddress->addAddress();
    }
    $this->ajaxReturn($rs);
  }

  /**
   * 删除收货地址
   */
  public function delAddress(){
    $this->isLogin();
    $userAddress = D('WebApp/UsersAddress');
    $rs = array();
    $rs = $userAddress->delAddress();
    $this->ajaxReturn($rs);
  }
  
  /**
   * 结算-获取指定地区的收货人地址
   */
  public function getUserAddressForOrder(){
    $this->isLogin();
    $userAddress = D('WebApp/UsersAddress');
    $rs = array();
    $rs = $userAddress->getUserAddressForOrder();
    $this->ajaxReturn($rs);
  }

}