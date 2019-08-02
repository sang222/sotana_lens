function openProTabs(index, $this) {
    $(".pro-tablinks").removeClass('active');
    $($this).addClass('active');
    $(".collection").fadeOut(500)
    $(".colection-" + index).fadeIn(1500)
}

$(document).ready(function () {
    $('#toggle-mobile-menu').click(function() {
        $('#menuzord').addClass('menu-opening')
    })
    $('.close-button').click(function() {
        $('#menuzord').removeClass('menu-opening')
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
        loop: true,
        margin: 15,
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
        autoplay: true,
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
//    contact slidercontact-carousel
    $('#contact-carousel').owlCarousel({
        loop: false,
        margin: 55,
        dots: false,
        autoplay: true,
        nav: false,
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


});
