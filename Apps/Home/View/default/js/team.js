//倒计时
function list_time(){        
	$(".times").each(function(){
	    var time_now = new Date();  // 获取当前时间
        time_now = time_now.getTime();
        
		var goodsId = $(this).attr("goodsId");
		var time_end = new Date($(this).attr("times"));// 设定结束时间
		time_end = time_end.getTime();
		
	    var time_distance = time_end - time_now;  // 结束时间减去当前时间
	    var int_day, int_hour, int_minute, int_second;
	    if(time_distance >= 0){
	        // 天时分秒换算
	        int_day = Math.floor(time_distance/86400000)
	        time_distance -= int_day * 86400000;
	        int_hour = Math.floor(time_distance/3600000)
	        time_distance -= int_hour * 3600000;
	        int_minute = Math.floor(time_distance/60000)
	        time_distance -= int_minute * 60000;
	        int_second = Math.floor(time_distance/1000)
	 
	        // 时分秒为单数时、前面加零站位
	        if(int_hour < 10)
	        int_hour = "0" + int_hour;
	        if(int_minute < 10)
	        int_minute = "0" + int_minute;
	        if(int_second < 10)
	        int_second = "0" + int_second;
	        
	        // 显示时间
	        $('.time_d'+goodsId).html(int_day);
	        $('.time_h'+goodsId).html(int_hour);
	        $('.time_m'+goodsId).html(int_minute);
	        $('.time_s'+goodsId).html(int_second);
	        
	        setTimeout("list_time()",1000);
	    }else{
	        $('.time_d'+goodsId).html('00');
	        $('.time_h'+goodsId).html('00');
	        $('.time_m'+goodsId).html('00');
	        $('.time_s'+goodsId).html('00');
	    }
	});
};