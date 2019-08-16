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
//        $data1 = array(
//            abc => 'ddd'
//        );
//        wp_send_json($data1);
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
    <div class="container-mini-cart" id="icon-cart-mobile">
        <div style="position: relative">
            <div class="cart-icon"></div>
            <span class="hd-cart-count total-outer"
                  id="count-mini-cart "><?php echo $woocommerce->cart->cart_contents_count ?></span>
        </div>
        <div class="popup-view-cart d-none">
            <div class="popup-cart-title">
                <h5>Shopping cart</h5>
            </div>
            <ul class="popup-cart-content">
                <?php
                $items = $woocommerce->cart->get_cart();
                $totalitem = 0;
                $total_price = 0;
                $vt = 0;
                if (!empty($items)) :
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
                        <li class="item item-<?php echo $values['product_id'] ?>">
                            <a href="<?php echo $linkpro; ?>" class="product-id-<?php echo $_product->get_id() ?>">
                                <?php
                                if ($_product->product_type != 'variation') : ?>
                                    <?php echo $imgpro; ?>
                                <?php else: ?>
                                    <?php
                                    $variation_id2 = $values['variation_id'];
                                    $variable_product2 = new WC_Product_Variation($variation_id2);
                                    ?>
                                    <img src="<?php echo wp_get_attachment_image_src($variable_product2->image_id)[0] ?>"/>
                                <?php endif; ?>
                            </a>
                            <div class="item-content">
                                <div class="item-content-sub">
                                    <a href="<?php echo $linkpro; ?>"><?php echo $titlepro ?></a>
                                    <p>
                                        <?php
                                        if ($_product->product_type != 'variation') :
                                            if ($getProductDetail->get_sale_price() > 0) {
                                                echo number_format(($getProductDetail->get_sale_price()), 0, ',', '.') . '<u>đ</u>';
                                            } else if ($getProductDetail->get_regular_price()) {
                                                echo number_format(($getProductDetail->get_regular_price()), 0, ',', '.') . '<u>đ</u>';
                                            }
                                            ?>
                                        <?php else:
                                            $variation_id = $values['variation_id'];
                                            $variable_product1 = new WC_Product_Variation($variation_id);
                                            $regular_price = $variable_product1->regular_price;
                                            $sales_price = $variable_product1->sale_price;
                                            if ($sales_price > 0) {
                                                echo number_format(($sales_price), 0, ',', '.') . '<u>đ</u>';
                                            } else {
                                                echo number_format(($regular_price), 0, ',', '.') . '<u>đ</u>';
                                            }
                                            ?>
                                        <?php endif; ?>
                                        x <?php echo $quantitypro; ?></p>
                                    <?php if ($_product->product_type == 'variation') :
                                        ?>
                                        <?php foreach ($values['variation'] as $key => $vari): ?>
                                        <?php if ($key == 'attribute_pa_color' && !empty($vari)): ?>
                                            <p style="margin-bottom: 0">Color:
                                                <?php echo $vari ?>
                                            </p>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <?php if ($_product->product_type != 'variation') : ?>
                                    <span
                                            class=" remove-product float-right"
                                            data-product_id="<?php echo $values['product_id'] ?>"
                                            data-product_sku="<?php echo $getProductDetail->get_sku() ?>">Xóa
                                            </span>
                                <?php else: ?>
                                    <span
                                            class=" remove-product-variable float-right"
                                            data-key_items="<?php echo $item ?>"
                                            data-product_id="<?php echo $values['product_id'] ?>"
                                            data-product_sku="<?php echo $getProductDetail->get_sku() ?>">Xóa
                                            </span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php $vt++; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <div class="popup-cart-footer">
                <?php $amount2 = floatval(preg_replace('#[^\d.]#', '', $woocommerce->cart->get_cart_total())); ?>
                <p data-total="<?php echo $amount2 ?>">Tổng
                    cộng: <?php echo number_format($amount2, 0, ',', '.') . 'đ'; ?></p>
                <div class="group-btn">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-default">View cart</a>
                    <a href="<?php echo wc_get_checkout_url() ?>" class="btn btn-default">Checkout</a>
                </div>
            </div>
            <?php else : ?>
                <p>Hiện không có sản phẩm nào</p>
            <?php endif; ?>
        </div>
    </div>
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
    $amount2 = floatval(preg_replace('#[^\d.]#', '', $woocommerce->cart->get_cart_total()));

    ?>
    <div class="modal-content modal-cart-content">
        <div class="modal-header">
            <button type="button" class="close close-custom" data-dismiss="modal"></button>
            <h4 class="modal-title "><i class="fa fa-cart-plus"></i> My cart</h4>
        </div>
        <div class="modal-body frm-cart " id="cart-roll">
            <div class="  ">
                <!--                    <form class="woocommerce-cart-form frm-cart" action="-->
                <?php //echo esc_url(wc_get_cart_url())
                ?><!--" method="post">-->
                <?php if ($amount2 > 0): ?>
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
                            $price = get_post_meta($values['product_id'], '_price', true);
                            ?>
                            <tr>
                                <td class="text-center modal-cart-image" style="vertical-align: middle;">
                                    <?php
                                    if ($_product->product_type != 'variation') : ?>
                                        <?php echo $getProductDetail->get_image('thumbnail'); ?>
                                    <?php else: ?>
                                        <?php
                                        $variation_id2 = $values['variation_id'];

                                        $variable_product2 = new WC_Product_Variation($variation_id2);

                                        ?>
                                        <img src="<?php echo wp_get_attachment_image_src($variable_product2->image_id)[0] ?>"/>
                                    <?php endif; ?>
                                </td>
                                <td style="vertical-align: middle;">
                                    <h4 class="title-product-modal"><?php echo $_product->get_title(); ?></h4>
                                    <?php if ($_product->product_type == 'variation') :
                                        ?>
                                        <?php foreach ($values['variation'] as $key => $vari): ?>
                                        <?php if ($key == 'attribute_pa_color' && !empty($vari)): ?>
                                            <p style="margin-bottom: 0">Color:
                                                <?php echo $vari ?>
                                            </p>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <p>
                                        Categories:
                                        <?php echo push_to_cat(get_the_terms($values['product_id'], 'product_cat'))
                                        ?></p>
                                </td>
                                <td class="text-center"
                                    style="vertical-align: middle;">
                                    <?php
                                    if ($_product->product_type != 'variation') :
                                        if ($getProductDetail->get_sale_price() > 0) {
                                            echo number_format($getProductDetail->get_sale_price(), 0, ',', '.') . 'đ';
                                        } else {
                                            echo number_format($getProductDetail->get_regular_price(), 0, ',', '.') . 'đ';
                                        }
                                        ?>
                                    <?php else: ?>
                                        <?php
                                        $variation_id = $values['variation_id'];
                                        $variable_product1 = new WC_Product_Variation($variation_id);
                                        $regular_price = $variable_product1->regular_price;
                                        $sales_price = $variable_product1->sale_price;
                                        if ($sales_price > 0) {
                                            echo number_format(($sales_price), 0, ',', '.') . '<u>đ</u>';
                                        } else {
                                            echo number_format(($regular_price), 0, ',', '.') . '<u>đ</u>';
                                        }
                                        ?>
                                    <?php endif; ?>
                                </td>

                                <td class="qty-modal text-center" style="vertical-align: middle;">
                                    <div class="js-qty">
                                        <button onclick="var result = document.getElementById('qty_<?php echo $values['product_id']; ?>_<?php echo $vt ?>');
                                                var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;"
                                                class="action-count reduced items-count2 <?php if ($values['quantity'] == '1') echo 'none-click' ?>"
                                                type="button"
                                                data-id="<?php echo $values['product_id'] ?>"
                                                data-price="<?php
                                                if ($getProductDetail->get_sale_price() > 0) {
                                                    echo $getProductDetail->get_sale_price();
                                                } else {
                                                    echo $getProductDetail->get_regular_price();
                                                }
                                                ?>" data-product_id="<?php echo $values['product_id'] ?>"
                                        ><i class="fa fa-minus"></i>
                                        </button>
                                        <input type="text" pattern="[0-9]*"
                                               class="input-text qty text-center"
                                               id="qty_<?php echo $values['product_id'] ?>_<?php echo $vt ?>" min="1"
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
                                        <button onclick="var result = document.getElementById('qty_<?php echo $values['product_id']; ?>_<?php echo $vt ?>'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                                                class=" action-count increase items-count2 "
                                                data-id="<?php echo $values['product_id'] ?>"
                                                type="button"
                                                data-price="<?php
                                                if ($getProductDetail->get_sale_price() > 0) {
                                                    echo $getProductDetail->get_sale_price();
                                                } else {
                                                    echo $getProductDetail->get_regular_price();
                                                }
                                                ?>"
                                        ><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td colspan="2" class="" style="vertical-align: middle;">
                                    <?php if ($_product->product_type != 'variation') : ?>
                                        <span class="total-price-<?php echo $values['product_id'] ?>">
                                            <?php if ($getProductDetail->get_sale_price() > 0) {
                                                echo number_format(($getProductDetail->get_sale_price() * $values['quantity']), 0, ',', '.') . 'đ';
                                            } else {
                                                echo number_format(($getProductDetail->get_regular_price() * $values['quantity']), 0, ',', '.') . 'đ';
                                            }
                                            ?>
                                        </span>
                                    <?php else: ?>
                                        <?php
                                        $variation_id = $values['variation_id'];
                                        $variable_product1 = new WC_Product_Variation($variation_id);
                                        $regular_price = $variable_product1->regular_price;
                                        $sales_price = $variable_product1->sale_price;
                                        if ($sales_price > 0) {
                                            echo number_format(($sales_price * $values['quantity']), 0, ',', '.') . '<u>đ</u>';
                                        } else {
                                            echo number_format(($regular_price * $values['quantity']), 0, ',', '.') . '<u>đ</u>';
                                        }
                                        ?>
                                    <?php endif; ?>
                                    <?php if ($_product->product_type != 'variation') : ?>
                                        <span
                                                class=" remove-product float-right"
                                                data-product_id="<?php echo $values['product_id'] ?>"
                                                data-product_sku="<?php echo $getProductDetail->get_sku() ?>"><i
                                                    class="fa fa-trash"></i>
                                            </span>
                                    <?php else: ?>
                                        <span
                                                class=" remove-product-variable float-right"
                                                data-key_items="<?php echo $item ?>"
                                                data-product_id="<?php echo $values['product_id'] ?>"
                                                data-product_sku="<?php echo $getProductDetail->get_sku() ?>"><i
                                                    class="fa fa-trash"></i>
                                            </span>
                                    <?php endif; ?>
                                </td>
                                </td>
                            </tr>
                            <?php
                            $vt++;
                        endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div id="modal-empty-cart">
                        <p class="text-center">Cart empty</p>
                        <p class="text-center">
                            <img width="100" class="img-fluid m-auto"
                                 src="<?php echo esc_url(get_template_directory_uri()) ?>/images/myimage/cart/cart-empty.png"/>
                        <div class="prefix"></div>
                        <a class="text-center d-block " style="margin-top: 10px"
                           href="<?php get_category_link(66); ?> "><span
                                    class="return-shop">Return shop</span></a>
                        <br/>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            <div id="modal-empty-cart" class="d-none">
                <p class="text-center">Cart empty</p>
                <p class="text-center">
                    <img width="100" class="img-fluid m-auto"
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
                    <?php $amount2 = floatval(preg_replace('#[^\d.]#', '', $woocommerce->cart->get_cart_total())); ?>
                    <span>Order Total</span>
                    <span class="total-price"><?php echo number_format($amount2, 0, ',', '.') . 'đ'; ?></span>
                </div>
                <br/>
                </button>
                <a href="<?php wc_get_checkout_url() ?>" class=" btn-modal-cart btn  btn-xs">Checkout</a>
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
    $product = new WC_product($id);
    $handle = new WC_Product_Variable($id);
    $attachment_ids = $product->get_gallery_image_ids($id);
    $arr_attachment = array();
    $available_variations = new WC_Product_Variable($id);
