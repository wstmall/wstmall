//hash改变后触发
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&');
    if(actionName[0]=='editPwd'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        toEditPwd();
    }else if(actionName[0]=='msgDetails'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        getMsgDetails(actionName[1]);
    }else{
        $('#wst-page1').show();
        $('#wst-page2').addClass('wst-page2');
        $('body').css('background','#EDEDED');
        setTimeout(function(){
            $('body').removeClass('ajaxpage-active');
        },100);
        setTimeout(function(){
        	$('#wst-page1').removeClass('wst-page1');
            $('#wst-page2').css('display','none');
            $('#msgBottom').show();
        },300);
    }
}

//账号安全页
function toEditPwd(){
    var template = Handlebars.compile( $('#editPwd').text() );
    var html = template('');
    $('#wst-page2').html(html);
    $('body').addClass('ajaxpage-active');
    setTimeout(function(){ 
        $('#wst-page1').hide();
    	$('#wst-page2').removeClass('wst-page2');
        $(document).scrollTop(0);
    },300);
    template = html = null;
}

//账号安全
function checkInputStatus(){
    var oldPwd = $('#oldPwd').val();
    var newPwd = $('#newPwd').val();
    var newPwd2 = $('#newPwd2').val();
    if( oldPwd != '' && newPwd != '' && newPwd2 != '' ){
        $('#pwd-confirm').addClass('active');
    }else{
        $('#pwd-confirm').removeClass('active');
    }
}

//修改密码
function submitPwd(){
    if( $('#pwd-confirm').attr('class').indexOf('active') > -1 ){
        var oldPwd = $('#oldPwd').val();
        var newPwd = $('#newPwd').val();
        var newPwd2 = $('#newPwd2').val();
        if( oldPwd == '' ){
            wstMsg('请输入旧密码', 'oldPwd');
            return false;
        }
        if( newPwd == '' ){
            wstMsg('请输入新密码', 'newPwd');
            return false;
        }
        if( newPwd.length < 5 || newPwd.length > 20 ){
            wstMsg('密码长度应为5至20位之间', 'newPwd');
            return false;
        }
        if( newPwd != newPwd2 ){
            wstMsg('两次输入的新密码不一致', 'newPwd');
            return false;
        }

        $('#pwd-submit').attr("disabled","disabled");
        $.post(WST.U('WebApp/Users/editPwd'), {oldPwd:oldPwd, newPwd:newPwd}, function(data){
            var json = WST.toJson(data);
            if(json == '1'){
                wstMsg('密码修改成功');
                setTimeout(function(){
                    location.href = WST.U('WebApp/Users/index');
                },2000);
            }else if(json == '-1'){
                wstMsg('您还没登录');
                $('#pwd-submit').removeAttr("disabled");
                return false;
            }else if(json == '-2'){
                wstMsg('旧密码不正确', 'oldPwd');
                $('#pwd-submit').removeAttr("disabled");
                return false;
            }else{
                wstMsg('密码修改失败，请重试');
                $('#pwd-submit').removeAttr("disabled");
                return false;
            }
        });
    }
}

//退出登录
function logout(){
    $.post(WST.U('WebApp/Users/logout'), {}, function(data){
        var json = WST.toJson(data);
        if(json == '1'){
            location.href = WST.U('WebApp/Users/index');
        }else{
            wstMsg('退出失败，请重试');
            return false;
        }
    });
}

//消息详情
function getMsgDetails(id){
    $('#wst-default-loading').modal();
    $.post(WST.U('WebApp/Messages/getMsgDetails'), {id:id}, function(data){
        var json = WST.toJson(data);
        var template = Handlebars.compile( $('#msgDetails').text() );
        var html = template(json);
        $('#wst-page2').html(html);
        $('#wst-default-loading').modal('close');
        $('body').addClass('ajaxpage-active').css('background','white');
        setTimeout(function(){ 
            $('#wst-page1').hide();
        	$('#wst-page2').removeClass('wst-page2');
            $('#msgBottom').hide();
        	$(document).scrollTop(0);
        },300);
        json = template = html = null;
    });
}

var msgIdsToDel = '';//要删除的消息的id串
//去删除商城消息
function toDelMsg(){
    var msgCount = $('.circle-icon.active').length;//消息个数
    msgIdsToDel = '';
    for(var i=0; i<msgCount; i++){
        msgIdsToDel += $('.circle-icon.active').eq(i).attr('msgId');
        if(i!=msgCount-1){
            msgIdsToDel +=  ',';
        }
    }
    if( msgCount == 0 || msgIdsToDel == '' ){
        wstMsg('请选择要删除的消息');
        return false;
    }
    wstConfirm('确定要删除选中的消息吗？', delMsg );
}

//删除商城消息
function delMsg(){
    $.post(WST.U('WebApp/Messages/delMsg'), {ids:msgIdsToDel}, function(data){
        var json = WST.toJson(data);
        if(json.status==1){
            wstMsg('删除成功');
            setTimeout(function(){
                location.href = WST.U('WebApp/Messages/index');
            },2000);
        }else{
            wstMsg('删除失败，请重试');
        }
    });
}

$(document).ready(function(){
    initFooter('users');
    $('#user-logout').click(function(){
        wstConfirm('确定退出登录？', logout);
    });
});