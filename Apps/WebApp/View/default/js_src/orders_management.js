//hash改变后触发
function changePage(){
    var actionName = window.location.hash.replace('#', '');
    actionName = actionName.split('&');
    if(actionName[0]=='details'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        $('#wst-footer').hide();
        var param = actionName[1].split('@@');
        getOrderDetails(param[0], param[1]);
    }else if(actionName[0]=='appraises'){
        $('#wst-page1').addClass('wst-page1');
        $('#wst-page2').show();
        $('#wst-footer').hide();
        var param = actionName[1].split('@@');
        getOrderAppraises(param[0], param[1]);
    }else{
        $('#wst-page1').show();
        $('#wst-page2').addClass('wst-page2');
        setTimeout(function(){
            $('body').removeClass('ajaxpage-active');
        },100);
        setTimeout(function(){
        	$('#wst-page1').removeClass('wst-page1');
            $('#wst-footer').show();
            $('#wst-page2').css('display','none');
        },500);
    }
}

var orderIdForCancel;//要取消的订单的id
var orderStatusForCancel;//要取消的订单的状态
var orderIdForComfirm;//要确认收货或拒收的订单的id
var cancelOrReject;//cancel:取消订单;reject:拒收订单

//加载订单详情页
function getOrderDetails(orderId, shopId){
    $('#wst-default-loading').modal();
    $.post(WST.U('WebApp/Orders/getOrderDetails'), {orderId:orderId,shopId:shopId}, function(data){
        var json = WST.toJson(data);
        var template = Handlebars.compile( $('#orderDetails').text() );
        Handlebars.registerHelper("compare",function(v1,v2,options){//注册一个比较大小的Helper,判断v1是否大于v2
            if(v1==v2){
                return options.fn(this);
            }else{
                return options.inverse(this);
            }
        });
        var info = {'info': json, 'rooturl': WST.ROOT};
        var html = template(info);
        $('#wst-page2').html(html);
        $('#wst-default-loading').modal('close');
        $('body').addClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-page1').hide();
    		$('#wst-page2').removeClass('wst-page2');
        	$(document).scrollTop(0);
        },300);
        json = template = json = html = null;
    });
}

function confirmCancelOrder(orderId, orderStatus){
    orderIdForCancel = orderId;
    orderStatusForCancel = orderStatus;
    wstConfirm('确定取消该订单吗？', toCancelOrder);
}

function toCancelOrder(){
    var param = {};
    if(orderStatusForCancel==-2 || orderStatusForCancel==0){//订单未付款或未受理
        cancelOrder(orderIdForCancel);
    }else if(orderStatusForCancel==1 || orderStatusForCancel==2){//订单已受理或打包中
        cancelOrReject = 'cancel';
        var options = {'closeViaDimmer': false};
        $('#wst-rejectionRemarks-popup').modal(options);
    }
}

//提交取消原因
function rejectionRemarks(){
    var rejectionRemarks = $('#rejectionRemarks').val();
    if(rejectionRemarks==''){
        wstMsg('原因不能为空', 'rejectionRemarks');
        return false;
    }
    $('#wst-rejectionRemarks-popup').modal('close');
    if(cancelOrReject=='cancel'){//取消订单
        cancelOrder(orderIdForCancel, rejectionRemarks);
    }else if(cancelOrReject=='reject'){//拒收订单
        comfirmOrder(orderIdForComfirm, 2);
    }
}

//关闭popup
function closePopup(){
    $('#wst-rejectionRemarks-popup').modal('close');
}

//取消订单
function cancelOrder(orderId, rejectionRemarks){
    var param = {};
    param.orderId = orderId;
    if(rejectionRemarks){
        param.rejectionRemarks = rejectionRemarks;
    }
    $.post(WST.U('WebApp/Orders/cancelOrder'), param, function(data){
        var json = WST.toJson(data);
        if(json.status!=-1){
            var status = $('#status').val();
            if(status==0){//当前栏是 全部
                wstMsg('订单取消成功');
                setTimeout(function(){
                    location.href = WST.U('WebApp/Orders/index');
                },2000);
            }else{
                setTimeout(function(){
                    $('#order'+orderIdForCancel).addClass('am-animation-slide-top am-animation-reverse');
                    setTimeout(function(){
                        wstMsg('订单取消成功');
                        $('#order'+orderIdForCancel).remove();
                    },500);
                },500);
            }
        }else{
            wstMsg('订单取消失败，请重试！');
        }
    });
}

