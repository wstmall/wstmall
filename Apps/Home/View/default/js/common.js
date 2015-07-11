

$(function() {
	checkCart();
	//head 弹出菜单部分
    var cateMenu2 = function () {
        var cateLiNum = $(".cateMenu2 li").length;
        $(".cateMenu2 li").each(function (index, element) {
            if (index < cateLiNum - 1) {
                $(this).mouseenter(function () {
                    var ty = $(this).offset().top - 200;
                    var obj = $(this).find(".list-item");
                    var sh = document.documentElement.scrollTop || document.body.scrollTop;
                    var oy = ty + (obj.height() + 30) + 158 - sh;
                    var dest = oy - $(window).height()
                    if (oy > $(window).height()) {
                        ty = ty - dest - 10;
                    }
                    if (ty < 0) ty = 0;
                    $(this).addClass("on");
                    obj.show();
                    $(".cateMenu2 li").find(".list-item").stop().animate({ "top": ty });
                    obj.stop().animate({ "top": ty });
                    $(".wst-nvgbk").css("top",index*60);
                    $(".wst-nvgbk").show();
                })
                $(this).mouseleave(function () {
                    $(this).removeClass("on");
                    $(this).find(".list-item").hide();
                    $(".wst-nvgbk").hide();
                })
            }
        });

        $(".navCon_on").hover(function () {
            $(".cateMenu2").show();
        },
		function () {
		    $(".cateMenu2").hide();
		})

    } ();
	$("#wst-nvg-cart").mouseover(function(){
		checkCart();
	});
	$("#wst-nvg-cart").click(function(){
		$(".wst-cart-box").toggle();
	});
	
	$(".wst-cart-box").hover(function() {
		
	}, function() {
		$(".wst-cart-box").hide();
	});
	
	$("#wst-panel-goods").click(function(){
		$("#wst-search-type").val(1);
		$("#wst-panel-goods").css({"background-color":"#E23C3D","border":"1px solid red","color":"#ffffff"});
		$("#wst-panel-shop").css({"background-color":"#F3F3F3","border":"0","color":"#000000"});
		$("#keyword").val("");
		$("#keyword").attr("placeholder","搜索 商品");
	});
	$("#wst-panel-shop").click(function(){
		$("#wst-search-type").val(2);
		$("#wst-panel-shop").css({"background-color":"#E23C3D","border":"1px solid red","color":"#ffffff"});
		$("#wst-panel-goods").css({"background-color":"#F3F3F3","border":"0","color":"#000000"});
		$("#keyword").val("");
		$("#keyword").attr("placeholder","搜索 店铺");
	});
	
	var view = $(window);
	var scrollTimer, resizeTimer, minWidth = 1350;
	function resizeHandler(){
		clearTimeout(scrollTimer);
		scrollTimer = setTimeout(checkScroll, 10);
	}
	
	function checkScroll(){
		if(view.scrollTop()>500){
			if(!$("#mainsearchbox").hasClass("wst-fixedsearch")){
				$("#wst-search-type-box").hide();
				$("#wst-logo").height(60);
				$("#wst-searchbox").css({"margin-top":"10px"});
				$("#wst-search-des-container .des-box").css({"margin-top":"10px"});
				$("#mainsearchbox").addClass("wst-fixedsearch").height(0).animate({height:60},300);
			}
		} else{
			if($("#wst-logo").height()<132){
				//$("#mainsearchbox").removeClass("wst-fixedsearch").animate({height:0},1000);
				$("#wst-search-type-box").show();
				$("#wst-logo").height(132);
				$("#wst-searchbox").css({"margin-top":"60px"});
				$("#wst-search-des-container .des-box").css({"margin-top":"50px"});
				$("#mainsearchbox").removeClass("wst-fixedsearch");
			}
		}
	}
	view.bind('scroll', resizeHandler);
	//checkScroll();
});

