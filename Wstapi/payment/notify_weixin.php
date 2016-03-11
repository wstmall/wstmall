<?php

// 绑定Home模块到当前入口文件
$_GET['m'] = 'Home';
$_GET['c'] = 'WxPay';
$_GET['a'] = 'notify';
define('APP_PATH','../../Apps/');
require '../../ThinkPHP/ThinkPHP.php';

?>