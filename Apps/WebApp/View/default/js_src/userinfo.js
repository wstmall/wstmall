//打开修改昵称面板
function openNickName(){
    var options = {'closeViaDimmer': false};
    $('#wst-nickname-popup').modal(options);
}

//关闭修改昵称面板
function closeNickName(){
    $('#wst-nickname-popup').modal('close');
}

//修改昵称
function editNickName(){
    var userName = $('#userName').val();
    if(userName==''){
        wstMsg('昵称不能为空', 'userName');
        return false;
    }
    $.post(WST.U('WebApp/Users/editUserInfo'), {userName:userName}, function(data){
        var json = WST.toJson(data);
        if(json == '1'){
            wstMsg('修改昵称成功');
            $('#nickname').html(userName);
            $('#wst-nickname-popup').modal('close');
        }else{
            wstMsg('修改昵称失败，请重试');
            return false;
        }
    });
}

//打开修改性別面板
function openUserSex(){
    var options = {'closeViaDimmer': false};
    $('#wst-usersex-popup').modal(options);
}

//关闭修改性別面板
function closeUserSex(){
    $('#wst-usersex-popup').modal('close');
}

//修改性别
function eidtUserSex(obj, userSex){
    $(obj).children('.usersex-check-area').html('<i class="am-icon-check usersex-check"></i>');
    $(obj).siblings('.usersex').children('.usersex-check-area').html('');
    $.post(WST.U('WebApp/Users/editUserInfo'), {userSex:userSex}, function(data){
        var json = WST.toJson(data);
        if(json == '1'){
            var newUserSex = '';
            if(userSex==0){
                newUserSex = '保密';
            }else if(userSex==1){
                newUserSex = '男';
            }else if(userSex==2){
                newUserSex = '女';
            }
            $('#usersex').html(newUserSex);
            wstMsg('修改性别成功');
            $('#wst-usersex-popup').modal('close');
        }else{
            wstMsg('修改性别失败，请重试');
            return false;
        }
    });
}

