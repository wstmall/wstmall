<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 分销佣金记录服务类
 */
class DistributMoneysModel extends BaseModel {
	
	/**
	 * 添加分成记录
	 */
	public function addDistributMoneys($obj){
		$data = array();
		$dm = M('distribut_moneys');
		$data["shopId"] = $obj['shopId'];
		$data["orderId"] = $obj['orderId'];
		$data["userId"] = $obj['userId'];
		$data["promoterId"] = $obj["promoterId"];
		$data["buyerId"] = $obj["userId"];
		$data["moneyRemark"] = $obj["moneyRemark"];
		$data["distributType"] = $obj["distributType"];
		$data["dataId"] = $obj["dataId"];
		$data["money"] = $obj["money"];
		$data["distributMoney"] = $obj["distributMoney"];
		$data["createTime"] = date('Y-m-d H:i:s');
		$dm->add($data);
		$rd = array('status'=>1);
		return $rd;
	}
	
	/**
	 * 店铺分成记录
	 */
	public function queryShopDistributMoneys(){
		$shopId = session('WST_USER.shopId');
		$userName = WSTAddslashes(I("userName"));
		$orderNo = WSTAddslashes(I("orderNo"));
		$startDate = WSTAddslashes(I("startDate"));
		$endDate = WSTAddslashes(I("endDate"));
		$settlementId = (int)I("settlementId",-999);
		$sql = "select m.*, o.orderNo,o.settlementId, u.userName, u.loginName from __PREFIX__distribut_moneys m, __PREFIX__users u, __PREFIX__orders o
				where m.shopId=$shopId and o.orderId=m.orderId and m.userId=u.userId";
		if($userName!="") $sql .= " and (u.userName like '%".$userName."%' or u.loginName like '%".$userName."%') ";
		if($orderNo!="") $sql .= " and o.orderNo like '%".$orderNo."%'";
		if($settlementId>=0)  $sql .= " and o.settlementId = $settlementId";
		if($startDate!=""){
			$sql .= " and m.createTime >='".$startDate."'";
		}
		if($endDate!=""){
			$sql .= " and m.createTime <='".$endDate."'";
		}
		$sql .= " order by createTime";
		$pages = $this->pageQuery($sql);
		return $pages;
	}
	
	/**
	 * 用户分成记录
	 */
	public function queryUserDistributMoneys(){
		$userId = session('WST_USER.userId');
		$userName = WSTAddslashes(I("userName"));
		$orderNo = WSTAddslashes(I("orderNo"));
		$startDate = WSTAddslashes(I("startDate"));
		$endDate = WSTAddslashes(I("endDate"));
		$sql = "select m.*, o.orderNo , u.userName, u.loginName from __PREFIX__distribut_moneys m, __PREFIX__users u, __PREFIX__orders o
				where o.orderId=m.orderId and m.userId=$userId and u.userId=o.userId ";
		if($userName!="") $sql .= " and (u.userName like '%".$userName."%' or u.loginName like '%".$userName."%') ";
		if($orderNo!="") $sql .= " and o.orderNo like '%".$orderNo."%'";
		if($startDate!=""){
			$sql .= " and m.createTime >='".$startDate."'";
		}
		if($endDate!=""){
			$sql .= " and m.createTime <='".$endDate."'";
		}
		$sql .= " order by createTime";
		$pages = $this->pageQuery($sql);
		return $pages;
	}
	
}