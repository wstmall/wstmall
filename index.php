<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
// 定义应用目录
define('APP_PATH','./Apps/');
/* 扩展目录*/
define('EXTEND_PATH', APP_PATH.'Library/');
//进入安装目录
if(is_dir("Install") && !file_exists("Install/install.ok")){
	header("Location:Install/index.php");
	exit();
}

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
