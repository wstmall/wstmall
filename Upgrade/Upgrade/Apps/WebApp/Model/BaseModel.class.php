<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 基础类
 */
use Think\Model;
class BaseModel extends Model {
    /**
     * 用来处理内容中为空的判断
     */
	public function checkEmpty($data,$isDie = false){
	    foreach ($data as $key=>$v){
			if(trim($v)==''){
				if($isDie)die("{status:-1,'key'=>'$key'}");
				return false;
			}
		}
		return true;
	}
	
	/**
	 * 输入sql调试信息
	 */
	public function logSql($m){
		echo $m->getLastSql();
	}
	
	
	/**
	 * 获取一行记录
	 */
	public function queryRow($sql){
		$plist = $this->query($sql);
		return $plist[0];
	}

	/**
	  * 获取登录用户的id
	*/
	public function getUserId(){
	    $USER = session('WST_USER');
	    if(empty($USER)){
	      $tokenId = I('tokenId');
	      if($tokenId=='')return array();
	      return M('app_session')->where("tokenId='".$tokenId."'")->getField('userId');
	    }else{
	      return $USER['userId'];
	    }
	    return array();
	}
	
	
};
?>