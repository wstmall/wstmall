<?php
namespace Home\Model;
use Think\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 报表服务类
 */
class ReportsModel extends BaseModel {
	/**
	 * 获取商品销售排行
	 */
	public function getTopSaleGoods(){
		$start = date('Y-m-d 00:00:00',strtotime(I('startDate')));
		$end = date('Y-m-d 23:59:59',strtotime(I('endDate')));
		$shopId = (int)session('WST_USER.shopId');
		$rs = M('order_goods og')->field('og.goodsId,g.goodsName,goodsSn,sum(og.goodsNums) goodsNums,og.goodsThums')
				->join('__ORDERS__ o on og.orderId=o.orderId')
				->join('__GOODS__ g on  og.goodsId=g.goodsId')
				->order('goodsNums desc')
				->where(array('o.createTime'=>array('between',array($start,$end))))
				->where('(payType=0 or (payType=1 and isPay=1)) and o.orderFlag=1 and o.shopId='.$shopId)->group('og.goodsId')
				->limit(20)->select();
		return array("data"=>$rs);
	}
	
	/**
	 * 获取销售额统计
	 */
	public function getStatSales(){
		$start = date('Y-m-d 00:00:00',strtotime(I('startDate')));
		$end = date('Y-m-d 23:59:59',strtotime(I('endDate')));
		$payType = (int)I('payType',-1);
		$shopId = (int)session('WST_USER.shopId');
		$rs = M('orders')->field('left(createTime,10) createTime,sum(totalMoney) totalMoney,count(orderId) orderNum')
				->where(array('createTime'=>array('between',array($start,$end))))
				->where('shopId',$shopId)
				->where('orderStatus>0 and (payType=0 or (payType=1 and isPay=1)) and orderFlag=1 '.(in_array($payType,array(0,1))?" and payType=".$payType:''))
				->order('createTime asc')
				->group('left(createTime,10)')->select();
		$rdata = array();
		if(count($rs)>0){
			$days = array();
			$tmp = array();
			foreach($rs as $key => $v){
				$days[] = $v['createTime'];
				$rdata['dayVals'][] = $v['totalMoney'];
				$rdata['list'][] = array('day'=>$v['createTime'],'val'=>$v['totalMoney'],'num'=>$v['orderNum']);
			}
			$rdata['days'] = $days;
		}
		return $rdata;
	}
	
	/**
	 * 获取商家订单情况
	 */
	public function getStatOrders(){
		$start = date('Y-m-d 00:00:00',strtotime(I('startDate')));
		$end = date('Y-m-d 23:59:59',strtotime(I('endDate')));
		$shopId = (int)session('WST_USER.shopId');
		$rs = M('orders')->field('left(createTime,10) createTime,orderStatus,count(orderId) orderNum,isPay')
				->where(array('createTime'=>array('between',array($start,$end))))
				->where('shopId',$shopId)
				->order('createTime asc')
				->group('left(createTime,10),orderStatus,isPay')->select();
		$rdata = array();
		if(count($rs)>0){
			$days = array();
			$tmp = array();
			$map = array('-3'=>0,'-1'=>0,'1'=>0);
			$mstatus = array(-1,-3,-4,-5,-6,-7,-8,-9,-10,-11);
			foreach($rs as $key => $v){
				if(!in_array($v['createTime'],$days))$days[] = $v['createTime'];
				if(in_array($v['orderStatus'], $mstatus)){
					if($v['isPay']==1){
						$tmp['-1_'.$v['createTime']] += $v['orderNum'];
					}else{
						$tmp['-3_'.$v['createTime']] += $v['orderNum'];
					}
				}else{
					if($v['orderStatus']>=0)$tmp['1_'.$v['createTime']] += $v['orderNum'];
				}
				
			}
			foreach($days as $v){
				$total = 0;
				$ou = 0;
				$o_3 = isset($tmp['-3_'.$v])?$tmp['-3_'.$v]:0;
				$o_1 = isset($tmp['-1_'.$v])?$tmp['-1_'.$v]:0;
				$ou = isset($tmp['1_'.$v])?$tmp['1_'.$v]:0;

				$rdata['-3'][] = $o_3;
				$rdata['-1'][] = $o_1;
				$rdata['1'][] = $ou;
				$map['-3']  += $o_3;
				$map['-1']  += $o_1;
				$map['1']  += $ou;
				$total += $o_3;
				$total += $o_1;
				$total += $ou;
				$rdata['total'][] = $total;
				$rdata['list'][] = array('day'=>$v,'o3'=>$o_3,'o1'=>$o_1,'ou'=>$ou);
			}
			$rdata['days'] = $days;
			$rdata['map'] = $map;
		}
		return $rdata;
	}
}