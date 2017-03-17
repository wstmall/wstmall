<?php
/**
 * 微信配置
 */
function WXAdmin(){
	require 'ThinkPHP/Library/Vendor/Wechat/WSTWechat.class.php';
    return new WSTWechat($GLOBALS['CONFIG']['WeiXinAppId'],$GLOBALS['CONFIG']['WeiXinAppKey']);
}