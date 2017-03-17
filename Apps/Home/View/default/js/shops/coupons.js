function queryCoupons(){
	var params = {};
	params.startDate = $("#startDate").val();
	params.endDate = $("#endDate").val();
	params.couponName = $("#couponName").val();
	location.href = Think.U('Home/Coupons/queryCouponByPage',params);
}

function toEdit(id){
	var params = {};
		params.id = id;
		params.umark = "queryCouponByPage";
	location.href = Think.U('Home/Coupons/toEdit',params);
}

function eidtCoupon(){
	var params = WST.fillForm('.wstipt');
	var loading = layer.load('正在提交商品信息，请稍后...', 3);
	   $.post(Think.U('Home/Coupons/edit'),params,function(data,textStatus){
		   layer.close(loading);
			var json = WST.toJson(data);
			if(json.status=='1'){
				WST.msg('操作成功!', {icon: 1}, function(){
					location.href=Think.U('Home/Coupons/queryCouponByPage');
				});
			}else{
				WST.msg(json.msg, {icon: 5});
			}
	 });
}

function delCoupon(id){
	
	layer.confirm("您确定删除该优惠券吗？",{icon: 3, title:'系统提示'},function(){
	      var ids = WST.getChks('.chk');
	      var loading = layer.load('正在处理，请稍后...', 3);
	      var params = {};
	      params.id = id;
	      $.post(Think.U('Home/Coupons/del'),params,function(data,textStatus){
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