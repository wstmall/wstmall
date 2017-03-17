<?php
/**
 * 微信支付
 */

include_once ("SDKRuntimeException.php");
include_once ("WxPayConfig.php");

/**
 * 所有接口的基类
 */

class CommonUtil {
	function __construct() {
	}
	function trimString($value) {
		$ret = null;
		if (null != $value) {
			$ret = $value;
			if (strlen ( $ret ) == 0) {
				$ret = null;
			}
		}
		return $ret;
	}
	
	/**
	 * 产生随机字符串，不长于32位
	 */
	public function createNoncestr($length = 32) {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$str = "";
		for($i = 0; $i < $length; $i ++) {
			$str .= substr ( $chars, mt_rand ( 0, strlen ( $chars ) - 1 ), 1 );
		}
		return $str;
	}
	
	/**
	 * 格式化参数，签名过程需要使用
	 */
	function formatBizQueryParaMap($paraMap, $urlencode) {
		$buff = "";
		ksort ( $paraMap );
		foreach ( $paraMap as $k => $v ) {
			if ($urlencode) {
				$v = urlencode ( $v );
			}
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen ( $buff ) > 0) {
			$reqPar = substr ( $buff, 0, strlen ( $buff ) - 1 );
		}
		return $reqPar;
	}
	
	/**
	 * 生成签名
	 */
	public function getSign($Obj) {
		foreach ( $Obj as $k => $v ) {
			$Parameters [$k] = $v;
		}
		// 签名步骤一：按字典序排序参数
		ksort ( $Parameters );
		$String = $this->formatBizQueryParaMap ( $Parameters, false );
		// 签名步骤二：在string后加入KEY
		$String = $String . "&key=" . WxPayConf::$KEY;
		// 签名步骤三：MD5加密
		$String = md5 ( $String );
		// 签名步骤四：所有字符转为大写
		$result_ = strtoupper ( $String );
		return $result_;
	}
	
	/**
	 * array转xml
	 */
	function arrayToXml($arr) {
		$xml = "<xml>";
		foreach ( $arr as $key => $val ) {
			if (is_numeric ( $val )) {
				$xml .= "<" . $key . ">" . $val . "</" . $key . ">";
			} else
				$xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
		}
		$xml .= "</xml>";
		return $xml;
	}
	
	/**
	 * 将xml转为array
	 */
	public function xmlToArray($xml) {
		// 将XML转为array
		libxml_disable_entity_loader(true);
		libxml_use_internal_errors();
		$array_data = json_decode ( json_encode ( simplexml_load_string ( $xml, 'SimpleXMLElement', LIBXML_NOCDATA ) ), true );
		return $array_data;
	}
	
	/**
	 * 以post方式提交xml到对应的接口url
	 */
	public function postXmlCurl($xml, $url, $second = 30) {
		// 初始化curl
		$ch = curl_init ();
		// 设置超时
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $second );
		// 这里设置代理，如果有的话
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
		// 设置header
		curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
		// 要求结果为字符串且输出到屏幕上
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		// post提交方式
		curl_setopt ( $ch, CURLOPT_POST, TRUE );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $xml );
		// 运行curl
		$data = curl_exec ( $ch );
		curl_close ( $ch );
		// 返回结果
		if ($data) {
			curl_close ( $ch );
			return $data;
		} else {
			$error = curl_errno ( $ch );
			echo "curl出错，错误码:$error" . "<br>";
			echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
			curl_close ( $ch );
			return false;
		}
	}
	
	/**
	 * 使用证书，以post方式提交xml到对应的接口url
	 */
	function postXmlSSLCurl($xml, $url, $second = 30) {
		$ch = curl_init ();
		// 超时时间
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $second );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
		// 设置header
		curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
		// 要求结果为字符串且输出到屏幕上
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		// 设置证书

		curl_setopt ( $ch, CURLOPT_SSLCERT, WxPayConf::$SSLCERT_PATH );
		curl_setopt ( $ch, CURLOPT_SSLKEY, WxPayConf::$SSLKEY_PATH );
		curl_setopt ( $ch, CURLOPT_CAINFO, WxPayConf::$SSLCA_PATH ); // CA根证书（用来验证的网站证书是否是CA颁布）
		                                                             
		// post提交方式
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $xml );
		$data = curl_exec ( $ch );
		// 返回结果
		if ($data) {
			//curl_close ( $ch );
			return $data;
		} else {
			$error = curl_errno ( $ch );
			echo "curl出错，错误码:$error" . "<br>";
			echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
			curl_close ( $ch );
			return false;
		}
	}
	
	/**
	 * 打印数组
	 */
	function printErr($wording = '', $err = '') {
		print_r ( '<pre>' );
		echo $wording . "</br>";
		var_dump ( $err );
		print_r ( '</pre>' );
	}
}

