<?php
namespace Admin\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 分销控制器
 */
class DistributsAction extends BaseAction {
	
	/**
	 * 分销商家列表
	 */
	public function queryShops(){
		$this->isLogin();
		$this->checkPrivelege('fxgl_01');
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		$m = D('Admin/Distributs');
    	$page = $m->queryShops();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	
    	$this->assign('Page',$page);
    	$this->assign('shopName',I('shopName'));
    	$this->assign('shopSn',I('shopSn'));
    	$this->assign('areaId1',I('areaId1',0));
    	$this->assign('areaId2',I('areaId2',0));
        $this->display("/distributs/list_shop");
	}
	
	/**
	 * 分销商品列表
	 */
	public function queryGoods(){
		$this->isLogin();
		$this->checkPrivelege('fxgl_02');
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		//获取商品分类信息
		$m = D('Admin/GoodsCats');
		$this->assign('goodsCatsList',$m->queryByList());
		$m = D('Admin/Distributs');
    	$page = $m->queryGoods();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign('shopName',I('shopName'));
    	$this->assign('goodsName',I('goodsName'));
    	$this->assign('areaId1',I('areaId1',0));
    	$this->assign('areaId2',I('areaId2',0));
    	$this->assign('goodsCatId1',I('goodsCatId1',0));
    	$this->assign('goodsCatId2',I('goodsCatId2',0));
    	$this->assign('goodsCatId3',I('goodsCatId3',0));
    	$this->assign('isAdminBest',I('isAdminBest',-1));
    	$this->assign('isAdminRecom',I('isAdminRecom',-1));
        $this->display("/distributs/list_goods");
	}
	
	/**
	 * 佣金分成列表
	 */
	public function queryMoneys(){
		$this->isLogin();
		$this->checkPrivelege('fxgl_03');
		$m = D('Admin/Distributs');
    	$page = $m->queryMoneys();
    	$pager = new \Think\Page($page['total'],$page['pageSize'],I());
    	$page['pager'] = $pager->show();
    	$this->assign('userName',I('userName'));
    	$this->assign('orderNo',I('orderNo'));
    	$this->assign('startDate',I('startDate'));
    	$this->assign('endDate',I('endDate'));
    	$this->assign('settlementId',(int)I('settlementId',-999));
    	$this->assign('Page',$page);
        $this->display("/distributs/list_money");
	}
	
	/**
	 * 推广用户列表
	 */
	public function queryUsers(){
		$this->isLogin();
		$this->checkPrivelege('fxgl_04');
		$m = D('Admin/Distributs');
		$page = $m->queryUsers();
		$pager = new \Think\Page($page['total'],$page['pageSize'],I());
		$page['pager'] = $pager->show();
		$this->assign('loginName',I('loginName'));
		$this->assign('userPhone',I('userPhone'));
		$this->assign('userEmail',I('userEmail'));
		$this->assign('userType',I('userType',-1));
		$this->assign('Page',$page);
		$this->display("/distributs/list_user");
	}
	
	/**
	 * 推广用的用户列表
	 */
	public function getDistributUsers(){
		$this->isLogin();
		$this->checkPrivelege('fxgl_04');
		$m = D('Admin/Distributs');
		$page = $m->getDistributUsers();
		$pager = new \Think\Page($page['total'],$page['pageSize'],I());
		$page['pager'] = $pager->show();
		$this->assign('Page',$page);
		$this->display("/distributs/list_buyer");
	}
}