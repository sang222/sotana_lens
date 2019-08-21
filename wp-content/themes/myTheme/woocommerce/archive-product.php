<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */


?>
<?php $cate = get_queried_object();
$trademark = array();
?>
<div class="breadcrumb-colect prefix">
    <div class="fixed-width content-breadcrum">
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
<div class="row-product fixed-width " id="collection-container" style="margin: 0 auto;text-align: center">
    <div class="row">
        <input type="hidden" id="vendor" value="<?php echo $_GET['vendor'] ?>"/>
        <input type="hidden" id="price" value="<?php echo $_GET['price'] ?>"/>
        <?php
        global $post;
        $dem1 = 0;
        $price = (isset($_GET['price']) && !empty($_GET['price'])) ? esc_attr($_GET['price']) : '0:500000000';
        $price = explode(':', $price);
        $vendor = (isset($_GET['vendor'])) ? trim(esc_attr($_GET['vendor'])) : '';
        $vendor = explode(',', $vendor);
        $cateID = $cate->term_id;
        if (sizeof($vendor) > 1) {
            $args = array(
                'post_type' => array('product', 'product_variation'),
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'paged' => $paged,
                'posts_per_page' => 12,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => '_price',
                        'value' => $price[0],
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    ),
                    array(
                        'key' => '_price',
                        'value' => $price[1],
                        'compare' => '<=',
                        'type' => 'NUMERIC'
                    ),
                ),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => $vendor,
                        'operator' => 'IN'
                    ),
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms' => $cateID,
                        'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ),
                    array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'slug',
                        'terms' => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                        'operator' => 'NOT IN'
                    )


                ),
            );
        } else {
            $args = array(
                'post_type' => array('product', 'product_variation'),
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'paged' => $paged,
                'posts_per_page' => 12,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => '_price',
                        'value' => $price[0],
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    ),
                    array(
                        'key' => '_price',
                        'value' => $price[1],
                        'compare' => '<=',
                        'type' => 'NUMERIC'
                    ),
                ),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms' => $cateID,
                        'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ),
                    array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'slug',
                        'terms' => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                        'operator' => 'NOT IN'
                    )


                ),
            );

        }
        $loop = new WP_Query($args);

        ?>
        <input type="hidden" id="cate_id" value="<?php echo $cateID ?>"/>
        <div class="collection-one float-left col-lg-9 col-sm-8 col-xs-12 px-0 ml-0 colection-<?php echo $dem1 + 1 ?>  <?php if ($dem1 > 0) echo 'd-none' ?>">
            <h1 class="title-cate text-left"><?php echo $cate->name ?></h1>
            <div class="grid--product">
                <?php
                $stt = 1;
                while ($loop->have_posts()) :
                    $loop->the_post();
                    global $product;
                    $max_post_count = $loop->post_count;

                    ?>
                    <div class=" ">
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
                                    <?php the_post_thumbnail('shop_catalog', array('alt' => get_the_title(), 'class' => 'lazyOwl')) ?>
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
                    <?php
                    $stt++;
                endwhile;
                wp_reset_query();
                ?>
            </div>
            <?php if ($max_post_count == 0) echo '<h3>Not found product</h3>' ?>
            <div class="prefix"></div>
            <?php devvn_corenavi_ajax($loop); ?>
        </div>
        <div class="float-right col-lg-3 col-sm-4 col-xs-12">
            <?php set_query_var('my_var', $cateID); ?>
            <?php get_template_part('template_part/content', 'sidebar') ?>
        </div>
    </div>
