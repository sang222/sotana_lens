function openProTabs(index, $this) {
    $(".pro-tablinks").removeClass('active');
    $($this).addClass('active');
    $(".collection").fadeOut(500)
    $(".colection-" + index).fadeIn(1500).removeClass('d-none')
}

function clickItemVariableItem() {
    $(document).on('click', '.box-variable-pr img', function () {
        $(this).parents('.product-item').find('.box-variable-pr').removeClass('active');
        $(this).parents('.box-variable-pr').addClass('active');
        var src = $(this).attr('src');
        $(this).parents('.product-item').find('.img-thumb img').attr('src', src);
        $(this).parents('.product-item').find('.img-thumb img').attr('srcset', src);
        if (!$(this).parents('.box-variable-pr').hasClass('out-variable-pr')) {

            $(this).parents('.product-item').find('.add-cart').removeClass('d-none')
            var variation_id = $(this).parents('.box-variable-pr').attr('data-variation_id');
            var attribute_pa_color = $(this).parents('.box-variable-pr').attr('data-attribute_pa_color');
            var display_price = $(this).parents('.box-variable-pr').attr('data-display_price');
            var display_regular_price = $(this).parents('.box-variable-pr').attr('data-display_regular_price');
            if (display_price != '') {
                $(this).parents('.action-detail').find('.sale-price').text(formatCurrency(display_regular_price))
            }
            if (display_regular_price != '') {
                $(this).parents('.action-detail').find('.regular-price').text(formatCurrency(display_price))
            }
            if ($(this).parents('.product-item').find('.add-variable').addClass('d-none')) {
                $(this).parents('.product-item').find('.add-variable').removeClass('d-none');
            }

            var addCartbtn = $(this).parents('.product-item').find('.add-variable');
            addCartbtn.attr('data-variation_id', variation_id);
            addCartbtn.attr('data-attribute_pa_color', attribute_pa_color);
        } else {
            $(this).parents('.product-item').find('.add-cart').addClass('d-none')
            var color = $(this).parents('.out-variable-pr').attr('data-attribute_pa_color')
            $("div.error-box").text('Màu ' + color + ' đã hết hàng').fadeIn(300).delay(1500).fadeOut(400);
        }


    })
}

function clickItemVariableQuick() {
    $(document).on('click', '.item-variable .box-variable-quick', function () {
        var src_tem = $(this).find('img').attr('src');
        $('.item-variable').removeClass('active');
        $(this).parents('.item-variable').addClass('active');
        var variation_id = $(this).attr('data-variation_id');
        var attribute_pa_color = $(this).attr('data-attribute_pa_color');
        var display_price = $(this).attr('data-display_price');
        var display_regular_price = $(this).attr('data-display_regular_price')
        if (display_regular_price != '') {
            $(this).parents('.content-quick').find('.price-regular').text(formatCurrency(display_price));
            $("#add-variable").attr('data-variation_id', variation_id);
            $("#add-variable").attr('data-attribute_pa_color', attribute_pa_color);
        }
        if (display_price != '') {
            $(this).parents('.content-quick').find('.price-sale').text(formatCurrency(display_regular_price));
        }
        if (!$(this).hasClass('out-variable-pr')) {
            $(".status-product").addClass('status-instock').removeClass('out-instock').text('Còn hàng');

            $("#myModal .add-cart").removeClass('d-none');

        } else {
            $(".status-product").removeClass('status-instock').addClass('out-instock').text('Hết hàng');
            $("#myModal .add-cart").addClass('d-none');
        }
        $('.zoomContainer').remove();
        $("#picture-quickview").removeData('elevateZoom');
        $("#picture-quickview").attr('src', src_tem);
        $("#picture-quickview").data('zoom-image', src_tem);
        $("#picture-quickview").elevateZoom({
            scrollZoom: true,
            zoomType: "inner",
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
        });
    })
}

