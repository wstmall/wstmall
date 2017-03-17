<?php
namespace Admin\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 抢购控制器
 */
class PanicsAction extends BaseAction {
	
	
   /**
	* 分页查询
	*/
	public function queryPanicGoods(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_02');
		//获取商品分类信息
		$m = D('Admin/GoodsCats');
		$this->assign('goodsCatsList',$m->queryByList());
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		$m = D('Admin/Panics');
		$page = $m->queryPanicGoodsByPage();
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
        $this->display("/panics/list");
	}
	
	
	/**
	 * 抢购商品列表
	 */
	public function queryPanicGoodsByPage(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_02');
		$m = D('Admin/panics');
		$rs = $m->queryPanicGoodsByPage();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 提交审核
	 */
	public function auditPanicGoods(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_02');
		$m = D('Admin/panics');
		$rs = $m->auditPanicGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除抢购商品
	 */
	public function delPanicGoods(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_02');
		$m = D('Admin/panics');
		$rs = $m->delPanicGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 抢购商品
	 */
	public function toRefuse(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_02');
		$this->assign('id',(int)I("id"));
		$this->display("/panics/refuse");
	}
	/**
	 * 抢购商品
	 */
	public function refusePanicGoods(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_02');
		$m = D('Admin/panics');
		$rs = $m->refusePanicGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除抢购商品
	 */
	public function editSort(){
		$this->isLogin();
		$this->checkPrivelege('cxgl_02');
		$m = D('Admin/panics');
		$rs = $m->editSort();
		$this->ajaxReturn($rs);
	}
	
}