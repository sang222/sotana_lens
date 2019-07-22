$(document).ready(function () {
    $(".register").on('submit', function (e) {
        e.preventDefault();
        var $this = $(this);
        console.log($this[0].ser)
        $.ajax({
            url: $("#url_admin").val(),
            type: 'POST',
            dataType: 'html',
            data: $this.serialize(),
            success: function (res) {
                console.log(res.response)
            },
            error: function () {
                alert(2)
            }
        })
    })

})
$(document).ready(function () {
    // Show the login dialog box on click
    $('a#show_login').on('click', function (e) {
        $('body').prepend('<div class="login_overlay"></div>');
        $('form#login').fadeIn(500);
        $('div.login_overlay, form#login a.close').on('click', function () {
            $('div.login_overlay').remove();
            $('form#login').hide();
        });
        e.preventDefault();
    });

    // Perform AJAX login on form submit
    $('form#login').on('submit', function (e) {
        e.preventDefault();
        // $('form#login p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: $("#url_admin").val(),
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(),
                'password': $('form#login #password').val(),
                'security': $('form#login #security').val()
            },
            success: function (data) {
                $('form#login p.status').text(data.message);
                console.log(data);
                if (data.loggedin == true) {
                    localStorage.setItem('user', $('form#login #username').val())
                    window.location.href = './order-history/'
                    // document.location.href = ajax_login_object.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

});