$(document).ready(function () {
    //funciton
    clickItemVariableItem();
    clickItemVariableQuick();
    //all
    $('#toggle-mobile-menu').click(function () {
        $('#menuzord').addClass('menu-opening')
    })
    $('.close-button').click(function () {
        $('#menuzord').removeClass('menu-opening')
    })
    $('#icon-cart-mobile').click(function () {
        $('#mini-cart-container').toggle()
    })
    $('.collapse.in').prev('.panel-heading').addClass('active');
    $('#accordion, #bs-collapse')
        .on('show.bs.collapse', function (a) {
            $(a.target).prev('.panel-heading').addClass('active');
        })
        .on('hide.bs.collapse', function (a) {
            $(a.target).prev('.panel-heading').removeClass('active');
        });
// append menu
    $('.menuzord-menu>li').each(function () {
        console.log($(this).find('ul').children().context);
        if ($(this).find('ul.dropdown').children('li').size() > 0) {
            $(this).children('a:first-child').append('<span class="dwn"> ▼</span>');
        }
    });
//  sale slider
    $('#sale-carousel').owlCarousel({
        lazyLoad: true,
        loop: true,
        margin: 15,
        autoplay: false,
        responsiveClass: true,
        autoplayHoverPause: true,
        touchDrag: false,
        mouseDrag: false,
        autoHeight: true,
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
                loop: true
            }
        }
    });
//    customer comment carousel
    $('#customer-carousel').owlCarousel({
        loop: true,
        margin: 15,
        autoplay: true,
        responsiveClass: true,
        lazyLoad: true,
        autoHeight: true,
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

    $('#carousel-blog').owlCarousel({
        loop: true,
        margin: 15,
        lazyLoad: true,
        autoplay: true,
        autoHeight: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            }
        }
    });
    $(".slick-carousel-mobile").owlCarousel({
        loop: true,
        margin: 10,
        lazyLoad: true,
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
//    contact slidercontact-carousel
    $('#contact-carousel').owlCarousel({
        loop: false,
        margin: 55,
        dots: false,
        lazyLoad: true,
        autoplay: true,
        nav: false,
        autoHeight: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 3,
                nav: true
            },
            600: {
                items: 4,
                nav: true
            },
            1000: {
                items: 7,
                nav: false,
                loop: true
            }
        }
    });
//    scroll top
    // BY KAREN GRIGORYAN


    /******************************
     BOTTOM SCROLL TOP BUTTON
     ******************************/

        // declare variable
    var scrollTop = $(".scrollTop");

    $(window).scroll(function () {
        // declare variable
        var topPos = $(this).scrollTop();

        // if user scrolls down - show scroll to top button
        if (topPos > 100) {
            $(scrollTop).css("opacity", "1");

        } else {
            $(scrollTop).css("opacity", "0");
        }

    }); // scroll END

    //Click event to scroll to top
    $(scrollTop).click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;

    }); // click() scroll top EMD

    /*************************************
     LEFT MENU SMOOTH SCROLL ANIMATION
     *************************************/
        // declare variable
    var h1 = $("#h1").position();
    var h2 = $("#h2").position();
    var h3 = $("#h3").position();

    $('.link1').click(function () {
        $('html, body').animate({
            scrollTop: h1.top
        }, 500);
        return false;

    }); // left menu link2 click() scroll END

    $('.link2').click(function () {
        $('html, body').animate({
            scrollTop: h2.top
        }, 500);
        return false;

    }); // left menu link2 click() scroll END

    $('.link3').click(function () {
        $('html, body').animate({
            scrollTop: h3.top
        }, 500);
        return false;

    }); // left menu link3 click() scroll END
    $(document).on('click', '.quickview-carousel .owl-item img', function () {
        $("#picture-quickview").attr('src', $(this).attr('src'))
        $(".owl-item img").removeClass('active');
        $(this).addClass('active');
        $('#picture-quickview').attr('data-zoom-image', $(this).attr('src'));
        $('.zoomContainer').remove();
        $("#picture-quickview").removeData('elevateZoom');
        $("#picture-quickview").elevateZoom({
            scrollZoom: true,
            zoomType: "inner",
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
        });

    })
    // $(".quickview-carousel").owlCarousel({});
//    quickview slider
    $(window).resize(function () {
        if (screen.width <= 767) {
            $('.zoomContainer').remove();
            $(".img-lst").width($("body").width() - 80)
        }

    })

    $("#picture-quickview").elevateZoom({
        scrollZoom: true,
        zoomType: "inner",
        cursor: "crosshair",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750
    });

    //    function

});
//zoom quick view
//function general
$(window).resize(function () {

    if (window.innerWidth <= 767) {

        $('.zoomContainer').remove();
        $("#picture-quickview").removeData('elevateZoom');
    }
})

function formatCurrency(number) {
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&.");
    return n2.split('').reverse().join('') + 'đ';
}

function changeInputTextQty() {
    $(".qty-quick-view .input-text").change(function () {
        if ($(this).val() <= 0) {
            $(this).val(1);
        }
        if (!Number.isInteger($(this).val())) {
            $(this).val(1);
        }
    })
}

