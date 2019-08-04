<?php /*
Template Name: Cart-Page
*/ ?>
<?php global $woocommerce;
$items = $woocommerce->cart->get_cart();
?>
<?php get_header() ?>
    <div class="container-fluid prefix">
        <div class="fixed-width">
            <div class="pro-title-breadcrumb text-center">
                <h4><?php $the_title = get_term_by('slug', $_GET['cat_name'], 'product_cat')->name;
                    echo $cate->name;
                    ?> </h4>

            </div>
            <div class="text-center"><?php woocommerce_breadcrumb(); ?></div>
            <br/>
            <br/>
        </div>
    </div>
    <div class="fixed-width p-15 " id="tbl-content">
        <h2 class="title-cart"><i class="fa fa-cart-plus"></i> My cart</h2>
        <?php if (sizeof($items) > 0) : ?>
            <table class=" table table-bordered  table-cart shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                <thead>
                <th></th>
                <th>Sản phẩm</th>
                <th class="text-center">Đơn giá</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center" colspan="2">Thành tiền</th>
                </th>
                </thead>
                <tbody>
                <?php
                $total_price = 0;
                $items = $woocommerce->cart->get_cart();
                $vt = 0;
                foreach ($items as $item => $values) :
                    $_product = wc_get_product($values['data']->get_id());
                    $getProductDetail = wc_get_product($values['product_id']);
                    if ($getProductDetail->get_sale_price() > 0) {
                        $total_price += $getProductDetail->get_sale_price() * $values['quantity'];
                    } else {
                        $total_price += $getProductDetail->get_regular_price() * $values['quantity'];
                    }
                    $price = get_post_meta($values['product_id'], '_price', true);
                    ?>
                    <tr id="table-normal-<?php echo $vt ?>">
                        <td class="text-center modal-cart-image"
                            style="vertical-align: middle;"><?php echo $getProductDetail->get_image('thumbnail'); // accepts 2 arguments ( size, attr )
                            ?></td>
                        <td style="vertical-align: middle;"><?php echo $_product->get_title(); ?></td>
                        <td class="text-center"
                            style="vertical-align: middle;">
                            <?php
                            if ($getProductDetail->get_sale_price() > 0) {
                                echo number_format($getProductDetail->get_sale_price(), 0, ',', '.') . ' VND';
                            } else {
                                echo number_format($getProductDetail->get_regular_price(), 0, ',', '.') . ' VND';
                            }
                            ?>

                        </td>

                        <td class="qty-modal text-center" style="vertical-align: middle;">
                            <div class="js-qty">
                                <button

                                        onclick="var result = document.getElementById('qty_<?php echo $values['product_id']; ?>');
                                                var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;"
                                        class="action-count reduced items-count2 <?php if ($values['quantity'] == '1') echo 'none-click' ?>"
                                        type="button"
                                        data-id="<?php echo $values['product_id'] ?>"
                                        data-price="<?php
                                        if ($getProductDetail->get_sale_price() > 0) {
                                            echo $getProductDetail->get_sale_price();
                                        } else {
                                            echo $getProductDetail->get_regular_price();
                                        }
                                        ?>"
                                ><i class="fa fa-minus"></i>
                                </button>
                                <input type="text" pattern="[0-9]*"
                                       class="input-text qty text-center"
                                       id="qty_<?php echo $values['product_id'] ?>" min="1"
                                       value="<?php echo $values['quantity']; ?>"
                                       title="SL" max="100"
                                       max inputmode="numeric"
                                       data-quantity="<?php echo $values['quantity']; ?>"
                                       data-price="<?php
                                       if ($getProductDetail->get_sale_price() > 0) {
                                           echo $getProductDetail->get_sale_price();
                                       } else {
                                           echo $getProductDetail->get_regular_price();
                                       }
                                       ?>"
                                       data-id="<?php echo $values['product_id'] ?>"
                                       maxlength="3"
                                       name="cart[<?php echo $item ?>][qty]"
                                >
                                <button onclick="var result = document.getElementById('qty_<?php echo $values['product_id']; ?>'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                                        class=" action-count increase items-count2 "
                                        data-id="<?php echo $values['product_id'] ?>"
                                        type="button"
                                        data-price="<?php
                                        if ($getProductDetail->get_sale_price() > 0) {
                                            echo $getProductDetail->get_sale_price();
                                        } else {
                                            echo $getProductDetail->get_regular_price();
                                        }
                                        ?>"
                                ><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </td>
                        <td colspan="2" class="" style="vertical-align: middle;">
                                        <span class="total-price-<?php echo $values['product_id'] ?>"><?php
                                            if ($getProductDetail->get_sale_price() > 0) {
                                                echo number_format(($getProductDetail->get_sale_price() * $values['quantity']), 0, ',', '.') . ' VND';
                                            } else {
                                                echo number_format(($getProductDetail->get_regular_price() * $values['quantity']), 0, ',', '.') . ' VND';
                                            }

                                            ?></span>
                            <span

                                    class=" remove-product float-right"
                                    data-line="<?php echo $vt ?>"
                                    data-product_id="<?php echo $values['product_id'] ?>"
                                    data-product_sku="<?php echo $getProductDetail->get_sku() ?>"

                            ><i class="fa fa-trash"></i></span></td>
                        </td>
                    </tr>
                    <?php
                    $vt++;
                endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="text-center">
                <img width="100" class="img-fluid"
                     src="<?php echo esc_url(get_template_directory_uri()) ?>/images/myimage/cart/cart-empty.png"/>
            <div class="prefix"></div>
            <a class="text-center d-block empty-shop" href="#">Cart Empty</a>
            <a class="text-center d-block " href=""><span class="return-shop">Return shop</span></a>
            </p>
        <?php endif; ?>
        <div id="empty-cart" class="d-none">
            <p class="text-center">
                <img width="100" class="img-fluid"
                     src="<?php echo esc_url(get_template_directory_uri()) ?>/images/myimage/cart/cart-empty.png"/>
            <div class="prefix"></div>
            <a class="text-center d-block empty-shop" href="#">Cart Empty</a>
            <a class="text-center d-block " href=""><span class="return-shop">Return shop</span></a>
            </p>
        </div>
        <div style="text-align: right">
            <div class="cart-btn modal-action <?php if ($vt == 0) echo 'd-none' ?> text-right ">
                <div class="total-order-cart">
                    <span>Order Total :</span>
                    <span class="total-price"><?php echo $total_price ?></span> VND
                </div>
                <br/>
                <div class="check-out-cart">
                    <a href="<?php wc_get_checkout_url() ?>" class=" btn-modal-cart btn  btn-xs">Checkout</a>
                </div>
            </div>

        </div>
    </div>
<?php get_footer() ?>