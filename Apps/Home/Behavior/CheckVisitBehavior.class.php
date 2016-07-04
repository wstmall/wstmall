<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Home\Behavior;
/**
 * 访问检测 并自动加载语言包
 */
class CheckVisitBehavior {

    // 行为扩展的执行入口必须是run
    public function run(&$params){
    	session_start();
		if(WSTIsMobile() && session('WST_VIEW')!='PC'){
			header("Location:".U('WebApp/Index/index'));
		}
    }
}
