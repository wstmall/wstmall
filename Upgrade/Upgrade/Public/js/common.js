$.browser = {};
$.browser.mozilla = /firefox/.test(navigator.userAgent.toLowerCase()); 
$.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase()); 
$.browser.opera = /opera/.test(navigator.userAgent.toLowerCase()); 
$.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
var WST = WST?WST:{};
WST.v = '1.4.4';
WST.pageHeight = function(){
	if($.browser.msie){ 
		return document.compatMode == "CSS1Compat"? document.documentElement.clientHeight : 
		document.body.clientHeight; 
	}else{ 
		return self.innerHeight; 
	} 
};
//返回当前页面宽度 
WST.pageWidth = function(){ 
	if($.browser.msie){ 
		return document.compatMode == "CSS1Compat"? document.documentElement.clientWidth : 
		document.body.clientWidth; 
	}else{ 
		return self.innerWidth; 
	} 
};
WST.TreeSelector = function(item,data,rootId,defaultValue){ 
    this._data = data; 
    this._item = item; 
    this._rootId = rootId; 
    if(defaultValue)this.defaultValue = defaultValue;
} 
WST.TreeSelector.prototype.createTree = function(){ 
    var len =this._data.length; 
    for( var i= 0;i<len;i++){ 
         if ( this._data[i].pid == this._rootId){ 
              this._item.options.add(new Option(" "+this._data[i].text,this._data[i].id)); 
              for(var j=0;j<len;j++){ 
                   this.createSubOption(len,this._data[i],this._data[j]); 
              } 
         } 
    }
    if(this.defaultValue)this._item.value = this.defaultValue;
} 

WST.TreeSelector.prototype.createSubOption = function(len,current,next){ 
    var blank = ".."; 
    if ( next.pid == current.id){ 
         intLevel =0; 
         var intlvl =this.getLevel(this._data,this._rootId,current); 
         for(a=0;a<intlvl;a++) 
              blank += ".."; 
              blank += "├-"; 
              this._item.options.add(new Option(blank + next.text,next.id)); 
              for(var j=0;j<len;j++){ 
                   this.createSubOption(len,next,this._data[j]); 
              } 
         } 
    } 
    WST.TreeSelector.prototype.getLevel = function(datasources,topId,currentitem){ 

    var pid =currentitem.pid; 
    if( pid !=topId) 
    { 
         for(var i =0 ;i<datasources.length;i++) 
         { 
              if( datasources[i].id == pid) 
              { 
                   intLevel ++; 
                   this.getLevel(datasources,topId,datasources[i]); 
              } 
         } 
    } 
    return intLevel; 
}

// 只能輸入數字，且第一數字不能為0
WST.digitalOnly = function(obj) {
 	// 先把非数字的都替换掉
 	obj.value=obj.value.replace(/\D/g, "");
 	// 必须保证第一个为数字
 	//obj.value = obj.value.replace(/^0/g, "");
}
/**
 * 获取版本
 */
