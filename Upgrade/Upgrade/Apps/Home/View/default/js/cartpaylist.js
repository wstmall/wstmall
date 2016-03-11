


//修改购物车中的商品数量
function changeCatGoodsnum(flag,shopId,goodsId,priceAttrId,isBook){
	isBook = 0;
	var num = parseInt($("#buy-num_"+goodsId+"_"+priceAttrId).val(),10);
	if(num<0){
		num = Math.abs(num);
		$("#buy-num_"+goodsId+"_"+priceAttrId).val(num);
	}
	
	if(flag==1){
		if(num>1)num = num-1;		
	}else if(flag==2){
		num = num+1;
	}
	if(num<1){
		num = 1;
		$("#buy-num_"+goodsId+"_"+priceAttrId).val(1);
	}
	
	if($("#chk_goods_"+goodsId+"_"+priceAttrId).is(":checked")){
		checkCartPay(shopId,goodsId,num,1,isBook,priceAttrId);
	}else{
		checkCartPay(shopId,goodsId,num,0,isBook,priceAttrId);
	}
	
}


function checkCartPay(shopId,goodsId,num,ischk,isBook,goodsAttrId){
	jQuery.post( Think.U('Home/Goods/getGoodsStock') ,{goodsId:goodsId,isBook:isBook,goodsAttrId:goodsAttrId},function(data) {		
		var json = WST.toJson(data);
		if(json.goodsStock==0){
			$("#stock_"+json.goodsId).html("<span style='color:red;'>无货</span>");
		}
		num = parseInt(num,10);
		if(json.goodsStock>=num){
			num = num>100?100:num;	
			$("#stock_"+json.goodsId+"_"+goodsAttrId).html("有货");
			$("#selgoods_"+json.goodsId+"_"+goodsAttrId).css({"border":"0"});	
		}else{
			num = json.goodsStock;	
			$("#stock_"+json.goodsId+"_"+goodsAttrId).html("<span style='color:red;'>仅剩最后"+json.goodsStock+"份</span>");
			$("#selgoods_"+json.goodsId+"_"+goodsAttrId).css({"border":"0"});
		}
		jQuery.post( Think.U('Home/Cart/changeCartGoodsNum') ,{goodsId:goodsId,num:num,ischk:ischk,goodsAttrId:goodsAttrId},function(rsp) {		
			if(rsp){
				var totalMoney = 0;	
				$("#buy-num_"+goodsId+"_"+goodsAttrId).val(num);
				$("#buy-num_"+goodsId+"_"+goodsAttrId).css({"border":""});
				var price = parseFloat($("#price_"+goodsId+"_"+goodsAttrId).val(),10);
				$("#prc_"+goodsId+"_"+goodsAttrId).html((num*price).toFixed(2));
				//店铺下的商品
				var shopTotalMoney = 0;
				$("input[name='chk_goods_"+shopId+"']").each(function(){
					if($(this).is(":checked")){
						var goodsAttrId = $(this).attr('dataId');
						var gid = $(this).val();
						var gnum = $("#buy-num_"+gid+"_"+goodsAttrId).val();
						var gprice = parseFloat($("#price_"+gid+"_"+goodsAttrId).val(),10);
						shopTotalMoney += gnum*gprice;
					}
				});
				$("#shop_totalMoney_"+shopId).html(shopTotalMoney.toFixed(2));
				//所有商品
				$(".cgoodsId").each(function(){
					var goodsAttrId = $(this).attr('dataId');
					var gid = $(this).val();
					if($("#chk_goods_"+gid+"_"+goodsAttrId).is(":checked")){
						var price = parseFloat($("#price_"+gid+"_"+goodsAttrId).val(),10);
						var cnt = parseInt($("#buy-num_"+gid+"_"+goodsAttrId).val(),10);
						
						totalMoney += price*cnt;
					}
				});			
				
				$("#wst_cart_totalmoney").html(totalMoney.toFixed(2));
			}
		});
	});
}

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

jQuery(function(){
	jQuery(".goodsStockFlag").each(function(){		
		if($(this).val()==-1){
			$("#showwarnmsg").show();
			return;
		}
	});

	$("#chk_all").click(function(){
		if($(this).prop("checked")){
			$("input[id^='chk_shop_']").each(function(){
				$(this).prop("checked",true);
				var shopId = $(this).val();
				$("input[name='chk_goods_"+shopId+"']").each(function(){
					$(this).prop("checked",true);
					var shopId = $(this).attr("parent");
					var priceAttrId = $(this).attr("dataId");
					var goodsId = $(this).val();
					var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
					var isBook = $(this).attr("isBook");
					checkCartPay(shopId,goodsId,num,1,isBook,priceAttrId);
					
				});
			});
		}else{
			$("input[id^='chk_shop_']").each(function(){
				$(this).prop("checked",false);
				var shopId = $(this).val();
				$("input[name='chk_goods_"+shopId+"']").each(function(){
					$(this).prop("checked",false);
					var priceAttrId = $(this).attr("dataId");
					var shopId = $(this).attr("parent");
					var goodsId = $(this).val();
					var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
					var isBook = $(this).attr("isBook");
					checkCartPay(shopId,goodsId,num,0,isBook,priceAttrId);
				});
			});
		}
	});
	
	
	$("input[id^='chk_shop_']").click(function(){
		var shopId = $(this).val();
		var priceAttrId = $(this).attr("dataId");
		if($(this).prop("checked")){
			$("input[name='chk_goods_"+shopId+"']").each(function(){
				var priceAttrId = $(this).attr("dataId");
				$(this).prop("checked",true)
				var shopId = $(this).attr("parent");
				var goodsId = $(this).val();
				var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
				var isBook = $(this).attr("isBook");
				checkCartPay(shopId,goodsId,num,1,isBook,priceAttrId);
				
			});
		}else{
			$("input[name='chk_goods_"+shopId+"']").each(function(){
				var priceAttrId = $(this).attr("dataId");
				$(this).prop("checked",false);
				var shopId = $(this).attr("parent");
				var goodsId = $(this).val();
				var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
				var isBook = $(this).attr("isBook");
				checkCartPay(shopId,goodsId,num,0,isBook,priceAttrId);
			});
		}
	});
	
	$("input[id^='chk_goods_']").click(function(){
		var priceAttrId = $(this).attr("dataId");
		var shopId = $(this).attr("parent");
		var goodsId = $(this).val();
		var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
		var isBook = $(this).attr("isBook");
		if($(this).is(":checked")){
			checkCartPay(shopId,goodsId,num,1,isBook,priceAttrId);
		}else{
			checkCartPay(shopId,goodsId,num,0,isBook,priceAttrId);
		}
		
	});
	
});
