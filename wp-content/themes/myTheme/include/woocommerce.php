<?php
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
//call ajax button cart
function woocommerce_ajax_add_to_cart()
{

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        $data1 = array(
            abc => 'ddd'
        );
        wp_send_json($data1);
        WC_AJAX:: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}

//mini c
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment', 30, 1);
function header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

    ?>
    <ul class="list-inline flip container-mini-cart pull-right">
        <li class="mb-0 pb-0">
            <?php global $woocommerce; ?>
            <div style="position: relative" class="show-on-mobile" id="icon-cart-mobile">
                <img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/hd_mainmenu_icon_cart.png"
                     alt="" style="margin-top: -11px;margin-right: 10px;">
                <span class="hd-cart-count total-outer"
                      id="count-mini-cart"><?php echo $woocommerce->cart->cart_contents_count ?></span>
            </div>
            <div class="top-dropdown-outer pt-5 pb-10">
                <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i
                            class="fa fa-shopping-cart font-13"></i>
                    <span class="total-outer"
                          id="count-mini-cart">(<?php echo $woocommerce->cart->cart_contents_count ?> Items) </span></a>
                <ul class="dropdown " id="mini-cart-container">
                    <li>
                        <!-- dropdown cart -->
                        <div class="dropdown-cart">
                            <div class="dropdown--content-tbl table-responsive">
                                <table class="table cart-table-list table-responsive">
                                    <tbody>
                                    <?php
                                    $items = $woocommerce->cart->get_cart();
                                    $totalitem = 0;
                                    $haveitems = 0;
                                    $total_price = 0;
                                    $vt = 0;
                                    foreach ($items as $item => $values):
                                        $_product = apply_filters('woocommerce_cart_item_product', $values['data'], $values, $item);
                                        if ($_product && $_product->exists() && $values['quantity'] > 0):
                                            $haveitems = 1;
                                            $_product = wc_get_product($values['data']->get_id());
                                            if ($_product->get_sale_price() > 0) {
                                                $total_price += $_product->get_sale_price() * $values['quantity'];
                                            } else {
                                                $total_price += $_product->get_regular_price() * $values['quantity'];
                                            }
                                            $linkpro = get_permalink($values['product_id']);
                                            $titlepro = $_product->get_title();
                                            $getProductDetail = wc_get_product($values['product_id']);
                                            $imgpro = $getProductDetail->get_image(array(80, 80));
                                            $pricepro = get_post_meta($values['product_id'], '_price', true);
                                            $quantitypro = $values['quantity'];
                                            $totalitem += $quantitypro;
                                            ?>
                                            <tr id="mini-item-<?php echo $vt ?>">
                                                <td><a href="<?php echo $linkpro; ?>"><img
                                                                alt="<?php echo $titlepro; ?>"
                                                        <?php echo $imgpro; ?></a>
                                                </td>
                                                <td><a href="<?php echo $linkpro; ?>"
                                                       class="truncate"> <?php echo $titlepro ?></a></td>
                                                <td>
                                                    X<span class="quantity-head-<?php echo $_product->get_id() ?>"><?php echo $quantitypro; ?></span>
                                                </td>
                                                <td><?php echo $pricepro; ?></td>
                                                <td><a class="close remove-product"
                                                       data-line="<?php echo $vt; ?>"
                                                       data-product_id="<?php echo $_product->get_id() ?>"
                                                       href="#"><i
                                                                class="fa fa-close font-13"></i></a>
                                                </td>
                                            </tr>
                                            <?php $vt++; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="total-cart text-right">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td> Item Total</td>
                                        <td><span data-amount="<?php echo $totalitem; ?>"
                                                  class="total-amount-dropdown"><?php echo $totalitem; ?></span> Items
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Order Total</td>
                                        <td><span class="total-price-dropdown"
                                                  data-total="<?php echo $total_price ?>"><?php echo $total_price ?></span>
                                            VND
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-btn text-right">
                                <a class="btn btn-theme-colored btn-xs"
                                   href="<?php echo wc_get_cart_url(); ?>"> View cart</a>
                                <a class="btn btn-dark btn-xs" href="<?php echo wc_get_checkout_url() ?>">
                                    Checkout</a>
                            </div>
                        </div>
                        <!-- dropdown cart ends -->
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-0 pb-0">
            <div class="top-dropdown-outer pt-5 pb-10">
                <a class="top-search-box has-dropdown text-white text-hover-theme-colored"><i
                            class="fa fa-search font-13"></i> &nbsp;</a>
                <ul class="dropdown">
                    <li>
                        <div class="search-form-wrapper">
                            <form action="<?php esc_url(home_url('/')) ?>" class="mt-10">
                                <input type="text"
                                       onfocus="if(this.value =='Enter your search') { this.value = ''; }"
                                       onblur="if(this.value == '') { this.value ='Enter your search'; }"
                                       value="Enter your search" id="searchinput" name="s"
                                       class="">
                                <label><input type="submit" name="submit" value=""></label>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <?php
    $fragments['.container-mini-cart'] = ob_get_clean();

    return $fragments;
}

