
function login(){
	return location.href=domainURL +"/index.php/Home/Users/login/";
}
function logout(){
	jQuery.post(domainURL +"/index.php/Home/Users/logout/",{},function(rsp) {
		location.reload();
	});
}
function regist(){
	return location.href=domainURL +"/index.php/Home/Users/regist/";
}
function createCookie(a,b,c,d){
	var d=d?d:"/";
	if(c){
		var e=new Date;
		e.setTime(e.getTime()+1e3*60*60*24*c);
		var f="; expires="+e.toGMTString()
	}else {
		var f="";
	}		
	document.cookie=a+"="+b+f+"; path="+d
}

//刷新验证码
function getVerify() {
    $('.verifyImg').attr('src',domainURL +'/index.php/Home/Users/getVerify/?rd='+Math.random());
}
function checkLogin(){
	jQuery.post(domainURL +"/index.php/Home/Shops/checkLoginStatus/",{},function(rsp) {
		var json = WST.toJson(rsp);
		if(json.status && json.status==-999)location.reload();
	});
}