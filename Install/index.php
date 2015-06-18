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
    <div style="margin:0 auto;margin-top:20px;background:url('./images/1_03.png') no-repeat left top;width:300px;height:47px;"></div>
    <form id='form1'action='index.php'>
    <input type='hidden' name="step" id='step' value='0'/>
    <input type='hidden' name="rnd" id='rnd' value='0'/>
    <?php if($step==0){?>
    
    <div id="system_agreement" class="main">
        <div class='content'>
            <p class='bold center'>WSTMall软件使用协议</p>

			<p>版权所有(c)2015,WSTMall开源商城</p>
			
			<p style='margin-top:10px;'>WSTMall遵循Apache2开源协议发布，并提供免费使用。</p>
			
			<p style='margin-top:10px;'>WSTMall由广州市晴暖信息科技有限公司(官网 http://www.wstmall.com )基于ThinkPHP3.2.2开发并开源发布。</p>
			
			<p style='margin-top:10px;'>Apache Licence是著名的非盈利开源组织Apache采用的协议。</p>
			<p>该协议鼓励代码共享和尊重原作者的著作权，允许代码修改，再作为开源或商业软件发布。需要满足的条件： </p>
			<p>1． 需要给代码的用户一份Apache Licence ；</p>
			<p>2． 如果你修改了代码，需要在被修改的文件中说明；</p>
			<p>3． 在延伸的代码中（修改和有源代码衍生的代码中）需要带有原来代码中的协议，商标，专利声明和其他原来作者规定需要包含的说明；</p>
			<p>4． 如果再发布的产品中包含一个Notice文件，则在Notice文件中需要带有本协议内容。你可以在Notice中增加自己的许可，但不可以表现为对Apache Licence构成更改。 </p>
			
			<p style='margin-top:10px;'>具体的协议参考：http://www.apache.org/licenses/LICENSE-2.0</p>
			
			<p>THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
			"AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
			LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
			FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
			COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
			INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
			BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
			LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
			CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
			LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
			ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
			POSSIBILITY OF SUCH DAMAGE.</p>
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
                                $str .= '<span class="check0"></span>目录不存在';
                                $check = false;
                            }else {
                                $str .= '<span class="check0"></span>不可写';
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
        <div class="content" style='text-align:center'>
        <span style="display:inline-block;margin-top:10px;">
            恭喜，WSTMall已安装成功!<br />
            安装成功后，建议删除Insatall目录
        </span><br /><br />
        <a href="../index.php" target="_blank" title="跳到WSTMALL首页">跳到WSTMall首页</a>&nbsp;&nbsp;
        <a href="../index.php/Admin/index" target="_blank" title="跳到WSTMALL后台">跳到WSTMall后台</a>
        </div>
    </div>
    <?php }?>
    </form>
</body>
</html>