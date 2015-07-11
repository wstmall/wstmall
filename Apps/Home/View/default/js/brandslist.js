$(function() {
	getBrands();
});


function getBrands(){
	var areaId3 = $("#areaId").val();
	var brandName = $.trim($("#brandName").val());
	var deliveryStartMoney = $("#deliveryStartMoney").val();
	var deliveryMoney = $("#deliveryMoney").val();
	var shopAtive = $("#shopAtive").val();
	
	$.post(domainURL +"/index.php/Home/Brands/getBrands/" ,{"areaId3":areaId3,"brandName":brandName},function(data) {		
		var json = WST.toJson(data);
		var html = new Array();
		var cnt = 0;
		for(var i=0;i<json.length;i++){
			var brand = json[i];
			html.push('<a href="'+domainURL +'/index.php/Home/goods/getGoodsList/?brandId='+brand.brandId+'"><li onmouseover="brandsover(this)" onmouseout="brandout(this)" class="wst-brands" data="'+brand.brandId+'">');
				html.push('<div style="wst-brands-items">');
				html.push('<img data-original="'+domainURL +"/"+brand.brandIco+'" width="188" title="'+brand.brandName+'"/>');
				html.push('</div>');
			html.push('</li></a>');
			
		}
		
		if(html.length>0){
			html.push('<div class="wst-clear"></div>');
		}else{
			html.push('<div style="line-height:300px;text-align:center;font-size:18px;">没有查找到相关品牌</div>');
		}
		$(".wst-brands-box").html(html.join(""));
		$(".wst-brands-box img").lazyload({effect: "fadeIn",failurelimit : 1000,threshold: 200,placeholder:domainURL +'/Apps/Home/View/default/images/store_default_signlist.png'});
	});
	
}

function brandsover(obj){
	$(".wst-brands").css({"opacity":"0.5"});
	$(obj).css({"opacity":"1"});
}

function brandout(obj){
	$(".wst-brands").css({"opacity":"1"});
}
