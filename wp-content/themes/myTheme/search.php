<?php 
    get_header();
    // Template Name: Search
    global $post;
?>
<div class=" breadcrumb-colect-blog prefix">
    <div class="content-breadcrum">
    </div>
</div>
<div class="container">
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="fixed-width">
                <div class="pro-title-breadcrumb text-center">
                    <h4><?php echo __('Search', 'localFile') ?></h4>
                </div>
                <div class="text-center">
                    <nav class="woocommerce-breadcrumb">
                        <a href="<?php echo get_site_url() ?>"><?php echo __('Home', 'localFile') ?></a>&nbsp;&#47;&nbsp;<?php echo __('Search', 'localFile') ?></nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="display: table; margin: 10px auto; float: none;">
            <div class="search-form-wrapper">
                <form method="get" style="margin: 0" action="<?php get_site_url() ?>">
                    <input type="text"
                            onfocus="if(this.value =='Enter your search') { this.value = ''; }"
                            onblur="if(this.value == '') { this.value ='Enter your search'; }"
                            value="Enter your search" id="searchinput" name="s"
                            class="">
                    <label></label>
                </form>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 50px 0">
        <div class="col-md-8 row-product fixed-width" id="collection-container" style="padding: 0">
            <div class="row collection">
                <?php
                    global $product;
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 10;
                    $s = get_search_query();
                    $args = array(
                        'post_type'	 => 'product',
                        'posts_per_page' => $paged,
                        'post_status' => 'publish',
                        's' => $s
                    );
                    $query = new WP_Query( $args );
                    if(count($query->posts) > 0) :
                    if( $query -> have_posts()) : while ($query -> have_posts()) : $query->the_post();
                    $feature_image_id = get_post_thumbnail_id(get_the_ID());
                    $feature_image_meta = wp_get_attachment_image_src($feature_image_id, 'full');
                ?>
                    <div class="col-md-4 col-xs-12">
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
                <?php endwhile;endif; wp_reset_postdata(); ?> 
                <div class="clearfix"></div>
                <!-- Pagination -->
                <?php if(count($query->posts) >= $paged) : ?>
                <div class="paging pagenavi pagination">
                                <div class="paging-normal">
                    <?php 
                    if (function_exists('wp_pagenavi')) {
                        wp_pagenavi(array('query' => $query));
                    }
                    wp_reset_query();
                    ?>
                </div>
                </div>
                <?php endif; ?>
                <!-- End Pagination -->
                
                <?php else : ?>
                    <div class="col-md-12">
                       <p><?php echo __('Không tìm thấy sản phẩm nào', 'localFile') ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4 sidebar-blog fixed-top">
            <?php get_sidebar() ?>
        </div>
    </div>
</div>
<?php
get_template_part('template_part/content', 'quickview');
get_footer('shop');
?>