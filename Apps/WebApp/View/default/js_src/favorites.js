//列表
function getFavoriteList(){
    $('#loading-icon').show();
    loading = true;

    var param = {};
    param.currPage = Number( $('#currPage').val() )+1;
    param.favoriteType = $('#favoriteType').val();
    param.favoriteKey = $('#favoriteSearch').val();
    $.post(WST.U('WebApp/Favorites/getFavoritesList'), param, function(data){
        var json = WST.toJson(data);
        var str = '';
        if(json && json.root && json.root.length>0){
            for(var i=0; i<json.root.length; i++){
                str += '<div class="am-g favorites" id="favorites-'+json.root[i].favoriteId+'">';
                if(param.favoriteType == 1){
                    str += '    <a href="javascript:void(0);" onclick="javascript:goToShopHome('+json.root[i].shopId+','+json.root[i].isSelf+');">';
                }else{
                    str += '    <a href="javascript:void(0);" onclick="javascript:goToGoodsDetails('+json.root[i].goodsId+');">';
                }
                str += '        <div class="am-u-sm-3 wst-goodsimage-area"><img src="'+ WST.DEFAULT_IMG +'" data-echo="'+ WST.ROOT +'/'+json.root[i].favoriteImg+'" class="wst-goodsimage"></div>';
                str += '    </a>';
                str += '    <div class="am-u-sm-9">';
                if(param.favoriteType == 1){
                    str += '    <a href="javascript:void(0);" onclick="javascript:goToShopHome('+json.root[i].shopId+','+json.root[i].isSelf+');">';
                }else{
                    str += '        <a href="javascript:void(0);" onclick="javascript:goToGoodsDetails('+json.root[i].goodsId+');">';
                }
                str += '            <span class="wst-goodsname">'+json.root[i].favoriteName+'</span>';
                str += '        </a>';
                str += '        <div class="am-g goodsname-bottom">';
                if(param.favoriteType == 0){
                    str += '           <a href="javascript:void(0);" onclick="javascript:goToGoodsDetails('+json.root[i].goodsId+');">';
                    str += '               <div class="am-u-sm-8">';
                    str += '                   <span class="wst-price">￥'+json.root[i].shopPrice+'</span>';
                    str += '               </div>';
                    str += '           </a>';
                    str += '           <div class="am-u-sm-4" style="text-align:right;">';
                    str += '               <img src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/car.png" class="goodlist-cart" onclick="javascript:addGoodsCart('+json.root[i].goodsId+','+json.root[i].goodsAttrId+');">';
                    str += '           </div>';
                }
                str += '            <div class="am-u-sm-12" style="text-align:right;">';
                str += '                <button type="button" class="am-btn am-btn-default am-btn-xs" onclick="javascript:toCancel('+json.root[i].favoriteId+');">取消关注</button>';
                str += '            </div>';
                str += '        </div>';
                str += '    </div>';
                str += '</div>';
            }
            $('#currPage').val( json.currPage );
            $('#totalPage').val( json.totalPage );
        }else{
            str += '<div class="am-g list-empty">';
            str += '<div class="am-u-sm-12 am-u-sm-centered" style="text-align:center;">';
            str += '<span class="list-empty-tips">没有相关信息</span>';
            str += '</div>';
            str += '</div>';
        }
        $('#favorites-list').append(str);
        loading = false;
        $('#loading-icon').hide();
        echo.init();//图片懒加载
    });
}

//是否取消关注
function toCancel(favoriteId){
    favoriteIdForCancel = favoriteId;
    var cancelTips = '您确定取消关注该商品吗？';
    if( $('#favoriteType').val() == 1 ){
        var cancelTips = '您确定取消关注该店铺吗？';
    }
    wstConfirm(cancelTips, cancelFavorite);
}

//取消关注
function cancelFavorite(){
    var param = {};
    param.favoriteId = favoriteIdForCancel;
    $.post(WST.U('WebApp/Favorites/cancelFavorite'), param, function(data){
        var json = WST.toJson(data);
        if(json.status == 1){
            wstMsg('取消成功');
            $('#favorites-'+favoriteIdForCancel).addClass('am-animation-slide-top am-animation-reverse');
            setTimeout(function(){
                $('#favorites-'+favoriteIdForCancel).remove();
            },500);
        }else{
            wstMsg('取消失败');
        }
    });
}

var currPage = totalPage = 0;
var loading = false;
var favoriteIdForCancel = 0;//拟取消的ID
$(document).ready(function(){
    initFooter('users');
    getFavoriteList();

    $('.condition-li').click(function(){
        var favoriteType = $(this).attr('favoriteType');
        $('#favoriteType').val(favoriteType);
        if(favoriteType == 1){
            var searchTips = '搜索店铺';
        }else{
            var searchTips = '搜索商品';
        }
        $('#favoriteSearch').attr('placeholder', searchTips);
        $(this).addClass('condition-active').siblings('li.condition-li').removeClass('condition-active');
        $('#currPage').val(0);
        $('#favorites-list').html('');
        getFavoriteList();
    });
    
    $('#toSearch').click(function(){
        $('#favorites-list').html('');
        $('#currPage').val(0);
        getFavoriteList();
    });

    $(window).scroll(function(){  
        if (loading) return;
        if ((5 + $(window).scrollTop()) >= ($(document).height() - $(window).height())) {
            currPage = Number( $('#currPage').val() );
            totalPage = Number( $('#totalPage').val() );
            if( totalPage > 0 && currPage < totalPage ){
                getFavoriteList();
            }
        }
    });
});