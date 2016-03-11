<?php
return array(
	//'配置项'=>'配置值'
	define('WEB_HOST', WSTDomain()),
	/*微信支付配置*/
	'WxPayConf'=>array(
		'NOTIFY_URL' =>  WEB_HOST.'/Wstapi/payment/notify_weixin.php',
		'CURL_TIMEOUT' => 30
	)
);