WST.getWSTMAllVersion = function(url){
	$.post(url,{},function(data,textStatus){
		var json = {};
		try{
	      if(typeof(data )=="object"){
			json = data;
	      }else{
			json = eval("("+data+")");
	      }
		}catch(e){}
	   if(json){
		   if(json.version && json.version!='same'){
			   $('.wstmall-version-tips').show();
			   $('#wstmall_version').html(json.version);
			   $('#wstmall_down').attr('href',json.downloadUrl);
		   }
		   if(json.accredit=='no'){
			   $('.wstmall-accredit-tips').show();
		   }
		   if(json.licenseStatus)$('#licenseStatus').html(json.licenseStatus);
	   }
	});
}
 /******************** 
 * 取窗口滚动条高度  
 ******************/  
 WST.getScrollTop = function()  
 {  
     var scrollTop=0;  
     if(document.documentElement&&document.documentElement.scrollTop)  
     {  
         scrollTop=document.documentElement.scrollTop;  
     }  
     else if(document.body)  
     {  
         scrollTop=document.body.scrollTop;  
     }  
     return scrollTop;  
 }  
   
 /******************** 
 * 取文档内容实际高度  
 *******************/  
 WST.getScrollHeight = function()  
 {  
     return Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);  
 }

 //只能輸入數字
 WST.isNumberKey = function(evt){
 	var charCode = (evt.which) ? evt.which : event.keyCode;
 	if (charCode > 31 && (charCode < 48 || charCode > 57)){
 		return false;
 	}else{		
 		return true;
 	}
 }  

 //只能輸入數字和小數點
 WST.isNumberdoteKey = function(evt){
 	var e = evt || window.event; 
 	var srcElement = e.srcElement || e.target;
 	
 	var charCode = (evt.which) ? evt.which : event.keyCode;			
 	if (charCode > 31 && ((charCode < 48 || charCode > 57) && charCode!=46)){
 		return false;
 	}else{
 		if(charCode==46){
 			var s = srcElement.value;			
 			if(s.length==0 || s.indexOf(".")!=-1){
 				return false;
 			}			
 		}		
 		return true;
 	}
 }

 //只能輸入數字和字母
 WST.isNumberCharKey = function(evt){
 	var e = evt || window.event; 
 	var srcElement = e.srcElement || e.target;	
 	var charCode = (evt.which) ? evt.which : event.keyCode;

 	if((charCode>=48 && charCode<=57) || (charCode>=65 && charCode<=90) || (charCode>=97 && charCode<=122) || charCode==8){
 		return true;
 	}else{		
 		return false;
 	}
 }

