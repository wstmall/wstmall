<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 分销服务类
 */
class DistributsModel extends BaseModel {
	
	/**
	 * 获取分销设置
	 */
	public function getDistributConf(){
		$shopId = session('WST_USER.shopId');
		$sql = "select * from __PREFIX__shop_configs where shopId= $shopId";
		$rs = $this->queryRow($sql);
		return $rs;
	}
	
	/**
	 * 店铺分销设置
	 * @return multitype:number string
	 */
	public function setDistributs(){
		$rd = array('status'=>-1,'msg'=>'操作失败');
		$shopId = session('WST_USER.shopId');
		//加载商店信息
		$m = M('shop_configs');
		$shopcg = $m->where('shopId='.$shopId)->find();
		
		$distributType = (int)I("distributType");
		$data = array();
		$data["isDistribut"] = (int)I("isDistribut");
		$data["distributType"] = (int)I("distributType");
		$data["distributOrderRate"] = ($distributType==2)?(int)I("distributOrderRate"):0;
		$data["promoterRate"] = (int)I("promoterRate");
		$data["buyerRate"] = 100-$data["promoterRate"];
		if($shopcg["configId"]>0){
			$rs = $m->where("shopId=".$shopId)->save($data);
		}else{
			$data["shopId"] = $shopId;
			$rs = $m->add($data);
		}
		if($data["isDistribut"]==1){
			$data = array();
			$data["isDistribut"] = 1;
			$rs = M('goods')->where("shopId=".$shopId." and goodsFlag=1")->save($data);
		}
		$rd["status"] = 1;
		return $rd;
	}
	
	/**
	 * 检测分享
	 * @return number
	 */
	public function checkShare(){
		$shareUserId = (int)session("WST_SHAREUSERID");
		if($shareUserId>0){
			$isDistribut = $GLOBALS['CONFIG']["isDistribut"];
			$distributDeal = $GLOBALS['CONFIG']["distributDeal"];
			if($isDistribut==1){
				$sql = "select isBuyer from __PREFIX__users where userId = $shareUserId";
				$sharer = $this->queryRow($sql);
				if($distributDeal==1 || ($sharer["isBuyer"]==1 && $distributDeal==2)){
					$userId = (int)session('WST_USER.userId');
					if($userId>0 && $shareUserId!=$userId){
						$sql = "select * from __PREFIX__distribut_users where buyerId=$userId";
						$row = $this->queryRow($sql);
						if(empty($row)){
							$m = M('distribut_users');
							$data = array();
							$data["userId"] = $shareUserId;
							$data["buyerId"] = $userId;
							$data["createTime"] = date("Y-m-d H:i:s");
							$m->add($data);
						}
					}
				
				}
			}
		}
		$rd["status"] = 1;
		return $rd;
	}
	
	
	
	
}