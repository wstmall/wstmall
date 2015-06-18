


//修改购物车中的商品数量
function changeCatGoodsnum(flag,goodsId,isBook){
	isBook = 0;
	var num = parseInt($("#buy-num_"+goodsId).val(),10);
	var num = num?num:1;
	var totalMoney = 0;	
	if(flag==1){
		if(num>1)num = num-1;		
	}else if(flag==2){
		num = num+1;
	}
	
	jQuery.post(rooturl+"/index.php/Home/Goods/getGoodsStock" ,{goodsId:goodsId,isBook:isBook},function(data) {		
		var json = WST.toJson(data);
		if(json.goodsStock==0){
			$("#stock_"+goods.goodsId).html("<span style='color:red;'>无货</span>");
		}
		if(json.goodsStock>=num){
			num = num>100?100:num;	
			$("#stock_"+json.goodsId).html("有货");
			//$("#showwarnmsg").hide();
			$("#selgoods_"+json.goodsId).css({"border":"0"});	
		}else{
			num = json.goodsStock;	
			$("#stock_"+json.goodsId).html("<span style='color:red;'>仅剩最后"+json.goodsStock+"份</span>");
			//$("#showwarnmsg").hide();
			$("#selgoods_"+json.goodsId).css({"border":"0"});
		}
		jQuery.post(rooturl+"/index.php/Home/Cart/changeCartGoodsNum" ,{goodsId:goodsId,num:num},function(rsp) {		
			if(rsp){
				$("#buy-num_"+goodsId).val(num);
				var price = parseFloat($("#price_"+goodsId).val(),10);
				$("#prc_"+goodsId).html((num*price).toFixed(1));
				$(".cgoodsId").each(function(){
					var gid = $(this).val();
					var price = parseFloat($("#price_"+gid).val(),10);
					var cnt = parseInt($("#buy-num_"+gid).val(),10);
					totalMoney += price*cnt;
				});			
				$("#totalMoney").html(totalMoney.toFixed(1));
			}
		});
	});
	
}

function toContinue(){
	location.href= rooturl;
}

//去结算
function goToPay(){
	
	var flag = true;
	jQuery.post(rooturl+"/index.php/Home/Cart/checkCartGoodsStock/" ,{},function(data) {
		var goodsInfo = WST.toJson(data);		
		for(var i=0;i<goodsInfo.length;i++){
			var goods = goodsInfo[i];			
			if(goods.stockStatus<1){
				flag = false;
				$("#selgoods_"+goods.goodsId).css({"border":"2px solid red"});				
				if(goods.goodsStock>0){
					$("#stock_"+goods.goodsId).html("<span style='color:red;'>仅剩最后"+goods.goodsStock+"份</span>");
				}else{
					$("#stock_"+goods.goodsId).html("<span style='color:red;'>无货</span>");
				}				
			}else{
				$("#stock_"+goods.goodsId).html("有货");
			}
		}
		if(flag){
			location.href= rooturl+"/index.php/Home/Orders/checkOrderInfo/?rnd="+new Date().getTime();
		}else{
			$("#showwarnmsg").show();
		}
	});
	
	
}

//删除购物车中的商品
function delCatGoods(goodsId){
	if(confirm("确定删除该商品？")){
		var num = parseInt($("#buy-num_"+goodsId).val(),10);	
		var totalMoney = parseFloat($("#totalMoney").html(),10);
		var price = parseFloat($("#price_"+goodsId).val(),10);
		
		jQuery.post(rooturl+"/index.php/Home/Cart/delCartGoods" ,{goodsId:goodsId},function(data) {		
			var vd = WST.toJson(data);
			$("#selgoods_"+goodsId).remove();
			$("#totalMoney").html(parseFloat((totalMoney-price*num),10).toFixed(2));			
			if(!$("#catgoodsList").find("div").html()){
				$("#catgoodsList").html("<div style='height:50px;line-height:50px;text-align:center;'>购物车中没有商品</div>");
				$('.wst-btn-checkout').hide();
			}
		});	
	}
	
	
}

jQuery(function(){
	jQuery(".goodsStockFlag").each(function(){		
		if($(this).val()==-1){
			$("#showwarnmsg").show();
			return;
		}
	});
	
});