function toConfirmOrder(orderId, receiptOrReject){
    orderIdForComfirm = orderId;
    if(receiptOrReject=='receipt'){
        wstConfirm('确认收货？', receiptOrder);
    }else if(receiptOrReject=='reject'){
        wstConfirm('确定拒收？', rejectOrder);
    }
}

function receiptOrder(){
    comfirmOrder(orderIdForComfirm, 1);
}

function rejectOrder(){
    cancelOrReject = 'reject';
    var options = {'closeViaDimmer': false};
    $('#wst-rejectionRemarks-popup').modal(options);
}

function comfirmOrder(orderId, type){
    var param = {};
    param.orderId = orderId;
    if(type==1){//确认收货
        param.type = 1;
    }else if(type==2){//拒收订单
        var rejectionRemarks = $('#rejectionRemarks').val();
        if(rejectionRemarks){
            param.rejectionRemarks = rejectionRemarks;
        }
    }
    $.post(WST.U('WebApp/Orders/confirmOrder'), param, function(data){
        var json = WST.toJson(data);
        if(json.status==1){
            if(type==1){
                var tips = '已确认收货'
            }else if(type==2){
                var tips = '已拒收'
            }
            var status = $('#status').val();
            if(status==0){//当前栏是 全部
                wstMsg(tips);
                setTimeout(function(){
                    location.href = WST.U('WebApp/Orders/index');
                },2000);
            }else{
                setTimeout(function(){
                    $('#order'+orderIdForComfirm).addClass('am-animation-slide-top am-animation-reverse');
                    setTimeout(function(){
                        wstMsg(tips);
                        $('#order'+orderIdForComfirm).remove();
                    },500);
                },500);
            }

        }else{
            wstMsg('操作失败，请重试！');
        }
    });
}

//付款
function toPay(orderId){
    location.href = WST.U('WebApp/Payments/toPay', 'orderId='+orderId);
}

//加载评价页
function getOrderAppraises(orderId){
    $('#wst-default-loading').modal();
    $('#orderId').val(orderId);
    $.post(WST.U('WebApp/Orders/getNoAppraiseOrderGoods'), {orderId: orderId}, function(data){
        var json = WST.toJson(data);
        var template = Handlebars.compile( $('#order-appraises').text() );
        //注册一个Handlebars Helper,用来将索引+1，因为默认是从0开始的
        Handlebars.registerHelper("goodsIndex",function(index,options){
            return parseInt(index)+1;
        });
        Handlebars.registerHelper("compare",function(v1,v2,options){
          if(v1==v2){
             return options.fn(this);
           }else{
             return options.inverse(this);
           }
        });
        var goodsInfo = {'info': json, 'rooturl': WST.ROOT};
        var html = template(goodsInfo);
        $('#wst-page2').html(html);
        $('#wst-default-loading').modal('close');
        $('body').addClass('ajaxpage-active');
        setTimeout(function(){ 
            $('#wst-page1').hide();
    		$('#wst-page2').removeClass('wst-page2');
        	$(document).scrollTop(0);
        },300);
        template = html = null;
    });
}

//商品评价
function clickStar(which, index){
    if(which==0){
        var where = 'goods';
    }else if(which==1){
        var where = 'time';
    }else{
        var where = 'service';
    }
    $('#'+where+'Score').val(index+1);
    for(var i=0; i<5; i++){
        if( i <= index ){
            $('.'+where+'-appraises').children('img.star').eq(i).attr('src', WST.ROOT +'/Apps/WebApp/View/default/images/1star.png');
        }else{
            $('.'+where+'-appraises').children('img.star').eq(i).attr('src', WST.ROOT +'/Apps/WebApp/View/default/images/gray_star.png');
        }
    }
    $('.'+where+'-tips'+index).show().siblings('span.appraises-tips').hide();
}

