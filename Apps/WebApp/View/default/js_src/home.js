//hash改变后触发
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&');
    if(actionName[0] == 'changeCity'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        $('#wst-footer').hide();
        getCitys();
    }else if(actionName[0] == 'brands'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        $('#wst-footer').hide();
        getBrands();
    }else{
        $('#wst-page1').show();
        $('#wst-page2').addClass('wst-page2');
        setTimeout(function(){
            $('body').removeClass('ajaxpage-active');
        }, 100);
        setTimeout(function(){
        	$('#wst-page1').removeClass('wst-page1');
            $('#wst-footer').show();
            $('#wst-page2').css('display','none');
        }, 500);
    }
}

//品牌页
function getBrands(){
    $('#wst-default-loading').modal();
    $.post(WST.U('WebApp/Brands/getBrandsList'), {}, function(data){
        var json = WST.toJson(data);
		var template = Handlebars.compile( $('#brands').text() );
        var brands = {'brands': json, 'defaultImg': WST.DEFAULT_IMG, 'rooturl': WST.ROOT};
        var html = template(brands);
	    $('#wst-page2').html(html);
	    $('#wst-default-loading').modal('close');
	    $('body').addClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-page1').hide();
        	$('#wst-page2').removeClass('wst-page2');
        	$(document).scrollTop(0);
        }, 300);
	    json = template = brands = html = null;
        setTimeout(function(){ 
        	echo.init();//图片懒加载
        }, 300);
    });
}

//商品列表页
function getGoodsList(goodsCatId){
	location.href = WST.U('WebApp/Goods/index', 'goodsCatId1='+goodsCatId);
}

//商家列表页
function goToShops(){
	location.href = WST.U('WebApp/Shops/goToShops');
}

//自营超市
function goToSelfShop(){
	location.href = WST.U('WebApp/Shops/index', 'isSelfShop=1');
}

//品牌列表页
function getGoodsListByBrands(brandId){
    location.href = WST.U('WebApp/Goods/index', 'brandId='+brandId);
}

//设置访问PC版的session，跳转到PC版
function toPc(){
    $.post(WST.U('WebApp/Index/setPcSession'), {}, function(){
        location.href = WST.U('Home/Index/index');
    });
}

$(document).ready(function(){
	initFooter('home');
    new Swiper('.swiper-container', {
        slidesPerView: 3,
        freeMode : true,
        spaceBetween: 5,
        onSlideChangeEnd: function(swiper){
            echo.init();//图片懒加载
        }
    });
});
