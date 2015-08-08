$(function () { 
    	 getVerify();
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
  		$("#shopName").formValidator({onShow:"",onFocus:"店铺名称不能超过20个字符",onCorrect:"输入正确"}).inputValidator({min:1,max:20,onError:"店铺名称不符合要求,请确认"});
  		$("#userName").formValidator({onShow:"",onFocus:"请输入店主姓名",onCorrect:"输入正确"}).inputValidator({min:1,max:20,onError:"店主姓名不能为空,请确认"});
  		$("#shopAddress").formValidator({onShow:"",onFocus:"请输入店铺地址",onCorrect:"输入正确"}).inputValidator({min:1,max:120,onError:"店铺地址不能为空,请确认"});
  		$("#areaId3").formValidator({onFocus:"请选择所属地区"}).inputValidator({min:1,onError: "请选择所属地区"});
  		$("#goodsCatId3").formValidator({onFocus:"请选择所属行业"}).inputValidator({min:1,onError: "请选择所属行业"});
		$("#shopImgUpload").uploadify({
  		    formData      : {'dir':'shops','width':500,'height':500},
  		    buttonText    : '选择图标',
  		    fileTypeDesc  : 'Image Files',
  	        fileTypeExts  : '*.gif; *.jpg; *.png',
  	        swf           : publicurl+'/plugins/uploadify/uploadify.swf',
  	        uploader      : Think.U('Home/shops/uploadPic'),
  	        onUploadSuccess : function(file, data, response) {
  	        	var json = WST.toJson(data);
  	        	var url = domainURL +'/'+json.Filedata.savepath+json.Filedata.savethumbname;
  	        	$('#preview').attr('src',url).show();
  	        	$('#shopImg').val(json.Filedata.savepath+json.Filedata.savename);
  	        	$('#preview').adjustImgage({width:150,height:150});
              }
  	    });
		$("#shopImgUpload2").uploadify({
  		    formData      : {'dir':'shops','width':500,'height':500},
  		    buttonText    : '选择图标',
  		    fileTypeDesc  : 'Image Files',
  	        fileTypeExts  : '*.gif; *.jpg; *.png',
  	        swf           : publicurl+'/plugins/uploadify/uploadify.swf',
  	        uploader      : Think.U('Home/shops/uploadPic'),
  	        onUploadSuccess : function(file, data, response) {
  	        	var json = WST.toJson(data);
  	        	var url = domainURL +'/'+json.Filedata.savepath+json.Filedata.savethumbname;
  	        	$('#preview2').attr('src',url).show();
  	        	$('#shopImg2').val(json.Filedata.savepath+json.Filedata.savename);
  	        	$('#preview2').adjustImgage({width:150,height:150});
              }
  	    });
	    $("#shopImgUpload").uploadify({
		    formData      : {'dir':'shops','width':150,'height':150},
		    buttonText    : '选择图标',
		    fileTypeDesc  : 'Image Files',
	        fileTypeExts  : '*.gif; *.jpg; *.png',
	        swf           : publicurl+'/plugins/uploadify/uploadify.swf',
	        uploader      : Think.U('Home/shops/uploadPic'),
	        onUploadSuccess : function(file, data, response) {
	        	var json = WST.toJson(data);
	        	var url = domainURL +'/'+json.Filedata.savepath+json.Filedata.savethumbname;
	        	$('#preview').attr('src',url).show();
	        	$('#shopImg').val(json.Filedata.savepath+json.Filedata.savename);
	        }
	    });
    })
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
			if(json.status=='1' && json.list && json.list.length>0){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.areaId+'" '+((id==opts.areaId)?'selected':'')+'>'+opts.areaName+'</option>');
				}
			}
			$('#'+objId).html(html.join(''));
	   });
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
		    title: 'WST用户注册协议',
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
   			alert('请输入手机号码!');
   			return;
   		}
   		if(isSend )return;
   		isSend = true;
   		var params = {};
   		params.userPhone = $.trim($("#userPhone").val());
   		$.post(Think.U('Home/Users/getPhoneVerifyCode'),params,function(data,textStatus){
   			var json = WST.toJson(data);
   			if(json.status==-1){
   				alert('手机号码格式错误!');
   				time = 0;
   				isSend = false;
   			}else if(json.status==-2){
   				alert('该手机号码已注册!');
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
   			alert('请输入验证码!');
   			$("#mobileCode").focus();
   			return;
   		}
   	}else{
   	
   		if($.trim($("#authcode").val())==""){		
   			alert('请输入验证码!');
   			$("#mobileCode").focus();
   			return;
   		}
   	}

   	if(!document.getElementById("protocol").checked){		
   		alert('必须同意使用协议才允许注册!');
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
	   	params.shopName = $('#shopName').val();
	   	params.shopCompany = $('#shopCompany').val();
	   	params.shopImg = $('#shopImg').val();
	   	if(params.shopImg==''){
	   		WST.msg('请上传店铺图片!', {icon: 5});
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
   