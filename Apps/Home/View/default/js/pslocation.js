!function ($) {
	$.extend({
		_jsonp : {
			scripts : {},
			counter : 1,
			charset : "gb2312",
			head : document.getElementsByTagName("head")[0],
			name : function (callback) {
				var name = "_jsonp_" + (new Date).getTime() + "_" + this.counter;
				this.counter++;
				var cb = function (json) {
					eval("delete " + name),
					callback(json),
					$._jsonp.head.removeChild($._jsonp.scripts[name]),
					delete $._jsonp.scripts[name]
				};
				return eval(name + " = cb"),
				name
			},
			load : function (a, b) {
				var c = document.createElement("script");
				c.type = "text/javascript",
				c.charset = this.charset,
				c.src = a,
				this.head.appendChild(c),
				this.scripts[b] = c
			}
		},
		getJSONP : function (a, b) {
			var c = $._jsonp.name(b),
			a = a.replace(/{callback};/, c);
			return $._jsonp.load(a, c),
			this
		}
	})
}
(jQuery);


var isUseServiceLoc = true; //是否默认使用服务端地址
var provinceHtml = '<div class="content"><div data-widget="tabs" class="m JD-stock" id="JD-stock">'
								+'<div class="mt">'
								+'    <ul class="tab">'
								+'        <li data-index="0" data-widget="tab-item" class="curr"><a href="#none" class=""><em>请选择</em><i></i></a></li>'
								+'        <li data-index="1" data-widget="tab-item" style="display:none;"><a href="#none" class=""><em>请选择</em><i></i></a></li>'
								+'    </ul>'
								+'    <div class="stock-line"></div>'
								+'</div>'
								+'<div class="mc" data-area="0" data-widget="tab-content" id="stock_area_item"></div>'
								+'<div class="mc" data-area="1" data-widget="tab-content" id="stock_town_item"></div>'
								+'</div></div>';
function getAreaList(result,level){
	var html = ["<ul class='area-list'>"];
	var longhtml = [];
	var longerhtml = [];
	if (result&&result.length > 0){
		for (var i=0,j=result.length;i<j ;i++ ){
			result[i].name = result[i].name.replace(" ","");
			if(level==2){
				if(result[i].name.length > 12){
					longerhtml.push("<li class='longer-area' areatype='2' onclick=chooseArea("+result[i].id+",'"+result[i].name+"')><a href='#none' data-value='"+result[i].id+"'>"+result[i].name+"</a></li>");
				}else if(result[i].name.length > 5){
					longhtml.push("<li class='long-area' areatype='2' onclick=chooseArea("+result[i].id+",'"+result[i].name+"')><a href='#none' data-value='"+result[i].id+"'>"+result[i].name+"</a></li>");
				}else{
					html.push("<li areatype='2' onclick=chooseArea("+result[i].id+",'"+result[i].name+"')><a href='#none' data-value='"+result[i].id+"'>"+result[i].name+"</a></li>");
				}
			}else{
				if(result[i].name.length > 12){
					longerhtml.push("<li class='longer-area' areatype='3' onclick='chooseTown(this)'><a href='#none' class='wst-town_"+result[i].id+"' data-value='"+result[i].id+"'>"+result[i].name+"</a></li>");
				}else if(result[i].name.length > 5){
					longhtml.push("<li class='long-area' areatype='3' onclick='chooseTown(this)'><a href='#none' class='wst-town_"+result[i].id+"' data-value='"+result[i].id+"'>"+result[i].name+"</a></li>");
				}else{
					html.push("<li areatype='3' onclick='chooseTown(this)'><a href='#none' class='wst-town_"+result[i].id+"'data-value='"+result[i].id+"'>"+result[i].name+"</a></li>");
				}
			}
		}
	}else{
		html.push("<li><a href='#none' data-value='"+currentAreaInfo.currentFid+"'> </a></li>");
	}
	html.push(longhtml.join(""));
	html.push(longerhtml.join(""));
	html.push("</ul>");
	return html.join("");
}
function cleanKuohao(str){
	if(str&&str.indexOf("(")>0){
		str = str.substring(0,str.indexOf("("));
	}
	if(str&&str.indexOf("（")>0){
		str = str.substring(0,str.indexOf("（"));
	}
	return str;
}

