<?php
namespace Admin\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 定时任务控制器
 */
class CronJobsAction extends BaseAction{
	public function checkLocation(){
		if('localhost'!=strtolower($_SERVER['HTTP_HOST'])){
			WSTLog("Apps/Runtime/Logs/url.log",strtolower($_SERVER['HTTP_HOST'])."--denied",true);
			exit();
		}
	}
	
	/**
	 * 自动收货
	 */
	public function autoReceivie(){
		$this->checkLocation();
		WSTLog("Apps/Runtime/Logs/autoReceivie.log","自动收货--start",true);
		$m = D('Admin/CronJobs');
		$m->autoReceivie();
		WSTLog("Apps/Runtime/Logs/autoReceivie.log","自动收货--end",true);
		echo "done";
	}

	/**
	 * 自动好评
	 */
	public function autoGoodAppraise(){
		$this->checkLocation();
		WSTLog("Apps/Runtime/Logs/autoGoodAappraise.log","自动好评--start",true);
		$m = D('Admin/CronJobs');
		$m->autoGoodAppraise();
		WSTLog("Apps/Runtime/Logs/autoGoodAappraise.log","自动好评--end",true);
		echo "done";
	}
	/**
	 * 自动结算
	 */
	public function autoSettlement(){
		$this->checkLocation();
		WSTLog("Apps/Runtime/Logs/autoSettlement.log","自动好评--start",true);
		$m = D('Admin/CronJobs');
		$m->autoSettlement();//7天自动好评
		WSTLog("Apps/Runtime/Logs/autoSettlement.log","自动好评--end",true);
		echo "done";
	}
}