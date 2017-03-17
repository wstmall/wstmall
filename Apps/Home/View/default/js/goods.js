function getCommunitys(obj){
	var vid = $(obj).attr("id");
	
	$("#scommunitys").find("li").removeClass("searched");
	$(obj).addClass("searched");
	var params = {};
	params.areaId = vid;
	var html = [];
	$.post(Think.U('Home/Communitys/queryByList'),params,function(data,textStatus){
	    html.push('<li class="searched">全部</li>');
		var json = WST.toJson(data);
		if(json.status=='1' && json.list.length>0){
			var opts = null;
			for(var i=0;i<json.list.length;i++){
				opts = json.list[i];
				html.push("<li id="+opts.communityId+">"+opts.communityName+"</li>")
				
			}
		}
		$('#psareas').html(html.join(''));
   });
	
}

function tohide(obj,id){
		
	if($("#"+id).height()<=28){
		$("#"+id).height('auto');
		$("#"+id).css("overflow","");
		$("#bs").val(1)
		$("#"+id+"-tp").html("&nbsp;隐藏&nbsp;");
	}else{
		$("#"+id).height(28);
		$("#"+id).css("overflow","hidden");
		$("#bs").val(0)
		$("#"+id+"-tp").html("&nbsp;显示&nbsp;");
	}
}

function queryGoods(obj,mark){
	var params = [];
	var communityId,brandId,prices,areaId3,c1Id,c2Id,c3Id,msort,isDistribut;
	keyWords = $.trim($("#keyword").val());
	c1Id = $("#c1Id").val();
	c2Id = $("#c2Id").val();
	c3Id = $("#c3Id").val();
	isDistribut = $("#isDistribut").val();
	msort = 1;
	if(mark==1){
		areaId3 = $(obj).attr("data")?$(obj).attr("data"):'';
		communityId = $("#wst-communitys").find(".searched").attr("data");
		brandId = $("#wst-brand").find(".searched").attr("data");
		prices = $("#wst-price").find(".searched").attr("data");
	}else if(mark==2){
		areaId3 = $("#wst-areas").find(".searched").attr("data");
		brandId = $("#wst-brand").find(".searched").attr("data");
		prices = $("#wst-price").find(".searched").attr("data");
		communityId = $(obj).attr("data");
	}else if(mark==3){
		areaId3 = $("#wst-areas").find(".searched").attr("data");
		communityId = $("#wst-communitys").find(".searched").attr("data");
		brandId = $(obj).attr("data");
		prices = $("#wst-price").find(".searched").attr("data");
	}else if(mark==4){
		areaId3 = $("#wst-areas").find(".searched").attr("data");
		communityId = $("#wst-communitys").find(".searched").attr("data");
		brandId = $("#wst-brand").find(".searched").attr("data");
		prices = $(obj).attr("data");	
	}else{
		areaId3 = $("#wst-areas").find(".searched").attr("data");
		communityId = $("#wst-communitys").find(".searched").attr("data");
		brandId = $("#wst-brand").find(".searched").attr("data");
		if(mark==12){
			prices = $("#sprice").val()+"_"+$("#eprice").val();
		}else{
			prices = $("#wst-price").find(".searched").attr("data");
		}
		msort = $('#msort').val();
		params.push("msort="+((msort=='0')?1:0));
		params.push("mark="+mark);
	}
	if(keyWords!="")params.push("keyWords="+keyWords);
	if(c1Id && c1Id!='0')params.push("c1Id="+c1Id);
	if(c2Id && c2Id!='0')params.push("c2Id="+$("#c2Id").val());
	if(c3Id && c3Id!='0')params.push("c3Id="+$("#c3Id").val());
	if(areaId3 && areaId3!='0')params.push("areaId3="+areaId3);
	if(isDistribut && isDistribut!='0')params.push("isDistribut="+isDistribut);
	if(communityId && communityId!='0')params.push("communityId="+communityId);
	if(brandId && brandId!='0')params.push("brandId="+brandId);
	if(prices)params.push("prices="+prices);
	window.location = Think.U('Home/Goods/getGoodsList',params.join('&'));
}

/**
 * 加入购物车
 */
