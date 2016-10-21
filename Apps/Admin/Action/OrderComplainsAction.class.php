<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单投诉控制器
 */
class OrderComplainsAction extends BaseAction{
	/**
	 * 订单投诉列表
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('ddts_00');
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		$m = D('Admin/OrderComplains');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign('orderNo',I('orderNo'));
    	$this->assign('complainStatus',I('complainStatus',-1));
    	$this->assign('areaId1',I('areaId1',0));
    	$this->assign('areaId2',I('areaId2',0));
    	$this->assign('areaId3',I('areaId3',0));
        $this->display("/ordercomplains/list");
	}
	
	/**
	 * 获取订单详情
	 */
    public function toView(){
		$this->isLogin();
		$this->checkPrivelege('ddts_00');
		$m = D('Admin/OrderComplains');
		if(I('id')>0){
			$object = $m->getDetail();
			$this->assign('object',$object);
		}
		$this->assign('referer',$_SERVER['HTTP_REFERER']);
		$this->display("/ordercomplains/view");
	}
	/**
	 * 跳去处理页面
	 */
    public function toHandle(){
		$this->isLogin();
		$this->checkPrivelege('ddts_04');
		$m = D('Admin/OrderComplains');
		if(I('id')>0){
			$object = $m->getDetail();
			$this->assign('object',$object);
		}
		$this->assign('referer',$_SERVER['HTTP_REFERER']);
		$this->display("/ordercomplains/handle");
	}
	
	/**
	 * 转交给应诉人回应
	 */
	public function deliverRespond(){
		$this->isLogin();
		$this->checkPrivelege('ddts_04');
		$rs = array('status'=>-1,'msg'=>'无效的投诉信息!');
		if((int)I('id')>0){
			$rs = D('Admin/OrderComplains')->deliverRespond();
		}
		$this->ajaxReturn($rs);
	}
	/**
	 * 仲裁投诉记录
	 */
	public function finalHandle(){
		$this->isLogin();
		$this->checkPrivelege('ddts_04');
		$rs = array('status'=>-1,'msg'=>'无效的投诉信息!');
		if((int)I('id')>0){
			$rs = D('Admin/OrderComplains')->finalHandle();
		}
		$this->ajaxReturn($rs);
	}
};
?>