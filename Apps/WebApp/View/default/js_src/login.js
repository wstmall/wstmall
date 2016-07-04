//hash改变后触发
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&');
    if(actionName[0]=='register'){
        $('#wst-page2').show();
        getRegister();
    }else if(actionName[0]=='forgetpassword'){
        $('#wst-page2').show();
        getForgetPassword();
    }else if(actionName[0]=='byPhone'){
        $('#wst-page2').show();
        byPhone();
    }else if(actionName[0]=='byEmail'){
        $('#wst-page2').show();
        byEmail();
    }else{
        $('body').removeClass('ajaxpage-active');
        setTimeout(function(){
            $('#wst-page2').css('display','none');
            getVerify('login-verifyImg');//从注册页返回登录页后刷选登录页的验证码
            $('#wst-username').focus();
        },300);
    }
}

//注册页
function getRegister(){
    var template = Handlebars.compile( $('#register').text() );
    var html = template('');
    $('#wst-page2').html(html);
    $('body').addClass('ajaxpage-active');
    setTimeout(function(){
        getVerify('register-verifyImg');//注册页加载完后加载验证码
        $('#register-username').focus();
    },300);
    template = html = null;
}

//忘记密码页
function getForgetPassword(){
    var template = Handlebars.compile( $('#forgetPassword').text() );
    var html = template('');
    $('#wst-page2').html(html);
    $('body').addClass('ajaxpage-active');
    setTimeout(function(){
        getVerify('forgetpwd-verifyImg');//加载完后加载验证码
        $('#fUsername').focus();
    },300);
    template = html = null;
}

//通过手机找回密码页
function byPhone(){
    var template = Handlebars.compile( $('#byPhone').text() );
    var html = template('');
    $('#wst-page2').html(html);
    $('#username').html($('#loginName').val());
    $('#phone').html($('#userPhone').val());
    $('body').addClass('ajaxpage-active');
    setTimeout(function(){
        getVerify('phone-verifyImg');//加载完后加载验证码
    },300);
    template = html = null;
}

//通过邮箱找回密码页
function byEmail(){
    var template = Handlebars.compile( $('#byEmail').text() );
    var html = template('');
    $('#wst-page2').html(html);
    $('#username').html($('#loginName').val());
    $('#email').html($('#userEmail').val());
    $('body').addClass('ajaxpage-active');
    setTimeout(function(){
        getVerify('email-verifyImg');//加载完后加载验证码
    },300);
    template = html = null;
}


//登录验证
function loginCheck(){
    var username = $('#wst-username').val();
    var password = $('#wst-password').val();
    var verifyCode = $('#wst-verifyCode').val();
    if(username==''){
        wstMsg('请输入用户名' , 'wst-username');
        return false;
    }
    if( username.length < 5 || username.length > 16 ){
        wstMsg('用户名长度应为5至16位之间' , 'wst-username');
        return false;
    }
    if(password==''){
        wstMsg('请输入密码' , 'wst-password');
        return false;
    }
    if( password.length < 5 || password.length > 20 ){
        wstMsg('密码长度应为5至20位之间' , 'wst-password');
        return false;
    }
    if(verifyCode==''){
        wstMsg('请输入验证码' , 'wst-verifyCode');
        return false;
    }
    $('#wst-login').attr("disabled","disabled");
    $.post(WST.U('WebApp/Users/checkCodeVerify'), {code:verifyCode}, function(data){
        var json = WST.toJson(data);
        if(json.status == '1'){
            $.post(WST.U('WebApp/Users/Login'), {username:username, password:password,rememberPwd:$("#rememberPwd").val()}, function(data){
                var json = WST.toJson(data);
                if(json.status == '1'){
                    wstMsg('登录成功' , '', 1);
                    var targetUrl = (json.originalUrl && json.originalUrl != '') ? json.originalUrl : WST.U('WebApp/Users/index');
                    setTimeout(function(){
                        location.href = targetUrl;
                    },1500);

                }else{
                    wstMsg('账号或密码不正确' , 'wst-username');
                    $('#wst-login').removeAttr("disabled");
                    return false;
                }
            });
        }else{
            wstMsg('验证码错误' , 'wst-verifyCode');
            setTimeout(function(){
                getVerify('login-verifyImg');
            },2000);
            $('#wst-login').removeAttr("disabled");
            return false;
        }
    });
}
//注册验证
function registerCheck(){
    var username = $('#register-username').val();
    var password = $('#register-password').val();
    var password2 = $('#register-password2').val();
    var verifyCode = $('#register-verifyCode').val();
    if( username == '' ){
        wstMsg('请输入用户名' , 'register-username');
        return false;
    }
    if( username.length < 5 || username.length > 16 ){
        wstMsg('用户名长度应为5至16位之间' , 'register-username');
        return false;
    }
    if( password == '' ){
        wstMsg('请输入密码' , 'register-password');
        return false;
    }
    if( password.length < 5 || password.length > 20 ){
        wstMsg('密码长度应为5至20位之间' , 'register-password');
        return false;
    }
    if( password2 == '' ){
        wstMsg('请再输入一次密码' , 'register-password2');
        return false;
    }
    if( password != password2 ){
        wstMsg('请两次输入的密码不一致' , 'register-password');
        return false;
    }
    if( verifyCode == '' ){
        wstMsg('请输入验证码' , 'register-verifyCode');
        return false;
    }
    $('#wst-register').attr("disabled","disabled");
    $.post(WST.U('WebApp/Users/checkCodeVerify'), {code:verifyCode}, function(data){
        var json = WST.toJson(data);
        if(json.status == '1'){
            $.post(WST.U('WebApp/Users/register'), {username:username, password:password}, function(data){
                var json = WST.toJson(data);
                if(json.status == '1'){
                    wstMsg('注册成功');
                    setTimeout(function(){
                        location.href = WST.U('WebApp/Users/index');
                    },1500);
                }else{
                    wstMsg('账号已存在!' , 'register-username');
                    $('#wst-register').removeAttr("disabled");
                    return false;
                }
            });
        }else{
            wstMsg('验证码错误' , 'register-verifyCode');
            setTimeout(function(){
                getVerify('register-verifyImg');
            },2500);
            $('#wst-register').removeAttr("disabled");
            return false;
        }
    });
}

