function queryGroups(){
	var params = {};
	params.startDate = $("#startDate").val();
	params.endDate = $("#endDate").val();
	params.groupName = $("#groupName").val();
	location.href = Think.U('Home/Groups/queryGroupByPage',params);
}

function toEdit(id){
	var params = {};
		params.groupId = id;
	location.href = Think.U('Home/Groups/toEdit',params);
}

function eidtGroup(){
	var params = WST.fillForm('.wstipt');
	var loading = layer.load('正在提交商品信息，请稍后...', 3);
	   $.post(Think.U('Home/Groups/edit'),params,function(data,textStatus){
		   layer.close(loading);
			var json = WST.toJson(data);
			if(json.status=='1'){
				WST.msg('操作成功!', {icon: 1}, function(){
					location.href=Think.U('Home/Groups/queryGroupByPage');
				});
			}else{
				WST.msg(json.msg, {icon: 5});
			}
	 });
}

function delGroup(id){
	
	layer.confirm("您确定删除该团购活动吗？",{icon: 3, title:'系统提示'},function(){
	      var ids = WST.getChks('.chk');
	      var loading = layer.load('正在处理，请稍后...', 3);
	      var params = {};
	      params.id = id;
	      $.post(Think.U('Home/Groups/del'),params,function(data,textStatus){
	    		var json = WST.toJson(data);
	    		if(json.status=='1'){
	    			WST.msg('操作成功！', {icon: 1},function(){
	    				location.reload();
	    			});
	    		}else{
	    			layer.close(loading);
	    			WST.msg('操作失败', {icon: 5});
	    		}
	     });
	});
}


function getGroupGoodsByCat(groupId,catId){
	
	$("#pk_l_goods").empty();
	$.post(Think.U('Home/Groups/getGroupGoodsByCat'),{"groupId":groupId,"catId":catId},function(data,textStatus){
		var json = WST.toJson(data);
		var html = [];
		var opts = [];
		$("#pk_r_goods option").each(function(){
			opts.push( $(this).val());
		});
		for(var i=0;i<json.length;i++){
			var obj = json[i];
			if(opts.toString().indexOf(obj.goodsId)==-1){
				html.push("<option value='"+obj.goodsId+"' txt='"+obj.goodsName+"' >"+obj.goodsName+"</option>");
			}
		}
		$("#pk_l_goods").html(html.join(""));
	});
}

function groupOptTo(fromId,toId){
	var currOpt = $("#"+fromId+" option:selected");
	if(currOpt.length>0){
		var txt = $(currOpt).attr("txt");
		var val = $(currOpt).val();
		$("#"+toId).append("<option value='"+val+"' txt='"+txt+"'>"+txt+"</option>");
		currOpt.remove();
	}
}

function addGroupGoods(){

	var params = {};
	params.groupId = $("#groupId").val();
	var goodsIds = [];
	$("#pk_r_goods option").each(function(){
		goodsIds.push($(this).val());
	});
	if(goodsIds.length==0){
		WST.msg('请选择参加团购的商品');
		return;
	}
	var loading = layer.load('正在提交数据，请稍后...', 3);
	params.goodsIds = goodsIds.join(",");
	$.post(Think.U('Home/Groups/addGroupGoods'),params,function(data,textStatus){
		var json = WST.toJson(data);
		layer.close(loading);
		if(json.status=='1'){
			WST.msg('操作成功！', {icon: 1},function(){
				$("#pk_r_goods").empty();
			});
		}else{
			WST.msg('操作失败', {icon: 5});
		}
		
	});
	
}

function delGroupGoods(id){
	layer.confirm("您确定删除该团购商品吗？",{icon: 3, title:'系统提示'},function(){
	      var ids = WST.getChks('.chk');
	      var loading = layer.load('正在处理，请稍后...', 3);
	      var params = {};
	      params.id = id;
	      $.post(Think.U('Home/Groups/delGroupGoods'),params,function(data,textStatus){
	    		var json = WST.toJson(data);
	    		if(json.status=='1'){
	    			WST.msg('操作成功！', {icon: 1},function(){
	    				location.reload();
	    			});
	    		}else{
	    			layer.close(loading);
	    			WST.msg('操作失败', {icon: 5});
	    		}
	     });
	});
}


