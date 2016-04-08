<?php
 namespace Home\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 会员地址控制器
 */
class UserAddressAction extends BaseAction{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		$this->isUserLogin();
	    $m = D('Home/UserAddress');
    	$object = array();
    	if((int)I('id',0)>0){
    		$object = $m->get();
    	}else{
    		$object = $m->getModel();
    	}
    	//获取地区信息
		$m = D('Home/Areas');
		$this->assign('areaList',$m->getProvinceList());
    	$this->assign('object',$object);
    	$this->assign("umark","addressQueryByPage");
		$this->view->display('default/users/useraddress/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		
		$this->isUserLogin();
		$m = D('Home/UserAddress');
    	$rs = array();
    	if((int)I('id',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isUserLogin();
		$m = D('Home/UserAddress');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function queryByPage(){
		$this->isLogin();
		$USER = session('WST_USER');
		$m = D('Home/UserAddress');
    	$list = $m->queryByList($USER['userId']);
    	$this->assign('List',$list);
    	$this->assign("umark","addressQueryByPage");
        $this->display("default/users/useraddress/list");
	}
	/**
	 * 获取用户地址
	 */
	public function getUserAddress(){
		$this->isUserLogin();
		$m = D('Home/UserAddress');
		$address = $m->getUserAddressInfo();	
		$addressInfo = array();
		$addressInfo["status"] = 1;
		$addressInfo["address"] = $address;
		$this->ajaxReturn($addressInfo);	
	}
	
	/**
	 * 获取区县
	 */
	public function getDistricts(){
		
		$m = D('Home/UserAddress');
		$areaId2 = (int)I("areaId2");
		$communitys = $m->getDistricts($areaId2);	
		$this->ajaxReturn($communitys);
			
	}
	
	/**
	 * 获取社区
	 */
	public function getCommunitys(){
		
		$m = D('Home/UserAddress');
		$districtId = (int)I("districtId");
		$communitys = $m->getCommunitys($districtId);	
		$this->ajaxReturn($communitys);
			
	}
	
	/**
	 * 获取区县
	 */
	public function getDistrictsOption(){
		
		$m = D('Home/UserAddress');
		$areaId2 = (int)I("areaId2");
		$communitys = $m->getDistrictsOption($areaId2);	
		$this->ajaxReturn($communitys);
			
	}
	
	/**
	 * 获取社区
	 */
	public function getCommunitysOption(){
		
		$m = D('Home/UserAddress');
		$districtId = (int)I("districtId");
		$communitys = $m->getCommunitysOption($districtId);	
		$this->ajaxReturn($communitys);
			
	}
	
	/**
	 * 获取店铺配送区县
	 */
	public function getShopDistricts(){
	
		$m = D('Home/UserAddress');
		$areaId2 = (int)I("areaId2");
		$shopId = (int)I("shopId");
		$communitys = $m->getShopDistricts($areaId2,$shopId);
		$this->ajaxReturn($communitys);
			
	}
	
	/**
	 * 获取店铺配送社区
	 */
	public function getShopCommunitys(){
	
		$m = D('Home/UserAddress');
		$districtId = (int)I("districtId");
		$shopId = (int)I("shopId");
		$communitys = $m->getShopCommunitys($districtId,$shopId);
		$this->ajaxReturn($communitys);
			
	}
	
};
?>