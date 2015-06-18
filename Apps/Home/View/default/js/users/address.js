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
			layer.msg("收货人姓名长度必须大于1个汉字", 1, 8);
			return ;	
		}
	   	if(params.areaId1<1){
			layer.msg("请选择省", 1, 8);
			return ;		
		}
		if(params.areaId2<1){
			layer.msg("请选择市", 1, 8);
			return ;		
		}
		if(params.areaId3<1){
			layer.msg("请选择区县", 1, 8);
			return ;		
		}
		if(params.communityId<1){
			layer.msg("请选择社区", 1, 8);
			return ;		
		}
		if(params.address==""){
			layer.msg("请输入详细地址", 1, 8);
			return ;		
		}
		if(params.userPhone=="" && params.userTel==""){
			layer.msg("请输入手机号码或固定电话", 1, 8);
			return ;		
		}
		if(params.userPhone!="" && !WST.isPhone(params.userPhone)){
			layer.msg("手机号码格式错误", 1, 8);
			return ;		
		}
		if(params.userTel!="" && !WST.isTel(params.userTel)){
			layer.msg("固定电话格式错误", 1, 8);
			return ;		
		}	
		if(params.postCode!="" && params.postCode.length!=6){
			layer.msg("邮编格式不正确", 1, 8);
			return;
		}
	   
	   $.post(rooturl+"/index.php/Home/UserAddress/edit",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status>0){
				layer.msg('操作成功!', 1,1, function(){
					location.href=rooturl+'/index.php/Home/UserAddress/queryByPage';
				});
			}else{
				layer.msg(' 操作失败!',1,8);
			}
	   });
   }
   function getAreaList(objId,parentId,t,id){
	   var params = {};
	   params.parentId = parentId;
	   $('#'+objId).empty();
	   if(t<1){
		   $('#areaId3').empty();
		   $('#areaId3').html('<option value="">请选择</option>');
	   }
	   var html = [];
	   $.post(rooturl+"/index.php/Home/Areas/queryByList",params,function(data,textStatus){
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
	   params.areaId = v;
	   $('#communityId').empty();
	   var html = [];
	   $.post(rooturl+"/index.php/Home/Communitys/queryByListByArea",params,function(data,textStatus){
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
	    location.href=rooturl+'/index.php/Home/UserAddress/toEdit/?id='+id; 
	}
	function del(id){
		layer.confirm("您确定要删除该地址吗？",function(){
			$.post(rooturl+'/index.php/Home/UserAddress/del/',{id:id},function(data,textStatus){
				var json = WST.toJson(data);
				if(json.status=='1'){
					layer.msg('操作成功!', 1,1, function(){
					   location.reload();
					});
				}else{
					layer.msg('操作失败!', 1, 8);
				}
			});
		});
	}