/**
 * 请求型接口的基类
 */
class WxpayClient extends CommonUtil {
	var $parameters; // 请求参数，类型为关联数组
	public $response; // 微信返回的响应
	public $result; // 返回参数，类型为关联数组
	var $url; // 接口链接
	var $curl_timeout; // curl超时时间
	
	/**
	 * 设置请求参数
	 */
	function setParameter($parameter, $parameterValue) {
		$this->parameters [$this->trimString ( $parameter )] = $this->trimString ( $parameterValue );
	}
	
	/**
	 * 设置标配的请求参数，生成签名，生成接口参数xml
	 */
	function createXml() {
		$this->parameters ["appid"] = WxPayConf::$APPID; // 公众账号ID
		$this->parameters ["mch_id"] = WxPayConf::$MCHID; // 商户号
		$this->parameters ["nonce_str"] = $this->createNoncestr (); // 随机字符串
		$this->parameters ["sign"] = $this->getSign ( $this->parameters ); // 签名
		return $this->arrayToXml ( $this->parameters );
	}
	
	/**
	 * post请求xml
	 */
	function postXml() {
		$xml = $this->createXml ();
		$this->response = $this->postXmlCurl ( $xml, $this->url, $this->curl_timeout );
		return $this->response;
	}
	
	/**
	 * 使用证书post请求xml
	 */
	function postXmlSSL() {
		$xml = $this->createXml ();
		$this->response = $this->postXmlSSLCurl ( $xml, $this->url, $this->curl_timeout );
		return $this->response;
	}
	
	/**
	 * 获取结果，默认不使用证书
	 */
	function getResult() {
		$this->postXml ();
		$this->result = $this->xmlToArray ( $this->response );
		return $this->result;
	}
}

/**
 * 统一支付接口类
 */
class UnifiedOrder extends WxpayClient {
	function __construct() {
		// 设置接口链接
		$this->url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
		// 设置curl超时时间
		$this->curl_timeout = WxPayConf::$CURL_TIMEOUT;
	}
	
	/**
	 * 生成接口参数xml
	 */
	function createXml() {
		try {
			// 检测必填参数
			if ($this->parameters ["out_trade_no"] == null) {
				throw new SDKRuntimeException ( "缺少统一支付接口必填参数out_trade_no！" . "<br>" );
			} elseif ($this->parameters ["body"] == null) {
				throw new SDKRuntimeException ( "缺少统一支付接口必填参数body！" . "<br>" );
			} elseif ($this->parameters ["total_fee"] == null) {
				throw new SDKRuntimeException ( "缺少统一支付接口必填参数total_fee！" . "<br>" );
			} elseif ($this->parameters ["notify_url"] == null) {
				throw new SDKRuntimeException ( "缺少统一支付接口必填参数notify_url！" . "<br>" );
			} elseif ($this->parameters ["trade_type"] == null) {
				throw new SDKRuntimeException ( "缺少统一支付接口必填参数trade_type！" . "<br>" );
			} elseif ($this->parameters ["trade_type"] == "JSAPI" && $this->parameters ["openid"] == NULL) {
				throw new SDKRuntimeException ( "统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！" . "<br>" );
			}
			$this->parameters ["appid"] = WxPayConf::$APPID; // 公众账号ID
			$this->parameters ["mch_id"] = WxPayConf::$MCHID; // 商户号
			$this->parameters ["spbill_create_ip"] = $_SERVER ['REMOTE_ADDR']; // 终端ip
			$this->parameters ["nonce_str"] = $this->createNoncestr (); // 随机字符串
			$this->parameters ["sign"] = $this->getSign ( $this->parameters ); // 签名
			return $this->arrayToXml ( $this->parameters );
		} catch ( SDKRuntimeException $e ) {
			die ( $e->errorMessage () );
		}
	}
	

