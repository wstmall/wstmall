<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 提现服务类
 */
class CashDrawsModel extends BaseModel {
	protected $tableName = 'cash_draws';
	/**
	 * 获取账号列表
	 */
    public function queryByPage($type){
		$sql = "select cd.*,b.bankName from __PREFIX__cash_draws cd left join __PREFIX__banks b on cd.accTargetId=b.bankId where ";
		if($type==0){
			$userId = (int)session('WST_USER.userId');
			$sql.=" cd.targetType = 0 and cd.targetId=".$userId;
		}
        if($type==1){
        	$shopId = (int)session('WST_USER.shopId');
			$sql.=" cd.targetType = 1 and cd.targetId=".$shopId;
		}
		$startDate = I('startDate');
		$endDate = I('endDate');
        if($startDate!=''){
			$startDate = date('Y-m-d',strtotime($startDate))." 00:00:00";
			if($startDate!='')$sql.=" and cd.createTime >='".$startDate."'";
		}
        if($endDate!=''){
			$endDate = date('Y-m-d',strtotime($endDate))." 23:59:59";
			if($endDate!='')$sql.=" and cd.createTime <='".$endDate."'";
		}
		$sql.=" order by cd.createTime desc";
		$rd = array('status'=>1);
		$rd['data'] = $this->pageQuery($sql);
		return $rd;
	}
	
	/**
	 * 新增记录
	 */
	public function insert(){
		$shopId = (int)session('WST_USER.shopId');
		$userId = (int)session('WST_USER.userId');
		$rd = array('status'=>-1);
		//验证支付密码
		if(empty(I('payPwd'))){
			$rd['msg'] = '请输入支付密码';
			return $rd;
		}
		$sql = "select payPwd,loginSecret from __PREFIX__users where userId=".$userId;
		$user = $this->queryRow($sql);
		if($user['payPwd']!=md5(I("payPwd").$user['loginSecret'])){
			$rd['msg'] = '支付密码不正确';
			return $rd;
		}
		//获取提现账号信息
	    if((int)I('configId')==0){
			$rd['msg'] = '请选择提现账号!';
			return $rd;
		}
		$sql = "select l.*,b.bankName from __PREFIX__cash_configs l 
		         left join __PREFIX__banks b on l.accTargetId=b.bankId
		         where l.dataFlag=1 and l.userId=".$userId." and l.id=".(int)I('configId');
		$config =  $this->queryRow($sql);
	    if(empty($config)){
			$rd['msg'] = '对不起,您的提现账号不存在!';
			return $rd;
		}
	    $money = (double)I('drawMoney');
		if($money<=0){
			$rd['msg'] = '提现金额必须大于0!';
			return $rd;
		}
		//判断提现金额是否允许
		$sql = "select shopMoney from __PREFIX__shops where shopId=".$shopId;
		$shop = $this->queryRow($sql);
		if($shop['shopMoney']<$money){
			$rd['msg'] = '对不起，您的可提现金额不足!';
			return $rd;
		}
		if($GLOBALS['CONFIG']['cashStartMoney']>$money){
			$rd['msg'] = '对不起，最低提现金额'.$GLOBALS['CONFIG']['cashStartMoney'].'元';
			return $rd;
		}
		$this->targetType = 1;
		$this->targetId = (int)session('WST_USER.shopId');
		$this->money = $money;
		$this->accType = $config['accType'];
		$this->accTargetId = $config['accTargetId'];
		$this->accNo = $config['accNo'];
		$this->accUser = $config['accUser'];
		$this->cashSatus = 0;
		$this->createTime = date('Y-m-d H:i:s');
		$this->cashConfigId = (int)I('configId');
		$id = $this->add();
		if(false !== $id){
			$data = array();
			$m = M('messages');
			$data["msgType"] = 0;
			$data["sendUserId"] = 0;
			$data["receiveUserId"] = $userId;
			$data["msgContent"] = "商家您申请提现 ¥".$money."已提交，预计明天24点前到帐！";
			$data["msgStatus"] = 0;
			$data["msgFlag"] = 1;
			$data["createTime"] = date('Y-m-d H:i:s');
			$m->add($data);
			$rd['status']= 1;
			$sql="update __PREFIX__shops set shopMoney=shopMoney-".$money.",lockMoney=lockMoney+".$money." where shopId=".$shopId;
			$this->execute($sql);
		}else{
			$rd['msg'] = $this->getError();
		}
		return $rd;
	}
	
     /**
	 * 新增用户记录
	 */
	public function insertByUser(){
		$userId = (int)session('WST_USER.userId');
		$rd = array('status'=>-1);
		//验证支付密码
		if(empty(I('payPwd'))){
			$rd['msg'] = '请输入支付密码';
			return $rd;
		}
		$sql = "select userMoney,payPwd,loginSecret from __PREFIX__users where userId=".$userId;
		$user = $this->queryRow($sql);
		if($user['payPwd']!=md5(I("payPwd").$user['loginSecret'])){
			$rd['msg'] = '支付密码不正确';
			return $rd;
		}
		//获取提现账号信息
	    if((int)I('configId')==0){
			$rd['msg'] = '请选择提现账号!';
			return $rd;
		}
		$sql = "select l.*,b.bankName from __PREFIX__cash_configs l 
		         left join __PREFIX__banks b on l.accTargetId=b.bankId
		         where l.dataFlag=1 and l.userId=".$userId." and l.id=".(int)I('configId');
		$config =  $this->queryRow($sql);
	    if(empty($config)){
			$rd['msg'] = '对不起,您的提现账号不存在!';
			return $rd;
		}
	    $money = (double)I('drawMoney');
		if($money<=0){
			$rd['msg'] = '提现金额必须大于0!';
			return $rd;
		}
		//判断提现金额是否允许
		if($user['userMoney']<$money){
			$rd['msg'] = '对不起，您的可提现金额不足!';
			return $rd;
		}
		if($GLOBALS['CONFIG']['cashStartMoney']>$money){
			$rd['msg'] = '对不起，最低提现金额'.$GLOBALS['CONFIG']['cashStartMoney'].'元';
			return $rd;
		}
		$this->targetType = 0;
		$this->targetId = $userId;
		$this->money = $money;
		$this->accType = $config['accType'];
		$this->accTargetId = $config['accTargetId'];
		$this->accNo = $config['accNo'];
		$this->accUser = $config['accUser'];
		$this->cashSatus = 0;
		$this->createTime = date('Y-m-d H:i:s');
		$this->cashConfigId = (int)I('configId');
		$id = $this->add();
		if(false !== $id){
			$data = array();
			$m = M('messages');
			$data["msgType"] = 0;
			$data["sendUserId"] = 0;
			$data["receiveUserId"] = $userId;
			$data["msgContent"] = "买家您申请提现 ¥".$money."已提交，预计明天24点前到帐！";
			$data["msgStatus"] = 0;
			$data["msgFlag"] = 1;
			$data["createTime"] = date('Y-m-d H:i:s');
			$m->add($data);
			$rd['status']= 1;
			$sql="update __PREFIX__users set userMoney=userMoney-".$money.",lockMoney=lockMoney+".$money." where userId=".$userId;
			$this->execute($sql);
		}else{
			$rd['msg'] = $this->getError();
		}
		return $rd;
	}
	
}