<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 分销控制器
 */
class DistributsAction extends BaseAction {
	
	public function toSetDistributs(){
		$this->isShopLogin();
		$m = D('Home/Distributs');
		$rs = $m->getDistributConf();
		$this->assign("object",$rs);
		$this->assign("umark","setDistributs");
		$this->display("shops/distributs/set");
	}
	
	/**
	 * 保存店铺设置
	 */
	public function setDistributs(){
		$this->isShopLogin();
		$m = D('Home/Distributs');
		$rs = $m->setDistributs();
		$this->ajaxReturn($rs);
	}
	
	
	/**
	 * 分页查询-分销商品
	 */
	public function queryDistributByPage(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		
		$m = D('Home/Distributs');
		$distributConf = $m->getDistributConf();
		
		//获取商家商品分类
		$m = D('Home/ShopsCats');
		$this->assign('shopCatsList',$m->queryByList($USER['shopId'],0));
		$m = D('Home/Goods');
		$page = $m->queryDistributByPage($USER['shopId']);
		$pager = new \Think\Page($page['total'],$page['pageSize']);
		$page['pager'] = $pager->show();
		$this->assign('Page',$page);
		$this->assign("umark","queryDistributByPage");
		$this->assign("shopCatId2",I('shopCatId2'));
		$this->assign("shopCatId1",I('shopCatId1'));
		$this->assign("goodsName",I('goodsName'));
		$this->assign("distributConf",$distributConf);
		$this->display("shops/distributs/list_goods");
	}
	
	/**
	 * 分页查询-店铺分成记录
	 */
	public function queryShopDistributMoneys(){
		$this->isShopLogin();
		$m = D('Home/DistributMoneys');
		$page = $m->queryShopDistributMoneys();
		$pager = new \Think\Page($page['total'],$page['pageSize']);
		$page['pager'] = $pager->show();
		$this->assign('Page',$page);
		$this->assign('userName',I("userName") );
		$this->assign('orderNo',I("orderNo") );
		$this->assign('startDate',I('startDate'));
		$this->assign('endDate',I('endDate'));
		$this->assign('settlementId',(int)I("settlementId",-999) );
		$this->assign("umark","queryShopDistributMoneys");
		
		$this->display("shops/distributs/list_money");
	}
	
	/**
	 * 查询店铺分销商
	 */
	public function queryShopDistributUsers(){
		$this->isShopLogin();
		$m = D('Home/DistributUsers');
		$page = $m->getShopDistributUsers();
		$pager = new \Think\Page($page['total'],$page['pageSize']);
		$page['pager'] = $pager->show();
		$this->assign('Page',$page);
		$this->assign("umark","queryShopDistributUsers");
		$this->display("shops/distributs/list_user");
	}
	
	public function queryDistributUsers(){
		$this->isUserLogin();
		$m = D('Home/DistributUsers');
		$page = $m->queryDistributUsers();
		$pager = new \Think\Page($page['total'],$page['pageSize']);
		$page['pager'] = $pager->show();
		$this->assign('Page',$page);
		$this->assign("umark","queryDistributUsers");
		$this->display("users/distributs/list_user");
	}
	
	/**
	 * 分页查询-用户分成记录
	 */
	public function queryUserDistributMoneys(){
		$this->isUserLogin();
		$m = D('Home/DistributMoneys');
		$page = $m->queryUserDistributMoneys();
		$pager = new \Think\Page($page['total'],$page['pageSize']);
		$page['pager'] = $pager->show();
		$this->assign('Page',$page);
		$this->assign('userName',I("userName") );
		$this->assign('orderNo',I("orderNo") );
		$this->assign('startDate',I('startDate'));
		$this->assign('endDate',I('endDate'));
		$this->assign("umark","queryUserDistributMoneys");
	
		$this->display("users/distributs/list_money");
	}
	
}