WST.isChinese = function(obj,isReplace){
 	var pattern = /[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/i
 	if(pattern.test(obj.value)){
 		if(isReplace)obj.value=obj.value.replace(/[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/ig,"");
 		return true;
 	}
 	return false;
 }   
 
 Number.prototype.toFixed = function(exponent){ 
      return parseInt(this * Math.pow(10, exponent)+0.5 )/Math.pow(10,exponent);
 }
 
//用户名判断 （可输入"_",".","@", 数字，字母）
 WST.isUserName = function(evt){
 	var e = evt || window.event; 
 	var srcElement = e.srcElement || e.target;	
 	var charCode = (evt.which) ? evt.which : event.keyCode;
 	if((charCode==95 || charCode==46 || charCode==64) || (charCode>=48 && charCode<=57) || (charCode>=65 && charCode<=90) || (charCode>=97 && charCode<=122) || charCode==8){
 		return true;
 	}else{		
 		return false;
 	}
 }
 
WST.isEmail =function(v){
		var tel = new RegExp("^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$");
		return(tel.test(v));
}   
//判断是否电话
WST.isTel = function(v){
	 var tel = new RegExp("^[[0-9]{3}-|\[0-9]{4}-]?(\[0-9]{8}|[0-9]{7})?$");
	 return(tel.test(v));
}
WST.isPhone = function(v){
	 var tel = new RegExp("^[1][0-9]{10}$");
	 return(tel.test(v));
}
//判断url
WST.isUrl = function(str){
    if(str==null||str=="") return false;
    var result=str.match(/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\’:+!]*([^<>\"])*$/);
    if(result==null)return false;
    return true;
}
//比较时间差
WST.getTimeDiff = function(startTime,endTime,diffType){
    //将xxxx-xx-xx的时间格式，转换为 xxxx/xx/xx的格式
    startTime = startTime.replace(/-/g, "/");
    endTime = endTime.replace(/-/g, "/");
    //将计算间隔类性字符转换为小写
    diffType = diffType.toLowerCase();
    var sTime = new Date(startTime); //开始时间
    var eTime = new Date(endTime); //结束时间
    //作为除数的数字
    var divNum = 1;
    switch (diffType) {
        case "second":
             divNum = 1000;
             break;
        case "minute":
             divNum = 1000 * 60;
             break;
        case "hour":
             divNum = 1000 * 3600;
             break;
        case "day":
             divNum = 1000 * 3600 * 24;
             break;
        default:
             break;
     }
     return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
}

/***
 * 获取字节数
 * @param str
 * @returns
 */
WST.getBytes = function(str) {
	var cArr = str.match(/[^\x00-\xff]/ig);
	return str.length + (cArr == null ? 0 : cArr.length);
};

/***
 * 判断最小字节数
 * @param o
 * @param minLength
 * @returns
 */
WST.checkMinLength = function(o,minLength){
	if(WST.getBytes(o)<=minLength){
		return false;
	}
	return true;
}
/***
 * 判断最大字节数
 * @param o
 * @param maxLength
 * @returns
 */
WST.checkMaxLength = function(o,maxLength){
	if(WST.getBytes(o)>maxLength){
		return false;
	}
	return true;
}
WST.msg = function(msg, options, func){
	var opts = {};
	//有抖動的效果,第二位是函數
	if(typeof(options)!='function'){
		opts = $.extend(opts,{time:2000,shade: [0.4, '#000000']},options);
		return layer.msg(msg, opts, func);
	}else{
		return layer.msg(msg, options);
	}
}
WST.toJson = function(str,notLimit){
	var json = {};
	try{
		if(typeof(str )=="object"){
			json = str;
		}else{
			json = eval("("+str+")");
		}
		if(!notLimit){
			if(json.status && json.status=='-999'){
				alert('对不起，您已经退出系统！请重新登录');
				if(window.parent){
					window.parent.location.reload();
				}else{
					location.reload();
				}
			}else if(json.status && json.status=='-998'){
				if(Plugins){
					Plugins.closeWindow();
					Plugins.Tips({title:'信息提示',icon:'error',content:'对不起，您没有操作权限，请与管理员联系',timeout:1000});
				}else{
					alert('对不起，您没有操作权限，请与管理员联系');
				}
				return;
			}
		}
	}catch(e){
		alert("系统发生错误:"+e.getMessage);
		json = {};
	}
	return json;
}
//把wst-panel-full样式的表单设置布满屏幕高度
$(function () {
	if($('.wst-panel-full').height()<WST.pageHeight())$('.wst-panel-full').height(WST.pageHeight()-3);
});


/***
 * 加载下拉搜索选项
 * @param loginName
 * @param namelist
 */
function loadSearchList(loginName,namelist){
	$("#"+loginName).keyup(function(event) {
		
		if(event.which == 38 || event.which == 40) {

			if($(".options").length>0){
				curRowIndex = (event.which == 38)?(curRowIndex-1):(curRowIndex+1);
				if(curRowIndex<1){
					curRowIndex = $(".options").length;
					$(".options")[0].style.backgroundColor = "white";
				}else if(curRowIndex>$(".options").length){
					curRowIndex = 1;						
					$(".options")[$(".options").length-1].style.backgroundColor = "white";
				}else{
					var preIdx = (event.which == 40)?(curRowIndex-2):curRowIndex;
					if(event.which == 40){
						if(curRowIndex>1)$(".options")[preIdx].style.backgroundColor = "white";
					}else{
						$(".options")[preIdx].style.backgroundColor = "white";
					}					
				}
				var obj = $(".options")[curRowIndex-1];
				obj.style.backgroundColor = "#E9E5E1";
				var optionId = obj.id;
			
				$("#"+loginName).val($("#"+optionId).html());
			}			
		}else if(event.which == 13){			
			var optionId = 0;
			if($(".options").length>0 && curRowIndex>=0){	
	
				var obj = $(".options")[curRowIndex-1];				
				optionId = obj.id;
				$("#"+loginName).val($("#"+optionId).html());
				$("#"+namelist).hide();
				$("#"+namelist).html("");
			}
			
		}else{
			var keywords = $.trim($("#loginName").val());
			var html = new Array();			
			if(keywords.length<1){		
				$("#"+namelist).hide();
				$("#"+namelist).html("");
				return;
			}else{
				if(keywords.indexOf("@")>=0){
					var works = keywords.split("@");
					var rworks = keywords.split("@")[0];
					var lworks = keywords.split("@")[1];					
					for(var i=0;i<emailList.length;i++){
						if(emailList[i].indexOf(lworks)==0){
							html.push("<div class='options' idx='"+i+"' id='nopt"+i+"' onmouseover='optionsOver(this,"+i+");' onclick='selectOpt("+i+")'>"+rworks+(i==0?"":"@")+emailList[i]+"</div>");
						}
					}
				}else{
					for(var i=0;i<emailList.length;i++){					
						html.push("<div class='options' idx='"+i+"' id='nopt"+i+"' onmouseover='optionsOver(this,"+i+");' onclick='selectOpt("+i+")'>"+keywords+(i==0?"":"@")+emailList[i]+"</div>");		
					}
				}				
				$("#"+namelist).show();
				$("#"+namelist).html(html.join(""));
			}			
		}
	});
}

/**
 * 去除url中指定的参数(用于分页)
 */
WST.splitURL = function(spchar){
	var url = location.href;
	var urlist = url.split("?");
	var furl = new Array();
	var fparams = new Array();
		furl.push(urlist[0]);
	if(urlist.length>1){
		var urlparam = urlist[1];
			params = urlparam.split("&");
		for(var i=0; i<params.length; i++){
			var vparam = params[i];
			var param = vparam.split("=");
			if(param[0]!=spchar){
				fparams.push(vparam);
			}
		}
		if(fparams.length>0){
			furl.push(fparams.join("&"));
		}
		
	}
	if(furl.length>1){
		return furl.join("?");
	}else{
		return furl.join("");
	}
}

/**
 * 替换url
 */
WST.replaceURL = function(url,ar){
	if(ar instanceof Array){
		for(var i=0;i<ar.length;i++){
			url = url.replace('__'+i,ar[i]);
		}
		return url;
	}else{
		return url.replace('__0',ar);
	}
}
/**
 * 截取字符串
 */
WST.cutStr = function (str,len)
{
	if(!str || str=='')return '';
	var strlen = 0;
	var s = "";
	for(var i = 0;i < str.length;i++)
	{
		if(strlen >= len){
			return s + "...";
		}
		if(str.charCodeAt(i) > 128)
			strlen += 2;
		else
			strlen++;
		s += str.charAt(i);
	}
	return s;
}
WST.checkChks = function(obj,cobj){
	$(cobj).each(function(){
		$(this)[0].checked = obj.checked;
	})
}
WST.getChks = function(obj){
	var ids = [];
	$(obj).each(function(){
		if($(this)[0].checked)ids.push($(this).val());
	});
	return ids;
}
WST.showHide = function(t,str){
	var s = str.split(',');
	if(t){
		for(var i=0;i<s.length;i++){
		   $(s[i]).show();
		}
	}else{
		for(var i=0;i<s.length;i++){
		   $(s[i]).hide();
		}
	}
	s = null;
}
WST.blank = function(str,defaultVal){
	if(str=='0000-00-00')str = '';
	if(str=='0000-00-00 00:00:00')str = '';
	if(!str)str = '';
	if(typeof(str)=='null')str = '';
	if(typeof(str)=='undefined')str = '';
	if(str=='' && defaultVal)str = defaultVal;
	return str;
}
WST.tips = function(content, selector, options){
	var opts = {};
	opts = $.extend(opts, {tips:1, time:2000, maxWidth: 260}, options);
	return layer.tips(content, selector, opts);
}
WST.open = function(options){
	var opts = {};
	opts = $.extend(opts, {}, options);
	return layer.open(opts);
}
WST.limitDecimal = function(obj,len){
	var s = obj.value;
 	if(s.indexOf(".")>-1){
	 	if((s.length - s.indexOf(".")-1)>len){
	 		obj.value = s.substring(0,s.indexOf(".")+len+1);
	 	}
	}
 	s = null;
}
WST.fillForm = function(obj){
	var params = {};
	var chk = {},s;
	$(obj).each(function(){
		if($(this)[0].type=='hidden' || $(this)[0].type=='number' || $(this)[0].type=='tel' || $(this)[0].type=='password' || $(this)[0].type=='select-one' || $(this)[0].type=='textarea' || $(this)[0].type=='text'){
			params[$(this).attr('id')] = $.trim($(this).val());
		}else if($(this)[0].type=='radio'){
			if($(this).attr('name')){
				params[$(this).attr('name')] = $('input[name='+$(this).attr('name')+']:checked').val();
			}
		}else if($(this)[0].type=='checkbox'){
			if($(this).attr('name') && !chk[$(this).attr('name')]){
				s = [];
				chk[$(this).attr('name')] = 1;
				$('input[name='+$(this).attr('name')+']:checked').each(function(){
					s.push($(this).val());
				});
				params[$(this).attr('name')] = s.join(',');
			}
		}
	});
	chk=null,s=null;
	return params;
}