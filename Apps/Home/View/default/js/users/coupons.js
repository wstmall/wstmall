
function delCoupon(obj,id){
	
	layer.confirm("您确定删除该优惠券吗？",{icon: 3, title:'系统提示'},function(){
	      var loading = layer.load('正在处理，请稍后...', 3);
	      var params = {};
	      params.id = id;
	      $.post(Think.U('Home/Coupons/delByUser'),params,function(data,textStatus){
	    		var json = WST.toJson(data);
	    		layer.close(loading);
	    		if(json.status=='1'){
	    			WST.msg('删除成功！', {icon: 1},function(){
	    				var couponBox = $(obj).parent();
	    				var couponPbox = couponBox.parent();
	    				var shopBox = couponPbox.parent();
	    				var listBox = shopBox.parent();
	    					couponBox.remove();
	    				if(couponPbox.children().length==1){
	    					shopBox.remove();
	    				}
	    				if(listBox.children().length==0){
	    					listBox.html("<div class='cempty'>您还没有领取优惠券哦！</div>");
	    				}
	    			});
	    		}else{
	    			WST.msg('删除失败', {icon: 5});
	    		}
	     });
	});
}