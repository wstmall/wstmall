<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 微信自定义列表服务类
 */
class WxMenusModel extends BaseModel {
	 /**
	  * 获取列表
	  */
	  public function queryByList($pid){
	     return $this->where('menuFlag=1 and parentId='.$pid)->order('menuSort asc,menuId asc')->select(); 
	  }
	  
	  /**
	   * 获取列表
	   */
	  public function listQuery(){
	  	$listMenu = $this->where('menuFlag=1 and parentId=0')->field('menuId,menuName')->order('menuSort asc')->select();
	  	for ($i = 0; $i < count($listMenu); $i++) {
	  		$parentId = $listMenu[$i]["menuId"];
	  		$listSon = $this->where('menuFlag=1 and parentId='.$parentId)->field('menuId,menuName')->order('menuSort asc')->select();
	  		$listMenu[$i]['listSon'] = empty($listSon)?'':$listSon;
	  	}
	  	return $listMenu;
	  }
	  
	  /**
	   * 获取指定对象
	   */
	  public function get(){
	  	return $this->where("menuId=".(int)I('id'))->find();
	  }
	  
	  /**
	   * 与微信菜单同步
	   */
	  public function synchroWx(){
	  	$rd = array('status'=>-1,'msg'=>'与微信同步失败,请清除缓存重试');
	  	$this->where('menuId>0')->delete();
	  	$wx = WXAdmin();
	  	$data = $wx->wxMenuGet();
	  	if(isset($data['errcode'])){
	  		if($data['errcode']!=0){
	  			$rd['msg']= '与微信同步失败,菜单为空';
	  			return $rd;
	  		}
	  	}
	  	if($data){
	  		$data = $data['menu']['button'];
	  		$type = array('click'=>1,'view'=>2,'scancode_push'=>3,'scancode_waitmsg'=>4,'pic_sysphoto'=>5,'pic_photo_or_album'=>6,'pic_weixin'=>7,'location_select'=>8,'media_id'=>9,'view_limited'=>10);
	  		$dataList = array();
	  		foreach( $data as $key=>$v){
	  			$data = array();
	  			$data['menuName'] = $v['name'];
	  			$data['createTime'] = date('Y-m-d H:i:s');
	  			$data['menuType'] = (isset($v['type']))?$type[$v['type']]:'';
	  			$data['menuKey'] = (isset($v['key']))?$v['key']:'';
	  			$data['menuSort'] = $key;
	  			$data['menuUrl'] = '';
	  			$data["menuFlag"] = 1;
	  			$rs = $this->add($data);
	  			if($v['sub_button']){
	  				foreach($v['sub_button'] as $keys=>$vs){
	  					$datas = [];
	  					$datas['menuName'] = $vs['name'];
	  					$datas['parentId'] = $rs;
	  					$datas['menuSort'] = $keys;
	  					$datas['createTime'] = date('Y-m-d H:i:s');
	  					$datas['menuType'] = (isset($vs['type']))?$type[$vs['type']]:'';
	  					$datas['menuKey'] = (isset($vs['key']))?$vs['key']:'';
	  					$datas['menuUrl'] = (isset($vs['url']))?$vs['url']:'';
	  					$data["menuFlag"] = 1;
	  					$dataList[] = $datas;
	  				}
	  			}
	  		}
	  		$this->addAll($dataList);
	  		$rd['msg']= '与微信同步成功';
	  		$rd['status']= 1;
	  	}
	  	return $rd;
	  }
	  
	  /**
	   * 同步到微信菜单
	   */
	  public function synchroAd(){
	  	$rd = array('status'=>-1,'msg'=>'菜单同步失败,请清除缓存重试');
	  	$rs = $this->where('menuFlag=1')->order('menuSort asc')->select();
	  	$arr = $this->makeNewArr($rs,0);
	  	header('content-type:text/html;charset=utf-8');
	  	$arr = json_encode($arr,JSON_UNESCAPED_UNICODE);
	  	$wx = WXAdmin();
	  	$data = $wx->wxMenuCreate($arr);
	  	if($data['errcode']==0){
	  		$rd['msg']= '菜单同步成功';
	  		$rd['status']= 1;
	  		return $rd;
	  	}
	  	return $rd;
	  }
	  function makeNewArr($data,$pId){
	  	$type = array(1=>'click',2=>'view',3=>'scancode_push',4=>'scancode_waitmsg',5=>'pic_sysphoto',6=>'pic_photo_or_album',7=>'pic_weixin',8=>'location_select',9=>'media_id',10=>'view_limited');
	  	$c=0;
	  	$newArr = array();
	  	foreach($data as $k=>$v){
	  		if($v['parentId']==$pId){
	  			$sub_button = $this->makeNewArr($data,$v['menuId']);
	  			if($pId==0){
	  				$arr = ['name'=>$v['menuName']];
	  				if(!empty($sub_button)){
	  					$arr['sub_button'] = $sub_button;
	  				}else{
	  					$arr['key']=$v['menuKey'];
	  					$arr['type']=$type[$v['menuType']];
	  					if($v['menuUrl']!='')
	  						$arr['url']=$v['menuUrl'];
	  				}
	  				$newArr['button'][] = $arr;
	  			}else{
	  				$newArr[$c]['name'] = $v['menuName'];
	  				$newArr[$c]['key'] = $v['menuKey'];
	  				$newArr[$c]['type'] =$type[$v['menuType']];
	  				if($v['menuUrl']!='')
	  					$newArr[$c]['url'] = $v['menuUrl'];
	  				++$c;
	  			}
	  		}
	  	}
	  	return $newArr;
	  }
	  