//modal cart
add_filter('woocommerce_add_to_cart_fragments', 'modal_add_to_cart_fragment', 20, 1);
function modal_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    ?>
    <div class="modal-content modal-cart-content">
        <div class="modal-header">
            <button type="button" class="close close-custom" data-dismiss="modal">&times;</button>
            <h4 class="modal-title "><i class="fa fa-cart-plus"></i> My cart</h4>
        </div>
        <div class="modal-body frm-cart ">
            <div class="  table-responsive">
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
                        if ($getProductDetail->get_sale_price() > 0) {
                            $total_price += $getProductDetail->get_sale_price() * $values['quantity'];
                        } else {
                            $total_price += $getProductDetail->get_regular_price() * $values['quantity'];
                        }
                        $price = get_post_meta($values['product_id'], '_price', true);
                        ?>
                        <tr id="table-normal-<?php echo $vt; ?>">
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
                                            data-id="<?php echo $values['product_id'] ?>"
                                            type="button"
                                            data-price="<?php
                                            if ($getProductDetail->get_sale_price() > 0) {
                                                echo $getProductDetail->get_sale_price();
                                            } else {
                                                echo $getProductDetail->get_regular_price();
                                            }
                                            ?>"
                                            data-id="<?php echo $values['product_id'] ?>"
                                    ><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <input type="text" pattern="[0-9]*"
                                           class="input-text qty text-center"
                                           id="qty_<?php echo $values['product_id'] ?>" min="1"
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
                                    >
                                        <i class="fa fa-plus"></i>
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
                <a class="text-center d-block " style="margin-top: 10px" href=""><span
                            class="return-shop">Return shop</span></a>
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

                </button>
                <a href="<?php echo wc_get_checkout_url() ?>" class=" btn-modal-cart btn  btn-xs">Checkout</a>
            </div>
        </div>

    </div>
    <?php
    $fragments['.modal-cart-content'] = ob_get_clean();

    return $fragments;
}


// view product modal
add_action('wp_ajax_viewProduct', 'viewProduct_init');
add_action('wp_ajax_nopriv_viewProduct', 'viewProduct_init');
function viewProduct_init()
{
    //do bên js để dạng json nên giá trị trả về dùng phải encode
    $id = (isset($_POST['id'])) ? esc_attr($_POST['id']) : '';
    $attachment_ids = get_post_gallery_images($id);;
    $terms = get_the_terms($id, 'product_cat');
    $arr_link_category = array();
    $_product = array();
    foreach ($terms as $term) {
        $term_link = get_term_link($term);
        array_push($arr_link_category, array(link => $term_link, name => $term->name));
    }
    $_pf = new WC_Product_Factory();
    $feat_pro = new WP_Query(
        array(
            'post_type' => 'product',
            'posts_per_page' => 1,
            'post__in' => array($id),

        )
    );
    $data = array(
        'data' => $feat_pro->post,
        'price' => json_encode($_pf),
        'image' => get_the_post_thumbnail_url($id, 'large'),
        'category' => $arr_link_category,
        'attachment_ids' => $attachment_ids
    );
    wp_send_json_success($data);
    die();//bắt buộc phải có khi kết thúc
}

//remove product
add_action('wp_ajax_product_remove', 'product_remove');
add_action('wp_ajax_nopriv_product_remove', 'product_remove');
function product_remove()
{
    global $wpdb, $woocommerce;
    $cart = $woocommerce->cart;

    foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $_POST['product_id']) {
            // Remove product in the cart using  cart_item_key.
            $cart->remove_cart_item($cart_item_key);
        }
    }
    wp_send_json_success($woocommerce->cart->get_cart());
    //echo json_encode(array('status' => 0));
    die();
}

//end remove product
//pagination
function devvn_corenavi_ajax($custom_query = null, $paged = 1)
{
    global $wp_query, $wp_rewrite;
    if ($custom_query) $main_query = $custom_query;
    else $main_query = $wp_query;
    $big = 999999999;
    $total = isset($main_query->max_num_pages) ? $main_query->max_num_pages : '';
    if ($total > 1) echo '<div class="paginate_links">';
    echo paginate_links(array(
        'base' => trailingslashit(home_url()) . "{$wp_rewrite->pagination_base}/%#%/",
        'format' => '?paged=%#%',
        'current' => max(1, $paged),
        'total' => $total,
        'mid_size' => '5',
        'prev_text' => __('<<', 'devvn'),
        'next_text' => __('>>', 'devvn'),
    ));
    if ($total > 1) echo '</div>';
}

