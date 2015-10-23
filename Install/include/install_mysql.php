<?php
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 广告控制器
 */
if(!defined('IN_WSTMALL')) {
	exit('Access Denied');
}

class Mysql {
	var $link;
	var $tablepre;

	function connect($dbhost, $dbuser, $dbpw, $dbname = '', $dbcharset, $pconnect = 0, $tablepre='', $time = 0) {
		$this->tablepre = $tablepre;
		if($pconnect) {
			if(!$this->link = mysql_pconnect($dbhost, $dbuser, $dbpw)) {
				die('{status:-1,msg:"Can not connect to MySQL server"}');
			}
		} else {
			if(!$this->link = mysql_connect($dbhost, $dbuser, $dbpw, 1)) {
				die('{status:-1,msg:"Can not connect to MySQL server"}');
			}
		}

		if($this->version() > '4.1') {
			if($dbcharset) {
				mysql_query("SET character_set_connection=".$dbcharset.", character_set_results=".$dbcharset.", character_set_client=binary", $this->link);
			}

			if($this->version() > '5.0.1') {
				mysql_query("SET sql_mode=''", $this->link);
			}
		}
		if($dbname) {
			$db_selected = mysql_select_db($dbname, $this->link);
			if (!$db_selected) {
				$sql="CREATE DATABASE $dbname DEFAULT CHARACTER SET utf8;";
				self::query($sql);
				mysql_select_db($dbname, $this->link);
			}
		}

	}

	function query($sql) {
		return mysql_query($sql, $this->link);
	}

	function version() {
		return mysql_get_server_info($this->link);
	}

	function close() {
		return mysql_close($this->link);
	}
}

?>