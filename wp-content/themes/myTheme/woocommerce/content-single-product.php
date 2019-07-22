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
            <div class="col-lg-4">
                <?php
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->post->ID), 'single-post-thumbnail');
                ?>
                <!-- get image product -->
                <div class="img-zoom-container">
                    <img id="myimage" src="<?php echo $image[0] ?>"/>
                    <div id="myresult" class="img-zoom-result"></div>
                </div>
                <ul style="width: 100%">
                    <?php
                    $attachment_ids = $product->get_gallery_attachment_ids();
                    $i = 0;
                    $active = 'active';
                    foreach ($attachment_ids as $attachment_id):
                        $i++;
                        $image_link = wp_get_attachment_url($attachment_id);
                        ?>
                        <li style="display: inline-block; margin:30px auto"><a href="#">
                                <img width="90" height="100" src="<?php echo $image_link ?>"></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-8">
                <h2><?php the_title() ?></h2>
                <!--                --><?php //var_dump($product) ?>
                <div>
                    <span class="current-price"><?php echo $product->get_regular_price(); ?></span>
                    <span class="sale-price"
                          style="text-decoration: line-through"><?php echo number_format($product->get_sale_price(), 0, ',', '.'); ?></span>
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
