<?php
namespace Admin\Model;
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
    	$targetType = (int)I('targetType',-1);
		$sql = "select c.*,u.loginName,u.userName,s.shopName from __PREFIX__cash_draws c left join __PREFIX__users u on c.targetType=0 and targetId=u.userId 
		        left join __PREFIX__shops s on c.targetType=1 and targetId=s.shopId where 1=1 ";
        if($targetType!=-1){
        	$sql.=" and c.targetType=".$targetType;
        }
		$startDate = I('startDate');
		$endDate = I('endDate');
        if($startDate!=''){
			$startDate = date('Y-m-d',strtotime($startDate))." 00:00:00";
			if($startDate!='')$sql.=" and c.createTime >='".$startDate."'";
		}
        if($endDate!=''){
			$endDate = date('Y-m-d',strtotime($endDate))." 23:59:59";
			if($endDate!='')$sql.=" and c.createTime <='".$endDate."'";
		}
		$sql.=" order by c.createTime desc";
		$rs = $this->pageQuery($sql);
        if(!empty($rs['root'])){
			foreach ($rs['root'] as $key =>$v){
				$rs['root'][$key]['targetName'] = ($v['targetType']==1)?("【店铺】".$v['shopName']):("【会员】【".$v['userName']."】");
			}
		}
		return $rs;
	}
	
	/**
	 * 获取提现资料
	 */
	public function get(){
		$id = (int)I('id');
		$sql = "select* from __PREFIX__cash_draws c left join  u on c.targetType=0 and targetId=u.userId 
		        left join __PREFIX__shops s on c.targetType=1 and targetId=s.shopId where 1=1 ";
		$rs = $this->where('cashId='.$id)->find();
		if(!empty($rs)){
			if($rs['targetType']==0){
				$sql = "select loginName,userName from __PREFIX__users where userId=".$rs['targetId'];
				$urs = $this->queryRow($sql);
				$rs['userName'] = "【".$urs['loginName']."】".$urs['userName'];
			}
		    if($rs['targetType']==1){
				$sql = "select shopName from __PREFIX__shops where userId=".$rs['targetId'];
				$urs = $this->queryRow($sql);
				$rs['userName'] = $urs['shopName'];
			}
		}
		return $rs;
	}
	
	/**
	 * 处理提现
	 */
	public function handle(){
		$id = (int)I('id');
		$rd = array('status'=>-1,'msg'=>'操作失败!');
		//判断提现记录状态
		$sql="select * from __PREFIX__cash_draws where cashId=".$id;
		$rs = $this->queryRow($sql);
		if(empty($rs)){
			$rd['msg'] = '无效的提现记录';
			return $rd;
		}
		if($rs['cashSatus']==1){
			$rd['status'] = 1;
			$rd['msg'] = '提现记录已处理';
			return $rd;
		}
		if($rs['cashSatus']==0){
			$data = array();
			$data['cashSatus'] = 1;
			$data['cashRemarks'] = I('content');
			$data['handleTime'] = date('Y-m-d H:i:s');
			$flag = $this->where('cashId='.$id)->save($data);
			if($flag !== false){
				$userId = 0;
				//扣除用户冻结金额
				if($rs['targetType']==1){
					$sql = "update __PREFIX__shops set lockMoney=lockMoney-".$rs['money']." where shopId=".$rs['targetId'];
					$this->execute($sql);
					$sql = "select userId from __PREFIX__shops where shopId=".$rs['targetId'];
					$urs = $this->queryRow($sql);
					$userId = $urs['userId'];
				}
			    if($rs['targetType']==0){
					$sql = "update __PREFIX__users set lockMoney=lockMoney-".$rs['money']." where userId=".$rs['targetId'];
					$this->execute($sql);
					$userId = $rs['targetId'];
				}
				$rd['status']= 1;
				//增加流水记录
				$data = array();
				$data['targetType'] = $rs['targetType'];
				$data['targetId'] = $rs['targetId'];
				$data['dataId'] = $id;
				$data['dataSrc'] = 3;
				$data['moneyRemark'] = "申请提现￥".$rs['money'];
				$data['moneyType'] = 1;
				$data['money'] = $rs['money'];
				$data['createTime'] = date('Y-m-d H:i:s');
				$data['payType'] = 0;
				$data['dataFlag'] = 1;
				D('Home/log_moneys')->add($data);
				//发站内信
				$messsage = array(
						'msgType' => 0,
						'sendUserId' => session('WST_STAFF.staffId'),
						'receiveUserId' => $userId,
						'msgContent' => "您的".(($rs['targetType']==1)?"店铺":"会员")."提现申【￥".$rs['money']."】请已通过，提现金额正在快马加鞭的赶往您的提现账号中。",
						'createTime' => date('Y-m-d H:i:s'),
						'msgStatus' => 0,
						'msgFlag' => 1,
				);
				M('messages')->add($messsage);
				$rd['status'] = 1;
			    $rd['msg'] = '操作成功!';
			    return $rd;
			}
		}
		return $rd;
	}
}