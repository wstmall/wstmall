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
class OrdersModel extends BaseModel {
	
	/**
	 * 用户申请退款
	 */
	public function refund($obj){
		$rd = array("status"=>-1);
		
		$orderId = $obj["orderId"];
		$refundRemark = $obj["refundRemark"];
		$money = $obj["backMoney"];
		$userId = $obj["userId"];
		
		
		$where = array();
		$where["orderFlag"] = 1;
		$where["orderId"] = $orderId;
		$where["payType"] = array("in","1,2");
		$where["isPay"] = 1;
		$where["userId"] = $userId;
		$where["orderStatus"] = array("in",array(0,1,2,3));
		$order = $this->where($where)->field("orderId,userId,orderStatus,payType,realTotalMoney,orderNo")->find();
	
		if($money==0 && $order["realTotalMoney"]>0){
			$rd["msg"] = "退款金额不能为0";
			return $rd;
		}
		if($refundRemark==''){
			$rd["msg"] = "请输入退款原因";
			return $rd;
		}
		if(empty($order)){
			$rd["msg"] = "操作失败，请检查订单状态是否已改变";
			return $rd;
		}
		if($money>$order['realTotalMoney']){
			$rd["msg"] = "申请退款金额不能大于实支付金额";
			return $rd;
		}
		$status = array("0"=>-1,"1"=>-6,"2"=>-9,"3"=>-3);
		$data = array();
		$data["refundRemark"] = $refundRemark;
		$data["backMoney"] = $money;
		$data["refundSrcStatus"] = $order["orderStatus"];
		$data["orderStatus"] = $status[$order["orderStatus"]];
		$flag = $this->where($where)->save($data);
	
		//申请退款要给商家发送信息
		if($flag!=false){
			WSTSendMsg($order['userId'],"订单【".$order['orderNo']."】用户申请退款，请及时处理。");
			WSTOrderLog($orderId,"用户申请退款【￥".$money."】",$order['userId'],0);
			$rd["status"] = 1;
			$rd["msg"] = "您的退款申请已提交，请留意退款信息";
			return $rd;
		}else{
			$rd["msg"] = "操作失败，请检查订单状态是否已改变";
			return $rd;
		}
	}
	
	
	/**
	 * 取消订单
	 */
	public function orderCancel($obj){
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
		$rejectionRemarks = $obj["rejectionRemarks"];
		$rsdata = array('status'=>-1);
		//判断订单状态，只有符合状态的订单才允许改变
		$sql = "SELECT orderId,orderNo,orderStatus,useScore FROM __PREFIX__orders WHERE orderFlag=1 and orderId = $orderId and orderFlag = 1 and userId=".$userId;
		$rsv = $this->queryRow($sql);
		$cancelStatus = array(0,1,2,3,-2);//未受理,已受理,打包中，配送中,待付款订单
		if(!in_array($rsv["orderStatus"], $cancelStatus)){
			$rsdata["msg"] = "操作失败，请检查订单状态是否已改变";
			return $rsdata;
		}
	
		if($rsv["orderStatus"]>0 && $rejectionRemarks==''){
			$rsdata["msg"] = "请输入取消原因";
			return $rsdata;//如果是受理后取消需要有原因
		}
		$status = array(-1,-6,-9,-3,'-2'=>-1);
		$orderStatus = $status[$rsv["orderStatus"]];
		$sql = "UPDATE __PREFIX__orders set orderStatus = ".$orderStatus." WHERE orderFlag=1 and orderId = $orderId and userId=".$userId;
		$rs = $this->execute($sql);
	
		$sql = "select ord.deliverType, ord.orderId, og.goodsId ,og.goodsId, og.goodsNums,ord.orderFrom,ord.orderFromId
				from __PREFIX__orders ord , __PREFIX__order_goods og
				WHERE ord.orderFlag=1 and ord.orderId = og.orderId AND ord.orderId = $orderId";
		$ogoodsList = $this->query($sql);
		//获取商品库存
		for($i=0;$i<count($ogoodsList);$i++){
			$sgoods = $ogoodsList[$i];
			$orderFrom = $sgoods["orderFrom"];
			if($orderFrom==2){
				$orderFromId = $sgoods["orderFromId"];
				$sql="update __PREFIX__groups_goods set goodsStock=goodsStock+".$sgoods['goodsNums']." where id=".$orderFromId;
				$this->execute($sql);
			}elseif($orderFrom==3){
				$orderFromId = $sgoods["orderFromId"];
				$sql="update __PREFIX__panics_goods set goodsStock=goodsStock+".$sgoods['goodsNums']." where id=".$orderFromId;
				$this->execute($sql);
			}else{
				$sql="update __PREFIX__goods set goodsStock=goodsStock+".$sgoods['goodsNums']." where goodsId=".$sgoods["goodsId"];
				$this->execute($sql);
			}
		}
		$sql="Delete From __PREFIX__order_reminds where orderId=".$orderId." AND remindType=0";
		$this->execute($sql);
	
		if($rsv["useScore"]>0){//如果有使用积分，则返还
			$sql = "UPDATE __PREFIX__users set userScore=userScore+".$rsv["useScore"]." WHERE userId=".$userId;
			$this->execute($sql);
					
			$m = M('user_score');
			$data = array();
			$data["userId"] = $userId;
			$data["score"] = $rsv["useScore"];
			$data["dataSrc"] = 3;
			$data["dataId"] = $orderId;
			$data["dataRemarks"] = "取消订单返还";
			$data["scoreType"] = 1;
			$data["createTime"] = date('Y-m-d H:i:s');
			$m->add($data);
		}
		
		$content = "用户已取消订单".(($rsv["orderStatus"]>0)?"，原因【".$rejectionRemarks."】":"");
		$rsdata["status"] = 1;
		WSTOrderLog($orderId, $content, $userId);
		return $rsdata;
	
	}
	
