<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 定时任务服务类
 */
class CronJobsModel extends BaseModel {
    /**
	  * 自动收货
	  */
	 public function autoReceivie(){
	 	$m = M('orders');
	 	$autoReceiveDays = (int)$GLOBALS['CONFIG']['autoReceiveDays'];
	 	$autoReceiveDays = ($autoReceiveDays>0)?$autoReceiveDays:10;//避免有些客户没有设置值
	 	$lastDay = date("Y-m-d 00:00:00",strtotime("-".$autoReceiveDays." days"));
	 	$rs = $m->where('deliveryTime<"'.$lastDay.'" and orderStatus=3 and orderFlag=1')->getField("orderId,orderNo,userId,shopId,orderScore,useScore,poundageRate,poundageMoney,scoreMoney");
	 	if(!empty($rs)){
	 		$mlogo = M('log_orders');
	 		$msm = M('log_sys_moneys');
	 		$mse = M('user_score');
	 		foreach ($rs as $key => $v){
	 			//结束订单状态
	 			$data = array();
	 			$data['receiveTime'] = date('Y-m-d 00:00:00');
	 			$data['orderStatus'] = 4;
	 			$rsStatus = $m->where('orderId='.$v['orderId']." and orderStatus=3 and orderFlag=1")->save($data);
	 			if(false !== $rsStatus){
		 			//修改商品销量
	        	    $sql = "UPDATE __PREFIX__goods g, __PREFIX__order_goods og, __PREFIX__orders o SET g.saleCount=g.saleCount+og.goodsNums WHERE g.goodsId= og.goodsId AND og.orderId = o.orderId AND o.orderId=".$v['orderId']." AND o.userId=".$v['userId'];
	        	    $this->execute($sql);
		 			//增加积分
		 			$sql = "UPDATE __PREFIX__users set userScore=userScore+".$v["orderScore"].",userTotalScore=userTotalScore+".$v["orderScore"]." WHERE userId=".$v['userId'];
		        	$this->execute($sql);
		 			//插入日志
		 			$data = array();
					$data["orderId"] = $v['orderId'];
					$data["logContent"] = "系统自动确认收货";
					$data["logUserId"] = $v['userId'];
					$data["logType"] = 0;
					$data["logTime"] = date('Y-m-d H:i:s');
					$mlogo->add($data);
		 			//修改积分
		        	if((int)$GLOBALS['CONFIG']['isOrderScore']==1){
			        	$sql = "UPDATE __PREFIX__users set userScore=userScore+".$v["orderScore"].",userTotalScore=userTotalScore+".$v["orderScore"]." WHERE userId=".$v['userId'];
			        	$this->execute($sql);
			        	$data = array();
			        	$data["userId"] = $v['userId'];
			        	$data["score"] = $v["orderScore"];
			        	$data["dataSrc"] = 1;
			        	$data["dataId"] = $v["orderId"];
			        	$data["dataRemarks"] = "交易获得";
			        	$data["scoreType"] = 1;
			        	$data["createTime"] = date('Y-m-d H:i:s');
			        	$mse->add($data);
		        	}
	 			    //平台积分支付支出
		        	if($v["scoreMoney"]>0){
		        		$data = array();
		        		$data["targetType"] = 0;
		        		$data["targetId"] = $v['userId'];
		        		$data["dataSrc"] = 2;
		        		$data["dataId"] = $v['orderId'];
		        		$data["moneyRemark"] = "订单【".$v["orderNo"]."】支付 ".$v["useScore"]." 个积分，支出 ￥".$v["scoreMoney"];
		        		$data["moneyType"] = 2;
		        		$data["money"] = $rsv["scoreMoney"];
		        		$data["createTime"] = date('Y-m-d H:i:s');
		        		$data["dataFlag"] = 1;
		        		$msm->add($data);
		        	}
		        	//平台收取订单佣金
		        	if($v["poundageMoney"]>0){
		        		$data = array();
		        		$data["targetType"] = 1;
		        		$data["targetId"] = $v["shopId"];
		        		$data["dataSrc"] = 1;
		        		$data["dataId"] = $v['orderId'];
		        		$data["moneyRemark"] = "收取订单【".$v["orderNo"]."】".$v["poundageRate"]."%的佣金 ￥".$v["poundageMoney"];
		        		$data["moneyType"] = 1;
		        		$data["money"] = $v["poundageMoney"];
		        		$data["createTime"] = date('Y-m-d H:i:s');
		        		$data["dataFlag"] = 1;
		        		$msm->add($data);
		        	}
	 			}
	 		}
	 	}
	 }
	 