//    print_r($available_variations);
    foreach ($attachment_ids as $attachment_id) {
        // Display the image URL
        $Original_image_url = wp_get_attachment_url($attachment_id);
        array_push($arr_attachment, $Original_image_url);
        // Display Image instead of URL


    }
    $html_price = null;

    //create price
    if ($handle->product_type != 'variable') {
        $sale_price = $handle->sale_price;
    } else {
        $regular_price = $handle->price;
    }
    if ($handle->product_type == 'variable') {
        $available_variations = $handle->get_available_variations();
        $attributes = $handle->get_attributes();
        $stock = $product->get_stock_status();
        $variation_id_first = '';
        $first_instock = null;
        $vt = 0;
        ob_start();
        foreach ($available_variations as $key => $variations) {
            $variation_id = $available_variations[$key]['variation_id'];
            $variable_product1 = new WC_Product_Variation($variation_id);
            ?>

            <?php if ($variable_product1->stock_status == 'instock'):
                ?>
                <div class="<?php if ($vt == 0) echo 'active' ?> item-variable  d-inline-block">
                    <div class="d-inline-block box-variable-quick border "
                         data-variation_id="<?php echo $variation_id ?>"
                         data-display_price="<?php echo $variations['display_price'] ?>"
                         data-attribute_pa_color="<?php echo $variations['attributes']['attribute_pa_color'] ?>"
                         data-display_regular_price="<?php echo $variations['display_regular_price'] ?>"
                         style="padding: 5px">
                        <span><?php echo $variations['attributes']['attribute_pa_color'] ?></span>
                        <img width="30" height="30" src="<?php echo $variations['image']['src'] ?>"/>
                    </div>
                </div>
                <?php
                $vt++;
            else:
                ?>
                <div class=" item-variable  d-inline-block">
                    <div class="d-inline-block box-variable-quick out-variable-pr border"
                         data-variation_id="<?php echo $variation_id ?>"
                         data-display_price="<?php echo $variations['display_price'] ?>"
                         data-attribute_pa_color="<?php echo $variations['attributes']['attribute_pa_color'] ?>"
                         data-display_regular_price="<?php echo $variations['display_regular_price'] ?>"
                         style="padding: 4px"
                    >
                        <span><?php echo $variations['attributes']['attribute_pa_color'] ?></span>
                        <img width="30" height="30"
                             src="<?php echo $variations['image']['src'] ?>"/>
                    </div>
                </div>
            <?php
            endif; ?>
            </div>
            <?php

        }
        $html_variable = ob_get_clean();
    }


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
        'arr_attachment' => $arr_attachment,
        'stock' => $stock,
        'html_variable' => $html_variable . ''
    );
    wp_send_json_success($data);
    die();//bắt buộc phải có khi kết thúc
}

