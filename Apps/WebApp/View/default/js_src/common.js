var wstStorage = window.localStorage;
var WST = WST ? WST : {};
WST.toJson = function(str){
    var json = {};
    try{
        if(typeof(str)=="object"){
            json = str;
        }else{
            json = eval("("+str+")");
        }
        if(json.status && json.status=='-999'){
            wstMsg('对不起，您尚未登录系统，请先登录');
            setTimeout(function(){
                location.href = WST.U('WebApp/Users/index');
            }, 2000);
        }
    }catch(e){
        wstMsg("系统发生错误:"+e.getMessage);
        json = {};
    }
    return json;
}
WST.blank = function(str,defaultVal){
	if(!str)str = '';
	if(str=='0000-00-00')str = '';
	if(str=='0000-00-00 00:00:00')str = '';
	if(typeof(str)=='null')str = '';
	if(typeof(str)=='undefined')str = '';
	if(str=='' && defaultVal)str = defaultVal;
	return str;
}
//只能輸入數字
WST.isNumberKey = function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }else{      
        return true;
    }
}

//只能輸入數字和小數點
WST.isNumberdoteKey = function(evt){
    var e = evt || window.event; 
    var srcElement = e.srcElement || e.target;
    var charCode = (evt.which) ? evt.which : event.keyCode;         
    if (charCode > 31 && ((charCode < 48 || charCode > 57) && charCode!=46)){
        return false;
    }else{
        if(charCode==46){
            var s = srcElement.value;           
            if(s.length==0 || s.indexOf(".")!=-1){
                return false;
            }           
        }       
        return true;
    }
}