	 /**
	  * 自动好评
	  */
	 public function autoGoodAppraise(){
	 	$m = M('orders');
	 	$autoAppraiseDays = (int)$GLOBALS['CONFIG']['autoAppraiseDays'];
	 	$autoAppraiseDays = ($autoAppraiseDays>0)?$autoAppraiseDays:7;//避免有些客户没有设置值
	 	$lastDay = date("Y-m-d 00:00:00",strtotime("-".$autoAppraiseDays." days"));
	 	$rs = $m->where('receiveTime<"'.$lastDay.'" and orderStatus=4 and orderFlag=1')->getField("orderId,userId,orderScore,shopId");
	 	if(!empty($rs)){
	 		$mog = M('order_goods');
	 		$mga = M('goods_appraises');
	 		$gm = M('goods_scores');
	 		$ms = M('user_score');
	 		foreach ($rs as $key => $v){
	 			//标记订单已评价
	 			$sql ="update __PREFIX__orders set isAppraises=1 where orderId=".$v['orderId'];
	 			$this->execute($sql);
	 			//获取该订单下的商品
	 			$ogRs = $mog->where('orderId='.$v['orderId'])->select();
	 			foreach ($ogRs as $vg){
	 				//自动评价
	 				$data = array();
	 				$data["goodsId"] = $vg['goodsId'];
		            $data["shopId"] = $v['shopId'];
		            $data["userId"] = $v['userId'];
		            $data["goodsScore"] = 5;
		            $data["timeScore"] = 5;
		            $data["serviceScore"] = 5;
		            $data["content"] = "系统自动好评";
		            $data['goodsAttrId'] = $vg['goodsAttrId'];
		            $data["isShow"] = 1;
		            $data["createTime"] = date('Y-m-d H:i:s');
		            $data["orderId"] = $v['orderId'];
		            $mga->add($data);
		            //增加商品评分
		            $sql ="SELECT * FROM __PREFIX__goods_scores WHERE goodsId=".$vg['goodsId'];
			        $goodsScores = $this->queryRow($sql);
			        if(empty($goodsScores)){
			        	$data = array();
				        $data["goodsId"] = $vg['goodsId'];
				        $data["shopId"] = $v['shopId'];
				        $data["goodsScore"] = 5;
				        $data["goodsUsers"] = 1;
				        $data["timeScore"] = 5;
				        $data["timeUsers"] = 1;
				        $data["serviceScore"] = 5;
				        $data["serviceUsers"] = 1;
				        $data["totalScore"] = 15;
				        $data["totalUsers"] = 1;
				        $gm->add($data);
			        }else{
			        	$sql = "UPDATE __PREFIX__goods_scores set  totalUsers = totalUsers +1 , totalScore = totalScore + 15
						,goodsUsers = goodsUsers +1 , goodsScore = goodsScore +5 ,timeUsers = timeUsers +1 , timeScore = timeScore +5
						,serviceUsers = serviceUsers +1 , serviceScore = serviceScore +5 WHERE goodsId = ".$vg['goodsId'];		
				        $this->execute($sql);
			        }
			        //增加店铺评分
					$sql = "UPDATE __PREFIX__shop_scores set totalUsers = totalUsers +1 , totalScore = totalScore + 15
					    ,goodsUsers = goodsUsers +1 , goodsScore = goodsScore +5,timeUsers = timeUsers +1 , timeScore = timeScore +5
						,serviceUsers = serviceUsers +1 , serviceScore = serviceScore +5 WHERE shopId = ".$v['shopId'];		
					$this->execute($sql);
					//如果有评价积分的话设置评价积分
					if((int)$GLOBALS['CONFIG']['isAppraisesScore']==1){
						$appraisesScore = (int)$GLOBALS['CONFIG']['appraisesScore'];
						$sql = "UPDATE __PREFIX__users set userScore=userScore+".$appraisesScore.",userTotalScore=userTotalScore+".$appraisesScore." WHERE userId=".$v['userId'];
						$this->execute($sql);
						//增加积分记录
						$data = array();
						$data["userId"] = $v['userId'];
						$data["score"] = $appraisesScore;
						$data["dataSrc"] = 2;
						$data["dataId"] = $v['orderId'];
						$data["dataRemarks"] = "订单评价获得";
						$data["scoreType"] = 1;
						$data["createTime"] = date('Y-m-d H:i:s');
						$ms->add($data);
					}
	 			}
	 		}
	 	}
	 }
	 
