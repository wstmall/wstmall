
function toPay(id){
    alert("支付接口");
}
function showOrder(id){
    $.layer({
	    type: 2,
	    title:"订单详情",
	    shade: [0.6, '#000'],
	    border: [0],
	    offset: ['20px',''],
	    iframe: {src : rooturl+'/index.php/Home/Orders/getOrderDetails?orderId='+id},
	    area: ['1020px', ($(window).height() - 50) +'px']
	});
}
function orderCancel(id){
	layer.confirm('确定删除吗？', function(){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(rooturl+"/index.php/Home/Orders/orderCancel/",{orderId:id},function(data){
	    	layer.close(ll);
	    	var json = WST.toJson(data);
			if(json.status>0){
				window.location.reload();
			}else if(json.status==-1){
				layer.msg('操作失，订单状态已发生改变，请刷新后再重试 !', 1, 8);
			}else{
				layer.msg('操作失，请与商城管理员联系 !', 1, 8);
			}
	   });
	});
	
}

function appraiseOrder(id){
	$.layer({
	    type: 2,
	    title:"订单详情",
	    shade: [0.6, '#000'],
	    border: [0],
	    iframe: {src : rooturl+'/index.php/Home/GoodsAppraises/toAppraise?orderId='+id},
	    area: ['1020px', ($(window).height() - 50) +'px'],
	    close:function(){
	    	window.location.reload();
	    }
	});
}


function addGoodsAppraises(goodsId,orderId){
	
	var goodsScore = $('.'+goodsId+'_goodsScore > input[name="score"]').val();
	if(goodsScore==0){
		layer.msg('请选择商品评分 !', 1, 8);
		return;
	}
	
	var timeScore = $('.'+goodsId+'_timeScore > input[name="score"]').val();
	if(timeScore==0){
		layer.msg('请选择时效得分 !', 1, 8);
		return;
	}
	
	var serviceScore = $('.'+goodsId+'_serviceScore > input[name="score"]').val();
	if(serviceScore==0){
		layer.msg('请选择服务得分 !', 1, 8);
		return;
	}
	
	var content = $.trim($('#'+goodsId+'_content').val());
	if(content.length<3 || content.length>50){
		layer.msg('评价内容为3-50个字 !', 1, 8);
		return;
	}
	
	layer.confirm('您确定要提交该评价吗？', function(){
	    var ll = layer.load('数据处理中，请稍候...');
		$.post(rooturl+"/index.php/Home/GoodsAppraises/addGoodsAppraises",{shopId:shopId, goodsId:goodsId, orderId:orderId, goodsScore:goodsScore, timeScore:timeScore, serviceScore:serviceScore, content:content },function(data,textStatus){
			layer.close(ll);
			var json = WST.toJson(data);
			if(json.status==1){
				layer.msg('评价成功!', 1,1, function(){
					location.reload();
				});
			}else{
				layer.msg('评价失败，请刷新后再重试 !', 1, 8);
			}
		});
	});
}

function orderConfirm(id,type){
	var msg = (type==1)?'确定已收货吗？':'您确认拒收货吗?';
	layer.confirm(msg, function(){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(rooturl+"/index.php/Home/Orders/orderConfirm/",{orderId:id,type:type},function(data){
	    	layer.close(ll);
	    	var json = WST.toJson(data);
			if(json.status>0){
				//window.location.reload();
			}else if(json.status==-1){
				layer.msg('操作失，订单状态已发生改变，请刷新后再重试 !', 1, 8);
			}else{
				layer.msg('操作失，请与商城管理员联系 !', 1, 8);
			}
	   });
	});
	
}

