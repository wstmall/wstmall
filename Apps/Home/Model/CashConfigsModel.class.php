<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 提现配置服务类
 */
class CashConfigsModel extends BaseModel {
	protected $tableName = 'cash_configs';
	
	protected $_validate = array(
	     array('accNo','require','请输入提现账号!',1),
		 array('accUser','require','请输入持有人!',1)
	);
	
	/**
	 * 获取指定记录
	 */
	public function get($id){
		$userId = (int)session('WST_USER.userId');
		$sql = "select l.*,b.bankName from __PREFIX__cash_configs l 
		         left join __PREFIX__banks b on l.accTargetId=b.bankId
		         where l.dataFlag=1 and l.userId=".$userId." and l.id=".$id;
		$rs = $this->queryRow($sql);
		$rs['areaId1'] = D('Home/Areas')->getCurrentProvinceId($rs['areaId2']);
		return $rs;
	}
	/**
	 * 获取账号列表
	 */
    public function queryByList(){
		$userId = (int)session('WST_USER.userId');
		$sql = "select l.*,b.bankName, a1.areaName areaName1, a2.areaName areaName2 from __PREFIX__cash_configs l 
		         left join __PREFIX__banks b on l.accTargetId=b.bankId,
				__PREFIX__areas a1, __PREFIX__areas a2
		         where l.areaId2=a2.areaId and a2.parentId = a1.areaId and l.dataFlag=1 and l.userId=".$userId;
		$sql.=" order by createTime desc";
		$rd = array('status'=>1);
		$rd['data'] = $this->query($sql);
		return $rd;
	}
	
	/**
	 * 新增账号
	 */
	public function insert(){
		$rd = array('status'=>-1);
		
	    if((int)I('accTargetId')==0){
			$rd['msg'] = '请选择银行卡所属银行!';
			return $rd;
		}
		if((int)I('areaId2')==0){
			$rd['msg'] = '请选择完整地址!';
			return $rd;
		}
		if ($this->create()){
			$this->accType = 3;
			$this->userId = (int)session('WST_USER.userId');
		    $this->createTime = date('Y-m-d H:i:s');
			$this->dataFlag = 1;
			$id = $this->add();
			if(false !== $id){
				$rd['status']= 1;
			}
		}else{
			$rd['msg'] = $this->getError();
		}
		return $rd;
	}
	
	/**
	 * 编辑账号
	 */
	public function edit(){
		$rd = array('status'=>-1);
		$id = (int)I('id');
	    if((int)I('accTargetId')==0){
			$rd['msg'] = '请选择银行卡所属银行!';
			return $rd;
		}
		if((int)I('areaId2')==0){
			$rd['msg'] = '请选择完整地址!';
			return $rd;
		}
		if ($this->create()){
			$id = $this->where('id='.$id." and userId=".(int)session('WST_USER.userId'))->save();
			if(false !== $id){
				$rd['status']= 1;
			}
		}else{
			$rd['msg'] = $this->getError();
		}
		return $rd;
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$rd = array('status'=>-1);
		$userId = (int)session('WST_USER.userId');
		$id = (int)I('id');
		$this->dataFlag = -1;
		$rd['status'] = $this->where('id='.$id.' and userId='.$userId)->save();
		return $rd;
	}
	
}