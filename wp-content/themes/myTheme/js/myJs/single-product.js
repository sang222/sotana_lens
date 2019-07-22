$(document).ready(function () {
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
})