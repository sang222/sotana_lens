<?php
global $woocommerce;

?>
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content modal-cart-content">
                <div class="modal-header">
                    <button type="button" class="close close-custom" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title "><i class="fa fa-cart-plus"></i> My cart</h4>
                </div>
                <div class="modal-body frm-cart ">
                    <div class="  table-responsive">
                        <!--                    <form class="woocommerce-cart-form frm-cart" action="-->
                        <?php //echo esc_url(wc_get_cart_url()) ?><!--" method="post">-->
                        <table class="table table-bordered  table-cart shop_table shop_table_responsive cart woocommerce-cart-form__contents">
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
                                <tr>
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
                                            <button onclick="var result = document.getElementById('qty_<?php echo $values['product_id']; ?>');
                                                    var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;"
                                                    class="action-count reduced items-count2"
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
                                                    class=" action-count increase items-count2"
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
                    </div>
                    <div id="modal-empty-cart" class="d-none">
                        <p class="text-center">Cart empty</p>
                        <p class="text-center">

                            <img width="100" class="img-fluid"
                                 src="<?php echo esc_url(get_template_directory_uri()) ?>/images/myimage/cart/cart-empty.png"/>
                        <div class="prefix"></div>
                        <a class="text-center d-block " style="margin-top: 10px" href=""><span class="return-shop">Return shop</span></a>
                        <br/>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="cart-btn modal-action text-right ">
                        <div>
                            <span>Order Total</span>
                            <span class="total-price"><?php echo $total_price ?></span> VND
                        </div>
                        <br/>
                        <!--                            <button type="submit" class="button btn-update-cart btn-modal-cart btn  btn-xs" name="update_cart"-->
                        <!--                                    value="Update cart" disabled="">Update Cart-->
                        <!--                            </button>-->
                        </button>
                        <a href="/checkout" class=" btn-modal-cart btn  btn-xs">Checkout</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
