<?php
 namespace Common\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 基础服务类
 */
use Think\Model;
class BaseModel extends Model {
    /**
     * 用来处理内容中为空的判断
     */
	public function checkEmpty($data,$isDie = false){
	    foreach ($data as $key=>$v){
			if(trim($v)==''){
				if($isDie)die("{status:-1,'key'=>'$key'}");
				return false;
			}
		}
		return true;
	}
	
	/**
	 * 输入sql调试信息
	 */
	public function logSql($m){
		echo $m->getLastSql();
	}
	
	
	/**
	 * 获取一行记录
	 */
	public function queryRow($sql){
		$plist = $this->query($sql);
		return $plist[0];
	}
	
	
	/**
	 * 格式化查询语句中传入的in 参与，防止sql注入
	 * @param  $split
	 * @param  $str
	 */
	public function formatIn($split,$str){
		if(is_array($str)){
			$strdatas = $str;
		}else{
			$strdatas = explode($split,$str);
		}
		
		$data = array();
		for($i=0;$i<count($strdatas);$i++){
			$data[] = (int)$strdatas[$i];
		}
		$data = array_unique($data);
		return implode($split,$data);
	}
};
?>