//计算总金额
function calculateTotalMoney(){
    var goodsCount = $('.check-icon').length;//商品个数
    var totalMoney = 0;//合计金额
    var totalMoneyIconStatus = false;
    for(var i=0; i<goodsCount; i++){
        if( $('.check-icon').eq(i).attr('class').indexOf('active') != -1 ){
		    var goodsNum = Number( $('.check-icon').eq(i).attr('goodsNum') );
		    var shopPrice =  Number( $('.check-icon').eq(i).attr('shopPrice') );
            totalMoneyIconStatus = true;
            totalMoney += goodsNum*shopPrice;//金额相加
        }
    }
    if( totalMoneyIconStatus ){
        changeIconStatus($('.total-icon'), 2, 'active');
    }else{
        changeIconStatus($('.total-icon'), 2);
    }
    $('#total-money').html(totalMoney.toFixed(2));

    calculateDeliveryMoney();
}

//计算店铺的运费
function calculateDeliveryMoney(){
    var goodsCount = $('.check-icon').length;//商品个数
    var shopCount = $('.shop-check-icon').length;//店铺个数
    for(var i=0; i<shopCount; i++){
        var shop = $('.shop-check-icon').eq(i).attr('shop');
        var shopGoodsMoney = 0;
	    for(var j=0; j<goodsCount; j++){
	        if( $('.check-icon').eq(j).attr('shop') == shop && $('.check-icon').eq(j).attr('class').indexOf('active') != -1 ){
		    	var goodsNum = Number( $('.check-icon').eq(j).attr('goodsNum') );
		    	var shopPrice =  Number( $('.check-icon').eq(j).attr('shopPrice') );
		    	shopGoodsMoney += goodsNum * shopPrice;
	        }
	    }
        var deliveryFreeMoney = Number( $('.shop-check-icon').eq(i).attr('deliveryFreeMoney') );//包邮起步价
	    var msg = '';
	    if( deliveryFreeMoney == 0 ){
	        msg += '店铺免运费';
	    }else if( deliveryFreeMoney > shopGoodsMoney ){
	        msg += '满'+ deliveryFreeMoney.toFixed(2) +'元免运费，差'+ (deliveryFreeMoney - shopGoodsMoney).toFixed(2) +'元';
	    }else{
	        msg += '购买商品已达到'+ deliveryFreeMoney.toFixed(2) +'元，店铺免运费';
	    }
	    var shopMsg = $('.shop-check-icon').eq(i).attr('childrenId');
	    $('#'+shopMsg).html(msg);
    }
}

//弹窗
function wstAlert(msg){
    $('#alertMsg').html(msg);
    var options = {closeViaDimmer:false};
    $('#wst-alert').modal(options);
}

//删除购物车中的商品
function delGoodsFromCart(){
    var goodsIconCount = $('.check-icon').length;//商品个数
    var cartIds = '';
    for(var i=0; i<goodsIconCount; i++){
        if( $('.check-icon').eq(i).attr('class').indexOf('active') != -1 ){
            cartIds += Number( $('.check-icon').eq(i).attr('cartId') ) + '#';
        }
    }
    $.post(WST.U('WebApp/Cart/delCartGoods'), {cartIds:cartIds}, function(data){
        var json = WST.toJson(data);
        if(json.status==1){
            wstMsg('删除成功');
            setTimeout(function(){
                location.href = WST.U('WebApp/Cart/index');
            }, 2000);
        }
    });
}

//修改数量
function changeNum(goodsId, goodsAttrId, shopPrice, flag){
    var num = parseInt( $("#goodsCount_"+goodsId+'_'+goodsAttrId).val(), 10);
    var num = num ? num : 1;
    if(flag == 1){
        if(num > 1){
        	num = num - 1;
        }
    }else if(flag == 2){
        num = num + 1;
    }
    $('#goods_'+goodsId).attr('goodsNum', num);
    changeCartGoodsNum(goodsId, goodsAttrId, num, shopPrice);
}

//修改购物车商品的数量
function changeCartGoodsNum(goodsId, goodsAttrId, goodsNum, shopPrice, isCheck){
    var isCheck = (isCheck==0 || isCheck==1)  ? isCheck : -1;
    var param = {};
    param.goodsId = goodsId;
    param.goodsAttrId = goodsAttrId;
    param.num = goodsNum;
    param.isCheck = isCheck;
    $.post(WST.U('WebApp/Cart/changeCartGoodsNum'), param, function(data){
        var json = WST.toJson(data);
        if(json.status == -2){
            wstMsg('库存不足，当前库存：'+json.goodsStock);
        }else if(json.status == 1){
            $("#goodsCount_"+goodsId+'_'+goodsAttrId).val(goodsNum);
            calculateTotalMoney();//计算所有商品的总金额
        }
    });
}