function addCart(goodsId,type,goodsThums){
	if(WST.IS_LOGIN==0){
		loginWin();
		return;
	}
	var params = {};
	params.goodsId = goodsId;
	params.gcount = parseInt($("#buy-num").val(),10);
	params.rnd = Math.random();
	params.goodsAttrId = $('#shopGoodsPrice_'+goodsId).attr('dataId');
	$("#flyItem img").attr("src",WST.DOMAIN  +"/"+ goodsThums)
	jQuery.post(Think.U('Home/Cart/addToCartAjax') ,params,function(data) {
		var json = WST.toJson(data);
		if(json.status==1){
			if(type==1){
				location.href= Think.U('Home/Cart/toCart');
			}
		}else{
			WST.msg(json.msg,{offset: '200px'});
		}
	});
}
//修改商品购买数量
function changebuynum(flag){
	var num = parseInt($("#buy-num").val(),10);
	var num = num?num:1;
	if(flag==1){
		if(num>1)num = num-1;
	}else if(flag==2){
		num = num+1;
	}
	var maxVal = parseInt($("#buy-num").attr('maxVal'),10);
	if(maxVal<=num)num=maxVal;
	$("#buy-num").val(num);
}

//获取属性价格
function getPriceAttrInfo(id){
	var goodsId = $("#goodsId").val();
	jQuery.post( Think.U('Home/Goods/getPriceAttrInfo') ,{goodsId:goodsId,id:id},function(data) {
		var json = WST.toJson(data);
		if(json.id){
			if(json.attrStock>0){
				WST.showHide(1,'#haveGoodsToBuy,#buyBtn');
				WST.showHide(0,'#noGoodsToBuy');
			}else{
				WST.showHide(0,'#haveGoodsToBuy,#buyBtn');
				WST.showHide(1,'#noGoodsToBuy');
			}
			$('#shopGoodsPrice_'+goodsId).html("￥"+json.attrPrice);
			var buyNum = parseInt($("#buy-num").val());
			$("#buy-num").attr('maxVal',json.attrStock);
			$("#goodsStock").html(json.attrStock);
			if(buyNum<=0)$("#buy-num").val(1);
			if(buyNum>json.attrStock){
				$("#buy-num").val(json.attrStock);
			}
			$('#shopGoodsPrice_'+goodsId).attr('dataId',id);
		}
	});
}
function checkStock(obj){
	$(obj).addClass('wst-goods-attrs-on').siblings().removeClass('wst-goods-attrs-on');
	getPriceAttrInfo($(obj).attr('dataId'));
}

