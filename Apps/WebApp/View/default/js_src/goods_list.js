//hash改变后触发对应的操作
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&');
    if(actionName=='changeCity'){
        $('#wst-page2').show();
        getCitys();
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

//排序条件
function orderCondition(obj,desc){
    var classContent = $(obj).attr('class');
    var status = $(obj).attr('status');
    var theSiblings = $(obj).siblings('.goods-filter');
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
            $('#goodsOrder').val('0');
        }else{
            $(obj).children('.arrow-down').hide();
            $(obj).children('.arrow-up').show();
            $(obj).attr('status','up');
            $('#goodsOrder').val('1');
        }
    }else{
        $(obj).children('.arrow-down').show();
        $(obj).children('.arrow-up').hide();
        $(obj).attr('status','down');
        $('#goodsOrder').val('0');
    }
    $('#goodsOrderby').val(desc);//排序条件
    $('#currPage').val('0');//当前页归零
    $('#goods-list').html('');
    getGoodsList();
}

//获取商品列表
function getGoodsList(){
    $('#loading-icon').show();
    loading = true;

    var param = {};
    param.pageSize = 10;
    param.currPage = Number( $('#currPage').val() ) + 1;
    param.goodsCatId1 = $('#goodsCatId1').val();
    param.goodsCatId2 = $('#goodsCatId2').val();
    param.goodsCatId3 = $('#goodsCatId3').val();
    param.brandId = $('#brandId').val();
    param.desc = $('#goodsOrderby').val();
    param.descType = $('#goodsOrder').val();
    param.key = $('#searchKey').val();

    $.post(WST.U('WebApp/Goods/getGoodsList'), param, function(data){
        var json = WST.toJson(data);
        var str = '';
        if(json && json.root && json.root.length>0){
            for(var i=0; i<json.root.length; i++){
                str += '<div class="am-g goods">';
                str += '<a href="javascript:void(0);" onclick="javascript:goToGoodsDetails('+json.root[i].goodsId+');">';
                str += '<div class="am-u-sm-3 wst-goodsimage-area"><img src="'+ WST.DEFAULT_IMG +'" data-echo="'+ WST.ROOT +'/'+json.root[i].goodsThums+'" class="wst-goodsimage"></div></a>';
                str += '<div class="am-u-sm-9">';
                str += '<a href="javascript:void(0);" onclick="javascript:goToGoodsDetails('+json.root[i].goodsId+');">';
                str += '<span class="wst-goodsname">'+json.root[i].shopName+'&nbsp;'+json.root[i].goodsName+'</span></a>';
                str += '<div class="am-g goodsname-bottom">';
                str += '<a href="javascript:void(0);" onclick="javascript:goToGoodsDetails('+json.root[i].goodsId+');">';
                str += '<div class="am-u-sm-8">';
                for(var j=1; j<6; j++){
                    if(j <= json.root[i].score){
                        str += '<img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/1star.png" class="goods-star">';
                    }else{
                        str += '<img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/gray_star.png" class="goods-star">';
                    }
                }
                str += '<br><span class="wst-price-area"><span class="wst-price">￥'+json.root[i].shopPrice+'</span></span>';
                str += '<span class="deliveryStartMoney">'+json.root[i].deliveryStartMoney+'元起配送</span>';
                str += '</div></a><div class="am-u-sm-4" style="text-align:right;">';
                str += '<img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/car.png" class="goodlist-cart" onclick="javascript:addGoodsCart('+json.root[i].goodsId+','+json.root[i].goodsAttrId+');">';
                var distance = (json.root[i].userDistance) ? json.root[i].userDistance : '';
                str += '<span class="userDistance">'+distance+'km</span>';
                str += '</div></div></div></div>';
            }
            $('#currPage').val(json.currPage)
            $('#totalPage').val(json.totalPage);
        }else{
            str += '<div class="am-g list-empty">';
            str += '<div class="am-u-sm-12 am-u-sm-centered" style="text-align:center;">';
            str += '<span class="list-empty-tips">对不起，没有相关商品。</span>';
            str += '</div>';
            str += '</div>';
        }
        $('#goods-list').append(str);
        loading = false;
        $('#loading-icon').hide();
        echo.init();//图片懒加载
    });
}

var currPage = totalPage = 0;
var loading = false;
$(document).ready(function(){
    initFooter('home');
    getGoodsList();

    $(window).scroll(function(){  
        if (loading) return;
        if ((5 + $(window).scrollTop()) >= ($(document).height() - $(window).height())) {
            currPage = Number( $('#currPage').val() );
            totalPage = Number( $('#totalPage').val() );
            if( totalPage > 0 && currPage < totalPage ){
                getGoodsList();
            }
        }
    });
});