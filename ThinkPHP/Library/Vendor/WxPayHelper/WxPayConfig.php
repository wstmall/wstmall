<?php

/**
 * 	配置账号信息
 */

class WxPayConf {
	
	
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
	// =======【基本信息设置】=====================================
	public function __construct($wxpayconfig = array()) {
		
		self::$APPID = $wxpayconfig['appid'];
		self::$APPSECRET = $wxpayconfig['appsecret'];
		self::$MCHID = $wxpayconfig['mchid'];
		self::$KEY = $wxpayconfig['key'];
		self::$JS_API_CALL_URL = $wxpayconfig['js_api_call_url'];
		self::$CURL_TIMEOUT = $wxpayconfig['curl_timeout'];
		self::$SSLCERT_PATH = $wxpayconfig['sslcert_path'];
		self::$SSLKEY_PATH = $wxpayconfig['sslkey_path'];
		self::$NOTIFY_URL = $wxpayconfig['notifyurl'];
		self::$RETURN_URL = $wxpayconfig['returnurl'];
		
	}

}

?>