function getStockOpt(id,name){
	if(currentAreaInfo.currentLevel==3){
		currentAreaInfo.currentAreaId = id;
		currentAreaInfo.currentAreaName = name;
		if(!page_load){
			currentAreaInfo.currentTownId = 0;
			currentAreaInfo.currentTownName = "";
		}
	}else if(currentAreaInfo.currentLevel==4){
		currentAreaInfo.currentTownId = id;
		currentAreaInfo.currentTownName = name;
	}

	if(currentAreaInfo.currentLevel==4)$('#store-selector').removeClass('hover');
	//setCommonCookies(currentAreaInfo.currentProvinceId,currentLocation,currentAreaInfo.currentCityId,currentAreaInfo.currentAreaId,currentAreaInfo.currentTownId,!page_load);
	if(page_load){
		page_load = false;
	}
	//替换gSC
	
	var address = cleanKuohao(currentAreaInfo.currentCityName)+cleanKuohao(currentAreaInfo.currentAreaName)+cleanKuohao(currentAreaInfo.currentTownName);
	areaTabContainer.eq(0).removeClass("curr").find("em").html(cleanKuohao(currentAreaInfo.currentAreaName));
	$("#store-selector .text div").html(address).attr("title",address);
}
function getAreaListcallback(r,level){
	
	if (currentAreaInfo.currentLevel == 2){
		areaContainer.html(getAreaList(r,level));
		areaContainer.find("a").bind("click",function(){
			if(page_load){
				page_load = false;
			}
			$("#wst-test").html(areaContainer.attr("id"));
			currentAreaInfo.currentLevel=3;
			
			getStockOpt($(this).attr("data-value"),$(this).html());
		});
		if(page_load){ //初始化加载
			//alert("初始化加载");
			currentAreaInfo.currentLevel = currentAreaInfo.currentLevel==2?3:4;
			if(currentAreaInfo.currentAreaId && new Number(currentAreaInfo.currentAreaId)>0){
				getStockOpt(currentAreaInfo.currentAreaId,currentDom.find("a[data-value='"+currentAreaInfo.currentAreaId+"']").html());
			}else{
				getStockOpt(currentDom.find("a").eq(0).attr("data-value"),currentDom.find("a").eq(0).html());
			}
		}
	}else if (currentAreaInfo.currentLevel == 3){
		townaContainer.html(getAreaList(r,level));
		townaContainer.find("a").bind("click",function(){
			if(page_load){
				page_load = false;
			}
			$("#wst-test").html(townaContainer.attr("id"));
			
			currentAreaInfo.currentLevel=4;
		
			getStockOpt($(this).attr("data-value"),$(this).html());
		});
		if(page_load){ //初始化加载
			//alert("初始化加载");
			currentAreaInfo.currentLevel = currentAreaInfo.currentLevel==2?3:4;
			if(currentAreaInfo.currentAreaId && new Number(currentAreaInfo.currentAreaId)>0){
				getStockOpt(currentAreaInfo.currentAreaId,currentDom.find("a[data-value='"+currentAreaInfo.currentAreaId+"']").html());
			}else{
				getStockOpt(currentDom.find("a").eq(0).attr("data-value"),currentDom.find("a").eq(0).html());
			}
		}
	}
}
//选择城市
function chooseCity(cityId,cityName){
	var shopId = $("#shopId").val();
	currentAreaInfo.currentLevel = 2;
	currentAreaInfo.currentCityId = cityId;
	currentAreaInfo.currentCityName = cityName;
	if(!page_load){
		//alert("a");
		currentAreaInfo.currentAreaId = 0;
		currentAreaInfo.currentAreaName = "";
		currentAreaInfo.currentTownId = 0;
		currentAreaInfo.currentTownName = "";
	}
	
	areaTabContainer.eq(1).addClass("curr").show().find("em").html("请选择");
	areaContainer.show().html("<div class='iloading'>正在加载中，请稍候...</div>");
	townaContainer.hide();
	$.post(Think.U('Home/UserAddress/getShopDistricts'),{areaId2:cityId,shopId:shopId},function(data,textStatus){
		var json = WST.toJson(data);
		getAreaListcallback(json,2);
	});
	
	
}
//选择社区
function chooseTown(obj){
	//obj
}

