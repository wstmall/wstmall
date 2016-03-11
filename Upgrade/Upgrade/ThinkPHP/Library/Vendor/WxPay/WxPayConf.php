<?php

/**
 * 	配置账号信息
 */

class WxPayConf {
	static public $APPID;
	static public $APPSECRET;
	static public $MCHID;
	static public $KEY;
	static public $CURL_TIMEOUT;
	static public $NOTIFY_URL;
	static public $RETURN_URL;
	
	public function __construct($wxpayconfig = array()) {
		
		self::$APPID = $wxpayconfig['appid'];
		self::$APPSECRET = $wxpayconfig['appsecret'];
		self::$MCHID = $wxpayconfig['mchid'];
		self::$KEY = $wxpayconfig['key'];
		self::$CURL_TIMEOUT = $wxpayconfig['CURL_TIMEOUT'];
		self::$NOTIFY_URL = $wxpayconfig['notifyurl'];
		self::$RETURN_URL = $wxpayconfig['returnurl'];
		
	}
}

?>