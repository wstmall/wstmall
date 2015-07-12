<?php
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 */ 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@set_time_limit(1000);
define('IN_WSTMALL', TRUE);
define('INSTALL_ROOT', dirname(dirname(__FILE__)));
define('INSTALL_PATH', dirname(__FILE__));
require INSTALL_PATH.'/include/install_var.php';
require INSTALL_PATH.'/include/install_function.php';
$step = (int)$_GET['step'];
if($step<3){
	if(file_exists(INSTALL_PATH.'/install.ok'))$step = 3;
}
timezone_set();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>WSTMall开源商城安装</title>
<link href="./css/general.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="./js/install.js"></script>
<script type="text/javascript">
</script>
</head>
<body>
<div style="width:960px;margin:0 auto;">
    <div style="margin:0 auto;margin-top:20px;background:url('./images/1_03.png') no-repeat left top;width:280px;height:47px;"></div>
    <form id='form1'action='index.php'>
    <input type='hidden' name="step" id='step' value='0'/>
    <input type='hidden' name="rnd" id='rnd' value='0'/>
    <?php if($step==0){?>
    
    <div id="system_agreement" class="main">
        <div class='content'>
            <p class='bold center'>WSTMall安装协议</p>

			<p>版权所有(c)2015,广州晴暖信息科技有限公司</p>
			
			<p style='margin-top:10px;'>用户须知：</p>
			
			<p style='margin-top:10px;text-indent: 2em'>感谢您选择WSTMall，WSTMall由广州市晴暖信息科技有限公司基于ThinkPHP3.2开发并开源发布。本协议是您与广州晴暖信息科技有限公司之间关于您使用WSTMall电子商务系统的法律协议。无论您是个人或组织 、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议。</p>
			
			<p style='margin-top:10px;text-indent: 2em'>1. 您可以在遵守本协议的基础上，免费获得WSTMall的授权并将本系统应用于商业用途或者非商业用途(包括个人用户：不具备法人资格的自然人，以个人名义从事电子商务开设网店的；非盈利性用途：从事非盈利活动的商业机构及非盈利性组织，将 WSTMall产品用且仅用于产品演示、展示及发布，或者用来买卖及盈利的运营活动)。</p>
			<p style='text-indent: 2em'>2. 您可以在协议规定的约束和限制范围内二次开发 WSTMall功能、插件或者风格，以适应您的网站运营要求。</p>
			<p style='text-indent: 2em'>3. 您可免费将本软件用于多用户O2O电子商务网站搭建(包括但不限于个人、企业搭建电子商务网站)。</p>
			<p style='text-indent: 2em'>4. WSTMall开源商城，保留WSTMall版权可二次开发并进行使用。无论用途如何、是否经过修改或美化、修改程度如何，只要使用 WSTMall的整体或任何部分，未经书面许可，网站顶部的 WSTMall名称和WSTMall的版权需保留，而不能清除或修改，或者拨打客服电话<strong>020-29806661</strong>进行咨询。</p>
			<p style='text-indent: 2em'>5. 禁止在 WSTMall的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。 </p>
			<p style='text-indent: 2em'>本协议一旦发生变更,广州晴暖信息科技有限公司将在WSTMall官方网站（<a target='_blank' href='http://www.wstmall.com'>http://www.wstmall.com</a>）上公布修改内容。修改后的服务条款将有效代替原来的服务条款。</p>
        </div>
        <div class='bottom'>
        <input type='button' class='btn' value='我同意' onclick='showStep(1)'/>
        </div>
    </div>
    <?php 
    }else if($step==1){
    	$env_items = env_check($env_items);
        $dir_items = dir_check($dir_items);
        $func_items = check_func($func_items);
    ?>
    <div id="system_env" class="main">
        <div class="content">
            <span class='bold' style='font-size:15px;'>系统环境检查</span>
            <table class="check-env" style='margin-bottom:20px;'>
                <?php 
                    echo '<tr><td class="left">操作系统</td><td><span class="check'.$env_items['os']['status'].'"></span>'.$env_items['os']['current'].'</td></tr>';
                    echo '<tr><td class="left">PHP 版本</td><td><span class="check'.$env_items['php']['status'].'"></span>'.$env_items['php']['current'].'</td></tr>';
                    echo '<tr><td class="left">附件上传</td><td><span class="check'.$env_items['attachmentupload']['status'].'"></span>'.$env_items['attachmentupload']['current'].'</td></tr>';
                    echo '<tr><td class="left">GD 库</td><td><span class="check'.$env_items['gdversion']['status'].'"></span>'.$env_items['gdversion']['current'].'</td></tr>';
                    echo '<tr><td class="left">磁盘空间 </td><td><span class="check'.$env_items['diskspace']['status'].'"></span>'.$env_items['diskspace']['current'].'</td></tr>';
                ?>
            </table>
            <span class='bold' style='font-size:15px;'>目录权限检查</span>
            <table class="check-env" style='margin-bottom:20px;'>
                <?php 
                    $str = '';
                    if(count($dir_items)>0){
                        $check = true;
                        foreach($dir_items as $v){
                            $str .= '<tr><td class="left">'.$v['path'].'</td><td>';
                            if($v['status'] == 1) {
                                $str .= '<span class="check1"></span>可写';
                            }else if($v['status'] == -1) {
                                $str .= '<span class="check-1"></span>目录不存在';
                                $check = false;
                            }else {
                                $str .= '<span class="check-1"></span>不可写';
                                $check = false;
                            }
                            $str .= '</td></tr>';
                        }
                    }
                    echo $str;
                ?>
            </table>
            <span style="display:none;color:red;margin-top:30px;text-align:center;" id="envInfo">目录不存在或不可写，请检查后再试</span>
            <span class='bold' style='font-size:15px;'>依赖函数检查</span>
            <table class="check-env">
                <?php 
                    echo '<tr><td class="left">mysql_connect()</td><td><span class="check'.$func_items['mysql_connect']['status'].'"></span>'.$func_items['mysql_connect']['current'].'</td></tr>';
                    echo '<tr><td class="left">file_get_contents()</td><td><span class="check'.$func_items['file_get_contents']['status'].'"></span>'.$func_items['file_get_contents']['current'].'</td></tr>';
                    echo '<tr><td class="left">curl_init()</td><td><span class="check'.$func_items['curl_init']['status'].'"></span>'.$func_items['curl_init']['current'].'</td></tr>';
                ?>
            </table>
        </div>
        <div class='bottom'>
        <input type='button' class='btn' value='重新检测' onclick='javascript:showStep(1,1)'/>
        <input type='button' class='btn nextBtn' value='下一步' onclick='showStep(2)'/>
        </div>
    </div>
    <?php }else if($step==2){?>
    <div id="system_data" class='main'>
       <div class='content'>
             <span class='bold' style='font-size:15px;'>数据库帐号</span>
             <table class='check-env'>
                <tbody>
                <tr>
                  <td width="130" align="right" class="item">数据库主机<span class='red'>*</span>：</td>
                  <td align="left">
                      <input type="text" class="ipt" name="db_host" id="db_host" value="localhost" onblur='checkVal(this.id)'>
                      <span class='db_host tips'>数据库主机不能为空</span>
                  </td>
                </tr>
                <tr>
                  <td align="right">访问账号<span class='red'>*</span>：</td>
                  <td align="left">
                      <input type="text" class="ipt" name="db_user" id="db_user" value="root" onblur='checkVal(this.id)'>
                      <span class='db_user tips'>数据库访问账号不能为空</span>
                  </td>
                </tr>
                <tr>
                  <td align="right">访问密码：</td>
                  <td align="left">
                      <input type="password" class="ipt" name="db_pass" id="db_pass" value="">
                  </td>
                </tr>
                <tr>
                   <td align="right">数据库名<span class='red'>*</span>：</td>
                   <td align="left">
                      <input type="text" class="ipt" name="db_name" id="db_name" value="wstmall" onblur='checkVal(this.id)'>
                      <span class='db_name tips'>数据库名不能为空</span>
                      <span class="tips" style='display:inline-block'>&nbsp; (若数据库存在则会覆盖原数据库，不存在则会创建一个新数据库)</span>
                   </td>
                </tr>
                <tr>
                   <td align="right">表前缀：</td>
                   <td align="left">
                      <input type="text" class="ipt" name="db_prefix" id="db_prefix" value="wst_" onblur='checkVal(this.id)'>
                      <span class="tips" style='display:inline-block'>&nbsp; (建议修改表前缀)</span>
                   </td>
                </tr>
                <tr>
                   <td align="right">&nbsp;</td>
                   <td align="left">
                      <label>
                      <input type="checkbox" name="db_demo" id="db_demo" checked><span class="tips" style='display:inline'>&nbsp;安装演示数据</span>
                      <span class="tips">&nbsp; </span>
                      </label>
                   </td>
                </tr>
           </tbody>
          </table>
          <span class='bold' style='font-size:15px;'>管理员帐号</span>
          <table class='check-env'>
          <tbody>
              <tr>
                <td width="130" align="right">管理员账号<span class='red'>*</span>：</td>
                <td align="left">
                   <input type="text" class="ipt" name="admin_name" id="admin_name" value="admin" onblur='checkVal(this.id)'>
                   <span class='admin_name tips'>管理员账号不能为空</span>
                </td>
              </tr>
              <tr>
                 <td align="right">登录密码<span class='red'>*</span>：</td>
                 <td align="left">
                   <input type="password" class="ipt" name="admin_password" id="admin_password" value="" onblur='checkVal(this.id)'>
                   <span class='admin_password tips'>管理员密码不能为空</span>
                 </td>
               </tr>
               <tr>
                  <td align="right">密码确认<span class='red'>*</span>：</td>
                  <td align="left">
                    <input type="password" class="ipt" name="admin_password2" id="admin_password2" value="" onblur='checkVal(this.id)'>
                    <span class="admin_password2 tips">两次输入的密码不一致</span>
                  </td>
               </tr>
            </tbody>
           </table>
        </div>
        <div class='bottom'>
           <span id='init_msg' style='display:none'>正在初始化数据库...</span>
           <input type='button' class='btn' value='上一步' onclick='showStep(1)'/>
		   <input type='button' class='btn nextBtn' value='下一步' onclick='showStep(3)'/>
	    </div>
    </div>
    <?php }else if($step==3){?>
    <div class="main" id="system_success">
        <div class="content" style='text-align:center;'>
        <div style="margin-top: 200px;">
        <span style="display:inline-block;margin-top:10px;">
           <span style="font-weight: bold;font-size:18px;"> 恭喜</span>，WSTMall已安装成功&nbsp;!<br /><br />
            安装成功后，建议删除Insatall目录
        </span><br /><br />
        <a href="../index.php" target="_blank" title="跳到WSTMALL首页">跳到WSTMall首页</a>&nbsp;&nbsp;
        <a href="../index.php/Admin/index" target="_blank" title="跳到WSTMALL后台">跳到WSTMall后台</a>
        </div>
        </div>
    </div>
    <?php }?>
    </form>
    </div>
</body>
</html>