function chooseArea(areaId,areaName){
	var shopId = $("#shopId").val();
	areaTabContainer.removeClass("curr");
	areaTabContainer.eq(1).addClass("curr").show();
	currentAreaInfo.currentLevel = 3;
	currentAreaInfo.currentAreaId = areaId;
	currentAreaInfo.currentAreaName = areaName;
	if(!page_load){
		currentAreaInfo.currentTownId = 0;
		currentAreaInfo.currentTownName = "";
	}
	baseDom = areaContainer;
	areaTabContainer.eq(0).removeClass("curr").find("em").html(areaName);
	areaTabContainer.eq(1).addClass("curr").show().find("em").html("请选择");
	areaContainer.hide();
	townaContainer.show().html("<div class='iloading'>正在加载中，请稍候...</div>");
	$.post(Think.U('Home/UserAddress/getShopCommunitys'),{districtId:areaId,shopId:shopId},function(data,textStatus){
		var json = WST.toJson(data);
		getAreaListcallback(json,3);
	});
}
$("#store-selector .text").after(provinceHtml);
var areaTabContainer=$("#JD-stock .tab li");
var areaContainer=$("#stock_area_item");
var townaContainer=$("#stock_town_item");
var baseDom = currentDom = areaContainer;
//当前地域信息
var currentAreaInfo;
//初始化当前地域信息
function CurrentAreaInfoInit(){
	currentAreaInfo =  {"currentLevel": 1,"currentProvinceId": 1,"currentProvinceName":"","currentCityId": 0,"currentCityName":"","currentAreaId": 0,"currentAreaName":"","currentTownId":0,"currentTownName":""};
	var ipLoc = getCookie("ipLoc-djd");
	ipLoc = ipLoc?ipLoc.split("-"):[1,72,0,0];
	
	if(ipLoc.length>1&&ipLoc[1]){
		currentAreaInfo.currentCityId = ipLoc[1];
	}
	if(ipLoc.length>2&&ipLoc[2]){
		currentAreaInfo.currentAreaId = ipLoc[2];
	}
	if(ipLoc.length>3&&ipLoc[3]){
		currentAreaInfo.currentTownId = ipLoc[3];
	}
}
var page_load = true;
(function(){
	$("#store-selector").unbind("mouseover").bind("mouseover",function(){
		$('#store-selector').addClass('hover');
		$("#store-selector .content,#JD-stock").show();
	}).find("dl").remove();
	CurrentAreaInfoInit();
	areaTabContainer.eq(0).find("a").click(function(){
		//alert("a");
		currentAreaInfo.currentLevel = 3;
		areaTabContainer.removeClass("curr");
		areaTabContainer.eq(0).addClass("curr").show();
		areaContainer.show();
		townaContainer.hide();
		areaTabContainer.eq(1).hide();
		
	});
	areaTabContainer.eq(1).find("a").click(function(){
		//alert("b");
		areaTabContainer.removeClass("curr");
		areaTabContainer.eq(1).addClass("curr").show();
		areaContainer.hide();
		townaContainer.show();
	});
	
	chooseCity(WST.CITY_ID,WST.CITY_NAME);
})();

function getCookie(name) {
	var start = document.cookie.indexOf(name + "=");
	var len = start + name.length + 1;
	if ((!start) && (name != document.cookie.substring(0, name.length))) {
		return null;
	}
	if (start == -1) return null;
	var end = document.cookie.indexOf(';', len);
	if (end == -1) end = document.cookie.length;
	return unescape(document.cookie.substring(len, end));
};





