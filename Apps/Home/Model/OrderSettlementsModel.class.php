<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单结算服务类
 */
class OrderSettlementsModel extends BaseModel {
	/**
	 * 获取结算列表
	 */
	public function querySettlementsByPage(){
		$settlementNo = WSTAddslashes(I('settlementNo',-1));
		$isFinish = (int)I('isFinish');
		$shopId = (int)session('WST_USER.shopId');
		$sql = "select * from __PREFIX__order_settlements where shopId=".$shopId;
		if($settlementNo!='')$sql.=" and  settlementNo like '%".$settlementNo."%'";
		if($isFinish>-1)$sql.=" and isFinish=".$isFinish;
		$sql.=" order by settlementId desc";
		return  $this->pageQuery($sql,(int)I('p'),30);
	}
    /**
	  * 获取未结算列表[在线付款 && 用户已收货]
	  */
	public function queryUnSettlementOrdersByPage(){
		$shopId = (int)session('WST_USER.shopId');
		$orderNo = WSTAddslashes(I('orderNo'));
		$userName = WSTAddslashes(I('userName'));
		$sql = "SELECT orderNo,orderId,userName,totalMoney,deliverMoney,realTotalMoney,poundageRate,poundageMoney,createTime FROM __PREFIX__orders o 
		    WHERE o.settlementId=0 and o.orderStatus=4 and o.payType=1 and o.shopId = $shopId ";
		if($orderNo!='')$sql.=" and o.orderNo like '%".$orderNo."%'";
		if($userName!='')$sql.=" and o.userName like '%".$userName."%'";
		$sql.=" order by o.orderId desc";
		return  $this->pageQuery($sql,(int)I('p'),30);
	}
	/**
	 * 获取已结算订单列表
	 */
	public function querySettlementsOrdersByPage(){
		$shopId = (int)session('WST_USER.shopId');
		$orderNo = WSTAddslashes(I('orderNo'));
		$settlementNo = WSTAddslashes(I('settlementNo',-1));
		$isFinish = (int)I('isFinish');
		$sql = "SELECT o.orderNo,o.orderId,o.userName,o.totalMoney,o.deliverMoney,o.realTotalMoney,os.settlementMoney,o.poundageRate,o.poundageMoney,o.createTime,os.settlementNo ,os.finishTime
		    FROM __PREFIX__orders o ,__PREFIX__order_settlements os
		    WHERE os.settlementId=o.settlementId and  o.settlementId>0 and o.orderStatus=4 and o.payType=1 and o.shopId = $shopId ";
		if($orderNo!='')$sql.=" and o.orderNo like '%".$orderNo."%'";
		if($settlementNo!='')$sql.=" and  os.settlementNo like '%".$settlementNo."%'";
		if($isFinish>-1)$sql.=" and os.isFinish=".$isFinish;
		$sql.=" order by o.settlementId desc";
		return  $this->pageQuery($sql,(int)I('p'),30);
	}
	/**
	 * 申请结算
	 */
	public function settlement(){
		$shopId = (int)session('WST_USER.shopId');
		$ids = WSTFormatIn(",", I('ids'));
		$sql = "select bankName,bankNo,bankUserName from __PREFIX__shops s 
		        left join __PREFIX__banks b on b.bankId=s.bankId where s.shopId=".$shopId;
		$accRs = $this->queryRow($sql);
		if(empty($accRs))return array('status'=>-1,'msg'=>'无效的结算账户!');
		$sql = "select orderId,orderNo,totalMoney,deliverMoney,realTotalMoney,poundageMoney from __PREFIX__orders where shopId=".$shopId." and orderId in(".$ids.") and settlementId=0 and orderStatus=4 and payType=1";
		$rs = $this->query($sql);
		if(empty($rs))return array('status'=>-1,'msg'=>'申请结算失败，请核对订单状态是否已申请结算了!');
		$orderMoney = 0;
		$settlementMoney = 0;
		$poundageMoney = 0;
		foreach ($rs as $key =>$v){
			$orderMoney += $v['totalMoney']+$v['deliverMoney'];
			$settlementMoney +=($v['totalMoney']+$v['deliverMoney']-$v['poundageMoney']);
			$poundageMoney+=$v['poundageMoney'];
		}
		$settlementStartMoney = floatval($GLOBALS['CONFIG']['settlementStartMoney']);
		if($settlementStartMoney>$orderMoney)return array('status'=>-1,'msg'=>'结算总金额必须大于'.$settlementStartMoney."才能申请结算!");
		//建立结算记录
		$data = array();
		$data['settlementType'] = 0;
		$data['shopId'] = $shopId;
		$data['accName'] = $accRs['bankName'];
		$data['accNo'] = $accRs['bankNo'];
		$data['accUser'] = $accRs['bankUserName'];
		$data['createTime'] = date('Y-m-d H:i:s');
		$data['orderMoney'] = $orderMoney;
		$data['settlementMoney'] = $settlementMoney;
		$data['poundageMoney'] = $poundageMoney;
		$data['isFinish'] = 0;
		$settlementId = M('order_settlements')->add($data);
		if(false !== $settlementId){
			$sql = "update __PREFIX__order_settlements set settlementNo='".date('y').sprintf("%08d", $settlementId)."' where settlementId=".$settlementId;
			$this->execute($sql);
			foreach ($rs as $key =>$v){
				$sql = "update __PREFIX__orders set settlementId=".$settlementId." where orderId=".$v['orderId'];
				$this->execute($sql);
			}
			return array('status'=>1);
		}
		return array('status'=>1,'msg'=>'申请结算失败，请与管理员联系。');
	}
    
}