	/**
	 * 用户确认收货
	 */
	public function orderConfirm ($obj){
		
		$userId = (int)$obj["userId"];
		$orderId = (int)$obj["orderId"];
		$optType = (int)$obj["optType"];
		$rd = array("status"=>-1);
		$sql = "SELECT orderId,shopId,userId,orderNo,orderScore,orderStatus,poundageRate,poundageMoney,shopId,useScore,scoreMoney,distributType,distributOrderRate,
				promoterRate,buyerRate,totalMoney,needPay,totalCommission,payType,orderFrom,orderFromId
				FROM __PREFIX__orders WHERE orderFlag=1 and orderId = $orderId and userId=".$userId;		
		$rsv = $this->queryRow($sql);
		if(($rsv["orderStatus"]!=3 && $optType==0) && ($rsv["orderStatus"]==4 && $optType==1)){
			$rd["msg"] = "操作失败，订单状态已发生改变，请刷新后再重试 !";
			return $rd;
		}
		$shopId = $rsv["shopId"];
        //收货则给用户增加积分
       
        $sql = "UPDATE __PREFIX__orders set orderStatus = 4,receiveTime='".date("Y-m-d H:i:s")."',settlementId=-1 WHERE orderFlag=1 and orderId = $orderId and userId=".$userId;			
       	$flag =$this->execute($sql);
       	if($flag!==false){
       		
       		if($rsv["payType"]==1){
				//结算给商家
				$spUserId = M("shops")->where(array("shopId"=>$shopId))->getField("userId");
			
	       		$poundageMoney = $rsv["poundageMoney"];
	       		$totalCommission = $rsv["totalCommission"];
	       		$data = array();
	       		$settlementMoney = WSTBCMoney($rsv['totalMoney'], $rsv['deliverMoney'])-WSTBCMoney($rsv['poundageMoney'], $rsv['totalCommission']);
	       		$data["userMoney"] = array("exp", "userMoney+".$settlementMoney);
	       		M("users")->where(array("userId"=>$spUserId))->save($data);
	       		$moneyRemark = "订单【".$rsv["orderNo"]."】结算";
	       		WSTMoneyLog(0, $spUserId, $moneyRemark, 1, $orderId, $settlementMoney, 0, 0, 1);
	      
	       		//生成结算单
	       		$data = array();
	       		$data['settlementType'] = 0;
	       		$data['shopId'] = $shopId;
	       		$data['accName'] = "";
	       		$data['accNo'] = "";
	       		$data['accUser'] = "";
	       		$data['createTime'] = date('Y-m-d H:i:s');
	       		$data['orderMoney'] = $rsv['totalMoney']+$rsv['deliverMoney'];
	       		$data['settlementMoney'] = $settlementMoney;
	       		$data['poundageMoney'] = $poundageMoney;
	       		$data['totalCommission'] = $totalCommission;
	       		$data['isFinish'] = 1;
	       		$data['finishTime'] = date("Y-m-d H:i:s");
	       		$settlementId = M('order_settlements')->add($data);
	       		if(false !== $settlementId){
	       			$sql = "update __PREFIX__order_settlements set settlementNo='".date('y').sprintf("%08d", $settlementId)."' where settlementId=".$settlementId;
	       			$this->execute($sql);
	       			
	       			$sql = "update __PREFIX__orders set settlementId=".$settlementId." where orderId=".$orderId;
	       			$this->execute($sql);
	       		}
       		}
       		
	        //修改商品销量
	        $sql = "select o.orderFrom,o.orderFromId,og.goodsId, sum(og.goodsNums) gcnt FROM __PREFIX__order_goods og, __PREFIX__orders o WHERE o.orderFlag=1 and og.orderId = o.orderId AND o.orderId=$orderId AND o.userId=".$userId." group by og.goodsId";
	        $ogoods = $this->query($sql);
	        for ($i = 0; $i < count($ogoods); $i++) {
	        	$row = $ogoods[$i];
	        	$orderFrom = $row["orderFrom"];
	        	if($orderFrom==2){
	        		$orderFromId = $row["orderFromId"];
	        		$sql="update __PREFIX__groups_goods set saleCnt=saleCnt+".$row['gcnt']." where id=".$orderFromId;
	        		$this->execute($sql);
	        	}elseif($orderFrom==3){
	        		$orderFromId = $row["orderFromId"];
	        		$sql="update __PREFIX__panics_goods set saleCnt=saleCnt+".$row['gcnt']." where id=".$orderFromId;
	        		$this->execute($sql);
	        	}else{
	        		$sql = "UPDATE __PREFIX__goods SET saleCount=saleCount+".$row['gcnt']." WHERE goodsId=".$row['goodsId'];
	        		$this->execute($sql);
	        	}
	        	
	       	}
	        //修改积分
	       	if($GLOBALS['CONFIG']['isOrderScore']==1 && $rsv["orderScore"]>0){
		       	$sql = "UPDATE __PREFIX__users set userScore=userScore+".$rsv["orderScore"].",userTotalScore=userTotalScore+".$rsv["orderScore"]." WHERE userId=".$userId;
		        $this->execute($sql);
		        	
		        $data = array();
		       	$m = M('user_score');
		        $data["userId"] = $userId;
		       	$data["score"] = $rsv["orderScore"];
		       	$data["dataSrc"] = 1;
		        $data["dataId"] = $orderId;
		        $data["dataRemarks"] = "交易获得";
		       	$data["scoreType"] = 1;
		        $data["createTime"] = date('Y-m-d H:i:s');
		       	$m->add($data);
	        }
	        //积分支付支出
	        if($rsv["scoreMoney"]>0){
	        	$data = array();
	        	$m = M('log_sys_moneys');
	        	$data["targetType"] = 0;
	        	$data["targetId"] = $userId;
	        	$data["dataSrc"] = 2;
	        	$data["dataId"] = $orderId;
	        	$data["moneyRemark"] = "订单【".$rsv["orderNo"]."】支付 ".$rsv["useScore"]." 个积分，支出 ￥".$rsv["scoreMoney"];
	        	$data["moneyType"] = 2;
	        	$data["money"] = $rsv["scoreMoney"];
	        	$data["createTime"] = date('Y-m-d H:i:s');
	        	$data["dataFlag"] = 1;
	        	$m->add($data);
	        }
	        //收取订单佣金
	       	if($rsv["poundageMoney"]>0){
	        	$data = array();
	        	$m = M('log_sys_moneys');
	        	$data["targetType"] = 1;
	        	$data["targetId"] = $rsv["shopId"];
	        	$data["dataSrc"] = 1;
	        	$data["dataId"] = $orderId;
	        	$data["moneyRemark"] = "收取订单【".$rsv["orderNo"]."】".$rsv["poundageRate"]."%的佣金 ￥".$rsv["poundageMoney"];
	        	$data["moneyType"] = 1;
	        	$data["money"] = $rsv["poundageMoney"];
	        	$data["createTime"] = date('Y-m-d H:i:s');
	        	$data["dataFlag"] = 1;
	        	$m->add($data);
	        }
	        	
	        //是否第一次购买
	        $sql = "select isBuyer from __PREFIX__users where userId = ".$userId;
			$userbuy = $this->queryRow($sql);
	        if($userbuy['isBuyer']==0){
	        	$u = M('users');
	        	$data = array();
	        	$data["isBuyer"] = 1;
	        	$u->where('userId='.$userId)->save($data);
	       	}
	        //分销
	       	if($rsv['distributType']>0){
	        	$sql = "select * from __PREFIX__distribut_users where buyerId=".$userId;
	        	$dis= $this->queryRow($sql);
	        	$promoterUser = D('Home/users')->getSimpInfo($dis['userId'],',userMoney,distributMoney');//推广者信息
	        	$buyerUser = D('Home/users')->getSimpInfo($userId,',userMoney,distributMoney');//购买者信息
	        	if($rsv['distributType']==1){//按商品设置
	        		$ogoods = M('order_goods')->where('orderId='.$rsv['orderId'])->field("goodsId,goodsName,goodsNums,goodsPrice,commission")->select();
	        		foreach($ogoods as $k=>$v){
	        			if($v['commission']>0){
		        			$promoterMoney = $buyerMoney = 0;
		        			$promoterMoney = round(($v['goodsNums']*$v['commission']*$rsv['promoterRate']/100),2);
		        			$buyerMoney = round(($v['goodsNums']*$v['commission']*$rsv['buyerRate']/100),2);
		        			//分销分成记录表
		        			$obj = array();
		        			$obj["shopId"] = $shopId;
		        			$obj["orderId"] = $rsv["orderId"];
		        				
		        			$obj["promoterId"] = $dis['userId'];
		        			$obj["buyerId"] = $rsv["userId"];
		        			$obj["moneyRemark"] = "商品【".$v["goodsName"]."】";
		        			$obj["distributType"] = 1;
		        			$obj["dataId"] = $v["goodsId"];
		        			$obj["money"] = $v["goodsPrice"];
		        			$obj["distributMoney"] = $promoterMoney;
		        			if($rsv['promoterRate']>0){
		        				$obj["userId"] = $dis['userId'];
		        				D('distribut_moneys')->addDistributMoneys($obj);//推广者
		        				//分成佣金
		        				$data = array();
		        				$data['distributMoney'] = $promoterMoney + $promoterUser['distributMoney'];
		        				$data['userMoney'] = $promoterMoney + $promoterUser['userMoney'];
		        					
		        				$data["userMoney"] = array("exp", "userMoney+".$promoterMoney);
		        				$data["distributMoney"] = array("exp", "distributMoney+".$promoterMoney);
		        				$allotMoney = M('users')->where("userId=".$dis['userId'])->save($data);
		        				if(false !== $allotMoney){
		        					//资金流水表
		        					$moneyRemark = "推广获得商品【".$v["goodsName"]."】".$rsv["promoterRate"]."%的佣金 ¥".$promoterMoney;
		        					WSTMoneyLog(0, $dis['userId'], $moneyRemark, 4, $v["goodsId"], $promoterMoney, 0, 0,1);
		        				}
		        			}
		        			$obj["distributMoney"] = $buyerMoney;
		        			if($rsv['buyerRate']>0){
		        				$obj["userId"] = $rsv["userId"];
		        				D('distribut_moneys')->addDistributMoneys($obj);//购买者
		        				//分成佣金
		        				$data = array();
		        				$data["userMoney"] = array("exp", "userMoney+".$buyerMoney);
		        				$data["distributMoney"] = array("exp", "distributMoney+".$buyerMoney);
		        				$allotMoney = M('users')->where("userId=".$rsv['userId'])->save($data);
		        				if(false !== $allotMoney){
		        					//资金流水表
		        					$moneyRemark = "购买获得商品【".$v["goodsName"]."】".$rsv["buyerRate"]."%的佣金 ¥".$buyerMoney;
		        					WSTMoneyLog(0, $rsv["userId"], $moneyRemark, 4, $v["goodsId"], $buyerMoney, 0, 0,1);
		        				}
		        			}
		        		}
		        	}
	        	}else if($rsv['distributType']==2){//按订单比例
	        		$promoterMoney = $buyerMoney = 0;
	        		$promoterMoney = round(($rsv['totalMoney']*$rsv['distributOrderRate']*$rsv['promoterRate']/10000),2);
	        		$buyerMoney = round(($rsv['totalMoney']*$rsv['distributOrderRate']*$rsv['buyerRate']/10000),2);
	        		//分销分成记录表
	        		$obj = array();
	        		$obj["shopId"] = $shopId;
	        		$obj["orderId"] = $rsv["orderId"];
	        		$obj["promoterId"] = $dis['userId'];
	        		$obj["buyerId"] = $rsv["userId"];
	        		$obj["moneyRemark"] = "订单【".$rsv["orderNo"]."】";
	        		$obj["distributType"] = 2;
	        		$obj["dataId"] = $rsv["orderId"];
	        		$obj["money"] = $rsv['totalMoney'];
	        		$obj["distributMoney"] = $promoterMoney;
	        		if($rsv['promoterRate']>0){
	        			$obj["userId"] = $dis['userId'];
	        			D('distribut_moneys')->addDistributMoneys($obj);//推广者
	        			//分成佣金
	        			$data = array();
	        			$data["userMoney"] = array("exp", "userMoney+".$promoterMoney);
	        			$data["distributMoney"] = array("exp", "distributMoney+".$promoterMoney);
	        			$allotMoney = M('users')->where("userId=".$dis['userId'])->save($data);
	        			if(false !== $allotMoney){
	        				//资金流水表
	        				$moneyRemark = "推广获得订单【".$rsv["orderNo"]."】".$rsv["promoterRate"]."%的佣金 ¥".$promoterMoney;
	        				WSTMoneyLog(0, $dis['userId'], $moneyRemark, 4, $rsv["orderId"], $promoterMoney, 0, 0,1);
	        			}
	        		}
	        		$obj["distributMoney"] = $buyerMoney;
	        		if($rsv['buyerRate']>0){
	        			$obj["userId"] = $rsv['userId'];
	        			D('distribut_moneys')->addDistributMoneys($obj);//购买者
	        			//分成佣金
	        			$data = array();
	        			$data["userMoney"] = array("exp", "userMoney+".$buyerMoney);
	        			$data["distributMoney"] = array("exp", "distributMoney+".$buyerMoney);
	        			$allotMoney = M('users')->where("userId=".$rsv['userId'])->save($data);
	        			if(false !== $allotMoney){
	        				//资金流水表
	        				$moneyRemark = "购买获得订单【".$rsv["orderNo"]."】".$rsv["buyerRate"]."%的佣金 ¥".$buyerMoney;
	        				WSTMoneyLog(0, $rsv["userId"], $moneyRemark, 4, $rsv["orderId"], $buyerMoney, 0, 0,1);
	        			}
	        		}
	        	}
	        }
	        
			WSTOrderLog($orderId, "用户已收货".($optType==1?"【管理员裁定】":""), $userId);
       	}
		$rd["status"] = 1;
		$rd["msg"] = "操作成功";
		return $rd;
	}
	
	
	
