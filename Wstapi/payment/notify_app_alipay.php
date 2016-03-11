<?php

// 绑定Home模块到当前入口文件
$_GET['m'] = 'App';
$_GET['c'] = 'Pay';
$_GET['a'] = 'notify';
define('APP_PATH','../../Apps/');
require '../../ThinkPHP/ThinkPHP.php';

?>