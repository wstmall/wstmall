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
use Think\Controller;
class ShopsAction extends BaseAction {
	/**
     * 跳到商家首页面
     */
	public function toShopHome(){
		$mshops = D('Home/Shops');
		$shops = $mshops->getShopInfo();
		$this->assign('shops',$shops);

		if(!empty($shops)){		
			$this->assign('shopId',I("shopId",0));
			$this->assign('ct1',I("ct1",0));
			$this->assign('ct2',I("ct2",0));
			$this->assign('msort',I("msort",0));
			$this->assign('sj',I("sj",0));
			$this->assign('sprice',I("sprice"));//上架开始时间
			$this->assign('eprice',I("eprice"));//上架结束时间
			$this->assign('goodsName',I("goodsName"));//上架结束时间
					
			$mshopscates = D('Home/ShopsCats');
			$shopscates = $mshopscates->getShopCateList();
			$this->assign('shopscates',$shopscates);
			
			$mgoods = D('Home/Goods');
			$shopsgoods = $mgoods->getShopsGoods();
			$this->assign('shopsgoods',$shopsgoods);
			//获取评分
			$obj["shopId"] = $shopId;
			$shopScores = $mshops->getShopScores($obj);
			$this->assign("shopScores",$shopScores);
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
   		$obj["areaId3"] = ((int)I('areaId3')>0)?(int)I('areaId3'):$areaList[0]['areaId'];
   		$dsplist = $mshops->getDistrictsShops($obj);
   		//广告
   		$ads = D('Home/Ads');
   		$ads = $ads->getAds($areaId2,-3);
   		$this->assign('keyWords',I("keyWords"));
   		$this->assign('ads',$ads);
   		$this->assign('nvg_mk',"shopstreet");
   		$this->assign('dsplist',$dsplist);
   		$this->assign('areaList',$areaList);
        $this->display("default/shop_street");
	}
	
	/**
     * 获取县区内的商铺
     */
	public function getDistrictsShops(){
		$areas= D('Home/Areas');
		$common= D('Home/Common');
	
   		$areaList = $areas->getCitys();
   		$mshops = D('Home/Shops');
   		$obj["areaId3"] = I("areaId3");
   		$obj["shopName"] = I("shopName");
   		$obj["deliveryStartMoney"] = I("deliveryStartMoney");
   		$obj["deliveryMoney"] = I("deliveryMoney");
   		$obj["shopAtive"] = I("shopAtive");
   		
   		$dsplist = $mshops->getDistrictsShops($obj);
   		$this->ajaxReturn($dsplist);
	}
	
	/**
     * 获取社区内的商铺
     */
	public function getShopByCommunitys(){
		
   		$mshops = D('Home/Shops');
   		$obj["communityId"] = I("communityId");
   		$ctplist = $mshops->getShopByCommunitys($obj);
   		$this->assign('ctplist',$ctplist);
       	$this->ajaxReturn($ctplist);
       	
	}
	
    /**
     * 跳到商家登录页面
     */
	public function login(){
		if(!empty($_SESSION['USER']) && $_SESSION['USER']['userType']>=1){
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
	    		$_SESSION['USER'] = $rs['shop'];
	    		unset($rs['shop']);
	    	}
		}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 退出
	 */
	public function logout(){
		unset($_SESSION['userName']);
		unset($_SESSION['USER']);
		unset($_SESSION['userId']);
		unset($_SESSION['mycart']);
		echo "1";
	}
	/**
	 * 跳到商家中心页面
	 */
	public function index(){
		$this->isShopLogin();
		$data['shop'] = $_SESSION['USER'];
        $_SESSION['USER']['loginTarget'] = 'Shop';
		$spm = D('Home/Shops');
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
		//获取银行列表
		$m = D('Admin/Banks');
		$this->assign('bankList',$m->queryByList(0));
		//获取商品信息
		$m = D('Home/Shops');
		$this->assign('object',$m->get((int)$_SESSION['USER']['shopId']));
		$this->assign("umark","toEdit");
		$this->display("default/shops/edit_shop");
	}
	
	/**
	 * 设置商家资料
	 */
	public function toShopCfg(){
		$this->isShopLogin();

		//获取商品信息
		$m = D('Home/Shops');
		$this->assign('object',$m->getShopCfg((int)$_SESSION['USER']['shopId']));
		$this->assign("umark","setShop");
		$this->display("default/shops/cfg_shop");
	}
	
	/**
	 * 新增/修改操作
	 */
	public function editShopCfg(){
		
		$this->isShopLogin();
		$m = D('Home/Shops');
    	$rs = array('status'=>-1);
    	if($_SESSION['USER']['shopId']>0){
    		$rs = $m->editShopCfg((int)$_SESSION['USER']['shopId']);
    	}
    	$this->ajaxReturn($rs);
	}
	
   /**
	* 新增/修改操作
	*/
	public function edit(){
		$this->isShopLogin();
		$m = D('Home/Shops');
    	$rs = array('status'=>-1);
    	if($_SESSION['USER']['shopId']>0){
    		$rs = $m->edit((int)$_SESSION['USER']['shopId']);
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
		if(!empty($_SESSION['USER']) && $_SESSION['USER']['userType']==0){
			//获取用户申请状态
			$m = D('Home/Shops');
			$shopStatus = $m->checkOpenShopStatus((int)$_SESSION['USER']['userId']);
			if(empty($shopStatus)){
				//获取商品分类信息
				$m = D('Home/GoodsCats');
				$this->assign('goodsCatsList',$m->queryByList());
				//获取品牌信息
				$m = D('Home/Brands');
				$this->assign('brandList',$m->queryByList());
				//获取地区信息
				$m = D('Home/Areas');
				$this->assign('areaList',$m->queryByList(0));
				//获取银行列表
				$m = D('Home/Banks');
				$this->assign('bankList',$m->queryByList(0));
				$object = $m->getModel();
				$this->assign('object',$object);
				$this->display("default/users/open_shop");
			}else{
				$this->assign('msg','您的申请正在审核中...');
				$this->display("default/users/user_msg");
			}
		}
	}
	
	/**
	 * 会员提交开店申请
	 */
	public function openShopByUser(){
		$this->isUserAjaxLogin();
		$m = D('Home/Shops');
    	$userId = (int)$_SESSION['USER']['userId'];
    	$rs = array('status'=>-1);
    	if(!$this->checkVerify("1")){			
			$rs['status'] = -4;
		}else{
		 	//如果用户没注册则先建立账号
		 	if($userId>0){
	    	    $rs = $m->addByUser($userId);
	    	    if($rs['status']>0)$_SESSION['USER']['shopStatus'] = 0;
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
		//获取地区信息
		$m = D('Home/Areas');
		$this->assign('areaList',$m->queryByList(0));
		//获取所在城市信息
		$cityId = $this->getDefaultCity();
		$area = $m->getArea($cityId);
		$this->assign('area',$area);
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
    	if(!$this->checkVerify("1")){			
			$rs['status'] = -4;
		}else{
	 		$rs = $m->addByVisitor();
	 	}
    	$this->ajaxReturn($rs);
	}

	
	
	
}