function viewProduct(product_id, $this) {
    $("#qty").val(1);
    $($this).addClass('view-now')
    var price = $($this).data('product_price');
    var price_regular = $($this).data('product_price_regular');
    var choise_price = (price == "") ? price_regular : price;
    var price_sale = $($this).data('product_price_sale');
    var product_link = $($this).data('product_link');
    $(".reduced").attr('data-id', product_id);
    $(".increase").attr('data-id', product_id);
    $(".qty-quick-view").empty();
    $(".qty-quick-view").append(`
        <button onclick="var result = document.getElementById(&#39;qty&#39;);
            var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;"
                    class="action-count reduced items-count2"
                    type="button"><i
                    data-id="` + product_id + `"
                        class="fa fa-minus"></i>
            </button>
            <input type="text" pattern="[0-9]*"
                   class="input-text qty text-center"
                   id="qty" min="1"
                   value="1"
                   title="SL" max="100"
                   max inputmode="numeric" value="1"
                   maxlength="3" name="quantity"
                   onkeyup="valid(this,&#39;numbers&#39;)"
                   onblur="valid(this,&#39;numbers&#39;)">
            <button onclick="var result = document.getElementById(&#39;qty&#39;); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                    class=" action-count increase items-count2"
                    data-id="` + product_id + `"
                    type="button"><i
                        class="fa fa-plus"></i>
            </button>
             <a title="Add cart"
               id="add-more"
               class="cart-product add-cart quick_add_to_cart_button button product_type_simple add_to_cart_button ajax_add_to_cart"
               href="?add-to-cart=` + product_id + `"
               data-quantity="1"
               data-attribute_pa_size="3"
               data-product_id="` + product_id + `"
            
            ><i class="fa fa-cart-plus"></i> Add to cart</a>
    `)
    $.ajax({
        type: "post", //Phương thức truyền post hoặc get
        dataType: "json", //Dạng dữ liệu trả về xml, json, script, or html
        url: $("#url_admin").val(), //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
        data: {
            action: "viewProduct", //Tên action
            id: product_id,

        },
        context: this,
        beforeSend: function () {

            //Làm gì đó trước khi gửi dữ liệu vào xử lý
        },
        success: function (response) {
            // console.log(response);
            //Làm gì đó khi dữ liệu đã được xử lý
            if (response.success) {
                var html_cate = '';
                console.log(response.data.data['post_excerpt'])
                console.log(response)
                response.data.category.forEach(function (value, index) {
                    html_cate += '<a href="' + value.link + '">' + value.name + '</a>'
                })
                $($this).removeClass('view-now')
                $($this).find('i').css('opacity', '1')
                $("#myModal").modal('show');
                $('#picture-quickview').prop('src', response.data.image)
                $(".nameQuickview").text(response.data.data['post_title'])
                $(".description-quick-view").text(response.data.data['post_excerpt'])
                $(".price-regular").text(choise_price)
                $(".price-sale").text(price_sale)
                $(".category-items").html(html_cate);
                $(".quick_add_to_cart_button").val(product_id);
                $(".frm-cart").attr('action', product_link)

            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $($this).removeClass('view-now')
            $($this).find('i').css('opacity', '1')
            alert('error')
        }
    })
}

$(document).ready(function () {
    jaxButtonCart();

})

function jaxButtonCart() {

    $(document).on('click', '.quick_add_to_cart_button', function (e) {
        e.preventDefault();

        // $("#modalCart").modal('show');
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
                $("#modal-empty-cart").addClass('d-none');
                if ($(".modal-action").hasClass('d-none')) {
                    $(".modal-action").removeClass('d-none')
                }

                $("#modalCart").modal('show');
                $("#myModal").modal('hide')
                if (response.error & response.product_url) {
                    console.log('error', response.error)
                    // window.location = response.product_url;
                    return;
                } else {
                    console.log('success', response)
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
            error: function (err) {
                console.log(err);
            }
        });

        return false;
    });

}

