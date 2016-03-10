<?php
/**
 * 获取指定位置的导航菜单
 * @param int $type 导航位置
 */
function WSTNavigation($type=0){
	$URL_HTML_SUFFIX = C('URL_HTML_SUFFIX');
	$cururl =  U(MODULE_NAME."/".CONTROLLER_NAME."/".ACTION_NAME);
	$cururl = str_ireplace(".".$URL_HTML_SUFFIX,'',$cururl);
	$areaId2 = (int)session('areaId2');
	$rs = F('navigation/'.$areaId2);
	if(!$rs){
		$m = M();
		//获取所在省份
	    $sql = "select parentId from __PREFIX__areas where areaId=".$areaId2;
		$areaId1Rs = $m->query($sql);
		$areaId1 = (int)$areaId1Rs[0]['parentId'];
		$sql = "select navType,navTitle,navUrl,isShow,isOpen 
		  from __PREFIX__navs where isShow=1 and (areaId1=0 or areaId1=".$areaId1.") and (areaId2=0 or areaId2=".$areaId2.") 
		  order by navType asc,navSort asc";
	    $rs = $m->query($sql);
	    F('navigation/'.$areaId2,$rs);
	}
	foreach ($rs as $key =>$v){
		$rs[$key]['url'] = $cururl;
		if(stripos($v['navUrl'],'https://')===false &&  stripos($v['navUrl'],'http://')===false){
			$rs[$key]['navUrl'] = WSTDomain()."/".$rs[$key]['navUrl'];
		}
		$rs[$key]['active'] = (stripos($rs[$key]['navUrl'],$cururl)!==false)?1:0;
		$rs[$key]['end'] = ($key==count($rs)-1)?1:0;
	}
	//分组
	$data = array();
	foreach ($rs as $key =>$v){
		$data[$v['navType']][] = $v;
	}
	return $data[$type];
}

/**
 * 货币枨式化
 * @param unknown $number
 */
function WSTMoney($number,$lc="en_US"){
	setlocale(LC_MONETARY, $lc);
	return money_format("%=*(#10.2n", $number);
}

/**
 * 获取首页商品分类列表
 */
function WSTGoodsCats(){
    $cats = S("WST_CACHE_GOODS_CAT_WEB");
	if(!$cats){
		$m = M();
		$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = 0 AND isShow =1 AND catFlag = 1 order by catSort asc";
		$rs1 = $m->query($sql);
		$cats = array();
		for ($i = 0; $i < count($rs1); $i++) {
			$cat1Id = $rs1[$i]["catId"];
			$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = $cat1Id AND isShow =1 AND catFlag = 1 order by catSort asc";
			$rs2 = $m->query($sql);
			$cats2 = array();
			for ($j = 0; $j < count($rs2); $j++) {
				$cat2Id = $rs2[$j]["catId"];
				$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = $cat2Id AND isShow =1 AND catFlag = 1 order by catSort asc";
				$rs3 = $m->query($sql);
				$cats3 = array();
				for ($k = 0; $k < count($rs3); $k++) {
					$cats3[] = $rs3[$k];
				}
				$rs2[$j]["catChildren"] = $cats3;
				$cats2[] = $rs2[$j];
			}
			$rs1[$i]["catChildren"] = $cats2;
			$cats[] = $rs1[$i];
		}
		S("WST_CACHE_GOODS_CAT_WEB",$cats,31536000);
	}
	return $cats;
}

/**
 * 获取购物车数量
 */
function WSTCartNum(){
	$shopcart = session("WST_CART")?session("WST_CART"):array();
	return count($shopcart);
}

/**
 * 根据IP获取城市
 */
function WSTIPAddress(){
	$url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP; 
    $ch = curl_init($url); 
    curl_setopt($ch, CURLOPT_ENCODING ,'utf8'); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $location = curl_exec($ch); 
    curl_close($ch);
    if($location){
    	$location = json_decode($location);
    	return array('province'=>$location->province,'city'=>$location->city,'district'=>$location->district);
    }
    return array();
}


