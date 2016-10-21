<?php
 namespace Home\Action;;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 商城消息控制器
 */
class MessagesAction extends BaseAction{
    /**
	 * 分页查询
	 */
	public function queryByPage(){
		$this->isLogin();
		$USER = session('WST_USER');
		$m = D('Home/Messages');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
    	$this->assign("umark","queryMessageByPage");
    	if($USER['loginTarget']=='User'){
            $this->display("default/users/messages/list");
    	}else{
    		$this->display("default/shops/messages/list");
    	}
	}

    /**
     * 显示详情页面
     */
    public function showMessage(){
        $info = D('Home/Messages')->get();
        $USER = session('WST_USER');
        $this->assign('info',$info);
        if($USER['loginTarget']=='User'){
            $this->display("default/users/messages/show");
        }else{
            $this->display("default/shops/messages/show");
        }
    }

    public function batchDel(){
        $re = D('Home/Messages')->batchDel();
        $this->ajaxReturn($re);
    }
};
?>