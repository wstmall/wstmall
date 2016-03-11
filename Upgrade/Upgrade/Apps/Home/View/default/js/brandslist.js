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
		if(json.root && json.root.length){
			var gettpl = document.getElementById('tblist2').innerHTML;
	       	laytpl(gettpl).render(json.root, function(html){
	       		hasPage = (currPage<json.totalPage);
	            if(hasPage)currPage++;
	    		html=html+'<div class="wst-clear"></div>';
	       	    $('.wst-brands-box').append(html);
	       	    $(".lazyBrandImg").lazyload({effect: "fadeIn",failurelimit : 1000,threshold: 200,placeholder:WST.DEFAULT_IMG});
	       	});
		}else{
			$('.wst-brands-box').append('<div style="line-height:300px;text-align:center;font-size:18px;">没有查找到相关品牌</div>');
		}
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
