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
	historyListTmpl = '',
	newMsgTmpl = '',
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
		quickPop.animate({left:280},100);
		$(".quick_links_panel").animate({"right":"0px"},100);
	},
	showQuickPop = function(type){
		if(WST.IS_LOGIN==0){
			return;
		}
		if(quickPopXHR && quickPopXHR.abort){
			quickPopXHR.abort();
		}
		if(type !== prevPopType){
			var fn = quickDataFns[type];
			
			if(fn && fn.msgtype==1){
				$(".quick_links_wrap").animate({"width":"280px"},100);
				$(".quick_links_panel").animate({"right":"280px"},100);
				fn.content = "<div class='ibar_plugin_loading' style=''><img src='"+WST.DOMAIN +"/Apps/Home/View/"+WST.WST_STYLE +"/images/loading.gif' width='20'/>数据加载中...</div>";
				quickPop.html(ds.tmpl(popTmpl, fn));
				jQuery.post(Think.U('Home/Cart/getCartInfo') ,{"axm":1},function(data) {
					var cart = WST.toJson(data);
					var html = new Array();
					var totalmoney = 0, chkgoodsnum = 0, goodsnum = 0;
					html.push('<div class="ibar_plugin_content"><div class="ibar_cart_group ibar_cart_product"><ul style="height:80%;overflow-y:auto;overflow-x: hidden;">');
					for(var shopId in cart.cartgoods){
						var shop = cart.cartgoods[shopId];
						html.push(  "<li style='padding:6px 0;border-bottom:1px solid #ddd;' id='cart_shop_li_"+shopId+"'><input type='checkbox' onclick='cartChkShop(this)' id='chk_shop_"+shopId+"' value='"+shopId+"' name='chk_shop' class='cart-goods-check'/>"+shop.shopName+"</li>" );
						
						for(var packageId in shop.packages){
							var pkg = shop.packages[packageId];
							html.push(  "<li class='cart_item'>"+
											"<div class='cart_item_pic' style='line-height:25px;'>" +
					                        	"<input type='hidden' id='price_"+pkg.packageId+"_"+pkg.batchNo+"' value='"+pkg.shopPrice+"'/>" +
												"<input type='checkbox' onclick='pkgCartChkGoods(this)' cnt='"+pkg.goods.length+"' isPackage='1' class='cart-goods-check cgoodsId' id='chk_goods_"+pkg.packageId+"_"+pkg.batchNo+"' name='chk_goods_"+pkg.shopId+"' value='"+pkg.packageId+"' parent='"+pkg.shopId+"' dataId='"+pkg.batchNo+"' isBook='0' "+(pkg.ischk==1?"checked":"")+">" +
												pkg.packageName
											+"</div>" +
												"<div class='cart_item_desc'>" +
												"<span class='cart_price'>￥"+pkg.shopPrice+"</span>"+
													"<div class='cart_goods_box' style='position:absolute;bottom:0px;right:6px;'>"+
													"<span id='numl_"+pkg.packageId+"_"+pkg.batchNo+"' class='cart-minus' onclick='changePkgCatGoodsnum(1,"+pkg.shopId+","+pkg.packageId+","+pkg.batchNo+")'>-</span>" +
													"<span id='buy-span_"+pkg.packageId+"_"+pkg.batchNo+"' style='font-size:14px;padding-left:6px;padding-right:6px;'>x "+pkg.goodsCnt+"</span><input type='hidden' id='buy-num_"+pkg.packageId+"_"+pkg.batchNo+"' value='"+pkg.goodsCnt+"' style='width:40px;'/>" +
													"<span id='numl_"+pkg.packageId+"_"+pkg.batchNo+"' class='cart-plus' onclick='changePkgCatGoodsnum(2,"+pkg.shopId+","+pkg.packageId+","+pkg.batchNo+")'>+</span>	" +
													
													"</div>" +
													"<div class='cart-close-box' ><span style='right:-22px;' class='cart-colse' price="+pkg.shopPrice+" cnt="+pkg.goodsCnt+" spId="+pkg.shopId+" onclick=removeCartGoods(this,'"+pkg.packageId+"','"+pkg.batchNo+"',1);></span></div>	" +
												"</div>" +
											"<div class='wst-clear'></div>");
							for(var goodsId in pkg.goods){
								var goods = pkg.goods[goodsId];
								goodsnum++;
								if(goods.ischk==1){
									chkgoodsnum++;
									totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
									totalmoney = totalmoney.toFixed(2);
								}
								var url = Think.U("Home/Goods/getGoodsDetails","goodsId="+goods.goodsId);
								html.push(  "<div class='cart_item'>" +
											"<div class='cart_item_pic'>" +
												"<a href='"+url+"'><img src='"+WST.DOMAIN +"/"+goods.goodsThums+"'  style='margin-left:28px;'/></a>" +
											"</div>" +
											"<div class='cart_item_desc'>" +
												"<a href='"+url+"' class='cart_item_name'>"+goods.goodsName+"</a>" );
								if(goods.attrName){
									html.push(  "<div class='cart_item_price'>"+goods.attrName+"："+goods.attrVal+"</div>" );
								}
								html.push(  "<div class='cart_item_price'><span class='cart_price'>￥"+goods.shopPrice+"</span></div>" +
												
													"<div class='cart_goods_box' style='position:absolute;bottom:0px;right:6px;'></div>	" +
											"</div>" +
											"<div class='wst-clear'></div>	" +
										"</div>"
									);
							}
							html.push(  "</li>");
						}
						
						for(var goodsId in shop.shopgoods){
							var goods = shop.shopgoods[goodsId];
							goodsnum++;
							if(goods.ischk==1){
								chkgoodsnum++;
								totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
								totalmoney = totalmoney.toFixed(2);
							}
							var url = Think.U("Home/Goods/getGoodsDetails","goodsId="+goods.goodsId);
							html.push(  "<li class='cart_item'>" +
										
										"<div class='cart_item_pic'>" +
			                            	"<input type='hidden' id='price_"+goods.goodsId+"_"+goods.goodsAttrId+"' value='"+goods.shopPrice+"'/>" +
											"<input type='checkbox' onclick='cartChkGoods(this)' cnt='1' class='cart-goods-check cgoodsId' id='chk_goods_"+goods.goodsId+"_"+goods.goodsAttrId+"' name='chk_goods_"+goods.shopId+"' value='"+goods.goodsId+"' parent='"+goods.shopId+"' dataId='"+goods.goodsAttrId+"' isBook='"+goods.isBook+"' "+(goods.ischk==1?"checked":"")+"><a href='"+url+"'><img src='"+WST.DOMAIN +"/"+goods.goodsThums+"' /></a>" +
										"</div>" +
										"<div class='cart_item_desc'>" +
											"<a href='"+url+"' class='cart_item_name'>"+goods.goodsName+"</a>" );
							if(goods.attrName){
								html.push(  "<div class='cart_item_price'>"+goods.attrName+"："+goods.attrVal+"</div>" );
							}
							html.push(  "<div class='cart_item_price'><span class='cart_price'>￥"+goods.shopPrice+"</span></div>" +
											"<div class='cart-close-box' style=''>" +
											"<span class='cart-colse' price="+goods.shopPrice+" cnt="+goods.cnt+" spId="+goods.shopId+" onclick=removeCartGoods(this,'"+goods.goodsId+"','"+goods.goodsAttrId+",0');></span></div>	" +
											"<div class='cart_goods_box' style='position:absolute;bottom:0px;right:6px;'>" +
											
											"<span id='numl_"+goods.goodsId+"_"+goods.goodsAttrId+"' class='cart-minus' onclick='changeCatGoodsnum(1,"+goods.shopId+","+goods.goodsId+","+goods.goodsAttrId+","+goods.isBook+")'>-</span>" +
											"<span id='buy-span_"+goods.goodsId+"_"+goods.goodsAttrId+"' style='font-size:14px;padding-left:6px;padding-right:6px;'>x "+goods.cnt+"</span><input type='hidden' id='buy-num_"+goods.goodsId+"_"+goods.goodsAttrId+"' value='"+goods.cnt+"' style='width:40px;'/>" +
											"<span id='numl_"+goods.goodsId+"_"+goods.goodsAttrId+"' class='cart-plus' onclick='changeCatGoodsnum(2,"+goods.shopId+","+goods.goodsId+","+goods.goodsAttrId+","+goods.isBook+")'>+</span></div>	" +
										"</div>" +
										"<div class='wst-clear'></div>	" +
									"</li>"
								);
						}
					}
					if(goodsnum==0){
						html.push('<li class="wst-empty-cart">亲~您的购物车空空如也，赶快开始购物吧！</li>');
					}
					$(".cart_num").html(goodsnum);
					$(".cart_gnum_chk").html(chkgoodsnum);
					$(".wst-nvg-cart-price").html(totalmoney);
					
					html.push('</ul></div><div class="cart_handler"><div class="cart_handler_header"><span class="cart_handler_left">已选<span class="cart_gnum_chk cart_price">'+chkgoodsnum+'</span>件商品</span><span class="cart_handler_right">￥<span id="cart_handler_right_totalmoney">'+totalmoney+'</span></span></div><div style="width:260px;"><a href="javascript:topay();" class="cart_go_btn" >去购物车结算</a></div></div></div>');
					fn.content = html.join("");
					quickPop.html(ds.tmpl(popTmpl, fn));
					fn.init.call(this, fn);
					$("li.cart_item").bind("mouseover",function(){
						$(this).css({"background-color":"#F7F7F7"});
					});
					$("li.cart_item").bind("mouseout",function(){
						$(this).css({"background-color":""});
					});
				});
				doc.unbind('click.quick_links').one('click.quick_links', hideQuickPop);

				quickPop[0].className = 'quick_links_pop quick_' + type;
				popDisplayed = true;
				prevPopType = type;
				quickPop.show();
				quickPop.animate({left:0},100);
			}
		}
	};
	quickShell.bind('click.quick_links', function(e){
		e.stopPropagation();
	});
	quickPop.delegate('a.ibar_closebtn','click',function(){
		$(".quick_links_wrap").width(40);
		quickPop.hide();
		quickPop.animate({left:280,queue:true},100);
		$(".quick_links_panel").animate({"right":"0px"},100);
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
		
		var type = getHandlerType(this.className);
		if(type && quickHandlers[type]){
			quickHandlers[type].call(this);
			e.preventDefault();
		}
		
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


