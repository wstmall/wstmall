<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 友情连接服务类
 */
use Think\Model;
class FriendlinksModel extends BaseModel {
	/**
     * 获取友情链接
     */
	public function getFriendlinks(){
		$sql = "select * from ".$this->tablePrefix."friendlinks  order by friendlinkSort asc";
		$rs = $this->query($sql);
		return $rs;
	}
	
	/**
	 * 查询网站帮助
	 */
    public function getHelps(){
		$sql ="SELECT artcat.catName, art.articleId,art.catId,art.articleTitle,art.articleImg FROM ".$this->tablePrefix."article_cats artcat,".$this->tablePrefix."articles art 
				WHERE artcat.catId = art.catId AND artcat.catType=1 AND artcat.catFlag = 1 AND artcat.isShow=1 AND art.isShow=1 ORDER BY artcat.catSort ,art.articleId";
		
		$rs = $this->query($sql);
		$articles = array();
		for ($i=0;$i<count($rs);$i++){
			$articles[$rs[$i]["catId"]]["articlecats"][] = $rs[$i];
			$articles[$rs[$i]["catId"]]["catName"] = $rs[$i]["catName"];
		}
		return $articles;
	}
}