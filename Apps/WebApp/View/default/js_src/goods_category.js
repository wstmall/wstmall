//去商品列表页
function toGoodsList(goodsCatId, goodsCat) {
    location.href = WST.U("WebApp/Goods/index", goodsCat+'='+goodsCatId);
}

$(document).ready(function() {
    initFooter("category");

    var h = $(window).height() - 100;
    $(".left-container").css("height", h + "px");
    $(".catcontent").css("height", h + "px");
    new Swiper(".left-container", {
        direction: "vertical",
        slidesPerView: 6,
        freeMode: true,
        freeModeSticky: true
    });
    $(".wst-cat1").click(function() {
        $(this).addClass("cat-active").siblings("div.wst-cat1").removeClass("cat-active");
        var catId = $(this).attr("cat");
        $("#"+catId).show().siblings(".cat1-div").hide();
        $(".catcontent").scrollTop(0);
    })
});