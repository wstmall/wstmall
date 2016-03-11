<?php

/**
 * 判断是否手机访问
 */
function WSTIsMobile() {
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';  
    $mobile_browser = '0';  
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))  
       $mobile_browser++;  
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))  
       $mobile_browser++;  
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))  
       $mobile_browser++;  
    if(isset($_SERVER['HTTP_PROFILE']))  
       $mobile_browser++;  
       $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));  
       $mobile_agents = array(  
		    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',  
		    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',  
		    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',  
		    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',  
		    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',  
		    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',  
		    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',  
		    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',  
		    'wapr','webc','winw','winw','xda','xda-'
	   );  
    if(in_array($mobile_ua, $mobile_agents))$mobile_browser++;  
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)$mobile_browser++;  
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)$mobile_browser=0;  
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)$mobile_browser++;  
    if($mobile_browser>0){  
       return true;  
    }else{
       return false;
    }
}

/**
 * 邮件发送函数
 * @param string to      要发送的邮箱地址
 * @param string subject 邮件标题
 * @param string content 邮件内容
 * @return array
 */
function WSTSendMail($to, $subject, $content) {
	require_cache(VENDOR_PATH."PHPMailer/class.smtp.php");
    require_cache(VENDOR_PATH."PHPMailer/class.phpmailer.php");
    $mail = new PHPMailer();
    // 装配邮件服务器
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = $GLOBALS['CONFIG']['mailSmtp'];
    $mail->SMTPAuth = $GLOBALS['CONFIG']['mailAuth'];
    $mail->Username = $GLOBALS['CONFIG']['mailUserName'];
    $mail->Password = $GLOBALS['CONFIG']['mailPassword'];
    $mail->CharSet = 'utf-8';
    // 装配邮件头信息
    $mail->From = $GLOBALS['CONFIG']['mailAddress'];
    $mail->AddAddress($to);
    $mail->FromName = $GLOBALS['CONFIG']['mailSendTitle'];
    $mail->IsHTML(true);
    // 装配邮件正文信息
    $mail->Subject = $subject;
    $mail->Body = $content;
    // 发送邮件
    $rs =array();
    if (!$mail->Send()) {
    	$rs['status'] = 0;
    	$rs['msg'] = $mail->ErrorInfo;
        return $rs;
    } else {
    	$rs['status'] = 1;
        return $rs;
    }
}
/**
 * 发送短信
 * 此接口要根据不同的短信服务商去写，这里只是一个参考
 * @param string $phoneNumer  手机号码
 * @param string $content     短信内容
 */
function WSTSendSMS2($phoneNumer,$content){
	$url = 'http://223.4.21.214:8180/service.asmx/SendMessage?Id='.$GLOBALS['CONFIG']['smsOrg']."&Name=".$GLOBALS['CONFIG']['smsKey']."&Psw=".$GLOBALS['CONFIG']['smsPass']."&Timestamp=0&Message=".$content."&Phone=".$phoneNumer;
	$ch=curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置否输出到页面
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30 ); //设置连接等待时间
    curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
    $data=curl_exec($ch);
    curl_close($ch);
    return "$data";
}
/**
 * @param unknown_type $phoneNumer
 * @param unknown_type $content
 */
function WSTSendSMS($phoneNumer,$content){
	$url = 'http://utf8.sms.webchinese.cn/?Uid='.$GLOBALS['CONFIG']['smsKey'].'&Key='.$GLOBALS['CONFIG']['smsPass'].'&smsMob='.$phoneNumer.'&smsText='.$content;
	$ch=curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置否输出到页面
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30 ); //设置连接等待时间
    curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
    $data=curl_exec($ch);
    curl_close($ch);
    return $data;
}
/**
 * 字符串替换
 * @param string $str     要替换的字符串
 * @param string $repStr  即将被替换的字符串
 * @param int $start      要替换的起始位置,从0开始
 * @param string $splilt  遇到这个指定的字符串就停止替换
 */