//查询登录名是否存在
function checkLoginKey(){
    var username = $('#fUsername').val();
    var verifyCode = $('#fVerifyCode').val();
    if(username==''){
        wstMsg('请输入用户名' , 'fUsername');
        return false;
    }
    if( username.length < 5 || username.length > 16 ){
        wstMsg('用户名长度应为5至16位之间' , 'fUsername');
        return false;
    }
    if(verifyCode==''){
        wstMsg('请输入验证码' , 'fVerifyCode');
        return false;
    }
    $.post(WST.U('WebApp/Users/checkLoginKey'), {loginName:username,code:verifyCode}, function(data){
        var json = WST.toJson(data);
        if(json.status == 1){
            location.href = WST.U('WebApp/Users/findPassword'); 
        }else if(json.status==-2){
            wstMsg('验证码错误' , 'fVerifyCode');
            setTimeout(function(){
                getVerify('forgetpwd-verifyImg');
            },2000);
        }else if(json.status==-1){        
            wstMsg('该用户名不存在' , 'fUsername');
            setTimeout(function(){
                getVerify('forgetpwd-verifyImg');
            },2000);
        }
    });
}

//发送短信验证码
function sendSmsCode(){
    var pVerifyCode = $('#pVerifyCode').val();
    if(pVerifyCode==''){
        wstMsg('请输入验证码' , 'pVerifyCode');
        return false;
    }
    $('#pButton').attr('disabled', 'disabled').html('正在处理...');
    $.post(WST.U('WebApp/Users/sendSmsCode'), {smsVerfy:pVerifyCode}, function(data){
        var json = WST.toJson(data);
        if(json.status == 1){
            wstMsg('短信发送成功');
            $('#pToNext').show();
            var t = 120;
            var timer = setInterval(function(){
                if(t>=1){
                    $('#pButton').html('重新发送('+t+')');
                    t--;
                }else{
                    clearInterval(timer);
                    $('#pButton').removeAttr('disabled').html('发送验证短信');
                }
            },1000);
        }else{
            wstMsg(json.msg);
            getVerify('phone-verifyImg');
            $('#pButton').removeAttr('disabled').html('发送验证短信');
            return false;
        }
    });
}

//发送验证邮件
function sendEmailCode(){
    var eVerifyCode = $('#eVerifyCode').val();
    if(eVerifyCode==''){
        wstMsg('请输入验证码' , 'eVerifyCode');
        return false;
    }
    $('#eButton').attr('disabled', 'disabled').html('正在处理...');
    $.post(WST.U('WebApp/Users/sendEmailCode'), {code:eVerifyCode}, function(data){
        var json = WST.toJson(data);
        if(json.status == -2){
            wstMsg('验证码不正确' , 'eVerifyCode');
            getVerify('email-verifyImg');
            $('#eButton').removeAttr('disabled').html('发送验证邮件');
            return false;
        }else if(json.status == 1){
            wstMsg('邮件发送成功');
            var t = 120;
            var timer = setInterval(function(){
                if(t>=1){
                    $('#eButton').html('重新发送('+t+')');
                    t--;
                }else{
                    clearInterval(timer);
                    $('#eButton').removeAttr('disabled').html('发送验证邮件');
                }
            },1000);
        }else{
            wstMsg('发送失败，请重试');
            $('#eButton').removeAttr('disabled').html('发送验证邮件');
            return false;
        }
    });
}

//手机：下一步
function toNextByPhone(){
    var phoneVerify = $('#phoneVerify').val();
    if(phoneVerify==''){
        wstMsg('请输入短信验证码' , 'phoneVerify');
        return false;
    }
    $.post(WST.U('WebApp/Users/checkPhoneVerify'), {phoneVerify:phoneVerify}, function(data){
        var json = WST.toJson(data);
        if(json.status == 1){
            location.href = json.url;
        }else{
            wstMsg('短信验证码不正确' , 'phoneVerify');
            return false;
        } 
    });
}

//重置密码
function saveNewPassword(){
    var loginPwd = $('#loginPwd').val();
    var loginPwd2 = $('#loginPwd2').val();
    if( loginPwd == '' ){
        wstMsg('请输入密码' , 'password');
        return false;
    }
    if( loginPwd.length < 5 || loginPwd.length > 20 ){
        wstMsg('密码长度应为5至20位之间' , 'loginPwd');
        return false;
    }
    if( loginPwd2 == '' ){
        wstMsg('请再输入一次密码' , 'loginPwd2');
        return false;
    }
    if( loginPwd != loginPwd2 ){
        wstMsg('请两次输入的密码不一致' , 'loginPwd');
        return false;
    }
    $.post(WST.U('WebApp/Users/resetPass'), {loginPwd:loginPwd, loginPwd2:loginPwd2}, function(data){
        var json = WST.toJson(data);
        if(json.status == 1){
            wstMsg('密码重置成功');
            setTimeout(function(){
                location.href = WST.U('WebApp/Users/index');
            },1500);
        }else{
            wstMsg(json.msg);
        } 
    });
}

$(document).ready(function(){
    initFooter('users');
    $('#wst-username').focus();
    getVerify('login-verifyImg');
});