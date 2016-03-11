<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 会员服务类
 */
class UsersModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	//检测账号
	 	$hasLoginName = self::checkLoginKey(I("loginName"));
	    if($hasLoginName['status']<=0){
	 		$rd = array('status'=>-2);
	 		return $rd;
	 	}
	 	if(I("userPhone")!=''){
	 		$hasUserPhone = self::checkLoginKey(I("userPhone"));
		 	if($hasUserPhone['status']<=0){
		 		$rd = array('status'=>-2);
		 		return $rd;
		 	}
	 	}
	 	if(I("userEmail")!=''){
		 	$hasUserEmail = self::checkLoginKey(I("userEmail"));
		 	if($hasUserEmail['status']<=0){
		 		$rd = array('status'=>-2);
		 		return $rd;
		 	}
	 	}
	 	//创建数据
	 	$id = I("id",0);
		$data = array();
		$data["loginName"] = I("loginName");
		$data["loginSecret"] = rand(1000,9999);
		$data["loginPwd"] = md5(I('loginPwd').$data['loginSecret']);
		if($this->checkEmpty($data)){
			$data["userPhoto"] = I("userPhoto");
			$data["userName"] = I("userName");
			$data["userStatus"] = I("userStatus",0);
			$data["userType"] = (int)I("userType",0);
			$data["userSex"] = (int)I("userSex",0);
			$data["userEmail"] = I("userEmail");
			$data["userPhone"] = I("userPhone");
			$data["userQQ"] = I("userQQ");
			$data["userScore"] = I("userScore",0);
		    $data["userTotalScore"] = I("userTotalScore",0);
		    $data["userFlag"] = 1;
		    
		    $data["createTime"] = date('Y-m-d H:i:s');
			$m = M('users');
			$rs = $m->add($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
     /**
	  * 修改
	  */
	 public function edit(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I('id',0);
	 	//检测账号
	 	if(I("userPhone")!=''){
	        $hasUserPhone = self::checkLoginKey(I("userPhone"),$id);
	        if($hasUserPhone['status']<=0){
		        $rd = array('status'=>-2);
		 		return $rd;
	        }
	 	}
	 	if(I("userEmail")!=''){
		 	$hasUserEmail = self::checkLoginKey(I("userEmail"),$id);
		 	if($hasUserEmail['status']<=0){
		 		$rd = array('status'=>-2);
		 		return $rd;
		 	}
		 	
	 	}
	 	//修改数据
		$m = M('users');
		$data = array();
		$data["userScore"] = (int)I("userScore",0);
		$data["userTotalScore"] = (int)I("userTotalScore",0);
		if($this->checkEmpty($data,true)){	
			$data["userName"] = I("userName");
			$data["userPhoto"] = I("userPhoto");
			$data["userSex"] = (int)I("userSex",0);
		    $data["userQQ"] = I("userQQ");
		    $data["userPhone"] = I("userPhone");
		    $data["userEmail"] = I("userEmail");
			$rs = $m->where("userId=".$id)->save($data);
			if(false !== $rs){
				$rd['status']= 1;
				
			}
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get(){
	 	$m = M('users');
		return $m->where("userId=".(int)I('id'))->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
        $m = M('users');
        $map = array();
	 	$sql = "select * from __PREFIX__users where userFlag=1 ";
	 	if(I('loginName')!='')$sql.=" and loginName LIKE '%".WSTAddslashes(I('loginName'))."%'";
	 	if(I('userPhone')!='')$sql.=" and userPhone LIKE '%".WSTAddslashes(I('userPhone'))."%'";
	 	if(I('userEmail')!='')$sql.=" and userEmail LIKE '%".WSTAddslashes(I('userEmail'))."%'";
	 	if(I('userType',-1)!=-1)$sql.=" and userType=".I('userType',-1);
	 	$sql.="  order by userId desc";
		$rs = $m->pageQuery($sql);
		//计算等级
		if(count($rs)>0){
			$m = M('user_ranks');
			$urs = $m->select();
			foreach ($rs['root'] as $key=>$v){
				foreach ($urs as $rkey=>$rv){
					if($v['userTotalScore']>=$rv['startScore'] && $v['userTotalScore']<$rv['endScore']){
					   $rs['root'][$key]['userRank'] = $rv['rankName'];
					}
				}
			}
		}
		return $rs;
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $m = M('users');
	     $sql = "select * from __PREFIX__users order by userId desc";
		 $rs = $m->find($sql);
		 return $rs;
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I('id');
	 	$m = M('users');
	 	//获取用户类型
	 	$userType = $m->where('userId='.$id)->getField('userType',1);
	 	$m->userFlag = -1;
		$rs = $m->where(" userId=".$id)->save();
		if(false !== $rs){
		   $rd['status']= 1;
		   //如果是商家还要下架他的商品
		   if($userType==1){
		   	    $m = M('shops');
		   	    $m->shopFlag = -1;
		   	    $m->shopStatus=-2;
		   	    $rs = $m->where(" userId=".$id)->save();
		   	    $shopId = $m->where('userId='.$id)->getField('shopId',1);
				$sql = "update __PREFIX__goods set isSale=0,goodsStatus=-1 where shopId=".$shopId;
			 	$m->execute($sql);
		   }
		}
		
		return $rd;
	 }
	 /**
	  * 查询登录关键字
	  */
	 public function checkLoginKey($val,$id = 0){
	 	$rd = array('status'=>-1);
	 	if($val=='')return $rd;
	 	$sql = " (loginName ='%s' or userPhone ='%s' or userEmail='%s') and userFlag=1";
	 	$keyArr = array($val,$val,$val);
	 	if($id>0){
	 		$sql.=" and userId!=".$id;
	 	}
	 	$m = M('users');
	 	$rs = $m->where($sql,$keyArr)->count();
	    if($rs==0)$rd['status'] = 1;
	    return $rd;
	 }
	 
	 
	 /**********************************************************************************************
	  *                                             账号管理                                                                                                                              *
	  **********************************************************************************************/
     /**
      * 获取账号分页列表
      */
	 public function queryAccountByPage(){
        $m = M('users');
	 	$sql = "select * from __PREFIX__users where userFlag=1 ";
	 	if(I('loginName')!='')$sql.=" and loginName LIKE '%".WSTAddslashes(I('loginName'))."%'";
	 	if(I('userStatus',-1)!=-1)$sql.=" and userStatus=".(int)I('userStatus',-1);
	 	if(I('userType',-1)!=-1)$sql.=" and userType=".(int)I('userType',-1);
	 	$sql.="  order by userId desc";
		$rs = $m->pageQuery($sql);
		//计算等级
		if(count($rs)>0){
			$m = M('user_ranks');
			$urs = $m->select();
			foreach ($rs['root'] as $key=>$v){
				foreach ($urs as $rkey=>$rv){
					if($v['userTotalScore']>=$rv['startScore'] && $v['userTotalScore']<$rv['endScore']){
					   $rs['root'][$key]['userRank'] = $rv['rankName'];
					}
				}
			}
		}
		return $rs;
	 }
	 /**
	  * 编辑账号状态
	  */
	 public function editUserStatus(){
	 	$rd = array('status'=>-1);
	 	if(I('id',0)==0)return $rd;
	 	$m = M('users');
	 	$m->userStatus = (I('userStatus')==1)?1:0;
	 	$rs = $m->where("userId=".I('id',0))->save();
	    if(false !== $rs){
			$rd['status']= 1;
		}
	 	return $rd;
	 }
	 /**
	  * 获取账号信息
	  */
	 public function getAccountById(){
	 	 $m = M('users');
		 $rs = $m->where('userId='.I('id',0))->getField('userId,loginName,userStatus,userType',1);
		 return current($rs);
	 }
	 /**
	  * 修改账号信息
	  */
	 public function editAccount(){
	 	$rd = array('status'=>-1);
	 	if(I('id')=='')return $rd;
	 	$m = M('users');
	 	$loginSecret = $m->where("userId=".I('id'))->getField('loginSecret');
	 	if(I('loginPwd')!='')$m->loginPwd = md5(I('loginPwd').$loginSecret);
	 	$m->userStatus = I('userStatus',0);
	 	$rs = $m->where('userId='.(int)I('id'))->save();
	    if(false !== $rs){
			$rd['status']= 1;
		}
		return $rd;
	 }
};
?>