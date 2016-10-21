<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 商品评价控制器
 */
class GoodsAppraisesAction extends BaseAction{
	
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isLogin();
		$this->checkPrivelege('sppl_03');
		$m = D('Admin/Goods_appraises');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 跳到编辑界面
	 */
	public function toEdit(){
		$this->isLogin();
		$this->checkPrivelege('sppl_04');
		$m = D('Admin/Goods_appraises');
		if(I('id')>0){
			$object = $m->get();
			$this->assign('object',$object);
		}
		$this->view->display('/goodsappraises/edit');
	}
	/**
	 * 修改商品评价
	 */
	public function edit(){
		$this->isLogin();
		$this->checkPrivelege('sppl_04');
		$m = D('Admin/Goods_appraises');
    	$rs = $m->edit();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		$this->isLogin();
		$this->checkPrivelege('sppl_00');
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		$m = D('Admin/Goods_appraises');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());
    	$page['pager'] = $pager->show();

    	foreach($page['root'] as $k=>$v)
		{
			$page['root'][$k]['appraisesAnnex'] = explode(',',$page['root'][$k]['appraisesAnnex']);
		}
		//dump($page);die;
    	$this->assign('Page',$page);
    	$this->assign('shopName',I('shopName'));
    	$this->assign('goodsName',I('goodsName'));
    	$this->assign('areaId1',I('areaId1',0));
    	$this->assign('areaId2',I('areaId2',0));
        $this->display("/goodsappraises/list");
	}
};
?>