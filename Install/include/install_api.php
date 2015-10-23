<?php
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 广告控制器
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@set_time_limit(0);
@set_magic_quotes_runtime(0);
define('IN_WSTMALL', TRUE);
define('INSTALL_ROOT', dirname(dirname(dirname(__FILE__))));
define('INSTALL_PATH', dirname(dirname(__FILE__)));
if(file_exists(INSTALL_PATH.'/install.ok'))return -1;
require 'install_var.php';
require 'install_function.php';

if(function_exists('mysql_connect')) {
    require 'install_mysql.php';
}
$db = new MySql;
$db_host = trim($_POST['db_host']);
$db_user = trim($_POST['db_user']);
$db_pass = trim($_POST['db_pass']);
$db_prefix = trim($_POST['db_prefix']);
$db_name = trim($_POST['db_name']);
$admin_name = trim($_POST['admin_name']);
$admin_password = trim($_POST['admin_password']);
$db_type = (int)trim($_POST['db_demo']);
$act = $_POST['act'];
$db->connect($db_host, $db_user, $db_pass, $db_name, DBCHARSET);
if($act=='list'){
	$list = array();
    $dh=opendir('../data/'.$db_type);
	while (($file=readdir($dh))!== false) {
		if($file!="." && $file!="..") {
			$list[] = $file;
		}
	}
	echo json_encode(array('status'=>1,'list'=>$list));
}else if($act=='insert'){
	$sql = "../data/".$db_type."/wst_".$_POST['table'].".sql";
	$sql = file_get_contents($sql);
	runquery($sql,$db_prefix);
	if(intval($_POST['isFinish'])==1){
		$sql = 'UPDATE '.$db_prefix.'staffs SET loginName="'.$admin_name.'",loginPwd="'.md5($admin_password."9365").'" WHERE staffId=1';
	    runquery($sql,$db_prefix);
	    initConfig($db_host,$db_user,$db_pass,$db_prefix,$db_name);
	    if(!file_exists(INSTALL_ROOT."/Apps/Common/Conf/config.php")){
	    	echo json_encode(array('status'=>-1,'msg'=>'无法创建配置文件，请检查Apps/Common/Conf目录是否有写入权限!'));exit();
	    }
	    $counter_file = INSTALL_PATH.'/install.ok';
		$fopen = fopen($counter_file,'wb');
		fputs($fopen,   date('Y-m-d H:i:s'));
		fclose($fopen);
		if(file_exists(INSTALL_PATH.'/install.ok')){
	        echo json_encode(array('status'=>1));exit();
		}else{
			echo json_encode(array('status'=>-1,'msg'=>'无法创建配置文件，请检查Install目录是否有写入权限!'));exit();
		}
    }
    echo json_encode(array('status'=>1));
}

?>