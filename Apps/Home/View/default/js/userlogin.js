var curRowIndex = 0;
var emailList = new Array("","163.com","126.com","qq.com","sina.com","gmail.com","sohu.com","vip.126.com","188.com","139.com");

$(function(){
	$('#chkRememberMe').change(function(){
		if($('#chkRememberMe:checked').val()){
			$("#rememberPwd").val(1);
		}else{
			$("#rememberPwd").val(0);
		}
	});
	$(document).keypress(function(e) {
		   if(e.which == 13) {  
			   checkLoginInfo();  
		   } 
	});
})

function toChoice(obj,type){
	$(obj).addClass('selected').siblings().removeClass('selected');
	if(type==1){
		$('#binding').show();
		$('#register').hide();
	}else{
		$('#binding').hide();
		$('#register').show();
	}
}

//登录
function checkLoginInfo(){	
	var loginName = $.trim($('#loginName2').val());
	var loginPwd = $.trim($('#loginPwd').val());
	var verify = $.trim($('#verify').val());
	var rememberPwd = $("#rememberPwd").val();
	if(loginName=="" || loginPwd==""){
		$("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户名及密码不能为空");
		return false;
	}
	if(verify==""){
		$("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;验证码不能为空");
		return false;
	}
	
	$.post(Think.U('Home/Users/checkLogin'),{loginName:loginName,loginPwd:loginPwd,verify:verify,rememberPwd:rememberPwd},function(data,textStatus){
		var json = WST.toJson(data);
		if(json.status=='1'){
			location.href=json.refer;
		}else if(json.status=='-1'){
			$("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;验证码错误");
			getVerify();
		}else if(json.status=='-2'){
			$("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;账号或密码错误");
			getVerify();
		}
	});
	return true;
}

function onblurName(obj){
	if(document.getElementById("nopt"+curRowIndex)){
			$("#loginName").val($("#nopt"+curRowIndex).html())
	}
	$("#namelist").hide();
	var uname = $.trim(obj.value);
	if(uname=='') {
		obj.value='邮箱/用户名/手机号';
		obj.style.color='#999999';
		jQuery("#loginNameTip").removeClass();
		jQuery("#loginNameTip").addClass("onError");
		jQuery("#loginNameTip").html("<span>请输入邮箱/用户名/手机号</span>");
		jQuery("#nameType").val(2);
		return;
	}else{
		if(uname.indexOf("@")>=0){
			jQuery("#loginNameTip").removeClass();			
			if(new RegExp(regexEnum.email).test(uname)){
				jQuery("#userEmail").val(uname);
				jQuery("#userPhone").val("");
				jQuery("#nameType").val(1);
				jQuery("#loginNameTip").removeClass();
				if(uname!=orgva){
					jQuery("#loginNameTip").addClass("onFocus");
					jQuery("#loginNameTip").html("<span>请稍候...</span>");
				}
				jQuery("#authcodeDiv").show();
				jQuery("#mobileCodeDiv").hide();
				changeName();
			}else{
				jQuery("#loginNameTip").addClass("onError");
				jQuery("#loginNameTip").html("<span>输入的邮箱格式不正确</span>");
				return;
			}			
		}else{
			if(WST.PHONE_VERFY=='1'){
				if(new RegExp(regexEnum.mobile).test(uname) && uname.length==11){
					jQuery("#userEmail").val("");
					jQuery("#userPhone").val(uname);
					jQuery("#loginNameTip").removeClass();
					jQuery("#nameType").val(3);
					if(uname!=orgva){
						jQuery("#loginNameTip").addClass("onFocus");
						jQuery("#loginNameTip").html("<span>请稍候...</span>");
					}
					changeName();
					jQuery("#authcodeDiv").hide();
					jQuery("#mobileCodeDiv").show();
				}else{
					jQuery("#userEmail").val("");
					jQuery("#userPhone").val("");
					jQuery("#nameType").val(2);
					jQuery("#loginNameTip").removeClass();
					if(uname==orgva){
							changeName();
					}else{
							jQuery("#loginNameTip").addClass("onFocus");
							jQuery("#loginNameTip").html("<span>请稍候...</span>");
					}
					changeName();
					jQuery("#authcodeDiv").show();
					jQuery("#mobileCodeDiv").hide();
				}
			}else{
				jQuery("#userEmail").val("");
				jQuery("#userPhone").val("");
				jQuery("#nameType").val(2);
				jQuery("#loginNameTip").removeClass();
				if(uname==orgva){
					changeName();
				}else{
					jQuery("#loginNameTip").addClass("onFocus");
					jQuery("#loginNameTip").html("<span>请稍候...</span>");
				}
				changeName();
				jQuery("#authcodeDiv").show();
				jQuery("#mobileCodeDiv").hide();
			}	
		}
	}
		
}

