<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商品评价服务类
 */
class GoodsAppraisesModel extends BaseModel {
     /**
	  * 修改
	  */
	 public function edit(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$m = M('goods_appraises');
		$data["goodsScore"] = I("goodsScore");
		$data["serviceScore"] = I("serviceScore");
		$data["timeScore"] = I("timeScore");
		$data["content"] = I("content");
		$data["isShow"] = (int)I("isShow",1);
		if($this->checkEmpty($data)){	
			$rs = $m->where("id=".(int)I('id'))->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get(){
	 	$id = (int)I('id');
		$sql = "select gp.*,o.orderNo,u.loginName,g.goodsName,g.goodsThums from __PREFIX__goods_appraises gp 
		         left join __PREFIX__goods g on gp.goodsId=g.goodsId
		         left join __PREFIX__orders o on gp.orderId=o.orderId 
		         left join __PREFIX__users u on u.userId=gp.userId 
		         where gp.id=".$id;
		return $this->queryRow($sql);
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
     	$shopName = WSTAddslashes(I('shopName'));
     	$goodsName = WSTAddslashes(I('goodsName'));
     	$areaId1 = (int)I('areaId1',0);
     	$areaId2 = (int)I('areaId2',0);
        $m = M('goods_appraises');
	 	$sql = "select gp.*,g.goodsName,g.goodsThums,o.orderNo,u.loginName from __PREFIX__goods_appraises gp
	 	         left join __PREFIX__goods g on gp.goodsId=g.goodsId
		         left join __PREFIX__orders o on gp.orderId=o.orderId 
		         left join __PREFIX__users u on u.userId=gp.userId 
		         left join __PREFIX__shops p on p.shopId=gp.shopId 
	 	        where p.shopId=g.shopId and gp.goodsId=g.goodsId and o.orderId=gp.orderId ";
	 	if($areaId1>0)$sql.=" and p.areaId1=".$areaId1;
	 	if($areaId2>0)$sql.=" and p.areaId2=".$areaId2;
	 	if($shopName!='')$sql.=" and (p.shopName like '%".$shopName."%' or p.shopSn like '%'".$shopName."%')";
	 	if($goodsName!='')$sql.=" and (g.goodsName like '%".$goodsName."%' or g.goodsSn like '%".$goodsName."%')";
	 	$sql.="  order by id desc";
		$rs = $m->pageQuery($sql);
		return $rs;
	 }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	$m = M('goods_appraises');
		$rs = $m->delete((int)I('id'));
		if($rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
};
?>