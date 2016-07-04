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
use Think\Controller;
class BaseAction extends Controller {
  public function __construct(){
		parent::__construct();
      //初始化系统信息
      $m = D('WebApp/System');
      $GLOBALS['CONFIG'] = $m->loadConfigs();
      $this->assign('CONF',$GLOBALS['CONFIG']);
      $this->assign('WST_V', C('WST_VERSION'));
      WSTAutoByCookie();
      $this->assign("WST_USER", session('WST_USER'));

      if( session('areaId2') && session('areaName2') != '' ){//显示session里的城市
          $this->assign('wstLatitude', session('wstLatitude'));
          $this->assign('wstLongitude', session('wstLongitude'));
          $this->assign('locationFrom', 'session');
      }else{//显示默认城市，并将其保存到session
          $defaultCity = $this->getDefaultCity();
          session('defaultAreaId', $defaultCity['areaId2']);
          session('defaultAreaName', $defaultCity['areaName2']);
          session('areaId2', $defaultCity['areaId2']);
          session('areaName2', $defaultCity['areaName2']);
          $this->assign('locationFrom', 'defaultCity');
      }
  }

    /**
     * 是否已登录
     */
    public function isLogin() {
      if( !IS_AJAX ){
        session('originalUrl', WSTGetPageUrl());//记录来源URL
      }
      $USER = session('WST_USER');
      if (empty($USER) || ($USER['userId']=='')){
        if(IS_AJAX){
          die("{status:-999}");
        }else{
          $this->redirect("Users/index");
        }
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
   * 产生验证码图片
   * 
   */
  public function getVerify(){
    // 导入Image类库
      $Verify = new \Think\Verify();
      $Verify->entry();
   }
   
  /**
   * 定位所在城市
   */
  public function getDefaultCity(){
    $areas= D('WebApp/Areas');
    return $areas->getDefaultCity();
  }

  /**
   * 上传图片
   */
    public function uploadImage(){
      $this->isLogin();
      $rs = array('status'=>-1);
      $base64Image = I('imgData');//图片的base64值
      $saveRootPath = I('saveRootPath','Upload/');//保存的根路径
      $imgPath = I('saveModulePath','uploads').'/'.I('saveSubPath', date('Y-m'));//保存目录，默认uploads
      $exts = array('jpg','png','gif','jpeg'); //允许的后缀
      $nameRule = time().rand(1111,9999);//命名

      WSTCreateDir(WSTRootPath()."/".$saveRootPath.$imgPath."/");
      
      if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64Image, $result)){
        $ext = $result[2];//图片后缀
        if( in_array($ext, $exts) ){
          $newFile = $saveRootPath.$imgPath.'/'.$nameRule.'.'.$ext;//保存的名称
          if (file_put_contents($newFile, base64_decode(str_replace($result[1], '', $base64Image)))){
            if(file_exists($newFile)){
              //生成缩略图
              $images = new \Think\Image();
            $images->open($newFile);
            $newsavename = str_replace('.','_thumb.', $nameRule.'.'.$ext);//缩略图名称
            $vv = $images->thumb(I('width',200), I('height',200))->save($saveRootPath.$imgPath.'/'.$newsavename);
              if(C('WST_M_IMG_SUFFIX')!=''){
                  $msuffix = C('WST_M_IMG_SUFFIX');
                  $mnewsavename = str_replace('.',$msuffix.'.', $nameRule.'.'.$ext);
                  $mnewsavename_thmb = str_replace('.',"_thumb".$msuffix.'.', $nameRule.'.'.$ext);
                $images->open($newFile);
                $images->thumb(I('width',600), I('height',600))->save($saveRootPath.$imgPath.'/'.$mnewsavename);
                $images->thumb(I('width',200), I('height',200))->save($saveRootPath.$imgPath.'/'.$mnewsavename_thmb);
                $rs['filepath'] = $saveRootPath.$imgPath.'/'.$mnewsavename;
                $rs['filethumbpath'] = $saveRootPath.$imgPath.'/'.$mnewsavename_thmb;
            }else{
              $rs['filepath'] = $newFile;
              $rs['filethumbpath'] = $saveRootPath.$imgPath.'/'.$newsavename;
            }
              $rs['status'] = 1;
              $rs['msg'] = '图片保存成功';
            }else{
              $rs['status'] = -2;
              $rs['msg'] = '图片保存失败';
            }
          }else{
            $rs['status'] = -2;
            $rs['msg'] = '图片保存失败';
          }
        }else{
          $rs['status'] = -3;
          $rs['msg'] = '图片后缀应为jpg、jpeg、png或gif';
        }
      }else{
          $rs['status'] = -4;
          $rs['msg'] = '图片数据格式错误';
      }
      $this->ajaxReturn($rs);
    }
    
  /**
   * 空操作处理
   */
  public function _empty(){
    $this->redirect("Index/index");
  }
}