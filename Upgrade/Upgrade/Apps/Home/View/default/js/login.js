$(function(){
	getVerify();
	
	$('#chkRememberMe').change(function(){
		if($('#chkRememberMe:checked').val()){
			$("#rememberPwd").val(1);
		}else{
			$("#rememberPwd").val(0);
		}
	});
})

function checkLoginInfo(){	
	var loginName = $.trim($('#loginName').val());
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
			$("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登陆失败，账号或密码错误");
			getVerify();
		}
	});
	
	return true;
}

function login(){
	   var params = {};
	   params.loginName = $.trim($('#loginName').val());
	   params.loginPwd = $.trim($('#loginPwd').val());
	   params.verify = $.trim($('#verify').val());
	   var rememberPwd = $("#rememberPwd").val();
	   if(params.loginName==''){
		   $("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请输入用户名!");
		   $('#loginName').focus();
		   return;
	   }
	   if(params.loginPwd==''){
		   $("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请输入密码!");
		   $('#loginPwd').focus();
		   return;
	   }
	   if(params.verify==""){
			$("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;验证码不能为空");
			return false;
	   }
	   $.post(Think.U('Home/Shops/checkLogin'),params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				location.href= Think.U('Home/Shops/index');
			}else if(json.status==-2){
				$("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;验证码错误");
				getVerify();
			}else{
				$("#errmsg").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;账号或密码错误!");
				getVerify();
			}
	   });
}