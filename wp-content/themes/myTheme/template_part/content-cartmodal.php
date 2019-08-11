<?php
global $woocommerce;

?>
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="vertical-alignment-helper ">
        <div class="modal-dialog vertical-align-center modal-cart-add">
            <div class="modal-content modal-cart-content">
                <div class="modal-header">
                   <button type="button" class="close close-custom" data-dismiss="modal"></button>
                    <h4 class="modal-title "><i class="fa fa-cart-plus"></i> My cart</h4>
                </div>
                <div class="modal-body frm-cart " id="cart-roll">
                    <div class="  ">
                        <!--                    <form class="woocommerce-cart-form frm-cart" action="-->
                        <?php //echo esc_url(wc_get_cart_url())
                        ?><!--" method="post">-->
                        <table class="
                        tablesaw tablesaw-stack
                        table table-bordered  table-cart shop_table shop_table_responsive cart woocommerce-cart-form__contents">
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
                                $price = get_post_meta($values['product_id'], '_price', true);
                                ?>
                                <tr>
                                    <td class="text-center modal-cart-image" style="vertical-align: middle;">
                                        <?php
                                        if ($_product->product_type != 'variation') : ?>
                                            <?php echo $getProductDetail->get_image('thumbnail'); ?>
                                        <?php else: ?>
                                            <?php
                                            $variation_id2 = $values['variation_id'];

                                            $variable_product2 = new WC_Product_Variation($variation_id2);

                                            ?>
                                            <img src="<?php echo wp_get_attachment_image_src($variable_product2->image_id)[0] ?>"/>
                                        <?php endif; ?>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h4 class="title-product-modal"><?php echo $_product->get_title(); ?></h4>
                                        <?php if ($_product->product_type == 'variation') :
                                            ?>
                                            <?php foreach ($values['variation'] as $key => $vari): ?>
                                            <?php if ($key == 'attribute_pa_color' && !empty($vari)): ?>
                                                <p style="margin-bottom: 0">Color:
                                                    <?php echo $vari ?>
                                                </p>
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <p>
                                            Categories:
                                            <?php echo push_to_cat(get_the_terms($values['product_id'], 'product_cat'))
                                            ?></p>
                                    </td>
                                    <td class="text-center"
                                        style="vertical-align: middle;">
                                        <?php
                                        if ($_product->product_type != 'variation') :
                                            if ($getProductDetail->get_sale_price() > 0) {
                                                echo number_format($getProductDetail->get_sale_price(), 0, ',', '.') . 'đ';
                                            } else if ($getProductDetail->get_regular_price()) {
                                                echo number_format($getProductDetail->get_regular_price(), 0, ',', '.') . 'đ';
                                            }
                                            ?>
                                        <?php else: ?>
                                            <?php
                                            $variation_id = $values['variation_id'];
                                            $variable_product1 = new WC_Product_Variation($variation_id);
                                            $regular_price = $variable_product1->regular_price;
                                            $sales_price = $variable_product1->sale_price;
                                            if ($sales_price > 0) {
                                                echo number_format(($sales_price), 0, ',', '.') . '<u>đ</u>';
                                            } else {
                                                echo number_format(($regular_price), 0, ',', '.') . '<u>đ</u>';
                                            }
                                            ?>
                                        <?php endif; ?>
                                    </td>

                                    <td class="qty-modal text-center" style="vertical-align: middle;">
                                        <div class="js-qty">
                                            <button onclick="var result = document.getElementById('qty_<?php echo $values['product_id']; ?>_<?php echo $vt ?>');
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
                                                    ?>" data-product_id="<?php echo $values['product_id'] ?>"
                                            ><i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" pattern="[0-9]*"
                                                   class="input-text qty text-center"
                                                   id="qty_<?php echo $values['product_id'] ?>_<?php echo $vt ?>"
                                                   min="1"
                                                   value="<?php echo $values['quantity']; ?>"
                                                   title="SL" max="100"
                                                   data-quantity="<?php echo $values['quantity']; ?>"
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
                                            <button onclick="var result = document.getElementById('qty_<?php echo $values['product_id']; ?>_<?php echo $vt ?>'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
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
                                        <?php if ($_product->product_type != 'variation') : ?>
                                            <span class="total-price-<?php echo $values['product_id'] ?>">
                                            <?php if ($getProductDetail->get_sale_price() > 0) {
                                                echo number_format(($getProductDetail->get_sale_price() * $values['quantity']), 0, ',', '.') . 'đ';
                                            } else if($getProductDetail->get_regular_price()) {
                                                echo number_format(($getProductDetail->get_regular_price() * $values['quantity']), 0, ',', '.') . 'đ';
                                            }
                                            ?>
                                        </span>
                                        <?php else: ?>
                                            <?php
                                            $variation_id = $values['variation_id'];
                                            $variable_product1 = new WC_Product_Variation($variation_id);
                                            $regular_price = $variable_product1->regular_price;
                                            $sales_price = $variable_product1->sale_price;
                                            if ($sales_price > 0) {
                                                echo number_format(($sales_price * $values['quantity']), 0, ',', '.') . '<u>đ</u>';
                                            } else {
                                                echo number_format(($regular_price * $values['quantity']), 0, ',', '.') . '<u>đ</u>';
                                            }
                                            ?>
                                        <?php endif; ?>
                                        <?php if ($_product->product_type != 'variation') : ?>
                                            <span
                                                    class=" remove-product float-right"
                                                    data-product_id="<?php echo $values['product_id'] ?>"
                                                    data-product_sku="<?php echo $getProductDetail->get_sku() ?>"><i
                                                        class="fa fa-trash"></i>
                                            </span>
                                        <?php else: ?>
                                            <span
                                                    class=" remove-product-variable float-right"
                                                    data-key_items="<?php echo $item ?>"
                                                    data-product_id="<?php echo $values['product_id'] ?>"
                                                    data-product_sku="<?php echo $getProductDetail->get_sku() ?>"><i
                                                        class="fa fa-trash"></i>
                                            </span>
                                        <?php endif; ?>
                                    </td>
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
                            <img width="100" class="img-fluid m-auto"
                                 src="<?php echo esc_url(get_template_directory_uri()) ?>/images/myimage/cart/cart-empty.png"/>
                        <div class="prefix"></div>
                        <a class="text-center d-block " style="margin-top: 10px" href=""><span
                                    class="return-shop">Return shop</span></a>
                        <br/>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="cart-btn modal-action text-right ">
                        <div>
                            <?php $amount2 = floatval(preg_replace('#[^\d.]#', '', $woocommerce->cart->get_cart_total())); ?>
                            <span>Order Total</span>
                            <span class="total-price"><?php echo number_format($amount2, 0, ',', '.') . 'đ'; ?></span>
                        </div>
                        <br/>
                        </button>
                        <a href="<?php wc_get_checkout_url() ?>" class=" btn-modal-cart btn  btn-xs">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