function getGoodsappraises(goodsId,p){
	var params = {}; 
	params.goodsId = goodsId;
	params.p = p;
	//加载商品评价
	jQuery.post(Think.U("Home/GoodsAppraises/getGoodsappraises") ,params,function(data) {
		var json = WST.toJson(data);
		if(json.root && json.root.length){
			var html = new Array();		    	
			for(var j=0;j<json.root.length;j++){
			    var appraises = json.root[j];	
			    html.push('<tr height="75" style="border-bottom:1px dotted #eeeeee;">');
				    html.push('<td width="150" style="padding-left:6px;"><div>'+(appraises.userName?appraises.userName:"匿名")+'</div></td>');
				    html.push('<td style="padding-bottom:10px;" width="*"><div style="padding:10px 0px;">'+appraises.content+'</div>');

				    //显示图片
				    if(appraises.appraisesAnnex)
				    {
				    	html.push('<div id="layer-photos-appraise'+j+'" class="layer-photos-appraise">');
				    	var img = appraises.appraisesAnnex.split(',');
				    	for(var i=0;i<img.length;i++)
				    	{
				    		html.push('<img onmouseover="appraiseImg()" layer-src="'+WST.DOMAIN+'/'+img[i]+'" src="'+WST.DOMAIN+'/'+img[i]+'" alt="'+appraises.content+'">');
				    	}
				    	html.push('</div>');
				    }	

				    html.push('</td>')



				    html.push('<td width="180">');
				    html.push('<div>商品评分：');
					for(var i=0;i<appraises.goodsScore;i++){
						html.push('<img src="'+WST.DOMAIN +'/Apps/Home/View/'+WST.WST_STYLE+'/images/icon_score_yes.png"/>');
					}
					html.push('</div>');
					html.push('<div>时效评分：');
					for(var i=0;i<appraises.timeScore;i++){
						html.push('<img src="'+WST.DOMAIN +'/Apps/Home/View/'+WST.WST_STYLE+'/images/icon_score_yes.png"/>');
					}
					html.push('</div>');
					html.push('<div>服务评分：');
					for(var i=0;i<appraises.serviceScore;i++){
						html.push('<img src="'+WST.DOMAIN +'/Apps/Home/View/'+WST.WST_STYLE+'/images/icon_score_yes.png"/>');
					}
					html.push('</div>');
					html.push('</td>');
					
			    html.push('</tr>');	
			}
			$("#appraiseTab").html(html.join(""));

			for(var j=0;j<json.root.length;j++){
				//调用layer相册
				layer.ready(function(){ //为了layer.ext.js加载完毕再执行
					layer.photos({
					photos: '#layer-photos-appraise'+j
					});
				}); 
			}



			if(json.totalPage>1){
				laypage({
				    cont: 'wst-page-items',
				    pages: json.totalPage,
				    curr: json.currPage,
				    skip: true,
				    skin: '#e23e3d',
				    groups: 3,
				    jump: function(e, first){
				        if(!first){
				        	getGoodsappraises(goodsId,e.curr);
				        }
				    }
				});
			}
		}else{
			$("#appraiseTab").html("<tr><td><div style='font-size:15px;text-align:center;line-height:45px;'>没有评价信息</div></td></tr>");
		}	
	});
}

function favoriteGoods(id){
	if($('#f0_txt').attr('f')=='0'){
		jQuery.post(Think.U("Home/Favorites/favoriteGoods") ,{id:id},function(data) {
			var json = WST.toJson(data,1);
			if(json.status==1){
				$('#f0_txt').html('已关注');
				$('#f0_txt').attr('f',json.id);
			}else if(json.status==-999){
				WST.msg('关注失败，请先登录!',{offset: '200px'});
			}else{
				WST.msg('关注失败!',{offset: '200px'});
			}
		});
	}else{
		id = $('#f0_txt').attr('f');
		cancelFavorites(id,0);
	}
}
function favoriteShops(id){
	if($('#f1_txt').attr('f')=='0'){
		jQuery.post(Think.U("Home/Favorites/favoriteShops") ,{id:id},function(data) {
			var json = WST.toJson(data,1);
			if(json.status==1){
				$('#f1_txt').html('已关注');
				$('#f1_txt').attr('f',json.id);
			}else if(json.status==-999){
				WST.msg('关注失败，请先登录!',{offset: '200px'});
			}else{
				WST.msg('关注失败!',{offset: '200px'});
			}
		});
	}else{
		id = $('#f1_txt').attr('f');
		cancelFavorites(id,1);
	}
}
function cancelFavorites(id,type){
	jQuery.post(Think.U("Home/Favorites/cancelFavorite") ,{id:id,type:type},function(data) {
		var json = WST.toJson(data,1);
		if(json.status==1){
			$('#f'+type+'_txt').html('关注'+((type==1)?'店铺':'商品'));
			$('#f'+type+'_txt').attr('f',0);
		}else{
			WST.msg('取消关注失败!',{offset: '100px'});
		}
	});
}


var layerll = 0;
function addPackages(packageId){
	var wh = ($(window).height() - 245);
	$("#wst-package-"+packageId).height(wh-200);
	layerll = layer.open({
	    type: 1,
	    title: '优惠套餐',
	    shadeClose: true,
	    shade: 0.4,
	    area: ['1000px', ($(window).height() - 350) +'px'],
	    content: $("#wst-package-"+packageId),
	    yes: function(index, layero){
	    	layer.close(index);
	    }
	});
}

