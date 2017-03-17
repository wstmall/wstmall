<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 资金流水服务类
 */
class LogMoneysModel extends BaseModel {
	/**
	 * 资金流水
	 */
    public function loadMoneys(){
		$key = WSTAddslashes(I('key'));
		$moneyType = (int)I('moneyType');
		$dataSrc = (int)I('dataSrc');
		$startDate = I('startDate');
		$endDate = I('endDate');
		$shopId = (int)session('WST_USER.shopId');
		$userId = (int)session('WST_USER.userId');
		$sql = "select l.* from __PREFIX__log_moneys l where dataFlag=1 ";
		$sql.=" and targetType=0 and targetId=".$userId;
		if($moneyType!=-1)$sql.=" and moneyType=".$moneyType;
		if($dataSrc!=-1)$sql.=" and dataSrc=".$dataSrc;
		if($key!='')$sql.=" and moneyRemark like '%".$key."%'";
		if($startDate!=''){
			$startDate = date('Y-m-d',strtotime($startDate))." 00:00:00";
			if($startDate!='')$sql.=" and createTime >='".$startDate."'";
		}
        if($endDate!=''){
			$endDate = date('Y-m-d',strtotime($endDate))." 23:59:59";
			if($endDate!='')$sql.=" and createTime <='".$endDate."'";
		}
		$sql.=" order by createTime desc";
		$rd = array('status'=>1);
		
		$rd['data'] = $this->pageQuery($sql,(int)I('p'),10);
		return $rd;
	}
	
	/**
	 * 获取商家资金信息
	 */
	public function getShopMoneys(){
		$shopId = (int)session('WST_USER.shopId');
		$sql = "select shopMoney,lockMoney from __PREFIX__shops where shopId=".$shopId;
		$rs = $this->queryRow($sql);
		$rs['status'] = 1;
		return $rs;
	}
    /**
	 * 获取用户资金信息
	 */
	public function getUserMoneys(){
		$userId = (int)session('WST_USER.userId');
		$sql = "select userMoney,lockMoney from __PREFIX__users where userId=".$userId;
		$rs = $this->queryRow($sql);
		$rs['status'] = 1;
		return $rs;
	}
	
}