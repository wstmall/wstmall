<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 文章服务类
 */
use Think\Model;
class ArticlesModel extends BaseModel {
   
	
	/**
     * 获取文章列表
     */
 	public function getArticleList(){
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
	
	/**
	 * 获取文章详情
	 */
	public function getArticle($obj){
		$articleId = $obj["articleId"];
		$sql ="SELECT * FROM ".$this->tablePrefix."articles WHERE articleId=$articleId AND isShow=1  ";
		$rs = $this->queryRow($sql);
		return $rs;
	}
}