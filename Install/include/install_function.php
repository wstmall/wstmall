<?php
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 */
function env_check(&$env_items) {
	foreach($env_items as $key => $item) {
		$env_items[$key]['status'] = 1;
		if($key == 'os') {
			$env_items[$key]['current'] = PHP_OS;
		} elseif($key == 'php') {
			$env_items[$key]['current'] = PHP_VERSION;
		} elseif($key == 'attachmentupload') {
			if(@ini_get('file_uploads')){
				$env_items[$key]['current'] =  ini_get('upload_max_filesize');
			}else{
				$env_items[$key]['status'] = -1;
				$env_items[$key]['current'] = '没有开启文件上传';
			}
		} elseif($key == 'gdversion') {
			if(extension_loaded('gd')){
				$tmp = gd_info();
			    $env_items[$key]['current'] = empty($tmp['GD Version']) ? '' : $tmp['GD Version'];
			    unset($tmp);
			}else{
				$env_items[$key]['current'] = "没有开启GD扩展";
				$env_items[$key]['status'] = -1;
			}
		} elseif($key == 'diskspace') {
			if(function_exists('disk_free_space')) {
				$env_items[$key]['current'] = floor(disk_free_space(INSTALL_ROOT) / (1024*1024)).'M';
			} else {
				$env_items[$key]['current'] = '未知的磁盘空间';
				$env_items[$key]['status'] = 0;
			}
		}
	}
	return $env_items;
}

function dir_check(&$dir_items) {
	foreach($dir_items as $key => $item) {
		$item_path = $item['path'];
		if(!dir_writeable(INSTALL_ROOT.$item_path)) {
			if(!is_dir(INSTALL_ROOT.$item_path)) {
				$dir_items[$key]['status'] = 1;
			} else {
				$dir_items[$key]['status'] = -1;
			}
		} else {
			$dir_items[$key]['status'] = 1;
		}
	}
	return $dir_items;
}

function dir_writeable($dir) {
	$writeable = 0;
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.txt", 'w')) {
			@fclose($fp);
			
		}
	    if(file_exists("$dir/test.txt")){
	    	$writeable = 1;
			@unlink("$dir/test.txt");
		}
	}
	return $writeable;
}
function initConfig($db_host,$db_user,$db_pass,$db_prefix,$db_name){
	$code = "return array(
	    'URL_CASE_INSENSITIVE'  =>  false,
	    'VAR_PAGE'=>'p',
	    'PAGE_SIZE'=>15,
		'DB_TYPE'=>'mysql',
	    'DB_HOST'=>'".$db_host."',
	    'DB_NAME'=>'".$db_name."',
	    'DB_USER'=>'".$db_user."',
	    'DB_PWD'=>'".$db_pass."',
	    'DB_PREFIX'=>'".$db_prefix."',
	    'DEFAULT_C_LAYER' =>  'Action',
	    'DEFAULT_CITY' => '440100',
	    'DATA_CACHE_SUBDIR'=>true,
        'DATA_PATH_LEVEL'=>2, 
	    'SESSION_PREFIX' => 'WSTMALL',
        'COOKIE_PREFIX'  => 'WSTMALL',
		'LOAD_EXT_CONFIG' => 'wst_config'
	)";
	$code = "<?php\n ".$code.";\n?>";
    file_put_contents(INSTALL_ROOT."/Apps/Common/Conf/config.php", $code);
    
    clearstatcache();
}
function check_func($func_items){
	foreach($func_items as $key => $item) {
		if(function_exists($key)){
			$func_items[$key]['current'] = '支持';
			$func_items[$key]['status'] = 1;
		}else{
			$func_items[$key]['current'] = '不支持';
			$func_items[$key]['status'] = -1;
		}
	}
	return $func_items;
}

function runquery($sql,$tablepre = '') {
	global $db;

	if(!isset($sql) || empty($sql)) return;
	$sql = str_replace("\r", "\n", str_replace(' `'.TABLEPRE, ' `'.$tablepre, $sql));
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
		}
		$num++;
	}
	unset($sql);
	$dbver = $db->version();
	foreach($ret as $query) {
		$query = trim($query);
		if($query) {
			if(strtoupper(substr($query, 0, 12)) == 'CREATE TABLE') {
				$type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $query));
	            $type = in_array($type, array('MYISAM', 'HEAP', 'MEMORY')) ? $type : 'MYISAM';
	            $query = preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $query).($dbver > '4.1' ? " ENGINE=$type DEFAULT CHARSET=".DBCHARSET : " TYPE=$type");
			}
			$db->query($query);
		}
	}
}

function timezone_set($timeoffset = 8) {
	if(function_exists('date_default_timezone_set')) {
		@date_default_timezone_set('Etc/GMT'.($timeoffset > 0 ? '-' : '+').(abs($timeoffset)));
	}
}


?>