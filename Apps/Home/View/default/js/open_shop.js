$(function () { 
    	 getVerify();
    	 initTime('serviceStartTime','8');
 		 initTime('serviceEndTime','20');
    	 $.formValidator.initConfig({
  		   theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
  			       regist();
  			       return false;
  			},onError:function(msg){
  		}});
  	   $("#loginName").formValidator({onShow:"",onFocus:"登录账号应该为5-16字母、数字或下划线",onCorrect:""}).inputValidator({min:5,max:16,onError:"登录账号应该为5-16字母、数字或下划线"}).regexValidator({
  	       regExp:"username",dataType:"enum",onError:"登录账号格式错误"
  		}).ajaxValidator({
  			dataType : "json",
  			async : true,
  			url : Think.U('Home/Users/checkLoginKey'),
  			success : function(data){
  				var json = WST.toJson(data);
  	            if( json.status == "1" ) {
  	                return true;
  				} else {
  	                return false;
  				}
  				return "该登录账号已被使用";
  			},
  			buttons: $("#dosubmit"),
  			onError : "该登录账号已存在。",
  			onWait : "请稍候..."
  		}).defaultPassed();
  	   $("#loginPwd").formValidator({
  			onShow:"",onFocus:"登录密码长度应该为5-20位之间"
  			}).inputValidator({
  				min:5,max:50,onError:"登录密码长度应该为5-20位之间"
  			});
  	  $("#reUserPwd").formValidator({onShow:"",onFocus:"至少1个长度",onCorrect:"密码一致"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"重复密码两边不能有空符号"},onError:"重复密码不能为空,请确认"}).compareValidator({desID:"loginPwd",operateor:"=",onError:"2次密码不一致,请确认"});
  		$("#userPhone").inputValidator({min:0,max:11,onError:"你输入的手机号码非法,请确认"}).regexValidator({
  			regExp:"mobile",dataType:"enum",onError:"手机号码格式错误"
  		}).ajaxValidator({
  			dataType : "json",
  			async : true,
  			url : Think.U('Home/Users/checkLoginKey'),
  			success : function(data){
  				var json = WST.toJson(data);
  	            if( json.status == "1" ) {
  	                return true;
  				} else {
  	                return false;
  				}
  				return "该手机号码已被使用";
  			},
  			buttons: $("#dosubmit"),
  			onError : "该手机号码已存在。",
  			onWait : "请稍候..."
  		});
  		$("#shopCompany").formValidator({onShow:"",onFocus:"请输入公司名称",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"公司名称不能为空,请确认"});
  		$("#shopTel").formValidator({onShow:"",onFocus:"请输入店铺电话",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"店铺电话不能为空,请确认"});
  		$("#shopName").formValidator({onShow:"",onFocus:"店铺名称不能超过20个字符",onCorrect:"输入正确"}).inputValidator({min:1,max:40,onError:"店铺名称不符合要求,请确认"});
  		$("#userName").formValidator({onShow:"",onFocus:"请输入店主姓名",onCorrect:"输入正确"}).inputValidator({min:1,max:20,onError:"店主姓名不能为空,请确认"});
  		$("#shopAddress").formValidator({onShow:"",onFocus:"请输入店铺地址",onCorrect:"输入正确"}).inputValidator({min:1,max:120,onError:"店铺地址不能为空,请确认"});
  		$("#areaId3").formValidator({onFocus:"请选择所属地区"}).inputValidator({min:1,onError: "请选择所属地区"});
  		$("#goodsCatId3").formValidator({onFocus:"请选择所属行业"}).inputValidator({min:1,onError: "请选择所属行业"});
  		$("#bankId").formValidator({onFocus:"请选择所属银行"}).inputValidator({min:1,onError: "请选择所属银行"});
		$("#bankNo").formValidator({onShow:"",onFocus:"请输入银行卡号",onCorrect:"输入正确"}).inputValidator({min:16,max:19,onError:"银行卡号格式错误,请确认"});
		
	    ShopMapInit({});
    })
function initTime(objId,val){
   for(var i=0;i<24;i++){
	  $('<option value="'+i+'" '+((val==i)?"selected":'')+'>'+i+':00</option>').appendTo($('#'+objId));
	  $('<option value="'+(i+0.5)+'" '+((val==(i+0.5))?"selected":'')+'>'+i+':30</option>').appendTo($('#'+objId));
   }
}
function isInvoce(v){
   if(v){
	   $('#invoiceRemarkstr').show();
   }else{
	   $('#invoiceRemarkstr').hide();
   }
}
function getAreaListForOpen(objId,parentId,t,id){
	   var params = {};
	   params.parentId = parentId;
	   params.type = t+1;
	   $('#'+objId).empty();
	   if(t<1){
		   $('#areaId3').empty();
		   $('#areaId3').html('<option value="">请选择</option>');
		   if(t==0 && shopMap && $('#areaId2').find("option:selected").text()!=''){
			   shopMap.setCity($('#areaId2').find("option:selected").text());
			   $('#showLevel').val(shopMap.getZoom());
		   }
	   }
	   var html = [];
	   $.post(Think.U('Home/Areas/queryByList'),params,function(data,textStatus){
		    html.push('<option value="">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.areaId+'" '+((id==opts.areaId)?'selected':'')+'>'+opts.areaName+'</option>');
				}
			}
			$('#'+objId).html(html.join(''));
			if(t==0)getCommunitysForOpen();
	   });
}

