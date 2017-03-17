//倒计时
function list_time(){        
	$(".times").each(function(){
		var dataId = $(this).attr("dataId");
		var time = $(this).attr("times");// 设定结束时间
		WST.countDown(time, dataId,0,2);
	});
};

var currpage = 1;
function getGoodsList(catId1,catId2){
	
	var ll = layer.load('数据加载中，请稍候...');
	$.post(Think.U('Home/Groups/getGroupGoodsByPage'),{"catId1":catId1,"catId2":catId2,"pcurr":currpage},function(data,textStatus){
		var json = WST.toJson(data);
		layer.close(ll);
		$("#wst-goods-list div").remove();
		var tmpMsg = '';
		if(json.root.length>0){
			
			for(var i=0;i<json.root.length;i++){
				var goods = json.root[i];
				var html = new Array();
				html.push('<div class="goods">');
					html.push('<div class="top">');
						html.push('<div class="img"><a href="'+Think.U('Home/Groups/getGoodsDetails',{'id':goods.id})+'"><img data-original="'+WST.ROOT+'/'+goods.goodsThums+'" class="glazyImg" title="'+goods.goodsName+'"/></a></div>');
						html.push('<p class="name">'+goods.goodsName+'</p>');
						html.push('<div class="time times" dataId="'+goods.id+'" times="'+goods.endTime+'"><i></i>团购中 剩余:');
							html.push('<b class="time_'+goods.id+'">00天00小时00分00秒</b>');
						html.push('</div>');
						html.push('<div class="wst-clear"></div>');
					html.push('</div>');
					html.push('<div class="bottom">');
						html.push('<span class="price">￥'+goods.groupMoney+'</span><span class="price2">￥'+goods.shopPrice+'</span>');
						if(goods.goodsStock>0){
							html.push('<a href="'+Think.U('Home/Groups/checkGroup',{'id':goods.id})+'" class="tobuy"></a>');
						}else{
							html.push('<a href="javascript:;" class="saleover"></a>');
						}
						
					html.push('</div>');
				html.push('</div>');
				$("#wst-goods-list").append(html.join(""));
			}
			$("#wst-goods-list").append('<div class="wst-clear"></div>');
			
			$('.glazyImg').lazyload({ effect: "fadeIn",failurelimit : 10,skip_invisible : false,threshold: 200,placeholder:WST.ROOT+'/'+WST.GOODS_LOGO});
		}
		if(json.totalPage>1){
			laypage({
				cont: "wst-page", 
				pages: json.totalPage, 
				curr: json.currPage,
				skin: '#e23e3d',
				groups: 3,
				jump: function(e, first){
					if(!first){
				       	currpage = e.curr;
				       	getGoodsList(catId1,catId2);
					}   
				} 
			});
		}else{
			$('#wst-page div').remove();
		}
		
	});
}

$(function(){
	getGoodsList(0,0);
	$("#wst-te-cat span").click(function(){
		$("#wst-te-cat span").removeClass("selected");
		$(this).addClass("selected");
		var catId1 = $(this).attr("data");
		$(".wst-te-cat2").hide();
		$(".wst-te-cat2 .cats span").removeClass("selected");
		$("#wst-te-cat2_"+catId1).show();
		$("#wst-te-cat2_"+catId1+" .cats span").eq(0).addClass("selected");
		currpage = 1;
		getGoodsList(catId1,0);
	});
	
	$(".wst-te-cat2 .cats span").click(function(){
		$(".wst-te-cat2 .cats span").removeClass("selected");
		$(this).addClass("selected");
		var catId1 = $("#wst-te-cat span.selected").attr("data");
		var catId2 = $(this).attr("data");
		currpage = 1;
		getGoodsList(catId1,catId2);
	});
	
});