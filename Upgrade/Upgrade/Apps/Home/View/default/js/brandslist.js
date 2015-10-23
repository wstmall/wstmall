var params_brands = {};
$(function() {
	getBrands();
});

var loading = false;
$(window).scroll(function () {
	if ($(document).height()-($(window).scrollTop() + $(window).height())<=300) {
		if(loading == false){
            loading = true;
            getBrands();
		}
	}
});
var hasPage = true;
var currPage = 1;
function getBrands(){
	if(!hasPage)return;
	var areaId3 = $("#areaId").val();
	var brandName = $.trim($("#brandName").val());

	$.post( Think.U('Home/Brands/getBrands') ,{"pcurr":currPage,"areaId3":areaId3,"brandName":brandName},function(data) {		
		var json = WST.toJson(data);
		var html = new Array();
		var cnt = 0;
		for(var i=0;i<json.root.length;i++){
			var brand = json.root[i];
			var url = Think.U('Home/goods/getGoodsList','brandId='+brand.brandId);
			html.push('<a href="'+url+'"><li onmouseover="brandsover(this)" onmouseout="brandout(this)" class="wst-brands" data="'+brand.brandId+'">');
				html.push('<div style="wst-brands-items">');
				html.push('<img data-original="'+domainURL +"/"+brand.brandIco+'" width="188" title="'+brand.brandName+'"/>');
				html.push('</div>');
			html.push('</li></a>');
			
		}
		hasPage = (currPage<json.totalPage);
        if(hasPage)currPage++;
        
		if(html.length>0){
			html.push('<div class="wst-clear"></div>');
		}else{
			html.push('<div style="line-height:300px;text-align:center;font-size:18px;">没有查找到相关品牌</div>');
		}
		$(".wst-brands-box").append(html.join(""));
		$(".wst-brands-box img").lazyload({effect: "fadeIn",failurelimit : 1000,threshold: 200,placeholder:currDefaultImg});
	
		loading = false;
	});
	
}

function changeAreaBrands(){
	hasPage = true;
	currPage = 1;
	$(".wst-brands-box").empty();
	getBrands();
}

function brandsover(obj){
	$(".wst-brands").css({"opacity":"0.5"});
	$(obj).css({"opacity":"1"});
}

function brandout(obj){
	$(".wst-brands").css({"opacity":"1"});
}
