<?php
global $woocommerce;

?>
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">My cart</h4>
                </div>
                <div class="modal-body frm-cart">
                    <!--                    <form class="woocommerce-cart-form frm-cart" action="-->
                    <?php //echo esc_url(wc_get_cart_url()) ?><!--" method="post">-->
                    <table class="table table-bordered table-cart shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                        <thead>
                        <th></th>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Giá sale</th>
                        <th>Số lượng</th>
                        <th>Số Thành tiền</th>
                        <th></th>
                        </th>
                        </thead>
                        <tbody>
                        <?php
                        $items = $woocommerce->cart->get_cart();
                        $vt = 0;
                        foreach ($items as $item => $values) :
                            $_product = wc_get_product($values['data']->get_id());
                            $getProductDetail = wc_get_product($values['product_id']);
                            $price = get_post_meta($values['product_id'], '_price', true);
                            ?>
                            <tr>
                                <td><?php echo $getProductDetail->get_image('thumbnail'); // accepts 2 arguments ( size, attr )
                                    ?></td>
                                <td><?php echo $_product->get_title(); ?></td>
                                <td><?php echo get_post_meta($values['product_id'], '_regular_price', true) ?></td>
                                <td><?php echo get_post_meta($values['product_id'], '_sale_price', true) ?></td>
                                <td><?php echo $values['quantity']; ?></td>
                                <td><?php echo $values['quantity']; ?></td>
                                <td class="product-remove  ">
                                        <span

                                                class=" remove-product"
                                                data-line="<?php echo $vt ?>"
                                                data-product_id="<?php echo $values['product_id'] ?>"
                                                data-product_sku="<?php echo $getProductDetail->get_sku() ?>"

                                        ><i class="fa fa-trash"></i></span></td>
                            </tr>
                            <?php
                            $vt++;
                        endforeach; ?>
                        </tbody>
                    </table>
                    <!--                    </form> remove remove_from_cart_button-->
                </div>
            </div>
        </div>
    </div>
</div>