var currpage = 0;
function queryGroupGoods(pcurr){
	var params = {};
	params.pcurr = pcurr;
	params.groupId = $("#groupId").val();
	var ll = layer.load('数据加载中，请稍候...');
	$.post(Think.U('Home/Groups/queryGroupGoodsByPage'),params,function(data,textStatus){
			var json = WST.toJson(data);
			
			$("#wst-tab tbody").remove();
			var tmpMsg = '';
			if(json.root.length>0){
				for(var i=0;i<json.root.length;i++){
					var goods = json.root[i];
					var html = new Array();
					html.push('<tbody>');     
						html.push('<tr >');
							html.push('<td >'+(i+1)+'</td>');
							html.push('<td ><div class="goods-img"><a target="_blank" href="'+Think.U('Home/Goods/getGoodsDetails',{'goodsId':goods.goodsId})+'"><img data-original="'+WST.ROOT+'/'+goods.goodsThums+'" class="glazyImg" title="'+goods.goodsName+'"/></a></div></td>');
							html.push('<td >'+goods.goodsName+'</td>');
							html.push('<td >'+goods.shopPrice+'<input id="shopPrice_'+goods.id+'" type="hidden" value="'+goods.shopPrice+'"/></td>');
							if(goods.goodsStatus<1){
								html.push('<td ><input id="groupMoney_'+goods.id+'" type="text" value="'+goods.groupMoney+'" style="width:60px;"/></td>');
								html.push('<td ><input id="goodsStock_'+goods.id+'" type="text" value="'+goods.goodsStock+'" style="width:60px;"/></td>');
								html.push('<td ><input id="virtualBuyCnt_'+goods.id+'" type="text" value="'+goods.virtualBuyCnt+'" style="width:60px;"/></td>');
							}else{
								html.push('<td >'+goods.groupMoney+'</td>');
								html.push('<td >'+goods.goodsStock+'/<span style="color:red">'+goods.saleCnt+'</span></td>');
								html.push('<td >'+goods.virtualBuyCnt+'</td>');
							}
							html.push('<td >'+groupGoodsStatus(goods.goodsStatus)+'</td>');
							html.push('<td >');
							if(goods.goodsStatus<1){
								html.push('<a href="javascript:;" style="color:" onclick="auditGroupGoods('+goods.id+')">【提交审核】</a>');
							}
							html.push('<a href="javascript:;" style="color:" onclick="delGroupGoods('+goods.id+')">【删除】</a>');
							html.push('</td>');
						html.push('</tr>');
				 	html.push('</tbody>');
					
				$(html.join("")).insertBefore("#wst-tab tfoot");
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
		        			 queryGroupGoods(e.curr);
		        			 currpage = e.curr;
		        		 }   
		        	 } 
		        });
	       }else{
	    	   $('#wst-page').remove();
	       }
		}
		layer.close(ll);
	});
}

function groupGoodsStatus(goodsStatus){
	var statusText = "";
	switch(goodsStatus){
		case '-1': statusText = "待提交";break;
		case '0': statusText = "待提交";break;
		case '1': statusText = "待审核";break;
		case '2': statusText = "审核通过";break;
	}
	return statusText;
}

function auditGroupGoods(id){

	var params = {};
	params.id = id;
	params.shopPrice = parseFloat($("#shopPrice_"+id).val(),10);
	params.groupMoney = parseFloat($("#groupMoney_"+id).val(),10);
	params.goodsStock = parseInt($("#goodsStock_"+id).val(),10);
	params.virtualBuyCnt = $("#virtualBuyCnt_"+id).val();
	if(params.groupMoney<=0){
		WST.msg('请输入团购价格');
		return;
	}
	if(params.groupMoney>params.shopPrice){
		WST.msg('团购价格必须小于店铺价格');
		return;
	}
	if(params.goodsStock<1){
		WST.msg('请输入商品库存');
		return;
	}
	var loading = layer.load('正在处理，请稍后...', 3);
	$.post(Think.U('Home/Groups/auditGroupGoods'),params,function(data,textStatus){
		var json = WST.toJson(data);
		if(json.status=='1'){
			WST.msg('操作成功！', {icon: 1},function(){
				queryGroupGoods(currpage);
			});
		}else{
			layer.close(loading);
				WST.msg('操作失败', {icon: 5});
			}
	});
	
}


function delGroupGoods(id){
	layer.confirm("您确定删除该团购商品吗？",{icon: 3, title:'系统提示'},function(){
	      var loading = layer.load('正在处理，请稍后...', 3);
	      var params = {};
	      params.id = id;
	      $.post(Think.U('Home/Groups/delGroupGoods'),params,function(data,textStatus){
	    		var json = WST.toJson(data);
	    		if(json.status=='1'){
	    			WST.msg('操作成功！', {icon: 1},function(){
	    				queryGroupGoods(currpage);
	    			});
	    		}else{
	    			layer.close(loading);
	    			WST.msg('操作失败', {icon: 5});
	    		}
	     });
	});
}
