<?php

namespace Home\Action;

use Think\Controller;

/**
 * 微信native方式支付
 */
class WxNative2Action extends BaseAction {
	/**
	 * 初始化
	 */
	private $wxpayConfig;
	private $wxpay;
	public function _initialize() {
		header ( "Content-type: text/html; charset=utf-8" );
		vendor ( 'WxPayPubHelper.WxPaypubconfig' );
		vendor ( 'WxPayPubHelper.WxPayPubHelper' );
		vendor ( 'WxPayPubHelper.SDKRuntimeException' );
		
		$this->wxpayConfig = C ( 'WxPayConf_pub' );
		
		$m = D ( 'Home/Payments' );
		$this->wxpay = $m->getPayment ( "Weixin" );
		$this->wxpayConfig ['appid'] = $this->wxpay ['appId']; // 微信公众号身份的唯一标识
		$this->wxpayConfig ['appsecret'] = $this->wxpay ['appsecret']; // JSAPI接口中获取openid
		$this->wxpayConfig ['mchid'] = $this->wxpay ['mchId']; // 受理商ID
		$this->wxpayConfig ['key'] = $this->wxpay ['apiKey']; // 商户支付密钥Key
		
		//$this->wxpayConfig ['appid'] = $this->wxpayConfig ['APPID']; // 微信公众号身份的唯一标识
		//$this->wxpayConfig ['appsecret'] = $this->wxpayConfig ['APPSECRET']; // JSAPI接口中获取openid
		//$this->wxpayConfig ['mchid'] = $this->wxpayConfig ['MCHID']; // 受理商ID
		//$this->wxpayConfig ['key'] = $this->wxpayConfig ['KEY']; // 商户支付密钥Key
		$this->wxpayConfig ['notifyurl'] = $this->wxpayConfig ['NOTIFY_URL'];
		$this->wxpayConfig ['returnurl'] = "";
		
		// 初始化WxPayConf_pub
		$wxpaypubconfig = new \WxPayConf_pub ( $this->wxpayConfig );
		// print_r($this->wxpayConfig);
	}
	
