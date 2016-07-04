//hash改变后触发
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&');
    if(actionName[0]=='orderInfo'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        $('#wst-footer').hide();
        getOrderInfo();
    }else if(actionName[0]=='getAddress'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        $('#wst-footer').hide();
        getAddress(actionName[1]);
    }else{
        $('.save-area').show();//显示 提交订单
        $('#wst-page1').show();
        $('#wst-page2').addClass('wst-page2');
        setTimeout(function(){
            $('body').removeClass('ajaxpage-active');
        }, 100);
        setTimeout(function(){
            $('#wst-footer').show();
        	$('#wst-page1').removeClass('wst-page1');
            $('#wst-page2').css('display','none');
        	$(document).scrollTop(0);
        }, 500);
    }
}

//加载收货地址
function getAddress(addressId){
    $('#wst-default-loading').modal();
    $.post(WST.U('WebApp/UsersAddress/getUserAddressForOrder'), {}, function(data){
        var json = WST.toJson(data);
        var template = Handlebars.compile( $('#addressForOrder').text() );
        Handlebars.registerHelper("compare",function(v1,v2,options){//注册一个比较大小的Helper,判断v1是否大于v2
            if(v1==v2){
                return options.fn(this);
            }else{
                return options.inverse(this);
            }
        });
        var html = template({'addressList':json, 'addressIdSelected': addressId});
        $('#wst-page2').html(html);
        $('#wst-default-loading').modal('close');
        $('body').addClass('ajaxpage-active');
        setTimeout(function(){ 
        	$('.save-area').hide();//隐藏 提交订单
            $('#wst-page1').hide();
        	$('#wst-page2').removeClass('wst-page2');
        	$(document).scrollTop(0);
        },300);
        data = template = json = html = null;
    });
}

//改变收货地址
function changeAddress(obj, addressId, userName, userPhone, areaName, address){
	$(obj).children('div.select-icon').html('<i class="am-icon-check usersex-check"></i>');
	$(obj).siblings().children('div.select-icon').html('');
	var str = '<a href="#getAddress&'+addressId+'"><div class="am-g am-g-collapse settlement"><div class="am-u-sm-11">'+userName+' &nbsp; '+userPhone+'<br>'+areaName+' &nbsp; '+address+'</div><div class="am-u-sm-1" style="text-align:right;padding-top:7px;"><i class="am-icon-angle-right am-icon-sm"></i></div></div></a>';
	$('#addressSelected').html(str);
	$('#addressId').val(addressId);
	window.location.hash = 'back';
}

//支付、配送、发票
function getOrderInfo(){
    $('#wst-default-loading').modal();
    $.post(WST.U('WebApp/Payments/getPayType'), {}, function(data){
        var json = WST.toJson(data);
        if(json){
            var payInfo = json;
            var template = Handlebars.compile( $('#invoiceInfo').text() );
		    Handlebars.registerHelper("compare",function(v1,v2,options){//注册一个比较大小的Helper,判断v1是否大于v2
		        if(v1==v2){
		            return options.fn(this);
		        }else{
		            return options.inverse(this);
		        }
		    });

		    var goodslist = [];
		    var goodsLength = $('.order-goods-img').length;//拟结算的商品数量
		    var invoiceStatus = 0;
		    var invoiceClientStatus = 0;
		    for(var i=0; i<goodsLength; i++){
		    	var goodsObj = $('.order-goods-img').eq(i);
		        var goodsImg = goodsObj.attr('src');
		        var shopName = goodsObj.siblings('.shopName').val();
		        var isInvoice = goodsObj.siblings('.isInvoice').val();
		        goodslist.push({'goodsImg':goodsImg, 'shopName':shopName, 'isInvoice':isInvoice});
		        if(isInvoice == 0){
		            invoiceStatus++;
		        }
		    }
		    if(invoiceStatus == goodsLength){//拟结算的所有商品所属的商家都不能开发票
		        invoiceClientStatus = 1;
		    }

		    var orderInfo = JSON.parse( storageGetItem('orderInfo') );
		    orderInfo = orderInfo ? orderInfo : {};

		    //将之前保存的支付方式放到payInfo里面便于在编译模板时做比较，以此给选中支付方式加上active的类名
		    for(var i in payInfo){
		    	payInfo[i].index = i;
		    	payInfo[i].payId = orderInfo.payId;
		    }

		    var htmlInfo = {
		        'payInfo': payInfo, 
		        'orderInfo': orderInfo, 
		        'deliveryType': orderInfo.deliveryType ? orderInfo.deliveryType : 0, 
		        'invoiceClientStatus': invoiceClientStatus, 
		        'goodslist': goodslist
		    };
		    var html = template(htmlInfo);
		    $('#wst-page2').html(html);
		    $('#wst-default-loading').modal('close');
		    $('.save-area').hide();//隐藏 提交订单
		    $('body').addClass('ajaxpage-active');
	        setTimeout(function(){ 
	        	$('.save-area').hide();//隐藏 提交订单
	            $('#wst-page1').hide();
        		$('#wst-page2').removeClass('wst-page2');
        		$(document).scrollTop(0);
	        }, 300);

	        //处理送达日期时间
		    var reach_date = '';
		    var startDay = 0;
		    var days = 3;
		    var startNum = getTimeOneHourLater();//一小时后的时间
		    if(startNum > 95){//这种情况下送达时间要从第二天算起
		        startDay = 1;
		        days = 4;
		        startNum = 0;
		    }
		    var reachDate = orderInfo.reachDate;//送达日期
		    var reachTime = orderInfo.reachTime;//送达时间
		    for(var i=startDay; i<days; i++){
		    	var theDate = getRelatedDate(i);
		        reach_date += '<option name="reachDate[]"';
		        reach_date += (reachDate == theDate) ? ' selected' : '';
		        reach_date += '>'+theDate+'</option>';
		    }
		    $('#requireDate').html(reach_date);
		    
			var currDate = getRelatedDate(0);//当前日期
		    if( !reachDate || reachDate == currDate ){
				createRequireTime(startNum, reachTime);
		    }else{
				createRequireTime(0, reachTime);
		    } 

		    htmlInfo = orderInfo = goodslist = template = html = reach_date = null;
        }else{
            wstMsg('请先选择支付方式');
        }
    });
}