$(document).on('click', '.remove-product', function (e) {
    // e.preventDefault();
    var product_id = $(this).data("product_id");
    var line = $(this).data('line');
    var $this = $(this);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: $("#url_admin").val(),
        data: {
            action: "product_remove",
            product_id: product_id
        }, success: function (data) {
            var count = 0;
            $.each(data.data, function (index, value) {
                count += value.quantity;
            })
            var old_price_update = $('.total-price').text();
            var new_price_update = parseInt(old_price_update) - parseInt($(".total-price-" + product_id).text().split(' ')[0]);
            $(".total-price-dropdown").text(new_price_update);
            $('.total-price').text(new_price_update);
            if ($this.parents('tr').prev().size() > 0 || $this.parents('tr').next().size() > 0) {
                $this.parents('tr').remove();
            } else {
                $this.parents('tr').remove();
                $(".modal-action").addClass('d-none')
                $(".shop_table").addClass('d-none')
                $("#empty-cart").removeClass('d-none');
                $("#modal-empty-cart").removeClass('d-none');
            }
            $("#mini-cart-container table #mini-item-" + line).remove();
            $("table #table-normal-" + line).remove();
            $(".total-outer").text(count + ' Items');
            $(".total-amount-dropdown").text(count + ' Items');

        }, error: function (err) {
            console.log(err);
        }
    });
    return false;
});

//action count

$(document).on('click', '.reduced,.increase', function () {
    var value = $("#qty").val();
    var id = $(".increase").data('id');
    $(".qty-quick-view").children().remove();
    $(".qty-quick-view").append(`
        <button onclick="var result = document.getElementById(&#39;qty&#39;);
            var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;"
                    class="action-count reduced items-count2"
                    type="button"
                     data-id="` + id + `"
                    ><i
                        class="fa fa-minus"></i>
            </button>
            <input type="text" pattern="[0-9]*"
                   class="input-text qty text-center"
                   id="qty" min="1"
                   value="` + value + `"
                   title="SL" max="100"
                   max inputmode="numeric" value="1"
                   maxlength="3" name="quantity"
                   onkeyup="valid(this,&#39;numbers&#39;)"
                   onblur="valid(this,&#39;numbers&#39;)">
            <button onclick="var result = document.getElementById(&#39;qty&#39;); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                    class=" action-count increase items-count2"
                       data-id="` + id + `"
                    type="button"><i
                        class="fa fa-plus"></i>
            </button>
           
         <a title="Add cart"
           id="add-more"
           class="cart-product add-cart quick_add_to_cart_button button product_type_simple add_to_cart_button ajax_add_to_cart"
           href="?add-to-cart=` + id + `"
           data-quantity="` + value + `"
           data-attribute_pa_size="3"
           data-product_id="` + id + `"
        
        ><i class="fa fa-cart-plus"></i> Add to cart</a>
    `)
})

