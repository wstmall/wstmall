<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 商品控制器
 */
class GoodsAction extends BaseAction {
	
	
	/**
	 * 商品列表
	 */
    public function getGoodsList(){
   		$mgoods = D('Home/Goods');
   		$mareas = D('Home/Areas');
   		$mcommunitys = D('Home/Communitys');
   		//获取默认城市及县区
   		$areaId2 = $this->getDefaultCity();
   		$districts = $mareas->getDistricts($areaId2);
   		//获取社区
   		$areaId3 = (int)I("areaId3");
   		$communitys = array();
   		if($areaId3>0){
   		    $communitys = $mcommunitys->getByDistrict($areaId3);
   		}
        $this->assign('communitys',$communitys);
   		
   		//获取商品列表
   		$obj["areaId2"] = $areaId2;
        $obj["areaId3"] = $areaId3;
   		$rslist = $mgoods->getGoodsList($obj);
		$brands = $rslist["brands"];
		$pages = $rslist["pages"];
		$goodsNav = $rslist["goodsNav"];
		$this->assign('goodsList',$rslist);
		//动态划分价格区间
		$maxPrice = $rslist["maxPrice"];
		$minPrice = 0;
		$pavg5 = ($maxPrice/5);
		$prices = array();
    	$price_grade = 0.0001;
        for($i=-2; $i<= log10($maxPrice); $i++){
            $price_grade *= 10;
        }
    	//区间跨度
        $span = ceil(($maxPrice - $minPrice) / 8 / $price_grade) * $price_grade;
        if($span == 0){
            $span = $price_grade;
        }
		for($i=1;$i<=8;$i++){
			$prices[($i-1)*$span."_".($span * $i)] = ($i-1)*$span."-".($span * $i);
			if(($span * $i)>$maxPrice) break;
		}
		if(count($prices)<5){
			$prices = array();
			$prices["0_100"] = "0-100";
			$prices["100_200"] = "100-200";
			$prices["200_300"] = "200-300";
			$prices["300_400"] = "300-400";
			$prices["400_500"] = "400-500";
		}
   		$this->assign('c1Id',(int)I("c1Id"));
   		$this->assign('c2Id',(int)I("c2Id"));
   		$this->assign('c3Id',(int)I("c3Id"));
   		$this->assign('msort',(int)I("msort",0));
   		$this->assign('mark',(int)I("mark",0));
		$this->assign('stime',I("stime"));//上架开始时间
		$this->assign('etime',I("etime"));//上架结束时间
   		
   		$this->assign('areaId3',(int)I("areaId3",0));
   		$this->assign('communityId',(int)I("communityId",0));
   		
   		$pricelist = explode("_",I("prices"));
   		$this->assign('sprice',(int)$pricelist[0]);
   		$this->assign('eprice',(int)$pricelist[1]);
   		
   		$this->assign('brandId',(int)I("brandId",0));
   		$this->assign('keyWords',urldecode(I("keyWords")));
		$this->assign('brands',$brands);
		$this->assign('goodsNav',$goodsNav);
		$this->assign('pages',$pages);
		$this->assign('prices',$prices);
		$priceId = $prices[I("prices")];
		$this->assign('priceId',(strlen($priceId)>1)?I("prices"):'');
   		$this->assign('districts',$districts);
   		$this->display('default/goods_list');
    }
    
  
	/**
	 * 查询商品详情
	 * 
	 */
	public function getGoodsDetails(){

		$goods = D('Home/Goods');
		$kcode = I("kcode");
		$scrictCode = md5(base64_encode("wstmall".date("Y-m-d")));
		
		//查询商品详情		
		$goodsId = (int)I("goodsId");
		$this->assign('goodsId',$goodsId);
		$obj["goodsId"] = $goodsId;	
		
		$packages = $goods->getGoodsPackages($goodsId,1);
		$this->assign('packages',$packages);
		
		$goodsDetails = $goods->getGoodsDetails($obj);
		if($kcode==$scrictCode || ($goodsDetails["isSale"]==1 && $goodsDetails["goodsStatus"]==1)){
			if($kcode==$scrictCode){//来自后台管理员
				$this->assign('comefrom',1);
			}
			
			$shopServiceStatus = 1;
			if($goodsDetails["shopAtive"]==0){
				$shopServiceStatus = 0;
			}
			$goodsDetails["serviceEndTime"] = str_replace('.5',':30',$goodsDetails["serviceEndTime"]);
			$goodsDetails["serviceEndTime"] = str_replace('.0',':00',$goodsDetails["serviceEndTime"]);
			$goodsDetails["serviceStartTime"] = str_replace('.5',':30',$goodsDetails["serviceStartTime"]);
			$goodsDetails["serviceStartTime"] = str_replace('.0',':00',$goodsDetails["serviceStartTime"]);
			$goodsDetails["shopServiceStatus"] = $shopServiceStatus;
			$goodsDetails['goodsDesc'] = htmlspecialchars_decode($goodsDetails['goodsDesc']);
			
			
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
			
			$this->assign("goodsImgs",$goods->getGoodsImgs());
			$this->assign("relatedGoods",$goods->getRelatedGoods($goodsId));
			$this->assign("goodsNav",$goods->getGoodsNav());
			$this->assign("goodsAttrs",$goods->getAttrs($obj));
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
			$this->display('default/goods_details');
		}else{
			$this->display('default/goods_notexist');
		}

	}
	
