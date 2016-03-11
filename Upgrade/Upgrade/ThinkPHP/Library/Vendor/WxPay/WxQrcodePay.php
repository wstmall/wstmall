<?php

/**
 * 扫码支付接口类
 */

include_once ("WxPayBase.php");


class WxQrcodePay extends WxPayBase {
	public $parameters; // 请求参数，类型为关联数组
	public $response; // 微信返回的响应
	public $result; // 返回参数，类型为关联数组
	public $url; // 接口链接
	public $curl_timeout; // curl超时时间
	public $data; // 接收到的数据，类型为关联数组
	public $returnParameters; // 返回参数，类型为关联数组
	
	function __construct() {
		// 设置接口链接
		$this->url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
		// 设置curl超时时间
		$this->curl_timeout = WxPayConf::$CURL_TIMEOUT;
	}
	
	/**
	 * 作用：设置请求参数
	 */
	function setParameter($parameter, $parameterValue) {
		$this->parameters [$this->trimString ( $parameter )] = $this->trimString ( $parameterValue );
	}
	
	/**
	 * 作用：设置标配的请求参数，生成签名，生成接口参数xml
	 */
	function getXml() {
		$this->parameters ["appid"] = WxPayConf::$APPID; // 公众账号ID
		$this->parameters ["mch_id"] = WxPayConf::$MCHID; // 商户号
		$this->parameters ["nonce_str"] = $this->createNoncestr (); // 随机字符串
		$this->parameters ["sign"] = $this->getSign ( $this->parameters ); // 签名
	
		return $this->arrayToXml ( $this->parameters );
	}
	
	/**
	 * 作用：post请求xml
	 */
	function postXml() {
		$xml = $this->getXml ();
		
		$this->response = $this->postXmlCurl ( $xml, $this->url, $this->curl_timeout );
		
		return $this->response;
	}
	
	/**
	 * 作用：使用证书post请求xml
	 */
	function postXmlSSL() {
		$xml = $this->getXml ();
		$this->response = $this->postXmlSSLCurl ( $xml, $this->url, $this->curl_timeout );
		return $this->response;
	}
	
	/**
	 * 作用：获取结果，默认不使用证书
	 */
	function getResult() {
		
		$this->postXml ();
		
		$this->result = $this->xmlToArray ( $this->response );
		return $this->result;
	}
	
	/**
	 * 将微信的请求xml转换成关联数组，以方便数据处理
	 */
	function saveData($xml) {
		$this->data = $this->xmlToArray ( $xml );
	}
	
	/**
	 * 检测微信签名
	 * @return boolean
	 */
	function checkSign() {
		$tmpData = $this->data;
		unset ( $tmpData ['sign'] );
		$sign = $this->getSign ( $tmpData ); // 本地签名
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

?>
