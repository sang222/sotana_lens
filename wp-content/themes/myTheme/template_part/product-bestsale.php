<?php
$feat_pro = new WP_Query(array('posts_per_page' => 10,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_visibility',
            'field' => 'name',
            'terms' => 'featured',
            'operator' => 'IN'),
    ),
));

?>
<?php if ($feat_pro->have_posts()): ?>
    <div class="pro-title wow fadeIn">
        <div class="fixed-width content-title title-slider">
            <span class="text-uppercase">BEST SALE</span>
        </div>

    </div>
<?php endif; ?>
<div class="row-product fixed-width wow fadeIn" style="padding: 0 15px">
    <div class="owl-carousel  owl-theme " id="sale-carousel">
        <?php
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
                        <div class="img-thumb">
                            <!--                            --><?php //the_post_thumbnail('shop_catalog', array('alt' => get_the_title(), 'class' => 'lazyload','src'=>get_theme_file_uri().'/images/myimage/lazyload.jpg','data-src'=>''))
                            ?>
                            <img
                                class="lazyload"
                                src="<?php echo get_theme_file_uri() ?>/images/myimage/lazyload.jpg"
                                data-src="<?php the_post_thumbnail_url(); ?>"
                            />
                        </div>
                    </a>
                    <div class="action-detail">

                        <p class="title-product"><?php echo get_the_title() ?></p>
                        <p class="price-product">
                            <?php if ($product->product_type != 'variable') : ?>
                                <span class="sale-price" style="text-decoration: line-through">
                                <?php if ($product->sale_price) {
                                    echo number_format($product->sale_price, 0, ',', '.') . 'đ';
                                } ?>
                                </span>
                                <span class="regular-price">
                                    <?php if ($product->price) echo number_format($product->price, 0, ',', '.') . 'đ'; ?>
                                </span>
                            <?php else: ?>
                                <?php $available_variations = $product->get_available_variations(); ?>
                                <span class="sale-price" style="text-decoration: line-through">
                                <?php if ($available_variations[0]['display_price']) {
                                    echo number_format($available_variations[0]['display_price'], 0, ',', '.') . 'đ';
                                } ?>
                                </span>
                                <span class="regular-price">
                                    <?php if ($available_variations[0]['display_regular_price']) echo number_format($available_variations[0]['display_regular_price'], 0, ',', '.') . 'đ'; ?>
                                </span>
                            <?php endif; ?>

                        </p>
                        <?php
                        if ($product->product_type == 'variable') {
                            $available_variations = $product->get_available_variations();
                            $attributes = $product->get_attributes();
                            $variation_id_first = '';
                            $first_instock = null;
                            $vt = 0;
                            ?>
                            <?php
                            foreach ($available_variations as $key => $variations) {
                                $variation_id = $available_variations[$key]['variation_id'];
                                $variable_product1 = new WC_Product_Variation($variation_id);
                                ?>
                                <div class="d-inline-block ">
                                    <!--                                    --><?php //var_dump($variable_product1->stock_status) ?>
                                    <?php if ($variable_product1->stock_status == 'instock'):
                                        $vt++;
                                        if ($vt == 1) {
                                            $variation_id_first = $variation_id;
                                            $first_color = $variations['attributes']['attribute_pa_color'];
                                        }
                                        ?>
                                        <div class="d-inline-block box-variable-pr border <?php if ($vt == 1) echo 'active' ?>"
                                             data-variation_id="<?php echo $variation_id ?>"
                                             data-product_id="<?php echo $product->get_id() ?>"
                                             data-display_price="<?php echo $variations['display_price'] ?>"
                                             data-attribute_pa_color="<?php echo $variations['attributes']['attribute_pa_color'] ?>"
                                             data-attribute_pa_size="<?php echo $variations['attributes']['attribute_pa_size'] ?>"
                                             data-display_regular_price="<?php echo $variations['display_regular_price'] ?>"
                                        >
                                            <img style="width:32px" height="32px"
                                                 src="<?php echo $variations['image']['src'] ?>"/>
                                        </div>
                                    <?php
                                    else:
                                        ?>
                                        <div class="d-inline-block box-variable-pr out-variable-pr border"
                                             data-attribute_pa_color="<?php echo $variations['attributes']['attribute_pa_color'] ?>">
                                            <img style="width:32px" height="32px"
                                                 src="<?php echo $variations['image']['src'] ?>"/>
                                        </div>
                                    <?php
                                    endif; ?>

                                </div>
                                <?php


                            }
                        } else {
                            ?>
                            <div class="d-inline-block box-variable-pr border active ">
                                <?php the_post_thumbnail('shop_catalog', array('alt' => get_the_title(), 'class' => 'lazyOwl')) ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="action-add">
                            <div class="content-action d-flex flex-column justify-content-end">
                                <?php if ($stock == 'instock'): ?>
                                    <?php if ($product->product_type != 'variable'): ?>
                                        <a title="Add cart"
                                           class="cart-product add-cart quick_add_to_cart_button button product_type_simple add_to_cart_button ajax_add_to_cart"
                                           href="?add-to-cart=<?php echo $product->get_id(); ?>"
                                           data-quantity="<?php echo $product->qty ?>"
                                           data-product_id="<?php echo $product->get_id(); ?>"
                                           data-product_sku="<?php echo $product->sku ?>"
                                           tooltip="Add to cart" flow="left"
                                        ><i class="fa fa-cart-plus"></i></a>
                                    <?php else: ?>
                                        <a title="Add cart"
                                           class="cart-product add-cart add-variable"
                                           href="?add-to-cart=<?php echo $product->get_id() ?>"
                                           data-variation_id="<?php echo $variation_id_first; ?>"
                                           data-attribute_pa_color="<?php echo $first_color; ?>"
                                           data-product_id="<?php echo $product->get_id() ?>"
                                        ><i class="fa fa-cart-plus"></i> </a>
                                        </a>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <a title="View"
                                       class="cart-product add-cart "
                                       href="<?php the_permalink() ?>"
                                    ><i class="fa fa-eye"></i></a>
                                <?php endif; ?>
                                <?php if ($product->product_type == 'variable') {
                                    $available_variations = $product->get_available_variations();
                                    $ds = 0;
                                    foreach ($available_variations as $available) {
                                        $variable_product1 = new WC_Product_Variation($available['variation_id']);
                                        if ($variable_product1->stock_status == 'instock' && $ds == 0) {
                                            $stock_first = $available;
                                            $ds++;
                                        }

                                    }
                                }
                                ?>
                                <span class="cart-product view-product"
                                      onclick="viewProduct(
                                      <?php echo $product->get_id() ?>,this)"
                                      data-quantity="<?php echo $product->qty ?>"
                                      data-variable_id="<?php
                                      if ($product->product_type == 'variable') {
                                          echo $stock_first['variation_id'];
                                      }
                                      ?>"
                                      data-attribute_pa_color="<?php
                                      if ($product->product_type == 'variable') {

                                          echo $stock_first['attributes']['attribute_pa_color'];
                                      }
                                      ?>"
                                      data-product_id="<?php echo $product->get_id(); ?>"
                                      data-product_sku="<?php echo $product->sku ?>"

                                      data-product_price_regular="
                                      <?php if ($product->product_type != 'variable') : ?>
                                              <?php if ($product->get_regular_price()) {
                                          echo number_format($product->get_regular_price(), 0, ',', '.') . 'đ';
                                      } ?>
                                          <?php else:
                                          if ($stock_first['display_regular_price']) {
                                              echo number_format($available_variations[0]['display_regular_price'], 0, ',', '.') . 'đ';
                                          }
                                          ?>
                                       <?php endif; ?>"
                                      data-product_price_sale="<?php if ($product->product_type != 'variable') : ?>
                                              <?php if ($product->get_price()) {
                                          echo number_format($product->get_price(), 0, ',', '.') . 'đ';
                                      } ?>
                                          <?php else:
                                          if ($stock_first['display_price']) {
                                              echo number_format($available_variations[0]['display_price'], 0, ',', '.') . 'đ';
                                          }
                                          ?>
                                       <?php endif; ?>"
                                      data-product_price_stock="<?php $product->get_stock_status(); ?>"
                                      data-product_link="<?php the_permalink() ?>"
                                ><i class="fa fa-search"></i></span>

                            </div>
                        </div>
                    </div>


                </div>

            </div>

        <?php endwhile;
        wp_reset_query()
        ?>

    </div>
    <!--    Quick view-->
    <div class="alert-box error-box">Hết hàng</div>
    <?php get_template_part('template_part/content', 'quickview') ?>
    <!--    End Quick view-->

</div>