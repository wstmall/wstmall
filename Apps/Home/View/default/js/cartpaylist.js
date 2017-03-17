

function toContinue(){
	location.href= WST.DOMAIN ;
}

//去结算
function goToPay(){
	var flag = true;
	var cflag = true;
	var chkId;
	var payGoodsNum = 0;
	if(WST.IS_LOGIN==0){
		loginWin();
		return;
	}
	$("input[id^='buy-num_']").each(function(){
		chkId = $(this).attr('id').replace('buy-num_','chk_goods_');
		if($("#"+chkId).prop('checked'))payGoodsNum++;
		if($(this).val()<1 && $("#"+chkId).prop('checked')){
			$(this).css({"border":"2px solid red"});
			layer.tips("购买数量不能小于1","#"+$(this).attr("id"));
			if(cflag){
				cflag = false;
			}
				
		}
	});
	if(payGoodsNum==0){
		WST.msg('请选择要结算的商品!',{icon:5,offset: '200px'});
		return;
	}
	if(!cflag){
		return false;
	}
	jQuery.post( Think.U('Home/Cart/checkCartGoodsStock') ,{},function(data) {
		var goodsInfo = WST.toJson(data);		
		for(var i=0;i<goodsInfo.length;i++){
			var goods = goodsInfo[i];
			if(goods.cnt<1 && $('#chk_goods_'+goods.goodsId+"_"+goods.goodsAttrId).prop('checked')){
				cflag = false;
				$("#buy-num_"+goods.goodsId+"_"+goods.goodsAttrId).css({"border":"2px solid red"});
				layer.tips("购买数量不能小于1","#buy-num_"+goods.goodsId+"_"+goods.goodsAttrId);
			}
			if(goods.stockStatus<1 && $('#chk_goods_'+goods.goodsId+"_"+goods.goodsAttrId).prop('checked')){
				flag = false;
				$("#selgoods_"+goods.goodsId+"_"+goods.goodsAttrId).css({"border":"2px solid red"});				
				if(goods.goodsStock>0){
					$("#stock_"+goods.goodsId+"_"+goods.goodsAttrId).html("<span style='color:red;'>仅剩最后"+goods.goodsStock+"份</span>");
				}else{
					$("#stock_"+goods.goodsId+"_"+goods.goodsAttrId).html("<span style='color:red;'>无货</span>");
				}				
			}else{
				$("#stock_"+goods.goodsId+"_"+goods.goodsAttrId).html("有货");
			}
		}
		if(!cflag){
			return false;
		}
		if(flag){
			location.href = Think.U('Home/Orders/checkOrderInfo','rnd='+new Date().getTime());
		}else{
			$("#showwarnmsg").show();
		}
	});
	
	
}

//删除购物车中的商品
function delCatGoods(shopId,goodsId,priceAttrId){
	layer.confirm('您确定要从购物车中删除该商品吗？',{icon: 3, title:'系统提示',offset: '150px'}, function(tips){
		var ll = layer.load('数据处理中，请稍候...');
		var num = parseInt($("#buy-num_"+goodsId+"_"+priceAttrId).val(),10);	
		var totalMoney = parseFloat($("#wst_cart_totalmoney").html(),10);
		var shop_totalMoney = parseFloat($("#shop_totalMoney_"+shopId).html(),10);
		var price = parseFloat($("#price_"+goodsId+"_"+priceAttrId).val(),10);
		var ischk = $("#chk_goods_"+goodsId+"_"+priceAttrId).prop('checked');
		jQuery.post(Think.U('Home/Cart/delCartGoods') ,{goodsId:goodsId,goodsAttrId:priceAttrId},function(data) {
			layer.close(ll);
	    	layer.close(tips);
			var vd = WST.toJson(data);
			$("#selgoods_"+goodsId+"_"+priceAttrId).remove();
			if($("input[name='chk_goods_"+shopId+"']").length==0){
				$("#wst_cart_shop_"+shopId).remove();
			}
			if(ischk){
			    $("#shop_totalMoney_"+shopId).html(parseFloat((shop_totalMoney-price*num),10).toFixed(2));
			    $("#wst_cart_totalmoney").html(parseFloat((totalMoney-price*num),10).toFixed(2));
			}
			if($("div[id^='wst_cart_shop_']").length==0){
				$("#wst_cartlist_pbox").html("<div style='height:80px;line-height:80px;font-size:20px;text-align:center;'>您的购物车空空如也，赶快开始购物吧！</div><br/>");
				$('.wst-btn-checkout').hide();
			}
		});	
	});
}