//返回一小时后的时间，返回规则见变量times
function getTimeOneHourLater(){
    var d = new Date();   
    var currHour = d.getHours();
    var currMinutes = d.getMinutes();
    return currHour*4+(Math.ceil(currMinutes/15))+4;
} 

//获取当前日期之后几天的日期，days为0时表示获取当前日期
function getRelatedDate(days){
    var d = new Date();
    d.setDate(d.getDate()+days);
    var m = d.getMonth()+1;
    return d.getFullYear()+'-'+(m>=10?m:'0'+m)+'-'+(d.getDate()>=10?d.getDate():"0"+d.getDate());
} 

//更改期望送达日期
function changeRequireDate(obj){
	var startNum = getTimeOneHourLater();//一小时后的时间
	var currDate = getRelatedDate(0);//当前日期
	if( currDate != $(obj).val() ){
		startNum = 0;
	}
	createRequireTime(startNum);
} 

//期望送达时间
function createRequireTime(startNum, reachTime){
	var reach_time = '';
    for(var i=startNum; i<=96; i++){  
        if(times[i]){   
            reach_time += '<option name="reachTime[]"';
            reach_time += (reachTime == times[i]) ? ' selected' : '';
            reach_time += '>'+times[i]+'</option>';
        }       
    }
    $('#requireTime').html(reach_time);
} 

//更改支付方式
function changePayType(obj){
    $(obj).addClass('active').parent().siblings('.paytype-wrapper').children('.paytype').removeClass('active');
}

//更改配送方式
function changeDeliveryType(obj){
    $(obj).addClass('active').parent().siblings('.deliverytype-wrapper').children('.paytype').removeClass('active');
}

//保存支付配送发票等信息
function saveOrderInfo(){
	var paytypeButton = $('.paytype-wrapper button.active');
	var deliverytypeButton = $('.deliverytype-wrapper button.active');
    var deliverytypeValue = deliverytypeButton.attr('deliverytypeValue');
    $('#payType').html( paytypeButton.html() );
    if(deliverytypeValue == 1){
        $('#deliveryType').html('自提');
        $('#deliveryTotalMoney').html('0.00');
    }else{
        $('#deliveryType').html('不自提');
        $('#deliveryTotalMoney').html( Number($('#totalDeliveryMoneyHidden').val()).toFixed(2) );
    }
    calculateTotalMoney();//计算实时付款金额

    var invoiceClient = $('#invoiceClient').val();
    if(invoiceClient == ''){
        $('#isInvoice').html('不开发票');
    }else{
        $('#isInvoice').html('开发票');
    }

    //将此页的设置信息保存到localStorage中
    var orderInfo = {
    	payType: paytypeButton.attr('isOnline'),
    	payId: paytypeButton.attr('payId'),
    	deliveryType: deliverytypeValue,
    	isSelf: deliverytypeValue,
    	invoiceClient: invoiceClient,
    	orderRemarks: $('#orderRemarks').val(),
    	reachDate: $("#requireDate").val(),
    	reachTime: $("#requireTime").val(),
    	requireTime: $("#requireDate").val() + " " + $("#requireTime").val() + ":00"
    }
    storageSetItem('orderInfo', JSON.stringify(orderInfo));

    location.hash = '#back';
}