</div>
<div class="alert-box error-box"><?php echo __('Hết hàng', 'localFile') ?></div>
<?php
//quickview
get_template_part('template_part/content', 'quickview');
//cart Modal
get_template_part('template_part/content', 'cartmodal');
//conent loading
get_template_part('template_part/content', 'loading');
get_footer('shop');
?>
<script>
    function replaceUrlParam(paramName, paramValue) {
        var url = window.location.href;

        if (paramValue == null) {
            paramValue = '';
        }

        var pattern = new RegExp('\\b(' + paramName + '=).*?(&|#|$)');
        if (url.search(pattern) >= 0) {
            return url.replace(pattern, '$1' + paramValue + '$2');
        }

        url = url.replace(/[?#]$/, '');
        return url + (url.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue;
    }

    var arr = Array.from($('#vendor').val().split(','));
    $(".no-bullets input[type=radio]").change(function () {
        $('.fixed-loading').removeClass('d-none')
        $('body').css({'overflow': 'hidden'})
        var newurl = replaceUrlParam('price', $(this).val());
        let send_vendor = '';
        for (var i = 0; i < arr.length; i++) {
            send_vendor += arr[i];
            if (i < arr.length - 1) {
                send_vendor += ',';
            }
        }
        $("#price").val($(this).val())
        history.pushState(null, null, newurl);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: $("#url_admin").val(),
            data: {
                action: "filter",
                price: $(this).val(),
                cat_id: $("#cate_id").val(),
                vendor: send_vendor,
            }, success: function (data) {
                console.log(data);
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
                $(".fixed-loading").addClass('d-none')
                $('body').css({'overflow': 'auto'})
                $(".collection-one").children().remove();
                if (data.data.trim() != '') {
                    $(".collection-one").append(data.data);
                } else {
                    $(".collection-one").append('<h3>Not found product</h3>');
                }


            }, error: function (err) {
                console.log(err);
            }
        });
    })

    $(".no-bullets input[type=checkbox]").change(function (e) {
        $(".fixed-loading").removeClass('d-none')
        $('body').css({'overflow': 'hidden'})
        if (e.target.checked) {
            arr.push($(this).val().trim())
        } else {
            var vt = arr.indexOf($(this).val());
            arr.splice(vt, 1);
        }
        var newurl = replaceUrlParam('vendor', arr);
        history.pushState(null, null, newurl);
        let send_vendor = '';
        for (var i = 0; i < arr.length; i++) {
            send_vendor += arr[i];
            if (i < arr.length - 1) {
                send_vendor += ',';
            }
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: $("#url_admin").val(),
            data: {
                action: "filter",
                price: $("#price").val(),
                cat_id: $("#cate_id").val(),
                vendor: send_vendor,
            }, success: function (data) {
                console.log(data);
                $('body').css({'overflow': 'auto'})
                $(".fixed-loading").addClass('d-none')
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
                $(".collection-one").children().remove();
                if (data.data.trim() != '') {
                    $(".collection-one").append(data.data);
                } else {
                    $(".collection-one").append('<h3>Not found product</h3>');
                }


            }, error: function (err) {
                console.log(err);
            }
        });
    });
    //    click pagination
    $(".collection-one").on('click', '.paginate_links a', function (e) {
        e.preventDefault();
        var hrefThis = $(this).attr('href');
        var paged = hrefThis.match(/\/\d+\//)[0];
        let send_vendor = '';
        for (var i = 0; i < arr.length; i++) {
            send_vendor += arr[i];
            if (i < arr.length - 1) {
                send_vendor += ',';
            }
        }
        paged = paged.match(/\d+/)[0];
        if (!paged) paged = 1;
        $.ajax({
            type: "post",
            dataType: "json",
            url: $("#url_admin").val(),
            data: {
                action: "ajax_load_post",
                cat_id: $("#cate_id").val(),
                ajax_paged: paged,
                price: $("#price").val(),
                vendor: send_vendor,
            },
            context: this,
            beforeSend: function () {
                $('.collection-one').addClass('active');
            },
            success: function (response) {
                console.log(response)
                if (response.success) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                    $(response.data).addClass('holder');
                    $(".collection-one").empty();
                    $(".collection-one").append($(response.data));
                }
                $('.collection-one').removeClass('active');
            }
        });
    });
</script>
    
