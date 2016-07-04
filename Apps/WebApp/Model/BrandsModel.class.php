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
class BrandsModel extends BaseModel {
	
	/**
	 * 品牌馆列表
	 */
	public function getBrandsList(){
		$areaId3 = (int)I("areaId3");
		$brandName = WSTAddslashes(I("brandName"));
		if($brandName==''){
			$brands = S("WST_BRANDS_001_".$areaId3);
			if(!$brands){
				$sql = "SELECT bs.brandId,bs.brandName,bs.brandIco FROM __PREFIX__brands bs,__PREFIX__shops sp,__PREFIX__goods g,__PREFIX__goods_cat_brands gcb
						WHERE bs.brandId=g.brandId AND g.shopId=sp.shopId AND gcb.brandId=bs.brandId AND bs.brandFlag = 1";
				if($areaId3>0){
					$sql .= " AND sp.areaId3 = $areaId3";
				}
				$sql.=" group by bs.brandId ";
				$brands = $this->query($sql);
				S("WST_BRANDS_001_".$areaId3,$brands,2592000);
			}
		}else{
			$sql = "SELECT bs.brandId,bs.brandName,bs.brandIco FROM __PREFIX__brands bs,__PREFIX__shops sp,__PREFIX__goods g,__PREFIX__goods_cat_brands gcb
						WHERE bs.brandId=g.brandId AND g.shopId=sp.shopId AND gcb.brandId=bs.brandId AND bs.brandFlag = 1";
			if($areaId3>0){
				$sql .= " AND sp.areaId3 = $areaId3";
			}
			if($brandName!=""){
				$sql .= " AND bs.brandName like '%$brandName%'";
			}
			$sql.=" group by bs.brandId ";
			$brands = $this->query($sql);
		}
		return $brands;
	}
	
}