function optionsOver(idx){	
	$(".options").css("background-color","white");
	$("#nopt"+idx).css("background-color","#E9E5E1");
	curRowIndex = idx;	
}

function selectOpt(optionId){
	$("#loginName").val($("#nopt"+optionId).html());
	$("#namelist").hide();
}

var orgva = "";
function onfocusName(obj){
	var keywords = jQuery.trim(obj.value);
	if(keywords=='邮箱/用户名/手机号'){
		obj.value='';
		obj.style.color='#333';
	}else{
		if(keywords.length>0){
			var html = new Array();
			if(keywords.indexOf("@")>=0){
				var works = keywords.split("@");
				var rworks = keywords.split("@")[0];
				var lworks = keywords.split("@")[1];					
				for(var i=0;i<emailList.length;i++){
					if(emailList[i].indexOf(lworks)==0){
						html.push("<div class='options' idx='"+i+"' id='nopt"+i+"' onmouseover='optionsOver("+i+");' onclick='selectOpt("+i+")'>"+rworks+(i==0?"":"@")+emailList[i]+"</div>");
					}
				}
			}else{
				for(var i=0;i<emailList.length;i++){						
					html.push("<div class='options' idx='"+i+"' id='nopt"+i+"' onmouseover='optionsOver("+i+");' onclick='selectOpt("+i+")'>"+keywords+(i==0?"":"@")+emailList[i]+"</div>");		
				}
			}				
			$("#namelist").show();
			$("#namelist").html(html.join(""));
			optionsOver(0);
		}
	}
	orgva = obj.value;
	jQuery("#loginNameTip").removeClass();
	jQuery("#loginNameTip").addClass("onFocus");
	jQuery("#loginNameTip").html("<span>请输入邮箱/用户名/手机号</span>");
}

function changeName(){
	var params = {};
	params.loginName = $.trim($('#loginName').val());
	params.clientid = 'loginName';
	if(params.loginName!="" && params.loginName!="邮箱/用户名/手机号"){
		jQuery.post(Think.U('Home/Users/checkLoginKey') ,params,function(rsp) {
			var json = WST.toJson(rsp);
			if( json.status == "1" ) {
				jQuery("#loginNameTip").removeClass();
				jQuery("#loginNameTip").addClass("onCorrect");
				jQuery("#loginNameTip").html(json.msg);
				return true;
			} else {
				jQuery("#loginNameTip").removeClass();
				jQuery("#loginNameTip").addClass("onError");
				jQuery("#loginNameTip").html(json.msg);
				return false;
			}
		});	
	}
}

