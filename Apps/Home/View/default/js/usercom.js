function checkLogin(){
	jQuery.post(Think.U('Home/Shops/checkLoginStatus'),{},function(rsp) {
		var json = WST.toJson(rsp);
		if(json.status && json.status==-999)location.reload();
	});
}
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
function editAddress(){
	   var params = {};
	   params.id = $('#id').val();
	   params.areaId1 = $('#areaId1').val();
	   params.areaId2 = $('#areaId2').val();
	   params.areaId3 = $('#areaId3').val();
	   params.communityId = $('#communityId').val();
	   params.address = $('#address').val();
	   params.userName = $('#userName').val();
	   params.userPhone = $('#userPhone').val();
	   params.userTel = $('#userTel').val();
	   params.isDefault = $("input[name='isDefault']:checked").val();
	   
	   
	   if(!WST.checkMinLength(params.userName,2)){
		   WST.msg("收货人姓名长度必须大于1个汉字", {icon: 5});
			return ;	
		}
	   	if(params.areaId1<1){
	   		WST.msg("请选择省", {icon: 5});
			return ;		
		}
		if(params.areaId2<1){
			WST.msg("请选择市", {icon: 5});
			return ;		
		}
		if(params.areaId3<1){
			WST.msg("请选择区县", {icon: 5,shade: [0.3, '#000'],time: 2000});
			return ;		
		}
		if(params.communityId<1){
			WST.msg("请选择社区", {icon: 5});
			return ;		
		}
		if(params.address==""){
			WST.msg("请输入详细地址", {icon: 5});
			return ;		
		}
		if(params.userPhone=="" && params.userTel==""){
			WST.msg("请输入手机号码或固定电话", {icon: 5});
			return ;		
		}
		if(params.userPhone!="" && !WST.isPhone(params.userPhone)){
			WST.msg("手机号码格式错误", {icon: 5});
			return ;		
		}
		if(params.userTel!="" && !WST.isTel(params.userTel)){
			WST.msg("固定电话格式错误", {icon: 5});
			return ;		
		}	
	   
	   $.post(Think.U('Home/UserAddress/edit'),params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status>0){
				WST.msg('操作成功!', {icon: 1}, function(){
					location.href = Think.U('Home/UserAddress/queryByPage');
				});
			}else{
				WST.msg(' 操作失败!',{icon: 5});
			}
	   });
}
function getAreaList(objId,parentId,t,id){
	   var params = {};
	   params.parentId = parentId;
	   params.type = t;
	   $('#'+objId).empty();
	   if(t<1){
		   $('#areaId3').empty();
		   $('#areaId3').html('<option value="">请选择</option>');
	   }
	   var html = [];
	   $.post(Think.U('Home/Areas/queryByList'),params,function(data,textStatus){
		    html.push('<option value="">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list.length>0){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.areaId+'" '+((id==opts.areaId)?'selected':'')+'>'+opts.areaName+'</option>');
				}
			}
			$('#'+objId).html(html.join(''));
	   });
}
function getCommunitys(v,id){
	   var params = {};
	   params.areaId3 = v;
	   $('#communityId').empty();
	   var html = [];
	   $.post(Think.U('Home/Communitys/getByDistrict'),params,function(data,textStatus){
		    html.push('<option value="">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list && json.list.length>0){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.communityId+'" '+((id==opts.communityId)?'selected':'')+'>'+opts.communityName+'</option>');
				}
			}
			$('#communityId').html(html.join(''));
	   });
}

function toEditAddress(id){
	    location.href = Think.U('Home/UserAddress/toEdit','id='+id); 
	}
	function delAddress(id){
		layer.confirm("您确定要删除该地址吗？",{icon: 3, title:'系统提示'},function(tips){
			var ll = layer.load('数据处理中，请稍候...');
			$.post(Think.U('Home/UserAddress/del'),{id:id},function(data,textStatus){
				layer.close(ll);
		    	layer.close(tips);
				var json = WST.toJson(data);
				if(json.status=='1'){
					WST.msg('操作成功!', {icon: 1}, function(){
					   location.reload();
					});
				}else{
					WST.msg('操作失败!', {icon: 5});
				}
			});
		});
	}
