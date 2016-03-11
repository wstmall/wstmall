<?php

// 绑定Home模块到当前入口文件
$_GET['m'] = 'WebApp';
$_GET['c'] = 'Payments';
$_GET['a'] = 'notify';
define('APP_PATH','../../Apps/');
require '../../ThinkPHP/ThinkPHP.php';

?>