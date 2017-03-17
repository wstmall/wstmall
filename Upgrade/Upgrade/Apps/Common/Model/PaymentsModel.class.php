<?php
namespace Common\Model;
use Think\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单服务类
 */
class PaymentsModel extends BaseModel {
	
	
	public function balancePay($obj){
		$rd = array("status"=>-1);
		$userId = (int)$obj["userId"];
		$orderType = (int)$obj["orderType"];
		$orderId = $obj["orderId"];
		
		$userMoney = M("users")->where(array("userId"=>$userId))->getField("userMoney");
		$orderNos = "";
		$idlist = array();
		$nolist = array();
		$where = array();
		if($orderType==1){
			$idlist[] = $orderId;
			$where = array("userId"=>$userId , "orderId" => $orderId , "payType" => 1 , "needPay" => array("gt",0),  "orderFlag" => 1 , "orderStatus"=>-2);
			$orderNo = M("orders")->where(array("orderId"=>$orderId))->getField("orderNo");
			$nolist[] = $orderNo;
			$sql = "select sum(needPay) needPay from __PREFIX__orders where userId=$userId and orderId = $orderId and payType = 1 and needPay > 0 and orderFlag=1 and orderStatus=-2";

			$sqlv = "select og.orderId,og.goodsId,og.goodsNums,og.goodsAttrId,orderFrom,orderFromId from __PREFIX__order_goods og, __PREFIX__orders o where o.userId=$userId and og.orderId = o.orderId AND o.orderId = $orderId and o.payType = 1 and o.needPay > 0 and o.orderFlag=1 and o.orderStatus=-2";
		}else{
			$where = array("userId"=>$userId , "orderunique" => $orderId , "payType" => 1 , "needPay" => array("gt",0),  "orderFlag" => 1 , "orderStatus"=>-2);
			
			$orders = M("orders")->where( $where )->field("orderId,orderNo")->select();
			for($i=0,$k=count($orders);$i<$k;$i++){
				$nolist[] = $orders[$i]["orderNo"];
				$idlist[] = $orders[$i]["orderId"];
			}
			
			$sql = "select sum(needPay) needPay from __PREFIX__orders where userId=$userId and orderunique = '$orderId' and payType = 1 and needPay > 0 and orderFlag=1 and orderStatus=-2";
		
			$sqlv = "select og.orderId,og.goodsId,og.goodsNums,og.goodsAttrId,orderFrom,orderFromId from __PREFIX__order_goods og, __PREFIX__orders o where o.userId=$userId and og.orderId = o.orderId AND o.orderunique = '$orderId' and o.payType = 1 and o.needPay > 0 and o.orderFlag=1 and o.orderStatus=-2";
		}
		$opay = $this->queryRow($sql);
		$goodslist = $this->query($sqlv);
		$needPay = (float)$opay["needPay"];
		if($needPay>0){
			if($userMoney>=$needPay){
				$now = date("Y-m-d H:i:s");
				
				$orderFrom = $goodslist[0]["orderFrom"];
				$orderFromId = $goodslist[0]["orderFromId"];
				$porderId = $goodslist[0]["orderId"];
				$goodsNums = $goodslist[0]['goodsNums'];
				$gpRd = array("status"=>1);
				if($orderFrom==2){//团购
					$sql = "select gp.id,gp.goodsId,gp.groupMoney,gp.goodsStock,gp.saleCnt,gp.virtualBuyCnt,p.startTime,p.endTime from __PREFIX__groups p, __PREFIX__groups_goods gp,__PREFIX__goods g
							where gp.id = $orderFromId and gp.groupId = p.groupId and and gp.goodsId = g.goodsId gp.goodsStatus=2 and gp.dataFlag = 1 and g.goodsFlag = 1 and g.isSale=1";
					$group = $this->queryRow($sql);
					if(!empty($group)){
						if($group["startTime"]>$now){
							$rd["msg"] = "团购失败，该活动还未开始！";
						}else if($group["endTime"]<$now){
							$rd["msg"] = "团购失败，该活动已结束";
						}else if($group["goodsStock"]==0){
							$rd["msg"] = "团购失败，团购商品库存不足！";
						}else if(($group["goodsStock"])<$cnt){
							$rd["msg"] = "团购失败，商品库存不足！";
						}else{
							$rd["status"] = 1;
						}
					}else{
						$rd["msg"] = "团购失败，团购商品不存在！";
					}
				}else if($orderFrom==3){//抢购
					$sql = "select gp.id,gp.goodsId,gp.panicMoney,gp.goodsStock,gp.saleCnt,gp.virtualBuyCnt,p.startTime,p.endTime from __PREFIX__panics p, __PREFIX__panics_goods gp,__PREFIX__goods g
							where gp.id = $orderFromId and gp.panicId = p.panicId and gp.goodsId = g.goodsId and gp.goodsStatus=2 and gp.dataFlag = 1 and g.goodsFlag = 1 and g.isSale=1 ";
					$panic = $this->queryRow($sql);
					if(!empty($panic)){
						if($panic["startTime"]>$now){
							$rd["msg"] = "抢购失败，该活动还未开始！";
						}else if($panic["endTime"]<$now){
							$rd["msg"] = "抢购失败，该活动已结束！";
						}else if($panic["goodsStock"]==0){
							$rd["msg"] = "抢购失败，商品库存不足！";
						}else if(($panic["goodsStock"])<$cnt){
							$rd["msg"] = "抢购失败，商品库存不足！";
						}else{
							$rd["status"] = 1;
						}
					}else{
						$rd["msg"] = "抢购失败，支付的金额已返回您的钱包！";
					}
				}
				if($rd["status"]==-1){
					return $rd;
				}
				$rd = array("status"=>-1);
				M("users")->where(array("userId"=>$userId))->setDec("userMoney",$needPay);
				M("orders")->where( $where )->save(array("isPay"=>1,"needPay"=>0,"orderStatus"=>0,"payFrom"=>3));
				
				
				//修改库存
				foreach ($goodslist as $key=> $sgoods){
					$orderFrom = $sgoods["orderFrom"];
					$orderFromId = $sgoods["orderFromId"];
					$goodsNums = $sgoods['goodsNums'];
					if($orderFrom==2){
						$sql="update __PREFIX__groups_goods set goodsStock=goodsStock-".$goodsNums." where id=".$orderFromId;
						$this->execute($sql);
					}else if($orderFrom==3){
						$sql="update __PREFIX__panics_goods set goodsStock=goodsStock-".$goodsNums." where id=".$orderFromId;
						$this->execute($sql);
					}else{
						$goodsId = $sgoods['goodsId'];
						$goodsAttrId = $sgoods['goodsAttrId'];
						$sql="update __PREFIX__goods set goodsStock=goodsStock-".$goodsNums." where goodsId=".$goodsId;
						$this->execute($sql);
						if((int)$goodsAttrId>0){
							$sql="update __PREFIX__goods_attributes set attrStock=attrStock-".$goodsNums." where id=".$goodsAttrId;
							$this->execute($sql);
						}
					}
				}
				
				$content = "订单已支付,下单成功";
				for($i=0,$k=count($idlist);$i<$k;$i++){
					$orderId = $idlist[$i];
					WSTMoneyLog(0, $userId, "支付订单【".$nolist[$i]."】", 5, $orderId, $needPay, 0, 2, 0);
					WSTOrderLog($orderId, $content, $userId,0);
				}
				$rd["status"] = 1;
			}else{
				$rd["msg"] = "您的帐户余额不足，请选择其他支付方式！";
			}
		}else{
			$rd["msg"] = "您的订单已支付，无需再支付！";
		}
		return $rd;
	}
	
}