	/**
	 * 团购下单
	 */
	public function submitGroupOrder(){
		$rd = array('status'=>-1);
		$USER = session('WST_USER');
		$goodsmodel = D('Home/Goods');
		$morders = D('Home/Orders');
		$totalMoney = 0;
		$totalCnt = 0;
		$userId = (int)session('WST_USER.userId');
	
		$orderunique = WSTGetMillisecond().$userId;
		$id = (int)session("WST_group_id");
		$cnt = (int)session("WST_group_cnt");
		$mgoods = D('Home/Goods');
		$goodsStock = array();
		
		$gpm = D('Common/Groups');
		$groupRd = $gpm->checkGroupGoods($id,$cnt);
		
		$cartgoods = array();
		$order = array();
		if($groupRd['status']==-1){
			$rd['msg'] = $groupRd["msg"];
			return $rd;
		}else{
			
			$sql = "select * from __PREFIX__groups_goods where id = $id and goodsStatus=2 and dataFlag = 1";
			$group = $this->queryRow($sql);
			//整理及核对数据
			$goodsId = (int)$group["goodsId"];
			$goods = $goodsmodel->getGoodsSimpInfo($goodsId,0);
			$goods["goodsStock"] = $group["goodsStock"];
			$goods["shopPrice"] = $group["groupMoney"];
			//核对商品是否符合购买要求
			if(empty($goods)){
				$rd['msg'] = '找不到指定的商品!';
				return $rd;
			}
			if($goods['goodsStock']<=0){
				$rd['msg'] = '对不起，商品'.$goods['goodsName'].'库存不足!';
				return $rd;
			}
			if($goods['isSale']!=1){
				$rd['msg'] = '对不起，商品库'.$goods['goodsName'].'已下架!';
				return $rd;
			}
			$goods["cnt"] = $cnt;
			
			$cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
			$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
			$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺免运费最低金额
			$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cnt;
			$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$group["groupMoney"]);

			M()->startTrans();
			try{
				$ordersInfo = self::addGroupOrders($userId,$cartgoods,$orderunique,2,$id);
				if($ordersInfo["status"]==1){
					$rd['orderIds'] = implode(",",$ordersInfo["orderIds"]);
					$rd['isPay'] = $ordersInfo["isPay"];
					$rd['status'] = 1;
					session("WST_ORDER_UNIQUE",$orderunique);
					M()->commit();
					session("WST_group_id",null);
					session("WST_group_cnt",null);
				}else{
					M()->rollback();
					$rd['msg'] = '用户帐户余额不足，请选择其他支付方式!';
				}
			}catch(Exception $e){
				M()->rollback();
				$rd['msg'] = '下单出错，请联系管理员!';
			}
			return $rd;
		}
	}
    
	
	/**
	 * 抢购下单
	 */
	public function submitPanicOrder(){
		$rd = array('status'=>-1);
		$USER = session('WST_USER');
		$goodsmodel = D('Home/Goods');
		$morders = D('Home/Orders');
		$totalMoney = 0;
		$totalCnt = 0;
		$userId = (int)session('WST_USER.userId');
	
		$orderunique = WSTGetMillisecond().$userId;
		$id = (int)session("WST_panic_id");
		$cnt = (int)session("WST_panic_cnt");
		$mgoods = D('Home/Goods');
		$goodsStock = array();
	
		$gpm = D('Common/Panics');
		$panicRd = $gpm->checkPanicGoods($id,$cnt);
	
		$cartgoods = array();
		$order = array();
		if($panicRd['status']==-1){
			$rd['msg'] = $panicRd["msg"];
			return $rd;
		}else{
				
			$sql = "select * from __PREFIX__panics_goods where id = $id and goodsStatus=2 and dataFlag = 1";
			$panic = $this->queryRow($sql);
			//整理及核对数据
			$goodsId = (int)$panic["goodsId"];
			$goods = $goodsmodel->getGoodsSimpInfo($goodsId,0);
			$goods["goodsStock"] = $panic["goodsStock"];
			$goods["shopPrice"] = $panic["panicMoney"];
			//核对商品是否符合购买要求
			if(empty($goods)){
				$rd['msg'] = '找不到指定的商品!';
				return $rd;
			}
			if($goods['goodsStock']<=0){
				$rd['msg'] = '对不起，商品'.$goods['goodsName'].'库存不足!';
				return $rd;
			}
			if($goods['isSale']!=1){
				$rd['msg'] = '对不起，商品库'.$goods['goodsName'].'已下架!';
				return $rd;
			}
			$goods["cnt"] = $cnt;
				
			$cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
			$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
			$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺免运费最低金额
			$cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"]+$cnt;
			$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$panic["panicMoney"]);
	
			M()->startTrans();
			try{
				$ordersInfo = self::addGroupOrders($userId,$cartgoods,$orderunique,3,$id);
				if($ordersInfo["status"]==1){
					$rd['orderIds'] = implode(",",$ordersInfo["orderIds"]);
					$rd['isPay'] = $ordersInfo["isPay"];
					$rd['status'] = 1;
					session("WST_ORDER_UNIQUE",$orderunique);
					M()->commit();
					session("WST_panic_id",null);
					session("WST_panic_cnt",null);
				}else{
					M()->rollback();
					$rd['msg'] = '用户帐户余额不足，请选择其他支付方式!';
				}
			}catch(Exception $e){
				M()->rollback();
				$rd['msg'] = '下单出错，请联系管理员!';
			}
			return $rd;
		}
	}
	
	/**
	 * 生成订单
	 */
	public function addGroupOrders($userId,$cartgoods,$orderunique,$orderFrom,$id){
	
		$consigneeId = (int)I("consigneeId");
		$payway = (int)I("payway");
		$isself = (int)I("isself");
		$needreceipt = (int)I("needreceipt");
		
		$orderInfos = array();
		$orderIds = array();
		$orderNos = array();
		$remarks = I("remarks");
		$m = D('Home/UserAddress');
		$addressInfo = $m->getAddressDetails($consigneeId);
	
		$isPay = 1;
		foreach ($cartgoods as $key=> $shopgoods){
			$m = M('orderids');
			//生成订单ID
			$orderSrcNo = $m->add(array('rnd'=>time()));
			$orderNo = $orderSrcNo."".(fmod($orderSrcNo,7));
			//创建订单信息
			$data = array();
			$pshopgoods = $shopgoods["shopgoods"];
			$shopId = $pshopgoods[0]["shopId"];
				

			$data["orderNo"] = $orderNo;
			$data["shopId"] = $shopId;
			$deliverType = intval($pshopgoods[0]["deliveryType"]);
			$data["userId"] = $userId;
	
			$data["orderFlag"] = 1;
			$data["totalMoney"] = $shopgoods["totalMoney"];
			if($isself==1){//自提
				$deliverMoney = 0;
			}else{
				$deliverMoney = ($shopgoods["totalMoney"]<$shopgoods["deliveryFreeMoney"])?$shopgoods["deliveryMoney"]:0;
			}
			$data["deliverMoney"] = $deliverMoney;
			$data["payType"] = $payway;
			$data["deliverType"] = $deliverType;
			$data["userName"] = $addressInfo["userName"];
			$data["areaId1"] = $addressInfo["areaId1"];
			$data["areaId2"] = $addressInfo["areaId2"];
			$data["areaId3"] = $addressInfo["areaId3"];
			$data["communityId"] = $addressInfo["communityId"];
			$data["userAddress"] = $addressInfo["paddress"]." ".$addressInfo["address"];
			$data["userTel"] = $addressInfo["userTel"];
			$data["userPhone"] = $addressInfo["userPhone"];
				
			$data['orderScore'] = floor($data["totalMoney"]);
			$data["isInvoice"] = $needreceipt;
			$data["orderRemarks"] = $remarks;
			$data["requireTime"] = I("requireTime");
			$data["invoiceClient"] = I("invoiceClient");
			$data["isAppraises"] = 0;
			$data["isSelf"] = $isself;

			$data["distributType"] = 0;
			$data["totalCommission"] = 0;

			//积分
			$isScorePay = (int)I("isScorePay",0);
			$scoreMoney = 0;
			$useScore = 0;
	
			if($GLOBALS['CONFIG']['poundageRate']>0){
				$data["poundageRate"] = (float)$GLOBALS['CONFIG']['poundageRate'];
				$data["poundageMoney"] = WSTBCMoney($data["totalMoney"] * $data["poundageRate"] / 100,0,2);
			}else{
				$data["poundageRate"] = 0;
				$data["poundageMoney"] = 0;
			}
			if($GLOBALS['CONFIG']['isOpenScorePay']==1 && $isScorePay==1){//积分支付
				$baseScore = WSTOrderScore();
				$baseMoney = WSTScoreMoney();
				$sql = "select userId,userScore from __PREFIX__users where userId=$userId";
				$user = $this->queryRow($sql);
				$useScore = $baseScore*floor($user["userScore"]/$baseScore);
				$scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
				$orderTotalMoney = $shopgoods["totalMoney"]+$deliverMoney;
				if($orderTotalMoney<$scoreMoney){//订单金额小于积分金额
					$useScore = $baseScore*floor($orderTotalMoney/$baseMoney);
					$scoreMoney = $baseMoney*floor($orderTotalMoney/$baseMoney);
				}
				$data["useScore"] = $useScore;
				$data["scoreMoney"] = $scoreMoney;
			}
			$data["realTotalMoney"] = $shopgoods["totalMoney"] + $deliverMoney - $scoreMoney;
			$needPay = $data["realTotalMoney"];
			$data["needPay"] = $data["realTotalMoney"];
			$data["couponMoney"] = 0;
			$data["createTime"] = date("Y-m-d H:i:s");
			if($payway==1){
				$data["orderStatus"] = -2;
			}else{
				$data["orderStatus"] = 0;
			}
				
			$data["orderunique"] = $orderunique;
			$data["isPay"] = 0;
			if($data["needPay"]==0){
				$data["isPay"] = 1;
				$data["orderStatus"] = 0;
			}else{
				$isPay = 0;
			}
				
			$morders = M('orders');
			$data["orderFromId"] = $id;
			$data["orderFrom"] = $orderFrom;
			$orderId = $morders->add($data);
				
			//订单创建成功则建立相关记录
			if($orderId>0){
	
				if($GLOBALS['CONFIG']['isOpenScorePay']==1 && $isScorePay==1 && $useScore>0){//积分支付
					$sql = "UPDATE __PREFIX__users set userScore=userScore-".$useScore." WHERE userId=".$userId;
					$rs = $this->execute($sql);
	
					$data = array();
					$m = M('user_score');
					$data["userId"] = $userId;
					$data["score"] = $useScore;
					$data["dataSrc"] = 1;
					$data["dataId"] = $orderId;
					$data["dataRemarks"] = "订单支付-扣积分";
					$data["scoreType"] = 2;
					$data["createTime"] = date('Y-m-d H:i:s');
					$m->add($data);
				}
	
				$orderIds[] = $orderId;
				//建立订单商品记录表
				$mog = M('order_goods');
				foreach ($pshopgoods as $key=> $sgoods){
					$data = array();
					$data["orderId"] = $orderId;
					$data["goodsId"] = $sgoods["goodsId"];
					$data["goodsAttrId"] = (int)$sgoods["goodsAttrId"];
					if($sgoods["attrVal"]!='')$data["goodsAttrName"] = $sgoods["attrName"].":".$sgoods["attrVal"];
					$data["goodsNums"] = $sgoods["cnt"];
					$data["goodsPrice"] = $sgoods["shopPrice"];
					$data["goodsName"] = $sgoods["goodsName"];
					$data["goodsThums"] = $sgoods["goodsThums"];
					$data["commission"] = 0;
					$mog->add($data);
				}
					
				if($payway==1){
					$content = "订单已提交，等待支付";
					WSTOrderLog($orderId, $content, $userId,0);
				}else{
					if($payway==2){//余额支付
						$content = "订单已提交，等待支付";
						WSTOrderLog($orderId, $content, $userId,0);
						$userMoney = M("users")->where(array("userId"=>$userId))->getField("userMoney");
						if($userMoney>=$needPay){
							M("users")->where(array("userId"=>$userId))->setDec("userMoney",$needPay);
							WSTMoneyLog(0, $userId, "支付订单【".$orderNo."】", 5, $orderId, $needPay, 0, 2, 0);
							M("orders")->where(array("orderId"=>$orderId))->save(array("isPay"=>1,"needPay"=>0));
								
							$content = "订单已支付,下单成功";
							WSTOrderLog($orderId, $content, $userId,0);
						}else{
							return array("orderIds"=>'',"isPay"=>0,"status"=>0);
						}
					}else{
						//建立订单记录
						$content = ($deliverType==0)? "下单成功":"下单成功等待审核";
						WSTOrderLog($orderId, $content, $userId,0);
					}
	
					//建立订单提醒
					$sql ="SELECT userId,shopId,shopName FROM __PREFIX__shops WHERE shopId=$shopId AND shopFlag=1  ";
					$users = $this->query($sql);
					$morm = M('order_reminds');
					for($i=0;$i<count($users);$i++){
						$data = array();
						$data["orderId"] = $orderId;
						$data["shopId"] = $shopId;
						$data["userId"] = $users[$i]["userId"];
						$data["userType"] = 0;
						$data["remindType"] = 0;
						$data["createTime"] = date("Y-m-d H:i:s");
						$morm->add($data);
					}
	
					foreach ($pshopgoods as $key=> $sgoods){
						if($orderFrom==2){
							$sql="update __PREFIX__groups_goods set goodsStock=goodsStock-".$sgoods['cnt'].",virtualBuyCnt=virtualBuyCnt+".$sgoods['cnt']." where id=".$id;
						}else{
							$sql="update __PREFIX__panics_goods set goodsStock=goodsStock-".$sgoods['cnt'].",virtualBuyCnt=virtualBuyCnt+".$sgoods['cnt']." where id=".$id;
						}
						$this->execute($sql);
					}
				}
			}
		}
	
		return array("orderIds"=>$orderIds,"isPay"=>$isPay,"status"=>1);
	
	}
}