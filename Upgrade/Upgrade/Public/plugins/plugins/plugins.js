
var Plugins = {};
/**从uikit移植过来的通知消息**/
Plugins.notify = function(opts){
	var Message = function(opts){
		var defaults = {
				 msg: '',
				 status:'',	 
				 timeout:1000,
				 pos: 'top-right',
				 onClose: function() {}
	    }; 
	    this._opts = $.extend(defaults, opts);
	    this.uuid    = "ID"+(new Date().getTime())+"RAND"+(Math.ceil(Math.random() * 100000));
	    this.element = $(['<div class="alert wst-notify-message" role="alert">',
	                      this._opts.msg,
	                '</div>'].join('')).data("notifyMessage", this);
	    if($('.wst-notify-'+this._opts.pos).length==0)$('<div class="wst-notify wst-notify-'+this._opts.pos+'"></div>').appendTo('body');
	    if (this._opts.status) {
	        this.element.addClass('alert-'+this._opts.status);
	    }
	    $(this.element).appendTo('.wst-notify-'+this._opts.pos);
	}
	$.extend(Message.prototype, {
		show: function() {
			var $this = this;
			$(this.element).appendTo('.wst-notify-'+this._opts.pos);
		    var marginbottom = parseInt(this.element.css("margin-bottom"), 10);
		    var closefn = function(){$this.close();};
		    this.element.css({"opacity":0, "margin-top": -1*this.element.outerHeight(), "margin-bottom":0}).animate({"opacity":1, "margin-top": 1, "margin-bottom":marginbottom}, function(){
		         setTimeout(closefn, $this._opts.timeout);
		    });
		},
	    close: function(){
	    	var $this = this;
	    	this.element.animate({"opacity":0, "margin-top": -1* this.element.outerHeight(), "margin-bottom":0}, function(){
	    		$this.element.remove();
	    		if(!$('.wst-notify'+$this._opts.pos).children().length){
	    			$('.wst-notify'+$this._opts.pos).hide();
	    		}
	        });
	    }
	});
    return new Message(opts).show();
}
/**
 * 物件效果
 **/
Plugins.animation = function(opts){
	this.shake = function(_opts){
		var a=['top','left'],b=0; 
		var u=setInterval(function(){ 
			$(_opts.target).css(a[b%2],(b++)%4<2?0:4); 
			if(b>15){clearInterval(u);b=0} 
		},32);
	}
	switch(opts.type){
	   case 'shake':this.shake(opts);break;
	}
}
/**
 * 彈出窗口效果
 * opts = {title:'窗體標題',titleClose:'是否要右上角的關閉按鈕',content:'窗體內容',buttons:[{title:'按鈕名稱',css:'按鈕自定義樣式',callback:function(){//按鈕點擊事件}}],callback:function(){//窗體顯示時的事件}}
 **/
Plugins.WManager = [];
Plugins.window = function(opts){
	var defaults = {
			id: 'wst'+new Date().getTime(),
			buttons:[],
			title:'',
			content:'',
			width:600,
			height:0,
			callback: function() {}
    }; 
	this._opts = $.extend(defaults, opts);
	this.elementStr = ['<div class="modal fade " data-backdrop="static" id="'+this._opts.id+'" '+(this._opts.zIndex?this._opts.zIndex:'style="z-index:2000"')+'>',
					  '<div class="modal-dialog">',
					    '<div class="modal-content">',
					      '<div class="modal-header">',
					      (opts.titleClose?'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>':''),
					        '<h4 class="modal-title"><b>'+this._opts.title+'</b></h4>',
					      '</div>',
					      '<div class="modal-body">',
					      this._opts.content,
			        '</div>'];
	if(this._opts.buttons && this._opts.buttons.length>0){
		this.elementStr.push('<div class="modal-footer">');
		for(var i=0;i<this._opts.buttons.length;i++){
			if(this._opts.buttons[i].map && this._opts.buttons[i].map=='close'){
				this.elementStr.push('<button type="button" id="'+this._opts.id+'_'+i+'" class="btn '+(this._opts.buttons[i].css?this._opts.buttons[i].css:'')+'" data-dismiss="modal">'+this._opts.buttons[i].text+'</button>');
			}else{
			    this.elementStr.push('<button type="button" id="'+this._opts.id+'_'+i+'" class="btn '+(this._opts.buttons[i].css?this._opts.buttons[i].css:'')+'">'+this._opts.buttons[i].text+'</button>');
			}
		}
		this.elementStr.push('</div>');
	}
	this.elementStr.push('</div></div></div>');
	this.element = $(this.elementStr.join(''));
	this.element.appendTo('body');
    if(this._opts.buttons && this._opts.buttons.length>0){
    	var $this = this;
    	for(var i=0;i<$this._opts.buttons.length;i++){
    		if($this._opts.buttons[i].callback)$('#'+$this._opts.id+'_'+i).bind('click',$this._opts.buttons[i].callback);
    	}
    }
    if(this._opts.width)this.element.find('.modal-dialog').width(this._opts.width);
    if(this._opts.height)this.element.find('.modal-dialog').height(this._opts.height);
    this.element.find('.modal-dialog').css('margin-left',(WST.pageWidth()-this._opts.width)/2);
    this.element.find('.modal-dialog').css('margin-top',(window.screen.availHeight-this._opts.height)/8);
    $('#'+this._opts.id).delegate('[data-dismiss="modal"]', 'click.dismiss.modal', function(){
		Plugins.closeWindow();
	});
    this.element.modal('show');
	
	Plugins.WManager.push($('#'+this._opts.id));
	if(this._opts.callback)this._opts.callback();
}
/**
 * 關閉當前窗體
 */
