 function edit(){
	   var params = {};
	   params.id = $('#id').val();
	   params.areaId1 = $('#areaId1').val();
	   params.areaId2 = $('#areaId2').val();
	   params.areaId3 = $('#areaId3').val();
	   params.communityId = $('#communityId').val();
	   params.postCode = $('#postCode').val();
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
		if(params.postCode!="" && params.postCode.length!=6){
			WST.msg("邮编格式不正确", {icon: 5});
			return;
		}
	   
	   $.post(domainURL +"/index.php/Home/UserAddress/edit",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status>0){
				WST.msg('操作成功!', {icon: 1}, function(){
					location.href=domainURL +'/index.php/Home/UserAddress/queryByPage';
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
	   $.post(domainURL +"/index.php/Home/Areas/queryByList",params,function(data,textStatus){
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
	   $.post(domainURL +"/index.php/Home/Communitys/getByDistrict",params,function(data,textStatus){
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
   
   
   /*************************list*************************/
   
   function toEdit(id){
	    location.href=domainURL +'/index.php/Home/UserAddress/toEdit/?id='+id; 
	}
	function del(id){
		layer.confirm("您确定要删除该地址吗？",{icon: 3, title:'系统提示'},function(tips){
			var ll = layer.load('数据处理中，请稍候...');
			$.post(domainURL +'/index.php/Home/UserAddress/del/',{id:id},function(data,textStatus){
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