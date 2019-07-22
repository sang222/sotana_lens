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
<?php global $product; ?>
<div class="content-cart container">
    <div class="view-product">
        <div class="row">
            <div class="col-lg-1" style="padding: 0px 0px !important;">
                <div class="top-arrow text-center w-100" style="display: inline-block;"><i
                            class="fa fa-angle-up fa-2x"></i></div>
                <div class="slick-carousel">
                    <?php
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->post->ID), 'single-post-thumbnail');
                    $attachment_ids = $product->get_gallery_attachment_ids();
                    $active = 'active';
                    ?>
                    <div><img src="<?php echo $image[0] ?>" class="img-responsive active"></div>
                    <?php
                    foreach ($attachment_ids as $attachment_id):

                        $image_link = wp_get_attachment_url($attachment_id);
                        ?>
                        <div><img src="<?php echo $image_link ?>" class="img-responsive"></div>

                    <?php endforeach; ?>
                </div>
                <div class="bottom-arrow text-center w-100" style="display: inline-block;"><i
                            class="fa-2x fa fa-angle-down"></i></div>

            </div>
            <div class="col-lg-7">
                <img id="zoom" style="max-height: 505px"
                     src="<?php echo $image[0] ?>"
                     data-zoom-image="<?php echo $image[0] ?>"/>

            </div>
            <div class="col-lg-4">
                <h2><?php the_title() ?></h2>
                <!--                --><?php //var_dump($product) ?>
                <div>
                    <span class="current-price"><?php if ($product->get_regular_price()) echo number_format($product->get_regular_price(), 0, ',', '.') . 'đ'; ?></span>
                    <span class="sale-price"
                          style="text-decoration: line-through"><?php if ($product->get_sale_price()) echo number_format($product->get_sale_price(), 0, ',', '.') . 'đ'; ?></span>
                </div>
                <div class="acttion-carts">
                    <form method="post" class="cart">
                        <input type="text" pattern="[0-9]*" class="input-text qty" id="qty" min="1" title="SL" max="100"
                               max inputmode="numeric" value="<?php if (isset($_POST['quantity'])) {
                            echo $_POST['quantity'];
                        } else {
                            echo '1';
                        } ?>" maxlength="3" name="quantity"
                               onkeyup="valid(this,&#39;numbers&#39;)" onblur="valid(this,&#39;numbers&#39;)">
                        <button onclick="var result = document.getElementById(&#39;qty&#39;); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                                class="increase items-count2" type="button"><i class="fa fa-plus"></i></button>
                        <button onclick="var result = document.getElementById(&#39;qty&#39;); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;"
                                class="reduced items-count2" type="button"><i class="fa fa-minus"></i></button>
                        <br/>
                        <button type="submit" name="add-to-cart" value="<?php echo get_the_id(); ?>"
                                style="margin-top: 10px" class="single_add_to_cart_button btn btn-warning">
                            <i class="fa fa-cart"></i>
                            Add to cart
                        </button>

                    </form>
                </div>
                <p><?php
                    $stock = $product->get_stock_status();
                    $stock = str_replace(array('instock', 'outofstock'), array('Còn hàng', 'Hết hàng'), $stock);
                    ?>
                <p/>
            </div>
        </div>
    </div>
</div>
