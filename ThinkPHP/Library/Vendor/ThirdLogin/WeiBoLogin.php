<?php
/**
 * QQ登录类
 */
class WeiBoLogin {
	
	public $appId;
    public $appKey;
    public $callbackUrl;
    public $code;
    public $state;
    public $evnName;
    public $tokenId;
    
    public function __construct($appId,$appKey,$callbackUrl,$evnName = 'WSTMall'){
        //接收从qq登陆页返回来的值
        $this->code = isset($_REQUEST['code'])? $_REQUEST['code'] : '';
        $this->state = isset($_REQUEST['state'])? $_REQUEST['state'] : '';
        //将参数赋值给成员属性
        $this->appId = $appId;
        $this->appKey = $appKey;
        $this->callbackUrl = $callbackUrl;
        
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
	        $url = "https://api.weibo.com/oauth2/access_token?grant_type=authorization_code&client_id=".$this->appId."&client_secret=".$this->appKey."&code=".$this->code."&redirect_uri=".urlencode($this->callbackUrl);
	        $str = $this->reqestUrl($url);//访问url获得返回值
	        parse_str($str,$arr);
	        if($arr['access_token']!=''){
	        	$this->tokenId = $arr['access_token'];
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
    public function getClientId($accessToken){
        $url = 'https://api.weibo.com/oauth2/get_token_info?access_token='.$accessToken;
        $str = $this->reqestUrl($url);//访问url获得返回值
        return $this->changeCallbackUrl($str);//返回经过json转码后的数组
    }
    /**
     * 获取用户信息
     * @param $clientId
     * @param $accessToken
     * @param $openId
     * @return array 用户的信息数组
     * */
    public function getUserInfo($clientId,$openId,$accessToken){
    	$url = "https://api.weibo.com/2/users/show.json";
    	$param = array(
    			"access_token"      =>    $token,
    			"uid"               =>    $openid
    	);
    	
    	$response = get($url, $param);
    	if($response == false) {
    		return false;
    	}
    	
    	$arr = json_decode($response, true);
    	return $arr;
    	
        $url = 'https://graph.qq.com/user/get_user_info?oauth_consumer_key='.$clientId.'&access_token='.$accessToken.'&openid='.$openId.'&format=json';
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
     * 将字符串转换为可以进行json_decode的格式
     * 将转换后的参数值赋值给成员属性$this->clientId,$this->openId
     * @param $str 返回的callbackUrl字符串 
     * @return 数组
     * */
    protected function changeCallbackUrl($str){
        if (strpos($str, "callback") !== false){
            //将字符串修改为可以json解码的格式
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $json  = substr($str, $lpos + 1, $rpos - $lpos -1);
            //转化json
            $result = json_decode($json,true);
            $this->clientId = $result['client_id'];
            $this->openId = $result['openid'];
            return $result;
        }else{
            return false;
        }
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
