//hash改变后触发对应的操作
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&&');
    if(actionName[0]=='register'){
        $('#wst-ajaxpage').show();
        getRegister();
    }else{
        $('#wst-ajax-index').show();
        $('#wst-footer').show();
        $('body').removeClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-ajaxpage').hide(); 
            getVerify('login-verifyImg');//从注册页返回登录页后刷选登录页的验证码
        },300);
    }
}

//ajax注册页
function getRegister(){
    $('#city-modal-loading').modal();
    $.post(rooturl+'/WebApp/Users/toRegister/', {}, function(data){
        var template = Handlebars.compile( $('#register').text() );
        var html = template('');
        $('#wst-ajaxpage').html(html);
        $('#city-modal-loading').modal('close');
        $('body').addClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-ajax-index').hide(); 
            afterAjax();
        },300);
    });
}

//注册页加载完后触发的操作
function afterAjax(){
    getVerify('register-verifyImg');
}

//登录验证
function loginCheck(){
    var username = $('#wst-username').val();
    var password = $('#wst-password').val();
    var verifyCode = $('#wst-verifyCode').val();
    if(username==''){
        alertThenFocus('请输入用户名', 'wst-username', 2);
        return false;
    }
    if( username.length < 5 || username.length > 16 ){
        alertThenFocus('用户名长度应为5至16位之间', 'register-username', 2);
        return false;
    }
    if(password==''){
        alertThenFocus('请输入密码', 'wst-password', 2);
        return false;
    }
    if( password.length < 5 || password.length > 20 ){
        alertThenFocus('密码长度应为5至20位之间', 'wst-password', 2);
        return false;
    }
    if(verifyCode==''){
        alertThenFocus('请输入验证码', 'wst-verifyCode', 2);
        return false;
    }
    $.post(rooturl+'/WebApp/Users/checkCodeVerify/', {code:verifyCode}, function(data){
        var json = WST.toJson(data);
        if(json.status == '1'){
            $.post(rooturl+'/WebApp/Users/Login/', {username:username, password:password}, function(data){
                var json = WST.toJson(data);
                if(json.status == '1'){
                    alertThenFocus('登录成功', '', 1);
                    setTimeout(function(){
                        location.href = ThinkPHP.U('WebApp/Users/index');
                    },1000);
                }else{
                    alertThenFocus('账号或密码不正确!', 'wst-username', 2);
                    return false;
                }
            });
        }else{
            alertThenFocus('验证码错误', 'wst-verifyCode', 2);
            setTimeout(function(){
                getVerify('login-verifyImg');
            },2500);
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
        alertThenFocus('请输入用户名', 'register-username', 2);
        return false;
    }
    if( username.length < 5 || username.length > 16 ){
        alertThenFocus('用户名长度应为5至16位之间', 'register-username', 2);
        return false;
    }
    if( password == '' ){
        alertThenFocus('请输入密码', 'register-password', 2);
        return false;
    }
    if( password.length < 5 || password.length > 20 ){
        alertThenFocus('密码长度应为5至20位之间', 'register-password', 2);
        return false;
    }
    if( password2 == '' ){
        alertThenFocus('请再输入一次密码', 'register-password2', 2);
        return false;
    }
    if( password != password2 ){
        alertThenFocus('请两次输入的密码不一致', 'register-password', 2);
        return false;
    }
    if( verifyCode == '' ){
        alertThenFocus('请输入验证码', 'register-verifyCode', 2);
        return false;
    }
    $.post(rooturl+'/WebApp/Users/checkCodeVerify/', {code:verifyCode}, function(data){
        var json = WST.toJson(data);
        if(json.status == '1'){
            $.post(rooturl+'/WebApp/Users/register/', {username:username, password:password}, function(data){
                var json = WST.toJson(data);
                if(json.status == '1'){
                    alertThenFocus('注册成功', '', 2);
                    location.href = ThinkPHP.U('WebApp/Index/index');
                }else{
                    alertThenFocus('账号已存在!', 'register-username', 2);
                    return false;
                }
            });
        }else{
            alertThenFocus('验证码错误', 'register-verifyCode', 2);
            setTimeout(function(){
                getVerify('register-verifyImg');
            },2500);
            return false;
        }
    });
}

//刷新验证码
function getVerify(targetId) {
    $('#'+targetId).attr('src',rooturl+'/WebApp/Users/getVerify'+'/rnd='+Math.random());
}

$(document).ready(function(){
    initFooter('users');
    getVerify('login-verifyImg');

});