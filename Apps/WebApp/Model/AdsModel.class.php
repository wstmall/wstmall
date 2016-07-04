<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 广告类
 */
class AdsModel extends BaseModel {
	/**
	 * 获取广告
	 */
	public function getAds($areaId2,$adType){
		//获取所在省份
		$sql = "select parentId from ".$this->tablePrefix."areas where areaId=".$areaId2;
		$rs = $this->queryRow($sql);
		$areaId1 = $rs['parentId'];
		$today = date("Y-m-d");
		$sql = "select * from ".$this->tablePrefix."ads WHERE (areaId2 = $areaId2 or areaId1 = 0 or (areaId1=".$areaId1." and areaId2=0))
				AND adStartDate<='$today' AND adEndDate >='$today' and adPositionId=".$adType." order by adSort asc";
		$rs = $this->query($sql);
		$data = array();
		foreach ($rs as $key =>$v){
			$rs[$key]['adFile'] = WSTMoblieImg($v['adFile']);
			$data[] = $rs[$key];
		}
		return $data;
	}
}