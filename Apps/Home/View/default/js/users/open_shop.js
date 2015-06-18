   $(function () {
  	 	//展开按钮
   		$("#expendAll").click(function(){
   			if ($(this).prop('checked')==true) {$("dl.areaSelect dd").removeClass('Hide')}
   			else{$("dl.areaSelect dd").addClass('Hide')}
   		})
	   $.formValidator.initConfig({
		   theme:'Default',mode:'AutoTip',formID:"myshop",debug:true,submitOnce:true,onSuccess:function(){
				   edit();
			       return false;
			},onError:function(msg){
		}});
	    $("#shopName").formValidator({onShow:"",onFocus:"店铺名称不能超过20个字符",onCorrect:"输入正确"}).inputValidator({min:1,max:20,onError:"店铺名称不符合要求,请确认"});
		$("#userName").formValidator({onShow:"",onFocus:"请输入店主姓名",onCorrect:"输入正确"}).inputValidator({min:1,max:20,onError:"店主姓名不能为空,请确认"});
		$("#shopCompany").formValidator({onShow:"",onFocus:"请输入公司名称",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"公司名称不能为空,请确认"});
		$("#shopAddress").formValidator({onShow:"",onFocus:"请输入店铺地址",onCorrect:"输入正确"}).inputValidator({min:1,max:120,onError:"店铺地址不能为空,请确认"});
		$("#areaId3").formValidator({onFocus:"请选择所属地区"}).inputValidator({min:1,onError: "请选择所属地区"});
		$("#goodsCatId1").formValidator({onFocus:"请选择所属行业"}).inputValidator({min:1,onError: "请选择所属行业"});
		$("#bankId").formValidator({onFocus:"请选择所属银行"}).inputValidator({min:1,onError: "请选择所属银行"});
		$("#bankNo").formValidator({onShow:"",onFocus:"请输入银行卡号",onCorrect:"输入正确"}).inputValidator({min:16,max:19,onError:"银行卡号格式错误,请确认"}) .functionValidator({fun:luhmCheck,onError:"请输入正确的银行卡号！"});;
		$("#shopImgUpload").uploadify({
		    formData      : {'dir':'shops','width':150,'height':150},
		    buttonText    : '选择图标',
		    fileTypeDesc  : 'Image Files',
	        fileTypeExts  : '*.gif; *.jpg; *.png',
	        swf           : publicurl+'/plugins/uploadify/uploadify.swf',
	        uploader      : rooturl+'/index.php/Home/shops/uploadPic',
	        onUploadSuccess : function(file, data, response) {
	        	var json = WST.toJson(data);
	        	$('#preview').attr('src',rooturl+'/'+json.Filedata.savepath+json.Filedata.savethumbname).show();
	        	$('#shopImg').val(json.Filedata.savepath+json.Filedata.savethumbname);
           }
	    });
		initTime('serviceStartTime','8');
		initTime('serviceEndTime','20');
		getVerify();
  });
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
			if(t==0)getCommunitys();
	   });
  }

  // 修改开始2015-4-25
  function getCommunitys(){
	  $('#areaTree').empty();
	  var areaId = $('#areaId2').val();
	  $.post(rooturl+"/index.php/Home/Areas/queryAreaAndCommunitysByList",{areaId:areaId},function(data,textStatus){
			var json = data;
			if(json.list){
					var html = [];
					json = json.list;
					for(var i=0;i<json.length;i++){
						var isAreaSelected = ($.inArray(json[i]['areaId'],relateArea)>-1)?" checked ":"";
						communitysCount = 0
						if (json[i].communitys) {
							for (var j =json[i].communitys.length - 1; j >= 0; j--) {
								if ($.inArray(json[i].communitys[j]['communityId'],relateCommunity) > -1 ) {communitysCount++;};
							};
						};
						html.push("<dl class='areaSelect' id='"+json[i]['areaId']+"'>");
						html.push("<dt class='ATRoot' id='node_"+json[i]['areaId']+"' isshow='0'>"+json[i]['areaName']+"：<span> <input type='checkbox' all='1' class='AreaNode' onclick='javascript:selectArea(this)' id='ck_"+json[i]['areaId']+"' "+isAreaSelected+" value='"+json[i]['areaId']+"'><label for='ck_"+json[i]['areaId']+"' "+isAreaSelected+" value='"+json[i]['areaId']+"'>全区配送</label></span> <small>(已选<span class='count'>"+communitysCount+"</span>个社区)</small></dt>");
						if(json[i].communitys && json[i].communitys.length){
							for(var j=0;j<json[i].communitys.length;j++){
								var isCommunitySelected = ($.inArray(json[i].communitys[j]['communityId'],relateCommunity)>-1)?" checked ":"";
								isCommunitySelected += (isAreaSelected!='')?" disabled ":"";
							    html.push("<dd id='node_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"'><input type='checkbox' id='ck_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"' all='0' class='AreaNode' "+isCommunitySelected+" onclick='javascript:selectArea(this)' value='"+json[i].communitys[j]['communityId']+"'><label for='ck_"+json[i]['areaId']+"_"+json[i].communitys[j]['communityId']+"'>"+json[i].communitys[j]['communityName']+"</label></dd>");
							}
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
	//修改结束 2015-4-25
  function edit(){
	   var params = {};
	   params.userName = $('#userName').val();
	   params.shopName = $('#shopName').val();
	   params.shopCompany = $('#shopCompany').val();
	   params.shopImg = $('#shopImg').val();
	   params.shopTel = $('#shopTel').val();
	   params.areaId1 = $('#areaId1').val();
	   params.areaId2 = $('#areaId2').val();
	   params.areaId3 = $('#areaId3').val();
	   params.goodsCatId1 = $('#goodsCatId1').val();
	   params.shopAddress = $('#shopAddress').val();
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
	   params.verify = $('#authcode').val();
	   if(params.shopImg==''){
		   layer.msg('请上传店铺图片!', 1, 8);
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
		   layer.msg('请选择配送区域!', 1, 8);
		   return;
	   }
	   if(params.isInvoice==1 && params.invoiceRemarks==''){
		   layer.msg('请输入发票说明!', 1, 8);
		   return;
	   }
	   if(parseInt(params.serviceStartTime,10)>parseInt(params.serviceEndTime,10)){
		   layer.msg('开始营业时间不能大于结束营业时间!', 1, 8);
		   return;
	   }
	   if(!document.getElementById('protocol').checked){
		   layer.msg('必须同意使用协议才允许注册!');
		   return;
	   }
	   if(params.verify==''){
		   layer.msg('请输入验证码!');
		   return;
	   }
	   layer.load('正在处理，请稍后...', 3);
	   $.post(rooturl+"/index.php/Home/Shops/openShopByUser",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				layer.msg('您的开店申请已提交，请等候商城管理员审核!', 1,1, function(){
					location.href=rooturl+'/index.php/Home/Orders/queryByPage';
				});
			}else if(json.status==-4){
				layer.msg('验证码错误!', 1, 8);
				getVerify();
			}else if(json.status==-5){
				layer.msg('验证码已超过有效期!', 1, 8);
				getVerify();
			}else{
				layer.msg('操作您的开店申请失败，请联系商城管理员!', 1, 8);
				getVerify();
			}
		});
  }

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
  function showXiey(id){
  	$.layer({
  	    type: 2,
  	    shadeClose: true,
  	    title: false,
  	    closeBtn: [0, false],
  	    shade: [0.8, '#000'],
  	    border: [0],
  	    offset: ['20px',''],
  	    area: ['1000px', ($(window).height() - 50) +'px'],
  	    iframe: {src: rooturl+'/'}
  	});
  }