//update cart
$(document).on('change', 'input.qty', function () {
    // alert(1)
    var item_hash = $(this).attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
    var item_quantity = $(this).val();
    var currentVal = parseFloat(item_quantity);
    const old_quantity = $(this).data('quantity');
    var $this = $(this);

    function qty_cart() {
        $.ajax({
            type: 'POST',
            url: $("#url_admin").val(),
            data: {
                action: 'qty_cart',
                hash: item_hash,
                quantity: currentVal
            },
            success: function (data) {
                var price = $this.data('price');
                var price_after_update = price * currentVal;
                var id = $this.data('id');
                var old_total_price_child = $('.total-price-' + id).text().split(' ')[0];
                if (parseInt(old_total_price_child) > parseInt(price_after_update)) {
                    var new_total_price1 = parseInt(old_total_price_child) - parseInt(price_after_update);
                    var old_total_price1 = $('.total-price').text()
                    var update_total_price1 = parseInt(old_total_price1) - parseInt(new_total_price1);
                    $('.total-price').text(update_total_price1);
                    $(".total-price-dropdown").text(update_total_price1);
                } else {
                    var new_total_price2 = parseInt(price_after_update) - parseInt(old_total_price_child);
                    var old_total_price2 = $('.total-price').text();
                    var update_total_price2 = parseInt(old_total_price2) + parseInt(new_total_price2);
                    $('.total-price').text(update_total_price2);
                    $(".total-price-dropdown").text(update_total_price2);
                }
                //change quantity
                if ($this.val() > old_quantity) {

                    var old_total_amount1 = $(".total-amount-dropdown:nth-child(1)").data('amount');
                    var differene_amount1 = parseInt($this.val()) - parseInt(old_quantity);
                    var new_total_amount1 = parseInt(old_total_amount1) + parseInt(differene_amount1);
                    // console.log(old_total_amount1,differene_amount1)
                    $(".total-amount-dropdown").text(new_total_amount1);
                    $(".total-amount-dropdown").attr('data-amount', new_total_amount1)
                    $(".total-outer").text(new_total_amount1 + ' ITEMS')
                } else {
                    var old_total_amount2 = $(".total-amount-dropdown:nth-child(1)").data('amount');
                    var differene_amount2 = parseInt(old_quantity) - parseInt($this.val());
                    var new_total_amount2 = parseInt(old_total_amount2) - parseInt(differene_amount2);
                    console.log(old_total_amount2, differene_amount2)
                    $(".total-amount-dropdown").text(new_total_amount2);
                    $(".total-amount-dropdown").attr('data-amount', new_total_amount2)
                    $(".total-outer").text(new_total_amount2 + ' ITEMS')
                }

                $('.total-price-' + id).text(price_after_update + ' VND');

            }
        });

    }

    qty_cart();

});
$(document).on('click', '.reduced', function () {
    var item_hash = $(this).next('input').attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
    var item_quantity = $(this).next('input').val();
    var currentVal = parseFloat(item_quantity);
    var $this = $(this);
    if (currentVal == 1) {
        $(this).addClass('none-click')
    }

    function qty_cart() {

        $.ajax({
            type: 'POST',
            url: $("#url_admin").val(),
            data: {
                action: 'qty_cart',
                hash: item_hash,
                quantity: currentVal
            },
            success: function (data) {

                var price = $this.data('price');
                var price_after_update = parseInt(price) * parseInt(currentVal);
                var id = $this.data('id');
                $(".quantity-head-" + id).text(currentVal);
                $('.total-price-' + id).text(price_after_update + ' VND');
                var old_total_price = $('.total-price-dropdown:nth-child(1)').data('total');
                var update_total_price = parseInt(old_total_price) - parseInt(price);
                $('.total-price').text(update_total_price);
                $('.total-price-dropdown').data('total', update_total_price);
                $(".total-price-dropdown").text(update_total_price);
                //total amount head
                var old_total_amount_dropdown = $(".total-amount-dropdown:nth-child(1)").data('amount');
                var new_total_amount_dropdown = parseInt(old_total_amount_dropdown) - 1;
                $(".total-amount-dropdown").text(new_total_amount_dropdown);
                $(".total-amount-dropdown:nth-child(1)").data('amount', new_total_amount_dropdown);
                $(".total-outer").text('(' + new_total_amount_dropdown + ' Items)')
            }
        });

    }

    qty_cart();
});
$(document).on('click', '.increase', function () {
    var item_hash = $(this).prev('input').attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
    var item_quantity = $(this).prev('input').val();
    var currentVal = parseFloat(item_quantity);
    var $this = $(this);
    $(this).prev().prev('.reduced').removeClass('none-click')

    function qty_cart() {

        $.ajax({
            type: 'POST',
            url: $("#url_admin").val(),
            data: {
                action: 'qty_cart',
                hash: item_hash,
                quantity: currentVal
            },
            success: function (data) {

                var price = $this.data('price');
                var price_after_update = parseInt(price) * parseInt(currentVal);
                var id = $this.data('id');
                $(".quantity-head-" + id).text(currentVal);
                $('.total-price-' + id).text(price_after_update + ' VND')
                var old_total_price = $('.total-price-dropdown:nth-child(1)').data('total');
                var update_total_price = parseInt(old_total_price) + parseInt(price);

                $('.total-price').text(update_total_price);
                $(".total-price-dropdown").text(update_total_price);
                $('.total-price-dropdown').data('total', update_total_price);

                //total amount head
                var old_total_amount_dropdown = $(".total-amount-dropdown:nth-child(1)").data('amount');
                var new_total_amount_dropdown = parseInt(old_total_amount_dropdown) + 1;
                $(".total-amount-dropdown").text(new_total_amount_dropdown);
                $(".total-amount-dropdown:nth-child(1)").data('amount', new_total_amount_dropdown);

                $(".total-outer").text('(' + new_total_amount_dropdown + ' Items)')

            }
        });

    }

    qty_cart();
});
