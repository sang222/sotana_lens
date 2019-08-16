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
        var quantity = $(this).parents('.qty-quick-views').find(".qty").val();
        $(this).addClass('loading').removeClass('added');
        $this = $(this);
        $.ajax({
            url: $("#url_admin").val(),
            type: 'POST',
            data: {
                action: "add_product",
                'quantity': quantity,
                'product_id': product_id,
                'variation_id': variation_id,
                'variation': {
                    'attribute_pa_color': attribute_pa_color,
                }

            },
            success: function (res) {
                // $('body').empty().append(res);
                // console.log(res);
                if (res) {
                    $this.removeClass('loading')
                    $this.addClass('added')
                    // console.log(res.find('.list-inline'))
                    var mini = res.fragments['.container-mini-cart'];
                    $(".container-mini-cart").empty().append(mini);
                    var modal = res.fragments['.modal-cart-content'];
                    $(".modal-cart-add").empty().append(modal);
                    $("#modalCart").modal('show');
                }

            },
            error: function (err) {
                console.log(err);
            }
        })
    })
}

function viewVariable() {

    $(".product-variable .box-variable").click(function () {
        var variation_id = $(this).attr('data-variation_id');
        var attribute_pa_color = $(this).attr('data-attribute_pa_color');
        if ($(this).hasClass('box-out-variable')) {
            $(".status-product").removeClass('has').addClass('not-has').text('Hết hàng');
            $(".acttion-carts .add-cart").addClass('d-none');
        } else {
            $(".status-product").removeClass('not-has').addClass('has').text('Còn hàng');
            $(".acttion-carts .add-cart").removeClass('d-none');
            $(".add-variable").attr('data-attribute_pa_color', attribute_pa_color);
            $(".add-variable").attr('data-variation_id', variation_id);
        }
        $('.product-variable .box-variable').removeClass('active');
        $(this).addClass('active');
        $('#verticle-slick img').removeClass('active');

        var display_price = $(this).attr('data-display_price');
        var display_regular_price = $(this).attr('data-display_regular_price');


        //add on
        $(".current-price").text(formatCurrency(display_regular_price));
        $(".sale-price").text(formatCurrency(display_price));

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
    // console.log($("#mark-fixed").offset().top);
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
function formatCurrency(number) {
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");
    return n2.split('').reverse().join('') + 'VNĐ';
}