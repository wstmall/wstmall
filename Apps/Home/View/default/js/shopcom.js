var domainURL = '';
function checkAll(obj){
	$('.chk').each(function(){
		$(this)[0].checked = obj.checked;
	})
}
function getChks(){
	var ids = [];
	$('.chk').each(function(){
		if($(this)[0].checked)ids.push($(this).val());
	});
	return ids.join(',');
}
$.fn.TabPanel = function(options){
	var defaults = {    
		tab: 0      
	}; 
	var opts = $.extend(defaults, options);
	var t = this;
	$(t).find('.wst-tab-nav li').click(function(){
		$(this).addClass("on").siblings().removeClass();
		var index = $(this).index();
		$(t).find('.wst-tab-content .wst-tab-item').eq(index).show().siblings().hide();
		if(opts.callback)opts.callback(index);
	});
	$(t).find('.wst-tab-nav li').eq(opts.tab).click();
}
/****************************商品操作**************************/
function queryUnSaleByPage(){
	var shopCatId1 = $('#shopCatId1').val();
	var shopCatId2 = $('#shopCatId2').val();
	var goodsName = $('#goodsName').val();
	location.href=domainURL+'index.php/Home/Goods/queryUnSaleByPage/?umark=queryUnSaleByPage&goodsName='+goodsName+"&shopCatId1="+shopCatId1+"&shopCatId2="+shopCatId2; 
}
function queryOnSale(){
	var shopCatId1 = $('#shopCatId1').val();
	var shopCatId2 = $('#shopCatId2').val();
	var goodsName = $('#goodsName').val();
	location.href=domainURL+'index.php/Home/Goods/queryOnSaleByPage/?umark=queryOnSaleByPage&goodsName='+goodsName+"&shopCatId1="+shopCatId1+"&shopCatId2="+shopCatId2; 
}
function queryPendding(){
	var shopCatId1 = $('#shopCatId1').val();
	var shopCatId2 = $('#shopCatId2').val();
	var goodsName = $('#goodsName').val();
	location.href=domainURL+'index.php/Home/Goods/queryPenddingByPage/?umark=queryPenddingByPage&goodsName='+goodsName+"&shopCatId1="+shopCatId1+"&shopCatId2="+shopCatId2; 
}
function toEditGoods(id,menuId){
    location.href=domainURL+'index.php/Home/Goods/toEdit/?umark='+menuId+'&id='+id; 
}
function toViewGoods(id){
	$.post(domainURL+'index.php/Home/Goods/getGoodsVerify',{id:id},function(data,textStatus){
		var json = WST.toJson(data);
		if(json.status=='1'){
			var verifyCode = json.verifyCode;
			window.open(domainURL+'index.php/Home/Goods/getGoodsDetails/?goodsId='+id+"&kcode="+verifyCode);
		}
	});
	
}
function delGoods(id){
	layer.confirm("您确定要删改该商品？",function(){
		$.post(domainURL+'index.php/Home/Goods/del',{id:id},function(data,textStatus){
    		var json = WST.toJson(data);
    		if(json.status=='1'){
    			layer.msg('操作成功！', 1, 1,function(){
    				location.reload();
    			});
    		}else{
    			layer.msg('操作失败', 1, 8);
    		}
		});
	});
}
function batchDel(){
	layer.confirm("您确定要删改这些商品？",function(){
	      var ids = getChks();
	      layer.load('正在处理，请稍后...', 3);
	      var params = {};
	      params.ids = ids;
	      $.post(domainURL+"index.php/Home/Goods/batchDel",params,function(data,textStatus){
	    		var json = WST.toJson(data);
	    		if(json.status=='1'){
	    			layer.msg('操作成功！', 1, 1,function(){
	    				location.reload();
	    			});
	    		}else{
	    			layer.msg('操作失败', 1, 8);
	    		}
	     });
	});
}
function sale(v){
	var ids = getChks();
	if(ids==''){
		layer.msg('请先选择商品!', 1, 8);
		return;
	}
	layer.confirm((v==1)?"您确定要上架这些商品？":"您确定要下架这些商品？",function(){
	    layer.load('正在处理，请稍后...', 3);
	    var params = {};
	    params.ids = ids;
	    params.isSale= v;
	    $.post(domainURL+"index.php/Home/Goods/sale",params,function(data,textStatus){
	    	var json = WST.toJson(data);
	    	if(json.status=='1'){
	    		layer.msg('操作成功！', 1, 1,function(){
	    			location.reload();
	    		});
	    	}else{
	    		layer.msg('操作失败!', 1, 8);
	    	}
	    });
	});
}
function goodsSet(type,umark){
	var ids = getChks();
	if(ids==''){
		layer.msg('请先选择商品!', 1, 8);
		return;
	}

	layer.load('正在处理，请稍后...', 3);
	var params = {};
	params.ids = ids;
	params.code= type;
	$.post(domainURL+"index.php/Home/Goods/goodsSet",params,function(data,textStatus){
	    var json = WST.toJson(data);
	    if(json.status=='1'){
	    	layer.msg('操作成功！', 1, 1,function(){
	    		location.reload();
	    	});
	    }else{
	    	layer.msg('操作失败!', 1, 8);
	    }
	});
}

