//hash改变后触发
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&');
    if(actionName[0]=='details'){
        $('#wst-page2').show();
        $('#wst-footer').hide();
        getOrderDetails(actionName[1]);
    }else{
        $('#wst-page1').show();
        setTimeout(function(){
            $('body').removeClass('ajaxpage-active');
        },100);
        setTimeout(function(){
            $('#wst-footer').show();
            $('#wst-page2').css('display','none');
        },500);
    }
}

//加载订单详情页
function getOrderDetails(orderId){
    $('#wst-default-loading').modal();
    $.post(WST.U('WebApp/Orders/getOrderDetails'), {orderId:orderId}, function(data){
        var json = WST.toJson(data);
        var template = Handlebars.compile( $('#orderDetails').text() );
        Handlebars.registerHelper("compare",function(v1,v2,options){//注册一个比较大小的Helper,判断v1是否大于v2
            if(v1==v2){
                return options.fn(this);
            }else{
                return options.inverse(this);
            }
        });
        var info = {'info': json, 'rooturl': WST.ROOT};
        var html = template(info);
        $('#wst-page2').html(html);
        $('#wst-default-loading').modal('close');
        $('body').addClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-page1').hide();
        },300);
        json = template = brands = html = null;
    });
}

$(document).ready(function(){
    initFooter('users');
});