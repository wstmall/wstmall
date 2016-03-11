<?php
 namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 支付类
 */
use Think\Model;
class PaymentsModel extends BaseModel {
	/**
	* 获取支付列表
	*/
	public function getList(){
	     $m = M('payments');
		 $payments = $m->where('enabled=1')->order('payOrder asc')->select();
		 $paylist = array();
		 foreach ($payments as $key => $payment) {
			 $payConfig = json_decode($payment["payConfig"]) ;
			 foreach ($payConfig as $key2 => $value) {
			 	$payment[$key2] = $value;
			 }
			 //$payments[$key] = $payment;
			 if($payment["isOnline"]){
			 	$paylist["onlines"][] = $payment;
			 }else{
			 	$paylist["unlines"][] = $payment;
			 }
		 }
		 return $paylist;
	}
	
	/**
	 * 获取支付信息
	 * @return unknown
	 */
	public function getPayment($payCode=""){
		$m = M('payments');
		$payCode = $payCode?$payCode:I("payCode");
		$payment = $m->where("enabled=1 AND payCode='$payCode' AND isOnline=1")->find();
		$payConfig = json_decode($payment["payConfig"]) ;
		foreach ($payConfig as $key => $value) {
			$payment[$key] = $value;
		}
		return $payment;
	}
	  
	/**
	* 生成支付代码
	* @param   array   $order      订单信息
	* @param   array   $payment    支付方式信息
	*/
    function getAlipayUrl(){
    	//$morders = D('Home/Orders');
    	$payment = self::getPayment();
        $real_method = 2;
        
        switch ($real_method){
            case '0':
                $service = 'trade_create_by_buyer';
                break;
            case '1':
                $service = 'create_partner_trade_by_buyer';
                break;
            case '2':
                $service = 'create_direct_pay_by_user';
                break;
        }
		
        $extend_param = '';
        $orderIds = I("orderIds");
        $orderAmount = I("needPay");
        $USER = session('WST_USER');
        $userId = (int)$USER['userId'];
        $obj["userId"] = $userId;
        $obj["orderIds"] = $orderIds;
        $orders = self::getPayOrders($obj);
        $orderNoList = array();
        foreach ($orders as $key => $order) {
        	$orderNoList[] = $order["orderNo"];
        }
        $return_url = WSTDomain().'/Wstapi/payment/return_alipay.php';
        $notify_url = WSTDomain().'/Wstapi/payment/notify_alipay.php';
        $orderNos = implode(",",$orderNoList);
        $parameter = array(
        	'extra_common_param'=> $userId,
            'service'           => $service,
            'partner'           => $payment['parterID'],
            '_input_charset'    => "utf-8",
            'notify_url'        => $notify_url,
            'return_url'        => $return_url,
            /* 业务参数 */
            'subject'           => '支付购买商品费'.$orderAmount.'元',
        	'body'  	        => '支付订单['.$orderNos.']费用',
            'out_trade_no'      => $orderIds,
        	'total_fee'         => $orderAmount,
            'quantity'          => 1,
            'payment_type'      => 1,
            /* 物流参数 */
            'logistics_type'    => 'EXPRESS',
            'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            /* 买卖双方信息 */
            'seller_email'      => $payment['payAccount']
        );
        ksort($parameter);
        reset($parameter);
        $param = '';
        $sign  = '';
        foreach ($parameter AS $key => $val){
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }
        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment['parterKey'];
        return 'https://mapi.alipay.com/gateway.do?'.$param. '&sign='.md5($sign).'&sign_type=MD5';
    }

    /**
     * 获取支付订单信息
     */
    public function getPayOrders ($obj){
    	$userId = $obj["userId"];
    	$orderIds = $obj["orderIds"];
    	$sql = "SELECT orderId,orderNo,orderStatus FROM __PREFIX__orders WHERE userId = $userId AND orderId in ($orderIds) AND orderFlag = 1 AND needPay>0 AND orderStatus = -2 AND isPay = 0 AND payType = 1";
    	$rsv = $this->query($sql);
    	return $rsv;
    }