function getShopCatListForGoods(v,id){
	   var params = {};
	   params.id = v;
	   $('#shopCatId2').empty();
	   var html = [];
	   $.post(domainURL+"index.php/Home/ShopsCats/queryByList",params,function(data,textStatus){
		    html.push('<option value="">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.catId+'" '+((id==opts.catId)?'selected':'')+'>'+opts.catName+'</option>');
				}
			}
			$('#shopCatId2').html(html.join(''));
	   });
}
$.fn.imagePreview = function(options){
	var defaults = {}; 
	var opts = $.extend(defaults, options);
	var t = this;
	xOffset = 5;
	yOffset = 20;
	if(!$('#preview')[0])$("body").append("<div id='preview'><img width='200' src=''/></div>");
	$(this).hover(function(e){
		   $('#preview img').attr('src',domainURL+$(this).attr('img'));      
		   $("#preview").css("top",(e.pageY - xOffset) + "px").css("left",(e.pageX + yOffset) + "px").show();      
	  },
	  function(){
		$("#preview").hide();
	}); 
	$(this).mousemove(function(e){
		   $("#preview").css("top",(e.pageY - xOffset) + "px").css("left",(e.pageX + yOffset) + "px");
	});
}
function getShopCatListForEdit(v,id){
	   var params = {};
	   params.id = v;
	   $('#shopCatId2').empty();
	   var html = [];
	   $.post(domainURL+"index.php/Home/ShopsCats/queryByList",params,function(data,textStatus){
		    html.push('<option value="">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.catId+'" '+((id==opts.catId)?'selected':'')+'>'+opts.catName+'</option>');
				}
			}
			$('#shopCatId2').html(html.join(''));
	   });
}
function getBrands(catId){
	var v = $('#brandId').attr('dataVal');
	var params = {};
	params.catId = catId;
	$('#brandId').empty();
	var html = [];
	$('#brandId').append('<option value="0">请选择</option>');
	$.post(domainURL+"index.php/Home/Brands/queryBrandsByCat",params,function(data,textStatus){
		var json = WST.toJson(data);
		if(json.status=='1' && json.list){
			for(var i=0;i<json.list.length;i++){
				opts = json.list[i];
				$('#brandId').append('<option value="'+opts.brandId+'" '+((v==opts.brandId)?'selected':'')+'>'+opts.brandName+'</option>');
			}
		}
	})
}
function getCatListForEdit(objId,parentId,t,id){
	   var params = {};
	   params.id = parentId;
	   $('#'+objId).empty();
	   if(t<1){
		   $('#goodsCatId3').empty();
		   $('#goodsCatId3').html('<option value="">请选择</option>');
		   getBrands(parentId);
	   }
	   var html = [];
	   $.post(domainURL+"index.php/Home/GoodsCats/queryByList",params,function(data,textStatus){
		    html.push('<option value="">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.catId+'" '+((id==opts.catId)?'selected':'')+'>'+opts.catName+'</option>');
				}
			}
			$('#'+objId).html(html.join(''));
	   });
}
function editGoods(menuId){
	   var params = {};
	   params.id = $('#id').val();
	   params.goodsSn = $('#goodsSn').val();
	   params.goodsName = $('#goodsName').val();
	   params.goodsImg = $('#goodsImg').val();
	   params.goodsThumbs = $('#goodsThumbs').val();
	   params.marketPrice = $('#marketPrice').val();
	   params.shopPrice = $('#shopPrice').val();
	   params.goodsStock = $('#goodsStock').val();
	   params.brandId = $('#brandId').val();
	   params.goodsUnit = $('#goodsUnit').val();
	   params.goodsSpec = $('#goodsSpec').val();
	   params.goodsCatId1 = $('#goodsCatId1').val();
	   params.goodsCatId2 = $('#goodsCatId2').val();
	   params.goodsCatId3 = $('#goodsCatId3').val();
	   params.shopCatId1 = $('#shopCatId1').val();
	   params.shopCatId2 = $('#shopCatId2').val();
	   params.isSale = $('input[name="isSale"]:checked').val();
	   params.isNew = $('input[name="isNew"]:checked').val();;
	   params.isBest = $('input[name="isBest"]:checked').val();;
	   params.isHot = $('input[name="isHot"]:checked').val();;
	   params.isRecomm = $('input[name="isRecomm"]:checked').val();;
	   params.goodsDesc = $('#goodsDesc').val();
	   var gallery = [];
	   $('.gallery-img').each(function(){
		   gallery.push($(this).attr('v')+'@'+$(this).attr('iv'));
	   });
	   if(params.goodsDesc==''){
		   layer.msg('请输入商品描述!', 1, 8);
		   return;
	   }
	   if(params.goodsImg==''){
		   layer.msg('请上传商品图片!', 1, 8);
		   return;
	   }
	   params.gallery = gallery.join(',');
	   
	   $.post(domainURL+"index.php/Home/Goods/edit",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				   location.href=domainURL+'index.php/Home/Goods/'+menuId;
			}else{
				alert('操作失败!');
			}
	   });
}
/*****************************商品分类***********************************/
function editGoodsCat(){
	   var params = {};
	   params.id = $('#id').val();
	   params.parentId = $('#parentId').val();
	   params.catName = $('#catName').val();
	   params.isShow = $('input[name="isShow"]:checked').val();;
	   params.catSort = $('#catSort').val();
	   $.post(domainURL+"index.php/Home/ShopsCats/edit",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				   location.href=domainURL+'index.php/Home/ShopsCats/';
			}else{
				alert('操作失败!');
			}
	   });
}
function toEditGoodsCat(id,pid){
    location.href=domainURL+'index.php/Home/ShopsCats/toEdit/?id='+id+"&parentId="+pid; 
}
function delGoodsCat(id){
	layer.confirm("您确定要删除该商品分类吗？",function(){
		layer.load('正在处理，请稍后...', 3);
		$.post(domainURL+"index.php/Home/ShopsCats/del",{id:id},function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				layer.msg('操作成功!', 1,1, function(){
					location.reload();
				});
			}else{
				layer.msg('操作失败!', 1, 8);
			}
		});
	})
}
function editGoodsCatName(obj){
	var name = $('#');
	$.post(domainURL+"index.php/Home/ShopsCats/editName",{id:$(obj).attr('dataId'),catName:obj.value},function(data,textStatus){
		var json = WST.toJson(data);
		if(json.status=='1'){
			layer.msg('操作成功!', 1, 1);
		}else{
			layer.msg('操作失败!', 1, 8);
		}
	});
}
function loadGoodsCatChildTree(obj,pid,objId){
	    var showhtml = "<span class='wst-state_yes'></span>";
	    var hidehtml = "<span class='wst-state_no'></span>";
		var str = objId.split("_");
		level = (str.length-2);
		if($(obj).hasClass('wst-tree-open')){
			$(obj).removeClass('wst-tree-open').addClass('wst-tree-close');
			$('tr[class^="'+objId+'"]').hide();
		}else{
			$(obj).removeClass('wst-tree-close').addClass('wst-tree-open');
			$('tr[class^="'+objId+'"]').show();
		}
}
/*****************商品评价**************************/
function queryAppraises(){
	var shopCatId1 = $('#shopCatId1').val();
	var shopCatId2 = $('#shopCatId2').val();
	var goodsName = $('#goodsName').val();
	location.href=domainURL+'index.php/Home/GoodsAppraises/index/?umark=GoodsAppraises&goodsName='+goodsName+"&shopCatId1="+shopCatId1+"&shopCatId2="+shopCatId2; 
}
function getShopCatListForAppraises(v,id){
	   var params = {};
	   params.id = v;
	   $('#shopCatId2').empty();
	   var html = [];
	   $.post(domainURL+"index.php/Home/ShopsCats/queryByList",params,function(data,textStatus){
		    html.push('<option value="">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.catId+'" '+((id==opts.catId)?'selected':'')+'>'+opts.catName+'</option>');
				}
			}
			$('#shopCatId2').html(html.join(''));
	   });
}
/******************订单列表**********************/
//查看订单
function showOrder(id){
    $.layer({
	    type: 2,
	    title:"订单详情",
	    shade: [0.6, '#000'],
	    border: [0],
	    iframe: {src : domainURL+'index.php/Home/Orders/getOrderDetails?orderId='+id},
	    area: ['1020px', ($(window).height() - 50) +'px']
	});
}
//受理
function shopOrderAccept(id){
	layer.confirm('确定受理吗？', function(){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(domainURL+"index.php/Home/Orders/shopOrderAccept/",{orderId:id},function(data){
	    	layer.close(ll);
	    	var json = WST.toJson(data);
			if(json.status>0){
				$(".wst-tab-nav").find("li").eq(statusMark).click();
			}else if(json.status==-1){
				layer.msg('操作失，订单状态已发生改变，请刷新后再重试 !', 1, 8);
			}else{
				layer.msg('操作失，请与商城管理员联系 !', 1, 8);
			}
	   });
	});
	
}
//包装
function shopOrderProduce(id){
	layer.confirm('确定打包中吗？', function(){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(domainURL+"index.php/Home/Orders/shopOrderProduce/",{orderId:id},function(data){
	    	layer.close(ll);
	    	var json = WST.toJson(data);
			if(json.status>0){
				$(".wst-tab-nav").find("li").eq(statusMark).click();
			}else if(json.status==-1){
				layer.msg('操作失，订单状态已发生改变，请刷新后再重试 !', 1, 8);
			}else{
				layer.msg('操作失，请与商城管理员联系 !', 1, 8);
			}
	   });
	});
	
}
//发货配送
function shopOrderDelivery(id){
	layer.confirm('确定正在发货吗？', function(){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(domainURL+"index.php/Home/Orders/shopOrderDelivery/",{orderId:id},function(data){
	    	layer.close(ll);
	    	var json = WST.toJson(data);
			if(json.status>0){
				$(".wst-tab-nav").find("li").eq(statusMark).click();
			}else if(json.status==-1){
				layer.msg('操作失，订单状态已发生改变，请刷新后再重试 !', 1, 8);
			}else{
				layer.msg('操作失，请与商城管理员联系 !', 1, 8);
			}
	   });
	});
	
}
//确认收货
function shopOrderReceipt(id){
	layer.confirm('确定已收货吗？', function(){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(domainURL+"index.php/Home/Orders/shopOrderReceipt/",{orderId:id},function(data){
	    	layer.close(ll);
	    	var json = WST.toJson(data);
			if(json.status>0){
				$(".wst-tab-nav").find("li").eq(statusMark).click();
			}else if(json.status==-1){
				layer.msg('操作失，订单状态已发生改变，请刷新后再重试 !', 1, 8);
			}else{
				layer.msg('操作失，请与商城管理员联系 !', 1, 8);
			}
	   });
	});
	
}
//同意拒收
function shopOrderRefund(id){
	layer.confirm('确定拒收吗？', function(){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(domainURL+"index.php/Home/Orders/shopOrderRefund/",{orderId:id},function(data){
	    	layer.close(ll);
	    	var json = WST.toJson(data);
			if(json.status>0){
				$(".wst-tab-nav").find("li").eq(statusMark).click();
			}else if(json.status==-1){
				layer.msg('操作失，订单状态已发生改变，请刷新后再重试 !', 1, 8);
			}else{
				layer.msg('操作失，请与商城管理员联系 !', 1, 8);
			}
	   });
	});
}



