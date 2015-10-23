<?php

/**
 * 	配置账号信息
 */

class WxPayConf_pub {
	
	
	static public $APPID;
	static public $APPSECRET;
	static public $MCHID;
	static public $KEY;
	static public $JS_API_CALL_URL;
	static public $CURL_TIMEOUT;
	static public $SSLCERT_PATH;
	static public $SSLKEY_PATH;
	static public $NOTIFY_URL;
	static public $RETURN_URL;
	
	public function __construct($wxpayconfig = array()) {
		
		self::$APPID = $wxpayconfig['appid'];
		self::$APPSECRET = $wxpayconfig['appsecret'];
		self::$MCHID = $wxpayconfig['mchid'];
		self::$KEY = $wxpayconfig['key'];
		self::$JS_API_CALL_URL = $wxpayconfig['js_api_call_url'];
		self::$CURL_TIMEOUT = $wxpayconfig['CURL_TIMEOUT'];
		self::$SSLCERT_PATH = $wxpayconfig['SSLCERT_PATH'];
		self::$SSLKEY_PATH = $wxpayconfig['SSLKEY_PATH'];
		self::$NOTIFY_URL = $wxpayconfig['notifyurl'];
		self::$RETURN_URL = $wxpayconfig['returnurl'];
		
	}
	
	// =======【基本信息设置】=====================================
	// 微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	/*const APPID = 'wx03a4b3dacd66550f';
	// 受理商ID，身份标识
	const MCHID = '1267499001'; // 测试
	// 商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = 'hnshjwlkjyxgshaoran123wgy456lzj7';
	// JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = '7033137f9f2edfd1bd65ffd1ae9d50fa';
	
	// =======【JSAPI路径设置】===================================
	// 获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL = '';
	
	// =======【证书路径设置】=====================================
	// 证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = '';
	const SSLKEY_PATH = '';
	const SSLCA_PATH = '';
	
	// =======【异步通知url设置】===================================
	// 异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = 'http://local.tpwxpay.com/index.php/Home/WxNative/notify';
	
	// =======【curl超时设置】===================================
	// 本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;*/
}

?>