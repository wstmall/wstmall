$(function () {
	   $.formValidator.initConfig({
		   theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
				   edit();
			       return false;
			},onError:function(msg){
		}});
	   $("#userName").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:6,max:20,onError:"用户昵称长度为6到20位"});
	   $("#userPhone").inputValidator({min:0,max:25,onError:"你输入的手机号码非法,请确认"}).regexValidator({
			regExp:"mobile",dataType:"enum",onError:"手机号码格式错误"
		}).ajaxValidator({
			dataType : "json",
			async : true,
			url : domainURL+"/index.php/Home/Users/checkLoginKey/",
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
		}).defaultPassed().unFormValidator(true);
		$("#userEmail").inputValidator({min:0,max:25,onError:"你输入的邮箱长度非法,请确认"}).regexValidator({
		       regExp:"email",dataType:"enum",onError:"邮箱格式错误"
			}).ajaxValidator({
				dataType : "json",
				async : true,
				url : domainURL+"/index.php/Home/Users/checkLoginKey/",
				success : function(data){
					var json = WST.toJson(data);
		            if( json.status == "1" ) {
		                return true;
					} else {
		                return false;
					}
					return "该电子邮箱已被使用";
				},
				buttons: $("#dosubmit"),
				onError : "该邮箱已存在。",
				onWait : "请稍候..."
			}).defaultPassed().unFormValidator(true);
		$("#userPhone").blur(function(){
			  if($("#userPhone").val()==''){
				  $("#userPhone").unFormValidator(true);
			  }else{
				  $("#userPhone").unFormValidator(false);
			  }
		});
		$("#userEmail").blur(function(){
			  if($("#userEmail").val()==''){
				  $("#userEmail").unFormValidator(true);
			  }else{
				  $("#userEmail").unFormValidator(false);
			  }
		});
	   $("#userImgUpload").uploadify({
		    formData      : {'dir':'users','width':150,'height':150},
		    buttonText    : '选择图标',
		    fileTypeDesc  : 'Image Files',
	        fileTypeExts  : '*.gif; *.jpg; *.png',
	        swf           : publicurl+'/plugins/uploadify/uploadify.swf',
	        uploader      : domainURL+'/index.php/Home/Users/uploadPic',
	        onUploadSuccess : function(file, data, response) {
	        	var json = WST.toJson(data);
	        	$('#preview').attr('src',domainURL +'/'+json.Filedata.savepath+json.Filedata.savethumbname).show();
	        	$('#userPhoto').val(json.Filedata.savepath+json.Filedata.savename);
          }
	    });
   });
   function edit(){
	   var params = {};
	   params.userName = $.trim($('#userName').val());
	   params.userQQ = $.trim($('#userQQ').val());
	   params.userPhone = $.trim($('#userPhone').val());
	   params.userEmail = $.trim($('#userEmail').val());
	   params.userSex = $('input:radio[name="userSex"]:checked').val();
	   params.userPhoto =  $.trim($('#userPhoto').val());		
	   var ll = layer.load('数据处理中，请稍候...');
	   $.post(domainURL+"/index.php/Home/Users/editUser",params,function(data,textStatus){
		   layer.close(ll);
			var json = WST.toJson(data);
			if(json.status=='1'){
				WST.msg('修改用户资料成功!', {icon: 1});
				location.reload();
			}else if(json.status=='-2'){
				WST.msg('用户手机已存在!', {icon: 5});
			}else if(json.status=='-3'){
				WST.msg('用户邮箱已存在!', {icon: 5});
			}else{
				WST.msg('修改用户资料失败!', {icon: 5});
			}
	   });
   }