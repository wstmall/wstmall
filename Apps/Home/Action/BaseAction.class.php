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
		$this->assign("baseUser",$_SESSION['USER']);
		$areas= D('Home/Areas');
   		$areaList = $areas->getCitys();
   		$areaId2 = $this->getDefaultCity();
   		$currArea = $areas->getArea($areaId2);
   		
        $this->assign('template_path',$template_path);
   		//获取分类
        $gcm = D('Home/GoodsCats');
   		$catList = $gcm->getGoodsCats($areaId2);
   		$spm = D('Home/Shops');
   		$selfShop = $spm->getSelfShop($areaId2);
   		$this->assign('selfShop',$selfShop);
   		$m = D('Home/Cart');
   		$cartInfo = $m->getCartInfo();
   		$this->assign('cartcnt',count($cartInfo["cartgoods"]));
   		$this->assign('searchType',I("searchType",1));
   		$this->assign('catList',$catList);
   		$this->assign('currCity',$areaList[$areaId2]);
   		$this->assign('cityList',$areaList);
   		$this->assign('areaId2',$areaId2);
   		$this->assign('currArea',$currArea);
   		$this->assign('CONF',$GLOBALS['CONFIG']);
		$this->header(); //加入头部
		$this->footer(); //加入底部
	}
	
    /**
     * 只要不是会员都跳到登录页面让他登录
     */
	public function isUserLogin($ref="") {
		if (empty($_SESSION['USER']) || ($_SESSION['USER']['userType']!=0 && $_SESSION['USER']['userType']<1)){
			$this->redirect("Users/login");
		}
	}
	/**
     * ajax程序验证,只要不是会员都返回-999
     */
    public function isUserAjaxLogin() {
		if (empty($_SESSION['USER']) || ($_SESSION['USER']['userType']!=0 || $_SESSION['USER']['userType']<1)){
			if(!empty($_COOKIE['loginName']) && !empty($_COOKIE['loginPwd'])){ //自动登录(已保存loginName，loginPwd)
				$m = D('Home/User');
				$user = $m->getUserInfo($_COOKIE['loginName'],$_COOKIE['loginPwd']);
				if(empty($user)){
					$_SESSION['USER'] = $user;
					
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
	    if (empty($_SESSION['USER']) || $_SESSION['USER']['userType']<1)$this->redirect("Shops/login");
	}
	/**
	 * 商家ajax登录验证
	 */
	public function isShopAjaxLogin(){
		if (empty($_SESSION['USER']) || $_SESSION['USER']['userType']<1){
			die("{status:-999,url:'Shops/login'}");
		}
	}
	/**
	 * 用户登录验证-主要用来判断会员和商家共同功能的部分
	 */
	public function isLogin($userType = 'User'){
		if (empty($_SESSION['USER'])){
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
		if (empty($_SESSION['USER'])){
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
	   	if (empty($_SESSION['USER'])){
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
		        'exts'          =>  array('jpg','png','gif','jpge'), //允许上传的文件后缀
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
	 * 页头参数初始化
	 */
	public function header(){
		
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
		$areaId2 = (int)$_SESSION['areaId2'];
		//检验城市有效性
		if($areaId2>0){
			$m = D('Home/Areas');
			$sql ="SELECT areaId FROM __PREFIX__areas WHERE isShow=1 AND areaFlag = 1 AND areaType=1 AND areaId=".$areaId2;
		    $rs = $m->query($sql);
		    if($rs[0]['areaId']=='')$areaId2 = 0;
		}else{
			$areaId2 = (int)$_COOKIE['areaId2'];
		}
		//定位城市
		if($areaId2==0){
			//IP定位
			$Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
			$area = $Ip->getlocation(get_client_ip()); 
			if($area['area']!=""){
				$m = D('Home/Areas');
			    $sql ="SELECT areaId FROM __PREFIX__areas WHERE isShow=1 AND areaFlag = 1 AND areaType=1 AND areaName like '$cityName'";
			    $rs = $m->query($sql);
			    if($rs[0]["areaId"]>0){
					$areaId2 = $rs[0]["areaId"];
			    }else{
					$areaId2 = C(DEFAULT_CITY);
			    }
			}else{
			    $areaId2 = C(DEFAULT_CITY);
			}
		}
		setcookie("areaId2", $areaId2, time()+3600*24*90);
		return $areaId2;
		
	}
}