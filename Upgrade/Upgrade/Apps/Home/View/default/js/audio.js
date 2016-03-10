var g_audio, audio, currAudioId;
//加载声音
function loadAudio(){				
	if((jQuery.browser.msie && (!$.support.leadingWhitespace))){//IE9以下版本
				
	}else{
		if(/i(Phone|P(o|a)d)/.test(navigator.userAgent)){//苹果产品			
			g_audio = window.g_audio = new Audio();
			var g_event = window.g_event =new function(){
			var events = ['load','abort','canplay','canplaythrough','durationchange','emptied','ended','error','loadeddata','loadedmetadata','loadstart','pause','play','playing','progress','ratechange','seeked','seeking','stalled','suspend','timeupdate','volumechange','waiting', 'mediachange'];
				g_audio.loop = false;
				g_audio.autoplay = true;
				g_audio.isLoadedmetadata = false;
				g_audio.touchstart = true;
				g_audio.paused = true;
				g_audio.audio = true;
				g_audio.elems = {};
				g_audio.isSupportAudio = function(type){
					type=type||"audio/mpeg";
					try{
						var r=g_audio.canPlayType(type);
						return g_audio.canPlayType&&(r=="maybe"||r=="probably")
					}catch(e){return false;}
				};
				g_audio.push = function(meta){						
					g_audio.previousId = g_audio.id;
					g_audio.id = meta.song_id;
					g_audio.previousSrc = g_audio.src;
					g_audio.previousTime = 0.00;
					g_audio.src = g_audio.currentSrc = meta.song_fileUrl;
					g_audio.isLoadedmetadata = false;
					g_audio.autobuffer = true;
					g_audio.load();
					g_audio.play();						
				};

				for(var i = 0, l = events.length; i < l; i++){
					(function(e){
						var fs = [];
						this[e] = function(fn){
							if(typeof fn!== 'function'){
								for (var k = 0; k<fs.length; k++){
									fs[k].apply(g_audio);
								}
								return ;
							}
							fs.push(fn);
							g_audio.addEventListener(e, function(){
								fn.apply(this);
							});
						};
					}).apply(this, [events[i]]);
				}					
				this.load(function(){						
					this.pause();
					this.play();
				});
				this.loadeddata(function(){
					this.pause();
					this.play();
				});
				this.loadedmetadata(function(){
					this.isLoadedmetadata = true;
				});
				this.ended(function(){});
			};				
		}else{//支付html5播放	
			createAudio();
		}
	}
}

//创建html5播放器
function createAudio(){
	if(document.getElementById('soundplay')){
		document.body.removeChild(document.getElementById('soundplay'));
	}
	audio = document.createElement("audio");
	document.body.appendChild(audio);
	for(var j=0;j<2;j++){
		var sour = document.createElement("source");		
		sour.src=ThinkPHP.DOMAIN+"/Apps/Home/View/default/audio/sound"+(j==0?".mp3":".ogg");					
		if(sour.src.indexOf('.ogg')>-1){
			sour.type = 'audio/ogg';
		}else{
			sour.type = 'audio/mpeg'; 
		}
		audio.appendChild(sour);
	}
	audio.id = 'soundplay';
	audio.type = 'audio/x-mpeg';
	//audio.addEventListener("canplaythrough", function(){}, false);
	//audio.addEventListener("ended", function(){});//当声音播放完后触发
	return;
}

//播放声音
function playsound(){
	pausesound();
	if((jQuery.browser.msie && (!$.support.leadingWhitespace))){	
		currAudioId = "player";		
		var audio = document.getElementById("player");		
		audio.url = ThinkPHP.DOMAIN+"/Apps/Home/View/default/audio/sound.mp3";		
		audio.controls.play();
		
	}else if(/i(Phone|P(o|a)d)/.test(navigator.userAgent)){		
		currAudioId = "soundplay";
		g_audio.push({song_id:"soundplay",song_fileUrl:"audio/sound.mp3"});	
	}else{		
		currAudioId = "soundplay";
		audio = document.getElementById("soundplay");		
		try {			
			if(audio.currentTime)audio.currentTime = 0;			
			audio.play();			
		} catch (e) { }		
	}	
}
//停止播放
function pausesound(){	
	if(/i(Phone|P(o|a)d)/.test(navigator.userAgent)){		
		g_audio.pause();
	}else{		
		try {
			if(jQuery.browser.msie && (!$.support.leadingWhitespace)){
				audio = document.getElementById("player");
				if(audio)audio.controls.stop();
			}else{
				audio = document.getElementById("soundplay");	
				if(audio)audio.pause();
			}		
		} catch (e) { }		
	}	
}
