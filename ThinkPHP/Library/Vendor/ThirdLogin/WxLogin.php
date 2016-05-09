<?php
/**
 * QQ登录类
 */
class WxLogin {
	
	public $appId;
    public $appKey;
    public $code;
    public $state;
    public $evnName;
    public $tokenId;
    public $openId;
    
    public function __construct($appId,$appKey,$evnName = 'WSTMall'){
        //接收从qq登陆页返回来的值
        $this->code = isset($_REQUEST['code'])? $_REQUEST['code'] : '';
        $this->state = isset($_REQUEST['state'])? $_REQUEST['state'] : '';
        //将参数赋值给成员属性
        $this->appId = $appId;
        $this->appKey = $appKey;
        
        $this->evnName = $evnName;
        $this->initEnv();
        $this->getToken();
    }
    /**
     * 获取access_token值
     * @return array 返回包含access_token,过期时间的数组
     * */
    public function getToken(){
    	if($this->getEvn('expires_in')<time()){
    		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appId."&secret=".$this->appKey."&code=".$this->code."&grant_type=authorization_code";
	        $str = $this->reqestUrl($url);//访问url获得返回值
	        $arr = json_decode($str,true);
	        if($arr['access_token']!=''){
	        	$this->tokenId = $arr['access_token'];
	        	$this->openId = $arr['openid'];
	        	$this->setEnv('expires_in', time()+7000);
	        	return $this->tokenId;
	        }
	        return false;
    	}
        return $this->tokenId;
    }
    /**
     * 获取client_id 和 openid
     * @param $accessToken access_token验证码
     * @return array 返回包含client_id 和 openid的数组
     * */
    public function getOpenId(){
    	
        return $this->openId;//返回经过json转码后的数组
    }
    /**
     * 获取用户信息
     * @param $clientId
     * @param $accessToken
     * @param $openId
     * @return array 用户的信息数组
     * */
    public function getUserInfo($openId,$accessToken){
    	$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$accessToken.'&openid='.$openId;
        //$url = 'https://api.weixin.qq.com//sns/userinfo?oauth_consumer_key='.$clientId.'&access_token='.$accessToken.'&openid='.$openId.'&format=json';
        $str = $this->reqestUrl($url);
        $arr = json_decode($str,true);
        return $arr;
    }
    /**
     * 请求URL地址，得到返回字符串
     * @param $url qq提供的api接口地址
     * */
    public function reqestUrl($url){
        static $cache = 0;
        //判断是否之前已经做过验证
        if($cache === 1){
            $str = $this->curl($url);
        }elseif($cache === 2){
            $str = $this->openSSL($url);
        }else{
            //是否可以使用cURL
            if(function_exists('curl_init')){
                $str = $this->curl($url);
                $cache = 1;
                //是否可以使用openSSL
            }elseif(function_exists('openssl_open') && ini_get("allow_fopen_url")=="1"){
                $str = $this->openSSL($url);
                $cache = 2;
            }else{
                die('请开启php配置中的php_curl或php_openssl');
            }
        }
        return $str;
    }

    /**
     * 通过curl取得页面返回值
     * 需要打开配置中的php_curl
     * */
    private function curl($url){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);//允许请求的内容以文件流的形式返回
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//禁用https
        curl_setopt($ch,CURLOPT_URL,$url);//设置请求的url地址
        $str = curl_exec($ch);//执行发送
        curl_close($ch);
        return $str;
    }
    /**
     * 通过file_get_contents取得页面返回值
     * 需要打开配置中的allow_fopen_url和php_openssl
     * */
    private function openSSL($url){
        $str = file_get_contents($url);//取得页面内容
        return $str;
    }
	
    /**
     * 初始化全局参数
     */
    private function initEnv(){
    	if(empty($GLOBALS[$this->evnName])){
    		$GLOBALS[$this->evnName]['expires_in'] = 0;
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

?>