$(document).ready(function(){
    initFooter('users');
    $('#user-logout').click(function(){
        wstConfirm('确定退出登录？', logout);
    });

    //绑定邮箱：发送验证邮件
    $('#sendEmail').click(function(){
	    var userEmail = $('#userEmail').val();
	    var verifyCode = $('#verifyCode').val();
	    if( userEmail == '' ){
	        wstMsg('请输入邮箱' , 'userEmail');
	        return false;
	    }
	    if( !WST.isEmail(userEmail) ){
	        wstMsg('邮箱地址格式不正确' , 'userEmail');
	        return false;
	    }
	    if( verifyCode == '' ){
	        wstMsg('请输入验证码' , 'verifyCode');
	        return false;
	    }
	    $(this).attr('disabled', 'disabled').html('正在处理...');
	    $.post(WST.U('WebApp/Users/sendEmailCodeToBind'), {code: verifyCode, userEmail: userEmail}, function(data){
	        var json = WST.toJson(data);
	        if(json.status == 1){
	            wstMsg('邮件发送成功');
	            var t = 120;
	            var timer = setInterval(function(){
	                if(t>=1){
	                    $('#sendEmail').html('重新发送('+t+')');
	                    t--;
	                }else{
	                    clearInterval(timer);
	                    $('#sendEmail').removeAttr('disabled').html('发送验证邮件');
	                }
	            }, 1000);
	            setTimeout(function(){
	            	$('.bind-area').show();
	            }, 1000);
	        }else if(json.status == -2){
	            wstMsg('验证码不正确' , 'verifyCode');
	            getVerify('verifyImg');
	            $('#sendEmail').removeAttr('disabled').html('发送验证邮件');
	            return false;
	        }else if(json.status == -3){
	            wstMsg('邮箱格式不正确' , 'userEmail');
	            $('#sendEmail').removeAttr('disabled').html('发送验证邮件');
	            return false;
	        }else if(json.status == -4){
	            wstMsg('请勿重复绑定相同的邮箱' , 'userEmail');
	            $('#sendEmail').removeAttr('disabled').html('发送验证邮件');
	            return false;
	        }else{
	            wstMsg(json.msg);
	            $('#sendEmail').removeAttr('disabled').html('发送验证邮件');
	            return false;
	        }
	    });
    });

    //绑定邮箱
    $('#bindEmail').click(function(){
	    var emailCode = $('#emailCode').val();
	    if( emailCode == '' ){
	        wstMsg('请输入邮箱验证码' , 'emailCode');
	        return false;
	    }
	    $(this).attr('disabled', 'disabled').html('正在处理...');
	    $.post(WST.U('WebApp/Users/bindEmail'), {emailCode: emailCode}, function(data){
	        var json = WST.toJson(data);
	        if(json.status == 1){
	            wstMsg('绑定邮箱成功');
	            setTimeout(function(){
	            	location.href = WST.U('WebApp/Users/toUserInfo');
	            }, 2000);
	        }else{
	            wstMsg(json.msg);
	            $('#bindEmail').removeAttr('disabled').html('绑定邮箱');
	        }
	    });
    });

    //绑定手机：发送验证短信
    $('#sendPhone').click(function(){
	    var userPhone = $('#userPhone').val();
	    var verifyCode = $('#verifyCode').val();
	    if( userPhone == '' ){
	        wstMsg('请输入手机号码' , 'userPhone');
	        return false;
	    }
	    if( !WST.isPhone(userPhone) ){
	        wstMsg('手机号码格式不正确' , 'userPhone');
	        return false;
	    }
	    if( verifyCode == '' ){
	        wstMsg('请输入验证码' , 'verifyCode');
	        return false;
	    }
	    $(this).attr('disabled', 'disabled').html('正在处理...');
	    $.post(WST.U('WebApp/Users/sendPhoneCodeToBind'), {code: verifyCode, userPhone: userPhone}, function(data){
	        var json = WST.toJson(data);
	        if(json.status == 1){
	            wstMsg('短信发送成功');
	            var t = 120;
	            var timer = setInterval(function(){
	                if(t>=1){
	                    $('#sendPhone').html('重新发送('+t+')');
	                    t--;
	                }else{
	                    clearInterval(timer);
	                    $('#sendPhone').removeAttr('disabled').html('发送验证短信');
	                }
	            }, 1000);
	            setTimeout(function(){
	            	$('.bind-area').show();
	            }, 1000);
	        }else if(json.status == -2){
	            wstMsg('验证码不正确' , 'verifyCode');
	            getVerify('verifyImg');
	            $('#sendPhone').removeAttr('disabled').html('发送验证短信');
	            return false;
	        }else if(json.status == -3){
	            wstMsg('手机号码格式不正确' , 'userPhone');
	            $('#sendPhone').removeAttr('disabled').html('发送验证短信');
	            return false;
	        }else if(json.status == -4){
	            wstMsg('请勿重复绑定相同的手机号码' , 'userPhone');
	            $('#sendPhone').removeAttr('disabled').html('发送验证短信');
	            return false;
	        }else{
	            wstMsg('短信发送失败，请重试');
	            $('#sendPhone').removeAttr('disabled').html('发送验证短信');
	            return false;
	        }
	    });
    });

    //绑定手机
    $('#bindPhone').click(function(){
	    var phoneCode = $('#phoneCode').val();
	    if( phoneCode == '' ){
	        wstMsg('请输入短信验证码' , 'phoneCode');
	        return false;
	    }
	    $(this).attr('disabled', 'disabled').html('正在处理...');
	    $.post(WST.U('WebApp/Users/bindPhone'), {phoneCode: phoneCode}, function(data){
	        var json = WST.toJson(data);
	        if(json.status == 1){
	            wstMsg('绑定手机号码成功');
	            setTimeout(function(){
	            	location.href = WST.U('WebApp/Users/toUserInfo');
	            }, 2000);
	        }else{
	            wstMsg(json.msg);
	            $('#bindPhone').removeAttr('disabled').html('绑定手机号码');
	        }
	    });
    });
});