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
class ArticlesModel extends BaseModel {
   
	
	/**
     * 获取文章列表
     */
 	public function getArticleList(){
 		$articleList = S("WST_CACHE_ARTICLE_LIST");
 		if(!$articleList){
			$sql ="SELECT artcat.catName, art.articleId,art.catId,art.articleTitle,art.articleImg FROM __PREFIX__article_cats artcat,__PREFIX__articles art 
					WHERE artcat.catId = art.catId AND artcat.catType=1 AND artcat.catFlag = 1 AND artcat.isShow=1 AND art.isShow=1 ORDER BY artcat.catSort ,art.articleId";
			$rs = $this->query($sql);
			$articles = array();
			for ($i=0;$i<count($rs);$i++){
				$articleList[$rs[$i]["catId"]]["articlecats"][] = $rs[$i];
				$articleList[$rs[$i]["catId"]]["catName"] = $rs[$i]["catName"];
			}
			S("WST_CACHE_ARTICLE_LIST",$articleList,2592000);
 		}
		return $articleList;
	}
	
	/**
	 * 获取文章详情
	 */
	public function getArticle($obj){
		$articleId = (int)$obj["articleId"];
		$sql ="SELECT * FROM __PREFIX__articles WHERE articleId=$articleId AND isShow=1  ";
		$article = $this->queryRow($sql);
		return $article;
	}
	
    /**
	 * 查询网站帮助
	 */
    public function getHelps(){
    	$articles = S("WST_CACHE_ARTICLE_INDEX");
    	if(!$articles){
			$sql ="SELECT artcat.catName, art.articleId,art.catId,art.articleTitle,art.articleImg FROM __PREFIX__article_cats artcat,__PREFIX__articles art 
					WHERE artcat.catId = art.catId AND artcat.catType=1 AND artcat.catFlag = 1 AND artcat.isShow=1 AND art.isShow=1 ORDER BY artcat.catSort ,art.articleId";
			
			$rs = $this->query($sql);
			$articles = array();
			for ($i=0;$i<count($rs);$i++){
				$articles[$rs[$i]["catId"]]["articlecats"][] = $rs[$i];
				$articles[$rs[$i]["catId"]]["catName"] = $rs[$i]["catName"];
			}
			S("WST_CACHE_ARTICLE_INDEX",$articles,2592000);
    	}
		return $articles;
	}
}