WST.isChinese = function(obj,isReplace){
    var pattern = /[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/i
    if(pattern.test(obj.value)){
        if(isReplace)obj.value=obj.value.replace(/[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/ig,"");
        return true;
    }
    return false;
}  

WST.isEmail =function(v){
    var tel = new RegExp("^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$");
    return(tel.test(v));
}

WST.isPhone = function(v){
     var tel = new RegExp("^[1][0-9]{10}$");
     return(tel.test(v));
}

//跳到商品分类页
function toGoodsCat(){
    location.href = WST.U('WebApp/GoodsCat/index');
}

//底部的tab
function initFooter(tab){
    var homeImage = (tab=='home') ? 'home-active' : 'home';
    var categoryImage = (tab=='category') ? 'category-active' : 'category';
    var cartImage = (tab=='cart') ? 'cart-active' : 'cart';
    var usersImage = (tab=='users') ? 'users-active' : 'users';
    $('#home').append('<img class="wst-footer-img" src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/'+homeImage+'.png" style="width:24px;height:40px;">');
    $('#category').append('<img class="wst-footer-img" src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/'+categoryImage+'.png" style="width:24px;height:40px;">');
    $('#cart').prepend('<img class="wst-footer-img cart-img" src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/'+cartImage+'.png" style="width:24px;height:40px;">');
    $('#users').append('<img class="wst-footer-img" src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/'+usersImage+'.png" style="width:24px;height:40px;">');
}

//提示
function wstMsg(msg, focusTarget, time){
    $('#wst-modal-content').html(msg);
    $('#wst-msg-modal').show();
    $('#wst-msg-modal').addClass('am-animation-fade');
    var t = time ? time : 2;
    setTimeout(function(){
        if(focusTarget){
            $('#'+focusTarget).focus();
        }
        $('#wst-msg-modal').fadeOut(1000);
    },t*1000);
}

//confirm
function wstConfirm(msg, callback, cancelCallback){
    $('#confirmMsg').html(msg);
    var options = {
        closeViaDimmer: false,
        relatedTarget: this,
        onConfirm: callback
    };
    if(cancelCallback){
        options.onCancel = cancelCallback;
    }
    $('#wst-confirm').modal(options);
}

//获取html5 storage item
function storageGetItem(itemName){
	return wstStorage.getItem(itemName);
}

//设置html5 storage item
function storageSetItem(itemName, itemValue){
	wstStorage.setItem(itemName, itemValue);
}

//移除html5 storage item
function storageRemoveItem(itemName){
	wstStorage.removeItem(itemName);
}

//变换选中框的状态
function changeIconStatus(obj, toggle, status){
    if(toggle==1){
        if( obj.attr('class').indexOf('am-icon-circle-thin') > -1 ){
            obj.removeClass('am-icon-circle-thin').addClass('am-icon-check-circle active');
        }else{
            obj.removeClass('am-icon-check-circle active').addClass('am-icon-circle-thin');
        }
    }else if(toggle==2){
        if(status == 'active'){
            obj.removeClass('am-icon-circle-thin').addClass('am-icon-check-circle active');
        }else{
            obj.removeClass('am-icon-check-circle active').addClass('am-icon-circle-thin');
        }
    }
}

//加入商品到购物车
function addGoodsCart(goodsId, goodsAttrId, gcount){
    var param = {};
    param.gcount = gcount ? gcount : 1;
    param.goodsId = goodsId;
    param.goodsAttrId = goodsAttrId;
    param.rnd = Math.random();
    $.post(WST.U('WebApp/Cart/addToCartAjax'), param, function(data){
        var json = WST.toJson(data);
        if(json.status==1){
            $.post(WST.U('WebApp/Cart/getCartGoodCnt'), {}, function(data){
                var json = WST.toJson(data);
                wstMsg('恭喜，加入购物车成功！');
                $('#cartGoodsNum').show();
                $('#cartGoodsNum').html(json.goodscnt);
            });
        }
    });
}

//搜索
function WSTSearch(flag){
    var key = $('#wst-nav-search').val();
    if(key==''){
        wstMsg('请输入要搜索的商品名称', 'wst-nav-search');
        return false;
    }
    var url = (flag==1) ? 'WebApp/Shops/goToShops' : 'WebApp/Goods/index';
    location.href = WST.U(url, 'key='+key);
}

//修改商品购买数量
function changeGoodsNum(flag){
    var num = parseInt($("#goodscount").val(),10);
    var num = num?num:1;
    if(flag==1){
        if(num>1)num = num-1;
    }else if(flag==2){
        num = num+1;
    }
    var maxVal = parseInt($("#goodscount").attr('maxVal'),10);
    if(maxVal<=num)num=maxVal;
    $("#goodscount").val(num);
}

//商品详情页:立即购买
function buyItNow(goodsId){
    var param = {};
    var gcount = $('#goodscount').val();
    param.gcount = gcount;
    param.goodsId = goodsId;
    param.goodsAttrId = $('#goodsAttrId').val();
    param.rnd = Math.random();
    $.post(WST.U('WebApp/Cart/addToCartAjax'), param, function(data){
        var json = WST.toJson(data);
        if(json.status==1){
            location.href = WST.U('WebApp/Cart/index');
        }
    });
}

//商品详情页:加入购物车
function addToCart(goodsId){
    var gcount = $('#goodscount').val();
    var goodsAttrId = $('#goodsAttrId').val();
    addGoodsCart(goodsId, goodsAttrId, gcount);
}

//商家主页
function goToShopHome(shopId, isSelfShop){
    location.href = WST.U('WebApp/Shops/index','shopId='+shopId+'&isSelfShop='+isSelfShop+'&areaId2='+ WST.areaId2);
}

//商品详情
function goToGoodsDetails(goodsId){
    location.href = WST.U('WebApp/Goods/goodsDetails','goodsId='+goodsId);
}

//订单投诉
function goToComplains(orderId){
    location.href = WST.U('WebApp/OrderComplains/toComplains','orderId='+orderId);
}

//关注商品或店铺
function favorite(obj, targetId, favoriteType){
	var param = {};
    param.targetId = targetId;
    param.favoriteType = favoriteType;
    $.post(WST.U('WebApp/Favorites/favorite'), param, function(data){
        var json = WST.toJson(data);
        if(json.status == 1){
            wstMsg('已关注');
    		var tips = '已关注该商品';
    		if(favoriteType == 1){
    			tips = '已关注该店铺';
    		}
            setTimeout(function(){
                $(obj).attr('disabled', 'disabled').html(tips);
            }, 2000);
        }else{
            wstMsg('关注失败，请重试');
        }
    });
}

//刷新验证码
function getVerify(targetId) {
    $('#'+targetId).attr('src',WST.U('WebApp/Users/getVerify', 'rnd='+Math.random()));
}

//加载高德地图成功后的回调函数
function mapCallback(){
    if( WST.locationFrom == 'defaultCity' ){//当前是默认城市，去获取其经纬度
	    AMap.service('AMap.Geocoder',function(){//回调函数
	        geocoder = new AMap.Geocoder({});
	        geocoder.getLocation(WST.defaultAreaName, function(status, result) {
	            if(status === 'complete' && result.info === 'OK') {//状态正常，得到默认城市的经纬度信息
	                var param = {};
	                param.areaId2 = WST.defaultAreaId;
	                param.areaName2 = WST.defaultAreaName;
	                param.wstLatitude = result.geocodes[0].location.lat;//纬度
	                param.wstLongitude = result.geocodes[0].location.lng;//经度
	                setLocationSession(param, 1);
	            }else{//状态异常
	                wstMsg(result);
	            }
	        });   
	    }); 
	}
}

//获取当前地理位置信息
function wstGetPosition(){
    var wstMap, wstGeolocation;
    wstMap = new AMap.Map('container', {
        resizeEnable: true
    });
    wstMap.plugin('AMap.Geolocation', function() {
        wstGeolocation = new AMap.Geolocation({
            timeout: 5000//超过5秒后停止定位，默认：无穷大
        });
        wstGeolocation.getCurrentPosition();
        AMap.event.addListener(wstGeolocation, 'complete', wstGetPositionComplete);//返回定位信息
        AMap.event.addListener(wstGeolocation, 'error', wstGetPositionError); //返回定位出错信息
    });
}

//获取当前地理位置信息的回调函数
function wstGetPositionComplete(data){
    var wstLatitude = data.position.getLat();//纬度
    var wstLongitude = data.position.getLng();//经度
    setRealLocationSession(wstLatitude, wstLongitude);
    AMap.service('AMap.Geocoder',function(){//回调函数
        geocoder = new AMap.Geocoder({});
        var lnglatXY = [wstLongitude, wstLatitude];
        geocoder.getAddress(lnglatXY, function(status, result) {
            if (status === 'complete' && result.info === 'OK') {//状态正常
                if(result.regeocode.addressComponent.city != ''){
                    var currentCityName = result.regeocode.addressComponent.city;
                }else{//city为空时是直辖市，此时取province
                    var currentCityName = result.regeocode.addressComponent.province;
                }
                if( currentCityName != WST.areaName2 ){//当前城市与页面中显示的城市不一样时才需要提示是否切换城市
                    var param = {};
                    param.action = 'location';
                    param.key = currentCityName;
                    $.post(WST.U('WebApp/Index/getCitys'), param, function(data){//检查系统里是否有该城市
                        if(data){
                            if( data.areaId != WST.areaId2 ){//经纬度定位到的城市跟IP定位到的不同时才提示是否切换城市
                                var param = {};
                                param.areaId2 = data.areaId;
                                param.areaName2 = data.areaName;
                                param.wstLatitude = wstLatitude;
                                param.wstLongitude = wstLongitude;
                                wstConfirm('检测到您当前在'+currentCityName+'，要切换到'+currentCityName+'吗？', function(){
                                    setLocationSession(param);
                                });
                            }
                        }
                    });
                }
            }
        });  
    });
}

//解析定位错误信息
function wstGetPositionError(data) {
    wstMsg('定位失败');
}

//设置真实位置信息session
function setRealLocationSession(wstRealLatitude, wstRealLongitude) {
    var param = {};
    param.wstRealLatitude = wstRealLatitude;
    param.wstRealLongitude = wstRealLongitude;
    $.post(WST.U("WebApp/Index/setRealLocationSession"), param);
}

//设置跟位置信息有关的session
function setLocationSession(param, type) {
    $.post(WST.U("WebApp/Index/setLocationSession"), param, function(data){
        var json = WST.toJson(data);
        if (json.status == 1) {
            if( type == 1 ){//定位所在城市
                wstGetPosition();
            }else{
                location.href = WST.U('WebApp/Index/index');
            }
        }
    });
}

$(document).ready(function(){
    FastClick.attach(document.body);//启用FastClick禁用点击事件的300ms延迟
    echo.init();//图片懒加载

    if( WST.locationFrom == 'defaultCity' ){
        $.getScript( WST.gaodeurl );//异步加载高德地图文件
    }
    
    // 滚动到顶部
    $(window).scroll(function(){
        if( $(window).scrollTop() > 100 ){
            $('#toTop').fadeIn();
        }else{
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').on('click', function() {
       $(window).smoothScroll({position: 0});
    });
});