<?php
 namespace WebApp\Action;;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 支付控制器
 */
class PaymentsAction extends BaseAction{
	
	/**
     * 获取商城支付方式
     */
    public function getPayType(){
    	$m = D('WebApp/Payments');  
        $rs = $m->getPayType();
        $this->ajaxReturn($rs);
    }

    /**
     * 支付宝支付跳转方法
     */
    public function toPay(){
		$this->isLogin();
    	vendor ( 'Alipay.Corefunction' );
    	vendor ( 'Alipay.Md5function' );
    	vendor ( 'Alipay.AlipayNotify' );
    	vendor ( 'Alipay.AlipaySubmit' );
    	$m = D('WebApp/Payments'); 
    	$orderIds = I("orderId");
    	$data = $m->checkOrderPay($orderIds);
    	if($data["status"]==-1){
    		echo "<span style='font-size:40px;'>您的订单已支付，不要重复支付！</span>";
    		return;
    	}else if($data["status"]==-2){
    		echo "<span style='font-size:40px;'>您订单中商品库存不足，不能支付！</span>";
    		return;
    	}
    	$payment = $m->getPayment("Alipay");
    	$alipay_config = array(
    		'partner' =>$payment['parterID'],   //这里是你在成功申请支付宝接口后获取到的PID；
    		'key'=>$payment['parterKey'],//这里是你在成功申请支付宝接口后获取到的Key
    		'sign_type'=>strtoupper('MD5'),
    		'input_charset'=> strtolower('utf-8'),
    		'transport'=> 'http'
    	);
    	 
    	$format = "xml";
    	$v = "2.0";
    	$req_id = date('Ymdhis');
    	
    	$call_back_url = WSTDomain().'/Wstapi/payment/return_webapp_alipay.php';
    	$notify_url = WSTDomain().'/Wstapi/payment/notify_webapp_alipay.php';
    	$subject = '支付购买商品费用';
    	$merchant_url = "";
    	$seller_email = $payment['payAccount'];
    	$out_trade_no = $orderIds;
    
    	$total_fee = $m->getOrdersNeedPay($orderIds);
    	$req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee><merchant_url>' . $merchant_url . '</merchant_url></direct_trade_create_req>';
    
    	//构造要请求的参数数组，无需改动
    	$para_token = array(
    		"service" => "alipay.wap.trade.create.direct",
    		"partner" => trim($alipay_config['partner']),
    		"sec_id" => trim($alipay_config['sign_type']),
    		"format"	=> $format,
    		"v"	=> $v,
    		"req_id"	=> $req_id,
    		"req_data"	=> $req_data,
    		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
    	);
    	//建立请求
    	$alipaySubmit = new \Alipay\AlipaySubmit($alipay_config);
    	$html_text = $alipaySubmit->buildRequestHttp($para_token);
    	//URLDECODE返回的信息
    	$html_text = urldecode($html_text);
    	//解析远程模拟提交后返回的信息
    	$para_html_text = $alipaySubmit->parseResponse($html_text);
    	//获取request_token
    	$request_token = $para_html_text['request_token'];
    	//**************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute**************************
    	//业务详细
    	$req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
    	//必填
    
    	//构造要请求的参数数组，无需改动
    	$parameter = array(
    		"service" => "alipay.wap.auth.authAndExecute",
    		"partner" => trim($alipay_config['partner']),
    		"sec_id" => trim($alipay_config['sign_type']),
    		"format"	=> $format,
    		"v"	=> $v,
    		"req_id"	=> $req_id,
    		"req_data"	=> $req_data,
    		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
    	);
    	//建立请求
    	$alipaySubmit = new \Alipay\AlipaySubmit($alipay_config);
    	$html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '');
    	echo $html_text;
    }
    
    /**
     * 服务器异步通知页面方法
     *
     */
    function notify() {
    	vendor ( 'Alipay.Corefunction' );
    	vendor ( 'Alipay.Md5function' );
    	vendor ( 'Alipay.AlipayNotify' );
    	vendor ( 'Alipay.AlipaySubmit' );
    	$m = D('WebApp/Payments'); 
    	$payment = $m->getPayment("Alipay");
    	$alipay_config = array(
    		'partner' =>$payment['parterID'],   //这里是你在成功申请支付宝接口后获取到的PID；
    		'key'=>$payment['parterKey'],//这里是你在成功申请支付宝接口后获取到的Key
    		'sign_type'=>strtoupper('MD5'),
    		'input_charset'=> strtolower('utf-8'),
    		'transport'=> 'http'
    	);
    	// 计算得出通知验证结果
    	$alipayNotify = new \Alipay\AlipayNotify ( $alipay_config );
    	$verify_result = $alipayNotify->verifyNotify ();
    	
    	if ($verify_result) {
    		$notify_data = $_POST['notify_data'];
    		// 获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
    		// 解析notify_data
    		// 注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
    		$doc = new \DOMDocument ();
    		$doc->loadXML ( $notify_data );
    		if (! empty ( $doc->getElementsByTagName ( "notify" )->item ( 0 )->nodeValue )) {
    			// 交易号
    			$trade_no = $doc->getElementsByTagName ( "trade_no" )->item ( 0 )->nodeValue;
    			// 商户订单号
    			$out_trade_no = $doc->getElementsByTagName ( "out_trade_no" )->item ( 0 )->nodeValue;
    
    			$total_fee = $doc->getElementsByTagName( "total_fee" )->item(0)->nodeValue;
    			// 支付宝交易号
    			$trade_no = $doc->getElementsByTagName ( "trade_no" )->item ( 0 )->nodeValue;
    			// 交易状态
    			$trade_status = $doc->getElementsByTagName ( "trade_status" )->item ( 0 )->nodeValue;
    			if ($trade_status == 'TRADE_FINISHED' OR $trade_status  == 'TRADE_SUCCESS') {
    				$obj["trade_no"] = $trade_no;
      				$obj["out_trade_no"] = $out_trade_no;
    				$obj["total_fee"] = $total_fee;
    				$m->complatePay($obj);
    			}
    			echo "success"; // 请不要修改或删除
    		}
    	} else {
    		// 验证失败
    		echo "fail";
    	}
    }
    
    /**
     * 支付结果同步回调
     */
    function response(){
    	header('Location:../../index.php?m=WebApp&c=Orders&a=index',false);
    }
    
};
?>