//提交商品评价
function submitAppraises(){
    var orderId = $('#orderId').val();
    var goodsId = $('#goodsId').val();
    var goodsAttrId = $('#goodsAttrId').val();
    var goodsName = $('#goodsName').html();
    var goodsScore = $('#goodsScore').val();
    var timeScore = $('#timeScore').val();
    var serviceScore = $('#serviceScore').val();
    var appraises = $('#appraises').val();
    if(goodsScore==''){
        wstMsg('请选择商品评分');
        return false;
    }
    if(timeScore==''){
        wstMsg('请选择时效评分');
        return false;
    }
    if(serviceScore==''){
        wstMsg('请选择服务评分');
        return false;
    }
    if( appraises.length < 3 || appraises.length > 50 ){
        wstMsg('点评内容为3-50个字');
        $('#appraises').focus();
        return false;
    }
    var param = {};
    param.orderId = orderId;
    param.goodsId = goodsId;
    param.goodsAttrId = goodsAttrId;
    param.goodsScore = goodsScore;
    param.timeScore = timeScore;
    param.serviceScore = serviceScore;
    param.content = appraises;
    $.post(WST.U('WebApp/Goods/addAppraises'), param, function(data){
        var json = WST.toJson(data);
        if(json.status==1){
            var html = '已评价<button type="button" class="am-btn am-btn-default am-btn-xs am-radius isappraises" onclick="scrollToAppraises('+json.id+',\''+goodsName+'\',1);">查看评价</button>';
            $('#isAppraises'+goodsId+'_'+goodsAttrId).html(html);
            $('#appraises-form').html('');
            wstMsg('评价成功');
        }else if(json.status==-1){
            wstMsg('该订单不存在');
        }else if(json.status==-2){
            wstMsg('亲，该商品已经评价过了~');
        }else{
            wstMsg('评价失败，请重试！');
        }
    });
}

//滚动到评价区
function scrollToAppraises(id, goodsName, type, goodsAttrId){
    $('#appraises-edit-container').show();
    var p = $('#appraises-edit-container').position();
    $(window).smoothScroll({position: p.top});//平滑滚动到评价区域
    $('#appraises-loading-icon').show();
    if(type==1){//查看评价
        $.post(WST.U('WebApp/Goods/getAppraiseById'), {id:id}, function(data){
            var json = WST.toJson(data);
            var template = Handlebars.compile( $('#goods-appraises').text() );
            Handlebars.registerHelper('list', function(score, options) {
                var out = '';
                for(var i=0; i<5; i++) {
                    if(i<score){
                        out += '<img class="star" src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/1star.png">';
                    }
                }
                return out;
            });
            var html = template({'info': json,'rooturl': WST.ROOT,'goodsId': goodsId});
            $('#appraises-form').html(html);
            $('#goodsName').html(goodsName);
            $('#appraises-loading-icon').hide();
            json = html = template = null;
        });
    }else{//添加评价
        $('#goodsId').val(id);
        $('#goodsAttrId').val(goodsAttrId);
        var template = Handlebars.compile( $('#goods-appraises').text() );
        Handlebars.registerHelper('list', function(options) {
            var out = "";
            for(var i=0; i<5; i++) {
                out += '<img class="star" src="'+ WST.ROOT +'/Apps/WebApp/View/default/images/gray_star.png" onclick="javascript:clickStar('+options+','+i+');">';
            }
            return out;
        });
        var html = template({'rooturl': WST.ROOT});
        $('#appraises-form').html(html);
        $('#goodsName').html(goodsName);
        $('#appraises-loading-icon').hide();
        html = template = null;
    }
}

