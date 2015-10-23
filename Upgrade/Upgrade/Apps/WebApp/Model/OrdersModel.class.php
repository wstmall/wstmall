<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
use Think\Model;
class OrdersModel extends BaseModel {
	/**
	 * 获取当前用户的订单列表
	 */
	public function getOrderList(){
		$userId = $this->getUserId();
		$m = M('orders');
		$status = I('status',-999);
		$sql = "select o.payType,o.orderId,o.orderNo,o.orderStatus,o.needPay,o.createTime,o.totalMoney,s.shopName,s.shopId 
		    from __PREFIX__orders o,__PREFIX__shops s WHERE o.shopId=s.shopId and o.userId=$userId AND orderFlag=1 ";
		if($status!=-999){
			//待付款
			if($status==-2)$sql.=" and orderStatus=-2";
			//待受理
			if($status==0)$sql.=" and orderStatus=0";
			//待收货
			if($status==3)$sql.=" and orderStatus in(1,2,3)";
			//未评价
			if($status==4)$sql.=" and orderStatus in(4,5) and isAppraises=0 ";
			//已消费
			if($status==5)$sql.=" and orderStatus = 5 ";
		}
		$sql.=" order by o.orderId desc";
		$rs = $m->pageQuery($sql);
		//獲取這些訂單下的商品信息
		if(count($rs['root'])>0){
			$ids = array();
			foreach ($rs['root'] as $key =>$v){
				$ids[] = $v['orderId'];
			}
			$sql = "select og.goodsThums,og.goodsId,og.goodsName,og.orderId,og.goodsNums,og.goodsPrice
			    from __PREFIX__order_goods og
			    where og.orderId in(".implode(',',$ids).") ";
			$grs = $m->query($sql);
			$ogrs = array();
			foreach ($grs as $v){
				$ogrs[$v['orderId']][] = $v;
			}
			//合并数据
			foreach ($rs['root'] as $key =>$v){
				$ogrs['goodsThums'] = WSTMoblieImg($ogrs['goodsThums']);
				$rs['root'][$key]['data'] = $ogrs[$v['orderId']];
			}
		}
		return $rs;
	}

	
}