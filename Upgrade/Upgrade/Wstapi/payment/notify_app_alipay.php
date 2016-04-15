<?php

// 绑定Home模块到当前入口文件
$_GET['m'] = 'App';
$_GET['c'] = 'Apis';
$_GET['a'] = 'notifyurl';
define('APP_PATH','../../Apps/');
require '../../ThinkPHP/ThinkPHP.php';

?>