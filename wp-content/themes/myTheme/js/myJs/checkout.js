$(document).ready(function () {
    $("#checkout_now").click(function () {
        $("#place_order").trigger('click');
    })

    if ($("input[value='free_shipping:1']").val() == 'free_shipping:1' && $("input[value='free_shipping:1']").attr('checked') == 'checked') {
        $(".account-back").css({'display': 'block'})
    }
    $("input[name='terms']").attr('checked', true)
})
$(document).on('click', '.shipping_method', function (e) {
    // alert(1) free_shipping:1
    if (e.target.value == 'free_shipping:1') {
        $(".account-back").css({'display': 'block'})
        scrollToSection('.account-back')
    } else {
        $(".account-back").css({'display': 'none'})
    }
})

function scrollToSection(target) {
    $('html,body').stop().animate({
        scrollTop: $(target).offset().top - $(".header-nav").outerHeight() - 20
    }, 1000);
}
