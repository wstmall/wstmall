<?php
namespace WebApp\Model;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商城配置类
 */
class SystemModel extends BaseModel {
    /**
     * 获取商城配置文件
     */
    public function loadConfigs(){
		$configs = WSTDataFile('mall_config');
		if(!$configs){
			$sql = "select fieldCode,fieldValue from __PREFIX__sys_configs order by parentId asc,fieldSort asc";
			$rs = $this->query($sql);
			$configs = array();
			if(count($rs)>0){
				foreach ($rs as $key=>$v){
					$configs[$v['fieldCode']] = $v['fieldValue'];
				}
			}
			unset($rs);
			WSTDataFile('mall_config','',$configs);
		}
		return $configs;
	}
	/**
	 * 获取商品配置分类信息
	 */
    public function loadConfigsForParent(){
		$sql = "select * from ".$this->tablePrefix."sys_configs where fieldType!='hidden' order by parentId asc,fieldSort asc";
		$rs = $this->query($sql);
		$configs = array();
		if(count($rs)>0){
			foreach ($rs as $key=>$v){
				if($v['fieldType']=='radio' || $v['fieldType']=='select'){
					$v['txt'] = explode('||',$v['valueRangeTxt']);
					$v['val'] = explode(',',$v['valueRange']);
				}
				$configs[$v['parentId']][] = $v;
			}
		}
		unset($rs);
		return $configs;
	}
}