add_action('wp_ajax_ajax_load_post', 'ajax_load_post_func');
add_action('wp_ajax_nopriv_ajax_load_post', 'ajax_load_post_func');
function ajax_load_post_func()
{
    $price = (isset($_POST['price']) && !empty($_POST['price'])) ? esc_attr($_POST['price']) : '0:500000000';
    $price = explode(':', $price);
    $cate_id = (isset($_POST['cat_id'])) ? esc_attr($_POST['cat_id']) : '';
    $vendor = (isset($_POST['vendor'])) ? trim(esc_attr($_POST['vendor'])) : '';
    $vendor = explode(',', $vendor);
    $paged = isset($_POST['ajax_paged']) ? intval($_POST['ajax_paged']) : '';
    if ($paged <= 0 || !$paged || !is_numeric($paged)) wp_send_json_error('');
    if (sizeof($vendor) > 1) {
        $args = array(
            'post_type' => array('product', 'product_variation'),
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish',
            'paged' => $paged,
            'posts_per_page' => 4,
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
                    'terms' => $cate_id,
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
            'posts_per_page' => 4,
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
                    'terms' => $cate_id,
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
    $stt = 1;
    $dem = 0;
    ob_start();
    while ($loop->have_posts()) : $loop->the_post();
        global $product;
        $max_post_count = $loop->post_count;
        $dem++;
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
    <?php if ($dem > 0): ?>
    <div class="prefix"></div><?php endif; ?>
    <?php devvn_corenavi_ajax($loop, $paged); ?>
    <?php
    $content = ob_get_clean();
    wp_send_json_success($content);
    die();
}

//endpagination
//filter product
add_action('wp_ajax_filter', 'filter_product');
add_action('wp_ajax_nopriv_filter', 'filter_product');
function filter_product()
{
    $price = (isset($_POST['price']) && !empty($_POST['price'])) ? esc_attr($_POST['price']) : '0:500000000';
    $price = explode(':', $price);
    $cate_id = (isset($_POST['cat_id'])) ? esc_attr($_POST['cat_id']) : '';
    $vendor = (isset($_POST['vendor'])) ? trim(esc_attr($_POST['vendor'])) : '';
    $vendor = explode(',', $vendor);
//    $paged = isset($_POST['ajax_paged']) ? intval($_POST['ajax_paged']) : '';
//    if ($paged <= 0 || !$paged || !is_numeric($paged)) wp_send_json_error('');
    if (sizeof($vendor) > 1) {
        $params = array(
            'post_type' => array('product', 'product_variation'),
            'post_status' => 'publish',
            'posts_per_page' => 4,
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
                    'terms' => $cate_id,
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
        $params = array(
            'post_type' => array('product', 'product_variation'),
            'post_status' => 'publish',
            'posts_per_page' => 4,
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
                    'terms' => $cate_id,
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
    $query = new WP_Query($params);
    ob_start();
    $dem = 0;
    while ($query->have_posts()) : $query->the_post();
        global $product;
        $dem++;
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
    endwhile;
    wp_reset_query();
    ?>
    <?php if ($dem > 0): ?>
    <div class="prefix"></div><?php endif; ?>
    <?php
    devvn_corenavi_ajax($query, 1);
    wp_send_json_success(ob_get_clean());
    //echo json_encode(array('status' => 0));
    die();
}


//UPDATE CART


function ajax_qty_cart()
{

    // Set item key as the hash found in input.qty's name
    $cart_item_key = $_POST['hash'];

    // Get the array of values owned by the product we're updating
    $threeball_product_values = WC()->cart->get_cart_item($cart_item_key);

    // Get the quantity of the item in the cart
    $threeball_product_quantity = apply_filters('woocommerce_stock_amount_cart_item', apply_filters('woocommerce_stock_amount', preg_replace("/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT))), $cart_item_key);

    // Update cart validation
    $passed_validation = apply_filters('woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity);

    // Update the quantity of the item in the cart
    if ($passed_validation) {
        WC()->cart->set_quantity($cart_item_key, $threeball_product_quantity, true);
    }

    // Refresh the page
    echo do_shortcode('[woocommerce_cart]');

    die();

}

add_action('wp_ajax_qty_cart', 'ajax_qty_cart');
add_action('wp_ajax_nopriv_qty_cart', 'ajax_qty_cart');
// TÙy bient product
// Change currency symbols
add_filter('woocommerce_currencies', 'add_my_currency');

function add_my_currency($currencies)
{
    $currencies['VND'] = __('Vietnam Dong', 'woocommerce');
    return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'VND':
            $currency_symbol = ' VND';
            break;
    }
    return $currency_symbol;
}