	public function createQrcode() {
		$pkey = base64_decode ( I ( "pkey" ) );
		$pkeys = explode ( "@", $pkey );
		if (count ( $pkeys ) != 2) {
			$this->assign ( 'out_trade_no', "" );
		} else {
			
			$morders = D ( 'Home/Orders' );
			$obj ["orderIds"] = $pkeys [1];
			$data = $morders->getPayOrders ( $obj );
			$orders = $data ["orders"];
			$needPay = $data ["needPay"];
			$this->assign ( "orderIds", $orderIds );
			$this->assign ( "orders", $orders );
			$this->assign ( "needPay", $needPay );
			$this->assign ( "orderCnt", count ( $orders ) );
			
			// 使用统一支付接口
			$unifiedOrder = new \UnifiedOrder_pub ();
			
			
			$unifiedOrder->setParameter ( "body", "支付订单費用" ); // 商品描述
			                                                       // 自定义订单号，此处仅作举例
			$timeStamp = time ();
			$out_trade_no = "$timeStamp";
			// $out_trade_no = "1000001|1000002";
			$unifiedOrder->setParameter ( "out_trade_no", "$out_trade_no" ); // 商户订单号
			$unifiedOrder->setParameter ( "total_fee", $needPay * 100 ); // 总金额
			$unifiedOrder->setParameter ( "notify_url", C ( 'WxPayConf_pub.NOTIFY_URL' ) ); // 通知地址
			$unifiedOrder->setParameter ( "trade_type", "NATIVE" ); // 交易类型
			$unifiedOrder->setParameter ( "attach", "$pkey" ); // 附加数据
			                                                   // $unifiedOrder->setParameter ( "detail", "Ipad mini" );//附加数据
			$unifiedOrder->SetParameter ( "input_charset", "UTF-8" );
			
			// 获取统一支付接口结果
			$unifiedOrderResult = $unifiedOrder->getResult ();
			
			// 商户根据实际情况设置相应的处理流程
			
			if ($unifiedOrderResult ["return_code"] == "FAIL") {
				// 商户自行增加处理流程
				echo "通信出错：" . $unifiedOrderResult ['return_msg'] . "<br>";
			} elseif ($unifiedOrderResult ["result_code"] == "FAIL") {
				// 商户自行增加处理流程
				echo "错误代码：" . $unifiedOrderResult ['err_code'] . "<br>";
				echo "错误代码描述：" . $unifiedOrderResult ['err_code_des'] . "<br>";
			} elseif ($unifiedOrderResult ["code_url"] != NULL) {
				// 从统一支付接口获取到code_url
				$code_url = $unifiedOrderResult ["code_url"];
				// 商户自行增加处理流程

			}
			
			$this->assign ( 'out_trade_no', $obj ["orderIds"] );
			$this->assign ( 'code_url', $code_url );
			$this->assign ( 'unifiedOrderResult', $unifiedOrderResult );
		}
		$this->display ( "default/payment/wxnative2/qrcode" );
	}
	public function notify() {
		// 使用通用通知接口
		$notify = new \Notify_pub ();
		
		// 存储微信的回调
		$xml = $GLOBALS ['HTTP_RAW_POST_DATA'];
		$notify->saveData ( $xml );
		
		// 验证签名，并回应微信。
		// 对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
		// 微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
		// 尽可能提高通知的成功率，但微信不保证通知最终能成功。
		if ($notify->checkSign () == FALSE) {
			$notify->setReturnParameter ( "return_code", "FAIL" ); // 返回状态码
			$notify->setReturnParameter ( "return_msg", "签名失败" ); // 返回信息
		} else {
			$notify->setReturnParameter ( "return_code", "SUCCESS" ); // 设置返回码
		}
		$returnXml = $notify->returnXml ();
		echo $returnXml;
		
		// ==商户根据实际情况设置相应的处理流程，此处仅作举例=======
		
		if ($notify->checkSign () == TRUE) {
			if ($notify->data ["return_code"] == "FAIL") {
				// 此处应该更新一下订单状态，商户自行增删操作
			} elseif ($notify->data ["result_code"] == "FAIL") {
				// 此处应该更新一下订单状态，商户自行增删操作
			} else {
				// 此处应该更新一下订单状态，商户自行增删操作
				$order = $notify->getData ();
				// $out_trade_no = $order["out_trade_no"];
				$trade_no = $order["transaction_id"];
				$total_fee = $order ["total_fee"];
				$pkey = $order ["attach"] ;
				$pkeys = explode ( "@", $pkey );
				$userId = $pkeys [0];
				$out_trade_no = $pkeys [1];
				
				$pm = D ( 'Home/Payments' );
				// 商户订单号
				$obj = array ();
				$obj ["trade_no"] = $trade_no;
				$obj ["out_trade_no"] = $out_trade_no;
				$obj ["total_fee"] = $total_fee;
				$obj ["userId"] = $userId;
				// 支付成功业务逻辑
				
				$payments = $pm->complatePay ( $obj );
				
				S ("$out_trade_no",$total_fee);

			}

		}
	}
	
	/**
	 * 检查支付结果
	 */
	public function getPayStatus() {
		$trade_no = I ( 'trade_no' );
		$total_fee = S ( $trade_no );
		$data = array("status"=>-1);
		
		if(empty ( $total_fee )){
			$data["status"] = -1;
		}else{// 检查缓存是否存在，存在说明支付成功
			S ( $trade_no, null );
			$data["status"] = 1;
		}		
		$this->ajaxReturn($data);
	}
	
	/**
	 * 检查支付结果
	 */
	public function paySuccess() {
		$this->display ( "default/payment/pay_success" );
	}
	

	
}