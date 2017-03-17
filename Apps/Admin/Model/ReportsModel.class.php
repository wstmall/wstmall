<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 订单统计服务类
 */
class ReportsModel extends BaseModel {
	/**
	 * 订单统计
	 */
	public function statOrders(){
		$statType = (int)I('statType');
	 	$startDate = date('Y-m-d',strtotime(I('startDate')));
	 	$endDate = date('Y-m-d',strtotime(I('endDate')));
	 	$areaId1 = (int)I('areaId1');
	 	$areaId2 = (int)I('areaId2');
	 	$areaId3 = (int)I('areaId3');
	 	$rs = array();
	 	if($statType==0){
	 		$sql = "select left(createTime,10) createTime,count(orderId) counts from __PREFIX__orders where orderStatus>=0 
	 		        and createTime >='".$startDate." 00:00:00' and createTime<='".$endDate." 23:59:59'  ";
	 		if($areaId1>0)$sql.=" and areaId1=".$areaId1;
	 		if($areaId2>0)$sql.=" and areaId2=".$areaId2;
	 		if($areaId3>0)$sql.=" and areaId3=".$areaId3;
	 		$sql.=" group by left(createTime,10)";
	 		
	 	}else{
	 		$sql = "select left(createTime,7) createTime,count(orderId) counts from __PREFIX__orders where orderStatus>=0 
	 		        and createTime >='".$startDate." 00:00:00' and createTime<='".$endDate." 23:59:59' ";
	 		if($areaId1>0)$sql.=" and areaId1=".$areaId1;
	 		if($areaId2>0)$sql.=" and areaId2=".$areaId2;
	 		if($areaId3>0)$sql.=" and areaId3=".$areaId3;
	 		$sql.="  group by left(createTime,7)";
	 	}
	 	$rs = $this->query($sql);
	 	$data = array('status'=>1);
	    foreach ($rs as $key =>$v){
	 		$data['list'][$v['createTime']]["o_0"] = $v['counts'];
	 	}
	 	return $data;
	}
	
	/**
	 * 获取新增用户
	 */
	public function statNewUser(){
		$start = date('Y-m-d 00:00:00',strtotime(I('startDate')));
		$end = date('Y-m-d 23:59:59',strtotime(I('endDate')));
		$urs = M("users")->field('left(createTime,10) createTime,count(userId) userNum')
				->where(array('createTime'=>array('between',array($start,$end))))
				->where(array('userFlag'=>1,'userType'=>0))
				->order('createTime asc')
				->group('left(createTime,10)')
				->select();
		$srs = M("shops")->field('left(createTime,10) createTime,count(shopId) userNum')
				->where(array('createTime'=>array('between',array($start,$end))))
				->where(array('shopFlag'=>1))
				->order('createTime asc')
				->group('left(createTime,10)')
				->select();
		$rdata = array();
		$days = array();
		$tmp = array();
		if(count($urs)>0){
			foreach($urs as $key => $v){
				if(!in_array($v['createTime'],$days))$days[] = $v['createTime'];
				$tmp["0_".$v['createTime']] = $v['userNum'];
			}
		}
		if(count($srs)>0){
			foreach($srs as $key => $v){
				if(!in_array($v['createTime'],$days))$days[] = $v['createTime'];
				$tmp["1_".$v['createTime']] = $v['userNum'];
			}
		}
		sort($days);
		foreach($days as $v){
			$rdata['u0'][] =  isset($tmp['0_'.$v])?$tmp['0_'.$v]:0;
			$rdata['u1'][] =  isset($tmp['1_'.$v])?$tmp['1_'.$v]:0;
		}
		$rdata['days'] = $days;
		return $rdata;
	}
	
