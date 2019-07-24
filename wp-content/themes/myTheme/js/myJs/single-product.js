$(document).ready(function () {
    var src_tem = $('.slick-carousel img.active').attr('src');
    $(".title").next().next('p').remove();
    $("#zoom").elevateZoom({
        scrollZoom: true,
        zoomType: "inner",
        cursor: "crosshair",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750
    });
    $('.slick-carousel').slick({
        infinite: false,
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 5,
        slidesToScroll: 3,
        prevArrow: $('.top-arrow'),
        nextArrow: $('.bottom-arrow')
    });
    $(".slick-carousel img").click(function (e) {
        $('.slick-carousel img').removeClass('active');
        $(this).addClass('active');
        src_tem = $(this).attr('src');
        $('.zoomContainer').remove();
        $("#zoom").removeData('elevateZoom');
        $("#zoom").attr('src', $(this).attr('src'));
        $("#zoom").data('zoom-image', $(this).attr('src'));
        $("#zoom").elevateZoom({
            scrollZoom: true,
            zoomType: "inner",
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
        });
    })

    $(".slick-carousel img").hover(function (e) {

        $('.zoomContainer').remove();
        $("#zoom").attr('src', $(this).attr('src'));
    }, function () {
        $("#zoom").attr('src', src_tem);
    })
    console.log($("#mark-fixed").offset().top);
//    add cart
    acttion_add_cart();
})

function acttion_add_cart() {
    // alert(1)
    // $(".qty-quick-view").append(`
    //
    // `)
}

window.onscroll = function () {
    console.log($(this).scrollTop());
    // console.log($("#mark-fixed").offset().top);
    // if ($(this).scrollTop() >= 280) {
    //     console.log($(this).scrollTop())
    //     // alert(window.innerWidth - $('.content-cart').width())
    //     $(".product-detail").css({
    //         position: 'fixed',
    //         maxWidth: '400px',
    //         right: '215px',
    //         top: '50px',
    //     })
    // } else {
    //     $(".product-detail").css({
    //         top: '260px',
    //     })
    // }
};