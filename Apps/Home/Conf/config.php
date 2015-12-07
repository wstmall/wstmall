<?php
return array(
	//'配置项'=>'配置值'
	define('WEB_HOST', WSTDomain()),
	/*微信支付配置*/
	'WxPayConf_pub'=>array(
		'JS_API_CALL_URL' => WEB_HOST.'/index.php/Home/WxJsAPI/jsApiCall',
		'SSLCERT_PATH' => WEB_HOST.'/ThinkPHP/Library/Vendor/WxPayPubHelper/cacert/apiclient_cert.pem',
		'SSLKEY_PATH' => WEB_HOST.'/ThinkPHP/Library/Vendor/WxPayPubHelper/cacert/apiclient_key.pem',
		'NOTIFY_URL' =>  WEB_HOST.'/index.php/Home/WxNative2/notify',
		'CURL_TIMEOUT' => 30
	)
);