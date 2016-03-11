<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 店铺控制器
 */
class ShopsAction extends BaseAction {
	/**
     * 跳到商家首页面
     */
	public function toShopHome(){
		$mshops = D('Home/Shops');
		$shopId = (int)I('shopId');
		//如果沒有传店铺ID进来则取默认自营店铺
		if($shopId==0){
			$areaId2 = $this->getDefaultCity();
			$shopId = $mshops->checkSelfShopId($areaId2);
		}
		$shops = $mshops->getShopInfo($shopId);
		$shops["serviceEndTime"] = str_replace('.5',':30',$shops["serviceEndTime"]);
		$shops["serviceEndTime"] = str_replace('.0',':00',$shops["serviceEndTime"]);
		$shops["serviceStartTime"] = str_replace('.5',':30',$shops["serviceStartTime"]);
		$shops["serviceStartTime"] = str_replace('.0',':00',$shops["serviceStartTime"]);
		$this->assign('shops',$shops);

		if(!empty($shops)){		
			$this->assign('shopId',$shopId);
			$this->assign('ct1',(int)I("ct1"));
			$this->assign('ct2',(int)I("ct2"));
			$this->assign('msort',(int)I("msort"));
			$this->assign('sj',I("sj",0));
			$this->assign('sprice',I("sprice"));//上架开始时间
			$this->assign('eprice',I("eprice"));//上架结束时间
			$this->assign('goodsName',urldecode(I("goodsName")));//上架结束时间
					
			$mshopscates = D('Home/ShopsCats');
			$shopscates = $mshopscates->getShopCateList($shopId);
			$this->assign('shopscates',$shopscates);
			
			$mgoods = D('Home/Goods');
			$shopsgoods = $mgoods->getShopsGoods($shopId);
			$this->assign('shopsgoods',$shopsgoods);
			//获取评分
			$obj = array();
			$obj["shopId"] = $shopId;
			$shopScores = $mshops->getShopScores($obj);
			$this->assign("shopScores",$shopScores);
			
			$m = D('Home/Favorites');
			$this->assign("favoriteShopId",$m->checkFavorite($shopId,1));
		}
        $this->display("default/shop_home");
	}
	/**
     * 跳到店铺街
     */
	public function toShopStreet(){
		$areas= D('Home/Areas');
		$areaId2 = $this->getDefaultCity();
   		$areaList = $areas->getDistricts($areaId2);
   		$mshops = D('Home/Shops');
   		$obj = array();
   		if((int)cookie("bstreesAreaId3")){
   			$obj["areaId3"] = (int)cookie("bstreesAreaId3");
   		}else{
   			$obj["areaId3"] = ((int)I('areaId3')>0)?(int)I('areaId3'):$areaList[0]['areaId'];
   			cookie("bstreesAreaId3",$obj["areaId3"]);
   		}
   		//广告
   		$ads = D('Home/Ads');
   		$ads = $ads->getAds($areaId2,-3);
   		$this->assign('areaId3',$obj["areaId3"]);
   		$this->assign('keyWords',I("keyWords"));
   		$this->assign('ads',$ads);
   		$this->assign('areaList',$areaList);
        $this->display("default/shop_street");
	}
	
	/**
     * 获取县区内的商铺
     */
	public function getDistrictsShops(){
   		$mshops = D('Home/Shops');
   		$obj["areaId3"] = (int)I("areaId3");
   		$obj["shopName"] = I("shopName");
   		$obj["deliveryStartMoney"] = I("deliveryStartMoney");
   		$obj["deliveryMoney"] = I("deliveryMoney");
   		$obj["shopAtive"] = I("shopAtive");
   		cookie("bstreesAreaId3",$obj["areaId3"]);
   		
   		$dsplist = $mshops->getDistrictsShops($obj);
   		$this->ajaxReturn($dsplist);
	}
	
