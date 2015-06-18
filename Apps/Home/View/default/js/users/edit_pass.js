 $(function () {
	   $.formValidator.initConfig({
		   theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
				   edit();
			       return false;
			},onError:function(msg){
		}});
	   $("#oldPass").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:6,max:20,onError:"密码长度为6到20位"});
	   $("#newPass").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:6,max:20,onError:"新密码长度为6到20位"});
	   $("#reNewPass").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:6,max:20,onError:"新密码长度为6到20位"}).compareValidator({desID:"newPass",operateor:"=",onError:"2次密码不一致,请确认"});

   });
   function edit(){
	   var params = {};
	   params.oldPass = $('#oldPass').val();
	   params.newPass = $('#newPass').val();
	   params.reNewPass = $('#reNewPass').val();
	   $.post(rooturl+"/index.php/Home/Users/editPass",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				layer.msg('密码修改成功!', 1,1, function(){
					location.reload();
				});
			}else{
				layer.msg('密码修改失败!', 1, 8);
			}
	   });
   }