function checkCart(){
	jQuery.post(domainURL +"/index.php/Home/Cart/getCartInfo/" ,{"axm":1},function(data) {
		var cart = WST.toJson(data);	
		var html = new Array();
		for(var i=0;i<cart.cartgoods.length;i++){
			var goods = cart.cartgoods[i];
			if(i<cart.cartgoods.length-1){
				html.push("<div style='border-bottom:1px dotted #E13335'>");
			}else{
				html.push("<div>");
			}
			
			html.push(  "<div style='float:left;'>" +
								"<a href='"+domainURL +"/index.php/Home/Goods/getGoodsDetails/?goodsId="+goods.goodsId+"'><img src='"+domainURL +"/"+goods.goodsThums+"' width='65' height='65'/></a>" +
						"</div>" +
						"<div style='float:left;width:280px;padding:4px;'>" +
								"<a target='_blank' href='"+domainURL +"/index.php/Home/Goods/getGoodsDetails/?goodsId="+goods.goodsId+"'>"+goods.goodsName+"</a><br/>￥"+goods.shopPrice+"元<br/>数量："+goods.cnt+"" +
						"</div><div style='clear:both;'></div>" +
						"</div>"
					);
			if(i==cart.cartgoods.length-1){
				html.push(  "<div id='wst-topay' style='text-align:right;'><li onclick='topay();'></li></div>");
			}
		}
	
		if(cart.cartgoods.length>0){
			$(".wst-nvg-cart-cnt").html(cart.cartgoods.length);
			$(".wst-nvg-cart-price").html(cart.totalMoney);
			$(".wst-cart-box").html(html.join(""));
		}else{
			
			$(".wst-nvg-cart-cnt").html("0");
			$(".wst-nvg-cart-price").html("0.00");
			$(".wst-cart-box").html("<div style='line-height:100px;text-align:center;font-size:18px;'>购物车中暂无商品</div>");
		}
	});
}
function topay(){
	location.href=domainURL +"/index.php/Home/Cart/getCartInfo/?rnd="+Math.round(Math.random()*10000000);
}

function changeCity(areaId2){
	if(areaId2){
		jQuery.post(domainURL +"/index.php/Home/Index/reChangeCity" ,{"city":areaId2,"changeCity":true},function(data) {
			var currurl = location.href;
			if(currurl.indexOf("changeCity")!=-1){
				location.href = domainURL +"/index.php";
			}else{
				location.href = location.href;
			}
		});
	}else{
		location.href=domainURL +"/index.php/Home/Index/changeCity";
	}
}

function addToFavorite(){
	var a=domainURL ,b="收藏WST MALL";
	document.all?window.external.AddFavorite(a,b):window.sidebar&&window.sidebar.addPanel?window.sidebar.addPanel(b,a,""):alert("\u5bf9\u4e0d\u8d77\uff0c\u60a8\u7684\u6d4f\u89c8\u5668\u4e0d\u652f\u6301\u6b64\u64cd\u4f5c!\n\u8bf7\u60a8\u4f7f\u7528\u83dc\u5355\u680f\u6216Ctrl+D\u6536\u85cf\u672c\u7ad9\u3002"),createCookie("_fv","1",30,"/;domain=http://localhost/wstmall/")
}

/*************************************用户操作*****************************************/
function login(){
	return location.href=domainURL +"/index.php/Home/Users/login/";
}
function logout(){
	jQuery.post(domainURL +"/index.php/Home/Users/logout/",{},function(rsp) {
		location.reload();
	});
}
function regist(){
	return location.href=domainURL +"/index.php/Home/Users/regist/";
}
function createCookie(a,b,c,d){
	var d=d?d:"/";
	if(c){
		var e=new Date;
		e.setTime(e.getTime()+1e3*60*60*24*c);
		var f="; expires="+e.toGMTString()
	}else {
		var f="";
	}		
	document.cookie=a+"="+b+f+"; path="+d
}

//刷新验证码
function getVerify() {
    $('.verifyImg').attr('src',domainURL +'/index.php/Home/Users/getVerify/?rd='+Math.random());
}
function checkLogin(){
	jQuery.post(domainURL +"/index.php/Home/Shops/checkLoginStatus/",{},function(rsp) {
		var json = WST.toJson(rsp);
		if(json.status && json.status==-999)location.reload();
	});
}
