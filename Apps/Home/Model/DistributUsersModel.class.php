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
class DistributUsersModel extends BaseModel {
	
	/**
	 * 注册添加分销用户
	 */
	public function addDistributUsers($userId){
		//添加分销用户记录
		$shareUserId = (int)session("WST_SHAREUSERID");
		if($shareUserId>0){
			$isDistribut = $GLOBALS['CONFIG']["isDistribut"];
			$distributDeal = $GLOBALS['CONFIG']["distributDeal"];
			if($isDistribut==1){
				$sql = "select isBuyer from __PREFIX__users where userId = $shareUserId";
				$sharer = $this->queryRow($sql);
				if($distributDeal==1 || ($sharer["isBuyer"]==1 && $distributDeal==2)){
					$m = M('distribut_users');
					$data = array();
					$data["userId"] = $shareUserId;
					$data["buyerId"] = $userId;
					$data["createTime"] = date("Y-m-d H:i:s");
					$data['ip'] = get_client_ip();
					$m->add($data);
					session('WST_SHAREUSERID', null);
				}
			}
		}
	}
	/**
	 * 获取推广用户
	 */
	public function queryDistributUsers(){
		$userId = session('WST_USER.userId');
		$sql = "select u.userId, u.loginName,u.userName,u.userSex, u.userPhoto from __PREFIX__distribut_users d, __PREFIX__users u 
				where d.userId=$userId and d.buyerId=u.userId order by d.createTime desc";
		$pages = $this->pageQuery($sql);
		return $pages;
	}
	
	/**
	 * 获取商家分销商
	 */
	public function getShopDistributUsers(){
		$shopId = session('WST_USER.shopId');
		$sql = "select u.userId, u.loginName,u.userName, u.userPhoto from __PREFIX__orders o, __PREFIX__distribut_users d, __PREFIX__users u
				where o.shopId=$shopId and o.userId=d.buyerId and d.userId=u.userId group by u.userId order by d.createTime desc";
		$pages = $this->pageQuery($sql);
		$users = $pages["root"];
		if(count($users)>0){
			$userIds = array();
			for($i=0,$k=count($users);$i<$k;$i++){
				$user = $users[$i];
				$userIds[] = $user["userId"];
			}
			//获取涉及的商品
			$sql = "SELECT userId, count(userId) cnt FROM __PREFIX__distribut_users WHERE userId in (".implode(',',$userIds).") group by userId";
			$rows = $this->query($sql);
			$ulist = array();
			for($i=0,$k=count($rows);$i<$k;$i++){
				$ulist[$rows[$i]["userId"]] = $rows[$i]["cnt"];
			}
			//放回分页数据里
			for($i=0,$k=count($users);$i<$k;$i++){
				$user = $users[$i];
				$user["userCnt"] = $ulist[$user["userId"]];
				$pages["root"][$i] = $user;
			}
		}
		return $pages;
	}
	
}