//remove product simple
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
    wp_send_json_success(WC_AJAX::get_refreshed_fragments());
    //echo json_encode(array('status' => 0));
    die();
}

//end remove product simple
// Remove product variable
function product_remove_variable()
{
    global $wpdb, $woocommerce;
    $cart = $woocommerce->cart;
    $key_items = $_POST['key_items'];

    foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
//        if ($cart_item['product_id'] == $_POST['product_id']) {
//            // Remove product in the cart using  cart_item_key.
//            $cart->remove_cart_item($cart_item_key);
//        }
        if ($cart_item_key == $key_items) {
            //remove single product
            $woocommerce->cart->remove_cart_item($key_items);
        }
    }
    wp_send_json_success(WC_AJAX::get_refreshed_fragments());
    //echo json_encode(array('status' => 0));
    die();
}

add_action('wp_ajax_product_remove_variable', 'product_remove_variable');
add_action('wp_ajax_nopriv_product_remove_variable', 'product_remove_variable');

// Remove product variable
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
        <?php if ($dem == 1): ?>
            <div class="grid--product">
        <?php endif; ?>
        <div class="">
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
        <?php if ($dem == $max_post_count): ?>
            </div>
        <?php endif; ?>
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
//filter product by category
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
        $max_post_count = $query->post_count;
        ?>
        <?php if ($dem == 1): ?>
            <div class="grid--product <?php echo $dem; ?>">
        <?php endif; ?>
        <div class="">
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
        <?php if ($dem == $max_post_count): ?>
            </div>
        <?php endif; ?>
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
//    echo do_shortcode('[woocommerce_cart]');
    WC_AJAX::get_refreshed_fragments();
    die();

}

add_action('wp_ajax_qty_cart', 'ajax_qty_cart');
add_action('wp_ajax_nopriv_qty_cart', 'ajax_qty_cart');
//add product
add_action('wp_ajax_add_product', 'add_product_cart');
add_action('wp_ajax_nopriv_add_product', 'add_product_cart');
function add_product_cart()
{

    ob_start();

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : '';
    $variations = !empty($_POST['variation']) ? (array)$_POST['variation'] : '';
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations, null);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations)) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if (get_option('woocommerce_cart_redirect_after_add') == 'yes') {
            wc_add_to_cart_message($product_id);
        }

        // Return fragments
        WC_AJAX::get_refreshed_fragments();

    } else {

        // If there was an error adding to the cart, redirect to the product page to show any errors
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );

        wp_send_json($data);

    }

    die();
}

//end product
// TÙy bient product
// Change currency symbols
add_filter('woocommerce_currencies', 'add_my_currency');

function add_my_currency($currencies)
{
    $currencies['đ'] = __('Vietnam Dong', 'woocommerce');
    return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'VND':
            $currency_symbol = ' đ';
            break;
    }
    return $currency_symbol;
}
//get variable