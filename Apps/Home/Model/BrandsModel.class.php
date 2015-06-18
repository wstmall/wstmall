<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 品牌服务类
 */
use Think\Model;
class BrandsModel extends BaseModel {
     /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $m = M('brands');
	     return $m->where('brandFlag=1')->select();
	  }
	
    /**
	  * 根据城市获取品牌列表
	  */
	public function queryBrandsByCity(){
		$areaId3 = I("areaId3",0);
		$brandName = I("brandName");
		
		$sql = "SELECT bs.* FROM __PREFIX__brands bs,__PREFIX__shops sp,__PREFIX__goods g
				WHERE bs.brandId=g.brandId AND g.shopId=sp.shopId AND bs.brandFlag = 1";
		if($areaId3>0){
			$sql .= " AND sp.areaId3 = $areaId3";
		}
		if($brandName!=""){
			$sql .= " AND bs.brandName like '%$brandName%'";
		}
		$sql.=" group by bs.brandId ";
		$rs = $this->query($sql);
		return $rs;
	}
	
     /**
	  * 获取列表
	  */
	  public function queryBrandsByCat($catId){
	  	 $rs = array('status'=>1);
	     $sql = "select b.brandId,b.brandName from __PREFIX__goods_cat_brands cb,__PREFIX__brands b where cb.brandId=b.brandId and catId=".$catId;
	     $rs['list'] = $this->query($sql);
		 return $rs;
	  }
	
}