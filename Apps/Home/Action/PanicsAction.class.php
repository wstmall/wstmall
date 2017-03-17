<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 抢购控制器
 */
class PanicsAction extends BaseAction {
	
	public function index(){
		$m = D('Home/GoodsCats');
		$goodsCats = $m->queryCats(0);
		$this->assign("goodsCats",$goodsCats);
		$m = D('Home/Panics');
		$list = $m->getPanicGoodsHome();
		$this->assign("pglist",$list);
		$this->display("/panics/list");
	}
	
	public function panicList(){
		$m = D('Home/GoodsCats');
		$goodsCats = $m->queryCats(0);
		$this->assign("panicType",(int)I("panicType",1));
		$this->assign("goodsCats",$goodsCats);
		$this->display("/panics/panic_list");
	}
	
	public function getPanicGoodsByPage(){
		$m = D('Home/Panics');
		$page = $m->getPanicGoodsByPage();
		$this->ajaxReturn($page);
	}
	
	
   /**
	* 分页查询
	*/
	public function queryPanicByPage(){
		$this->isShopLogin();
		$m = D('Home/Panics');
    	$page = $m->queryPanicByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('panicName',I("panicName"));
    	$this->assign('startDate',I("startDate"));
    	$this->assign('endDate',I("endDate"));
    	$this->assign('Page',$page);
    	$this->assign("umark","queryPanicByPage");
        $this->display("shops/panics/list");
	}
	/**
	 * 跳到新增/编辑抢购
	 */
    public function toEdit(){
		$this->isShopLogin();
		$m = D('Home/Panics');
		$object = array();
		$panicId = (int)I('panicId',0);
    	if($panicId>0){
    		$object = $m->get();
    	}else{
    		$object = $m->getModel();
    	}
    	
    	
    	$this->assign('object',$object);
    	$this->assign("umark","queryPanicByPage");
        $this->display("shops/panics/edit");
	}
	/**
	 * 新增抢购
	 */
	public function edit(){
		$this->isShopLogin();
		$m = D('Home/Panics');
    	$rs = array();
    	if((int)I('panicId',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除抢购
	 */
	public function del(){
		$this->isShopLogin();
		$m = D('Home/Panics');
		$rs = $m->del();
		$this->ajaxReturn($rs);
	}
	
	public function toAddGoods(){
		$this->isShopLogin();
		$m = D('Home/Panics');
		$object = $m->get();
		$this->assign('object',$object);

		$sm = D('Home/ShopsCats');
		$shopCats = $sm->getCatAndChild(session('WST_USER.shopId'));
		$this->assign('shopCats',$shopCats);
		
		$this->assign("umark","queryPanicByPage");
		$this->display("shops/panics/panic_goods");
	}
	
	
	/**
	 * 根据分类获取抢购商品
	 */
	public function getPanicGoodsByCat(){
		$this->isShopLogin();
		$m = D('Home/Panics');
		$rs = $m->getPanicGoodsByCat();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 添加抢购商品
	 */
	public function addPanicGoods(){
		$this->isShopLogin();
		$m = D('Home/Panics');
		$rs = $m->addPanicGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 抢购商品列表
	 */
	public function queryPanicGoodsByPage(){
		$this->isShopLogin();
		$m = D('Home/Panics');
		$rs = $m->queryPanicGoodsByPage();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 提交审核
	 */
	public function auditPanicGoods(){
		$this->isShopLogin();
		$m = D('Home/Panics');
		$rs = $m->auditPanicGoods();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 删除抢购商品
	 */
	public function delPanicGoods(){
		$this->isShopLogin();
		$m = D('Home/Panics');
		$rs = $m->delPanicGoods();
		$this->ajaxReturn($rs);
	}
	
	
	/**
	 * 查询商品详情
	 *
	 */
	public function getGoodsDetails(){
	
		$shareUserId = (int)base64_decode(I("shareUserId"));
		if($shareUserId>0){
			session("WST_SHAREUSERID",$shareUserId);
			if(session("WST_USER.userId")>0){
				$dm = D('Home/Distributs');
				$dm->checkShare();
			}
		}
		$gp = D('Common/Panics');
		$goods = D('Home/Goods');
		$appraise = D('Home/GoodsAppraises');
		
		$panic = $gp->getPanicGoods();
		$goodsId = $panic["goodsId"];
		$this->assign('panic',$panic);
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
			$this->display('/panics/goods_details');
		}else{
			$this->display('/goods_notexist');
		}
	
	}
	
	/**
	 * 核对抢购订单信息
	 */
	public function checkPanic(){
		$this->isUserLogin();
		$maddress = D('Home/UserAddress');
		$gp= D('Common/Panics');
		$id = (int)I("id");
		$rd = $gp->checkPanicGoods();	
	    if($rd["status"]==-1){
	    	session("WST_panic_id",null);
	    	session("WST_panic_cnt",null);
			$this->assign("fail_msg",$rd["msg"]);
			$this->display('order_fail');
			exit();
		}
		session("WST_group_id",null);
		session("WST_group_cnt",null);
		session("WST_panic_id",$id);
		session("WST_panic_cnt",(int)I("cnt",1));
		$this->assign("orderFrom",3);
		$this->assign("dataId",$id);
		
		$gp= D('Home/Panics');
		$rdata = $gp->getPanicInfo();
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
	
	public function checkPanicStock(){
		$this->isUserLogin();
		$m = D('Common/Panics');
		$goodsStock = $m->checkPanicStock();
		$this->ajaxReturn($goodsStock);
	}
	
	/**
	 * 提交订单信息
	 *
	 */
	public function submitPanicOrder(){
		$this->isUserLogin();
		session("WST_ORDER_UNIQUE",null);
		$morders = D('Common/Orders');
		$rs = $morders->submitPanicOrder();
		$this->ajaxReturn($rs);
	}
}