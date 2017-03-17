<?php
namespace Admin\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 团购控制器
 */
class GroupsAction extends BaseAction {
	
	
   /**
	* 分页查询
	*/
	public function queryGroupGoods(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_01');
		//获取商品分类信息
		$m = D('Admin/GoodsCats');
		$this->assign('goodsCatsList',$m->queryByList());
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		$m = D('Admin/Groups');
		$page = $m->queryGroupGoodsByPage();
		$pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
		$page['pager'] = $pager->show();
		$this->assign('Page',$page);
		$this->assign('areaId1',(int)I("areaId1"));
		$this->assign('areaId2',(int)I("areaId2"));
		
		$this->assign('goodsCatId1',(int)I("goodsCatId1"));
		$this->assign('goodsCatId2',(int)I("goodsCatId2"));
		$this->assign('goodsCatId3',(int)I("goodsCatId3"));
		$this->assign('goodsName',I("goodsName"));
		$this->assign('shopName',I("shopName"));
        $this->display("/groups/list");
	}
	
	
	/**
	 * 团购商品列表
	 */
	public function queryGroupGoodsByPage(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_01');
		$m = D('Admin/groups');
		$rs = $m->queryGroupGoodsByPage();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 提交审核
	 */
	public function auditGroupGoods(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_01');
		$m = D('Admin/groups');
		$rs = $m->auditGroupGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除团购商品
	 */
	public function delGroupGoods(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_01');
		$m = D('Admin/groups');
		$rs = $m->delGroupGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 团购商品
	 */
	public function toRefuse(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_01');
		$this->assign('id',(int)I("id"));
		$this->display("/groups/refuse");
	}
	/**
	 * 团购商品
	 */
	public function refuseGroupGoods(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_01');
		$m = D('Admin/groups');
		$rs = $m->refuseGroupGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除团购商品
	 */
	public function editSort(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_01');
		$m = D('Admin/groups');
		$rs = $m->editSort();
		$this->ajaxReturn($rs);
	}
	
}