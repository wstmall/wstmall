<?php 
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 微信接口类
 */
class WSTWechat{
	public $appId;
	public $secret;
	private $tokenId;
	private $jsapi_ticket;
	private $error;
	private $evnName;
	
	/**
	 * 初始微信配置信息
	 */
    public function __construct($appId, $secret,$evnName = 'WSTMall') {
        $this->appId = $appId;
        $this->secret = $secret;
        $this->evnName = $evnName;
        $this->initEnv();
        $this->getToken();
    }
    /**
     * http访问
     * @param $url 访问网址
     */
	private function http($url,$data = null){
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    if($data){
	    	curl_setopt($curl,CURLOPT_POST,1);
	    	curl_setopt($curl,CURLOPT_POSTFIELDS,$data);//如果要处理的数据，请在处理后再传进来 ，例如http_build_query这里不要加
	    }
	    $res = curl_exec($curl);
	    if(!$res){
	    	$error = curl_errno($ch);
	    	echo $error;
	    }
	    curl_close($curl);
	    return $res;
	}
	
	/**
	 * 获取访问令牌
	 */
	public function getToken(){
		//没有过期则继续用，过期了就重新获取一次
    	if($this->getEvn('token_expire')<time()){
	    	$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appId.'&secret='.$this->secret;
		    $data = $this->http($url);
		    $data = json_decode($data, true);
		    if($data['access_token']!=''){
		    	$this->tokenId = $data['access_token'];
		    	$this->setEnv('token_expire', time()+7000);
		    	return $this->tokenId;
		    }else{
		        $this->error = $data;
		    }
		    return false;
    	}
    	return $this->tokenId;
	}
	
	/**
	 * 获取用户信息
	 */
	public function getUserInfo($code){
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appId.'&secret='.$this->secret.'&code='.$code.'&grant_type=authorization_code';
		$data = $this->http($url);
		return json_decode($data, true);
	}
	
	/**
	 * 发送模板消息
	 */
	public function sendTemplateMessage($data){
		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$this->getToken();
		return $this->http($url,$data);
		//return json_decode($rdata, true);
	}
	/*******************************************************************
	 * 
	 *                      JS SDK相关接口
	 * 
	 ******************************************************************/
	/**
	 * 获取随机字符加数值
	 * @param len 需要返回的字符串长度
	 */
	public function getRadomStr($len = 16){
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    $str = "";
	    for ($i = 0; $i < $len; $i++) {
	       $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	    }
	    return $str;
	}
	/**
	 * 
	 */
	/**
	 * 获取jsapi_ticket
	 */
	public function getJsApiTicket(){
		$tokenId = $this->getToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$tokenId.'&type=jsapi';
		$data = $this->http($url);
		return json_decode($data, true);
	}
	/**
	 * 获取签名
	 * @param url 调用的网址
	 * @return array('status'=>-1/1)
	 */
	public function getJsSignature($url){
		//如果jsapi_ticket过期的话就重新获取，否则就继续用原来的
		if($this->getEvn('jsapi_ticket_expire')<time()){
			$tokenId = $this->getToken();
			$ticket = $this->getJsApiTicket();
			if($ticket['errcode']==0){
				$this->jsapi_ticket = $ticket['ticket'];
				$this->setEnv('jsapi_ticket_expire',time()+7000);
				$data = array();
				$data['status'] = 1;
				$data['noncestr'] = $this->getRadomStr();
				$data['timestamp'] = time();
				$data['jsapi_ticket'] = $ticket['ticket'];
			    $data['signature'] = sha1('jsapi_ticket='.$ticket['ticket'].'&noncestr='.$data['noncestr'].'&timestamp='.$data['timestamp'].'&url='.$url);
			    //echo 'jsapi_ticket='.$ticket['ticket'].'&noncestr='.$data['noncestr'].'&timestamp='.$data['timestamp'].'&url='.$url;
			    return $data;
			}else{
				$this->error = $ticket;
			}
			return array('status'=>-1,'errcode'=>$ticket['errcode'],'errmsg'=>$ticket['errmsg']);
		}
		return $this->jsapi_ticket;
	}
	
    /**
     * 记录出错日志
     * @return array
     */
    public function getError(){
    	return $this->error;
    }
    
    /**
     * 初始化全局参数
     */
    private function initEnv(){
    	if(empty($GLOBALS[$this->evnName])){
    		$GLOBALS[$this->evnName]['token_expire'] = 0;
    		$GLOBALS[$this->evnName]['jsapi_ticket_expire'] = 0;
    	}
    }
    /**
     * 保存全局参数
     */
    private function setEnv($name,$time){
    	$GLOBALS[$this->evnName][$name] = $time;
    }
    /**
     * 获取全局参数
     */
    private function getEvn($name){
    	return $GLOBALS[$this->evnName][$name];
    }
	
}