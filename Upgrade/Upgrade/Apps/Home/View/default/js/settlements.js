function querySettlementsByPage(p){
	var tips = layer.load('正在获取订单，请稍后...', 3);
	var params = {};
	params.p = p;
	params.settlementNo = $.trim($('#settlementNo_0').val());
	params.isFinish = $('#isFinish_0').val();
	$.post(Think.U('Home/OrderSettlements/querySettlementsByPage'),params,function(data,textStatus){
		layer.close(tips);
		var json = WST.toJson(data);
		var gettpl = document.getElementById('tblist0').innerHTML;
       	laytpl(gettpl).render(json.data.root, function(html){
       	    $('#otbody0').html(html);
       	});
       	if(json.data.totalPage>1){
       		laypage({
	            cont: 'wst-page-0', 
	        	pages:json.data.totalPage, 
	        	curr: json.data.currPage,
	        	skin: '#e23e3d',
	        	groups: 3,
	        	jump: function(e, first){
	        		if(!first){
	        			querySettlementsByPage(e.curr);
	        		}
	        	} 
	        });
       	}else{
       		$('#wst-page-0').empty();
       	}
	});
}

function queryUnSettlementOrdersByPage(p){
	var tips = layer.load('正在获取订单，请稍后...', 3);
	var params = {};
	params.p = p;
	params.orderNo = $.trim($('#orderNo_1').val());
	params.userName = $.trim($('#userName_1').val());
	$.post(Think.U('Home/OrderSettlements/queryUnSettlementOrdersByPage'),params,function(data,textStatus){
		layer.close(tips);
		var json = WST.toJson(data);
		var gettpl = document.getElementById('tblist1').innerHTML;
       	laytpl(gettpl).render(json.data.root, function(html){
       	    $('#otbody1').html(html);
       	});
       	if(json.data.totalPage>1){
       		laypage({
	            cont: 'wst-page-1', 
	        	pages:json.data.totalPage, 
	        	curr: json.data.currPage,
	        	skin: '#e23e3d',
	        	groups: 3,
	        	jump: function(e, first){
	        		if(!first){
	        			queryUnSettlementOrdersByPage(e.curr);
	        		}
	        	} 
	        });
       	}else{
       		$('#wst-page-1').empty();
       	}
	});
}

function querySettlementsOrdersByPage(p){
	var tips = layer.load('正在获取订单，请稍后...', 3);
	var params = {};
	params.p = p;
	params.settlementNo = $.trim($('#settlementNo_2').val());
	params.orderNo = $.trim($('#orderNo_2').val());
	params.isFinish = $('#isFinish_2').val();
	$.post(Think.U('Home/OrderSettlements/querySettlementsOrdersByPage'),params,function(data,textStatus){
		layer.close(tips);
		var json = WST.toJson(data);
		var gettpl = document.getElementById('tblist2').innerHTML;
       	laytpl(gettpl).render(json.data.root, function(html){
       	    $('#otbody2').html(html);
       	});
       	if(json.data.totalPage>1){
       		laypage({
	            cont: 'wst-page-2', 
	        	pages:json.data.totalPage, 
	        	curr: json.data.currPage,
	        	skin: '#e23e3d',
	        	groups: 3,
	        	jump: function(e, first){
	        		if(!first){
	        			querySettlementsOrdersByPage(e.curr);
	        		}
	        	} 
	        });
       	}else{
       		$('#wst-page-2').empty();
       	}
	});
}

function settlement(){
	var ids = WST.getChks('.chk_1');
	if(ids.length==0){
		WST.msg("请选择要结算的订单!", {icon: 5});
		return;
	}
	layer.confirm("您确定申请结算这些订单吗？",{icon: 3, title:'系统提示'},function(index){
		layer.close(index);
		var tips = layer.load('正在获取订单，请稍后...', 3);
		$.post(Think.U('Home/OrderSettlements/settlement'),{ids:ids.join(',')},function(data,textStatus){
			layer.close(tips);
			var json = WST.toJson(data);
			if(json.status=='1'){
				WST.msg('您的申请已提交!', {icon: 1}, function(){
					queryUnSettlementOrdersByPage();
				});
			}else{
				WST.msg(json.msg, {icon: 5});
			}
		});
	});
}
function view(val){
	$('#settlementNo_2').val(val);
	$('#tab').find('.wst-tab-nav li').eq(2).click();
}