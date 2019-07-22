<div class="pro-title">
    <span>BEST SALE</span>
</div>
<div class="row-product fixed-width" style="margin: 0 auto;text-align: center">
    <div class="owl-carousel owl-theme">
        <?php
        $feat_pro = new WP_Query(array('posts_per_page' => 8,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                    'operator' => 'IN'),
            ),
        ));

        while ($feat_pro->have_posts()) :
            $feat_pro->the_post();
            global $product ?>
            <div>
                <div class="product-item">
                    <a href="<?php the_permalink() ?>">
                        <?php
                        $sale = $product->sale_price;
                        $koostis = wc_get_product_terms($product->id, 'pa_color', array('fields' => 'names'));
                        $stock = $product->get_stock_status();
                        ?>

                        <?php if (!empty($sale)): ?>
                            <p class="sale-banner">Sale!</p>
                        <?php endif; ?>
                        <?php the_post_thumbnail('shop_catalog', array("title" => get_the_title(), 'alt' => get_the_title())) ?>

                        <div class="action-detail">
                            <p class="title-product"><?php echo get_the_title() ?></p>
                            <p class="price-product"><?php echo number_format($product->price, 0, ',', '.') . 'đ'; ?>
                                <span style="text-decoration: line-through"><?php if ($product->sale_price) {
                                        echo number_format($product->sale_price, 0, ',', '.') . 'đ';
                                    } ?></span>
                            </p>
                        </div>
                    </a>
                    <div class="content-action d-flex flex-column justify-content-end">
                        <?php if ($stock == 'instock'): ?>
                            <a title="Add cart"
                               class="cart-product add-cart quick_add_to_cart_button button product_type_simple add_to_cart_button ajax_add_to_cart"
                               href="?add-to-cart=<?php echo $product->get_id(); ?>"
                               data-quantity="<?php echo $product->qty ?>"
                               data-product_id="<?php echo $product->get_id(); ?>"
                               data-product_sku="<?php echo $product->sku ?>"
                            ><i class="fa fa-cart-plus"></i></a>
                        <?php else: ?>
                            <a title="View"
                               class="cart-product add-cart "
                               href="<?php the_permalink() ?>"
                            ><i class="fa fa-eye"></i></a>
                        <?php endif; ?>
                        <span class="cart-product view-product"
                              class="tooltip-left" data-tooltip="Quick view"
                              onclick="viewProduct(
                              <?php echo $product->get_id() ?>,this)"
                              data-quantity="<?php echo $product->qty ?>"
                              data-product_id="<?php echo $product->get_id(); ?>"
                              data-product_sku="<?php echo $product->sku ?>"
                              data-product_price="<?php if ($product->get_price()) {
                                  echo number_format($product->get_price(), 0, ',', '.') . 'đ';
                              } ?>"
                              data-product_price_regular="<?php if ($product->get_regular_price()) {
                                  echo number_format($product->get_regular_price(), 0, ',', '.') . 'đ';
                              } ?>"
                              data-product_price_sale="<?php if ($product->get_sale_price()) {
                                  echo number_format($product->get_sale_price(), 0, ',', '.') . 'đ';
                              } ?>"
                              data-product_price_stock="<?php $product->get_stock_status(); ?>"
                              data-product_link="<?php the_permalink() ?>"
                        ><i
                                    class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>

        <?php endwhile;
        wp_reset_query()
        ?>
    </div>
    <!--    Quick view-->
    <?php get_template_part('template_part/content', 'quickview') ?>
    <!--    End Quick view-->

</div>