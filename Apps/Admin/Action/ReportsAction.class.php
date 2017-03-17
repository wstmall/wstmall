<?php
 namespace Admin\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 统计报表控制器
 */
class ReportsAction extends BaseAction{
	/**
	 * 去订单统计
	 */
	public function toStatOrders(){
		$this->isLogin();
		$this->checkPrivelege('dttj_00');
		$this->assign('startDate',date('Y-m-d',strtotime("-31 day")));
		$this->assign('endDate',date('Y-m-d'));
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
        $this->display("/reports/orders");
	}
	
	/**
	 * 订单统计
	 */
	public function statOrders(){
		$this->isLogin();
		$this->checkPrivelege('dttj_00');
		$rs = D('Admin/Reports')->statOrders();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 去新增会员统计
	 */
	public function toStatNewUser(){
		$this->isLogin();
		$this->checkPrivelege('dttj_04');
		$this->assign('startDate',date('Y-m-d',strtotime("-31 day")));
		$this->assign('endDate',date('Y-m-d'));
		$this->display("/reports/new_users");
	}
	
	/**
	 * 会员新增会员统计
	 */
	public function statNewUser(){
		$this->isLogin();
		$this->checkPrivelege('dttj_04');
		$rs = D('Admin/Reports')->statNewUser();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 去会员登录统计
	 */
	public function toStatUserLogin(){
		$this->isLogin();
		$this->checkPrivelege('dttj_05');
		$this->assign('startDate',date('Y-m-d',strtotime("-31 day")));
		$this->assign('endDate',date('Y-m-d'));
		$this->display("/reports/user_login");
	}
	
	/**
	 * 会员登录统计
	 */
	public function statUserLogin(){
		$this->isLogin();
		$this->checkPrivelege('dttj_05');
		$rs = D('Admin/Reports')->statUserLogin();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 商品销售排行
	 */
	public function statTopSaleGoods(){
		$this->isLogin();
		$this->checkPrivelege('dttj_01');
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		//获取商品分类信息
		$m = D('Admin/GoodsCats');
		$this->assign('goodsCatsList',$m->queryByList());
		
		if(I("queryDate")!=""){
			$dates = explode(" ",I("queryDate"));
			$startDate = $dates[0];
			$endDate = $dates[2];
		}else{
			$startDate = date('Y-m-d',strtotime("-31 day"));
			$endDate = date('Y-m-d');
		}
		
		$page = D('Admin/Reports')->statTopSaleGoods($startDate,$endDate);
		$pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
		$page['pager'] = $pager->show();
		$this->assign('Page',$page);
	
		$this->assign('startDate',$startDate);
		$this->assign('endDate',$endDate);
		$this->assign('shopName',I('shopName'));
		$this->assign('goodsName',I('goodsName'));
		$this->assign('areaId1',I('areaId1',0));
		$this->assign('areaId2',I('areaId2',0));
		$this->assign('goodsCatId1',I('goodsCatId1',0));
		$this->assign('goodsCatId2',I('goodsCatId2',0));
		$this->assign('goodsCatId3',I('goodsCatId3',0));
		
		$this->display("/reports/goods_sale");
	}
	
	/**
	 * 店铺销售排行
	 */
	public function statShopSales(){
		$this->isLogin();
		$this->checkPrivelege('dttj_02');
		//获取地区信息
		$m = D('Admin/Areas');
		$this->assign('areaList',$m->queryShowByList(0));
		
		if(I("queryDate")!=""){
			$dates = explode(" ",I("queryDate"));
			$startDate = $dates[0];
			$endDate = $dates[2];
		}else{
			$startDate = date('Y-m-d',strtotime("-31 day"));
			$endDate = date('Y-m-d');
		}
		$page = D('Admin/Reports')->statShopSales($startDate,$endDate);
		$pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
		$page['pager'] = $pager->show();
		 
		$this->assign('Page',$page);
		$this->assign('shopName',I('shopName'));
		$this->assign('areaId1',I('areaId1',0));
		$this->assign('areaId2',I('areaId2',0));
		
		$this->assign("startDate",$startDate);
		$this->assign("endDate",$endDate);
		$this->display("/reports/shops_sale");
	}
	
	/**
	 * 销售额统计
	 */
	public function statSales(){
		$this->isLogin();
		$this->checkPrivelege('dttj_03');
		$this->assign('startDate',date('Y-m-d',strtotime("-31 day")));
		$this->assign('endDate',date('Y-m-d'));
		$this->display("/reports/stat_sales");
	}
	public function getStatSales(){
		$this->isLogin();
		$this->checkPrivelege('dttj_03');
		$rs = D('Admin/Reports')->getStatSales();
		$this->ajaxReturn($rs);
	}
};
?>