
 /** ***********************start************************ */
$(function() {
	//head 弹出菜单部分
	$(".pcate").click(function(){
		var cname = $(this).attr("data");
			if($("#"+cname+"-s").attr("class")=="span2"){
				$("#"+cname+"-s").attr("class","span1");
			}else{
				$("#"+cname+"-s").attr("class","span2");
			}
		$("."+cname+"-c").toggle(100);
		
	});
	
});

/**
 * 加入购物车
 */
/*function addCart(goodsId,type){
	jQuery.post(domainURL +"/index.php/Home/Cart/addToCartAjax/?goodsId="+goodsId+'&gcount=1&rnd='+Math.random() ,{goodsId:goodsId},function(data) {
		if(type==1){
			location.href=domainURL +'/index.php/Home/Cart/toCart';
		}else{
			layer.msg("添加成功!",3000,30);
		}
	});
}*/

function searchShopsGoods(obj){
	
	if(obj==4){
		var sj = $("#sj").val();
		if(sj==2){
			$("#sj").val(1);
			$("#msort").val(4);
		}else{
			$("#sj").val(2);
			$("#msort").val(5);
		}		
	}else{
		$("#sj").val(0);
		$("#msort").val(obj);
	}	
	var params = new Array();
	params.push("msort=" + $("#msort").val());
	params.push("sj=" + $("#sj").val());	
	params.push("sprice=" + $("#sprice").val());
	params.push("eprice=" + $("#eprice").val());
	params.push("shopId=" + $("#shopId").val());
	params.push("ct1=" + $("#ct1").val());
	params.push("ct2=" + $("#ct2").val());
	params.push("goodsName=" + $("#goodsName").val());
	document.location.href = domainURL +"/index.php/Home/Shops/toShopHome/?"+params.join("&");

}

function searchwst(){
	var goodsName = $.trim($("#goodsName").val());
	window.location = domainURL  + '/index.php/Home/goods/getGoodsList/?searchType=2&keyWords=' + encodeURIComponent(goodsName);
	
}