    /**
     * 完成支付订单
     */
    public function complatePay ($obj){

    	$trade_no = $obj["trade_no"];
		$orderIds = $obj["out_trade_no"];
		$total_fee = $obj["total_fee"];
		$userId = $obj["userId"];
		$sql = "select og.orderId,og.goodsId,og.goodsNums,og.goodsAttrId from __PREFIX__order_goods og, __PREFIX__orders o where og.orderId = o.orderId AND o.orderId in ($orderIds) and o.payType = 1 and o.needPay > 0 and o.orderFlag=1 and o.orderStatus=-2";
		$goodslist = $this->query($sql);
		$data = array();
		$data["needPay"] = 0;
		$data["isPay"] = 1;
		$data["orderStatus"] = 0;
		$data["tradeNo"] = $trade_no;
		$rd = array('status'=>-1);
		$om = M('orders');
		$rs = $om->where("orderId in ($orderIds) and payType = 1 and needPay > 0 and orderFlag=1 and orderStatus=-2")->save($data);
			
		if(false !== $rs){
			$rd['status']= 1;
			//修改库存
			foreach ($goodslist as $key=> $sgoods){
				$goodsId = $sgoods['goodsId'];
				$goodsNums = $sgoods['goodsNums'];
				$goodsAttrId = $sgoods['goodsAttrId'];
				$sql="update __PREFIX__goods set goodsStock=goodsStock-".$goodsNums." where goodsId=".$goodsId;
				$this->execute($sql);
				if((int)$goodsAttrId>0){
					$sql="update __PREFIX__goods_attributes set attrStock=attrStock-".$goodsNums." where id=".$goodsAttrId;
					$this->execute($sql);
				}
			}
			$orderIdArr = explode(",",$orderIds);
			foreach ($orderIdArr as $key => $orderId) {
				$data = array();
				$lm = M('log_orders');
				$data["orderId"] = $orderId;
				$data["logContent"] = "订单已支付,下单成功";
				$data["logUserId"] = $userId;
				$data["logType"] = 0;
				$data["logTime"] = date('Y-m-d H:i:s');
				$ra = $lm->add($data);
			}
		}
    	
		return $rd;
    }
    

    /**
     * 支付回调接口
     * @param unknown $request
     * @return multitype:string boolean
     */
    function notify($request){
    	$return_res = array(
    		'info'=>'',
    		'status'=>false,
    	);
    	$request = $this->argSort($request);
    	/* 检查数字签名是否正确 */
    	$isSign = $this->getSignVeryfy($request);
    	if (!$isSign){//签名验证失败
    		$return_res['info'] = '签名验证失败';
    		return $return_res;
    	}
    	if ($request['trade_status'] == 'TRADE_SUCCESS' || $request['trade_status'] == 'TRADE_FINISHED' || $request['trade_status'] == 'WAIT_SELLER_SEND_GOODS' || $request['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS'){
    		$return_res['status'] = true;
    	}
    	return $return_res;
    }
    
    /**
     * 获取返回时的签名验证结果
     * @param unknown $para_temp
     * @return boolean
     */
    function getSignVeryfy($para_temp) {
    	$payment = self::getPayment("Alipay");
    	$parterKey = $payment["parterKey"];
    	//除去待签名参数数组中的空值和签名参数
    	$para_filter = $this->paraFilter($para_temp);
    	//对待签名参数数组排序
    	$para_sort = $this->argSort($para_filter);
    	//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
    	$prestr = $this->createLinkstring($para_sort);
    
    	$isSgin = false;
    	$isSgin = $this->md5Verify($prestr, $para_temp['sign'], $parterKey);
    	return $isSgin;
    }
    
    /**
     * 验证签名
     * @param unknown $prestr
     * @param unknown $sign
     * @param unknown $key
     * @return boolean
     */
    function md5Verify($prestr, $sign, $key) {
    	$prestr = $prestr . $key;
    	$mysgin = md5($prestr);
    	if($mysgin == $sign) {
    		return true;
    	}else {
    		return false;
    	}
    }
    
    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     */
    function createLinkstring($para) {
    	$arg  = "";
    	while (list ($key, $val) = each ($para)) {
    		$arg.=$key."=".$val."&";
    	}
    	//去掉最后一个&字符
    	$arg = substr($arg,0,count($arg)-2);
    	//如果存在转义字符，那么去掉转义
    	if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
    
    	return $arg;
    }
    
    /**
     * 除去数组中的空值和签名参数
     */
    function paraFilter($para) {
    	$para_filter = array();
    	while (list ($key, $val) = each ($para)) {
    		if($key == "sign" || $key == "sign_type" || $val == "")continue;
    		else    $para_filter[$key] = $para[$key];
    	}
    	return $para_filter;
    }
    
    /**
     * 对数组排序
     * @param unknown $para
     * @return unknown
     */
    function argSort($para) {
    	ksort($para);
    	reset($para);
    	return $para;
    }
};
?>