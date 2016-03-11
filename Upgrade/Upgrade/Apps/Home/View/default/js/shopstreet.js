
$(function() {
	getDistrictsShops();
});

function getShopByCommunitys(obj,p){
	$(".wst-shop-address").removeClass("liselected");
	$(obj).addClass("liselected");
	var params = {};
	params.curr = p;
	params.communityId = $(obj).attr("data");
	params.shopName = $.trim($("#shopName").val());
	params.deliveryStartMoney = $("#deliveryStartMoney").val();
	params.deliveryMoney = $("#deliveryMoney").val();
	params.shopAtive = $("#shopAtive").val();
	params.searchType = $("#wst-search-type").val();
	if(params.searchType==2){
		params.keyWords = $.trim($("#keyword").val());
	}
	$.post(Think.U('Home/Shops/getShopByCommunitys') ,params,function(data) {		
		var json = WST.toJson(data);
		if(json.root){
			var gettpl = document.getElementById('tblist').innerHTML;
	       	laytpl(gettpl).render(json.root, function(html){
	       	    $('.wst-shop-list').html(html);
	       	});
	       	$('.lazyImg').lazyload({ effect: "fadeIn",failurelimit : 10,threshold: 200,placeholder:WST.DEFAULT_IMG});
	       	if(json.totalPage>1){
	       		laypage({
		        	 cont: 'wst-page-items', 
		        	 pages:json.totalPage, 
		        	 curr: json.currPage,
		        	 skin: '#e23e3d',
		        	 groups: 3,
		        	 jump: function(e, first){
		        		    if(!first){
		        		    	getShopByCommunitys(obj,e.curr);
		        		    }
		        	    } 
		        });
	       	}else{
	       		$('#wst-page-items').empty();
	       	}
		}
	});
}

function getDistrictsShops(){
	var params = {};
	params.areaId3 = $("#cityId").val();
	params.shopName = $.trim($("#shopName").val());
	params.deliveryStartMoney = $("#deliveryStartMoney").val();
	params.deliveryMoney = $("#deliveryMoney").val();
	params.shopAtive = $("#shopAtive").val();
	params.searchType = $("#wst-search-type").val();
	if(params.searchType==2){
		params.keyWords = $.trim($("#keyword").val());
	}
	$.post(Think.U('Home/Shops/getDistrictsShops') , params ,function(data) {		
		var json = WST.toJson(data);
		if(json.length){
			$('#spcnt').html(json.length);
			var gettpl = document.getElementById('tblist2').innerHTML;
	       	laytpl(gettpl).render(json, function(html){
	       	    $('.wst-shop-address-box').html(html);
	       	    if(html!=''){
	 			   $(".wst-shop-address").eq(0).click();
	 		    }
	       	});
		}else{
			$('#spcnt').html(0);
			$('.wst-shop-address-box').html('<div style="font-size:15px;text-align:center;padding-top:80%;">没有相关店铺信息</div>');
			$('#wst-page-items').empty();
			$('.wst-shop-list').empty();
		}
	});
	
}

