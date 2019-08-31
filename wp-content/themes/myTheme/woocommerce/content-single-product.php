<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;
?>

<?php
global $product;
global $wp;
$currentURL = home_url($wp->request);

?>
<div class="breadcrumb-colect prefix">
    <div class="fixed-width content-breadcrum">
        <div class="pro-title-breadcrumb text-center">
            <h4><?php the_title() ?></h4>
        </div>
        <div class="text-center"><?php echo woocommerce_breadcrumb(); ?></div>
        <br/>
        <br/>
    </div>
</div>
<div class="content-cart fixed-width">
    <div class="clearfix"></div>
    <div class="view-product" style="padding: 0px 10px;">

        <div class="row">
            <?php $attachment_ids = $product->get_gallery_attachment_ids(); ?>
            <div class="col-lg-1 col-sm-1 col-xs-12 list-picture "
                 style="padding: 0px 0px !important;">
                <?php if (sizeof($attachment_ids) >= 4) : ?>
                    <div class="top-arrow text-center w-100" style="display: inline-block;"><i
                                class="fa fa-angle-up fa-2x"></i></div>
                <?php endif; ?>
                <div id="verticle-slick" class="slick-carousel <?php if (sizeof($attachment_ids) < 4) echo 'mt-4'; ?>">
                    <?php
                    $vt = 0;
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->post->ID), 'single-post-thumbnail');

                    $active = 'active';
                    ?>
                    <div><img src="<?php echo $image[0] ?>" class="img-responsive active"></div>
                    <?php
                    foreach ($attachment_ids as $attachment_id):
                        $vt++;
                        $image_link = wp_get_attachment_url($attachment_id);
                        ?>
                        <div><img src="<?php echo $image_link ?>" class="img-responsive"></div>

                    <?php endforeach; ?>
                </div>
                <?php if ($vt >= 5): ?>
                    <div class="bottom-arrow text-center w-100" style="display: inline-block;"><i
                                class="fa-2x fa fa-angle-down"></i></div>
                <?php endif; ?>

            </div>
            <div id="mark-fixed"></div>
            <div class="col-lg-7 col-sm-7 col-xs-12">
                <div class="text-center">
                    <img id="zoom" style="max-height: 505px"
                         src="<?php echo $image[0] ?>"
                         data-zoom-image="<?php echo $image[0] ?>"/>
                    <br/>
                    <br/>
                    <p class="text-center w-100">
                        <small class="weight-600"><?php echo __('Zoom in and Zoom out to view product', 'localFile') ?></small>
                    </p>
                </div>
                <div class="slick-carousel-mobile owl-carousel owl-theme w-100">
                    <?php
                    $vt1 = 0;
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->post->ID), 'single-post-thumbnail');
                    $active = 'active';
                    ?>
                    <div><img src="<?php echo $image[0] ?>" class="img-responsive active"></div>
                    <?php
                    foreach ($attachment_ids as $attachment_id):
                        $vt1++;
                        $image_link = wp_get_attachment_url($attachment_id);
                        ?>
                        <div><img src="<?php echo $image_link ?>" class="img-responsive"></div>

                    <?php endforeach; ?>
                </div>

            </div>
            <div class="col-lg-4 col-sm-5 col-xs-12 product-detail">
                <div class="d-flex  w-100 justify-content-between align-items-center">
                    <div>
                        <h2 class="my-0 title-product"><?php the_title() ?></h2>
                    </div>
                    <?php
                    global $post, $product;
                    $stock_st = $product->get_stock_status();
                    $stock = str_replace(array('instock', 'outofstock'), array('Còn hàng', 'Hết hàng'), $stock_st);
                    ?>

                    <div class="status-product <?php if ($stock_st == 'instock') echo 'has'; else echo 'not-has'; ?> "><?php echo $stock; ?></div>

                </div>
                <div class="meta-product">
                    <?php
                    $terms = get_the_terms($product->get_id(), 'product_cat');
                    //                    var_dump($terms);
                    $trademark = array();
                    foreach ($terms as $category) {

                        if ($category->parent == 49) {

                            array_push($trademark, $category);
                        }
//                        var_dump(get_category($category->term_id));


                    }
                    ?>
                    <span><?php echo __('Trademark:', 'localFile') ?> <b><a
                                    href="<?php echo home_url() ?>/collection/?cat_name=<?php echo $trademark[0]->slug ?>"><?php echo $trademark[0]->name . '' ?></a></b> </span>
                </div>
                <div class="social-product">
                    <span class="share-in"><?php echo __('Chia sẻ trên', 'localFile') ?> </span>
                    <a class="fb-share " href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $currentURL; ?>">
                        <span class="icon-share facebook-icon">
                                <i class="fa fa-facebook"></i>
                        </span>
                    </a>
                    <a class="fb-share  zalo-share">
                        <span class="icon-share zalo-icon">
                               <img width="20" height="20" src="<?php echo get_template_directory_uri() ?>/images/myimage/favicon.ico"/>
                        </span>
                    </a>
                    <div class="zalo-share-button d-none" data-href="<?php echo $currentURL; ?>" data-oaid="579745863508352884" data-layout="2" data-color="blue" data-customize=false></div>
                    <a class="fb-share" href="https://plus.google.com/share?url=<?php echo $currentURL; ?>">
                    <span class="icon-share google-icon">
                            <i class="fa fa-google"></i>
                    </span>
                    </a>
                </div>
                <div class="description">
                    <p>
                        <?php echo $product->short_description; ?>
                    </p>
                </div>
                <?php
                if ($product->is_type('simple')) : ?>
                    <div class="price-product">
                    <span class="current-price <?php if ($product->get_sale_price()) {
                        echo 'through';
                    } ?>"><?php if ($product->get_regular_price()) echo number_format($product->get_regular_price(), 0, ',', '.') . 'đ'; ?></span>
                        <span class="sale-price"
                        ><?php if ($product->get_sale_price()) echo number_format($product->get_sale_price(), 0, ',', '.') . 'đ'; ?></span>
                    </div>
                <?php else:
                    $available_variations = $product->get_available_variations();
                    ?>
                    <div class="price-product">
                        <span class="current-price <?php if ($available_variations[0]['display_regular_price']) {
                            echo 'through';
                        } ?>"><?php if ($available_variations[0]['display_regular_price']>$available_variations[0]['display_price']) echo number_format($available_variations[0]['display_regular_price'], 0, ',', '.') . 'đ'; ?></span>
                        <span class="sale-price"
                        ><?php if ($available_variations[0]['display_price']) echo number_format($available_variations[0]['display_price'], 0, ',', '.') . 'đ'; ?></span>
                    </div>
                <?php endif; ?>
                <div class="product-variable">
                    <?php
                    if ($product->product_type == 'variable') {
                        $available_variations = $product->get_available_variations();
                        $attributes = $product->get_attributes();
                        $variation_id_first = '';
                        $first_instock = null;
//                        var_dump($attributes);
                        $vt = 0;
                        ?>
                        <h5 class="title-variable"><b><?php if (isset($attributes['pa_color'])) echo 'Color: ' ?></b>
                        </h5>
                        <?php
                        foreach ($available_variations as $key => $variations) {
//                            var_dump($key);
                            $variation_id = $available_variations[$key]['variation_id'];
                            $variable_product1 = new WC_Product_Variation($variation_id);
//                            var_dump($variable_product1->stock_status);
                            ?>
                            <div class="d-inline-block ">

                                <?php if ($variable_product1->stock_status == 'instock'):
                                    $vt++;
                                    if ($vt == 1) {
                                        $variation_id_first = $variation_id;
                                        $first_color = $variations['attributes']['attribute_pa_color'];
                                        $first_size = $variations['attributes']['attribute_pa_size'];
                                    }
                                    ?>
                                    <div class="d-inline-block box-variable border <?php if ($vt == 1) echo 'active' ?>"
                                         data-variation_id="<?php echo $variation_id ?>"
                                         data-display_price="<?php echo $variations['display_price'] ?>"
                                         data-attribute_pa_color="<?php echo $variations['attributes']['attribute_pa_color'] ?>"
                                         data-attribute_pa_size="<?php echo $variations['attributes']['attribute_pa_size'] ?>"
                                         data-display_regular_price="<?php echo $variations['display_regular_price'] ?>"
                                         style="padding: 5px">
                                        <span><?php echo $variations['attributes']['attribute_pa_color'] ?></span>
                                        <img width="30" height="30" src="<?php echo $variations['image']['src'] ?>"/>
                                    </div>
                                <?php
                                else:
                                    ?>
                                    <div class="d-inline-block box-variable box-out-variable border "
                                         data-variation_id="<?php echo $variation_id ?>"
                                         data-display_price="<?php echo $variations['display_price'] ?>"
                                         data-attribute_pa_color="<?php echo $variations['attributes']['attribute_pa_color'] ?>"
                                         data-attribute_pa_size="<?php echo $variations['attributes']['attribute_pa_size'] ?>"
                                         data-display_regular_price="<?php echo $variations['display_regular_price'] ?>"
                                         style="padding: 5px">
                                        <span><?php echo $variations['attributes']['attribute_pa_color'] ?></span>
                                        <img width="30" height="30" src="<?php echo $variations['image']['src'] ?>"/>
                                    </div>
                                <?php
                                endif; ?>

                            </div>
                            <?php
                        }
                    }
                    ?>
                    </p>
                </div>
                <div class="acttion-carts qty-quick-views">
                    <?php $stock_st = $product->get_stock_status();
                    if ($stock_st == 'instock'):
                        ?>
                        <button onclick="var result = document.getElementById(&#39;qty_1&#39;); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;"
                                class="reduced action-count items-count2" type="button"><i class="fa fa-minus"></i>
                        </button>
                        <input type="text" pattern="[0-9]*" class="input-text qty" id="qty_1" min="1" title="SL"
                               max="100"
                               max inputmode="numeric" value="<?php if (isset($_POST['quantity'])) {
                            echo $_POST['quantity'];
                        } else {
                            echo '1';
                        } ?>" maxlength="3" name="quantity"
                               onkeyup="valid(this,&#39;numbers&#39;)" onblur="valid(this,&#39;numbers&#39;)">
                        <button onclick="var result = document.getElementById(&#39;qty_1&#39;); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                                class="increase action-count items-count2"
                                data-id="<?php echo $product->get_id(); ?>"
                                type="button">
                            <i class="fa fa-plus"></i>
                        </button>
                        <?php if ($product->is_type('simple')) : ?>
                        <a title="Add cart" id="add-more"
                           class="cart-product add-cart add_single  button product_type_simple add_to_cart_button ajax_add_to_cart"
                           href="?add-to-cart=<?php echo $product->get_id() ?>"
                           data-quantity="1"
                           data-product_id="<?php echo $product->get_id() ?>"
                        ><i class="fa fa-cart-plus"></i> <?php echo __('Add to cart', 'localFile') ?></a>
                    <?php else: ?>
                        <a title="Add cart"
                           class="cart-product add-cart add-variable"
                           href="?add-to-cart=<?php echo $product->get_id() ?>"
                           data-variation_id="<?php echo $variation_id_first; ?>"
                           data-attribute_pa_color="<?php echo $first_color; ?>"
                           data-product_id="<?php echo $product->get_id() ?>"
                           data-attribute_pa_size="<?php echo $first_size ?>"
                        ><i class="fa fa-cart-plus"></i> <?php echo __('Add to cart', 'localFile') ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php if(get_field('try-eye')): ?>
                    <div class="try_eyewear">
                        <p><?php echo __('Bạn có muốn xem thử kính có hợp với mình không?', 'localFile') ?> <a
                                    class="color-secondary"
                                    href="<?php echo esc_url(get_page_link(get_page_by_path('try-eyewear'))) ?>/?id_lens=<?php echo get_the_ID() ?>">
                                <?php echo __('Thử kính ngay', 'localFile') ?></a>.</p>
                    </div>
                <?php endif; ?>
                <div class="ship-detail">
                    <div class="product-size-hotline">
                        <div class="product-hotline d-flex justify-content-between align-items-center">
                            <a href="tel: <?php echo get_field('thong_tin', 'option')['phone'] ?>">
                                <img
                                        src="<?php echo get_theme_file_uri() ?>/images/myimage/single/phone-receiver.png?v=78"><span> <?php echo get_field('thong_tin', 'option')['phone'] ?></span>
                            </a>
                            <span>
                                <img src="<?php echo get_theme_file_uri() ?>/images/myimage/single/open.png?v=78"> <?php echo __('9h00 : 20h00', 'localFile') ?>
                            </span>
                        </div>
                        <div class="product-policy">
                            <ul class="no-bullets">
                                <li>
                                    <div class="icon">
                                        <img src="<?php echo get_theme_file_uri() ?>/images/myimage/single/pro_policy_icon1.png?v=78"
                                             alt="Giao hàng miễn phí">
                                    </div>
                                    <span><?php echo __('Giao hàng miễn phí', 'localFile') ?></span>
                                    <span class="small"><?php echo __('(Sản phẩm trên 500k)', 'localFile') ?></span>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="<?php echo get_theme_file_uri() ?>/images/myimage/single/pro_policy_icon2.png?v=78"
                                             alt="Đổi trả miễn phí">
                                    </div>
                                    <span><?php echo __('Đổi trả miễn phí', 'localFile') ?></span>
                                    <span class="small"><?php echo __('(30 ngày)', 'localFile') ?></span>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="<?php echo get_theme_file_uri() ?>/images/myimage/single/pro_policy_icon3.png?v=78"
                                             alt="Thanh toán COD">
                                    </div>
                                    <span><?php echo __('Thanh toán COD', 'localFile') ?></span>
                                    <span class="small"><?php echo __('(Thanh toán khi nhận hàng)', 'localFile') ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8" id="content">
        <div class="content-wp">
            <?php the_content() ?>
        </div>
    </div>
    <div class="prefix"></div>
    <div class="pro-title fixed-width m-auto wow fadeIn">
        <div class="pro-title wow fadeIn">
            <div class="fixed-width content-title title-slider">
                <span class="text-uppercase"><?php echo __('RELATED PRODUCTS', 'localFile') ?></span>
            </div>
        </div>

    </div>
    <div class="row-product fixed-width w-100 prefix"  style="padding: 0 15px">
        <div class="owl-carousel owl-theme " id="sale-carousel-related">
            <?php
            global $post;
            // get categories
            $terms = wp_get_post_terms($post->ID, 'product_cat');
            foreach ($terms as $term) $cats_array[] = $term->term_id;
            $query_args = array('post__not_in' => array($post->ID), 'posts_per_page' => 5, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $cats_array
                )));
            $r = new WP_Query($query_args);
            if ($r->have_posts()) {
                ?>
                <?php while ($r->have_posts()) : $r->the_post();
                    global $product; ?>
                    <div>
                        <div class="product-item">
                            <a href="<?php the_permalink() ?>">
                                <?php
                                $sale = $product->sale_price;
                                $koostis = wc_get_product_terms($product->id, 'pa_color', array('fields' => 'names'));
                                $stock = $product->get_stock_status();
                                ?>
                                <?php if (!empty($sale)): ?>
                                    <p class="sale-banner"><?php echo __('Sale!', 'localFile') ?></p>
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
                                <?php if ($product->is_on_sale()) {
                                    echo number_format($product->get_sale_price(), 0, ',', '.') . 'đ';
                                } ?>
                                </span>
                                        <span class="regular-price">
                                    <?php if ($product->get_regular_price()) echo number_format($product->get_regular_price(), 0, ',', '.') . 'đ'; ?>
                                </span>
                                    <?php else: ?>

                                        <?php $available_variations = $product->get_available_variations();
                                        $d = 0;
                                        ?>
                                        <?php foreach ($available_variations as $key => $variations) :
                                            $d++;
                                            if ($d == sizeof($available_variations)) {
                                                $first = $available_variations[0];
                                            }
                                            $variation_id = $available_variations[$key]['variation_id'];
                                            $variable_product1 = new WC_Product_Variation($variation_id);
                                            ?>
                                            <?php if ($variable_product1->stock_status == 'instock'): ?>
                                            <?php $first = $variations;
                                            break; ?>
                                        <?php endif; ?>
                                        <?php endforeach; ?>

                                        <span class="sale-price" style="text-decoration: line-through">
                                                    <?php if ($first['display_price'] < $first['display_regular_price']) {
                                                        echo number_format($first['display_price'], 0, ',', '.') . 'đ';
                                                    } ?>
                                                </span>
                                        <span class="regular-price">
                                                <?php if ($first['display_regular_price']) echo number_format($first['display_regular_price'], 0, ',', '.') . 'đ'; ?>
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
                                                     data-display_price="<?php if ($variations['display_regular_price'] > $variations['display_price']) echo $variations['display_price'] ?>"
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
                                                     data-variation_id="<?php echo $variation_id ?>"
                                                     data-product_id="<?php echo $product->get_id() ?>"
                                                     data-display_price="<?php if ($variations['display_regular_price'] > $variations['display_price']) echo $variations['display_price'] ?>"
                                                     data-attribute_pa_size="<?php echo $variations['attributes']['attribute_pa_size'] ?>"
                                                     data-display_regular_price="<?php echo $variations['display_regular_price'] ?>"
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
                                            foreach ($available_variations as $key => $available) {
                                                $variation_id = $available_variations[$key]['variation_id'];
                                                $variable_product1 = new WC_Product_Variation($variation_id);
                                                $ds++;
                                                if (sizeof($available_variations) == $ds) {
                                                    $stock_first = $available_variations[0];
                                                }
                                                if ($variable_product1->stock_status == 'instock') {
                                                    $stock_first = $available;
                                                    break;

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
                                                      echo number_format($stock_first['display_regular_price'], 0, ',', '.') . 'đ';
                                                  }
                                                  ?>
                                       <?php endif; ?>"
                                              data-product_price_sale="<?php if ($product->product_type != 'variable') : ?>
                                              <?php if ($product->get_price()) {
                                                  echo number_format($product->get_price(), 0, ',', '.') . 'đ';
                                              } ?>
                                          <?php else:
                                                  if ($stock_first['display_regular_price'] > $stock_first['display_price']) {
                                                      echo number_format($stock_first['display_price'], 0, ',', '.') . 'đ';
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
                <?php endwhile; ?>

                <?php
                // Reset the global $the_post as this query will have stomped on it
                wp_reset_query();
            } else {
                echo '<h4 class="text-center">Không có sản phẩm liên quan</h4>';
            }
            ?>
        </div>
    </div>
    <div class="alert-box error-box"><?php echo __('Hết hàng', 'localFile') ?></div>
    <!--    Quick view-->
    <?php get_template_part('template_part/content', 'cartmodal') ?>
    <!-- content notice -->
    <!--    --><?php //get_template_part('template_part/content', 'notice') ?>
    <!-- content notice -->
    <?php get_template_part('template_part/content', 'quickview') ?>
</div>
