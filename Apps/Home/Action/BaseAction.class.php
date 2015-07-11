<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 基础控制器
 */
use Think\Controller;
class BaseAction extends Controller {
	public function __construct(){
		parent::__construct();
		//初始化系统信息
		$m = D('Home/System');
		$GLOBALS['CONFIG'] = $m->loadConfigs();
		$this->assign("WST_USER",session('WST_USER'));
		$areas= D('Home/Areas');
   		$areaList = $areas->getCityListByProvince();
		$areaId2 = $this->getDefaultCity();
		$currArea = $areas->getArea($areaId2);
		$this->assign('currArea',$currArea);
   		$this->assign('searchType',I("searchType",1));
   		
   		$this->assign('currCity',$areaList[$areaId2]);
   		$this->assign('areaId2',$areaId2);
   		$this->assign('template_path',$template_path);
   		$this->assign('CONF',$GLOBALS['CONFIG']);
		$this->footer(); //加入底部
	}
	
	/**
	 * 
	 */
	public function getBaseInfo(){
		$areaId2 = $this->getDefaultCity();
		//获取分类
		$gcm = D('Home/GoodsCats');
		$catList = $gcm->getGoodsCats($areaId2);
		$this->assign('catList',$catList);
		
		//获取自营商店
		$spm = D('Home/Shops');
		$selfShop = $spm->getSelfShop($areaId2);
		$this->assign('selfShop',$selfShop);
		
		//获取购物车
		$m = D('Home/Cart');
		$cartInfo = $m->getCartInfo();
		$this->assign('cartcnt',count($cartInfo["cartgoods"]));
	}
	
	/**
	 * 空操作处理
	 */
    public function _empty($name){
        $this->assign('msg',"你的思想太飘忽，系统完全跟不上....");
        $this->display('default/sys_msg');
    }
	
    /**
     * 只要不是会员都跳到登录页面让他登录
     */
	public function isUserLogin($ref="") {
		$USER = session('WST_USER');
		if (empty($USER) || ($USER['userType']!=0 && $USER['userType']<1)){
			$this->redirect("Users/login");
		}
	}
	/**
     * ajax程序验证,只要不是会员都返回-999
     */
    public function isUserAjaxLogin() {
    	$USER = session('WST_USER');
		if (empty($USER) || ($USER['userType']!=0 || $USER['userType']<1)){
			if(!empty($_COOKIE['loginName']) && !empty($_COOKIE['loginPwd'])){ //自动登录(已保存loginName，loginPwd)
				$m = D('Home/User');
				$user = $m->getUserInfo($_COOKIE['loginName'],$_COOKIE['loginPwd']);
				if(empty($user)){
					session('WST_USER',$user);
				}else{
					die("{status:-999}");
				}
			}
		}
	}
	/**
	 * 商家登录验证
	 */
	public function isShopLogin(){
		$USER = session('WST_USER');
	    if (empty($USER) || $USER['userType']<1)$this->redirect("Shops/login");
	}
	/**
	 * 商家ajax登录验证
	 */
	public function isShopAjaxLogin(){
		$USER = session('WST_USER');
		if (empty($USER) || $USER['userType']<1){
			die("{status:-999,url:'Shops/login'}");
		}
	}
	/**
	 * 用户登录验证-主要用来判断会员和商家共同功能的部分
	 */
	public function isLogin($userType = 'User'){
		$USER = session('WST_USER');
		if (empty($USER)){
		    if($userType=='Shop'){
		    	$this->redirect("Shops/login");
		    }else{
		    	$this->redirect("Users/login");
		    }
		}
   }
   /**
	* 用户ajax登录验证
	*/
   public function isAjaxLogin($userType = 'User'){
   	   $USER = session('WST_USER');
	   if (empty($USER)){
			if($userType=='Shop'){
				die("{status:-999,url:'Shops/login'}");
			}else{
				die("{status:-999,url:'Users/login'}");
			}
	   }
   }
   /**
    * 检查登录状态
    */
   public function checkLoginStatus(){
   	   $USER = session('WST_USER');
	   if (empty($USER)){
	   	    die("{status:-999}");
	   }else{
	   		die("{status:1}");
	   }
   }
   /**
	 * 验证模块的码校验
	 */
	public function checkVerify($type){
		if(stripos($GLOBALS['CONFIG']['captcha_model']["valueRange"],$type) !==false) {
			$verify = new \Think\Verify();
			return $verify->check(I('verify'));
		}else{
			return true;
		}
		return false;
	}
	
    /**
     * 核对单独的验证码
	 * $re = false 的时候不是ajax返回
	 * @param  boolean $re [description]
	 * @return [type]      [description]
	 */
	public function checkCodeVerify($re = true){
		$code = I('code');
		$verify = new \Think\Verify(array('reset'=>false));    
		$rs =  $verify->check($code);		
		if ($re == false) return $rs;
		else $this->ajaxReturn(array('status'=>(int)$rs));
	}
    /**
	 * 单个上传图片
	 */
    public function uploadPic(){
	   $config = array(
		        'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
		        'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
		        'rootPath'      =>  './Upload/', //保存根路径
		        'driver'        =>  'LOCAL', // 文件上传驱动
		        'subName'       =>  array('date', 'Y-m'),
		        'savePath'      =>  I('dir','uploads')."/"
		);
		$upload = new \Think\Upload($config);
		$rs = $upload->upload($_FILES);
		if(!$rs){
			$this->error($upload->getErrorMsg());
		}else{
			$images = new \Think\Image();
			$images->open('./Upload/'.$rs['Filedata']['savepath'].$rs['Filedata']['savename']);
			$newsavename = str_replace('.','_thumb.',$rs['Filedata']['savename']);
			$vv = $images->thumb(I('width',100), I('height',100))->save('./Upload/'.$rs['Filedata']['savepath'].$newsavename);
	        $rs['Filedata']['savepath'] = "Upload/".$rs['Filedata']['savepath'];
			$rs['Filedata']['savethumbname'] = $newsavename;
			$rs['status'] = 1;
			echo json_encode($rs);
		}	
    }
	
	/**
	 * 产生验证码图片
	 * 
	 */
	public function getVerify(){
		// 导入Image类库
    	$Verify = new \Think\Verify();
    	$Verify->entry();
    }
   /**
	 * 页尾参数初始化
	 */
	public function footer(){
		$m = D('Home/Friendlinks');
		$friendLikds = $m->getFriendLinks();
		$this->assign('friendLikds',$friendLikds);
		$m = D('Home/Articles');
		$helps = $m->getHelps();
		$this->view->assign("helps",$helps);
	}
	/**
	 * 设置所在城市
	 */
	public function setDefaultCity($cityId){
		setcookie("areaId2", $cityId, time()+3600*24*90);
	}
	/**
	 * 定位所在城市
	 */
	public function getDefaultCity(){
		$areas= D('Home/Areas');
		return $areas->getDefaultCity();
	}
}