function batchMessageDel(){
	  layer.confirm("您确定要删除这些消息？",function(){
	        var ids = getChks();
	        layer.load('正在处理，请稍后...', 3);
	        var params = {};
	        params.ids = ids;
	        $.post(Think.U('Home/Messages/batchDel'),params,function(data,textStatus){
	          var json = WST.toJson(data);
	          if(json.status=='1'){
	        	  WST.msg('操作成功！', {icon: 1},function(){
	              location.reload();
	            });
	          }else{
	        	  WST.msg('操作失败', {icon: 5});
	          }
	       });
	  });
}
function editPass(){
	   var params = {};
	   params.oldPass = $('#oldPass').val();
	   params.newPass = $('#newPass').val();
	   params.reNewPass = $('#reNewPass').val();
	   var ll = layer.load('数据处理中，请稍候...');
	   $.post(Think.U("Home/Users/editPass"),params,function(data,textStatus){
		   layer.close(ll);
			var json = WST.toJson(data);
			if(json.status=='1'){
				WST.msg('密码修改成功!', {icon: 1}, function(){
					location.reload();
				});
			}else{
				WST.msg('密码修改失败!', {icon: 5});
			}
	   });
}
function editUser(){
	   var params = {};
	   params.userName = $.trim($('#userName').val());
	   params.userQQ = $.trim($('#userQQ').val());
	   params.userPhone = $.trim($('#userPhone').val());
	   params.userEmail = $.trim($('#userEmail').val());
	   params.userSex = $('input:radio[name="userSex"]:checked').val();
	   params.userPhoto =  $.trim($('#userPhoto').val());		
	   var ll = layer.load('数据处理中，请稍候...');
	   $.post(Think.U('Home/Users/editUser'),params,function(data,textStatus){
		   layer.close(ll);
			var json = WST.toJson(data);
			if(json.status=='1'){
				WST.msg('修改用户资料成功!', {icon: 1},function(){
					location.href= location.href;
				});
			}else if(json.status=='-2'){
				WST.msg('用户手机已存在!', {icon: 5});
			}else if(json.status=='-3'){
				WST.msg('用户邮箱已存在!', {icon: 5});
			}else{
				WST.msg('修改用户资料失败!', {icon: 5});
			}
	   });
}