var time = 0;
var isSend = false;
var isUse = false;
function getVerifyCode(){
		
		if(isSend )return;
		isSend = true;
		
		var params = {};
		params.userPhone = $.trim($("#loginName").val());
		if(WST.SMS_VERFY=='1'){
			var html = [];
			html.push('<table class="wst-smsverfy"><tr><td width="80" align="right">');
			html.push('验证码：</td><td><input type="text" id="smsVerfy" size="12" class="wst-text" maxLength="8">');
			html.push('<img style="vertical-align:middle;cursor:pointer;height:39px;" class="verifyImg" src="'+WST.DOMAIN+'/Apps/Home/View/'+WST.WST_STYLE+'/images/clickForVerify.png" title="刷新验证码" onclick="javascript:getVerify()"/>');
			html.push('</td></tr></table>');
			layer.open({
				title:'请输入验证码',
			    type: 1,
			    area: ['420px', '150px'], //宽高
			    content: html.join(''),
			    btn: ['发送验证码', '取消'],
			    success: function(layero, index){
			    	getVerify();
			    },
			    yes: function(index, layero){
			    	isSend = true;
			    	params.smsVerfy = $.trim($('#smsVerfy').val());
			    	if(params.smsVerfy==''){
   			    		WST.msg('请输入验证码!', {icon: 5});
   			   			return;
   			    	}
			    	WST.msg('正在发送短信，请稍后...',{time:600000});
			    	$.post(Think.U('Home/Users/getPhoneVerifyCode'),params,function(data,textStatus){
			   			var json = WST.toJson(data);
			   			if(json.status!=1){
							WST.msg(json.msg, {icon: 5});
							time = 0;
							isSend = false;
							getVerify();
						}if(json.status==1){
							WST.msg('短信已发送，请注册查收');
							layer.close(index);
			   				time = 130;
			   				$('#timeTips').css('width','100px');
			   				$('#timeTips').html('获取验证码(130)');
			   				$('#mobileCode').val(json.phoneVerifyCode);
			   				var task = setInterval(function(){
			   					time--;
			   					$('#timeTips').html('获取验证码('+time+")");
			   					if(time==0){
			   						isSend = false;						
			   						clearInterval(task);
			   						$('#timeTips').html("重新获取验证码");
			   					}
			   				},1000);
			   			}
			   		});
			    },
			    cancel:function(){
			    	isSend = false;
			    }
			});
		}else{
			isSend = true;
			WST.msg('正在发送短信，请稍后...',{time:600000});
			$.post(Think.U('Home/Users/getPhoneVerifyCode'),params,function(data,textStatus){
	   			var json = WST.toJson(data);
	   			if(json.status!=1){
					WST.msg(json.msg, {icon: 5});
					time = 0;
					isSend = false;
				}if(json.status==1){
					WST.msg('短信已发送，请注册查收');
	   				time = 130;
	   				$('#timeTips').css('width','100px');
	   				$('#timeTips').html('获取验证码(130)');
	   				$('#mobileCode').val(json.phoneVerifyCode);
	   				var task = setInterval(function(){
	   					time--;
	   					$('#timeTips').html('获取验证码('+time+")");
	   					if(time==0){
	   						isSend = false;						
	   						clearInterval(task);
	   						$('#timeTips').html("重新获取验证码");
	   					}
	   				},1000);
	   			}
	   		});
		}
}

function regist(){	
	
	if($("#nameType").val()==3 && WST.PHONE_VERFY=='1'){
		if($.trim($("#mobileCode").val())==""){		
			WST.msg('请输入验证码!', {icon: 5});
			$("#mobileCode").focus();
			return;
		}
	}else{
		if($.trim($("#authCode").val())==""){		
			WST.msg('请输入验证码!', {icon: 5});
			$("#authCode").focus();
			return;
		}
	}

	if(!document.getElementById("protocol").checked){		
		WST.msg('必须同意使用协议才允许注册!', {icon: 5});
		return;
	}
  	var params = {};
	params.loginName = $.trim($('#loginName').val());
	params.loginPwd = $.trim($('#loginPwd2').val());
	params.reUserPwd = $.trim($('#reUserPwd').val());
	
	params.userTaste = $('#userTaste').val();
	params.mobileCode = $.trim($('#mobileCode').val());
	
	params.verify = $.trim($('#authCode').val());
	params.nameType = $("#nameType").val();
	params.protocol = document.getElementById("protocol").checked?1:0;	
	
	$.post(Think.U('Home/Users/toRegist'),params,function(data,textStatus){
		var json = WST.toJson(data);
		if(json.status>0){
			WST.msg('注册成功，正在跳转登录!', {icon: 6}, function(){
				location.href=WST.DOMAIN;
   			});
		}else{
			WST.msg(json.msg, {icon: 5});
		}
		getVerify();
	});
}

function showXiey(id){
	layer.open({
	    type: 2,
	    title: '用户注册协议',
	    shadeClose: true,
	    shade: 0.8,
	    area: ['1000px', ($(window).height() - 50) +'px'],
	    content: [Think.U('Home/Index/toUserProtocol')],
	    btn: ['同意并注册'],
	    yes: function(index, layero){
	    	layer.close(index);
	    }
	});
}	 