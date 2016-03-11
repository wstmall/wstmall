 /** ***********************广告显示 start************************ */
$(function() {
	var slide = $('#wst-slide'), li = slide.find("li");

	var slidecontrols = $('.wst-slide-controls').eq(0), span = slidecontrols
			.find("span");
	var index = 1, _self = null;
	span.bind("mouseover", function() {
		_self = $(this);
		index = span.index(_self);
		span.removeClass("curr");
		span.eq(index).addClass("curr");
		li.addClass("hide");
		li.css("z-index", -1);
		li.css("display", "none");
		li.eq(index).css("display", "");
		li.eq(index).css("z-index", 1);
		li.eq(index).removeClass("hide");
		clearInterval(timer);
	});
	var timer = setInterval(function() {
		span.removeClass("curr");
		span.eq(index).addClass("curr");
		li.addClass("hide");
		li.css("z-index", -1);
		li.css("display", "none");
		li.eq(index).fadeToggle(500);
		li.eq(index).css("z-index", 1);
		li.eq(index).removeClass("hide");
		index++;
		if (index >= span.length)
			index = 0;
	}, 4000);
	span.bind("mouseout", function() {
		timer = setInterval(function() {
			span.removeClass("curr");
			span.eq(index).addClass("curr");
			li.addClass("hide");
			li.css("z-index", -1);
			li.css("display", "none");
			li.eq(index).fadeToggle(500);
			li.eq(index).css("z-index", 1);
			li.eq(index).removeClass("hide");
			index++;
			if (index >= span.length)
				index = 0;
		}, 4000);
	});
	
});

function gpanelOver(obj){
	var sid = $(obj).attr("id");
	var ids = sid.split("_");
	var preid = ids[0]+"_"+ids[1];
	
	$("li[id^="+preid+"_]").removeClass("selectli");
	$("#"+sid).addClass("selectli");
	
	$("div[id^="+preid+"_]").hide();
	$("#"+sid+"_pl").show();
	$("#"+sid+"_pl img").lazyload({effect: "fadeIn",failurelimit : 1000,threshold: 200,placeholder:WST.DEFAULT_IMG});
}