function checkAttrStock(obj,goodsId,hasAttr,packageId){
	if(hasAttr==1){
		$(obj).addClass('wst-goods-attrs-on').siblings().removeClass('wst-goods-attrs-on');
	}else{
		$(obj).addClass('wst-pattr-box-on').removeClass('wst-pattr-box');
	}
	var attrStock = $(obj).attr("attrStock");
	$(".wst-pstock-"+goodsId).html(attrStock);
	if(attrStock<=0){
		$("#wst-goods-notice-"+goodsId).html("商品库存不足");
		$("#wst-goods-notice-"+goodsId).show();
	}else{
		$("#wst-goods-notice-"+goodsId).hide();
	}
	var packagePrice = 0;
	var flag = 1;
	$("#wst-package-"+packageId+" div[class^=wst-pattr-box]").each(function(){
		var hasAttr = $(this).attr("hasAttr");
		if(hasAttr==0){
			if($(this).hasClass("wst-pattr-box-on")){
				packagePrice += parseFloat($(this).attr("attrPrice"),10);
			}else{
				flag = 0;
			}
		}else{
			var gattr = $(this).find(".wst-goods-attrs-on");
			if(gattr.length>0){
				packagePrice += parseFloat(gattr.attr("attrPrice"),10);
			}else{
				flag = 0;
			}
		}
	});
	if(flag==1){
		$(".wst-package-price-"+packageId).html(packagePrice);
	}else{
		$(".wst-package-price-"+packageId).html($("#wst-package-price-"+packageId).attr("allPrice"));
	}
}

function addCartPackage(obj,packageId,goodsThums){
	$(obj).attr("disabled",true);
	var flag = 1;
	var gflag = 1;
	var goodsAttrIds = [];
	$("#wst-package-"+packageId+" div[class^=wst-pattr-box]").each(function(){
		var goodsId = $(this).attr("goodsId");
		var attrId = 0;
		var hasAttr = $(this).attr("hasAttr");
		
		var attrStock = $(this).attr("attrStock");
		$("#wst-package-"+packageId+" .wst-pstock-"+goodsId).html(attrStock);
		if(attrStock<=0){
			$("#wst-package-"+packageId+" .wst-goods-notice-"+goodsId).html("商品库存不足").show();
			gflag = 0;
		}else{
			$("#wst-package-"+packageId+" .wst-goods-notice-"+goodsId).hide();
		}
		
		if(hasAttr==0){
			if($(this).hasClass("wst-pattr-box-on")){
				attrId = $(this).attr("attrId");
				$("#wst-package-"+packageId+" .wst-goods-notice-"+goodsId).hide();
			}else{
				
				$("#wst-package-"+packageId+" .wst-goods-notice-"+goodsId).html("请选择商品").show();
				flag = 0;
			}
		}else{
			var gattr = $(this).find(".wst-goods-attrs-on");
			if(gattr.length>0){
				attrId = gattr.attr("attrId");
				$("#wst-package-"+packageId+" .wst-goods-notice-"+goodsId).hide();
			}else{
				$("#wst-package-"+packageId+" .wst-goods-notice-"+goodsId).html("请选择商品").show();
				flag = 0;
			}
		}
		goodsAttrIds.push(goodsId+"_"+attrId+"_"+1);
	});
	
	if(flag==0){
		$("#wst-package-"+packageId+" .wst-package-notice").show();
	}else{
		$("#wst-package-"+packageId+" .wst-package-notice").hide();
	}
	if(flag==0 || gflag==0){
		$(obj).attr("disabled",false);
		return;
	}
	
	var params = {};
		params.goodsAttrIds = goodsAttrIds.join("@");
		params.packageId = packageId;
	$("#flyItem img").attr("src",WST.DOMAIN  +"/"+ goodsThums)
	jQuery.post(Think.U('Home/Cart/addCartPackage') ,params,function(data) {
		var json = WST.toJson(data);
		$(obj).attr("disabled",false);
		if(json.status==1){
			layer.close(layerll);
			location.href= Think.U('Home/Cart/toCart');
		}else{
			WST.msg(json.msg,{offset: '200px'});
		}
	});
}

function receiveCoupon(couponId){
	location.href = Think.U('Home/Coupons/toReceiveCoupon',{"couponId":couponId});
}

//倒计时
function goods_time(){  
    var dataId = $("#times").attr("dataId");
	var time = $("#times").val();// 设定结束时间
	WST.countDown(time, dataId,1,0);
};