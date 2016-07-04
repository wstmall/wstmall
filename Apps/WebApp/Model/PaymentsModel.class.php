<?php
 namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 支付类
 */
class PaymentsModel extends BaseModel {
	/**
     * 获取商城支付方式
     */
    public function getPayType(){
         $m = M('payments');
         $payments = array();
         $payments = $m->where('enabled=1 and payCode!="weixin"')->order('payOrder asc')->field('id,payCode,payName,isOnline')->select();//不显示微信支付
         return $payments;
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
     * 完成支付订单
     */
    public function complatePay ($obj){
    
    	$trade_no = $obj["trade_no"];
    	$orderIds = $obj["out_trade_no"];
    	$total_fee = $obj["total_fee"];

    	$sql = "select o.userId, og.orderId,og.goodsId,og.goodsNums,og.goodsAttrId from __PREFIX__order_goods og, __PREFIX__orders o where og.orderId = o.orderId AND o.orderId in ($orderIds) and o.payType = 1 and o.needPay > 0 and o.orderFlag=1 and o.orderStatus=-2";
    	$goodslist = $this->query($sql);
    
    	$data = array();
    	$data["tradeNo"] = $trade_no;
    	$data["needPay"] = 0;
    	$data["isPay"] = 1;
    	$data["orderStatus"] = 0;
    		
    	$rd = array('status'=>-1);
    	$om = M('orders');
    	$rs = $om->where("orderId in ($orderIds) and payType = 1 and needPay > 0 and orderFlag=1 and orderStatus=-2")->save($data);
    		
    	if(false !== $rs){
    		$rd['status']= 1;
    		$userId = 0;
    		//修改库存
    		foreach ($goodslist as $key=> $sgoods){
    			$userId = $sgoods['userId'];
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
     * 获取订单金额
     */
    public function getOrdersNeedPay($orderIds){
    	$userId = (int)session('WST_USER.userId');
    	$sql = "select sum(needPay) total_money from __PREFIX__orders where userId = $userId AND orderId in ($orderIds) and payType = 1 and needPay > 0 and orderFlag=1 and orderStatus=-2";
    	$obj = $this->queryRow($sql);
    	return $obj["total_money"];
    }
    
    /**
     * 检查订单是否已支付
     */
    public function checkOrderPay ($orderIds){
    	$userId = (int)session('WST_USER.userId');
    	$sql = "SELECT count(orderId) counts FROM __PREFIX__orders WHERE userId = $userId AND orderId in ($orderIds) AND orderFlag = 1 AND orderStatus = -2 AND isPay = 0 AND payType = 1";
    	$rsv = $this->query($sql);
    	$ocnt = count(explode(",",$orderIds));
    	$data = array();
    
    	if($ocnt==$rsv[0]['counts']){
    
    		$sql = "SELECT og.goodsId,og.goodsName,og.goodsAttrName,g.goodsStock,og.goodsNums, og.goodsAttrId, ga.attrStock FROM  __PREFIX__goods g ,__PREFIX__order_goods og
    		left join __PREFIX__goods_attributes ga on ga.goodsId=og.goodsId and og.goodsAttrId=ga.id
    		WHERE og.goodsId = g.goodsId and og.orderId in($orderIds)";
    		$glist = $this->query($sql);
    			
    		if(count($glist)>0){
    			$rlist = array();
    			foreach ($glist as $goods) {
    				if($goods["goodsAttrId"]>0){
    					if($goods["attrStock"]<$goods["goodsNums"]){
    						$rlist[] = $goods;
    					}
    				}else{
    					if($goods["goodsStock"]<$goods["goodsNums"]){
    						$rlist[] = $goods;
    					}
    				}
    			}
    			if(count($rlist)>0){
    				$data["status"] = -2;
    				$data["rlist"] = $rlist;
    			}else{
    				$data["status"] = 1;
    			}
    		}else{
    			$data["status"] = 1;
    		}
    
    
    	}else{
    		$data["status"] = -1;
    	}
    	return $data;
    }
    
};
?>