	/**
	 * 会员登录统计
	 */
	public function statUserLogin(){
		$start = date('Y-m-d 00:00:00',strtotime(I('startDate')));
		$end = date('Y-m-d 23:59:59',strtotime(I('endDate')));
		$sql ='select createTime,userType,count(userId) userNum from (
             SELECT left(loginTime,10) createTime,`userType`,u.userId
                FROM `wst_users` `u` INNER JOIN `__PREFIX__log_user_logins` `lg` ON `u`.`userId`=`lg`.`userId`
                WHERE  `loginTime` BETWEEN "'.$start.'" AND "'.$end.'"  AND (  userFlag=1 )
                GROUP BY left(loginTime,10),userType,lg.userId
              ) a GROUP BY createTime, userType ORDER BY createTime asc ';
		$rs = $this->query($sql);
		$rdata = array();
		if(count($rs)>0){
			$days = array();
			$tmp = array();
			foreach($rs as $key => $v){
				if(!in_array($v['createTime'],$days))$days[] = $v['createTime'];
				$tmp[$v['userType']."_".$v['createTime']] = $v['userNum'];
			}
			foreach($days as $v){
				$rdata['u0'][] = isset($tmp['0_'.$v])?$tmp['0_'.$v]:0;
				$rdata['u1'][] = isset($tmp['1_'.$v])?$tmp['1_'.$v]:0;
			}
			$rdata['days'] = $days;
		}
		return $rdata;
	}
	
	/**
	 * 获取商品销售排行
	 */
	public function statTopSaleGoods($startDate,$endDate){
		
		$shopName = WSTAddslashes(I('shopName'));
		$areaId1 = (int)I('areaId1',0);
		$areaId2 = (int)I('areaId2',0);
		$goodsCatId1 = (int)I('goodsCatId1',0);
		$goodsCatId2 = (int)I('goodsCatId2',0);
		$goodsCatId3 = (int)I('goodsCatId3',0);
		
		
		$start = date('Y-m-d 00:00:00',strtotime($startDate));
		$end = date('Y-m-d 23:59:59',strtotime($endDate));
		
		$sql = "select og.goodsId,g.goodsName,goodsSn,sum(og.goodsNums) goodsNums,og.goodsThums,sp.shopName from __PREFIX__order_goods og, __PREFIX__orders o, __PREFIX__goods g, __PREFIX__shops sp 
				where og.orderId=o.orderId and og.goodsId=g.goodsId and sp.shopId=g.shopId and (payType=0 or (payType=1 and isPay=1)) and o.orderFlag=1 and (o.createTime between '$start' and '$end' )";
		if($shopName!="")$sql.=" and sp.shopName like '%".$shopName."%'";
		if($areaId1>0)$sql.=" and sp.areaId1=".$areaId1;
		if($areaId2>0)$sql.=" and sp.areaId2=".$areaId2;
		if($goodsCatId1>0)$sql.=" and g.goodsCatId1=".$goodsCatId1;
		if($goodsCatId2>0)$sql.=" and g.goodsCatId2=".$goodsCatId2;
		if($goodsCatId3>0)$sql.=" and g.goodsCatId3=".$goodsCatId3;
		$sql.=" GROUP BY og.goodsId  order by goodsNums desc ";
		
		$page = $this->pageQuery($sql);
		
		return $page;
	}
	
	/**
	 * 获取店铺销售订单统计
	 */
	public function statShopSales($startDate,$endDate){
		$start = date('Y-m-d 00:00:00',strtotime($startDate));
		$end = date('Y-m-d 23:59:59',strtotime($endDate));
		$shopName = WSTAddslashes(I('shopName'));
		
		$areaId1 = (int)I('areaId1',0);
		$areaId2 = (int)I('areaId2',0);
		$sql = "select s.shopId,shopSn,shopName,shopAtive,shopStatus,gc.catName from __PREFIX__shops s ,__PREFIX__orders o ,__PREFIX__goods_cats gc
	 	     	where s.shopId=o.shopId and gc.catId=s.goodsCatId1 and shopStatus=1 and shopFlag=1 and orderStatus>0 
				and (o.createTime between '$start' and '$end' ) ";
		if(I('shopName')!='')$sql.=" and shopName like '%".$shopName."%'";
		if($areaId1>0)$sql.=" and areaId1=".$areaId1;
		if($areaId2>0)$sql.=" and areaId2=".$areaId2;
		$sql.=" GROUP BY o.shopId order by sum(o.totalMoney) desc";
		$page = $this->pageQuery($sql);
		$shopIds = array(0);
		for($i=0,$k=count($page['root']);$i<$k;$i++){
			$shopIds[] = $page['root'][$i]['shopId'];
		}
		
		$sql = "select s.shopId,sum(o.totalMoney) totalMoney,count(o.orderId) orderNum from __PREFIX__shops s,__PREFIX__orders o 
				where s.shopId=o.shopId and o.orderFlag=1 and orderStatus>0 and (o.createTime between '$start' and '$end' ) and o.shopId in (".implode(",",$shopIds).")";
		if($shopName!='')$sql.=" and ( s.shopName like '%".$shopName."%' or s.loginName like '%".$shopName."%')";
		if($areaId1>0)$sql.=" and s.areaId1=".$areaId1;
		if($areaId2>0)$sql.=" and s.areaId2=".$areaId2;
		
		$group  =" GROUP BY o.shopId  order by totalMoney desc,orderNum desc ";
		
		//货到付款
		$sql1 = $sql . " and payType=0 ";
		$sql1 = $sql1 . $group;
		$tlist = $this->query($sql1);
		//echo $this->getLastSql();
		$tmap = array();
		for($i=0,$k=count($tlist);$i<$k;$i++){
			$tmap[$tlist[$i]['shopId']] = $tlist[$i];
		}
		//在线支付
		$sql2 = $sql . " and (payType=1 and isPay=1) ";
		$sql2 = $sql2 . $group;
		$plist = $this->query($sql2);
		$pmap = array();
		for($i=0,$k=count($plist);$i<$k;$i++){
			$pmap[$plist[$i]['shopId']] = $plist[$i];
		}
		
		for($i=0,$k=count($page['root']);$i<$k;$i++){
			$shopId = $page['root'][$i]['shopId'];
			$tord = $tmap[$shopId];
			$pord = $pmap[$shopId];
			
			$page['root'][$i]['onlineMoney'] = $pord["totalMoney"];
			$page['root'][$i]['unlineMoney'] = $tord["totalMoney"];
			$page['root'][$i]['totalMoney'] = $pord["totalMoney"] + $tord["totalMoney"];
			$page['root'][$i]['orderNum'] = $tord["orderNum"]+$pord["orderNum"];
		}
		
		return $page;
	}
	
	/**
	 * 获取店铺销售额统计
	 */
	public function getStatSales(){
		$start = date('Y-m-d 00:00:00',strtotime(I('startDate')));
		$end = date('Y-m-d 23:59:59',strtotime(I('endDate')));
		$payType = (int)I('payType',-1);
		$rs = M('orders')->field('left(createTime,10) createTime,sum(totalMoney) totalMoney,count(orderId) orderNum')
				->where(array('createTime'=>array('between',array($start,$end))))
				->where('(payType=0 or (payType=1 and isPay=1)) and orderStatus>0 and orderFlag=1 '.(in_array($payType,array(0,1))?" and payType=".$payType:''))
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
	
};
?>