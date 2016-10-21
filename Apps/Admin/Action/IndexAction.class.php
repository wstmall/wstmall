<?php
namespace Admin\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 首页（默认）控制器
 */
class IndexAction extends BaseAction {
	/**
	 * 跳到商城首页
	 */
    public function index(){
    	$this->isLogin();
        $this->display("/index");
    }
    /**
     * 跳去后台主页面
     */
    public function toMain(){
    	$this->isLogin();
        $m = D('Index');
        $weekInfo = $m->getWeekInfo();//一周动态
        $this->assign('weekInfo',$weekInfo);
        $sumInfo = $m->getSumInfo();//一周动态
        $this->assign('sumInfo',$sumInfo);
    	$this->display("/main");
    }
    /**
     * 跳去商城配置界面
     */
    public function toMallConfig(){
    	$this->isLogin();
    	$this->checkPrivelege('scxx_00');
    	$m = D('Admin/Index');
    	$this->assign('configs',$m->loadConfigsForParent());
    	//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		$areaId2 = intval($GLOBALS['CONFIG']['defaultCity'])>0?$GLOBALS['CONFIG']['defaultCity']:(int)C('DEFAULT_CITY');
		if($areaId2>0){
			$area = $m->get($areaId2);
			$this->assign('areaId1',$area['parentId']);
		}
    	$this->display("/mall_config");
    }
    /**
     * 保存商城配置信息
     */
    public function saveMallConfig(){
    	$this->isLogin();
    	$this->checkPrivelege('scxx_02');
    	$m = D('Admin/Index');
    	$rs = $m->saveConfigsForCode();
    	$this->ajaxReturn($rs);
    }
    /**
     * 跳去登录页面
     */
    public function toLogin(){
		//触发定时任务
		D('Admin/CronJobs')->autoComplate();
    	$this->display("/login");
    }
    /**
     * 职员登录
     */
    public function login(){
    	$m = D('Admin/Staffs');
    	if($this->checkVerify()){
	    	$rs = $m->login();
	    	if($rs['status']==1){
	    		session('WST_STAFF',$rs['staff']);
	    		unset($rs['staff']);
	    	}
    	}else{
    		$rs["status"]= -2;//验证码错误
    	}
    	$this->ajaxReturn($rs);
    }
    /**
     * 离开系统
     */
    public function logout(){
    	session('WST_STAFF',null);
    	$this->redirect("Index/toLogin");
    }
    /**
     * 获取定时任务
     */
    public function getTask(){
    	$this->isLogin();
    	//获取待审核商品
    	$m = D('Admin/Goods');
    	$grs = $m->queryPenddingGoodsNum();
    	//获取待审核店铺
    	$m = D('Admin/Shops');
    	$srs = $m->queryPenddingShopsNum();
    	$rd = array('status'=>1);
    	$rd['goodsNum'] = $grs['num'];
    	$rd['shopsNum'] = $srs['num'];
    	$this->ajaxReturn($rd);
    }
    
    /**
     * 获取当前版本
     */
    public function getWSTMallVersion(){
    	$this->isLogin();
    	$version = C('WST_VERSION');
    	$key = C('WST_MD5');
    	$license = $GLOBALS['CONFIG']['mallLicense'];
    	$content = file_get_contents(C('WST_WEB').'/index.php?m=Api&c=Download&a=getLastVersion&version='.$version.'&version_md5='.$key."&license=".$license."&host=".WSTDomain());
    	$json = json_decode($content,true);
        if($json['version'] ==  $version){
    		$json['version'] = "same";
        }
		$this->ajaxReturn($json);
    }
    
    /**
     * 输入授权码
     */
    public function enterLicense(){
    	$this->isLogin();
    	$this->display("/enter_license");
    }
    /**
     * 验证授权码
     */
    public function verifyLicense(){
    	$this->isLogin();
    	$license = I('license');
    	$content = file_get_contents(C('WST_WEB').'/index.php?m=Api&c=License&a=verifyLicense&host='.WSTRootDomain().'&license='.$license);
    	$json = json_decode($content,true);
    	$rs = array('status'=>1);
    	if($json['status']==1){
    		$rs = D('Admin/Index')->saveLicense();
    	}
    	$rs['license'] = $json;
		$this->ajaxReturn($rs);
    }
    /**
     * 清除缓存
     */
    public function cleanAllCache(){
    	$this->isLogin();
        $rv = array('status'=>-1);
		$rv['status'] = WSTDelDir(C('WST_RUNTIME_PATH'));
    	$this->ajaxReturn($rv);
    }
}