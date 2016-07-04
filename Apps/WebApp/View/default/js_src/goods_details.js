//跳转到商品评价页
function viewAppraises(goodsId){
    location.href = WST.U("WebApp/Goods/toGoodsAppraise", "goodsId="+goodsId);
}

//检查商品库存
function checkStock(obj, id, goodsId){
    $('#goodsAttrId').val(id);
    $(obj).addClass('active').siblings().removeClass('active');
    $.post(WST.U('WebApp/Goods/getPriceAttrInfo'), {goodsId:goodsId, id:id}, function(data){
        var json = WST.toJson(data);
        $('#goodsPrice').html('￥'+json.attrPrice);
        if(json.attrStock>0){
          $('#goodsStock').html('有货').css('color','black');
        }else{
          $('#goodsStock').html('无货').css('color','red');
        }
    });
}

$(document).ready(function(){
    initFooter('home');
});
