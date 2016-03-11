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
