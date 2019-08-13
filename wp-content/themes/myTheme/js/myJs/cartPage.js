$(document).on('click', '#container-tbl .remove-product', function (e) {
    var product_id = $(this).data("product_id");
    var $this = $(this);
    var price = $(this).attr('data-price');
    var id = $(this).attr('data-id');
    var quantity = $(this).prev('input').val();
    var total_price = price * quantity;
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: $("#url_admin").val(),
        data: {
            action: "product_remove",
            product_id: product_id,
        }, success: function (data) {
            var mini = data.fragments['.container-mini-cart'];
            $(".container-mini-cart").remove()
            $('.header').append(mini);
            var total = $("#icon-cart-mobile").find('.popup-cart-footer p').attr('data-total');
            if (total > 0) {
                $(".total-order-cart .total-price").text(formatCurrency(total))

                $this.parents('tr').find('.total-price-' + id).text(formatCurrency(total_price.toString()))
                $this.parents('tr').remove();
            } else {
                $('.cart-page-content').empty();
                $("#empty-cart").removeClass('d-none');
            }
        }, error: function (err) {
            console.log(err);
        }
    });
    return false;
});
//end remove product simple
//Remove product variable
$(document).on('click', '#container-tbl .remove-product-variable', function (e) {
    // e.preventDefault();
    $(this).css('pointer-events', 'none')
    var product_id = $(this).data("product_id");
    var key_items = $(this).attr('data-key_items');
    var $this = $(this);
    var price = $(this).attr('data-price');
    var id = $(this).attr('data-id');
    var quantity = $(this).prev('input').val();
    var total_price = price * quantity;
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: $("#url_admin").val(),
        data: {
            action: "product_remove_variable",
            product_id: product_id,
            key_items: key_items,
        }, success: function (data) {
            var mini = data.fragments['.container-mini-cart'];
            $(".container-mini-cart").empty().append(mini);
            var total = $("#icon-cart-mobile").find('.popup-cart-footer p').attr('data-total');
            if (total > 0) {
                $(".total-order-cart .total-price").text(formatCurrency(total))
                $this.parents('tr').find('.total-price-' + id).text(formatCurrency(total_price.toString()))
                $this.parents('tr').remove();
            } else
            {
                $('.cart-page-content').empty();
                $("#empty-cart").removeClass('d-none');
            }
        }, error: function (err) {
            console.log(err);
        }
    });
    return false;
});

//update cart
$(document).on('change', '#container-tbl input.qty', function () {
    // alert(1)
    var item_hash = $(this).attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
    var item_quantity = $(this).val();
    var currentVal = parseFloat(item_quantity);
    var price = $(this).attr('data-price');
    var id = $(this).attr('data-id');
    var quantity = $(this).val();
    var total_price = price * quantity;
    $this = $(this);

    function qty_cart() {
        $.ajax({
            type: 'POST',
            url: $("#url_admin").val(),
            data: {
                action: 'qty_cart',
                hash: item_hash,
                quantity: currentVal
            },
            success: function (res) {
                if (res) {
                    var mini = res.fragments['.container-mini-cart'];
                    $(".container-mini-cart").empty().append(mini);
                    var total = $("#icon-cart-mobile").find('.popup-cart-footer p').attr('data-total');
                    $(".total-order-cart .total-price").text(formatCurrency(total))
                    var total = $("#icon-cart-mobile").find('.popup-cart-footer p').attr('data-total');
                    $(".total-order-cart .total-price").text(formatCurrency(total))
                    $this.parents('tr').find('.total-price-' + id).text(formatCurrency(total_price.toString()))
                }

            }
        });

    }

    qty_cart();

});
$(document).on('click', ' #container-tbl .reduced', function () {
    var item_hash = $(this).next('input').attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
    var item_quantity = $(this).next('input').val();
    var currentVal = parseFloat(item_quantity);
    var $this = $(this);
    if (currentVal == 1) {
        $(this).addClass('none-click')
    }
    var price = $(this).attr('data-price');
    var id = $(this).attr('data-id');
    var quantity = $(this).next('input').val();
    var total_price = price * quantity;

    function qty_cart() {

        $.ajax({
            type: 'POST',
            url: $("#url_admin").val(),
            data: {
                action: 'qty_cart',
                hash: item_hash,
                quantity: currentVal
            },
            success: function (res) {
                if (res) {
                    var mini = res.fragments['.container-mini-cart'];
                    $(".container-mini-cart").empty().append(mini);
                    var total = $("#icon-cart-mobile").find('.popup-cart-footer p').attr('data-total');
                    $(".total-order-cart .total-price").text(formatCurrency(total))
                    var total = $("#icon-cart-mobile").find('.popup-cart-footer p').attr('data-total');
                    $(".total-order-cart .total-price").text(formatCurrency(total))
                    $this.parents('tr').find('.total-price-' + id).text(formatCurrency(total_price.toString()))
                }
            }
        });

    }

    qty_cart();
});
$(document).on('click', '#container-tbl .increase', function () {
    var item_hash = $(this).prev('input').attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
    var item_quantity = $(this).prev('input').val();
    var currentVal = parseFloat(item_quantity);
    var $this = $(this);
    $(this).prev().prev('.reduced').removeClass('none-click')
    var price = $(this).attr('data-price');
    var id = $(this).attr('data-id');
    var quantity = $(this).prev('input').val();
    var total_price = price * quantity;

    function qty_cart() {

        $.ajax({
            type: 'POST',
            url: $("#url_admin").val(),
            data: {
                action: 'qty_cart',
                hash: item_hash,
                quantity: currentVal
            },
            success: function (res) {
                if (res) {
                    var mini = res.fragments['.container-mini-cart'];
                    $(".container-mini-cart").empty().append(mini);
                    var total = $("#icon-cart-mobile").find('.popup-cart-footer p').attr('data-total');
                    $(".total-order-cart .total-price").text(formatCurrency(total))
                    $this.parents('tr').find('.total-price-' + id).text(formatCurrency(total_price.toString()))
                }

            }
        });

    }

    qty_cart();
});

//function general
function formatCurrency(number) {
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");
    return n2.split('').reverse().join('') + 'VNĐ';
}