	/**
	 * 设置jsapi的参数
	 */
	public function getParameters($obj) {
		$appObj ["appid"] = WxPayConf::$APPID;
		$appObj ["partnerid"] = WxPayConf::$MCHID; // 商户号
		$appObj ["prepayid"] = $obj["prepayid"];
		$appObj ["package"] = "Sign=WXPay";
		$appObj ["noncestr"] = $this->createNoncestr ();
		$timeStamp = time ();
		$appObj ["timestamp"] =  (string)$timeStamp;
		$appObj ["sign"] = $this->getSign ( $appObj );
		return $appObj;
	}
	
	/**
	 * 获取prepay_id
	 */
	function getPrepayId() {
		$this->postXml ();
		$this->result = $this->xmlToArray ( $this->response );
		
		$prepay_id = $this->result ["prepay_id"];
		return $prepay_id;
	}
}

/**
 * 订单查询接口
 */
class OrderQuery extends WxpayClient {
	function __construct() {
		// 设置接口链接
		$this->url = "https://api.mch.weixin.qq.com/pay/orderquery";
		// 设置curl超时时间
		$this->curl_timeout = WxPayConf::$CURL_TIMEOUT;
	}
	
	/**
	 * 生成接口参数xml
	 */
	function createXml() {
		try {
			// 检测必填参数
			if ($this->parameters ["out_trade_no"] == null && $this->parameters ["transaction_id"] == null) {
				throw new SDKRuntimeException ( "订单查询接口中，out_trade_no、transaction_id至少填一个！" . "<br>" );
			}
			$this->parameters ["appid"] = WxPayConf::$APPID; // 公众账号ID
			$this->parameters ["mch_id"] = WxPayConf::$MCHID; // 商户号
			$this->parameters ["nonce_str"] = $this->createNoncestr (); // 随机字符串
			$this->parameters ["sign"] = $this->getSign ( $this->parameters ); // 签名
			return $this->arrayToXml ( $this->parameters );
		} catch ( SDKRuntimeException $e ) {
			die ( $e->errorMessage () );
		}
	}
}




/**
 * 响应型接口基类
 */
class WxpayServer extends CommonUtil {
	public $data; // 接收到的数据，类型为关联数组
	var $returnParameters; // 返回参数，类型为关联数组
	
