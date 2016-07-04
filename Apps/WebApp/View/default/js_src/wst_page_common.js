//设置所在城市
function setCity(areaId, areaName){
    $('#loadingTips').html('正在切换城市......');
    $('#wst-default-loading').modal();
    AMap.service('AMap.Geocoder',function(){
        geocoder = new AMap.Geocoder({});
        geocoder.getLocation(areaName, function(status, result) {
            if (status === 'complete' && result.info === 'OK') {//状态正常，得到该城市的经纬度信息
                var param = {};
                param.areaId2 = areaId;
                param.areaName2 = areaName;
                param.wstLatitude = result.geocodes[0].location.lat;//纬度
                param.wstLongitude = result.geocodes[0].location.lng;//经度
                $.post(WST.U('WebApp/Index/setLocationSession'), param, function(data){
                    $('#wst-default-loading').modal('close');
                    $('#loadingTips').html('Loading...');
        			var json = WST.toJson(data);
                    if(json.status == 1){
                        location.href = WST.U('WebApp/Index/index');
                    }else{
                        wstMsg('切换失败，请重试');
                        setTimeout(function(){
                            location.href = WST.U('WebApp/Index/index');
                        }, 2000);
                    }
                });
            }else{//状态异常
                $('#wst-default-loading').modal('close');
                $('#loadingTips').html('Loading...');
                wstMsg('切换失败，请重试');
                setTimeout(function(){
                    location.href = WST.U('WebApp/Index/index');
                }, 2000);
            }
        });   
    });
}

//加载城市列表页
function getCitys(){
    $('#wst-default-loading').modal();
    $.post(WST.U('WebApp/Index/getCitys'), {}, function(data){
        var json = WST.toJson(data);
        var template = Handlebars.compile( $('#citys').text() );
        var citys = {'citys':json};
        var html = template(citys);
        $('#wst-page2').html(html);
        $('#wst-default-loading').modal('close');
        $('body').addClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-page1').hide();
        	$('#wst-page2').removeClass('wst-page2');
        	$(document).scrollTop(0);
        }, 300);
        json = citys = html = null;
        $.getScript(WST.gaodeurl, function(){//动态加载高德地图的js文件
            wstGetPosition();
        });
    });
}

$(document).ready(function(){
    var actionName = '';
    window.location.hash = actionName;
    $(window).on('hashchange', function(e) {
        changePage();
    });
});