//勾选/取消勾选商品
function changeIsCheck(obj){
    var goodsNum = Number( $(obj).attr('goodsNum') );
	if(goodsNum<=0){
        wstMsg('购买数量不能小于1');
        return false;
    }
    var goodsId = Number( $(obj).attr('goodsId') );
    var goodsAttrId = Number( $(obj).attr('goodsAttrId') );
    var shopPrice =  Number( $(obj).attr('shopPrice') );
    var isCheck =  Number( $(obj).attr('isCheck') );
    changeCartGoodsNum(goodsId, goodsAttrId, goodsNum, shopPrice, isCheck);
}

$(document).ready(function(){
    initFooter('cart');
    calculateTotalMoney();
    
    //选中店铺
    $('.shop-check-icon').click(function(){
        changeIconStatus($(this), 1);
        var childrenId = $(this).attr('childrenId');
        var isCheck = ( $(this).attr('class').indexOf('active') == -1 ) ? 0 : 1;
        if( $(this).attr('class').indexOf('active') == -1 ){//取消选中
            changeIconStatus($('.'+childrenId), 2);
        }else{//选中
            changeIconStatus($('.'+childrenId), 2, 'active');
        }

        var shop = $(this).attr('shop');
        var goodsCount = $('.check-icon').length;//商品个数
	    for(var i=0; i<goodsCount; i++){
	        if( $('.check-icon').eq(i).attr('shop') == shop ){
            	$('.check-icon').eq(i).attr('isCheck', isCheck);
        		changeIsCheck( $('.check-icon').eq(i) );
	        }
	    }
    });
    //选中商品
    $('.check-icon').click(function(){
        changeIconStatus($(this), 1);
        var parentId = $(this).attr('parentId');
        var goodsId = Number( $(this).attr('goodsId') );
        if( $(this).attr('class').indexOf('active') == -1 ){//取消选中
            changeIconStatus($('.'+parentId), 2);
            $(this).attr('isCheck', 0);
        }else{//选中
            var childrenId = $('.'+parentId).attr('childrenId');
            var goodsCount = $('.'+childrenId).length;//商品个数
            var isActive = 0;
            for(var i=0; i<goodsCount; i++){
                if( $('.'+childrenId).eq(i).attr('class').indexOf('active') != -1 ){
                    isActive++;
                }
            }
            if(isActive == goodsCount){
                changeIconStatus($('.'+parentId), 2, 'active');
            }
            $(this).attr('isCheck', 1);
        }
        changeIsCheck( $(this) );
    });
    $('.total-icon').click(function(){
        changeIconStatus($(this), 1);
        var shopIconCount = $('.shop-check-icon').length;//店铺个数
        var goodsCount = $('.check-icon').length;//商品个数
        if( $(this).attr('class').indexOf('active') == -1 ){//取消选中所有
            for(var i=0; i<shopIconCount; i++){
                changeIconStatus($('.shop-check-icon').eq(i), 2);
            }
            for(var i=0; i<goodsCount; i++){
            	$('.check-icon').eq(i).attr('isCheck', 0);
                changeIconStatus($('.check-icon').eq(i), 2);
                changeIsCheck($('.check-icon').eq(i));
            }
        }else{//选中所有
            for(var i=0; i<shopIconCount; i++){
                changeIconStatus($('.shop-check-icon').eq(i), 2, 'active');
            }
            for(var i=0; i<goodsCount; i++){
            	$('.check-icon').eq(i).attr('isCheck', 1);
                changeIconStatus($('.check-icon').eq(i), 2, 'active');
                changeIsCheck($('.check-icon').eq(i));
            }
        }
        calculateTotalMoney();//计算总金额
    });

    $('#editCart').click(function(){
        $(this).hide();
        $('.cartinfo-top').hide();
        $('.goods-spec').hide();
        $('.oldgoodsnum').hide();
        $('.cartinfo-editarea').show();
        $('#buyit-area').hide();
        $('#editDone').show();
        $('#delit-area').show();
        $('.total-money-area').removeClass('tosubmit').addClass('todel');
    });
    $('#editDone').click(function(){
        location.href = WST.U('WebApp/Cart/index');
    });
    $('#delit').click(function(){
        var goodsIconCount = $('.check-icon').length;//商品个数
        var goodsIds = '';
        for(var i=0; i<goodsIconCount; i++){
            if( $('.check-icon').eq(i).attr('class').indexOf('active') != -1 ){
                goodsIds += $('.check-icon').eq(i).prev('input.goodsid').val() + '#';
            }
        }
        if(goodsIds!=''){
            wstConfirm('确定删除选中的商品吗？', delGoodsFromCart);
        }else{
            wstAlert('请选择要删除的商品');
        }
    });
    $('#buyit-area').click(function(){
        var goodsIconCount = $('.check-icon').length;//商品个数
        var noGoodsSelected = true;
        for(var i=0; i<goodsIconCount; i++){
            if( $('.check-icon').eq(i).attr('class').indexOf('active') != -1 ){
                noGoodsSelected = false;
            }
        }
        if(noGoodsSelected){
            wstMsg('请勾选要结算的商品');
            return false;
        }
        location.href = WST.U('WebApp/Cart/settlement', 'isDefault=1');
    });
});