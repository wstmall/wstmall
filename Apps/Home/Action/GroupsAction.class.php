<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 团购控制器
 */
class GroupsAction extends BaseAction {
	
	public function index(){
		$m = D('Home/GoodsCats');
		$goodsCats = $m->queryCats(0);
		$this->assign("goodsCats",$goodsCats);
		$this->display("/groups/list");
	}
	
	public function getGroupGoodsByPage(){
		$m = D('Home/Groups');
		$page = $m->getGroupGoodsByPage();
		$this->ajaxReturn($page);
	}
	
	
   /**
	* 分页查询
	*/
	public function queryGroupByPage(){
		$this->isShopLogin();
		$m = D('Home/Groups');
    	$page = $m->queryGroupByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('groupName',I("groupName"));
    	$this->assign('startDate',I("startDate"));
    	$this->assign('endDate',I("endDate"));
    	$this->assign('Page',$page);
    	$this->assign("umark","queryGroupByPage");
        $this->display("shops/groups/list");
	}
	/**
	 * 跳到新增/编辑团购
	 */
    public function toEdit(){
		$this->isShopLogin();
		$m = D('Home/Groups');
		$object = array();
		$groupId = (int)I('groupId',0);
    	if($groupId>0){
    		$object = $m->get();
    	}else{
    		$object = $m->getModel();
    	}
    	
    	
    	$this->assign('object',$object);
    	$this->assign("umark","queryGroupByPage");
        $this->display("shops/groups/edit");
	}
	/**
	 * 新增团购
	 */
	public function edit(){
		$this->isShopLogin();
		$m = D('Home/groups');
    	$rs = array();
    	if((int)I('groupId',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除团购
	 */
	public function del(){
		$this->isShopLogin();
		$m = D('Home/groups');
		$rs = $m->del();
		$this->ajaxReturn($rs);
	}
	
	public function toAddGoods(){
		$this->isShopLogin();
		$m = D('Home/Groups');
		$object = $m->get();
		$this->assign('object',$object);

		$sm = D('Home/ShopsCats');
		$shopCats = $sm->getCatAndChild(session('WST_USER.shopId'));
		$this->assign('shopCats',$shopCats);
		
		$this->assign("umark","queryGroupByPage");
		$this->display("shops/groups/group_goods");
	}
	
	
	/**
	 * 根据分类获取团购商品
	 */
	public function getGroupGoodsByCat(){
		$this->isShopLogin();
		$m = D('Home/groups');
		$rs = $m->getGroupGoodsByCat();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 添加团购商品
	 */
	public function addGroupGoods(){
		$this->isShopLogin();
		$m = D('Home/groups');
		$rs = $m->addGroupGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 团购商品列表
	 */
	public function queryGroupGoodsByPage(){
		$this->isShopLogin();
		$m = D('Home/groups');
		$rs = $m->queryGroupGoodsByPage();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 提交审核
	 */
	public function auditGroupGoods(){
		$this->isShopLogin();
		$m = D('Home/groups');
		$rs = $m->auditGroupGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除团购商品
	 */
	public function delGroupGoods(){
		$this->isShopLogin();
		$m = D('Home/groups');
		$rs = $m->delGroupGoods();
		$this->ajaxReturn($rs);
	}
	
	
	/**
	 * 查询商品详情
	 *
	 */
	public function getGoodsDetails(){
		
		$gp = D('Common/Groups');
		$rd = $gp->checkGroupGoods();
		if($rd["status"]==-1){
			session("WST_group_id",null);
			session("WST_group_cnt",null);
			$this->assign("fail_msg",$rd["msg"]);
			$this->display('order_fail');
			exit();
		}
		
		$shareUserId = (int)base64_decode(I("shareUserId"));
		if($shareUserId>0){
			session("WST_SHAREUSERID",$shareUserId);
			if(session("WST_USER.userId")>0){
				$dm = D('Home/Distributs');
				$dm->checkShare();
			}
		}
		$appraise = D('Home/GoodsAppraises');
		$goods = D('Home/Goods');
		$group = $gp->getGroupGoods();
		$goodsId = $group["goodsId"];
		$this->assign('group',$group);
		//查询商品详情
		$this->assign('goodsId',$goodsId);
		$obj["goodsId"] = $goodsId;
	
		$goodsDetails = $goods->getGoodsDetails($obj);
		if($goodsDetails["isSale"]==1 && $goodsDetails["goodsStatus"]==1){
			
			$shopServiceStatus = 1;
			if($goodsDetails["shopAtive"]==0){
				$shopServiceStatus = 0;
			}
			
			$goodsDetails["shopServiceStatus"] = $shopServiceStatus;
			$goodsDetails['goodsDesc'] = htmlspecialchars_decode($goodsDetails['goodsDesc']);
			$goodsDetails['isDistributGoods'] = 0;
			
			$areas = D('Home/Areas');
			$shopId = intval($goodsDetails["shopId"]);
			$obj["shopId"] = $shopId;
			$obj["areaId2"] = $this->getDefaultCity();
			$obj["attrCatId"] = $goodsDetails['attrCatId'];
			$shops = D('Home/Shops');
			$shopScores = $shops->getShopScores($obj);
			$this->assign("shopScores",$shopScores);
			
			$shopCity = $areas->getDistrictsByShop($obj);
			$this->assign("shopCity",$shopCity[0]);
				
			$shopCommunitys = $areas->getShopCommunitys($obj);
			$this->assign("shopCommunitys",json_encode($shopCommunitys));
				
			$this->assign("goodsImgs",$goods->getGoodsImgs($goodsId));
			$this->assign("goodsNav",$goods->getGoodsNav($goodsId));
			$this->assign("appraiseCnt",$appraise->getGoodsAppraisesCnt($goodsId));
			$this->assign("goodsDetails",$goodsDetails);
				
			$viewGoods = cookie("viewGoods");
			if(!in_array($goodsId,$viewGoods)){
				$viewGoods[] = $goodsId;
			}
			if(!empty($viewGoods)){
				cookie("viewGoods",$viewGoods,25920000);
			}
			//获取关注信息
			$m = D('Home/Favorites');
			$this->assign("favoriteGoodsId",$m->checkFavorite($goodsId,0));
			$m = D('Home/Favorites');
			$this->assign("favoriteShopId",$m->checkFavorite($shopId,1));
			//客户端二维码
			$this->assign("qrcode",base64_encode("{type:'goods',content:'".$goodsId."',key:'wstmall'}"));
			$this->display('/groups/goods_details');
		}else{
			$this->display('/goods_notexist');
		}
	
	}
	
	/**
	 * 核对团购订单信息
	 */
	public function checkGroup(){
		$this->isUserLogin();
		$maddress = D('Home/UserAddress');
		$gp= D('Common/Groups');
		$id = (int)I("id");
		$rd = $gp->checkGroupGoods();	
	    if($rd["status"]==-1){
	    	session("WST_group_id",null);
	    	session("WST_group_cnt",null);
			$this->assign("fail_msg",$rd["msg"]);
			$this->display('order_fail');
			exit();
		}
		session("WST_panic_id",null);
		session("WST_panic_cnt",null);
		session("WST_group_id",$id);
		session("WST_group_cnt",(int)I("cnt",1));
		$this->assign("orderFrom",2);
		$this->assign("dataId",$id);
		
		$gp= D('Home/Groups');
		$rdata = $gp->getGroupInfo();
		$catgoods = $rdata["cartgoods"];
		$shopColleges = $rdata["shopColleges"];
		$distributAll = $rdata["distributAll"]; 
		$startTime = $rdata["startTime"];
		$endTime = $rdata["endTime"];
		$gtotalMoney = $rdata["gtotalMoney"];//商品总价（去除配送费）
		$totalMoney = $rdata["totalMoney"];//商品总价（含配送费）
		$totalCnt = $rdata["totalCnt"];

		$userId = session('WST_USER.userId');
		//获取地址列表
        $areaId2 = $this->getDefaultCity();
		$addressList = $maddress->queryByUserAndCity($userId,$areaId2);
		$this->assign("addressList",$addressList);
		$this->assign("areaId2",$areaId2);
		//支付方式
		$pm = D('Home/Payments');
		$payments = $pm->getList();
		$this->assign("payments",$payments);

		//获取当前市的县区
		$m = D('Home/Areas');
		$provinces = $m->getProvinceList();
		$this->assign("provinces",$provinces);
		
		if($endTime==0){
			$endTime = 24;
			$cstartTime = (floor($startTime))*4;
			$cendTime = (floor($endTime))*4;
		}else{
			$cstartTime = (floor($startTime)+1)*4;
			$cendTime = (floor($endTime)+1)*4;
		}
		if(floor($startTime)<$startTime){
			$cstartTime = $cstartTime + 2;
		}
		if(floor($endTime)<$endTime){
			$cendTime = $cendTime + 2;
		}
		$baseScore = WSTOrderScore();
		$baseMoney = WSTScoreMoney();
		$this->assign("distCnt",0);
		$this->assign("startTime",$cstartTime);
		$this->assign("endTime",$cendTime);
		$this->assign("shopColleges",$shopColleges);
		$this->assign("distributAll",$distributAll);
		$this->assign("catgoods",$catgoods);
		$this->assign("gtotalMoney",$gtotalMoney);
		$this->assign("totalMoney",$totalMoney);
		$um = D('Home/Users');
		$user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
		$this->assign("userScore",$user['userScore']);
		$this->assign("userMoney",$user["userMoney"]);
		$useScore = $baseScore*floor($user["userScore"]/$baseScore);
		$scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
		if($totalMoney<$scoreMoney){//订单金额小于积分金额
			$useScore = $baseScore*floor($totalMoney/$baseMoney);
			$scoreMoney = $baseMoney*floor($totalMoney/$baseMoney);
		}
		$this->assign("canUserScore",$useScore);
		$this->assign("scoreMoney",$scoreMoney);
		$this->display('check_order');
	}
	
	public function checkGroupStock(){
		$this->isUserLogin();
		$m = D('Common/Groups');
		$goodsStock = $m->checkGroupStock();
		$this->ajaxReturn($goodsStock);
	}
	
	/**
	 * 提交订单信息
	 *
	 */
	public function submitGroupOrder(){
		$this->isUserLogin();
		session("WST_ORDER_UNIQUE",null);
		$morders = D('Common/Orders');
		$rs = $morders->submitGroupOrder();
		$this->ajaxReturn($rs);
	}
}