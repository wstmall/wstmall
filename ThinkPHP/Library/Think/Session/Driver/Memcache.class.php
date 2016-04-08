<?php

/**
 *  +----------------------------------------------------------------------
 *  | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2006-2013 http://thinkphp.cn All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 *  +----------------------------------------------------------------------
 *  | @author guizhiming <sd2536888@163.com>
 *  +----------------------------------------------------------------------
 *  | @datetime 2014-4-1 14:11:24
 *  +---------------------------------------------------------------------- 
 */

namespace Think\Session\Driver;

/**
  +------------------------------------------------------------------------------
 * Memcache方式Session处理过滤器
  +------------------------------------------------------------------------------
 * @category   Think
 * @package  Session
 * @subpackage  Driver
 * @author guizhiming <sd2536888@163.com>
 * @version   $Id$
  +------------------------------------------------------------------------------
 */
class Memcache {//类定义开始

	/**
	  +----------------------------------------------------------
	 * Session有效时间
	  +----------------------------------------------------------
	 * @var int
	 * @access protected
	  +----------------------------------------------------------
	 */

	protected $lifeTime = 3600;

	/**
	  +----------------------------------------------------------
	 * session保存的名称，如NDSESSION，session_id的cookie名称
	  +----------------------------------------------------------
	 * @var string
	 * @access protected
	  +----------------------------------------------------------
	 */
	protected $sessionName = '';

	/**
	  +----------------------------------------------------------
	 * memcache句柄
	  +----------------------------------------------------------
	 * @var Memcache
	 * @access private
	  +----------------------------------------------------------
	 */
	private static $mHandle;

	/**
	  +----------------------------------------------------------
	 * session静态缓存
	  +----------------------------------------------------------
	 * @var array
	 * @access private
	  +----------------------------------------------------------
	 */
	private static $staticCache;

	/**
	  +----------------------------------------------------------
	 * memcache设置参数
	  +----------------------------------------------------------
	 * @var array
	 * @access public
	  +----------------------------------------------------------
	 */
	public static $options;

	/**
	  +----------------------------------------------------------
	 * 打开Session 
	  +----------------------------------------------------------
	 * @access public 
	  +----------------------------------------------------------
	 * @param string $savePath 
	 * @param mixed $sessName  
	  +----------------------------------------------------------
	 */
	public function open($savePath, $sessName) {
		// get session-lifetime 
		$this->lifeTime = C('SESSION_EXPIRE') ? C('SESSION_EXPIRE') : $this->lifeTime;
		$this->sessionName = $sessName;
		if (empty(self::$options)) {
			self::$options = array
				(
				'arrservers' => C('SESSION_SERVERS'),
				'timeout' => C('SESSION_TIMEOUT'),
				'persistent' => C('SESSION_PERSISTENT')
			);
		}
		$options = self::$options;
		self::$mHandle = new \Memcache;
		$re = false;
		$servernum = count($options["arrservers"]); //总的MEMCACHE服务器数量 
		if ($servernum == 1) {
			$func = $options['persistent'] ? 'pconnect' : 'connect';
			$flag = $options['timeout'] ? 
					self::$mHandle->$func($options["arrservers"][0]["ip"], $options["arrservers"][0]["port"], $options['timeout']) :
					self::$mHandle->$func($options["arrservers"][0]["ip"], $options["arrservers"][0]["port"]);
				;
			if ($flag) {
				return true;
			} else {
				return false;
			}
		} elseif ($servernum > 1) {
			$k = 0;
			foreach ($options["arrservers"] as $value) {
				$flag = self::$mHandle->addServer($value["ip"], $value["port"], true, 1, $options['timeout']); //将服务添加到连接池
				if ($flag == false)
					$k++; //不能连接的MEMCACHE服务器数量
			}
		}
		if ($k == 0)
			$re = false; //全不能连接
		else
			$re = true; //至少有一个连接成功
		return $re;
	}

	/**
	  +----------------------------------------------------------
	 * 关闭Session 
	  +----------------------------------------------------------
	 * @access public 
	  +----------------------------------------------------------
	 */
	public function close() {
		$this->gc(ini_get('session.gc_maxlifetime'));
		self::$mHandle->close();
		self::$mHandle = null;
		self::$staticCache = null;
		return true;
	}

	/**
	  +----------------------------------------------------------
	 * 读取Session 
	  +----------------------------------------------------------
	 * @access public 
	  +----------------------------------------------------------
	 * @param string $sessID 
	  +----------------------------------------------------------
	 */
	public function read($sessID) {
		if (isset(self::$staticCache[$this->sessionName . $sessID])) {
			$re = self::$staticCache[$this->sessionName . $sessID];
		} else {
			$re = self::$mHandle->get($this->sessionName . $sessID);
			if ($re)
				self::$staticCache[$this->sessionName . $sessID] = $re;
		}
		return $re;
	}

	/**
	  +----------------------------------------------------------
	 * 写入Session 
	  +----------------------------------------------------------
	 * @access public 
	  +----------------------------------------------------------
	 * @param string $sessID 
	 * @param String $sessData  
	  +----------------------------------------------------------
	 */
	public function write($sessID, $sessData) {
		self::$staticCache[$this->sessionName . $sessID] = $sessData;
		return self::$mHandle->set($this->sessionName . $sessID, $sessData, 0, $this->lifeTime);
	}

	/**
	  +----------------------------------------------------------
	 * 删除Session 
	  +----------------------------------------------------------
	 * @access public 
	  +----------------------------------------------------------
	 * @param string $sessID 
	  +----------------------------------------------------------
	 */
	public function destroy($sessID) {
		// delete session-data 
		if (isset(self::$staticCache[$this->sessionName . $sessID]))
			unset(self::$staticCache[$this->sessionName . $sessID]);
		return self::$mHandle->delete($this->sessionName . $sessID);
	}

	/**
	  +----------------------------------------------------------
	 * Session 垃圾回收
	  +----------------------------------------------------------
	 * @access public 
	  +----------------------------------------------------------
	 * @param string $sessMaxLifeTime 
	  +----------------------------------------------------------
	 */
	public function gc($sessMaxLifeTime) {
		//TODO: memcache will aoto gc. 
		return true;
	}

	/**
	  +----------------------------------------------------------
	 * 打开Session 
	  +----------------------------------------------------------
	 * @access public 
	  +----------------------------------------------------------
	 * @param string $savePath 
	 * @param mixed $sessName  
	  +----------------------------------------------------------
	 */
	public function execute() {
		session_set_save_handler(array(&$this, "open"), array(&$this, "close"), array(&$this, "read"), array(&$this, "write"), array(&$this, "destroy"), array(&$this, "gc"));
	}

}

?>