//订单列表
function getOrderList(){
    $('#loading-icon').show();

	var param = {};
    param.pageSize = 10;
    param.currPage = Number( $('#currPage').val() ) + 1;
    param.status = Number( $('#status').val() );
    $.post(WST.U('WebApp/Orders/getOrderList'), param, function(data){
        var json = WST.toJson(data);
        var str = '';
        var orderStatus = {'-7':'用户取消','-6':'用户取消','-5':'商家不同意拒收','-4':'商家确认拒收','-3':'用户拒收','-2':'未付款','-1':'用户取消','0':'未受理','1':'已受理','2':'打包中','3':'待收货','4':'已收货'};
        
        if(json && json.root && json.root.length>0){
            for(var i=0; i<json.root.length; i++){
                str += '<div class="orders" id="order'+json.root[i].orderId+'">';
                str += '<div class="am-g orders-top">';
                str += '<div class="am-u-sm-7 orders-shopname">'+json.root[i].shopName+'</div>';
                str += '<div class="am-u-sm-5 orders-top-right">';
                str += '<span class="orders-status">';
                if(status==4){
                    str += '已收货';
                }else if(status==5){
                    str += '待评价';
                }else{
                    str += orderStatus[json.root[i].orderStatus];
                }
                if(json.root[i].orderStatus==-7||json.root[i].orderStatus==-6||json.root[i].orderStatus==-4||json.root[i].orderStatus==-1){
                    if(json.root[i].payType==1 && json.root[i].isPay==1){
                      str += (json.root[i].isRefund==1) ? '(已退款)' : '(未退款)';
                    }
                }
                str += '</span>';
                str += '</div></div>';
                if(json.root[i].data && json.root[i].data.length>0){
                    for(var j=0; j<json.root[i].data.length; j++){
                        str += '<a href="#details&'+json.root[i].orderId+'"><div class="am-g orders-middle">';
                        str += '<div class="am-u-sm-2"><img src="'+ WST.DEFAULT_IMG +'" data-echo="'+ WST.ROOT +'/'+json.root[i].data[j].goodsThums+'" class="orders-goods-img"></div>';
                        str += '<div class="am-u-sm-7"><span class="orders-goods-name">'+json.root[i].data[j].goodsName+'</span></div>';
                        str += '<div class="am-u-sm-3 orders-goods-price-area">';
                        str += '<span class="orders-goods-price">￥ '+json.root[i].data[j].goodsPrice+'</span>';
                        str += '<span class="orders-goods-num">x'+json.root[i].data[j].goodsNums+'</span>';
                        str += '</div></div></a>';
                    }
                }
                str += '<div class="am-g orders-bottom"><div class="am-u-sm-12">';
                if(json.root[i].orderStatus==-2 || json.root[i].orderStatus==0 || json.root[i].orderStatus==1 || json.root[i].orderStatus==2){
                    str += '<span class="cancel-order" onclick="javascript:confirmCancelOrder('+json.root[i].orderId+','+json.root[i].orderStatus+');">取消订单</span>';
                }
                if(json.root[i].orderStatus==-2){
                    str += '<span class="cancel-order" onclick="javascript:toPay('+json.root[i].orderId+');">付款</span>';
                }
                if(json.root[i].orderStatus==3){
                    str += '<span class="cancel-order" onclick="javascript:toConfirmOrder('+json.root[i].orderId+',\'receipt\');">确认收货</span>';
                    str += '<span class="cancel-order" onclick="javascript:toConfirmOrder('+json.root[i].orderId+',\'reject\');">拒收</span>';
                }
                if(json.root[i].orderStatus==4){
                    str += '<a href="#appraises&'+json.root[i].orderId+'"><span class="cancel-order">'+((json.root[i].isAppraises==0) ? '去评价' : '查看评价')+'</span></a>';
                }
                if( json.root[i].noComplains==1 && (json.root[i].orderStatus==-5 || json.root[i].orderStatus==-4 || json.root[i].orderStatus==-3 || json.root[i].orderStatus==4) ){
                    str += '<span class="cancel-order" onclick="javascript:goToComplains('+json.root[i].orderId+');">投诉</span>';
                }
                str += '</div>';
                var goodsCount = json.root[i].data ? json.root[i].data.length : '';
                str += '<div class="am-u-sm-12" style="text-align:right;">共 '+goodsCount+' 件商品  实付：<span class="orders-totalmoney">￥'+json.root[i].totalMoney+'</span></div></div>';
                str += '</div></div>';
            }
            $('#currPage').val(json.currPage)
            $('#totalPage').val(json.totalPage);
	        $('#orders-list').append(str);
	        echo.init();//图片懒加载
        }else{
            wstMsg('没有订单信息，快去下一个吧~');
        }
	    $('#loading-icon').hide();
    });
}

var currPage = totalPage = 0;
var loading = false;
$(document).ready(function(){
    initFooter('users');
    $('body').removeClass('am-with-fixed-header');
    getOrderList();

  	//各种状态的订单
    $('.condition-li').click(function(){
        $('#loading-icon').show();
        $(this).addClass('condition-active').siblings('li.condition-li').removeClass('condition-active');
        var status = $(this).attr('status');
        $('#status').val(status);
        $('#currPage').val(0);
    	$('#orders-list').html('');
        getOrderList();
    });

    $(window).scroll(function(){  
        if (loading) return;
        if ((5 + $(window).scrollTop()) >= ($(document).height() - $(window).height())) {
            currPage = Number( $('#currPage').val() );
            totalPage = Number( $('#totalPage').val() );
            if( totalPage > 0 && currPage < totalPage ){
                getOrderList();
            }
        }
    });
});