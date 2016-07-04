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
class GoodsCatModel extends BaseModel {

	/**
	 * 获取商品分类
	 */
	public function getGoodsCats(){
		$rs1 = S("WST_CACHE_GOODS_CAT_MOB");
		if(!$rs1){
			//查询一级分类
			$sql = "select catId id,catName name,parentId from __PREFIX__goods_cats WHERE parentId = 0 AND isShow =1 AND catFlag = 1 order by catSort asc";
			$trs1 = $this->query($sql);
			$rs1 = array();
			$rs2 = array();
			$maprs = array();
			$ids = array();
			foreach ($trs1 as $key =>$v){
				$ids[] = $v['id'];
			}
		    //查询二级分类
			$sql = "select catId id,catName name,parentId from __PREFIX__goods_cats WHERE parentId in(".implode(',',$ids).") AND isShow =1 AND catFlag = 1 order by catSort asc ";
			$trs2 = $this->query($sql);
			$ids = array();
			foreach ($trs2 as $v2){
				$ids[] = $v2['id'];
				$maprs[$v2['parentId']][] = $v2;
			}
			//查询三级分类
			$sql = "select catId id,catName name,parentId from __PREFIX__goods_cats WHERE parentId in(".implode(',',$ids).") AND isShow =1 AND catFlag = 1 order by catSort asc ";
			$trs3 = $this->query($sql);
			$ids = array();
			foreach ($trs3 as $v2){
				$maprs[$v2['parentId']][] = $v2;
			}
			//倒序建立樹形
			foreach ($trs2 as $v2){
				$v2['childList'] = $maprs[$v2['id']];
				$rs2[] = $v2;
			}
			foreach ($trs1 as $v2){
				foreach ($rs2 as $vv2){
					if($vv2['parentId']==$v2['id']){
						$v2['childList'][] = $vv2;
					}
				}
				$rs1[] = $v2;
			}
			S("WST_CACHE_GOODS_CAT_MOB",$rs1,31536000);
		}
		return $rs1;
	}
	
}