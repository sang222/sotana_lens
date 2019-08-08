function openProTabs(index, $this) {
    $(".pro-tablinks").removeClass('active');
    $($this).addClass('active');
    $(".collection").fadeOut(500)
    $(".colection-" + index).fadeIn(1500).removeClass('d-none')
}

function clickItemVariableItem() {
    $('.box-variable-pr img').click(function () {
        $(this).parents('.product-item').find('.box-variable-pr').removeClass('active');
        $(this).parents('.box-variable-pr').addClass('active');
        var src = $(this).attr('src');
        $(this).parents('.product-item').find('.img-thumb img').attr('src', src);
        $(this).parents('.product-item').find('.img-thumb img').attr('srcset', src);
        var product_id = $(this).parents('.box-variable-pr').attr('data-product_id');
        var variation_id = $(this).parents('.box-variable-pr').attr('data-variation_id');
        var attribute_pa_color = $(this).parents('.box-variable-pr').attr('data-attribute_pa_color');
        console.log(variation_id, attribute_pa_color)
        var addCartbtn = $(this).parents('.product-item').find('.add-variable');
        addCartbtn.attr('data-variation_id', variation_id);
        addCartbtn.attr('data-attribute_pa_color', attribute_pa_color);
    })
}

function clickItemVariableQuick() {
    $(document).on('click', '.item-variable .box-variable-quick', function () {
        var src_tem = $(this).find('img').attr('src');
        $('.item-variable').removeClass('active');
        $(this).parents('.item-variable').addClass('active');
        var variation_id = $(this).attr('data-variation_id');
        var attribute_pa_color = $(this).attr('data-attribute_pa_color');
        $("#add-variable").attr('data-variation_id', variation_id);
        $("#add-variable").attr('data-attribute_pa_color', attribute_pa_color);
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
            $(".img-lst").width($("#myModal").width() - 80)
        }

    })

    $("#picture-quickview").elevateZoom({
        scrollZoom: true,
        zoomType: "inner",
        cursor: "crosshair",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750
    });
    // $("#pictures-quickview").elevateZoom({
    //     scrollZoom: true,
    //     zoomType: "inner",
    //     cursor: "crosshair",
    //     zoomWindowFadeIn: 500,
    //     zoomWindowFadeOut: 750
    // });
});
//zoom quick view
