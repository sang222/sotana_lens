<?php $baseURL = esc_url(get_template_directory_uri()); ?>
<section class="shop-now-container">
    <div class="shop-now d-flex justify-content-center m-auto" style="max-width: 1500px">

        <!--        <div class="image-shop w-50">-->
        <!--<!--            <img src="-->--><?php ////echo $baseURL ?><!--<!--/images/myimage/glasses.png">--> -->
        <!--        </div>-->
        <?php global $tp_option;

        $cate_id = $tp_option['banner-category'];
        $banner_description = $tp_option['banner-description'];
        $banner_title = $tp_option['banner-title'];
        ?>
        <div class="w-100 m-auto shop-now-right text-center">
            <h1><span class="pink"><?php echo $banner_title ?><br/></span></h1>
            <p class="description-shopnow w-75 m-auto"><?php echo $banner_description ?></p>
            <a class="text-white color-general weight-600"
               href="<?php echo get_category_link($cate_id) ?>"
               title="<?php echo get_the_category_by_ID($cate_id) ?>"
            >
                <div class="btn-shopnow text-uppercase">Shop Now</div>
            </a>
        </div>
    </div>
</section>
