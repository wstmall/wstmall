//hash改变后触发对应的操作
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    if(actionName=='changeCity'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        getCitys();
    }else{
        $('#wst-page1').show();
        $('#wst-footer').show();
        $('body').removeClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-page2').hide();
            $('#wst-page1').removeClass('wst-page1');
        },300);
    }
}

//排序条件
function orderCondition(obj,desc){
    var classContent = $(obj).attr('class');
    var status = $(obj).attr('status');
    var theSiblings = $(obj).siblings('.shops-filter');
    $(obj).addClass('active');
    theSiblings.removeClass('active').attr('status','down');;
    if(classContent.indexOf('active')==-1){
        $(obj).children('.active-icon').show();
        $(obj).children('.noactive-icon').hide();
        theSiblings.children('.active-icon').hide();
        theSiblings.children('.noactive-icon').show();
        theSiblings.children('.arrow-up').hide();
    }
    if(status.indexOf('down')>-1){
        if(classContent.indexOf('active')==-1){
            $(obj).children('.arrow-down').show();
            $(obj).children('.arrow-up').hide();
            $('#shopOrder').val('0');
        }else{
            $(obj).children('.arrow-down').hide();
            $(obj).children('.arrow-up').show();
            $(obj).attr('status','up');
            $('#shopOrder').val('1');
        }
    }else{
        $(obj).children('.arrow-down').show();
        $(obj).children('.arrow-up').hide();
        $(obj).attr('status','down');
        $('#shopOrder').val('0');
    }
    $('#shopOrderby').val(desc);//排序条件
    $('#currPage').val('0');//当前页归零
    $('#shops-list').html('');
    getShopList();
}

//商家列表
function getShopList(){
    $('#loading-icon').show();
    loading = true;

    var param = {};
    param.pageSize = 10;
    param.currPage = Number( $('#currPage').val() ) + 1;
    param.desc = $('#shopOrderby').val();
    param.descType = $('#shopOrder').val();
    param.key = $('#searchKey').val();

    $.post(WST.U('WebApp/Shops/getShopsList'), param, function(data){
        var json = WST.toJson(data);
        var str = '';
        if(json && json.root && json.root.length>0){
            for(var i=0; i<json.root.length; i++){
                str += '<a class="shops" href="javascript:void(0);" onclick="goToShopHome('+json.root[i].shopId+','+json.root[i].isSelf+');">';
                str += '<div class="am-g">';
                str += '<div class="am-u-sm-3 wst-shopsimage-area">';
                str += '<img src="'+ WST.DEFAULT_IMG +'" data-echo="'+ WST.ROOT +'/'+json.root[i].shopImg+'" class="wst-shopsimage">';
                str += '</div>';
                str += '<div class="am-u-sm-9">';
                str += '<div class="am-g">';
                str += '<div class="am-u-sm-7"><h5 class="wst-shopsname">'+json.root[i].shopName+'</h5></div>';
                str += '<div class="am-u-sm-5 wst-minmoney">￥'+json.root[i].deliveryStartMoney+'元起配送</div>';
                str += '</div>';
                str += '<div class="am-g">';
                str += '<div class="am-u-sm-7">';
                for(var j=1; j<6; j++){
                    if(j <= json.root[i].score){
                        str += '<img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/1star.png" class="shops-star">';
                    }else{
                        str += '<img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/gray_star.png" class="shops-star">';
                    }
                }
                str += '</div>';
                var distance = (json.root[i].userDistance) ? json.root[i].userDistance : '';
                str += '<div class="am-u-sm-5 wst-distance">'+distance+'KM</div>';
                str += '</div>';
                str += '<span class="wst-trade">主营：'+json.root[i].catName+'</span>';
                str += '<span class="wst-address">'+json.root[i].shopAddress+'</span>';
                str += '</div>';
                str += '</div></a>';

            }
            $('#currPage').val(json.currPage);
            $('#totalPage').val(json.totalPage);
        }else{
            str += '<div class="am-g list-empty">';
            str += '<div class="am-u-sm-12 am-u-sm-centered" style="text-align:center;">';
            str += '<span class="list-empty-tips">对不起，附近没有商家。</span>';
            str += '</div>';
            str += '</div>';
        }
        $('#shops-list').append(str);
        loading = false;
        $('#loading-icon').hide();
        echo.init();//图片懒加载
    });
}

var currPage = totalPage = 0;
var loading = false;
$(document).ready(function(){
    initFooter('home');
    getShopList();

    $(window).scroll(function(){  
        if (loading) return;
        if ((5 + $(window).scrollTop()) >= ($(document).height() - $(window).height())) {
            currPage = Number( $('#currPage').val() );
            totalPage = Number( $('#totalPage').val() );
            if( totalPage > 0 && currPage < totalPage ){
                getShopList();
            }
        }
    });
});