// 修改开始2015-4-25
function getCommunitysForOpen(){
	  $('#areaTree').empty();
	  var areaId = $('#areaId2').val();
	  $.post(Think.U('Home/Areas/getAreaAndCommunitysByList'),{areaId:areaId},function(data,textStatus){
			var json = data;
			if(json.list){
					var html = [];
					json = json.list;
					for(var i=0;i<json.length;i++){
						communitysCount = 0
						html.push("<dl class='areaSelect' id='"+json[i]['areaId']+"'>");
						html.push("<dt class='ATRoot' id='node_"+json[i]['areaId']+"' isshow='0'><div class='tleft'>"+json[i]['areaName']+"：</div><span> <input type='checkbox' all='1' class='AreaNode' onclick='javascript:selectArea(this)' id='ck_"+json[i]['areaId']+"' value='"+json[i]['areaId']+"'><label for='ck_"+json[i]['areaId']+"' value='"+json[i]['areaId']+"'>全区配送</label></span> <small>(已选<span class='count'>"+communitysCount+"</span>个社区)</small></dt>");
						if(json[i].communitys && json[i].communitys.length){
							html.push('<dd>');
							for(var j=0;j<json[i].communitys.length;j++){
							    html.push("<div class='ATNode' id='node_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"'><input type='checkbox' id='ck_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"' all='0' class='AreaNode' onclick='javascript:selectArea(this)' value='"+json[i].communitys[j]['communityId']+"'><label for='ck_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"'>"+json[i].communitys[j]['communityName']+"</label></div>");
							}
							html.push('</dd>');
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
	count = 0;
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
   function getCatList(objId,parentId,t,id){
 	   var params = {};
 	   params.id = parentId;
 	   $('#'+objId).empty();
 	   if(t<1){
 		   $('#goodsCatId3').empty();
 		   $('#goodsCatId3').html('<option value="">请选择</option>');
 	   }
 	   var html = [];
 	   $.post(Think.U('Home/goodsCats/queryByList'),params,function(data,textStatus){
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
   function showXiey(id){
		layer.open({
		    type: 2,
		    title: '店铺用户注册协议',
		    shadeClose: true,
		    shade: 0.8,
		    area: ['1000px', ($(window).height() - 50) +'px'],
		    content: [Think.U('Home/Index/toUserProtocol')],
		    btn: ['同意并注册'],
		    yes: function(index, layero){
		    	layer.close(index);
		    }
		});
	}	 
   
   
   var time = 0;
   var isSend = false;
   var isUse = false;
   function getVerifyCode(){
   		if($.trim($("#userPhone").val())==''){
   			WST.msg('请输入手机号码!', {icon: 5});
   			return;
   		}
   		if(isSend )return;
   		isSend = true;
   		var params = {};
   		params.userPhone = $.trim($("#userPhone").val());
   		$.post(Think.U('Home/Users/getPhoneVerifyCode'),params,function(data,textStatus){
   			var json = WST.toJson(data);
   			if(json.status==-1){
   				WST.msg('手机号码格式错误!', {icon: 5});
   				time = 0;
   				isSend = false;
   			}else if(json.status==-2){
   				WST.msg('该手机号码已注册!', {icon: 5});
   				time = 0;
   				isSend = false;
   			}else if(json.status==1){
   				time = 120;
   				$('#timeTips').css('width','100px');
   				$('#timeTips').html('获取验证码(120)');
   				$('#mobileCode').val(json.phoneVerifyCode);
   				var task = setInterval(function(){
   					time--;
   					$('#timeTips').html('获取验证码('+time+")");
   					if(time==0){
   						isSend = false;						
   						clearInterval(task);
   						$('#timeTips').html("重新获取验证码");
   					}
   				},1000);
   			}
   		});
   	}

   function regist(){	
   	if($("#nameType").val()==3){
   		if($.trim($("#mobileCode").val())==""){		
   			WST.msg('请输入验证码!', {icon: 5});
   			$("#mobileCode").focus();
   			return;
   		}
   	}else{
   	
   		if($.trim($("#authcode").val())==""){		
   			WST.msg('请输入验证码!', {icon: 5});
   			$("#mobileCode").focus();
   			return;
   		}
   	}

   	if(!document.getElementById("protocol").checked){		
   		WST.msg('必须同意使用协议才允许注册!', {icon: 5});
   		return;
   	}
     	var params = {};
     	params.loginName = $('#loginName').val();
     	params.loginPwd = $('#loginPwd').val();
     	params.userName = $('#userName').val();
	   	params.userPhone = $('#userPhone').val();
	   	params.areaId1 = $('#areaId1').val();
	   	params.areaId2 = $('#areaId2').val();
	   	params.areaId3 = $('#areaId3').val();
	   	params.goodsCatId1 = $('#goodsCatId1').val();
	   	params.goodsCatId2 = $('#goodsCatId2').val();
	   	params.goodsCatId3 = $('#goodsCatId3').val();
	   	params.latitude = $('#latitude').val();
	   	params.longitude = $('#longitude').val();
	   	params.mapLevel = $('#mapLevel').val();
		params.shopTel = $('#shopTel').val();
		params.qqNo = $('#qqNo').val();
	   	params.shopName = $('#shopName').val();
	   	params.shopCompany = $('#shopCompany').val();
	   	params.shopImg = $('#shopImg').val();
	   	params.deliveryStartMoney = $('#deliveryStartMoney').val();
	   	params.deliveryMoney = $('#deliveryMoney').val();
		params.deliveryFreeMoney = $('#deliveryFreeMoney').val();
		params.avgeCostMoney = $('#avgeCostMoney').val();
		params.bankId = $('#bankId').val();
		params.bankNo = $('#bankNo').val();
		params.isInvoice = $("input[name='isInvoice']:checked").val();
		params.invoiceRemarks = $.trim($('#invoiceRemarks').val());
		params.serviceStartTime = $('#serviceStartTime').val();
		params.serviceEndTime = $('#serviceEndTime').val();
		params.shopAtive = $("input[name='shopAtive']:checked").val();
	   	if(params.shopImg==''){
	   		WST.msg('请上传店铺图片!', {icon: 5});
	   		return;
	   	}
	   	if(params.latitude=='' || params.longitude==''){
			   WST.msg('请标注店铺地址!', {icon: 5});
			   return;
		   }
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
		params.relateAreaId=relateArea.join(',');
		params.relateCommunityId=relateCommunity.join(',');
		if(params.relateAreaId=='0' && params.relateCommunityId=='0'){
			 WST.msg('请选择配送区域!', {icon: 5});
			 return;
		}
		if(params.isInvoice==1 && params.invoiceRemarks==''){
			 WST.msg('请输入发票说明!', {icon: 5});
			 return;
		}
		if(parseInt(params.serviceStartTime,10)>parseInt(params.serviceEndTime,10)){
			 WST.msg('开始营业时间不能大于结束营业时间!', {icon: 5});
			 return;
		}
	   	params.shopTel = $('#shopTel').val();
	   	params.shopAddress = $('#shopAddress').val();
	   	params.mobileCode = $.trim($('#mobileCode').val());
	   	params.verify = $.trim($('#authcode').val());
	   	params.protocol = document.getElementById("protocol").checked?1:0;	
	   	$.post(Think.U('Home/Shops/openShop'),params,function(data,textStatus){
	   		var json = WST.toJson(data);
	   		if(json.status>0){
	   			WST.msg('您的开店申请已提交，请等候商城管理员审核!', {icon: 1}, function(){
	   			    location.href=domainURL +'/index.php';
	   			});
	   		}else if(json.status==-2){
	   			WST.msg('登录账号已存在!', {icon: 5});
	   		}else if(json.status==-3){
	   			WST.msg('两次输入密码不一致!');
	   		}else if(json.status==-4){
	   			WST.msg('验证码错误!', {icon: 5});
	   		}else if(json.status==-5){
	   			WST.msg('验证码已超过有效期!', {icon: 5});
	   		}else if(json.status==-6){
	   			WST.msg('必须同意使用协议才允许注册!');
	   		}else if(json.status==-7){
	   			WST.msg('手机号码已存在!', {icon: 5});
	   		}else{
	   			WST.msg('注册失败!', {icon: 5});
	   		}
	   		getVerify();
	   	});
   }
   var shopMap = null;
   var toolBar = null;
   function ShopMapInit(option){
	   var opts = {zoom:$('#mapLevel').val(),longitude:$('#longitude').val(),latitude:$('#latitude').val()};
	   if(shopMap)return;
	   $('#shopMap').show();
	   shopMap = new AMap.Map('mapContainer', {
			view: new AMap.View2D({
				zoom:opts.zoom
			})
	   });
	   if(opts.longitude!='' && opts.latitude){
		   shopMap.setZoomAndCenter(opts.zoom, new AMap.LngLat(opts.longitude, opts.latitude));
		   var marker = new AMap.Marker({
				position: new AMap.LngLat(opts.longitude, opts.latitude), //基点位置
				icon:"http://webapi.amap.com/images/marker_sprite.png"
		   });
		   marker.setMap(shopMap);
	   }
	   shopMap.plugin(["AMap.ToolBar"],function(){		
			toolBar = new AMap.ToolBar();
			shopMap.addControl(toolBar);
			toolBar.show();
	   });
	   
	   AMap.event.addListener(shopMap,'click',function(e){
			shopMap.clearMap();
			$('#longitude').val(e.lnglat.getLng());
			$('#latitude').val(e.lnglat.getLat());
			var marker = new AMap.Marker({
				position: e.lnglat, //基点位置
				icon:"http://webapi.amap.com/images/marker_sprite.png"
			});
			marker.setMap(shopMap);
	   });
	   AMap.event.addListener(shopMap,'zoomchange',function(e){
		   $('#mapLevel').val(this.getZoom());
	   })
   }
   