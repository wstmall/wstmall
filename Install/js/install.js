$(document).ready(function(){
	if($('.check-1')[0])$('.nextBtn').attr('disabled',true);
    $('#admin_install').click(function(){
        var admin_name = $('#admin_name').val();
        var admin_password = $('#admin_password').val();
        var admin_password2 = $('#admin_password2').val();
        var dbHost = $('#dbHost').val();
        var dbUser = $('#dbUser').val();
        var dbPass = $('#dbPass').val();
        var dbPrefix = $('#dbPrefix').val();
        var dbName = $('#dbName').val();
        var curStep = Number( $('#curStep').val() );
            
        
        data = {
            action: 'admin_info',
            dbHost: dbHost,
            dbUser: dbUser,
            dbPass: dbPass,
            dbPrefix: dbPrefix,
            dbName: dbName,
            admin_name: admin_name,
            admin_password: admin_password
        };
        url = 'ajax.php';
        $(this).html('loading...');
        $.post(url,data,function(status){
        });
    });
});
function checkVal(name){
   if( $('#'+name).val() == ''){
        $('.'+name).show().addClass('red');
   }else{
    	$('.'+name).hide().removeClass('red');
   }
}
function initDataBase(){
	var check = true;
	var db_host = $('#db_host').val();
    var db_user = $('#db_user').val();
    var db_pass = $('#db_pass').val();
    var db_prefix = $('#db_prefix').val();
    var db_name = $('#db_name').val();
    var admin_name = $('#admin_name').val();
    var admin_password = $('#admin_password').val();
    var admin_password2 = $('#admin_password2').val();
    if( db_host == ''){
        $('.db_host').show().addClass('red');
        check = false;
    }
    if( db_user == ''){
        $('.db_user').show().addClass('red');
        check = false;
    }
    if( db_name == ''){
        $('.db_name').show().addClass('red');
        check = false;
    }
    if( admin_name == ''){
        $('.admin_name').show().addClass('red');
        check = false;
    }
    if( admin_password == ''){
        $('.admin_password').show().addClass('red');
        check = false;
    }
    if( admin_password2 == ''){
        $('.admin_password2').html('请再次输入密码').show().addClass('red');
        check = false;
    }
    if(admin_password != admin_password2 ){
        $('.admin_password2').html('两次输入的密码不正确').show().addClass('red');
        check = false;
    }
    if(!check)return;
    data = {
        db_host: db_host,
        db_user: db_user,
        db_pass: db_pass,
        db_name: db_name,
        db_prefix: db_prefix,
        db_demo: document.getElementById('db_demo').checked?1:0,
        admin_name:admin_name,
        admin_password:admin_password
    };
    url = 'include/install_api.php';
    $('#init_msg').show();
    $('.btn').hide();
    $.post(url,data,function(status){
        if(status==1){
        	location.href='index.php?step=3';
        }else{
        	$('#init_msg').hide();
            $('.btn').show();
            alert('数据库安装失败，请检查账户密码是否正确或该数据库是否存在');
        }
    });
}
function showStep(step){
	if(step==1){
		$('#step').val(1);
		$('#rnd').val(Math.random());
		$('#form1').submit();
	}else if(step==2){
		$('#step').val(2);
		$('#form1').submit();
	}else if(step==3){
		$('#step').val(3);
		initDataBase();
	}else if(step==4){
		$('#step').val(4);
		$('#form1').submit();
	}else if(step==5){
		$('#step').val(5);
		$('#form1').submit();
	}
}
