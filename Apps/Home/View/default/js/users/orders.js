
function toPay(id){
    alert("支付接口");
}
function showOrder(id){
	layer.open({
	    type: 2,
	    title:"订单详情",
	    shade: [0.6, '#000'],
	    border: [0],
	    offset: ['20px',''],
	    content: [domainURL +'/index.php/Home/Orders/getOrderDetails?orderId='+id],
	    area: ['1020px', ($(window).height() - 50) +'px']
	});
}
function orderCancel(id){
	layer.confirm('您确定要取消该订单吗？',{icon: 3, title:'系统提示'}, function(tips){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(domainURL +"/index.php/Home/Orders/orderCancel/",{orderId:id},function(data){
	    	layer.close(ll);
	    	layer.close(tips);
	    	var json = WST.toJson(data);
			if(json.status>0){
				window.location.reload();
			}else if(json.status==-1){
				WST.msg('操作失，订单状态已发生改变，请刷新后再重试 !', {icon: 5});
			}else{
				WST.msg('操作失，请与商城管理员联系 !', {icon: 5});
			}
	   });
	});
	
}

function appraiseOrder(id){
	layer.open({
	    type: 2,
	    title:"订单详情",
	    shade: [0.6, '#000'],
	    border: [0],
	    content: [domainURL +'/index.php/Home/GoodsAppraises/toAppraise?orderId='+id],
	    area: ['1020px', ($(window).height() - 50) +'px'],
	    end:function(){
	    	window.location.reload();
	    }
	});
}


function addGoodsAppraises(goodsId,orderId){
	
	var goodsScore = $('.'+goodsId+'_goodsScore > input[name="score"]').val();
	if(goodsScore==0){
		WST.msg('请选择商品评分 !', {icon: 5});
		return;
	}
	
	var timeScore = $('.'+goodsId+'_timeScore > input[name="score"]').val();
	if(timeScore==0){
		WST.msg('请选择时效得分 !', {icon: 5});
		return;
	}
	
	var serviceScore = $('.'+goodsId+'_serviceScore > input[name="score"]').val();
	if(serviceScore==0){
		WST.msg('请选择服务得分 !', {icon: 5});
		return;
	}
	
	var content = $.trim($('#'+goodsId+'_content').val());
	if(content.length<3 || content.length>50){
		WST.msg('评价内容为3-50个字 !', {icon: 5});
		return;
	}
	
	layer.confirm('您确定要提交该评价吗？',{icon: 3, title:'系统提示'}, function(tips){
	    var ll = layer.load('数据处理中，请稍候...');
		$.post(domainURL +"/index.php/Home/GoodsAppraises/addGoodsAppraises",{shopId:shopId, goodsId:goodsId, orderId:orderId, goodsScore:goodsScore, timeScore:timeScore, serviceScore:serviceScore, content:content },function(data,textStatus){
			layer.close(tips);
			layer.close(ll);
			var json = WST.toJson(data);
			if(json.status==1){
				WST.msg('评价成功!', {icon: 1}, function(){
					$('#'+goodsId+'_appraise').slideUp();
					$('#'+goodsId+'_appraise').empty();
					$('#'+goodsId+'_status').html('已评价');
				});
			}else{
				WST.msg('评价失败，请刷新后再重试 !', {icon: 5});
			}
		});
	});
}

function orderConfirm(id,type){
	var msg = (type==1)?'您确定已收货吗？':'您确认拒收货吗?';
	layer.confirm(msg,{icon: 3, title:'系统提示'}, function(tips){
	    var ll = layer.load('数据处理中，请稍候...');
	    $.post(domainURL +"/index.php/Home/Orders/orderConfirm/",{orderId:id,type:type},function(data){
	    	layer.close(tips);
	    	layer.close(ll);
	    	var json = WST.toJson(data);
			if(json.status>0){
				location.reload();
			}else if(json.status==-1){
				WST.msg('操作失，订单状态已发生改变，请刷新后再重试 !', {icon: 5});
			}else{
				WST.msg('操作失，请与商城管理员联系 !', {icon: 5});
			}
	   });
	});
	
}

