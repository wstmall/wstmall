jQuery(function($){
	//创建DOM
	var 
	quickHTML = document.querySelector("div.quick_link_mian"),
	quickShell = $(document.createElement('div')).html(quickHTML).addClass('quick_links_wrap'),
	quickLinks = quickShell.find('.quick_links');
	quickPanel = quickLinks.next();
	quickShell.appendTo('.mui-mbar-tabs');
	
	//具体数据操作 
	var 
	quickPopXHR,
	loadingTmpl = '<div class="loading" style="padding:30px 80px"><i></i><span>Loading...</span></div>',
	popTmpl = '<a href="javascript:;" class="ibar_closebtn" title="关闭"></a><div class="ibar_plugin_title"><h3><%=title%></h3></div><div class="pop_panel"><%=content%></div><div class="arrow"><i></i></div><div class="fix_bg"></div>',
	historyListTmpl = '<ul><%for(var i=0,len=items.length; i<5&&i<len; i++){%><li><a href="<%=items[i].productUrl%>" target="_blank" class="pic"><img alt="<%=items[i].productName%>" src="<%=items[i].productImage%>" width="60" height="60"/></a><a href="<%=items[i].productUrl%>" title="<%=items[i].productName%>" target="_blank" class="tit"><%=items[i].productName%></a><div class="price" title="单价"><em>&yen;<%=items[i].productPrice%></em></div></li><%}%></ul>',
	newMsgTmpl = '<ul><li><a href="#"><span class="tips">新回复<em class="num"><b><%=items.commentNewReply%></b></em></span>商品评价/晒单</a></li><li><a href="#"><span class="tips">新回复<em class="num"><b><%=items.consultNewReply%></b></em></span>商品咨询</a></li><li><a href="#"><span class="tips">新回复<em class="num"><b><%=items.messageNewReply%></b></em></span>我的留言</a></li><li><a href="#"><span class="tips">新通知<em class="num"><b><%=items.arrivalNewNotice%></b></em></span>到货通知</a></li><li><a href="#"><span class="tips">新通知<em class="num"><b><%=items.reduceNewNotice%></b></em></span>降价提醒</a></li></ul>',
	quickPop = quickShell.find('#quick_links_pop'),
	quickDataFns = {
		//购物信息
		message_list: {
			msgtype:1,
			title: '购物车',
			content: '<div class="ibar_plugin_content"><a href="javascript:topay();" class="cart_go_btn" >去购物车结算</a></div></div>',
			init:$.noop
		}
	};
	
	//showQuickPop
	var 
	prevPopType,
	prevTrigger,
	doc = $(document),
	popDisplayed = false,
	hideQuickPop = function(){
		if(prevTrigger){
			prevTrigger.removeClass('current');
		}
		popDisplayed = false;
		prevPopType = '';
		quickPop.hide();
		$(".quick_links_wrap").width(40);
		quickPop.animate({left:280,queue:true});
	},
	showQuickPop = function(type){
		if(quickPopXHR && quickPopXHR.abort){
			quickPopXHR.abort();
		}
		if(type !== prevPopType){
			var fn = quickDataFns[type];
			
			if(fn && fn.msgtype==1){
				$(".quick_links_wrap").width(320);
				fn.content = "<div class='ibar_plugin_content' style='height:100%;padding-top:100%;padding-left:80px;'><img src='"+rooturl+"/Apps/Home/View/default/images/loading.gif' width='20'/>数据加载中...</div>";
				quickPop.html(ds.tmpl(popTmpl, fn));
				jQuery.post(rooturl+"/index.php/Home/Cart/getCartInfo/" ,{"axm":1},function(data) {
					var cart = WST.toJson(data);	
					var html = new Array();
					var totalmoney = 0;
					html.push('<div class="ibar_plugin_content"><div class="ibar_cart_group ibar_cart_product"><ul style="height:80%;overflow:auto;">');
					for(var i=0;i<cart.cartgoods.length;i++){
						var goods = cart.cartgoods[i];
						totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
						html.push(  "<li class='cart_item'>" +
										"<div class='cart_item_pic'>" +
											"<!--input type='checkbox' class='cart-goods-check'-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='"+rooturl+"/index.php/Home/Goods/getGoodsDetails/?goodsId="+goods.goodsId+"'><img src='"+rooturl+"/"+goods.goodsThums+"' /></a>" +
										"</div>" +
										"<div class='cart_item_desc'>" +
											"<a href='"+rooturl+"/index.php/Home/Goods/getGoodsDetails/?goodsId="+goods.goodsId+"' class='cart_item_name'>"+goods.goodsName+"</a>" +
											"<div class='cart_item_price'><span class='cart_price'>￥"+goods.shopPrice+"</span></div>" +
											"<div class='cart-close-box' style=''>" +
											"<span class='cart-colse'>x</span></div>	" +
											"<div class='cart_goods_box' style='position:absolute;bottom:0px;right:6px;'>" +
											
											"<span class='cart-minus'>-</span>" +
											"<span style='font-size:14px;padding-left:6px;padding-right:6px;'>x "+goods.cnt+"</span>" +
											"<span class='cart-plus'>+</span></div>	" +
										"</div>" +
										"<div class='wst-clear'></div>	" +
									"</li>"
								);
						
					}
					html.push('</ul></div><div class="cart_handler"><div class="cart_handler_header"><span class="cart_handler_left">共<span class="cart_price">'+cart.cartgoods.length+'</span>件商品</span><span class="cart_handler_right">￥'+totalmoney+'</span></div><div style="width:260px;"><a href="javascript:topay();" class="cart_go_btn" >去购物车结算</a></div></div></div>');
					fn.content = html.join("");
					quickPop.html(ds.tmpl(popTmpl, fn));
					fn.init.call(this, fn);
					$("li.cart_item").bind("mouseover",function(){
						//$(this).find(".cart-close-box").show();
						//$(this).find(".cart-minus").show();
						//$(this).find(".cart-plus").show();
						$(this).css({"background-color":"#F7F7F7"});
					});
					$("li.cart_item").bind("mouseout",function(){
						//$(this).find(".cart-close-box").hide();
						//$(this).find(".cart-minus").hide();
						//$(this).find(".cart-plus").hide();
						$(this).css({"background-color":""});
					});
				});
				doc.unbind('click.quick_links').one('click.quick_links', hideQuickPop);

				quickPop[0].className = 'quick_links_pop quick_' + type;
				popDisplayed = true;
				prevPopType = type;
				quickPop.show();
				quickPop.animate({left:0,queue:true});
			}
			
		}
		/**/
	};
	quickShell.bind('click.quick_links', function(e){
		
		e.stopPropagation();
	});
	quickPop.delegate('a.ibar_closebtn','click',function(){
		$(".quick_links_wrap").width(40);
		quickPop.hide();
		quickPop.animate({left:280,queue:true});
		if(prevTrigger){
			prevTrigger.removeClass('current');
		}
	});

	//通用事件处理
	var 
	view = $(window),
	quickLinkCollapsed = !!ds.getCookie('ql_collapse'),
	getHandlerType = function(className){
		return className.replace(/current/g, '').replace(/\s+/, '');
	},
	showPopFn = function(){
		var type = getHandlerType(this.className);
		if(popDisplayed && type === prevPopType){
			return hideQuickPop();
		}
		showQuickPop(this.className);
		if(prevTrigger){
			prevTrigger.removeClass('current');
		}
		//prevTrigger = $(this).addClass('current');
	},
	quickHandlers = {
		//购物车，最近浏览，商品咨询
		my_qlinks: showPopFn,
		message_list: showPopFn,
		history_list: showPopFn,
		leave_message: showPopFn,
		mpbtn_histroy:showPopFn,
		mpbtn_recharge:showPopFn,
		mpbtn_wdsc:showPopFn,
		//返回顶部
		return_top: function(){
			ds.scrollTo(0, 0);
			hideReturnTop();
		}
	};
	quickShell.delegate('a', 'click', function(e){
		/*if($(".quick_links_wrap").width()>40){
			$(".quick_links_wrap").width(40);
		}else{
			$(".quick_links_wrap").width(320);
		}*/
		var type = getHandlerType(this.className);
		if(type && quickHandlers[type]){
			quickHandlers[type].call(this);
			e.preventDefault();
		}
		
		/*if($(this).parent().attr("id")=="shopCart"){
			if($(".quick_links_wrap").width()>40){
				$(".quick_links_wrap").width(40);
			}else{
				$(".quick_links_wrap").width(320);
			}
		}*/
	});
	
	//Return top
	var scrollTimer, resizeTimer, minWidth = 1350;

	function resizeHandler(){
		clearTimeout(scrollTimer);
		scrollTimer = setTimeout(checkScroll, 160);
	}
	
	function checkResize(){
		quickShell[view.width() > 1340 ? 'removeClass' : 'addClass']('quick_links_dockright');
	}
	function scrollHandler(){
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(checkResize, 160);
	}
	function checkScroll(){
		view.scrollTop()>100 ? showReturnTop() : hideReturnTop();
	}
	function showReturnTop(){
		quickPanel.addClass('quick_links_allow_gotop');
	}
	function hideReturnTop(){
		quickPanel.removeClass('quick_links_allow_gotop');
	}
	view.bind('scroll.go_top', resizeHandler).bind('resize.quick_links', scrollHandler);
	quickLinkCollapsed && quickShell.addClass('quick_links_min');
	resizeHandler();
	scrollHandler();
});