function viewProduct(product_id, $this) {
    $("#qty").val(1);
    $($this).addClass('view-now')
    var price = $($this).data('product_price');
    var price_regular = $($this).data('product_price_regular');
    var choise_price = (price == "") ? price_regular : price;
    var variable_id = $($this).attr('data-variable_id');
    var attribute_pa_color = $($this).data('attribute_pa_color');
    var price_sale = $($this).data('product_price_sale');
    var product_link = $($this).data('product_link');
    $(".reduced").attr('data-id', product_id);
    $(".increase").attr('data-id', product_id);
    var btnAddCart = null;
    var buttonHtmlSimple = `<a title="Add cart"
    id="add-more"
    class="cart-product add-cart quick_add_to_cart_button button product_type_simple add_to_cart_button ajax_add_to_cart"
    href="?add-to-cart=` + product_id + `"
    data-quantity="1"
    data-attribute_pa_size="3"
    data-product_id="` + product_id + `"
    ><i class="fa fa-cart-plus"></i> Add to cart</a>`
    var buttonHtmlVariable = `<a title="Add cart" id="add-variable"
                           class="cart-product add-cart"
                           data-variation_id="` + variable_id + `"
                           data-attribute_pa_color="` + attribute_pa_color + `"
                           data-product_id="` + product_id + `">
                           <i class="fa fa-cart-plus"></i> Add to cart</a>`
    if (variable_id != "") {
        btnAddCart = buttonHtmlVariable;
    } else {
        btnAddCart = buttonHtmlSimple;
    }
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
            </button> ` + btnAddCart + ``)
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
            console.log(response)
            // console.log(response);
            //Làm gì đó khi dữ liệu đã được xử lý
            if (response.success) {
                var html_cate = '';
                response.data.category.forEach(function (value, index) {
                    if (index == 0) {
                        html_cate += '<a href="' + value.link + '">' + value.name + '</a>'
                    } else {
                        html_cate += ' , <a href="' + value.link + '">' + value.name + '</a>'
                    }

                })
                $($this).removeClass('view-now')
                $($this).find('i').css('opacity', '1')
                $("#myModal").modal('show');
                $('#picture-quickview').prop('src', response.data.image);
                $('#picture-quickview').attr('data-zoom-image', response.data.image);
                $('.zoomContainer').remove();
                $("#picture-quickview").removeData('elevateZoom');
                setTimeout(function () {
                    $("#picture-quickview").elevateZoom({
                        scrollZoom: true,
                        zoomType: "inner",
                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750
                    });
                }, 2000)

                $(".nameQuickview").text(response.data.data['post_title'])
                $(".description-quick-view").text(response.data.data['post_excerpt'])
                $(".price-regular").text(choise_price)
                $(".price-sale").text(price_sale)
                $(".category-items").html(html_cate);
                $(".quick_add_to_cart_button").val(product_id);
                $(".variable-quick").empty().append(response.data.html_variable)
                $(".frm-cart").attr('action', product_link)
                //    list gallery
                var arr_attachment = response.data.arr_attachment;
                var html = '';

                new Promise(function (resolve, reject) {

                    setTimeout(function () {
                        $(".quick-slider").children().remove();
                        html += '<div><img class="active img-responsive" src="' + response.data.image + '"></div>'
                        Array.from(arr_attachment).forEach(function (value, key) {
                            html += '<div>';
                            html += '<img  class="img-responsive" src="' + value + '" />'
                            html += '</div>'
                        })
                        // html += '</div>';
                        $(".quickview-carousel").append(html);
                        if ($(".quickview-carousel").children().size() > 0) {
                            resolve('success')
                        }

                    }, 1000)
                    // html += '<div class="quickview-carousel owl-carousel owl-theme w-100">'

                }).then(function (success) {
                    $('.quickview-carousel').owlCarousel('destroy');
                    // $('#quickview-carousel').data('owl.carousel').destroy();
                    if (screen.width <= 767) {
                        $(".img-lst").width($("#myModal").width() - 80)
                    }

                    $(".quickview-carousel").owlCarousel({
                        loop: false,
                        margin: 15,
                        autoplay: false,
                        dots: false,
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 3,
                                nav: false
                            },
                            600: {
                                items: 4,
                                nav: false
                            },
                            1000: {
                                items: 5,
                                nav: false,
                                loop: false
                            }
                        }
                    });
                }, 1000)


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
    $(".total-price").text($('.total-price-dropdown').attr('data-total'))
    jaxButtonCart();
    submitProductVariable();
    submitProductQuick();
})

function submitProductQuick() {
    $(document).on('click', '#add-variable', function (e) {
        e.preventDefault();
        $(this).addClass('loading')
        var product_id = $(this).attr('data-product_id');
        var variation_id = $(this).attr('data-variation_id');
        var attribute_pa_color = $(this).attr('data-attribute_pa_color');
        var attribute_pa_size = $(this).attr('data-attribute_pa_size');
        console.log(variation_id)
        var quantity = (document.getElementById('qty')) ? document.getElementById('qty').value : 1;
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
                    'attribute_pa_size': attribute_pa_size,
                }
            },
            success: function (res) {
                $this.removeClass('loading');
                var mini = res.fragments['.container-mini-cart'];
                $(".container-mini-cart").empty().append(mini);
                var modal = res.fragments['.modal-cart-content'];
                $(".modal-cart-add").empty().append(modal);
                $("#modalCart").modal('show');
                $("#myModal").modal('hide')


            },
            error: function (err) {
                console.log(err);
            }
        })
    })
}

function submitProductVariable() {
    $(document).on('click', '.add-variable', function (e) {
        e.preventDefault();
        // $(this).addClass('loading')
        var product_id = $(this).attr('data-product_id');
        var variation_id = $(this).attr('data-variation_id');
        var attribute_pa_color = $(this).attr('data-attribute_pa_color');
        console.log(variation_id)
        var quantity = (document.getElementById('qty')) ? document.getElementById('qty').value : 1;
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

                $this.removeClass('loading');

                var mini = res.fragments['.container-mini-cart'];
                $(".container-mini-cart").empty().append(mini);

                var modal = res.fragments['.modal-cart-content'];
                $(".modal-cart-add").empty().append(modal);
                $("#modalCart").modal('show');
                $("#myModal").modal('hide')
            },
            error: function (err) {
                console.log(err);
            }
        })
    })
}

function jaxButtonCart() {

    $(document).on('click', '.quick_add_to_cart_button', function (e) {
        e.preventDefault();
        // $("#modalCart").modal('show');
        var $thisbutton = $(this),
            $form = $thisbutton.closest('form.cart'),
            id = $thisbutton.val(),
            product_qty = (document.getElementById('qty')) ? document.getElementById('qty').value : 1,
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

//remove product simple
$(document).on('click', '.remove-product', function (e) {
    // e.preventDefault();
    // $(this).css('pointer-events', 'none')
    var product_id = $(this).data("product_id");
    var line = $(this).data('line');

    var $this = $(this);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: $("#url_admin").val(),
        data: {
            action: "product_remove",
            product_id: product_id,

        }, success: function (data) {
            var count = 0;
            var mini = data.fragments['.container-mini-cart'];
            var modal = data.fragments['.modal-cart-content'];
            $(".container-mini-cart").empty().append(mini);
            $('.modal-cart-add').empty().append(modal);
            if ($this.parents('tr').prev().size() > 0 || $this.parents('tr').next().size() > 0) {
                $this.parents('tr').remove();
            } else {
                $this.parents('tr').remove();
                $(".modal-action").addClass('d-none')
                $(".shop_table").addClass('d-none')
                $("#empty-cart").removeClass('d-none');
                $("#modal-empty-cart").removeClass('d-none');
            }
        }, error: function (err) {
            console.log(err);
        }
    });
    return false;
});
//end remove product simple
//Remove product variable
$(document).on('click', '.remove-product-variable', function (e) {
    // e.preventDefault();
    $(this).css('pointer-events', 'none')
    var product_id = $(this).data("product_id");
    var line = $(this).data('line');
    var key_items = $(this).attr('data-key_items');
    var $this = $(this);
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
            var modal = data.fragments['.modal-cart-content'];
            $(".modal-cart-add").empty().append(modal);
            $(".total-price").text($('.total-price-dropdown').attr('data-total'))
            if ($this.parents('tr').prev().size() > 0 || $this.parents('tr').next().size() > 0) {
                $this.parents('tr').remove();
            } else {
                $this.parents('tr').remove();
                $(".modal-action").addClass('d-none')
                $(".shop_table").addClass('d-none')
                $("#empty-cart").removeClass('d-none');
                $("#modal-empty-cart").removeClass('d-none');
            }
            ;

        }, error: function (err) {
            console.log(err);
        }
    });
    return false;
});

//update cart
$(document).on('change', 'input.qty', function () {
    // alert(1)
    var item_hash = $(this).attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
    var item_quantity = $(this).val();
    var currentVal = parseFloat(item_quantity);

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
                    var modal = res.fragments['.modal-cart-content'];
                    $(".modal-cart-add").empty().append(modal);
                }

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
            success: function (res) {
                if (res) {
                    var mini = res.fragments['.container-mini-cart'];
                    $(".container-mini-cart").empty().append(mini);
                    var modal = res.fragments['.modal-cart-content'];
                    $(".modal-cart-add").empty().append(modal);
                }
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
            success: function (res) {
                if (res) {
                    var mini = res.fragments['.container-mini-cart'];
                    $(".container-mini-cart").empty().append(mini);
                    var modal = res.fragments['.modal-cart-content'];
                    $(".modal-cart-add").empty().append(modal);
                }

            }
        });

    }

    qty_cart();
});