	  /**
	   * 修改名称
	   */
	  public function editName(){
	  	$rd = array('status'=>-1);
	  	$id = (int)I("id",0);
	  	$data = array();
	  	$data["menuName"] = I("menuName");
	  	if($this->checkEmpty($data)){
	  		$rs = $this->where("menuFlag=1 and menuId=".(int)I('id'))->save($data);
	  		if(false !== $rs){
	  			$rd['status']= 1;
	  		}
	  	}
	  	return $rd;
	  }
	  
	  /**
	   * 查询菜单个数
	   */
	  function menuNum($parentId){
	  	$rs = $this->where('parentId='.$parentId.' and menuFlag=1')->field('menuId')->select();
	  	return count($rs);
	  }
	  
	  /**
	   * 新增
	   */
	  public function insert(){
	  	$rd = array('status'=>-1,'msg'=>'操作失败');
	  	$id = (int)I("id",0);
	  	$data = array();
	  	$data["parentId"] = (int)I("parentId");
	  	$num = $this->menuNum($data["parentId"]);
	  	if($data['parentId']==0){
	  		if($num>=3){
	  			$rd['msg']="一级菜单数，个数应为1~3个 ";
	  			return $rd;
	  		}
	  	}else{
	  		if($num>=5){
	  			$rd['msg']="二级菜单数，个数应为1~5个 ";
	  			return $rd;
	  		}
	  	}
	  	$content = (int)I("content",0);
	  	if($content == 0){
	  		$data['menuType'] = 2;
	  	}
	  	$data["menuName"] = I("menuName");
	  	$data["menuUrl"] = I("menuUrl");
	  	$data["menuSort"] = (int)I("menuSort",0);
	  	$data["menuFlag"] = 1;
	  	if($this->checkEmpty($data,true)){
	  		$rs = $this->add($data);
	  		if(false !== $rs){
	  			$rd['msg']= '操作成功';
	  			$rd['status']= 1;
	  		}
	  	}
	  	return $rd;
	  }
	  /**
	   * 修改
	   */
	  public function edit(){
	  	$rd = array('status'=>-1,'msg'=>'操作失败');
	  	$id = (int)I("id",0);
	  	$data = array();
	  	$data["menuName"] = I("menuName");
	  	$data["menuUrl"] = I("menuUrl");
	  	$data["menuSort"] = (int)I("menuSort");
	  	if($this->checkEmpty($data)){
	  		$rs = $this->where("menuId=".(int)I('id',0))->save($data);
	  		if(false !== $rs){
	  			$rd['msg']= '操作成功';
	  			$rd['status']= 1;
	  
	  		}
	  	}
	  	return $rd;
	  }
	  
	  /**
	   * 删除
	   */
	  public function del(){
	  	$rd = array('status'=>-1);
	  	//获取子集
	  	$ids = array();
	  	$ids[] = (int)I('id');
	  	$ids = $this->getChild($ids,$ids);
	  	$this->menuFlag = -1;
	  	$rs = $this->where(" menuId in(".implode(',',$ids).")")->save();
	  	if(false !== $rs){
	  		$rd['status']= 1;
	  	}
	  	return $rd;
	  }
	  
	  /**
	   * 迭代获取下级
	   */
	  public function getChild($ids = array(),$pids = array()){
	  	$sql = "select menuId from __PREFIX__wx_menus where menuFlag=1 and parentId in(".implode(',',$pids).")";
	  	$rs = $this->query($sql);
	  	if(count($rs)>0){
	  		$cids = array();
	  		foreach ($rs as $key =>$v){
	  			$cids[] = $v['menuId'];
	  		}
	  		$ids = array_merge($ids,$cids);
	  		return $this->getChild($ids,$cids);
	  
	  	}else{
	  		return $ids;
	  	}
	  }
};
?>