<div class="pro-title">
    <div class="fixed-width content-title">
        <span>HOT SALE</span>
    </div>

</div>
<div class="row-product fixed-width" id="product-option" style="margin: 0 auto;text-align: center">
    <?php global $tp_option;
    $category_hot = $tp_option['product-hot'];
    ?>
    <div class="tab clearfix text-center clearfix">
        <?php $dem = 0; ?>
        <?php foreach ($category_hot as $cate_id): ?>
            <button data-vt="<?php $dem + 1; ?>"
                    class="pro-tablinks text-uppercase <?php if ($dem == 0) echo 'active' ?>"
                    onclick="openProTabs(<?php echo $dem + 1 ?>,this)" id="defaultOpenProTabs">
                <?php echo get_the_category_by_ID($cate_id) ?>
            </button>
            <?php $dem++; endforeach; ?>
    </div>
</div>
<div class="row-product fixed-width" style="margin: 0 auto;text-align: center">
    <?php
    $dem1 = 0;
    foreach ($category_hot as $cate_id):
        $args = array('post_type' => 'product', 'posts_per_page' => 8, 'product_cat' => get_the_category_by_ID($cate_id), 'orderby' => 'rand');
        $loop = new WP_Query($args);
        ?>
        <div class="collection w-100 row colection-<?php echo $dem1 + 1 ?>  <?php if ($dem1 > 0) echo 'd-none' ?>">
            <?php
            while ($loop->have_posts()) : $loop->the_post();
                global $product; ?>

                <div class="col-lg-3 col-sm-6 col-xs-6 ">
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

            <?php
            endwhile;
            wp_reset_query();

            ?>
            <div class="text-center prefix"><span>View all product</span><a class="color-general weight-600"
                                                                            href="<?php echo get_category_link($cate_id)?>"
                                                                            title="<?php echo get_the_category_by_ID($cate_id) ?>"> <?php echo get_the_category_by_ID($cate_id) ?>
                    <i class="fa fa-angle-double-right"></i></a></div>
        </div>
        <?php
        $dem1++;
    endforeach;
    ?>
</div>