function WSTStrReplace($str,$repStr,$start,$splilt = ''){
	$newStr = substr($str,0,$start);
	$breakNum = -1;
	for ($i=$start;$i<strlen($str);$i++){
		$char = substr($str,$i,1);
		if($char==$splilt){
			$breakNum = $i;
			break;
		}
		$newStr.=$repStr;
	}
	if($splilt!='' && $breakNum>-1){
		for ($i=$breakNum;$i<strlen($str);$i++){
			$char = substr($str,$i,1);
			$newStr.=$char;
		}
	}
	return $newStr;
}
/**
 * 循环删除指定目录下的文件及文件夹
 * @param string $dirpath 文件夹路径
 */
function WSTDelDir($dirpath){
	$dh=opendir($dirpath);
	while (($file=readdir($dh))!==false) {
		if($file!="." && $file!="..") {
		    $fullpath=$dirpath."/".$file;
		    if(!is_dir($fullpath)) {
		        unlink($fullpath);
		    } else {
		        WSTDelDir($fullpath);
		        rmdir($fullpath);
		    }
	    }
	}	 
	closedir($dh);
    $isEmpty = 1;
	$dh=opendir($dirpath);
	while (($file=readdir($dh))!== false) {
		if($file!="." && $file!="..") {
			$isEmpty = 0;
			break;
		}
	}
	return $isEmpty;
}
/**
 * 获取网站域名
 */
function WSTDomain(){
	$server = $_SERVER['HTTP_HOST'];
	$http = is_ssl()?'https://':'http://';
	return $http.$server.__ROOT__;
}
/**
 * 获取系统根目录
 */
function WSTRootPath(){
	return dirname(dirname(dirname(dirname(__File__))));
}
/**
 * 获取网站根域名
 */
function WSTRootDomain(){
	$server = $_SERVER['HTTP_HOST'];
	$http = is_ssl()?'https://':'http://';
	return $http.$server;
}
/**
 * 设置当前页面对象
 * @param int 0-用户  1-商家
 */
function WSTLoginTarget($target = 0){
	$WST_USER = session('WST_USER');
	$WST_USER['loginTarget'] = $target;
	session('WST_USER',$WST_USER);
}

/**
 * 生成缓存文件
 */
function WSTDataFile($name, $path = '',$data=array()){
	$key = C('DATA_CACHE_KEY');
	$name = md5($key.$name);
	if(is_array($data) && !empty($data)){
		if($data['mallLicense']==''){
			if(stripos($data['mallTitle'],'Powered By WSTMall')===false)$data['mallTitle'] = $data['mallTitle']." - Powered By WSTMall";
		}
	    $data   =   serialize($data);
        if( C('DATA_CACHE_COMPRESS') && function_exists('gzcompress')) {
            //数据压缩
            $data   =   gzcompress($data,3);
        }
        if(C('DATA_CACHE_CHECK')) {//开启数据校验
            $check  =  md5($data);
        }else {
            $check  =  '';
        }
        $data    = "<?php\n//".sprintf('%012d',$expire).$check.$data."\n?>";
        $result  =   file_put_contents(DATA_PATH.$path.$name.".php",$data);
	    clearstatcache();
	}else if(is_null($data)){
	    unlink(DATA_PATH.$path.$name.".php");
	}else{
		if(file_exists(DATA_PATH.$path.$name.'.php')){
		    $content    =   file_get_contents(DATA_PATH.$path.$name.'.php');
            if( false !== $content) {
	            $expire  =  (int)substr($content,8, 12);
	            if(C('DATA_CACHE_CHECK')) {//开启数据校验
	                $check  =  substr($content,20, 32);
	                $content   =  substr($content,52, -3);
	                if($check != md5($content)) {//校验错误
	                    return null;
	                }
	            }else {
	            	$content   =  substr($content,20, -3);
	            }
	            if(C('DATA_CACHE_COMPRESS') && function_exists('gzcompress')) {
	                //启用数据压缩
	                $content   =   gzuncompress($content);
	            }
	            $content    =   unserialize($content);
	            return $content;
	        }
		}
		return null;
	}
}