function orderPager(statusMark,pcurr){
	var orderNo = $.trim($("#orderNo_"+statusMark).val());
	var userName = $.trim($("#userName_"+statusMark).val());
	var userAddress = $.trim($("#userAddress_"+statusMark).val());
	
	$.post(domainURL+"index.php/Home/Orders/queryShopOrders",{orderNo:orderNo,userName:userName,userAddress:userAddress,statusMark:statusMark,pcurr:pcurr},function(data,textStatus){
		var json = WST.toJson(data);
		var html = new Array();
		if(json.root.length>0){
			for(var i=0;i<json.root.length;i++){
				var order = json.root[i];
				html.push("<tr>");
					html.push("<td width='100'><a href='javascript:;' style='color:blue;font-weight:bold;' onclick=showOrder('"+order.orderId+"')>"+order.orderNo+"</a></td>");
					html.push("<td width='100'>"+order.userName+"</td>");
					html.push("<td width='*'>"+order.userAddress+"</td>");
					html.push("<td width='100'>"+order.totalMoney+"</td>");
					html.push("<td width='100'><div style='line-height:20px;'>"+order.createTime+"</div></td>");

					html.push("<td width='100'>");
						html.push("<a href='javascript:;' onclick=showOrder('"+order.orderId+"')>查看</a> | ");
					if(statusMark==0){
						html.push(" | <a href='javascript:;' onclick=shopOrderAccept('"+order.orderId+"')>受理</a>");
					}else if(statusMark==1){
						html.push(" | <a href='javascript:;' onclick=shopOrderProduce('"+order.orderId+"')>打包</a>");
					}else if(statusMark==2){
						html.push(" | <a href='javascript:;' onclick=shopOrderDelivery('"+order.orderId+"')>发货配送</a>");
					}else if(statusMark==3){
							
					}else if(statusMark==4){
						html.push(" | <a href='javascript:;' onclick=shopOrderReceipt('"+order.orderId+"')>确认收货</a>");
					}else if(statusMark==6){
						if(order.orderStatus==-3){
						     html.push(" | <a href='javascript:;' onclick=shopOrderRefund('"+order.orderId+"')>同意拒收</a>");
						}
					}
					
					html.push("</td>");
				html.push("</tr>");
			}
			$("#otbody"+statusMark).html(html.join(""));
			$('.pager_'+statusMark).show();
		}else{
			$('#pager_'+statusMark).hide();
			$(".otbody"+statusMark).empty();
			
		}
	});	
	
}

