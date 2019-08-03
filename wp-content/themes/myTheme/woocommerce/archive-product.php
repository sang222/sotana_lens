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
<?php $cate = get_queried_object(); ?>
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
<div class="row-product fixed-width " id="collection-container" style="margin: 0 auto;text-align: center">
    <div class="row">
        <input type="hidden" id="vendor" value="<?php echo $_GET['vendor'] ?>"/>
        <input type="hidden" id="price" value="<?php echo $_GET['price'] ?>"/>
        <?php
        global $post;
        $dem1 = 0;
        $cateID = $cate->term_id;
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => '4',
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
            )
        );
        $loop = new WP_Query($args);
        ?>
        <input type="hidden" id="cate_id" value="<?php echo $cateID ?>"/>
        <div class="collection float-left col-lg-9 ml-0 row colection-<?php echo $dem1 + 1 ?>  <?php if ($dem1 > 0) echo 'd-none' ?>">
            <?php
            $stt = 1;
            while ($loop->have_posts()) : $loop->the_post();
                global $product;
                $max_post_count = $loop->post_count;
                ?>
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
                $stt++;
            endwhile;
            wp_reset_query();
            ?>
            <div class="prefix"></div>
            <?php devvn_corenavi_ajax($loop); ?>
        </div>

        <div class="float-right col-lg-3 col-sm-3 col-xs-12">
            <?php get_template_part('template_part/content', 'sidebar') ?>
        </div>
    </div>
</div>

<?php
get_template_part('template_part/content', 'quickview');
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
                $(window).scrollTop(0);
                $(".collection").children().remove();
                if (data.data.trim() != '') {
                    $(".collection").append(data.data);
                } else {
                    $(".collection").append('<h3>Not found product</h3>');
                }


            }, error: function (err) {
                console.log(err);
            }
        });
    })

    $(".no-bullets input[type=checkbox]").change(function (e) {
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
                $(window).scrollTop(0);
                $(".collection").children().remove();
                if (data.data.trim() != '') {
                    $(".collection").append(data.data);
                } else {
                    $(".collection").append('<h3>Not found product</h3>');
                }


            }, error: function (err) {
                console.log(err);
            }
        });
    });
    //    click pagination
    $(".collection").on('click', '.paginate_links a', function (e) {
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
                $('.collection').addClass('active');
            },
            success: function (response) {
                console.log(response)
                if (response.success) {

                    $(response.data).addClass('holder');
                    $(".collection").empty();
                    $(".collection").append($(response.data));
                }
                $('.collection').removeClass('active');
            }
        });
    });
</script>