	/**
     * 获取社区内的商铺
     */
	public function getShopByCommunitys(){
		
   		$mshops = D('Home/Shops');
   		$obj["communityId"] = (int)I("communityId");
   		$obj["areaId3"] = (int)I("areaId3");
   		$obj["shopName"] = I("shopName");
   		$obj["deliveryStartMoney"] = I("deliveryStartMoney");
   		$obj["deliveryMoney"] = I("deliveryMoney");
   		$obj["shopAtive"] = (int)I("shopAtive",-1);
   		$ctplist = $mshops->getShopByCommunitys($obj);
   		$pages = $rslist["pages"];

   		$this->assign('ctplist',$pages);
       	$this->ajaxReturn($ctplist);
       	
	}
	
    /**
     * 跳到商家登录页面
     */
	public function login(){
		$USER = session('WST_USER');
		if(!empty($USER) && $USER['userType']>=1){
			$this->redirect("Shops/index");
		}else{
            $this->display("default/shop_login");
		}
	}
	
	/**
	 * 商家登录验证
	 */
	public function checkLogin(){
		$rs = array('status'=>-2);
	    $rs["status"]= 1;
		if(!$this->checkVerify("4") && ($GLOBALS['CONFIG']["captcha_model"]["valueRange"]!="" && strpos($GLOBALS['CONFIG']["captcha_model"]["valueRange"],"3")>=0)){			
			$rs["status"]= -2;//验证码错误
		}else{
			$m = D('Home/Shops');
	   		$rs = $m->login();
	   		if($rs['status']==1){
	    		session('WST_USER',$rs['shop']);
	    		unset($rs['shop']);
	    	}
		}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 退出
	 */
	public function logout(){
		session('WST_USER',null);
		session("WST_CART",null);
		echo "1";
	}
	/**
	 * 跳到商家中心页面
	 */
	public function index(){
		$this->isShopLogin();
		$spm = D('Home/Shops');
		$data['shop'] = $spm->loadShopInfo(session('WST_USER.userId'));
		$obj["shopId"] = $data['shop']['shopId'];
		$details = $spm->getShopDetails($obj);
		$data['details'] = $details;
		
		$this->assign('shopInfo',$data);
		
		$this->display("default/shops/index");
	}
	/**
	 * 编辑商家资料
	 */
	public function toEdit(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		//获取银行列表
		$m = D('Admin/Banks');
		$this->assign('bankList',$m->queryByList(0));
		//获取商品信息
		$m = D('Home/Shops');
		$this->assign('object',$m->get((int)$USER['shopId']));
		$this->assign("umark","toEdit");
		$this->display("default/shops/edit_shop");
	}
	
	/**
	 * 设置商家资料
	 */
	public function toShopCfg(){
		$this->isShopLogin();
        $USER = session('WST_USER');
		//获取商品信息
		$m = D('Home/Shops');
		$this->assign('object',$m->getShopCfg((int)$USER['shopId']));
		$this->assign("umark","setShop");
		$this->display("default/shops/cfg_shop");
	}
	/**
	 * 查询店铺名称是否存在
	 */
	public function checkShopName(){
		$m = D('Home/Shops');
		$rs = $m->checkShopName(I('shopName'),(int)I('id'));
		echo json_encode($rs);
	}
	/**
	 * 新增/修改操作
	 */
	public function editShopCfg(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		$m = D('Home/Shops');
    	$rs = array('status'=>-1);
    	if($USER['shopId']>0){
    		$rs = $m->editShopCfg((int)$USER['shopId']);
    	}
    	$this->ajaxReturn($rs);
	}
	
   /**
	* 新增/修改操作
	*/
	public function edit(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		$m = D('Home/Shops');
    	$rs = array('status'=>-1);
    	if($USER['shopId']>0){
    		$rs = $m->edit((int)$USER['shopId']);
    	}
    	$this->ajaxReturn($rs);
	}
	
   /**
    * 跳到修改用户密码
    */
	public function toEditPass(){
		$this->isShopLogin();
		$this->assign("umark","toEditPass");
        $this->display("default/shops/edit_pass");
	}
	
	/**
	 * 申请开店
	 */
	public function toOpenShopByUser(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		if(!empty($USER) && $USER['userType']==0){
			//获取用户申请状态
			$m = D('Home/Shops');
			$shopStatus = $m->checkOpenShopStatus((int)$USER['userId']);
			if(empty($shopStatus)){
				//获取商品分类信息
				$m = D('Home/GoodsCats');
				$this->assign('goodsCatsList',$m->queryByList());
				//获取地区信息
				$m = D('Home/Areas');
				$this->assign('areaList',$m->getProvinceList());
				//获取所在城市信息
		        $cityId = $this->getDefaultCity();
		        $area = $m->getArea($cityId);
		        $this->assign('area',$area);
				//获取银行列表
				$m = D('Home/Banks');
				$this->assign('bankList',$m->queryByList(0));
				$object = $m->getModel();
				$this->assign('object',$object);
				$this->display("default/users/open_shop");
			}else{
				if($shopStatus[0]==1){
					$shops = $m->loadShopInfo((int)$USER['userId']);
					$USER = array_merge($USER,$shops);
					session('WST_USER',$USER);
					$this->assign('msg','您的申请已通过，请刷新页面后点击右上角的"卖家中心"进入店铺界面.');
					$this->display("default/users/user_msg");
				}else{
					$this->assign('msg','您的申请正在审核中...');
					$this->display("default/users/user_msg");
				}
			}
		}else{
			$this->redirect("Shops/index");
		}
	}
	
	/**
	 * 会员提交开店申请
	 */
	public function openShopByUser(){
		$this->isUserAjaxLogin();
		$rs = array('status'=>-1);
		if($GLOBALS['CONFIG']['phoneVerfy']==1){
			$verify = session('VerifyCode_userPhone');
			$startTime = (int)session('VerifyCode_userPhone_Time');
			$mobileCode = I("mobileCode");
			if((time()-$startTime)>120){
				 $rs['msg'] = '验证码已失效!';
			}
			if($mobileCode=="" || $verify != $mobileCode){
				$rs['msg'] = '验证码错误!';
			}
    	}else{
	    	if(!$this->checkVerify("1")){			
				$rs['msg'] = '验证码错误!';
			}
    	}
    	if($rs['msg']==''){
			$USER = session('WST_USER');
			$m = D('Home/Shops');
	    	$userId = (int)$USER['userId'];
		 	//如果用户没注册则先建立账号
			if($userId>0){
		   	    $rs = $m->addByUser($userId);
		    	if($rs['status']>0)$USER['shopStatus'] = 0;
			}
    	}
    	$this->ajaxReturn($rs);
	}
	
	
	/**
	 * 游客跳到开店申请
	 */
    public function toOpenShop(){
    	//获取商品分类信息
		$m = D('Home/GoodsCats');
		$this->assign('goodsCatsList',$m->queryByList());
		//获取省份信息
		$m = D('Home/Areas');
		$this->assign('areaList',$m->getProvinceList());
		//获取所在城市信息
		$cityId = $this->getDefaultCity();
		$area = $m->getArea($cityId);
		$this->assign('area',$area);
		//获取银行列表
		$m = D('Home/Banks');
		$this->assign('bankList',$m->queryByList(0));
		$object = $m->getModel();
		$this->assign('object',$object);
		$this->display("default/open_shop");

	}
	
    /**
	 * 游客提交开店申请
	 */
	public function openShop(){
		$m = D('Home/Shops');
    	$rs = array('status'=>-1);
    	if($GLOBALS['CONFIG']['phoneVerfy']==1){
	    	$verify = session('VerifyCode_userPhone');
			$startTime = (int)session('VerifyCode_userPhone_Time');
			$mobileCode = I("mobileCode");
			if((time()-$startTime)>120){
			    $rs['msg'] = '验证码已失效!';
		    }
			if($mobileCode=="" || $verify != $mobileCode){
				$rs['msg'] = '验证码错误!';
			}
    	}else{
	    	if(!$this->checkVerify("1")){			
				$rs['msg'] = '验证码错误!';
			}
    	}
    	if($rs['msg']==''){
			$rs = $m->addByVisitor();
			$m = D('Home/Users');
			$user = $m->get($rs['userId']);
			if(!empty($user))session('WST_USER',$user);
    	}
    	$this->ajaxReturn($rs);
	}

	/**
	 * 获取店铺搜索提示列表
	 */
	public function getKeyList(){
		$m = D('Home/Shops');
		$areaId2 = $this->getDefaultCity();
		$rs = $m->getKeyList($areaId2);
		$this->ajaxReturn($rs);
	}
	
	
}