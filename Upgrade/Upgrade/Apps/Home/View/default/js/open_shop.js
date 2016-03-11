function visitorShopInit(){
    	 if(WST.PHONE_VERFY=='0')getVerify();
    	 initTime('serviceStartTime','8');
 		 initTime('serviceEndTime','20');
    	 $.formValidator.initConfig({
  		   theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
  			  visitorOpenShop();
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
  		$("#shopName").formValidator({onShow:"",onFocus:"店铺名称不能超过20个字符",onCorrect:"输入正确"}).inputValidator({min:1,max:40,onError:"店铺名称长度不符合要求,请确认"}).ajaxValidator({
			dataType : "json",
			async : true,
			url : Think.U('Home/Shops/checkShopName'),
			success : function(data){
				var json = WST.toJson(data);
	            if( json.status == "1" ) {
	                return true;
				} else {
	                return false;
				}

			},
			buttons: $("#dosubmit"),
			onError : "该店铺名称已被使用",
			onWait : "请稍候..."
		});
  		$("#userName").formValidator({onShow:"",onFocus:"请输入店主姓名",onCorrect:"输入正确"}).inputValidator({min:1,max:20,onError:"店主姓名不能为空,请确认"});
  		$("#shopAddress").formValidator({onShow:"",onFocus:"请输入店铺地址",onCorrect:"输入正确"}).inputValidator({min:1,max:120,onError:"店铺地址不能为空,请确认"});
  		$("#areaId3").formValidator({onFocus:"请选择所属地区"}).inputValidator({min:1,onError: "请选择所属地区"});
  		$("#goodsCatId3").formValidator({onFocus:"请选择所属行业"}).inputValidator({min:1,onError: "请选择所属行业"});
  		$("#bankId").formValidator({onFocus:"请选择所属银行"}).inputValidator({min:1,onError: "请选择所属银行"});
		$("#bankNo").formValidator({onShow:"",onFocus:"请输入银行卡号",onCorrect:"输入正确"}).inputValidator({min:16,max:19,onError:"银行卡号格式错误,请确认"});
		var uploading = null;
		uploadFile({
	    	  server:Think.U('Home/Shops/uploadPic'),pick:'#filePicker',
	    	  formData: {dir:'shops'},
	    	  callback:function(f){
	    		  layer.close(uploading);
	    		  var json = WST.toJson(f);
	    		  $('#preview').attr('src',WST.DOMAIN+"/"+json.file.savepath+json.file.savethumbname);
	    		  $('#shopImg').val(json.file.savepath+json.file.savename);
	    		  $('#preview').show();
		      },
		      progress:function(rate){
		    	  uploading = WST.msg('正在上传图片，请稍后...');
		      }
	    });
	    ShopMapInit({});
}
function initTime(objId,val){
   for(var i=0;i<24;i++){
	  $('<option value="'+i+'" '+((val==i)?"selected":'')+'>'+i+':00</option>').appendTo($('#'+objId));
	  $('<option value="'+(i+0.5)+'" '+((val==(i+0.5))?"selected":'')+'>'+i+':30</option>').appendTo($('#'+objId));
   }
}
function getAreas(obj,id,val,fval,callback){
	var params = {};
	params.parentId = id;
	$("#"+obj).empty();
	var s = [];
	if(fval!=''){
		s = fval.split(',');
		for(var i=0;i<s.length;i++){
			$("#"+s[i]).empty();
			$("#"+s[i]).html("<option value=''>请选择</option>");
		}
	}
	$.post(Think.U('Home/Areas/queryByList'),params,function(data,textStatus){
		var json = WST.toJson(data);
		if(json.status==1 && json.list){
			var opts,html=[];
			html.push("<option value=''>请选择</option>");
			for(var i=0;i<json.list.length;i++){
				opts = json.list[i];
				html.push('<option value="'+opts.areaId+'" '+((val==opts.areaId)?'selected':'')+'>'+opts.areaName+'</option>');
			}
			$("#"+obj).html(html.join(''));
			if(typeof(callback)=='function')callback();
		}
	});
}
// 修改开始2015-4-25
function getCommunityForOpen(){
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
						html.push("<dt class='ATRoot' id='node_"+json[i]['areaId']+"' isshow='0'><span class='tleft'>"+json[i]['areaName']+"：</span><span> <input type='checkbox' all='1' class='AreaNode' onclick='javascript:selectArea(this)' id='ck_"+json[i]['areaId']+"' value='"+json[i]['areaId']+"'><label for='ck_"+json[i]['areaId']+"' value='"+json[i]['areaId']+"'>全区配送</label></span> <small>(已选<span class='count'>"+communitysCount+"</span>个社区)</small></dt>");
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
  		if(WST.SMS_VERFY=='1'){
  			var html = [];
  			html.push('<table class="wst-smsverfy"><tr><td width="80" align="right">');
  			html.push('验证码：</td><td><input type="text" id="smsVerfy" size="12" class="wst-text" maxLength="8">');
  			html.push('<img style="vertical-align:middle;cursor:pointer;height:39px;" class="verifyImg" src="'+WST.DOMAIN+'/Apps/Home/View/default/images/clickForVerify.png" title="刷新验证码" onclick="javascript:getVerify()"/>');
  			html.push('</td></tr></table>');
  			layer.open({
  				title:'请输入验证码',
  			    type: 1,
  			    area: ['420px', '160px'], //宽高
  			    content: html.join(''),
  			    btn: ['发送验证码', '取消'],
  			    success: function(layero, index){
  			    	getVerify();
  			    },
  			    yes: function(index, layero){
  			    	isSend = true;
  			    	params.smsVerfy = $.trim($('#smsVerfy').val());
  			    	WST.msg('正在发送短信，请稍后...',{time:600000});
  			    	$.post(Think.U('Home/Users/getPhoneVerifyCode'),params,function(data,textStatus){
  			   			var json = WST.toJson(data);
  			   			if(json.status!=1){
  							WST.msg(json.msg, {icon: 5});
  							time = 0;
  							isSend = false;
  							getVerify();
  						}if(json.status==1){
  							WST.msg('短信已发送，请注册查收');
  							layer.close(index);
  			   				time = 130;
  			   				$('#timeTips').css('width','100px');
  			   				$('#timeTips').html('获取验证码(130)');
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
  			    },
  			    cancel:function(){
  			    	isSend = false;
  			    }
  			});
  		}else{
  			isSend = true;
  			WST.msg('正在发送短信，请稍后...',{time:600000});
  			$.post(Think.U('Home/Users/getPhoneVerifyCode'),params,function(data,textStatus){
		   			var json = WST.toJson(data);
		   			if(json.status!=1){
						WST.msg(json.msg, {icon: 5});
						time = 0;
						isSend = false;
					}if(json.status==1){
						WST.msg('短信已发送，请注册查收');
		   				time = 130;
		   				$('#timeTips').css('width','100px');
		   				$('#timeTips').html('获取验证码(130)');
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
  	}

function visitorOpenShop(){	
	if(WST.PHONE_VERFY=='1'){
	   	if($.trim($("#mobileCode").val())==""){		
	   		WST.msg('请输入验证码!', {icon: 5});
	   		$("#mobileCode").focus();
	   		return;
	   	}
	}else{
		if($.trim($("#verify").val())==""){		
	   		WST.msg('请输入验证码!', {icon: 5});
	   		$("#verify").focus();
	   		return;
	   	}
	}

   	if(!document.getElementById("protocol").checked){		
   		WST.msg('必须同意使用协议才允许注册!', {icon: 5});
   		return;
   	}
   	var params = WST.fillForm('.wstipt');
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
	params.protocol = document.getElementById("protocol").checked?1:0;	
	$.post(Think.U('Home/Shops/openShop'),params,function(data,textStatus){
	   	var json = WST.toJson(data);
	   	if(json.status>0){
	   		WST.msg('您的开店申请已提交，请等候商城管理员审核!', {icon: 1}, function(){
	   			location.href=WST.DOMAIN +'/index.php';
	   		});
	   	}else{
	   		if(WST.PHONE_VERFY=='0')getVerify();
	   		WST.msg(json.msg, {icon: 5});
	   	}
	   		
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
function userShopInit(){
   $("#expendAll").click(function(){
			if ($(this).prop('checked')==true) {$("dl.areaSelect dd").removeClass('Hide')}
			else{$("dl.areaSelect dd").addClass('Hide')}
		})
   $.formValidator.initConfig({
	   theme:'Default',mode:'AutoTip',formID:"myshop",debug:true,submitOnce:true,onSuccess:function(){
		   userOpenShop();
		   return false;
		},onError:function(msg){
	}});
    $("#shopName").formValidator({onShow:"",onFocus:"店铺名称不能超过20个字符",onCorrect:"输入正确"}).inputValidator({min:1,max:40,onError:"店铺名称长度不符合要求,请确认"}).ajaxValidator({
			dataType : "json",
			async : true,
			url : Think.U('Home/Shops/checkShopName'),
			success : function(data){
				var json = WST.toJson(data);
	            if( json.status == "1" ) {
	                return true;
				} else {
	                return false;
				}

			},
			buttons: $("#dosubmit"),
			onError : "该店铺名称已被使用",
			onWait : "请稍候..."
		});
	$("#userName").formValidator({onShow:"",onFocus:"请输入店主姓名",onCorrect:"输入正确"}).inputValidator({min:1,max:20,onError:"店主姓名不能为空,请确认"});
	$("#shopCompany").formValidator({onShow:"",onFocus:"请输入公司名称",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"公司名称不能为空,请确认"});
	$("#shopTel").formValidator({onShow:"",onFocus:"请输入店铺电话",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"店铺电话不能为空,请确认"});
	$("#shopAddress").formValidator({onShow:"",onFocus:"请输入店铺地址",onCorrect:"输入正确"}).inputValidator({min:1,max:120,onError:"店铺地址不能为空,请确认"});
	$("#areaId3").formValidator({onFocus:"请选择所属地区"}).inputValidator({min:1,onError: "请选择所属地区"});
	$("#goodsCatId1").formValidator({onFocus:"请选择所属行业"}).inputValidator({min:1,onError: "请选择所属行业"});
	$("#bankId").formValidator({onFocus:"请选择所属银行"}).inputValidator({min:1,onError: "请选择所属银行"});
	$("#bankNo").formValidator({onShow:"",onFocus:"请输入银行卡号",onCorrect:"输入正确"}).inputValidator({min:16,max:19,onError:"银行卡号格式错误,请确认"});
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
	initTime('serviceStartTime','8');
	initTime('serviceEndTime','20');
	if(WST.PHONE_VERFY=='0')getVerify();
	var uploading = null;
	uploadFile({
    	  server:Think.U('Home/Shops/uploadPic'),pick:'#filePicker',
    	  formData: {dir:'shops'},
    	  callback:function(f){
    		  layer.close(uploading);
    		  var json = WST.toJson(f);
    		  $('#preview').attr('src',WST.DOMAIN+"/"+json.file.savepath+json.file.savethumbname);
    		  $('#shopImg').val(json.file.savepath+json.file.savename);
    		  $('#preview').show();
	      },
	      progress:function(rate){
	    	  uploading = WST.msg('正在上传图片，请稍后...');
	      }
    });
	ShopMapInit({});
}
function userOpenShop(){
	var params = WST.fillForm('.wstipt');
	if(params.latitude=='' || params.longitude==''){
		 WST.msg('请标注店铺地址!', {icon: 5});
		 return;
	}
	if(params.shopImg==''){
		 WST.msg('请上传店铺图片!', {icon: 5});
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
	if(!document.getElementById('protocol').checked){
		WST.msg('必须同意使用协议才允许注册!',{icon: 5});
		return;
	}
	if(params.mobileCode==''){
		WST.msg('请输入验证码!',{icon: 5});
		return;
	}
	var ll = layer.load('正在处理，请稍后...', 3);
	$.post(Think.U('Home/Shops/openShopByUser'),params,function(data,textStatus){
		var json = WST.toJson(data);
		if(json.status=='1'){
			WST.msg('您的开店申请已提交，请等候商城管理员审核!', {icon: 1}, function(){
				location.href=Think.U('Home/Orders/queryByPage');
			});
		}else{
			WST.msg(json.msg, {icon: 5});
			if(WST.PHONE_VERFY=='0')getVerify();
		}
		layer.close(ll);
   });
}
