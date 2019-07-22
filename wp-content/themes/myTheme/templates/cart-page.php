<?php /*
Template Name: Cart-Page
*/ ?>
<?php global $woocommerce;
$items = $woocommerce->cart->get_cart();
?>
<?php get_header() ?>
    <div class="fixed-width " id="tbl-content">
        <h3>My cart</h3>
        <?php if (sizeof($items) > 0) : ?>
            <table
                    class="table table-bordered table-cart shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center">Sản phẩm</th>
                    <th class="text-center">Đơn giá</th>
                    <th class="text-center">Giá sale</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Số Thành tiền</th>
                    <th class="text-center"></th>
                </tr>
                </th>
                </thead>
                <tbody>
                <?php

                $vt = 0;
                foreach ($items as $item => $values) :
                    $_product = wc_get_product($values['data']->get_id());
                    $getProductDetail = wc_get_product($values['product_id']);
                    $price = get_post_meta($values['product_id'], '_price', true);
                    ?>
                    <tr>
                        <td style="vertical-align: middle;"
                            class="text-center"><?php echo $getProductDetail->get_image('thumbnail'); // accepts 2 arguments ( size, attr )
                            ?></td>
                        <td style="vertical-align: middle;" class="text-center">
                            <h4><?php echo $_product->get_title(); ?></h4></td>
                        <td style="vertical-align: middle;"
                            class="text-center"><?php echo get_post_meta($values['product_id'], '_regular_price', true) ?></td>
                        <td style="vertical-align: middle;"
                            class="text-center"><?php echo get_post_meta($values['product_id'], '_sale_price', true) ?></td>
                        <td style="vertical-align: middle;" class="text-center">
                            <div class="js-qty">
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
                                       value="<?php echo $values['quantity']; ?>"
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
                            </div>
                        </td>
                        <td style="vertical-align: middle;" class="text-center"><?php echo $values['quantity']; ?></td>
                        <td style="vertical-align: middle;" class="product-remove text-center">
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
        <?php else: ?>
            <p class="">
                <a href="#">Cart Empty</a><br/>
                <a href="">Return shop</a>
            </p>
        <?php endif; ?>
        <div style="text-align: right">
            <div><span>Tổng tiền:<h3 style="display: inline-block">300,000đ</h3></span></div>
            <div class="d-block">
                <button type="submit" name="update" class="btnCart update-cart" onclick="buyXgetY.UpdateCartFromCart();">Cập nhật</button>
                <button type="submit" name="update" class="btnCart update-cart" onclick="buyXgetY.UpdateCartFromCart();">Thanh Toán</button>
            </div>
        </div>
    </div>
<?php get_footer() ?>