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

//    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
//
//        do_action('woocommerce_ajax_added_to_cart', $product_id);
//
//        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
//            wc_add_to_cart_message(array($product_id => $quantity), true);
//        }
//        $data1 = array(
//            abc => 'ddd'
//        );
//        wp_send_json($data1);
//        WC_AJAX:: get_refreshed_fragments();
//    } else {

    $data = array(
        'error' => true,
        'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

    echo wp_send_json($data);
//    }

    wp_die();
}

//mini c
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment', 30, 1);
function header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

    ?>
    <ul class="list-inline container-mini-cart pull-right">
        <li class="mb-0 pb-0">
            <?php global $woocommerce; ?>
            <div class="top-dropdown-outer pt-5 pb-10">
                <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i
                            class="fa fa-shopping-cart font-13"></i>
                    (<span id="count-mini-cart"><?php echo $woocommerce->cart->cart_contents_count ?></span> Items)
                </a></a>
                <ul class="dropdown" id="mini-cart-container">
                    <li>
                        <!-- dropdown cart -->
                        <div class="dropdown-cart">
                            <table class="table cart-table-list table-responsive">
                                <tbody>
                                <?php
                                $items = $woocommerce->cart->get_cart();
                                $totalitem = 0;
                                $vt = 0;
                                foreach ($items as $item => $values):
                                    $_product = apply_filters('woocommerce_cart_item_product', $values['data'], $values, $item);
                                    if ($_product && $_product->exists() && $values['quantity'] > 0):
                                        $haveitems = 1;
                                        $_product = wc_get_product($values['data']->get_id());
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
                                            <td><a href="#"> <?php echo $_product->get_title() ?></a></td>
                                            <td>X<?php echo $quantitypro; ?></td>
                                            <td><?php echo $pricepro; ?></td>
                                            <td><a
                                                        class="close remove-product"
                                                        data-product_id="<?php echo $_product->get_id() ?>"
                                                        href="#"><i class="fa fa-close font-13"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $vt++;
                                    endif; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="total-cart text-right">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td> Item Total</td>
                                        <td><?php echo $totalitem; ?> Items</td>
                                    </tr>
                                    <tr>
                                        <td>Order Total</td>
                                        <td><?php echo WC()->cart->get_cart_subtotal(); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-btn text-right">
                                <a class="btn btn-theme-colored btn-xs"
                                   href="<?php echo wc_get_cart_url(); ?>"> View cart</a>
                                <a class="btn btn-dark btn-xs" href="shop-checkout.html">
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
                            <form method="get" class="mt-10">
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
    <div class="modal-body frm-cart">
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
                    <td class="product-remove">
                        <span
                                class="remove-product"
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
    </div>
    <?php
    $fragments['.frm-cart'] = ob_get_clean();

    return $fragments;
}


// view product modal
add_action('wp_ajax_viewProduct', 'viewProduct_init');
add_action('wp_ajax_nopriv_viewProduct', 'viewProduct_init');
function viewProduct_init()
{
    //do bên js để dạng json nên giá trị trả về dùng phải encode
    $id = (isset($_POST['id'])) ? esc_attr($_POST['id']) : '';
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
            'post__in' => array($id)
        )
    );
    $data = array(
        data => $feat_pro->post,
        price => json_encode($_pf),
        image => get_the_post_thumbnail_url($id, 'large'),
        category => $arr_link_category
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
//filter product
add_action('wp_ajax_filter', 'filter_product');
add_action('wp_ajax_nopriv_filter', 'filter_product');
function filter_product()
{

    $price = (isset($_POST['price'])) ? esc_attr($_POST['price']) : '';
    $cate_name = (isset($_POST['cat_name'])) ? esc_attr($_POST['cat_name']) : '';
    $vendor = (isset($_POST['vendor'])) ? trim(esc_attr($_POST['vendor'])) : '';
    $vendor = explode(',', $vendor);
    if (sizeof($vendor) > 1) {
        $params = array(
            'posts_per_page' => 100,
            'post_type' => array('product', 'product_variation'),
            'product_cat' => $cate_name,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_price',
                    'value' => $price,
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

            ),
        );
    } else {
        $params = array(
            'posts_per_page' => 100,
            'post_type' => array('product', 'product_variation'),
            'product_cat' => $cate_name,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_price',
                    'value' => $price,
                    'compare' => '<=',
                    'type' => 'NUMERIC'
                ),
            ),
        );
    }
    $query = new WP_Query($params);
    ob_start();
    while ($query->have_posts()) : $query->the_post();
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
    <?php
//    ob_get_clean()
    wp_send_json_success(ob_get_clean());
    //echo json_encode(array('status' => 0));
    die();
}