//提交订单
function submitOrders(){
	var addressId = $('#addressId').val();
    if(addressId == ''){
        wstMsg('请选择收货地址');
        return false;
    }
    var orderInfo = JSON.parse( storageGetItem('orderInfo') );
    orderInfo = orderInfo ? orderInfo : {};

    var param = {};
    param.addressId = addressId;//收货地址id
    param.payType = orderInfo.payType;//支付方式
    param.isSelf = orderInfo.isSelf;//是否自提
    param.invoiceClient = orderInfo.invoiceClient;//发票抬头
    param.orderRemarks = orderInfo.orderRemarks;//订单备注
    param.requireTime = orderInfo.requireTime;//送达时间
    param.isScorePay = Number( $('#scorePay').val() );//是否用积分支付

    $.post(WST.U('WebApp/Orders/addOrder'), param, function(data){
        var json = WST.toJson(data);
        if(json.status == 1){
        	storageRemoveItem('orderInfo');
            if(param.payType == 1){//在线支付
                location.href = WST.U('WebApp/Payments/toPay', 'orderId='+json.orderIds);
            }else{
                wstMsg('下单成功');
                setTimeout(function(){ 
                    location.href = WST.U('WebApp/Orders/index');
                }, 2000);
            }
        }else{
            wstMsg(json.msg);
        }
    });
}

//计算实时付款总金额
function calculateTotalMoney(){
    var goodsTotalMoney = Number( $('#totalMoney').html() );//商品总金额
    var deliveryTotalMoney = Number( $('#deliveryTotalMoney').html() );//运费总金额
    var totalMoney = goodsTotalMoney + deliveryTotalMoney;
    if( Number( $('#scorePay').val() ) == 1 ){
		var scoreMoney = Number( $('#scoreMoney').val() );//可用的积分支付总金额
    	totalMoney -= scoreMoney;
    }
	$('#payMoney').html( totalMoney.toFixed(2) );
}

//去新增收货地址
function addNewAddress(){
	//设置新增完成后的要返回到的目的页面URL
	storageSetItem('targetUrl', location.href);
	location.href = WST.U('WebApp/UsersAddress/index');
}

//送达时间段
var times = [
	"00:00", "00:15", "00:30", "00:45",
	"01:00", "01:15", "01:30", "01:45",
	"02:00", "02:15", "02:30", "02:45",
	"03:00", "03:15", "03:30", "03:45",
	"04:00", "04:15", "04:30", "04:45",
	"05:00", "05:15", "05:30", "05:45",
	"06:00", "06:15", "06:30", "06:45",
	"07:00", "07:15", "07:30", "07:45",
	"08:00", "08:15", "08:30", "08:45",
	"09:00", "09:15", "09:30", "09:45",
	"10:00", "10:15", "10:30", "10:45",
	"11:00", "11:15", "11:30", "11:45",
	"12:00", "12:15", "12:30", "12:45",
	"13:00", "13:15", "13:30", "13:45",
	"14:00", "14:15", "14:30", "14:45",
	"15:00", "15:15", "15:30", "15:45",
	"16:00", "16:15", "16:30", "16:45",
	"17:00", "17:15", "17:30", "17:45",
	"18:00", "18:15", "18:30", "18:45",
	"19:00", "19:15", "19:30", "19:45",
	"20:00", "20:15", "20:30", "20:45",
	"21:00", "21:15", "21:30", "21:45",
	"22:00", "22:15", "22:30", "22:45",
	"23:00", "23:15", "23:30", "23:45"
];

$(document).ready(function(){
    initFooter('cart');

    //计算默认的期望送达时间	
    var startDay = 0;
    var startNum = getTimeOneHourLater();//一小时后的时间
    if(startNum > 95){//这种情况下送达时间要从第二天算起
        startDay = 1;
        startNum = 0;
    }
    var reachDate = getRelatedDate(startDay);
    var reachTime = times[startNum];
    var requireTime = reachDate + " " + reachTime + ":00";	 

    var orderInfo = {
      addressId: $('#addressId').val(),
      payType: payType,
      isSelf: 0,
      requireTime: requireTime
    }
    storageSetItem('orderInfo', JSON.stringify(orderInfo));

    //积分支付
    $('#scorePayIcon').click(function(){
        if( $(this).attr('class').indexOf('active') != -1 ){
        	$(this).addClass('am-icon-circle-thin').removeClass('am-icon-check-circle active');
        	$('#scorePay').val(0);
        }else{
        	$(this).addClass('am-icon-check-circle active').removeClass('am-icon-circle-thin');
        	$('#scorePay').val(1);
        }
    	calculateTotalMoney();
    });
});