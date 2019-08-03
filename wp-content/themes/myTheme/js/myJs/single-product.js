$(document).ready(function () {
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
    $(".slick-carousel-mobile").owlCarousel({
        loop: true,
        margin: 10,
        autoplay: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 4,
                nav: false
            },
            600: {
                items: 5,
                nav: false
            },
            1000: {
                items: 5,
                nav: false,
                loop: false
            }
        }
    });
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
})

//check cart add notice
function jaxButtonCart() {
    $(document).on('click', '.ajax_add_to_cart', function (e) {
        e.preventDefault();
        $(this).removeClass('added');
        $(".notification").removeClass('-active')
        var $thisbutton = $(this),
            $form = $thisbutton.closest('form.cart'),
            id = $thisbutton.val(),
            product_qty = $form.find('input[name=quantity]').val() || 1,

            product_id = $form.find('input[name=product_id]').val() || id,
            variation_id = $form.find('input[name=variation_id]').val() || 0;
        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };

        $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
        var $this = $(this);
        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {
                if ($(e.target).hasClass('added')) {
                    $(".notification").addClass('-active')
                    setTimeout(function () {
                        $(".notification").removeClass('-active')
                    }, 2000)
                }

                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
        });

        return false;
    });

}