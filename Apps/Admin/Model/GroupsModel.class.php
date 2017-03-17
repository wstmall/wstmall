<?php
namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 团购服务类
 */
class GroupsModel extends BaseModel {

	 /**
	  * 获取团购商品
	  */
	 public function queryGroupGoodsByPage(){

	 	$pcurr = (int)I("pcurr",0);
	 	$areaId1 = (int)I("areaId1");
	 	$areaId2 = (int)I("areaId2");
	 	$goodsCatId1 = (int)I("goodsCatId1");
	 	$goodsCatId2 = (int)I("goodsCatId2");
	 	$goodsCatId3 = (int)I("goodsCatId3");
	 	$shopName = I("shopName");
	 	$goodsName = I('goodsName');
	 	
	 	$sql = "select gp.groupName,gp.startTime,gp.endTime, g.goodsName,sp.shopName,g.goodsThums,g.shopPrice,p.* from __PREFIX__groups_goods p, __PREFIX__goods g , __PREFIX__shops sp  , __PREFIX__groups gp
	 			where sp.shopId=p.shopId and gp.groupId=p.groupId and p.goodsId=g.goodsId and g.goodsFlag=1 and p.dataFlag=1 and p.goodsStatus>0 ";
	 	if($goodsName!=""){
	 		$sql .= " and g.goodsName like '%".$goodsName."%'";
	 	}
	 	if($shopName!=""){
	 		$sql .= " and sp.shopName like '%".$shopName."%'";
	 	}
	 	if($areaId1>0){
	 		$sql .= " and sp.areaId1= $areaId1";
	 	}
	 	if($areaId2>0){
	 		$sql .= " and sp.areaId2= $areaId2";
	 	}
	 	if($goodsCatId1>0){
	 		$sql .= " and g.goodsCatId1= $goodsCatId1";
	 	}
	 	if($goodsCatId2>0){
	 		$sql .= " and g.goodsCatId2= $goodsCatId2";
	 	}
	 	if($goodsCatId3>0){
	 		$sql .= " and g.goodsCatId3= $goodsCatId3";
	 	}
	 	$page = $this->pageQuery($sql,$pcurr);
		//获取涉及的订单及商品
		if(count($page['root'])>0){
		    foreach ($page['root'] as $key => $v){
		    	$page['root'][$key]['goodsRate'] = sprintf('%.1f',($page['root'][$key]['groupMoney']/$page['root'][$key]['shopPrice'])*10);
		    }
		}
	 	return $page;
	 }

	
	 /**
	  * 团购商品审核通过
	  */
	 public function auditGroupGoods(){
	 	$rd = array('status'=>-1);
	 	$where = array();
	 	$where["id"] = (int)I("id");
	 	$data = array();
	 	$data["goodsStatus"] = 2;//审核通过
	 	M("groups_goods")->where($where)->save($data);
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 
	 /**
	  * 关闭团购商品
	  */
	 public function delGroupGoods(){
	 	$rd = array('status'=>-1);
	 	$where = array();
	 	$where["id"] = (int)I("id");
	 	$data = array();
	 	$data["dataFlag"] = -1;//删除
	 	M("groups_goods")->where($where)->save($data);
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 
	 /**
	  * 修改排序
	  */
	 public function editSort(){
	 	$rd = array('status'=>-1);
	 	$where = array();
	 	$where["id"] = (int)I("id");
	 	$data = array();
	 	$data["sortNo"] = (int)I("sortNo");//删除
	 	M("groups_goods")->where($where)->save($data);
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 
	 /**
	  * 拒绝团购商品
	  */
	 public function refuseGroupGoods(){
	 	$rd = array('status'=>-1);
	 	$where = array();
	 	$id = (int)I("id");
	 	$where["id"] = $id;
	 	$data = array();
	 	$data["goodsStatus"] = -1;//拒绝
	 	M("groups_goods")->where($where)->save($data);
	 	
	 	$sql = "select g.goodsName,gp.shopId,sp.userId from __PREFIX__groups_goods gp,__PREFIX__goods g ,__PREFIX__shops sp
	 			where gp.id=$id and gp.goodsId=g.goodsId and sp.shopId=gp.shopId";
	 	$row = $this->queryRow($sql);
	 	//发站内信
	 	$messsage = array(
	 			'msgType' => 0,
	 			'sendUserId' => session('WST_STAFF.staffId'),
	 			'receiveUserId' => $row["userId"],
	 			'msgContent' => "您的团购商品“".$row["goodsName"]."”由于【".I("refuseRemarks")."】原因，没能通过审核。",
	 			'createTime' => date('Y-m-d H:i:s'),
	 			'msgStatus' => 0,
	 			'msgFlag' => 1,
	 	);
	 	M('messages')->add($messsage);
	 	
	 	$rd["status"] = 1;
	 	return $rd;
	 }
	 
}