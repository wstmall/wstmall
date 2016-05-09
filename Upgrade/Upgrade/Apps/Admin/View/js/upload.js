
//上傳文件

function getUploadFilename(sfilename,srcpath,thumbpath,fname){
	if(srcpath!="fail"){
		$("#s_"+sfilename).val(srcpath);
		$("#"+fname).val(srcpath);
		if(fname=="goodsImg"){
			$("#goodsThumbs").val(thumbpath);
		}
		$("#preview_"+sfilename).html("<img width='152' height='152' src='"+ThinkPHP.ROOT+"/"+thumbpath+"'/>");
		
	}else{
		$("#s_"+sfilename).val("");
		$("#"+fname).val("");
	}
}

function updfile(filename){
	
	var filepath = jQuery("#"+filename).val();
	var patharr = filepath.split("\\");
	var fnames = patharr[patharr.length-1].split(".");
	var ext = (fnames[fnames.length-1]);
		ext = ext.toLocaleLowerCase();	
	var flag = false;
	for(var i=0;i<filetypes.length;i++){
		if(filetypes[i]==ext){
			flag = true;
			break;
		}
	}
	
	if(flag){	
		jQuery("#uploadform_"+filename).submit();
	}else{		
		WST.msg("上传文件类型错误 (文档支持格式："+filetypes.join(",")+")");		
		jQuery('#uploadform_'+filename)[0].reset();
		return;
	}	
}
function uploadFile(opts){
	
	var _opts = {};
	_opts = $.extend(_opts,{auto: true,swf: ThinkPHP.PUBLIC +'/plugins/webuploader/Uploader.swf'},opts);
	var uploader = WebUploader.create(_opts);
	uploader.on('uploadSuccess', function( file,response ) {
	    var json = WST.toJson(response._raw);
	    if(_opts.callback)_opts.callback(json,file);
	    if(json.status==1){
	    	uploader.removeFile(file);
			uploader.refresh();
	    }
	});
	uploader.on('uploadError', function( file ) {
		//Plugins.Tips({title:'信息提示',icon:'error',content:'上传失败1',timeout:1000});
	});
	uploader.on( 'uploadProgress', function( file, percentage ) {
		if(_opts.progress)_opts.progress(percentage);
	});
	return uploader;
}