	/**
	 * 将微信的请求xml转换成关联数组，以方便数据处理
	 */
	function saveData($xml) {
		$this->data = $this->xmlToArray ( $xml );
		print_r($this->data); 
	}
	function checkSign() {
		$tmpData = $this->data;
		unset ( $tmpData ['sign'] );
		print_r($tmpData);
		$sign = $this->getSign ( $tmpData ); // 本地签名
		echo $sign;
		if ($this->data ['sign'] == $sign) {
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * 获取微信的请求数据
	 */
	function getData() {
		return $this->data;
	}
	
	/**
	 * 设置返回微信的xml数据
	 */
	function setReturnParameter($parameter, $parameterValue) {
		$this->returnParameters [$this->trimString ( $parameter )] = $this->trimString ( $parameterValue );
	}
	
	/**
	 * 生成接口参数xml
	 */
	function createXml() {
		return $this->arrayToXml ( $this->returnParameters );
	}
	
	/**
	 * 将xml数据返回微信
	 */
	function returnXml() {
		$returnXml = $this->createXml ();
		return $returnXml;
	}
}

/**
 * 通用通知接口
 */
class Notify extends WxpayServer {
}


/**
 * 请求商家获取商品信息接口
 */
class NativeCall extends WxpayServer {
	/**
	 * 生成接口参数xml
	 */
	function createXml() {
		if ($this->returnParameters ["return_code"] == "SUCCESS") {
			$this->returnParameters ["appid"] = WxPayConf::$APPID; // 公众账号ID
			$this->returnParameters ["mch_id"] = WxPayConf::$MCHID; // 商户号
			$this->returnParameters ["nonce_str"] = $this->createNoncestr (); // 随机字符串
			$this->returnParameters ["sign"] = $this->getSign ( $this->returnParameters ); // 签名
		}
		return $this->arrayToXml ( $this->returnParameters );
	}
	
	/**
	 * 获取product_id
	 */
	function getProductId() {
		$product_id = $this->data ["product_id"];
		return $product_id;
	}
}

/**
 * 静态链接二维码
 */
class NativeLink extends CommonUtil {
	var $parameters; // 静态链接参数
	var $url; // 静态链接
	function __construct() {
	}
	
	/**
	 * 设置参数
	 */
	function setParameter($parameter, $parameterValue) {
		$this->parameters [$this->trimString ( $parameter )] = $this->trimString ( $parameterValue );
	}
	
	/**
	 * 生成Native支付链接二维码
	 */
	function createLink() {
		try {
			if ($this->parameters ["product_id"] == null) {
				throw new SDKRuntimeException ( "缺少Native支付二维码链接必填参数product_id！" . "<br>" );
			}
			$this->parameters ["appid"] = WxPayConf::$APPID; // 公众账号ID
			$this->parameters ["mch_id"] = WxPayConf::$MCHID; // 商户号
			$time_stamp = time ();
			$this->parameters ["time_stamp"] = "$time_stamp"; // 时间戳
			$this->parameters ["nonce_str"] = $this->createNoncestr (); // 随机字符串
			$this->parameters ["sign"] = $this->getSign ( $this->parameters ); // 签名
			$bizString = $this->formatBizQueryParaMap ( $this->parameters, false );
			$this->url = "weixin://wxpay/bizpayurl?" . $bizString;
		} catch ( SDKRuntimeException $e ) {
			die ( $e->errorMessage () );
		}
	}
	
	/**
	 * 返回链接
	 */
	function getUrl() {
		$this->createLink ();
		return $this->url;
	}
}

/**
 * JSAPI支付——H5网页端调起支付接口
 */
class JsApi extends CommonUtil {
	var $code; // code码，用以获取openid
	var $openid; // 用户的openid
	var $parameters; // jsapi参数，格式为json
	var $prepay_id; // 使用统一支付接口得到的预支付id
	var $curl_timeout; // curl超时时间
	function __construct() {
		// 设置curl超时时间
		$this->curl_timeout = WxPayConf::$CURL_TIMEOUT;
	}
	
	/**
	 * 生成可以获得code的url
	 */
	function createOauthUrlForCode($redirectUrl) {
		$urlObj ["appid"] = WxPayConf::$APPID;
		$urlObj ["redirect_uri"] = "$redirectUrl";
		$urlObj ["response_type"] = "code";
		$urlObj ["scope"] = "snsapi_base";
		$urlObj ["state"] = "STATE" . "#wechat_redirect";
		$bizString = $this->formatBizQueryParaMap ( $urlObj, false );
		return "https://open.weixin.qq.com/connect/oauth2/authorize?" . $bizString;
	}
	
	/**
	 * 生成可以获得openid的url
	 */
	function createOauthUrlForOpenid() {
		$urlObj ["appid"] = WxPayConf::$APPID;
		$urlObj ["secret"] = WxPayConf::$APPSECRET;
		$urlObj ["code"] = $this->code;
		$urlObj ["grant_type"] = "authorization_code";
		$bizString = $this->formatBizQueryParaMap ( $urlObj, false );
		return "https://api.weixin.qq.com/sns/oauth2/access_token?" . $bizString;
	}
	
	/**
	 * 通过curl向微信提交code，以获取openid
	 */
	function getOpenid() {
		$url = $this->createOauthUrlForOpenid ();
		// 初始化curl
		$ch = curl_init ();
		// 设置超时
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $this->curl_timeout );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
		curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		// 运行curl，结果以jason形式返回
		$res = curl_exec ( $ch );
		curl_close ( $ch );
		// 取出openid
		$data = json_decode ( $res, true );
		$this->openid = $data ['openid'];
		return $this->openid;
	}
	
	/**
	 * 设置prepay_id
	 */
	function setPrepayId($prepayId) {
		$this->prepay_id = $prepayId;
	}
	
	/**
	 * 设置code
	 */
	function setCode($code_) {
		$this->code = $code_;
	}
	
	/**
	 * 设置jsapi的参数
	 */
	public function getParameters() {
		$jsApiObj ["appId"] = WxPayConf::$APPID;
		$timeStamp = time ();
		$jsApiObj ["timeStamp"] =  (string)$timeStamp;
		//$jsApiObj ["timeStamp"] = "$timeStamp";
		$jsApiObj ["nonceStr"] = $this->createNoncestr ();
		$jsApiObj ["package"] = "prepay_id=$this->prepay_id";
		$jsApiObj ["signType"] = "MD5";
		$jsApiObj ["paySign"] = $this->getSign ( $jsApiObj );
		$this->parameters = json_encode ( $jsApiObj );
		
		return $this->parameters;
	}
}

?>
