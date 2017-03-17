<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 风格服务类
 */
class StylesModel extends BaseModel {
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
		 $rs = $this->select();
		 $styles = array();
		 foreach($rs as $key => $v){
            $styles[$v['styleSys']][] = $v;
		 }
		 return $styles;
	  }
	  
	 /**
	  * 删除
	  */
	 public function changeStyle(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I('id');
	 	$style = $this->where('id='.$id)->find();
	 	$data = array();
	 	$data['isUse'] = 0;
	    $this->where(array('styleSys'=>$style['styleSys']))->save($data);
        $data['isUse'] = 1;
        $rs = $this->where('id='.$id)->save($data);
		if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
};
?>