/**
 * 建立文件夹
 * @param string $aimUrl
 * @return viod
 */
function WSTCreateDir($aimUrl) {
	$aimUrl = str_replace('', '/', $aimUrl);
	$aimDir = '';
	$arr = explode('/', $aimUrl);
	$result = true;
	foreach ($arr as $str) {
		$aimDir .= $str . '/';
		if (!file_exists_case($aimDir)) {
			$result = mkdir($aimDir,0777);
		}
	}
	return $result;
}

/**
 * 建立文件
 * @param string $aimUrl
 * @param boolean $overWrite 该参数控制是否覆盖原文件
 * @return boolean
 */
function WSTCreateFile($aimUrl, $overWrite = false) {
	if (file_exists_case($aimUrl) && $overWrite == false) {
		return false;
	} elseif (file_exists_case($aimUrl) && $overWrite == true) {
		WSTUnlinkFile($aimUrl);
	}
	$aimDir = dirname($aimUrl);
	WSTCreateDir($aimDir);
	touch($aimUrl);
	return true;
}

/**
 * 删除文件
 * @param string $aimUrl
 * @return boolean
 */
function WSTUnlinkFile($aimUrl) {
	if (file_exists_case($aimUrl)) {
		unlink($aimUrl);
		return true;
	} else {
		return false;
	}
}

function  WSTLogResult($filepath,$word){
	if(!file_exists_case($filepath)){
		WSTCreateFile($filepath);
	}
	$fp = fopen($filepath,"a");
	flock($fp, LOCK_EX) ;
	fwrite($fp,"执行日期：".strftime("%Y-%m-%d %H:%M:%S",time())."\n".$word."\n\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}

function WSTReadExcel($file){
	Vendor("PHPExcel.PHPExcel");
	Vendor("PHPExcel.PHPExcel.IOFactory");
	return PHPExcel_IOFactory::load(WSTRootPath()."/Upload/".$file);
}
/**
 * 处理转义字符
 * @param $str 需要处理的字符串
 */
function WSTAddslashes($str){
	if (!get_magic_quotes_gpc()){
		if (!is_array($str)){
			$str = addslashes($str);
		}else{
			foreach ($str as $key => $val){
				$str[$key] = WSTAddslashes($val);
			}
		}
	}
	return $str;
}

/**
 * 检测字符串不否包含
 * @param $srcword 被检测的字符串
 * @param $filterWords 禁用使用的字符串列表
 * @return boolean true-检测到,false-未检测到
 */
function WSTCheckFilterWords($srcword,$filterWords){
	$flag = true;
	$filterWords = str_replace("，",",",$filterWords);
	$words = explode(",",$filterWords);
	for($i=0;$i<count($words);$i++){
		if(strpos($srcword,$words[$i]) !== false){
			$flag = false;
			break;
		}
	}
	return $flag;
}

/**
 * 比较两个日期相差的天数
 * @param $date1 开始日期  Y-m-d
 * @param $date2 结束日期  Y-m-d
 */
function WSTCompareDate($date1,$date2){
	$time1 = strtotime($date1);
	$time2 = strtotime($date2);
	return ceil(($time1-$time2)/86400);
}
/**
 * 截取字符串
 */
function WSTMSubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
	$newStr = '';
	if (function_exists ( "mb_substr" )) {
		if ($suffix)
			$newStr = mb_substr ( $str, $start, $length, $charset );
		else
			$newStr = mb_substr ( $str, $start, $length, $charset );
	} elseif (function_exists ( 'iconv_substr' )) {
		if ($suffix)
			$newStr = iconv_substr ( $str, $start, $length, $charset );
		else
			$newStr = iconv_substr ( $str, $start, $length, $charset );
	}
	if($newStr==''){
	$re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	preg_match_all ( $re [$charset], $str, $match );
	$slice = join ( "", array_slice ( $match [0], $start, $length ) );
	if ($suffix)
		$newStr = $slice;
	}
	return (strlen($str)>strlen($newStr))?$newStr."...":$newStr;
}