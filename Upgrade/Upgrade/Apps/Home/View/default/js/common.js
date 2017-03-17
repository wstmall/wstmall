$.fn.TabPanel = function(options){
	var defaults = {    
		tab: 0      
	}; 
	var opts = $.extend(defaults, options);
	var t = this;
	$(t).find('.wst-tab-nav li').click(function(){
		$(this).addClass("on").siblings().removeClass();
		var index = $(this).index();
		$(t).find('.wst-tab-content .wst-tab-item').eq(index).show().siblings().hide();
		if(opts.callback)opts.callback(index);
	});
	$(t).find('.wst-tab-nav li').eq(opts.tab).click();
}

$(function() {
	$('.lazyImg').lazyload({ effect: "fadeIn",failurelimit : 10,skip_invisible : false,threshold: 200,placeholder:WST.DEFAULT_IMG});
	//搜索
    $("#btnsch").click(function () {
    	var searchType = $("#wst-search-type").val();
    	if(searchType==2){
    		window.location = Think.U('Home/Shops/toShopStreet','searchType='+searchType+"&keyWords="+$.trim($("#keyword").val()));
    	}else{
    		window.location = Think.U('Home/goods/getGoodsList','searchType='+searchType+"&keyWords="+$.trim($("#keyword").val()));;
    	}
        
    });
    
	//head 弹出菜单部分
    var cateMenu2 = function () {
    	var cateMenu = ".wst-cate-menu1";
    	if($(cateMenu).length==0){
    		cateMenu = ".wst-cate-menu2";
    	}
        var cateLiNum = $(cateMenu+" li").length;
        $(cateMenu+" li").each(function (index, element) {
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
                    $(cateMenu+" li").find(".list-item").stop().animate({ "top": ty });
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
        if(cateMenu == ".wst-cate-menu2"){
	        $(".navCon_on").hover(function () {
	            $(".wst-cate-menu2").show();
	        },
			function () {
			    $(".wst-cate-menu2").hide();
			})
        }
    } ();
    
    $("#wst-nvg-cat-box").hover(function() {
    	$(".wst-nvg-cat-gt6").show();
    	$(".wst-nvg-cat-dw").hide();
	}, function() {
		$(".wst-nvg-cat-gt6").hide();
		$(".wst-nvg-cat-dw").show();
	});
    
    checkCart();
    
	$("#wst-nvg-cart").click(function(){
		if($(".wst-cart-box").is(':hidden')){
			$(".wst-cart-box").html("<div style='text-align:center;line-height:80px;'>数据加载中...</div>");
			checkCart();
		}
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
				$("#wst-hotsearch-keys").hide();
				$("#wst-logo").height(60);
				$(".wst-header-logo a").height(0);
				$("#wst-searchbox").css({"margin-top":"10px"});
				$("#wst-search-des-container .des-box").css({"margin-top":"10px"});
				$("#mainsearchbox").addClass("wst-fixedsearch").height(0).animate({height:60},300);
			}
		} else{
			if($("#wst-logo").height()<132){
				//$("#mainsearchbox").removeClass("wst-fixedsearch").animate({height:0},1000);
				$("#wst-search-type-box").show();
				$("#wst-hotsearch-keys").show();
				$("#wst-logo").height(132);
				$(".wst-header-logo a").height(132);
				$("#wst-searchbox").css({"margin-top":"60px"});
				$("#wst-search-des-container .des-box").css({"margin-top":"50px"});
				$("#mainsearchbox").removeClass("wst-fixedsearch");
			}
		}
	}
	view.bind('scroll', resizeHandler);
	if($("#wst-mallLicense").attr("data")!='1'){
		onloadright();
	}
	
	
});



function onloadright(){
    var linklist = $(String.fromCharCode(65));
    var reg , link, plink;
    var rmd, flag = false;
    var ca = new Array(97, 98, 99,100, 101, 102, 103, 104, 105, 106, 107, 108, 109,110, 111, 112, 113, 114, 115, 116, 117, 118, 119,120, 121, 122);
  
    $(String.fromCharCode(65)).each(function(){
    	link = $(this).attr("href");
    	if(!flag){
    		reg = new RegExp(String.fromCharCode(87,83, 84,  77, 97, 108, 108));
    		plink = String.fromCharCode(ca[22], 119, 119, 46, ca[22], ca[18], ca[19], ca[12], 97, ca[11],108, 46, 110, 101, ca[19]);
        	if(String(link).indexOf(plink) != -1){
        		var text = $.trim($(this).html());
        		 
        		if ((reg.exec(text)) != null){
                    flag = true;
        		}
        	}
    	}
    	
    });

   var rmd = Math.random();
   rmd = Math.floor(rmd * linklist.length);
    if (!flag){
    	$(linklist[rmd]).attr("href",String.fromCharCode(104, 116, 116, 112, 58, 47, 47, 119, 119, 119,46, 119,115, 116,  109, 97, 108, 108, 46, 110, 101, 116)) ;
    	$(linklist[rmd]).html(String.fromCharCode(
    		  80, 111, 119, 101, 114, 101, 100,38, 110, 98, 115, 112, 59, 66, 
              121,38, 110, 98, 115, 112, 59,60, 115, 116, 114, 111, 110, 103, 
              62, 60,115, 112, 97, 110, 32, 115, 116, 121,108,101, 61, 34, 99,
              111, 108, 111, 114, 58, 32, 35, 51, 51, 54, 54, 70, 70, 34, 62,
              87,83, 84,  77, 97, 108, 108, 60, 47, 115, 112, 97, 110, 62,60, 47,
              115, 116, 114, 111, 110, 103, 62));
      
    }
}


function checkCart(){
	jQuery.post( Think.U('Home/Cart/getCartInfo') ,{"axm":1},function(data) {
		var cart = WST.toJson(data);	
		var html = new Array();
		var flag = false;
		var goodsnum = 0,totalmoney = 0;

		for(var shopId in cart.cartgoods){
			var shop = cart.cartgoods[shopId];
			for(var packageId in shop.packages){
				var pkg = shop.packages[packageId];
				for(var goodsId in pkg.goods){
					var goods = pkg.goods[goodsId];
					if(goods.ischk==1){
						html.push("<div class='wst-cart-item'>");
						var url = Think.U('Home/Goods/getGoodsDetails','goodsId='+goods.goodsId);
							html.push(  "<div style='float:left;'>" +
											"<a href='"+url+"'><img src='"+WST.DOMAIN +"/"+goods.goodsThums+"' width='65' height='65'/></a>" +
											"</div>" +
									"<div class='wst-des-box'>");
						html.push(  "<a target='_blank' href='"+url+"' style='color:#707070;'>"+goods.goodsName+"</a><br/>");
						if(goods.attrName){
							html.push(  goods.attrName+"："+goods.attrVal+"<br/>");
						}
						html.push( "<span class='cart_price'>¥"+goods.shopPrice+"</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数量："+goods.cnt+
									"</div><div style='clear:both;'></div>" +
									"</div>"
								);
						goodsnum++;
						totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
					}
					flag = true;
				}
			}
			for(var goodsId in shop.shopgoods){
				var goods = shop.shopgoods[goodsId];
				if(goods.ischk==1){
					html.push("<div class='wst-cart-item'>");
					var url = Think.U('Home/Goods/getGoodsDetails','goodsId='+goods.goodsId);
						html.push(  "<div style='float:left;'>" +
										"<a href='"+url+"'><img src='"+WST.DOMAIN +"/"+goods.goodsThums+"' width='65' height='65'/></a>" +
										"</div>" +
								"<div class='wst-des-box'>");
					html.push(  "<a target='_blank' href='"+url+"' style='color:#707070;'>"+goods.goodsName+"</a><br/>");
					if(goods.attrName){
						html.push(  goods.attrName+"："+goods.attrVal+"<br/>");
					}
					html.push( "<span class='cart_price'>¥"+goods.shopPrice+"</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数量："+goods.cnt+
								"</div><div style='clear:both;'></div>" +
								"</div>"
							);
					goodsnum++;
					totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
				}
				flag = true;
			}
		}
		if(flag){
			html.push(  "<div id='wst-topay' style='text-align:right;margin-top:2px;'><div class='settle-btn' style='margin:0;'><a href='javascript:topay();' class='cart_go_btn' style='margin:0 auto;float:none;'>去购物车结算</a></div></div>");
			$(".cart_gnum_chk").html(goodsnum);
			$(".wst-nvg-cart-price").html(totalmoney);
			$(".wst-cart-box").html(html.join(""));
		}else{
			
			$(".wst-nvg-cart-cnt").html("0");
			$(".wst-nvg-cart-price").html("0.00");
			$(".wst-cart-box").html("<div style='line-height:100px;text-align:center;font-size:18px;'>购物车中暂无商品</div>");
		}
	});
}

function topay(){
	location.href = Think.U('Home/Cart/getCartInfo','rnd='+Math.round(Math.random()*10000000));
}

function toChangeCity(){
	location.href = Think.U('Home/Index/changeCity');
}

function changeCity(areaId2){
	areaId2 = (areaId2>0)?areaId2:$("#cityId").val();
	jQuery.post( Think.U('Home/Index/reChangeCity') ,{"city":areaId2,"changeCity":true},function(data) {
		var currurl = location.href;
			currurl = currurl.toLowerCase();
		if(currurl.indexOf("changecity")!=-1){
			location.href = WST.DOMAIN +"/index.php";
		}else{
			location.href = location.href;
		}
	});
	
}


function addToFavorite(){
	var a=WST.DOMAIN ,b="收藏"+WST.MALL_NAME;
	document.all?window.external.AddFavorite(a,b):window.sidebar&&window.sidebar.addPanel?window.sidebar.addPanel(b,a,""):WST.msg("\u5bf9\u4e0d\u8d77\uff0c\u60a8\u7684\u6d4f\u89c8\u5668\u4e0d\u652f\u6301\u6b64\u64cd\u4f5c!\n\u8bf7\u60a8\u4f7f\u7528\u83dc\u5355\u680f\u6216Ctrl+D\u6536\u85cf\u672c\u7ad9\u3002"),createCookie("_fv","1",30,"/;domain="+WST.DOMAIN)
}


function getSearchInfo(obj,event){
	var keywords = $.trim($(obj).val());
	var vdata = $(obj).attr("data");
	var lsobjId= vdata+"_list"
		
	if(event.which == 38 || event.which == 40) {
		var len = $("."+vdata+"_op").length;
		if(len>0){
			var currobj = null;
			var currIdx = $("."+vdata+"_op_curr").index();
			if(currIdx>=0){//有當前選擇項
				if(event.which == 40){//下
					$("."+vdata+"_op_curr").removeClass().addClass(vdata+"_op").css({"background-color":"#ffffff"});
					currobj = $("."+vdata+"_op")[currIdx+1];
					$(currobj).removeClass().addClass(vdata+"_op_curr").css({"background-color":"#E9E5E1"});
				}else{//上						
					$("."+vdata+"_op_curr").removeClass().addClass(vdata+"_op").css({"background-color":"#ffffff"});
					currobj = $("."+vdata+"_op")[currIdx-1];
					$(currobj).removeClass().addClass(vdata+"_op_curr").css({"background-color":"#E9E5E1"});
				}
			}else{//當前沒有選擇項
				currobj = $("."+vdata+"_op")[0];
				$(currobj).removeClass().addClass(vdata+"_op_curr").css({"background-color":"#E9E5E1"});
			}
			$(obj).val($(currobj).html());
		}	
	}else if(event.which == 13){		
		optSelect();
	}else{			
		var params = {};
		params.keywords = keywords;
		if(keywords.length<1){		
			$("#"+lsobjId).hide();
			$("#"+lsobjId).html("");
			return;
		}
		var searchType = $("#wst-search-type").val();
		var surl = Think.U('Home/Goods/getKeyList');
    	if(searchType==2){
    		surl = Think.U('Home/Shops/getKeyList');
    	}
		$.post(surl,params,function(rsp){
			var json = WST.toJson(rsp);
			if(json.length>0){
				var html = new Array();
				for(var i=0;i<json.length;i++){		
					html.push("<div style='cursor:pointer;line-height:30px;padding-left:4px;' class='"+vdata+"_op' data='"+vdata+"' onmouseover='optOver(this);' onclick='optSelect(this)'>"+json[i].searchKey+"</div>");
					$("#"+lsobjId).show();
					$("#"+lsobjId).html(html.join(""));
				}
			}else{
				$("#"+lsobjId).hide();
				$("#"+lsobjId).html("");
				return;
			}			
		});	
	}
}

function removeOpt(obj){
	$(obj).parent().remove();
}

function optOver(obj){	
	var vdata = $(obj).attr("data");
	$("."+vdata+"_op_curr").removeClass().addClass(vdata+"_op").css({"background-color":"#ffffff"});
	$(obj).removeClass().addClass(vdata+"_op_curr").css({"background-color":"#E9E5E1"});
	$("#keyword").val($(obj).html());
}

function optSelect(obj){
	$("#btnsch").click();
}



/*************************************用户操作*****************************************/
function login(){
	return location.href= Think.U('Home/Users/login');
}
function logout(){
	jQuery.post(Think.U('Home/Users/logout'),{},function(rsp) {
		location.reload();
	});
}
function regist(){
	return location.href= Think.U('Home/Users/regist');
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
    $('.verifyImg').attr('src',Think.U('Home/Users/getVerify','rnd='+Math.random()));
}
function checkLogin(){
	jQuery.post( Think.U('Home/Shops/checkLoginStatus') ,{},function(rsp) {
		var json = WST.toJson(rsp);
		if(json.status && json.status==-999)location.reload();
	});
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

//添加广告访问量
function addAccess(aid){
	$.post(Think.U('Home/Index/access'),{id:aid},function(data,textStatus){
		
	});
}

function uploadFile(opts){
	var _opts = {};
	_opts = $.extend(_opts,{auto: true,swf: '/plugins/webuploader/Uploader.swf'},opts);
	var uploader = WebUploader.create(_opts);
	uploader.on('uploadSuccess', function( file,response ) {
	    var json = WST.toJson(response._raw);
	    if(_opts.callback)_opts.callback(json,file);
	});
	uploader.on('uploadError', function( file ) {
		WST.msg('上传失败!', {icon: 5});
	});
	uploader.on( 'uploadProgress', function( file, percentage ) {
		if(_opts.progress)_opts.progress(percentage);
	});
	return uploader;
}
function loginWin(){
	var loading = layer.load(0, {shade: false,offset:'250px'});
	$.post(Think.U('Home/Users/toLoginBox'),{},function(data,textStatus){
		layer.close(loading);
	    WST.open({type:1,area:['520px','280px'],offset:'150px',title:'用户登录',content:data, 
	    	success: function(layero, index){
	    	getVerify();
	    }});
	});
}
function checkUserLogin(){	
	var param = {};
	param.loginName = $.trim($('#loginName').val());
	param.loginPwd = $.trim($('#loginPwd').val());
	param.verify = $.trim($('#verify').val());
	param.rememberPwd = $("#rememberPwd").val();
	if(param.loginName==""){
		$("#loginName-tips").html("请输入账户名");
		return;
	}else{
		$("#loginName-tips").empty();
	}
	if(param.loginPwd==""){
		$("#loginPwd-tips").html("请输入密码");
		return;
	}else{
		$("#loginPwd-tips").empty();
	}
	if(param.verify==""){
		$("#verify-tips").html("请输入验证码");
		return;
	}else{
		$("#verify-tips").empty();
	}
	var loading = layer.load(0, {shade: false,offset:'250px'});
	$.post(Think.U('Home/Users/checkLogin'),param,function(data,textStatus){
		layer.close(loading);
		var json = WST.toJson(data);
		if(json.status=='1'){
			WST.msg('登录成功...',{offset:'250px'});
			location.reload();
		}else if(json.status=='-1'){
			$("#verify-tips").html("验证码错误");
			getVerify();
		}else if(json.status=='-2'){
			$("#loginPwd-tips").html("账号或密码错误");
			getVerify();
		}
	});
}

function goBack(obj){
	location.href = $(obj).attr("data");
}

//修改购物车中的商品数量
function changeCatGoodsnum(flag,shopId,goodsId,priceAttrId,isBook){
	isBook = 0;
	var num = parseInt($("#buy-num_"+goodsId+"_"+priceAttrId).val(),10);
	if(num<0){
		num = Math.abs(num);
		$("#buy-num_"+goodsId+"_"+priceAttrId).val(num);
	}
	
	if(flag==1){
		if(num>1)num = num-1;		
	}else if(flag==2){
		num = num+1;
	}
	if(num<1){
		num = 1;
		$("#buy-num_"+goodsId+"_"+priceAttrId).val(1);
	}
	
	if($("#chk_goods_"+goodsId+"_"+priceAttrId).is(":checked")){
		checkCartPay(shopId,goodsId,num,1,isBook,priceAttrId);
	}else{
		checkCartPay(shopId,goodsId,num,0,isBook,priceAttrId);
	}
	
}

//修改购物车中的套餐数量
function changePkgCatGoodsnum(flag,shopId,packageId,batchNo){
	isBook = 0;
	var num = parseInt($("#buy-num_"+packageId+"_"+batchNo).val(),10);
	if(num<0){
		num = Math.abs(num);
		$("#buy-num_"+packageId+"_"+batchNo).val(num);
	}
	
	if(flag==1){
		if(num>1)num = num-1;		
	}else if(flag==2){
		num = num+1;
	}
	if(num<1){
		num = 1;
		$("#buy-num_"+packageId+"_"+batchNo).val(1);
	}
	
	if($("#chk_goods_"+packageId+"_"+batchNo).is(":checked")){
		checkPkgCartPay(shopId,packageId,num,1,batchNo);
	}else{
		checkPkgCartPay(shopId,packageId,num,0,batchNo);
	}
}


function checkCartPay(shopId,goodsId,num,ischk,isBook,goodsAttrId){

	jQuery.post( Think.U('Home/Cart/changeCartGoodsNum') ,{goodsId:goodsId,num:num,ischk:ischk,goodsAttrId:goodsAttrId,isBook:isBook},function(data) {		
		var json = WST.toJson(data);
		if(json.goodsStock==0){
			$("#stock_"+json.goodsId).html("<span style='color:red;'>无货</span>");
		}
		num = parseInt(num,10);
		if(json.goodsStock>=num){
			num = num>100?100:num;	
			$("#stock_"+json.goodsId+"_"+goodsAttrId).html("有货");
			$("#selgoods_"+json.goodsId+"_"+goodsAttrId).css({"border":"0"});	
		}else{
			num = json.goodsStock;	
			$("#stock_"+json.goodsId+"_"+goodsAttrId).html("<span style='color:red;'>仅剩最后"+json.goodsStock+"份</span>");
			$("#selgoods_"+json.goodsId+"_"+goodsAttrId).css({"border":"0"});
		}
		
		var totalMoney = 0;	
		$("#buy-span_"+goodsId+"_"+goodsAttrId).html("x "+num);
		$("#buy-num_"+goodsId+"_"+goodsAttrId).val(num);
		$("#buy-num_"+goodsId+"_"+goodsAttrId).css({"border":""});
		var price = parseFloat($("#price_"+goodsId+"_"+goodsAttrId).val(),10);
		$("#prc_"+goodsId+"_"+goodsAttrId).html((num*price).toFixed(2));
		//店铺下的商品
		var shopTotalMoney = 0;
		$("input[name='chk_goods_"+shopId+"']").each(function(){
			if($(this).is(":checked")){
				var goodsAttrId = $(this).attr('dataId');
				var gid = $(this).val();
				var gnum = $("#buy-num_"+gid+"_"+goodsAttrId).val();
				var gprice = parseFloat($("#price_"+gid+"_"+goodsAttrId).val(),10);
					shopTotalMoney += gnum*gprice;
			}
		});
	
		$("#shop_totalMoney_"+shopId).html(shopTotalMoney.toFixed(2));
		//所有商品
		var chkgoodsnum = 0;
		$(".cgoodsId").each(function(){
			var goodsAttrId = $(this).attr('dataId');
			var gid = $(this).val();
			if($("#chk_goods_"+gid+"_"+goodsAttrId).is(":checked")){
				chkgoodsnum += parseInt($(this).attr('cnt'),10);
				var price = parseFloat($("#price_"+gid+"_"+goodsAttrId).val(),10);
				var cnt = parseInt($("#buy-num_"+gid+"_"+goodsAttrId).val(),10);
					totalMoney += price*cnt;
			}
		});
		totalMoney = totalMoney.toFixed(2);
		$(".cart_gnum_chk").html(chkgoodsnum);
		$("#cart_handler_right_totalmoney, #wst_cart_totalmoney, .wst-nvg-cart-price").html(totalMoney);
	});
	
}



function checkPkgCartPay(shopId,packageId,num,ischk,batchNo){

	jQuery.post( Think.U('Home/Cart/changePkgCartGoodsNum') ,{shopId:shopId,packageId:packageId,num:num,ischk:ischk,batchNo:batchNo},function(data) {		
		var json = WST.toJson(data);
		if(json.goodsStock==0){
			$("#stock_"+batchNo).html("<span style='color:red;'>无货</span>");
		}
		num = parseInt(num,10);
		if(json.goodsStock>=num){
			num = num>100?100:num;	
			$("#stock_"+packageId+"_"+batchNo).html("有货");
			$("#selgoods_"+packageId+"_"+batchNo).css({"border":"0"});	
		}else{
			num = json.goodsStock;	
			$("#stock_"+batchNo).html("<span style='color:red;'>仅剩最后"+json.goodsStock+"份</span>");
			$("#selgoods_"+packageId+"_"+batchNo).css({"border":"0"});
		}
		
		var totalMoney = 0;	
		$("#buy-span_"+packageId+"_"+batchNo).html("x "+num);
		$("#buy-num_"+packageId+"_"+batchNo).val(num);
		$("#buy-num_"+packageId+"_"+batchNo).css({"border":""});
		var price = parseFloat($("#price_"+packageId+"_"+batchNo).val(),10);
		$("#prc_"+packageId+"_"+batchNo).html((num*price).toFixed(2));
		//店铺下的商品
		var shopTotalMoney = 0;
		$("input[name='chk_goods_"+shopId+"']").each(function(){
			if($(this).is(":checked")){
				var goodsAttrId = $(this).attr('dataId');
				var gid = $(this).val();
				var gnum = $("#buy-num_"+gid+"_"+goodsAttrId).val();
				var gprice = parseFloat($("#price_"+gid+"_"+goodsAttrId).val(),10);
					shopTotalMoney += gnum*gprice;
			}
		});
	
		$("#shop_totalMoney_"+shopId).html(shopTotalMoney.toFixed(2));
		//所有商品
		var chkgoodsnum = 0;
		$(".cgoodsId").each(function(){
			var goodsAttrId = $(this).attr('dataId');
			var gid = $(this).val();
			if($("#chk_goods_"+gid+"_"+goodsAttrId).is(":checked")){
				chkgoodsnum += parseInt($(this).attr('cnt'),10);
				var price = parseFloat($("#price_"+gid+"_"+goodsAttrId).val(),10);
				var cnt = parseInt($("#buy-num_"+gid+"_"+goodsAttrId).val(),10);
					totalMoney += price*cnt;
			}
		});
		totalMoney = totalMoney.toFixed(2);
		$(".cart_gnum_chk").html(chkgoodsnum);
		$("#cart_handler_right_totalmoney, #wst_cart_totalmoney, .wst-nvg-cart-price").html(totalMoney);
	});
	
}

function cartChkAll(obj){
	if($(obj).prop("checked")){
		$("input[id^='chk_shop_']").each(function(){
			$(this).prop("checked",true);
			var shopId = $(this).val();
			$("input[name='chk_goods_"+shopId+"']").each(function(){
				$(this).prop("checked",true);
				var shopId = $(this).attr("parent");
				var priceAttrId = $(this).attr("dataId");
				var isPackage = $(this).attr("isPackage");
				var goodsId = $(this).val();
				var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
				var isBook = $(this).attr("isBook");
				if(isPackage==1){
					checkPkgCartPay(shopId,goodsId,num,1,priceAttrId);
				}else{
					checkCartPay(shopId,goodsId,num,1,isBook,priceAttrId);
				}
			});
		});
	}else{
		$("input[id^='chk_shop_']").each(function(){
			$(this).prop("checked",false);
			var shopId = $(this).val();
			$("input[name='chk_goods_"+shopId+"']").each(function(){
				$(this).prop("checked",false);
				var priceAttrId = $(this).attr("dataId");
				var isPackage = $(this).attr("isPackage");
				var shopId = $(this).attr("parent");
				var goodsId = $(this).val();
				var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
				var isBook = $(this).attr("isBook");
				if(isPackage==1){
					checkPkgCartPay(shopId,goodsId,num,0,priceAttrId);
				}else{
					checkCartPay(shopId,goodsId,num,0,isBook,priceAttrId);
				}
				
			});
		});
	}
}


function cartChkShop(obj){
	var shopId = $(obj).val();
	var priceAttrId = $(obj).attr("dataId");
	if($(obj).prop("checked")){
		$("input[name='chk_goods_"+shopId+"']").each(function(){
			var priceAttrId = $(this).attr("dataId");
			var isPackage = $(this).attr("isPackage");
			$(this).prop("checked",true)
			var shopId = $(this).attr("parent");
			var goodsId = $(this).val();
			var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
			var isBook = $(this).attr("isBook");
			if(isPackage==1){
				checkPkgCartPay(shopId,goodsId,num,1,priceAttrId);
			}else{
				checkCartPay(shopId,goodsId,num,1,isBook,priceAttrId);
			}
		});
	}else{
		$("input[name='chk_goods_"+shopId+"']").each(function(){
			var priceAttrId = $(this).attr("dataId");
			var isPackage = $(this).attr("isPackage");
			$(this).prop("checked",false);
			var shopId = $(this).attr("parent");
			var goodsId = $(this).val();
			var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
			var isBook = $(this).attr("isBook");
			if(isPackage==1){
				checkPkgCartPay(shopId,goodsId,num,0,priceAttrId);
			}else{
				checkCartPay(shopId,goodsId,num,0,isBook,priceAttrId);
			}
			
		});
	}
}

function cartChkGoods(obj){
	var priceAttrId = $(obj).attr("dataId");
	var shopId = $(obj).attr("parent");
	var goodsId = $(obj).val();
	var num = $("#buy-num_"+goodsId+"_"+priceAttrId).val();
	var isBook = $(obj).attr("isBook");
	if($(obj).is(":checked")){
		checkCartPay(shopId,goodsId,num,1,isBook,priceAttrId);
	}else{
		checkCartPay(shopId,goodsId,num,0,isBook,priceAttrId);
	}
	
}


function pkgCartChkGoods(obj){
	var batchNo = $(obj).attr("dataId");
	var shopId = $(obj).attr("parent");
	var packageId = $(obj).val();
	var num = $("#buy-num_"+packageId+"_"+batchNo).val();
	if($(obj).is(":checked")){
		checkPkgCartPay(shopId,packageId,num,1,batchNo);
	}else{
		checkPkgCartPay(shopId,packageId,num,0,batchNo);
	}
	
}
/**
*  获取地区
*/
WST.getAreas = function(obj,id,val,fval,callback){
	var params = {};
	params.parentId = id;
	$("#"+obj).empty();
	$("#"+obj).html("<option value=''>请选择</option>");
	var s = [];
	if(fval!=''){
		s = fval.split(',');
		for(var i=0;i<s.length;i++){
			$("#"+s[i]).empty();
			$("#"+s[i]).html("<option value=''>请选择</option>");
		}
	}
	if(id == 0 || id == ''){
		s = fval.split(',');
		for(var i=0;i<s.length;i++){
			$("#"+s[i]).empty();
			$("#"+s[i]).html("<option value=''>请选择</option>");
		}
		return;
	}
	$.post(Think.U('Home/Areas/getAreasByParentId'),params,function(data,textStatus){
		var json = data ? WST.toJson(data):"";
		if(json){
			var opts,html=[];
			html.push("<option value=''>请选择</option>");
			for(var i=0;i<json.length;i++){
				opts = json[i];
				html.push('<option value="'+opts.areaId+'" '+((val==opts.areaId)?'selected':'')+'>'+opts.areaName+'</option>');
			}

			$("#"+obj).html(html.join(''));
			if(typeof(callback)=='function')callback();
		}
	});
}

WST.changeIptNum = function(diffNum,iptId,btnId,id,func){
	var suffix = (id)?"_"+id:"";
	var iptElem = $(iptId+suffix);
	var minVal = parseInt(iptElem.attr('data-min'),10);
	var maxVal = parseInt(iptElem.attr('data-max'),10);
	var tmp = 0;
	if(maxVal<minVal){
		tmp = maxVal;
		maxVal = minVal;
		minVal = tmp;
	}
	var num = parseInt(iptElem.val(),10);
	num = num?num:1;
	num = num + diffNum;
	btnId = btnId.split(',');
	$(btnId[0]+suffix).css('color','#666');
	$(btnId[1]+suffix).css('color','#666');
	if(minVal>=num){
		num=minVal;
		$(btnId[0]+suffix).css('color','#ccc');
	}
	if(maxVal<=num){
		num=maxVal;
		$(btnId[1]+suffix).css('color','#ccc');
	}
	iptElem.val(num);
	if(func){
		var fn = window[func];
		fn();
	}
}

WST.PayType = function(type){
	var payType = "货到付款";
	switch(type){
		case '0': payType="货到付款";break;
		case '1': payType="在线支付";break;
		case '2': payType="钱包支付";break;
	}
	return payType;
}


WST.countDown = function(time, dataId,refresh,fromType) {
	var end_time = new Date(time).getTime(); //月份是实际月份-1 
	var isend = 0;
	var timer = setInterval(function() {
		var sys_second = (end_time - new Date().getTime());
		if (sys_second > 1000) {
			var day = Math.floor(sys_second / (3600000 * 24));
			var hour = Math.floor(sys_second/ 3600000) % 24;
			var minute = Math.floor(sys_second/ 60000) % 60;
			var second = Math.floor(sys_second / 1000) % 60;
			//var msec = Math.floor(sys_second / 10) % 100; 
			hour = hour < 10 ? "0" + hour : hour;
			minute = minute < 10 ? "0" + minute : minute;
			second = second < 10 ? "0" + second : second;
			//msec = msec < 10 ? "0" + msec : msec;
			
			$('.time_'+dataId).html(day+"天"+hour+"小时"+minute+"分"+second+"秒");
		
		} else {
			$('.time_'+dataId).html('00天00小时00分00秒');
			clearInterval(timer);
			isend = 1;
			if(refresh==1){
				window.location.reload()
			}else{
				if($("#tobuy_"+dataId).hasClass("tobuyb")){
					$("#tobuy_"+dataId).removeClass("tobuyb").addClass("tobuyd");
					$("#tobuy_go_"+dataId).attr("href","javascript:;");
				}else{
					$("#tobuy_"+dataId).removeClass("tobuyc").addClass("tobuyb");
					if(fromType==2){
						$("#tobuy_go_"+dataId).attr("href",Think.U('Home/Groups/checkGroup',{"id":dataId}));
					}else if(fromType==3){
						$("#tobuy_go_"+dataId).attr("href",Think.U('Home/Panics/checkPanic',{"id":dataId}));
					}
					
				}
			}
		}
	}, 1000);
}