function queryOrderPager(statusMark,pcurr){
	var orderNo = $.trim($("#orderNo_"+statusMark).val());
	var userName = $.trim($("#userName_"+statusMark).val());
	var userAddress = $.trim($("#userAddress_"+statusMark).val());
	
	var ll = layer.load('数据加载中，请稍候...');
		$.post(domainURL+"index.php/Home/Orders/queryShopOrders",{orderNo:orderNo,userName:userName,userAddress:userAddress,statusMark:statusMark,pcurr:pcurr},function(data,textStatus){
			var json = WST.toJson(data);
			var html = new Array();
			if(json.root.length>0){
				for(var i=0;i<json.root.length;i++){
					var order = json.root[i];
					html.push("<tr>");
						html.push("<td width='100'><a href='javascript:;' style='color:blue;font-weight:bold;' onclick=showOrder('"+order.orderId+"')>"+order.orderNo+"</a></td>");
						html.push("<td width='100'>"+order.userName+"</td>");
						html.push("<td width='*'>"+order.userAddress+"</td>");
						html.push("<td width='100'>"+order.totalMoney+"</td>");
						html.push("<td width='100'><div style='line-height:20px;'>"+order.createTime+"</div></td>");
				
						html.push("<td width='100'>");
							html.push("<a href='javascript:;' onclick=showOrder('"+order.orderId+"')>查看</a>");
						if(statusMark==0){
							html.push(" | <a href='javascript:;' onclick=shopOrderAccept('"+order.orderId+"')>受理</a>");
						}else if(statusMark==1){
							html.push(" | <a href='javascript:;' onclick=shopOrderProduce('"+order.orderId+"')>打包</a>");
						}else if(statusMark==2){
							html.push(" | <a href='javascript:;' onclick=shopOrderDelivery('"+order.orderId+"')>发货配送</a>");
						}else if(statusMark==3){
							
						}else if(statusMark==4){
							html.push(" | <a href='javascript:;' onclick=shopOrderReceipt('"+order.orderId+"')>确认收货</a>");
						}else if(statusMark==6){
							if(order.orderStatus==-3){
							     html.push(" | <a href='javascript:;' onclick=shopOrderRefund('"+order.orderId+"')>同意拒收</a>");
							}
						}
						html.push("</td>");
					html.push("</tr>");
				}
				$("#otbody"+statusMark).html(html.join(""));
				$('.pager_'+statusMark).show();
			}else{
				$('.pager_'+statusMark).hide();
				$("#otbody"+statusMark).empty();
				
			}
			var tt = null;
			tt = $("#opage_"+statusMark+" .wst-page-items").createPage({
				pageCount:json.totalPage,
				current:json.currPage,
				backFn:function(pcurr){
					orderPager(statusMark,pcurr);
				}
			});
			layer.close(ll);
		});
}
/*******修改密码 ********************/
function editPass(){
	   var params = {};
	   params.oldPass = $('#oldPass').val();
	   params.newPass = $('#newPass').val();
	   params.reNewPass = $('#reNewPass').val();
	   $.post(domainURL+"index.php/Home/Users/editPass",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				layer.msg('密码修改成功!', 1,1, function(){
					location.reload();
				});
			}else{
				layer.msg('密码修改失败!', 1, 8);
			}
	   });
}
/***************编辑店铺资料******************/
function getCommunitysForShopEdit(){
	  
	  $.post(rooturl+"/index.php/Home/Areas/queryAreaAndCommunitysByList",{areaId:areaId},function(data,textStatus){
			var json = data;
			if(json.list){
				var html = [];
				json = json.list;
				for(var i=0;i<json.length;i++){
					var isAreaSelected = ($.inArray(json[i]['areaId'],relateArea)>-1)?" checked ":"";
					communitysCount = 0
					if (json[i].communitys) {
						for (var j =json[i].communitys.length - 1; j >= 0; j--) {
							if ($.inArray(json[i].communitys[j]['communityId'],relateCommunity) > -1 ) {communitysCount++;};
						};
					};
					html.push("<dl class='areaSelect' id='"+json[i]['areaId']+"'>");
					html.push("<dt class='ATRoot' id='node_"+json[i]['areaId']+"' isshow='0'>"+json[i]['areaName']+"：<span> <input type='checkbox' all='1' class='AreaNode' onclick='javascript:selectArea(this)' id='ck_"+json[i]['areaId']+"' "+isAreaSelected+" value='"+json[i]['areaId']+"'><label for='ck_"+json[i]['areaId']+"' "+isAreaSelected+" value='"+json[i]['areaId']+"'>全区配送</label></span> <small>(已选<span class='count'>"+communitysCount+"</span>个社区)</small></dt>");
					if(json[i].communitys && json[i].communitys.length){
						for(var j=0;j<json[i].communitys.length;j++){
							var isCommunitySelected = ($.inArray(json[i].communitys[j]['communityId'],relateCommunity)>-1)?" checked ":"";
							isCommunitySelected += (isAreaSelected!='')?" disabled ":"";
						    html.push("<dd id='node_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"'><input type='checkbox' id='ck_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"' all='0' class='AreaNode' "+isCommunitySelected+" onclick='javascript:selectArea(this)' value='"+json[i].communitys[j]['communityId']+"'><label for='ck_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"'>"+json[i].communitys[j]['communityName']+"</label></dd>");
						}
					}
					html.push("</dl>");
				}
				$('#areaTree').html(html.join(''));
				$('#expendAll').parent().removeClass('Hide');
				$('#expendAll').attr('checked','checked');
			}
		});
	}
function selectArea(v){
	  var count = 0;
	  if($(v).attr('all')=='1'){
		$('input[id^="'+$(v).attr('id')+'_"]').each(function(){
			$(this)[0].checked = $(v)[0].checked;
			$(this)[0].disabled = $(v)[0].checked;
			if ($(v)[0].checked) {count++};
		});
	}else{
		$(v).closest('dl').find('input[type="checkbox"]').each(function(){
				if ($(this).prop('checked') == true) { count++};
		});
	}
	$(v).closest('dl').find('.count:first').html(count);
}

function editShop(){
	   var params = {};
	   params.userName = $('#userName').val();
	   params.shopSn = $('#shopSn').val();
	   params.shopName = $('#shopName').val();
	   params.shopCompany = $('#shopCompany').val();
	   params.shopKeywords = $('#shopKeywords').val();
	   params.shopImg = $('#shopImg').val();
	   params.shopTel = $('#shopTel').val();
	   params.shopAddress = $('#shopAddress').val();
	   params.deliveryMoney = $('#deliveryMoney').val();
	   params.deliveryFreeMoney = $('#deliveryFreeMoney').val();
	   params.avgeCostMoney = $('#avgeCostMoney').val();
	   params.isInvoice = $("input[name='isInvoice']:checked").val();
	   params.invoiceRemarks = $('#invoiceRemarks').val();
	   params.serviceStartTime = $('#serviceStartTime').val();
	   params.serviceEndTime = $('#serviceEndTime').val();
	   
	   params.shopAtive = $("input[name='shopAtive']:checked").val();
	   var relateArea = [0];
	   var relateCommunity = [0];
	   $('.AreaNode').each(function(){
			if($(this)[0].checked){
				if($(this).attr('all')==1){
					relateArea.push($(this).val());
				}else{
					relateCommunity.push($(this).val());
				}
			}
	   });
	   var shopAds = new Array();
	   var shopAdsUrl = new Array();
	   $('.gallery-img').each(function(){
		   shopAds.push($(this).attr("v"));
	   });
	   $('.gallery-img-url').each(function(){
		   shopAdsUrl.push($(this).val());
	   });
	   params.shopAds=shopAds.join('#@#');
	   params.shopAdsUrl=shopAdsUrl.join('#@#');
	   params.relateAreaId=relateArea.join(',');
	   params.relateCommunityId=relateCommunity.join(',');
	   layer.load('正在处理，请稍后...', 3);
	   $.post(rooturl+"/index.php/Home/Shops/edit",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				layer.msg('操作成功!', 1,1, function(){
					location.reload();
				});
			}else{
				layer.msg('操作失败!', 1, 8);
			}
		});
}
/******************店铺设置************************/
function setShop(){
	   var params = {};
	   params.shopTitle = $('#shopTitle').val();
	   params.shopKeywords = $('#shopKeywords').val();
	   params.shopBanner = $('#shopBanner').val();
	   var shopAds = new Array();
	   var shopAdsUrl = new Array();
	   $('.gallery-img').each(function(){
		   shopAds.push($(this).attr("v"));
	   });
	   $('.gallery-img-url').each(function(){
		   shopAdsUrl.push($(this).val());
	   });
	   params.shopAds=shopAds.join('#@#');
	   params.shopAdsUrl=shopAdsUrl.join('#@#');
	   params.shopDesc = $('#shopDesc').val();
	   layer.load('正在处理，请稍后...', 3);
	   
	   $.post(domainURL+"index.php/Home/Shops/editShopCfg",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				layer.msg('操作成功!', 1,1, function(){
					location.reload();
				});
			}else{
				layer.msg('操作失败!', 1, 8);
			}
		});
}
function logout(){
	jQuery.post(rooturl+"/index.php/Home/Shops/logout/",{},function(rsp) {
		location.reload();
	});
}
function checkLogin(){
	jQuery.post(domainURL+"/index.php/Home/Shops/checkLoginStatus/",{},function(rsp) {
		var json = WST.toJson(rsp);
		if(json.status && json.status==-999)location.reload();
	});
}