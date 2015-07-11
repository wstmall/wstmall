
//修改商品购买数量
function changebuynum(goodsId,flag){
	//isBook = 0;
	var num = parseInt($("#buy-num").val(),10)
	var num = num?num:1;
	if(flag==1){
		if(num>1)num = num-1;
	}else if(flag==2){
		num = num+1;
	}	
	jQuery.post(domainURL +"/index.php/Home/Goods/getGoodsStock/" ,{goodsId:goodsId},function(data) {		
		var json = WST.toJson(data);
		if($("#haveGoodsToBuy").attr("display")=="" && json.goodsStock==0){
			$("#haveGoodsToBuy").hide();
			$("#noGoodsToBuy").show();
		}
		if(json.goodsStock>=num){
			num = num>100?100:num;
		}else{
			num = json.goodsStock;	
		}
		$("#buy-num").val(num);		
		var caturl = $("#InitCartUrl").attr("href");
		//alert(caturl.split("gcount")[0]);
		$("#InitCartUrl").attr("href",(caturl.split("&gcount")[0])+"&gcount="+num+"&rnd="+new Date().getTime());
	});
	
}
