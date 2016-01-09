<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 短信服务类
 */
class LogSmsModel extends BaseModel {
	/**
	 * 插入并发送短讯记录
	 */
	public function sendSMS($smsSrc,$phoneNumber,$content,$smsFunc,$verfyCode){
	$USER = session('WST_USER');
		$userId = empty($USER)?0:$USER['userId'];
		$m = M('log_sms');
		$ip = get_client_ip();
	    //检测短信验证码验证是否正确
	    if($GLOBALS['CONFIG']['smsVerfy']==1){
	    	$smsverfy = I('smsVerfy');
	    	$verify = new \Think\Verify(array('reset'=>false));    
		    $rs =  $verify->check($smsverfy);
			if(!$rs){
				return array('status'=>-29999,'msg'=>'验证码不正确!');
			}
		}
		//检测是否超过每日短信发送数
		$date = date('Y-m-d');
		$sql = 'select count(smsId) counts,max(createTime) createTime from __PREFIX__log_sms
		          where smsPhoneNumber='.$phoneNumber.' and createTime>"'.$date.' 00:00:00" and createTime<="'.$date.' 23:59:59"';
		$smsRs = $this->queryRow($sql);
		if($smsRs['counts']>(int)$GLOBALS['CONFIG']['smsLimit']){
			return array('status'=>-20000,'msg'=>'请勿频繁发送短信验证!');
		}
		if($smsRs['createTime'] !='' && ((time()-strtotime($smsRs['createTime']))<120)){
			return array('status'=>-20001,'msg'=>'请勿频繁发送短信验证!');
		}
		//检测IP是否超过发短信次数
	    $sql = 'select count(smsId) counts,max(createTime) createTime from __PREFIX__log_sms
		          where smsIP="'.$ip.'" and createTime>"'.$date.' 00:00:00" and createTime<="'.$date.' 23:59:59"';
		$ipRs = $this->queryRow($sql);
		if($ipRs['counts']>(int)$GLOBALS['CONFIG']['smsLimit']){
			return array('status'=>-20003,'msg'=>'请勿频繁发送短信验证!');
		}
		if($ipRs['createTime']!='' && ((time()-strtotime($ipRs['createTime']))<120)){
			return array('status'=>-20004,'msg'=>'请勿频繁发送短信验证!');
		}
		
		$code = WSTSendSMS($phoneNumber,$content);
	    $data = array();
		$data['smsSrc'] = $smsSrc;
		$data['smsUserId'] = $userId;
		$data['smsPhoneNumber'] = $phoneNumber;
		$data['smsContent'] = $content;
		$data['smsReturnCode'] = $code;
		$data['smsCode'] = $verfyCode;
		$data['smsIP'] = $ip;
		$data['smsFunc'] = $smsFunc;
		$data['createTime'] = date('Y-m-d H:i:s');
		$m->add($data);
		if(intval($code)>0){
			return array('status'=>1,'msg'=>'短信发送成功!');
		}else{
			return array('status'=>-1,'msg'=>'短信发送失败!');
		}
	}
}