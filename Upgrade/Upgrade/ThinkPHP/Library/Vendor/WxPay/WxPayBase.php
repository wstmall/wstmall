<?php
include_once ("WxException.php");
/**
 * 所有接口的基类
 */
class WxPayBase {
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
	 * 作用：产生随机字符串，不长于32位
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
	 * 作用：格式化参数，签名过程需要使用
	 */
	function formatBizQueryParaMap($paraMap, $urlencode) {
		$buff = "";
		ksort ( $paraMap );
		foreach ( $paraMap as $k => $v ) {
			if ($urlencode) {
				$v = urlencode ( $v );
			}
			// $buff .= strtolower($k) . "=" . $v . "&";
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen ( $buff ) > 0) {
			$reqPar = substr ( $buff, 0, strlen ( $buff ) - 1 );
		}
		return $reqPar;
	}
	
	/**
	 * 作用：生成签名
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
	 * 作用：array转xml
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
	 * 作用：将xml转为array
	 */
	public function xmlToArray($xml) {
		// 将XML转为array
		$array_data = json_decode ( json_encode ( simplexml_load_string ( $xml, 'SimpleXMLElement', LIBXML_NOCDATA ) ), true );
		return $array_data;
	}
	
	/**
	 * 作用：以post方式提交xml到对应的接口url
	 */
	public function postXmlCurl($xml, $url, $second = 30) {
		// 初始化curl
		$ch = curl_init ();
		// 设置超时
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $second );
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
			curl_close ( $ch );
			throw new WxException("curl出错，错误码:$error");
		}
	}
	
	/**
	 * 作用：使用证书，以post方式提交xml到对应的接口url
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
		// post提交方式
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $xml );
		$data = curl_exec ( $ch );
		// 返回结果
		if ($data) {
			return $data;
		} else {
			$error = curl_errno ( $ch );
			curl_close ( $ch );
			throw new WxException("curl出错，错误码:$error");
		}
	}

}

?>