//删除购物车中的商品
function delPckCatGoods(shopId,packageId,batchNo){
	layer.confirm('您确定要从购物车中删除该商品吗？',{icon: 3, title:'系统提示',offset: '150px'}, function(tips){
		var ll = layer.load('数据处理中，请稍候...');
		var num = parseInt($("#buy-num_"+packageId+"_"+batchNo).val(),10);	
		var totalMoney = parseFloat($("#wst_cart_totalmoney").html(),10);
		var shop_totalMoney = parseFloat($("#shop_totalMoney_"+shopId).html(),10);
		var price = parseFloat($("#price_"+packageId+"_"+batchNo).val(),10);
		var ischk = $("#chk_goods_"+packageId+"_"+batchNo).prop('checked');
		jQuery.post(Think.U('Home/Cart/delPckCatGoods') ,{shopId:shopId,packageId:packageId,batchNo:batchNo},function(data) {
			layer.close(ll);
	    	layer.close(tips);
			var vd = WST.toJson(data);
			$("#selgoods_"+packageId+"_"+batchNo).remove();
			if($("input[name='chk_goods_"+shopId+"']").length==0){
				$("#wst_cart_shop_"+shopId).remove();
			}
			if(ischk){
			    $("#shop_totalMoney_"+shopId).html(parseFloat((shop_totalMoney-price*num),10).toFixed(2));
			    $("#wst_cart_totalmoney").html(parseFloat((totalMoney-price*num),10).toFixed(2));
			}
			if($("div[id^='wst_cart_shop_']").length==0){
				$("#wst_cartlist_pbox").html("<div style='height:80px;line-height:80px;font-size:20px;text-align:center;'>您的购物车空空如也，赶快开始购物吧！</div><br/>");
				$('.wst-btn-checkout').hide();
			}
		});	
	});
}

function getShopCoupons(shopId){
	var obj = $("#coupon_box_"+shopId);
	if(obj.is(":hidden")){
		obj.show();
		$("#cart_coupon_"+shopId).html("<div class='coupon-loading'><img src='"+WST.ROOT+"/Apps/Home/View/"+WST.WST_STYLE+"/images/loading.gif'/>正在加载数据</div>");
		jQuery.post(Think.U('Home/Coupons/getShopCoupons') ,{shopId:shopId},function(data) {
			var json = WST.toJson(data);
			var html = [];
			for(var i=0;i<json.length;i++){
				
				html.push('<li class="coupon">');
					html.push('<div class="coupon-amount"><span class="rmb">¥</span>'+json[i]['couponMoney']+'</div>');
					html.push('<div class="coupon-detail">');
						html.push('<div class="coupon-info">');
							html.push('<p class="coupon-title">满'+json[i]['spendMoney']+'减'+json[i]['couponMoney']+'</p>');
							html.push('<p class="coupon-time">'+json[i]['validStartTime']+'至'+json[i]['validEndTime']+'</p>');
							html.push('</div>');
							html.push('<div class="coupon-op">');
							if(json[i]['id']>0){
								html.push('<button class="coupon-received">领取成功</button>');
							}else{
								html.push('<button class="coupon-unreceived" onclick="receiveCoupon(this,'+json[i]['couponId']+')">领取</button>');
							}
						html.push('</div>');
					html.push('</div>');
				html.push('</li>');
			}
			$("#cart_coupon_"+shopId).html(html.join(""))
		});	
	}else{
		obj.hide();
	}
}

function receiveCoupon(obj,couponId){
	$(obj).attr("disabled",true);
	$.post(Think.U('Home/Coupons/receiveCoupon'),{"id":couponId},function(data,textStatus){
	    var json = WST.toJson(data);
	    var result = 0;
	    if(json.status=='1'){
	    	$(obj).removeClass("coupon-unreceived").addClass("coupon-received").html("领取成功");
	    	$(obj).removeAttr("onclick");
	    }else{
	    	$(obj).attr("disabled",false);
	    	WST.msg('领取失败!',{icon:5,offset: '200px'});
	    }
	});
}

function closeCoupon(shopId){
	 $("#coupon_box_"+shopId).hide();
}

jQuery(function(){
	jQuery(".goodsStockFlag").each(function(){		
		if($(this).val()==-1){
			$("#showwarnmsg").show();
			return;
		}
	});

	
	
});
