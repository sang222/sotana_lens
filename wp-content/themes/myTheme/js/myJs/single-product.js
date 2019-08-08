$(document).ready(function () {
    settingSlider();
    viewVariable();
    submitProductVariable();
})

function submitProductVariable() {
    $('.add-variable').click(function (e) {
        e.preventDefault();
        var product_id = $(this).attr('data-product_id');
        var variation_id = $(this).attr('data-variation_id');
        var attribute_pa_color = $(this).attr('data-attribute_pa_color');
        var attribute_pa_size = $(this).attr('data-attribute_pa_size');
        $.ajax({
            url: $("#url_admin").val(),
            type: 'POST',
            data: {
                action: "add_product",
                'quantity': 1,
                'product_id': product_id,
                'variation_id': variation_id,
                'variation': {
                    'attribute_pa_color': attribute_pa_color,
                    'attribute_pa_size': attribute_pa_size,
                }

            },
            success: function (res) {
                // $('body').empty().append(res);
                // console.log(res);
                // console.log(res.find('.list-inline'))
                var mini = res.fragments['.container-mini-cart'];

                $(".container-mini-cart").empty().append(mini);
            },
            error: function (err) {
                console.log(err);
            }
        })
    })
}

function viewVariable() {

    $(".product-variable .box-variable").click(function () {
        $('.product-variable .box-variable').removeClass('active');
        $(this).addClass('active');
        $('#verticle-slick img').removeClass('active');
        var variation_id = $(this).attr('data-variation_id');
        var display_price = $(this).attr('data-display_price');
        var display_regular_price = $(this).attr('data-display_regular_price');
        var attribute_pa_color = $(this).attr('data-attribute_pa_color');
        var attribute_pa_size = $(this).attr('data-attribute_pa_size');

        $("#add-variable").attr('data-attribute_pa_color', attribute_pa_color);
        $("#add-variable").attr('data-attribute_pa_size', attribute_pa_size);
        $("#add-variable").attr('data-variation_id', variation_id);
        //add on
        $(".current-price").text(display_regular_price + 'đ');
        $(".sale-price").text(display_price + 'đ');

        var src = $(this).find('img').attr('src');
        $('.zoomContainer').remove();
        $("#zoom").removeData('elevateZoom');
        $("#zoom").attr('src', src);
        $("#zoom").data('zoom-image', src);
        $("#zoom").elevateZoom({
            scrollZoom: true,
            zoomType: "inner",
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
        });
    })
}

function settingSlider() {
    var src_tem = $('#verticle-slick img.active').attr('src');
    $(".title").next().next('p').remove();
    $("#zoom").elevateZoom({
        scrollZoom: true,
        zoomType: "inner",
        cursor: "crosshair",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750
    });
    $('#verticle-slick').slick({
        infinite: false,
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 5,
        slidesToScroll: 3,
        prevArrow: $('.top-arrow'),
        nextArrow: $('.bottom-arrow')
    });
    $("#verticle-slick img").click(function (e) {
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

    $("#verticle-slick img").hover(function (e) {

        $('.zoomContainer').remove();
        $("#zoom").attr('src', $(this).attr('src'));
    }, function () {
        $("#zoom").attr('src', src_tem);
    })
    console.log($("#mark-fixed").offset().top);
    //Slider product mobile

    $(".slick-carousel-mobile img").click(function () {
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
//    slide related
    $('#sale-carousel-related').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: true,
                loop: false
            }
        }
    });
}

//check cart add notice
