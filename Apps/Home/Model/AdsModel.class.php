<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 广告服务类
 */
use Think\Model;
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
		$sql = "select * from ".$this->tablePrefix."ads WHERE (areaId2 = $areaId2 or areaId1 = 0 or areaId1=".$areaId1.")
				AND adStartDate<='$today' AND adEndDate >='$today' and adPositionId=".$adType." order by adSort asc";
		$rs = $this->query($sql);
		$data = array();
		for($i = 0; $i < count($rs); $i++){
			$row = $rs[$i];
			$data[] = $row ;
		}
		return $data;
	}
	/**
	 * 获取主页分类广告
	 */
	public function getAdsByCat($areaId2){
		//获取所在省份
		$sql = "select parentId from ".$this->tablePrefix."areas where areaId=".$areaId2;
		$rs = $this->queryRow($sql);
		$areaId1 = $rs['parentId'];
		$today = date("Y-m-d");
		$sql = "select * from ".$this->tablePrefix."ads WHERE (areaId2 = $areaId2 or areaId1 = 0 or areaId1=".$areaId1.")
				AND adStartDate<='$today' AND adEndDate >='$today' and adPositionId>0 order by adSort asc";
		$rs = $this->query($sql);
		$ads = array();
		if(count($rs)>0){
			foreach($rs as $key => $v){
				$ads[$v['adPositionId']][] = $v;
			}
		}
		return $ads;
	}
	/**
	 * 广告统计
	 */
	public function statistics($adId){
		$sql = "UPDATE ".$this->tablePrefix."ads set adClickNum = adClickNum+1 WHERE adId = $adId";		
		$rs = $this->query($sql);
	}
}