function toPay(id){
	
	var params = {};
	params.orderIds = id;
	jQuery.post(Think.U('Home/Orders/checkOrderPay') ,params,function(data) {
		var json = WST.toJson(data);
		if(json.status==1){
			location.href=Think.U('Home/Payments/toPay','orderIds='+params.orderIds);
		}else if(json.status==-2){
			var rlist = json.rlist;
			var garr = new Array();
			for(var i=0;i<rlist.length;i++){
				garr.push(rlist[i].goodsName+rlist[i].goodsAttrName);
			}
			WST.msg('订单中商品【'+garr.join("，")+'】库存不足，不能进行支付。', {icon: 5});
		}else{
			WST.msg('您的订单已支付!', {icon: 5});
			setTimeout(function(){
				window.location = Think.U('Home/orders/queryDeliveryByPage');
			},1500);
		}
	});
	
}
function showOrder(id){
	layer.open({
	    type: 2,
	    title:"订单详情",
	    shade: [0.6, '#000'],
	    border: [0],
	    offset: ['20px',''],
	    content: [Think.U('Home/Orders/getOrderDetails','orderId='+id)],
	    area: ['1020px', ($(window).height() - 50) +'px']
	});
}
function orderCancel(id,type){
	if(type==1 || type==2){
		var w = layer.open({
		    type: 1,
		    title:"取消原因",
		    shade: [0.6, '#000'],
		    border: [0],
		    content: '<textarea id="rejectionRemarks" rows="8" style="width:96%" maxLength="100"></textarea>',
		    area: ['500px', '260px'],
		    btn: ['提交', '关闭窗口'],
	        yes: function(index, layero){
	        	var rejectionRemarks = $.trim($('#rejectionRemarks').val());
	        	if(rejectionRemarks==''){
	        		WST.msg('请输入拒收原因 !', {icon: 5});
	        		return;
	        	}
	        	var ll = layer.load('数据处理中，请稍候...');
			    $.post(Think.U('Home/Orders/orderCancel'),{orderId:id,type:1,rejectionRemarks:rejectionRemarks},function(data){
			    	layer.close(w);
			    	layer.close(ll);
			    	var json = WST.toJson(data);
					if(json.status>0){
						window.location.reload();
					}else if(json.status==-1){
						WST.msg('操作失败，订单状态已发生改变，请刷新后再重试 !', {icon: 5});
					}else{
						WST.msg('操作失败，请与商城管理员联系 !', {icon: 5});
					}
			   });
	        }
		});
	}else{
		layer.confirm('您确定要取消该订单吗？',{icon: 3, title:'系统提示'}, function(tips){
		    var ll = layer.load('数据处理中，请稍候...');
		    $.post(Think.U('Home/Orders/orderCancel'),{orderId:id},function(data){
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
}

function appraiseOrder(id){
	layer.open({
	    type: 2,
	    title:"订单详情",
	    shade: [0.6, '#000'],
	    border: [0],
	    content: [Think.U('Home/GoodsAppraises/toAppraise','orderId='+id)],
	    area: ['1020px', ($(window).height() - 50) +'px'],
	    end:function(){
	    	window.location.reload();
	    }
	});
}
function complainInit(){
	var uploading = null;
	var uploader = WebUploader.create({
	      auto: true,
	      swf: WST.PUBLIC +'/plugins/webuploader/Uploader.swf',
  	  server:Think.U('Home/OrderComplains/uploadPic'),
  	  pick:'#filePicker',
  	  accept: {
		    title: 'Images',
		    extensions: 'gif,jpg,jpeg,bmp,png',
		    mimeTypes: 'image/*'
	      },
	      fileNumLimit:5,
  	  formData: {dir:'complains'}
 });
 uploader.on('uploadSuccess', function( file,response ) {
	    var json = WST.toJson(response._raw);
	    layer.close(uploading);
	    if(json.status==1){
	    	var html = [];
			html.push("<div style='width:100px;float:left;margin-right:5px;'>");
			html.push("<img class='complain_pic' width='100' height='100' src='"+WST.DOMAIN+"/"+json.file.savepath+json.file.savename+"'>");
			html.push('<div style="position:relative;top:-100px;left:80px;cursor:pointer;" onclick="javascript:delComplainPic(this)"><img src="'+WST.DOMAIN+'/Apps/Home/View/default/images/action_delete.gif"></div>');
			html.push('</div>');
			$('#picBox').append(html.join(''));
	    }
	});
	uploader.on('uploadError', function( file ) {
		WST.msg('上传图片失败!', {icon: 5});
	});
	uploader.on( 'uploadProgress', function( file, percentage ) {
		uploading = WST.msg('正在上传图片，请稍后...');
	});
}
function delComplainPic(obj){
	$(obj).parent().remove();
}
function getComplainList(){
	location.href=Think.U('Home/OrderComplains/queryUserComplainByPage','orderNo='+$.trim($('#orderNo').val()));
}
function saveComplain(historyURL){
	var params = WST.fillForm('.wstipt');
	var img = [];
	$('.complain_pic').each(function(){
		img.push($(this).attr('src').replace(WST.DOMAIN+"/",""));
	});
	params.complainAnnex = img.join(',');
	if(params.complainContent==''){
		WST.msg('投诉内容不能为空！', {icon: 5});
		return;
	}
	var ll = WST.msg('正在提交投诉信息，请稍候...', {icon: 16,shade: [0.5, '#B3B3B3']});
	jQuery.post(Think.U('Home/OrderComplains/saveComplain') ,params,function(data) {
		 layer.close(ll);
		 var json = WST.toJson(data);	
		 if(json.status==1){
			 WST.msg('您的投诉已提交，请留意信息回复', {icon: 6},function(){
				 location.href = historyURL;
			 });
		 }else{
			 WST.msg(json.msg, {icon: 5});
		 }
    });
}
function addGoodsAppraises(shopId,goodsId,goodsAttrId,orderId){
	var goodsScore = $('.'+goodsId+'_'+goodsAttrId+'_goodsScore > input[name="score"]').val();
	if(goodsScore==0){
		WST.msg('请选择商品评分 !', {icon: 5});
		return;
	}
	
	var timeScore = $('.'+goodsId+'_'+goodsAttrId+'_timeScore > input[name="score"]').val();
	if(timeScore==0){
		WST.msg('请选择时效得分 !', {icon: 5});
		return;
	}
	
	var serviceScore = $('.'+goodsId+'_'+goodsAttrId+'_serviceScore > input[name="score"]').val();
	if(serviceScore==0){
		WST.msg('请选择服务得分 !', {icon: 5});
		return;
	}
	
	var content = $.trim($('#'+goodsId+'_'+goodsAttrId+'_content').val());
	if(content.length<3 || content.length>50){
		WST.msg('评价内容为3-50个字 !', {icon: 5});
		return;
	}
	
	//layer.confirm('您确定要提交该评价吗？',{icon: 3, title:'系统提示'}, function(tips){
	    var ll = layer.load('数据处理中，请稍候...');
		$.post(Think.U('Home/GoodsAppraises/addGoodsAppraises'),{shopId:shopId, goodsId:goodsId, goodsAttrId:goodsAttrId,orderId:orderId, goodsScore:goodsScore, timeScore:timeScore, serviceScore:serviceScore, content:content },function(data,textStatus){
			//layer.close(tips);
			layer.close(ll);
			var json = WST.toJson(data);
			if(json.status==1){
				$('#'+goodsId+'_'+goodsAttrId+'_appraise').slideUp();
				$('#'+goodsId+'_'+goodsAttrId+'_appraise').empty();
				$('#'+goodsId+'_'+goodsAttrId+'_status').html('评价成功');
			}else if(json.status==-1){
				WST.msg(json.msg, {icon: 5});
			}else{
				WST.msg('评价失败，请刷新后再重试 !', {icon: 5});
			}
		});
	//});
}

function orderConfirm(id,type){
	if(type==1){
		layer.confirm('您确定已收货吗？',{icon: 3, title:'系统提示'}, function(tips){
		    var ll = layer.load('数据处理中，请稍候...');
		    $.post(Think.U('Home/Orders/orderConfirm'),{orderId:id,type:type},function(data){
		    	layer.close(tips);
		    	layer.close(ll);
		    	var json = WST.toJson(data);
				if(json.status>0){
					location.reload();
				}else if(json.status==-1){
					WST.msg('操作失败，订单状态已发生改变，请刷新后再重试 !', {icon: 5});
				}else{
					WST.msg('操作失败，请与商城管理员联系 !', {icon: 5});
				}
		   });
		});
	}else{
		var w = layer.open({
		    type: 1,
		    title:"拒收原因",
		    shade: [0.6, '#000'],
		    border: [0],
		    content: '<textarea id="rejectionRemarks" rows="8" style="width:96%" maxLength="100"></textarea>',
		    area: ['500px', '260px'],
		    btn: ['拒收订单', '关闭窗口'],
	        yes: function(index, layero){
	        	var rejectionRemarks = $.trim($('#rejectionRemarks').val());
	        	if(rejectionRemarks==''){
	        		WST.msg('请输入拒收原因 !', {icon: 5});
	        		return;
	        	}
	        	var ll = layer.load('数据处理中，请稍候...');
			    $.post(Think.U('Home/Orders/orderConfirm'),{orderId:id,type:type,rejectionRemarks:rejectionRemarks},function(data){
			    	layer.close(w);
			    	layer.close(ll);
			    	var json = WST.toJson(data);
					if(json.status>0){
						location.reload();
					}else if(json.status==-1){
						WST.msg('操作失败，订单状态已发生改变，请刷新后再重试 !', {icon: 5});
					}else{
						WST.msg('操作失败，请与商城管理员联系 !', {icon: 5});
					}
			   });
	        }
		});
	}
}

function getOrdersList(type){
	var params = {};
	var orderNo = $.trim($('#orderNo').val());
	var userName = $.trim($('#userName').val());
	var shopName = $.trim($('#shopName').val());
	var sdate = $.trim($('#sdate').val());
	var edate = $.trim($('#edate').val());
	if(orderNo!=""){
		params.orderNo = $.trim($('#orderNo').val());
	}
	if(userName!=""){
		params.userName = $.trim($('#userName').val());
	}
	if(shopName!=""){
		params.shopName = $.trim($('#shopName').val());
	}
	if(sdate!=""){
		params.sdate = $.trim($('#sdate').val());
	}
	if(edate!=""){
		params.edate = $.trim($('#edate').val());
	}
	
	//type->1:待付款订单;2:待发货订单;3:待确认收货;4:待评价交易;5:已取消订单;6:拒收/退款
	if(type==1){
		location.href=Think.U('Home/Orders/queryPayByPage',params);
	}else if(type==2){
		location.href=Think.U('Home/Orders/queryDeliveryByPage',params);
	}else if(type==3){
		location.href=Think.U('Home/Orders/queryReceiveByPage',params);
	}else if(type==4){
		location.href=Think.U('Home/Orders/queryAppraiseByPage',params);
	}else if(type==5){
		location.href=Think.U('Home/Orders/queryCancelOrders',params);
	}else if(type==6){
		location.href=Think.U('Home/Orders/queryRefundByPage',params);
	}
	
}



function getUserMsgTips(){
	$.post(Think.U('Home/Orders/getUserMsgTips'),{},function(data,textStatus){
		var json = WST.toJson(data);
		for(var i in json){
			if(i==-2){//未支付
				if(json[i]>0){
					$("#li_queryPayByPage .wst-msg-tips-box").show();
				}else{
					$("#li_queryPayByPage .wst-msg-tips-box").hide();
				}
				$("#li_queryPayByPage .wst-msg-tips-box").html(json[i]);
			}else if(i==2){//待发货
				if(json[i]>0){
					$("#li_queryDeliveryByPage .wst-msg-tips-box").show();
				}else{
					$("#li_queryDeliveryByPage .wst-msg-tips-box").hide();
				}
				$("#li_queryDeliveryByPage .wst-msg-tips-box").html(json[i]);
			}else if(i==3){//待收货
				if(json[i]>0){
					$("#li_queryReceiveByPage .wst-msg-tips-box").show();
				}else{
					$("#li_queryReceiveByPage .wst-msg-tips-box").hide();
				}
				$("#li_queryReceiveByPage .wst-msg-tips-box").html(json[i]);
			}else if(i==-3){//退款订单
				
			}else if(i==4){//获取待评价订单
				if(json[i]>0){
					$("#li_queryAppraiseByPage .wst-msg-tips-box").show();
				}else{
					$("#li_queryAppraiseByPage .wst-msg-tips-box").hide();
				}
				$("#li_queryAppraiseByPage .wst-msg-tips-box").html(json[i]);
			}else if(i==100000){//商城消息
				if(json[i]>0){
					$("#li_queryMessageByPage .wst-msg-tips-box").show();
				}else{
					$("#li_queryMessageByPage .wst-msg-tips-box").hide();
				}
				$("#li_queryMessageByPage .wst-msg-tips-box").html(json[i]);
			}
		}
	});
}

$(function() {
	getUserMsgTips();
	setInterval("getUserMsgTips()",30000);
});

function queryFavoriteGoods(p){
	 layer.load('正在查询商品数据，请稍后...', 3);
	 var param = {};
	 param.key = $.trim($("#key_"+statusMark).val());
     params.p = p;
     $.post(Think.U('Home/Favorites/queryGoodsByPage'),params,function(data,textStatus){
       var json = WST.toJson(data);
       
     });
}
function queryFavoriteGoods(p){
	var tips = WST.msg('正在加载记录,请稍候...',{time:600000000});
	var params = {};
	params.key = $.trim($('#key_0').val());
	params.p = p;
	$.post(Think.U('Home/Favorites/queryGoodsByPage'),params,function(data,textStatus){
		layer.close(tips);
	    var json = WST.toJson(data);
	    if(json.status==1 && json.data){
	       	var gettpl = document.getElementById('tblist').innerHTML;
	       	laytpl(gettpl).render(json.data.root, function(html){
	       	    $('.wst-goods-page').html(html);
	       	});
	       	$('.lazyImg').lazyload({ effect: "fadeIn",failurelimit : 10,threshold: 200,placeholder:WST.DEFAULT_IMG});
	       	if(json.data.totalPage>1){
	       		laypage({
		        	 cont: 'wst-page-0', 
		        	 pages:json.data.totalPage, 
		        	 curr: json.data.currPage,
		        	 skin: '#e23e3d',
		        	 groups: 3,
		        	 jump: function(e, first){
		        		    if(!first){
		        		    	queryFavoriteGoods(e.curr);
		        		    }
		        	    } 
		        });
	       	}else{
	       		$('#wst-page-0').empty();
	       	}
       	}  
	});
}
/**
 * 加入购物车
 */
function addCart(goodsId,type,goodsThums){
	var params = {};
	params.goodsId = goodsId;
	params.gcount = parseInt($("#buy-num").val(),10);
	params.rnd = Math.random();
	params.goodsAttrId = $('#shopGoodsPrice_'+goodsId).attr('dataId');
	$("#flyItem img").attr("src",WST.DOMAIN  +"/"+ goodsThums)
	jQuery.post(Think.U('Home/Cart/addToCartAjax') ,params,function(data) {
		if(type==1){
			location.href= Think.U('Home/Cart/toCart');
		}else{
			layer.msg("添加成功!",1,1);
		}
	});
}
function cancelGoodsFavorites(obj,id){
	layer.confirm('您确定取消关注该商品吗？',{icon: 3, title:'系统提示'}, function(tips){
		layer.close(tips);
	    var ll = layer.load('数据处理中，请稍候...');
		jQuery.post(Think.U("Home/Favorites/cancelFavorite") ,{id:id,type:0},function(data) {
			var json = WST.toJson(data,1);
			if(json.status==1){
				layer.close(ll);
				$(obj).parent().parent().parent().parent().remove();
				if($('.wst-goods-page').children().length==0)queryFavoriteGoods();
			}else{
				WST.msg('取消关注失败!');
			}
		});
	});
}
function queryFavoriteShops(p){
	var tips = WST.msg('正在加载记录,请稍候...',{time:600000000});
	var params = {};
	params.key = $.trim($('#key_1').val());
	params.p = p;
	$.post(Think.U('Home/Favorites/queryShopsByPage'),params,function(data,textStatus){
		layer.close(tips);
	    var json = WST.toJson(data);
	    if(json.status==1 && json.data){
	       	var gettpl = document.getElementById('tblist2').innerHTML;
	       	laytpl(gettpl).render(json.data.root, function(html){
	       	    $('.wst-shops-page').html(html);
	       	});
	       	$('.lazyImg').lazyload({ effect: "fadeIn",failurelimit : 10,threshold: 200,placeholder:WST.DEFAULT_IMG});
	       	if(json.data.totalPage>1){
	       		laypage({
		        	 cont: 'wst-page-1', 
		        	 pages:json.data.totalPage, 
		        	 curr: json.data.currPage,
		        	 skin: '#e23e3d',
		        	 groups: 3,
		        	 jump: function(e, first){
		        		    if(!first){
		        		    	queryFavoriteShops(e.curr);
		        		    }
		        	    } 
		        });
	       	}else{
	       		$('#wst-page-1').empty();
	       	}
       	}  
	});
}
function cancelShopFavorites(obj,id){
	layer.confirm('您确定取消关注该店铺吗？',{icon: 3, title:'系统提示'}, function(tips){
		layer.close(tips);
	    var ll = layer.load('数据处理中，请稍候...');
		jQuery.post(Think.U("Home/Favorites/cancelFavorite") ,{id:id,type:1},function(data) {
			var json = WST.toJson(data,1);
			if(json.status==1){
				layer.close(ll);
				$(obj).parent().parent().parent().remove();
				if($('.wst-shops-page').children().length==0)queryFavoriteShops();
			}else{
				WST.msg('取消关注失败!');
			}
		});
	});
}