	/**
	 * 获取商品库存
	 * 
	 */
	public function getGoodsStock(){
		$data = array();
		$data['goodsId'] = (int)I('goodsId');
		$data['isBook'] = (int)I('isBook');
		$data['goodsAttrId'] = (int)I('goodsAttrId');
		$goods = D('Home/Goods');
		$goodsStock = $goods->getGoodsStock($data);
		echo json_encode($goodsStock);
		
	}
	
	/**
	 * 获取服务社区
	 * 
	 */
	public function getServiceCommunitys(){
		
		$areas = D('Home/Areas');
		$serviceCommunitys = $areas->getShopCommunitys();
		echo json_encode($serviceCommunitys);
	}
	
   /**
	* 分页查询-出售中的商品
	*/
	public function queryOnSaleByPage(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		//获取商家商品分类
		$m = D('Home/ShopsCats');
		$this->assign('shopCatsList',$m->queryByList($USER['shopId'],0));
		$m = D('Home/Goods');
    	$page = $m->queryOnSaleByPage($USER['shopId']);
    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign("umark","queryOnSaleByPage");
    	$this->assign("shopCatId2",I('shopCatId2'));
    	$this->assign("shopCatId1",I('shopCatId1'));
    	$this->assign("goodsName",I('goodsName'));
        $this->display("default/shops/goods/list_onsale");
	}
   /**
	* 分页查询-仓库中的商品
	*/
	public function queryUnSaleByPage(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		//获取商家商品分类
		$m = D('Home/ShopsCats');
		$this->assign('shopCatsList',$m->queryByList($USER['shopId'],0));
		$m = D('Home/Goods');
    	$page = $m->queryUnSaleByPage($USER['shopId']);
    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign("umark","queryUnSaleByPage");
    	$this->assign("shopCatId2",I('shopCatId2'));
    	$this->assign("shopCatId1",I('shopCatId1'));
    	$this->assign("goodsName",I('goodsName'));
        $this->display("default/shops/goods/list_unsale");
	}
   /**
	* 分页查询-在审核中的商品
	*/
	public function queryPenddingByPage(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		//获取商家商品分类
		$m = D('Home/ShopsCats');
		$this->assign('shopCatsList',$m->queryByList($USER['shopId'],0));
		$m = D('Home/Goods');
    	$page = $m->queryPenddingByPage($USER['shopId']);
    	$pager = new \Think\Page($page['total'],$page['pageSize']);
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign("umark","queryPenddingByPage");
    	$this->assign("shopCatId2",I('shopCatId2'));
    	$this->assign("shopCatId1",I('shopCatId1'));
    	$this->assign("goodsName",I('goodsName'));
        $this->display("default/shops/goods/list_pendding");
	}
	/**
	 * 跳到新增/编辑商品
	 */
    public function toEdit(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		//获取商品分类信息
		$m = D('Home/GoodsCats');
		$this->assign('goodsCatsList',$m->queryByList());
		$sm = D('Home/ShopsCats');
		$pkShopCats = $sm->getCatAndChild($USER['shopId']);
		$this->assign('pkShopCats',$pkShopCats);
		//获取商家商品分类
		$m = D('Home/ShopsCats');
		$this->assign('shopCatsList',$m->queryByList($USER['shopId'],0));
		//获取商品类型
		$m = D('Home/AttributeCats');
		$this->assign('attributeCatsCatsList',$m->queryByList());
		$m = D('Home/Goods');
		$object = array();
		$goodsId = (int)I('id',0);
    	if($goodsId>0){
    		$object = $m->get();
    		$packages = $m->getGoodsPackages($goodsId);
    		$this->assign('packages',$packages);
    	}else{
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
    	$this->assign("umark",I('umark'));
        $this->display("default/shops/goods/edit");
	}
	/**
	 * 新增商品
	 */
	public function edit(){
		$this->isShopLogin();
		$m = D('Home/Goods');
    	$rs = array();
    	if((int)I('id',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除商品
	 */
	public function del(){
		$this->isShopLogin();
		$m = D('Home/Goods');
		$rs = $m->del();
		$this->ajaxReturn($rs);
	}
	/**
	 * 批量设置商品状态
	 */
	public function goodsSet(){
		$this->isShopLogin();
		$m = D('Home/Goods');
		$rs = $m->goodsSet();
		$this->ajaxReturn($rs);
	}
	/**
	 * 批量删除商品
	 */
	public function batchDel(){
		$this->isShopLogin();
		$m = D('Home/Goods');
		$rs = $m->batchDel();
		$this->ajaxReturn($rs);
	}
	/**
	 * 修改商品上架/下架状态
	 */
	public function sale(){
		$this->isShopLogin();
		$m = D('Home/Goods');
		$rs = $m->sale();
		$this->ajaxReturn($rs);
	}
	
	
	
	/**
	 * 核对商品信息
	 */
	public function checkGoodsStock(){
	
		$m = D('Home/Cart');
		$catgoods = $m->checkGoodsStock();
		$this->ajaxReturn($catgoods);
	
	}
	
	/**
	 * 获取验证码
	 */
	public function getGoodsVerify(){
		$data = array();
		$data["status"] = 1;
		$verifyCode = md5(base64_encode("wstmall".date("Y-m-d")));
		$data["verifyCode"] = $verifyCode;
		$this->ajaxReturn($data);
	}
	
	/**
	 * 查询商品属性价格及库存
	 */
    public function getPriceAttrInfo(){
    	$goods = D('Home/Goods');
		$rs = $goods->getPriceAttrInfo();
		$this->ajaxReturn($rs);
    }
	/**
	 * 修改商品库存
	 */
    public function editStock(){
    	$this->isShopLogin();
    	$m = D('Home/Goods');
    	$rs = $m->editStock();
    	$this->ajaxReturn($rs);
    }
    
    /**
     * 修改商品库存,商品编号,价格
     */
    public function editGoodsBase(){
    	$this->isShopLogin();
    	$m = D('Home/Goods');
    	$rs = $m->editGoodsBase();
    	$this->ajaxReturn($rs);
    }
    
    /**
     * 获取商品搜索提示列表
     */
    public function getKeyList(){
    	$m = D('Home/Goods');
    	$areaId2 = $this->getDefaultCity();
    	$rs = $m->getKeyList($areaId2);
    	$this->ajaxReturn($rs);
    }
    
    /**
     * 修改 推荐/精品/新品/热销/上架
     */
    public function changSaleStatus(){
    	$this->isShopLogin();
    	$m = D('Home/Goods');
    	$rs = $m->changSaleStatus();
    	$this->ajaxReturn($rs);
    }
    
    /**
     * 上传商品数据
     */
    public function importGoods(){
    	$this->isShopLogin();
    	$config = array(
		        'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
		        'exts'          =>  array('xls','xlsx','xlsm'), //允许上传的文件后缀
		        'rootPath'      =>  './Upload/', //保存根路径
		        'driver'        =>  'LOCAL', // 文件上传驱动
		        'subName'       =>  array('date', 'Y-m'),
		        'savePath'      =>  I('dir','uploads')."/"
		);
		$upload = new \Think\Upload($config);
		$rs = $upload->upload($_FILES);
		$rv = array('status'=>-1);
		if(!$rs){
			$rv['msg'] = $upload->getError();
		}else{
			$m = D('Home/Goods');
    	    $rv = $m->importGoods($rs);
		}
    	$this->ajaxReturn($rv);
    }
    
    public function getGoodsByCat() {
    	$this->isShopLogin();
    	$m = D('Home/Goods');
    	$rs = $m->getGoodsByCat();
    	$this->ajaxReturn($rs);
    }
    
    public function getPackageGoods(){
    	$this->isShopLogin();
    	$m = D('Home/Goods');
    	$rs = $m->getPackageGoods();
    	$this->ajaxReturn($rs);
    }
    
    public function editGoodsPackages(){
    	$this->isShopLogin();
    	$m = D('Home/Goods');
    	$rs = $m->editGoodsPackages();
    	$this->ajaxReturn($rs);
    }
	
}