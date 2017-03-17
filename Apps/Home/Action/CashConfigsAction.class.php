<?php
 namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 系统配置控制器
 */
class CashConfigsAction extends BaseAction{
	/**
	 * 跳去配置列表
	 */
	public function toEdit(){
		$this->isLogin();
		$object = array();
		if((int)I('id')>0){
			$object = D('Home/CashConfigs')->get((int)I('id'));
		}else{
			$object = D('Home/CashConfigs')->getModel('cash_configs');
		}
		$m = D('Home/Banks');
		$a = D('Home/Areas');
		$this->assign('areaList',$a->queryShowByList(0));
		$this->assign('shopInfo',$data);
		$list = $m->queryByList();
		$this->assign('bank',$list);
		$this->assign('object',$object);
		$this->display("shops/moneys/draw_config");
	}
	/**
	 * 获取配置列表
	 */
	public function queryByList(){
		$this->isLogin();
		$list = D('Home/CashConfigs')->queryByList();
		$this->ajaxReturn($list);
	}
	
	/**
	 * 保存账号配置
	 */
	public function edit(){
		$this->isLogin();
		if((int)I('id')>0){
		    $rs = D('Home/CashConfigs')->edit();
		}else{
			$rs = D('Home/CashConfigs')->insert();
		}
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除提现账号
	 */
	public function del(){
		$this->isLogin();
		$rs = D('Home/CashConfigs')->del();
		$this->ajaxReturn($rs);
	}
};

?>