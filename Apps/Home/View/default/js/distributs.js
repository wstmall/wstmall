function setDistributType(obj){
	var type = $(obj).val();
	if(type==1){
		$(".wst-order-rate").hide();
	}else{
		$(".wst-order-rate").show();
	}
}

function setRate(){
	var promoterRate= $("#promoterRate").val();
	$("#buyerRate").html(100-promoterRate);
}

function setDistributs(){
	var params = WST.fillForm('.wst-ipt');
	var ll = layer.load('数据处理中，请稍候...');
    $.post(Think.U('Home/Distributs/setDistributs'),params,function(data){
    	layer.close(ll);
    	var json = WST.toJson(data);
		if(json.status>0){
			WST.msg('操作成功');
		}else{
			WST.msg(json.msg, {icon: 5});
		}
   });
}

function queryDistributByPage(){
	var shopCatId1 = $('#shopCatId1').val();
	var shopCatId2 = $('#shopCatId2').val();
	var goodsName = $('#goodsName').val();
	location.href= Think.U('Home/Distributs/queryDistributByPage','goodsName='+goodsName+"&shopCatId1="+shopCatId1+"&shopCatId2="+shopCatId2); 
}

function queryShopDistributMoneys(){
	var params = {};
	params.userName = $('#userName').val();
	params.orderNo = $('#orderNo').val();
	params.startDate = $('#startDate').val();
	params.endDate = $('#endDate').val();
	params.settlementId = $('#settlementId').val();
	location.href= Think.U('Home/Distributs/queryShopDistributMoneys',params); 
}

function queryUserDistributMoneys(){
	var params = {};
	params.userName = $('#userName').val();
	params.orderNo = $('#orderNo').val();
	params.startDate = $('#startDate').val();
	params.endDate = $('#endDate').val();
	location.href= Think.U('Home/Distributs/queryUserDistributMoneys',params); 
}