Plugins.closeWindow = function(v){
	if(!v)v = Plugins.WManager[Plugins.WManager.length-1].attr('id');
	for(var i=Plugins.WManager.length-1;i>=0;i--){
		if(v==Plugins.WManager[i].attr('id')){
			if(Plugins.WManager[i]){
				Plugins.WManager[i].remove();
				Plugins.WManager.splice(Plugins.WManager[i],1);
				$('.modal-backdrop').remove();
				if(Plugins.WManager.length==0)$('body').removeClass('modal-open');
			}
		}
	}
}
/**
 * 確認框
 * opts = {title:'窗體標題',content:'窗體內容',okText:'確認按鈕標題',okfun:function(){//確定按鈕事件},cancelText:'取消按鈕標題',cancelFun:function(){//取消按鈕事件}}
 */
Plugins.confirm = function(opts){
	var defaults = {
			id: 'wst'+new Date().getTime(),
			width:300,
			titleClose:true,
			zIndex:2000,
			buttons:[
			   {text:opts.okText?opts.okText:'OK',css:'btn-success',callback:opts.okFun},
			   {text:opts.cancelText?opts.cancelText:'Cancel',map:'close',callback:opts.cancelFun}
			],
			title:opts.title?opts.title:'Warning',
			content:opts.content
    };
	Plugins.window(defaults);
}
/**
 * 提示框
 * opts = {title:'窗體標題',content:'窗體內容',okText:按鈕文字,okFun:按鈕點擊事件}
 */
Plugins.Alert = function(opts){
	var defaults = {
			id: 'wst'+new Date().getTime(),
			width:300,
			titleClose:true,
			zIndex:2000,
			buttons:[
			   {text:opts.okText?opts.okText:'OK',css:'btn-success',callback:(opts.okFun?opts.okFun:function(){Plugins.closeWindow();})}
			],
			title:opts.title?opts.title:'Warning',
			content:opts.content
    };
	Plugins.window(defaults);
}
/**
 * 操作等待及結果提示
 * opts = {title:'信息提示',content:'正在處理中...',callback:提示框出現后的事件}
 */
Plugins.waitTips = function(opts){
	var _id = 'wst'+new Date().getTime();
	var defaults = {
			id: _id,
			width:300,
			zIndex:2000,
			title:opts.title?opts.title:'Message',
			content:opts.content,
			callback:function(){
		       	if(opts.callback)opts.callback();
	        }
    };
	Plugins.window(defaults);
}
/**
 * 修改提示框文字
 * opts = {content:'正在處理中...',timeout:提示框關閉的時間(默認1秒),callback:修改文字后的事件}
 */
Plugins.setWaitTipsMsg = function(opts){
	$("#"+Plugins.WManager[Plugins.WManager.length-1].attr('id')+' .modal-body').html(opts.content);
	setTimeout(function(){
   	   Plugins.closeWindow();
   	   if(opts.callback)opts.callback();
    },opts.timeout?opts.timeout:1000);
}

/**
 * 提示信息
 * opts = {title:'窗體標題',icon:'提示類型(warn/correct/error/info)',content:'窗體內容',timeout:延時多久自動關閉(默認1秒)}
 */
Plugins.Tips = function(opts){
	var defaults = {
			id: 'wst'+new Date().getTime(),
			width:300,
			zIndex:2000,
			title:opts.title?opts.title:'Message',
			content:opts.content,
			callback:function(){
		         setTimeout(function(){
		        	 Plugins.closeWindow();
		        	 if(opts.callback)opts.callback();
		         },opts.timeout?opts.timeout:1000);
	        }
    };
	Plugins.window(defaults);
}
/**
 * 图片自适应大小
 * opts = {width:父容器的寬度,height:父容器的高度}
 */
