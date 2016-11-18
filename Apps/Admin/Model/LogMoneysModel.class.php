<?php
namespace Admin\Model;
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
    public function queryByPage(){
		$key = WSTAddslashes(I('key'));
		$targetType = (int)I('targetType',-1);
		$moneyType = (int)I('moneyType',-1);
		$dataSrc = (int)I('dataSrc',-1);
		$startDate = I('startDate');
		$endDate = I('endDate');
		$sql = "select l.*,u.userName,u.loginName,s.shopName from __PREFIX__log_moneys l left join __PREFIX__users u on l.targetType=0 and targetId=u.userId 
		        left join __PREFIX__shops s on l.targetType=1 and targetId=s.shopId where l.dataFlag=1 ";
		if($targetType!=-1){
			$sql.=" and l.targetType=".$targetType;
		}
		if($moneyType!=-1)$sql.=" and l.moneyType=".$moneyType;
		if($dataSrc!=-1)$sql.=" and l.dataSrc=".$dataSrc;
		if($key!='')$sql.=" and l.moneyRemark like '%".$key."%'";
		if($startDate!=''){
			$startDate = date('Y-m-d',strtotime($startDate))." 00:00:00";
			if($startDate!='')$sql.=" and l.createTime >='".$startDate."'";
		}
        if($endDate!=''){
			$endDate = date('Y-m-d',strtotime($endDate))." 23:59:59";
			if($endDate!='')$sql.=" and l.createTime <='".$endDate."'";
		}
		$sql.=" order by l.createTime desc";
		$page = $this->pageQuery($sql,(int)I('p'),10);
		if(!empty($page['root'])){
			foreach ($page['root'] as $key =>$v){
				$page['root'][$key]['targetName'] = ($v['targetType']==1)?$v['shopName']:("【".$v['userName']."】");
			}
		}
		return $page;
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
}