	 /**
	  * 自动结算
	  */
	 public function autoSettlement(){
	 	//获取上一月没有计结算的订单
	 	$lastMonth = WSTMonth(-1);
	 	$sql ="select distinct shopId from __PREFIX__orders where left(receiveTime,7)='".$lastMonth."' and orderStatus=4 
	 	     and orderFlag=1 and o.payType=1 and ";
	 	$rs = $this->query($sql);
	 	if(!empty($rs)){
	 		$m = M('order_settlements');
	 		foreach ($rs as $v){
	 			//获取商家结算账户
	 			$sql = "select bankName,bankNo,bankUserName from __PREFIX__shops s 
		        left join __PREFIX__banks b on b.bankId=s.bankId where s.shopId=".$v['shopId'];
		        $accRs = $this->queryRow($sql);
		        if(empty($accRs))continue;
	 			//按商家进行结算
	 			$sql = "select sum(totalMoney+deliverMoney) settlementMoney,sum(poundageMoney) poundageMoney 
	 			     from __PREFIX__orders where left(receiveTime,7)='".$lastMonth."' and orderStatus=4 
	 			     and settlementId=0 and orderFlag=1 and shopId=".$v['shopId'];
	 			$totalRs = $this->queryRow($sql);
	 			if((float)$totalRs['settlementMoney']==0)continue;
	 			$data = array();
				$data['settlementType'] = 0;
				$data['shopId'] = $v['shopId'];
				$data['accName'] = $accRs['bankName'];
				$data['accNo'] = $accRs['bankNo'];
				$data['accUser'] = $accRs['bankUserName'];
				$data['createTime'] = date('Y-m-d H:i:s');
				$data['orderMoney'] = $totalRs['realTotalMoney'];
				$data['settlementMoney'] = $totalRs['settlementMoney']-$totalRs['poundageMoney'];
				$data['poundageMoney'] = $totalRs['poundageMoney'];
				$data['isFinish'] = 0;
				$settlementId = $m->add($data);
				if(false !== $settlementId){
					//修改结算单号
					$sql = "update __PREFIX__order_settlements set settlementNo='".date('y').sprintf("%08d", $settlementId)."' 
					where  settlementId=".$settlementId;
			        $this->execute($sql);
			        //修改订单ID的结算ID
			        $sql = "update __PREFIX__orders set settlementId=".$settlementId." where left(receiveTime,7)='".$lastMonth."' 
			              and orderStatus=4 and settlementId=0 and orderFlag=1 and shopId=".$v['shopId'];
				    $this->execute($sql);
				}
	 		}
	 	}
	 }
};
?>