//hash改变后触发
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&');
    if(actionName[0]=='complainDetails'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        $('#wst-footer').hide();
        getComplainDetails(actionName[1]);
    }else{
        $('#wst-page1').show();
        $('#wst-page2').addClass('wst-page2');
        setTimeout(function(){
            $('body').removeClass('ajaxpage-active');
        },100);
        setTimeout(function(){
            $('#wst-page1').removeClass('wst-page1');
            $('#wst-footer').show();
            $('#wst-page2').css('display','none');
        },500);
    }
}

//加载投诉订单详情页
function getComplainDetails(complainId){
    $('#wst-default-loading').modal();
    $.post(WST.U('WebApp/orderComplains/getComplainDetails'), {complainId:complainId}, function(data){
        var json = WST.toJson(data);
        var template = Handlebars.compile( $('#complainDetails').text() );
        Handlebars.registerHelper("compare",function(v1,v2,options){//注册一个比较大小的Helper,判断v1是否大于v2
            if(v1==v2){
                return options.fn(this);
            }else{
                return options.inverse(this);
            }
        });
        Handlebars.registerHelper('list', function(annex, options) {
            var out = '';
            if( annex.length > 0 ){
                for(var i=0; i<annex.length; i++) {
                    out += '<img class="complains-img" src="'+ WST.ROOT +'/'+annex[i]+'">';
                }
            }
            return out;
        });
        var info = {'info': json, 'rooturl': WST.ROOT};
        var html = template(info);
        $('#wst-page2').html(html);
        $('#wst-default-loading').modal('close');
        $('body').addClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-page1').hide();
            $('#wst-page2').removeClass('wst-page2');
            $(document).scrollTop(0);
        },300);
        json = template = info = html = null;
    });
}

//关闭图片上传区
function closeUploadArea(){
    $('.not-upload').show();
    $('#upload_modal').hide();
    $('#clip').hide();
    //清空图片上传区的内容
    $('#clipArea').find('img').remove();
    $('#file').val('');
    $('#view').css('background-image','');
    $('#imgData').val('');
}

//删除上传的附件
function delImg(obj){
    $(obj).parent('div.complains-annex').remove();
    isDisabledButton();
}

//检查上传的附件的数量，超过5张就禁用上传按钮
function isDisabledButton(){
    if( $('.complains-annex').length >= 5 ){
        $('#addImg').attr('disabled', 'disabled');
        $('#uploadImg').hide();
    }else{
        $('#addImg').removeAttr('disabled');
        $('#uploadImg').show();
    }
}

$(document).ready(function(){
    initFooter('users');

    $('#orderInfo').on('open.collapse.amui', function() {
        $('.order-icon-plus').hide();
        $('.order-icon-minus').show();
    }).on('close.collapse.amui', function() {
        $('.order-icon-plus').show();
        $('.order-icon-minus').hide();
    });

    $('#complainSubmit').click(function(){
        var complainType = $('input[name="complainType"]:checked').val();
        var complainContent = $('#complainContent').val();
        if(complainType!=1 && complainType!=2 && complainType!=3 &&complainType!=4){
            wstMsg('请选择投诉类型');
            return false;
        }
        if(complainContent == ''){
            wstMsg('请输入投诉内容' , 'complainContent');
            return false;
        }
        if( $('.complains-annex').length > 5 ){
            wstMsg('附件数量不能超过5张');
            return false;
        }
        var imgContainer = new Array();
        $('.imgSrc').each(function(){
            imgContainer.push( $(this).val() );
        });
        var complainAnnex = imgContainer.join(',');

        var param = {};
        param.orderId = $('#orderId').val();
        param.complainType = complainType;
        param.complainContent = complainContent;
        param.complainAnnex = complainAnnex;
        $.post(Think.U('WebApp/OrderComplains/saveComplain'), param, function(data){
            var json = WST.toJson(data);
            if(json.status==1){
                wstMsg('您的投诉已提交，请留意信息回复');
                $('#complainSubmit').attr('disabled', 'disabled');
                setTimeout(function(){
                	location.href = WST.U('WebApp/OrderComplains/index');
                },2000);
            }else{
                wstMsg(json.msg);
                $('#complainSubmit').removeAttr('disabled');
            }
        });
    });

    $('#uploadImg').on('change', function() {
        $('.not-upload').hide();
        $('#clip').show();
        $('#upload_modal').show();
    });
});