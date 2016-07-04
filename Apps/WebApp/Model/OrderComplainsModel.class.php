<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品服务类
 */
class OrderComplainsModel extends BaseModel {
	/**
	 * 投诉订单列表
	 */
	public function getOrderComplainsList(){
		$userId = (int)session('WST_USER.userId');
		$currPage = (int)I("currPage",0);
		$pageSize = ( I('pageSize') ? (int)I('pageSize') : 10 );
		$sql = "select oc.complainId,o.orderId,o.orderNo,p.shopId,p.shopName,oc.complainContent,oc.complainStatus,oc.complainTime
		        from __PREFIX__order_complains oc left join __PREFIX__shops p on oc.respondTargetId=p.shopId,
		        __PREFIX__orders o where oc.orderId=o.orderId and o.orderFlag=1 and o.userId=".$userId." order by oc.complainId desc";

		$rs = $this->pageQuery($sql,$currPage,$pageSize);
		return $rs;
	}

	/**
	 * 获取订单信息
	 */
	public function getOrderInfo(){
		$userId = (int)session('WST_USER.userId');
		$orderId = (int)I('orderId');
		//判断是否提交过投诉
		$sql = "select complainId from __PREFIX__order_complains where orderId=".$orderId." and complainTargetId=".$userId;
		$rs = $this->queryRow($sql);
		$data = array('complainStatus'=>1);
		if($rs['complainId']==''){
			//获取订单信息
			$sql = "select o.totalMoney,o.orderNo,o.orderId,o.createTime,o.deliverMoney,o.requireTime,p.shopName,p.shopId 
			        from __PREFIX__orders o left join __PREFIX__shops p on o.shopId=p.shopId where o.orderId=".$orderId." and o.userId=".$userId;
			$order = $this->queryRow($sql);
			if($order){
				//获取相关商品
				$sql = "select og.orderId, og.goodsId ,g.goodsSn, og.goodsNums, og.goodsName , og.goodsPrice shopPrice,og.goodsThums,og.goodsAttrName,og.goodsAttrName 
						from __PREFIX__goods g , __PREFIX__order_goods og 
						WHERE g.goodsId = og.goodsId AND og.orderId = $orderId";
				$goods = $this->query($sql);
				$order["goodsList"] = $goods;
			}
			$data['order'] = $order;
			$data['complainStatus'] = 0;
		}
        return $data;
	}

	/**
	 * 保存订单投诉信息
	 */
	public function saveComplain(){
		$rd = array('status'=>-1);
		$userId = (int)session('WST_USER.userId');
		$rules = array(
		     array('orderId','integer','无效的订单！',1),
		     array('complainType',array(1,2,3,4),'无效的投诉类型！',1,'in'),
		     array('complainContent','require','投诉内容不能为空！',1)
		);
	    if( $this->validate($rules)->create() ){
	        //判断订单是否该用户的
			$sql = "select orderId,shopId from __PREFIX__orders where orderId=".$this->orderId." and userId=".$userId;
			$order = $this->queryRow($sql);
			if(!$order){
				$rd['msg'] = "无效的订单信息";
			    return $rd;
			}
			//判断是否提交过投诉
			$sql = "select complainId from __PREFIX__order_complains where orderId=".$this->orderId." and complainTargetId=".$userId;
			$rs = $this->queryRow($sql);
			if((int)$rs['complainId']>0){
				$rd['msg'] = "该订单已进行了投诉,请勿重复提交投诉信息";
			    return $rd;
			}
			
			$this->complainTargetId = $userId;
			$this->respondTargetId = $order['shopId'];
			$this->complainStatus = 0;
			$this->complainTime = date('Y-m-d H:i:s');
			$complainAnnex = I('complainAnnex');
			if( $complainAnnex != '' ){
				$complainAnnex = explode(',', $complainAnnex);
				$complainAnnex = array_slice($complainAnnex, 0, 5);//只取前五张图片
				$this->complainAnnex = implode(',', $complainAnnex);
			}
			$rs = $this->add();
			if( $rs !== false ){
				$rd['status'] = 1;
			}else{
				$rd['msg'] = '提交订单投诉信息失败';
			}
		}else{
			$rd['msg'] = $this->getError();
		}
		return $rd;
	}

	/**
	* 获取投诉详情
	*/
	public function getComplainDetails(){
		$userId = (int)session('WST_USER.userId');
		$complainId = (int)I('complainId');
		$sql = "select oc.*,o.orderNo,o.orderId,p.shopName,p.shopId 
			        from __PREFIX__order_complains oc,__PREFIX__orders o left join __PREFIX__shops p on o.shopId=p.shopId where oc.orderId=o.orderId and oc.complainId=".$complainId." and oc.complainTargetId=".$userId;
		$rs = $this->queryRow($sql);
		if($rs){
			if($rs['complainAnnex']!='')$rs['complainAnnex'] = explode(',',$rs['complainAnnex']);
			if($rs['respondAnnex']!='')$rs['respondAnnex'] = explode(',',$rs['respondAnnex']);
		}
        return $rs;
	}
}