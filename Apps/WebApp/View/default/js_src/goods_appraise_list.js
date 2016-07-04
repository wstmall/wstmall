//排序条件
function orderCondition(obj,type){
    $(obj).addClass('active').siblings('.appraise-filter').removeClass('active');
    $('#type').val(type);
    $('#currPage').val('0');//当前页归零
    $('#appraise-list').html('');
    getGoodsAppraiseList();
}

//商品评价列表
function getGoodsAppraiseList(){
    $('#loading-icon').show();
    loading = true;

    var param = {};
    param.currPage = Number( $('#currPage').val() ) + 1;
    param.goodsId = $('#goodsId').val();
    param.type = $('#type').val();

    $.post(WST.U('WebApp/Goods/getAppraisesList'), param, function(data){
        var json = WST.toJson(data);
        var str = '';
        if(json && json.root && json.root.length>0){
            for(var i=0; i<json.root.length; i++){
                str += '<div class="am-g single-appraise">';
                str += '<div class="am-u-sm-6" style="padding-right:0;">用户：'+json.root[i].userName+'</div>';
                str += '<div class="am-u-sm-6 appraise-datetime">'+json.root[i].createTime+'</div>';
                str += '<div class="am-u-sm-12 score-area">';
                str += '<span class="score">商品评分：';
                for(var j=0; j<json.root[i].goodsScore; j++){
                    str += '<img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/1star.png" class="star">';
                }
                str += '</span>';
                str += '<span class="score">服务评分：';
                for(var j=0; j<json.root[i].serviceScore; j++){
                    str += '<img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/1star.png" class="star">';
                }
                str += '</span>';
                str += '<span class="score">时效评分：';
                for(var j=0; j<json.root[i].timeScore; j++){
                    str += '<img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/1star.png" class="star">';
                }
                str += '</div>';
                str += '<div class="am-u-sm-12 appraises-content">'+json.root[i].content+'</div>';
                str += '</div>';
            }
            $('#currPage').val(json.currPage);
            $('#totalPage').val(json.totalPage);
        }else{
            str += '<div class="am-g list-empty">';
            str += '<div class="am-u-sm-12 am-u-sm-centered" style="text-align:center;">';
            str += '<span class="list-empty-tips">对不起，没有相关评价。</span>';
            str += '</div>';
            str += '</div>';
        }
        $('#appraise-list').append(str);
        loading = false;
        $('#loading-icon').hide();
    });
}

var currPage = totalPage = 0;
var loading = false;
$(document).ready(function(){
    initFooter('home');
    getGoodsAppraiseList();

    $(window).scroll(function(){  
        if (loading) return;
        if ((5 + $(window).scrollTop()) >= ($(document).height() - $(window).height())) {
            currPage = Number( $('#currPage').val() );
            totalPage = Number( $('#totalPage').val() );
            if( totalPage > 0 && currPage < totalPage ){
                getGoodsAppraiseList();
            }
        }
    });
});