$.fn.adjustImgage = function(opts) { 
	var loadImgage = function(obj){
		if(jQuery.browser.msie){
		    var img=new Image();
		    img.src=obj.attr('ref');
			img.style.display="none";
	        if(img.readyState=="complete"){
	        	adjust(opts,img,obj);
	        }else{
	             img.onreadystatechange=function(){
	                 if(img.readyState=='complete'){
	                	 adjust(opts,img,obj);
	                 }
			     }
			}
		}else{
		    var img=new Image();
		    img.src=obj.attr('ref');
			img.onload = function () {
			    if (img.complete == true){
			    	adjust(opts,img,obj);
			    }
			}
		}
		img.onerror=function(){
		   //alert('无法加载图片!');
		}
	}
	var adjust = function(opts,img,obj){
		var sacle = img.height/img.width;
		if(img.height<img.width ){
			if(img.width<opts.width){
    			img.width = opts.width;
    			img.height = img.width*sacle;
		    }
		}else{
			if(img.height<opts.height){
    			img.height = opts.height;
    			img.width = img.height/sacle;
			}
		}
		var wh = {width:img.width,height:img.height};
	    if(img.height>opts.height)wh = {width:(img.width*opts.height/img.height),height:opts.height};
	    if(wh.width>opts.width)wh = {width:opts.width,height:(wh.height*opts.width/wh.width)};
		var dw = (opts.width-wh.width)/2;
	    var dh = (opts.height-wh.height)/2;
	    obj.attr({width:wh.width,height:wh.height,src:obj.attr('ref')});
	    obj.css('margin-left',dw+'px').css('margin-top',dh+'px');
	}
	return this.each(function() { 
		loadImgage($(this));
	});
};
Plugins.Modal = function(opts){
	var defaults = {
			id: 'wst'+new Date().getTime(),
			buttons:[],
			title:'',
			content:'',
			width:600,
			height:0,
			titleClose:true,
			callback: function() {}
    }; 
	this._opts = $.extend(defaults, opts);
	
	this.elementStr = ['<div class="modal fade " data-backdrop="static" id="'+this._opts.id+'">',
					  '<div class="modal-dialog">',
					    '<div class="modal-content">',
					      '<div class="modal-header">',
					      (opts.titleClose?'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>':''),
					        '<h4 class="modal-title"><b>'+this._opts.title+'</b></h4>',
					      '</div>',
					      '<div class="modal-body">loading...',
			        '</div>'];
	if(this._opts.buttons && this._opts.buttons.length>0){
		this.elementStr.push('<div class="modal-footer">');
		for(var i=0;i<this._opts.buttons.length;i++){
			if(this._opts.buttons[i].map && this._opts.buttons[i].map=='close'){
				this.elementStr.push('<button type="button" id="'+this._opts.id+'_'+i+'" class="btn '+(this._opts.buttons[i].css?this._opts.buttons[i].css:'')+'" data-dismiss="modal">'+this._opts.buttons[i].text+'</button>');
			}else{
			    this.elementStr.push('<button type="'+(this._opts.buttons[i].type?this._opts.buttons[i].type:'button')+'" id="'+(this._opts.buttons[i].id?this._opts.buttons[i].id:this._opts.id+'_'+i)+'" class="btn '+(this._opts.buttons[i].css?this._opts.buttons[i].css:'')+'">'+this._opts.buttons[i].text+'</button>');
			}
		}
		this.elementStr.push('</div>');
	}
	this.elementStr.push('</div></div></div>');
	this.element = $(this.elementStr.join(''));
	this.element.appendTo('body');
	$(".modal-body").load(this._opts.url,function(){});
	
    if(this._opts.buttons && this._opts.buttons.length>0){
    	var $this = this;
    	for(var i=0;i<$this._opts.buttons.length;i++){
    		if($this._opts.buttons[i].type!='submit' && $this._opts.buttons[i].callback)$('#'+(this._opts.buttons[i].id?this._opts.buttons[i].id:this._opts.id+'_'+i)).bind('click',$this._opts.buttons[i].callback);
    	}
    }
    if(this._opts.width)this.element.find('.modal-dialog').width(this._opts.width);
    if(this._opts.height)this.element.find('.modal-dialog').height(this._opts.height);
    this.element.find('.modal-dialog').css('margin-left',(WST.pageWidth()-this._opts.width)/2);
    this.element.find('.modal-dialog').css('margin-top',(WST.pageHeight()-this._opts.height)/4);
    $('#'+this._opts.id).delegate('[data-dismiss="modal"]', 'click.dismiss.modal', function(){
		Plugins.closeWindow();
	});
    this.element.modal('show');
	
	Plugins.WManager.push($('#'+this._opts.id));
	if(this._opts.callback)this._opts.callback();
}
/**
 * tabpanel
 */
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