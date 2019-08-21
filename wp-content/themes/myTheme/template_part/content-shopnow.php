<?php $baseURL = esc_url(get_template_directory_uri()); ?>
<section class="shop-now-container">
    <div class="shop-now d-flex justify-content-center m-auto" style="max-width: 1500px">
        <?php 
            $field = get_field('banner', 'option');
            $link = $field['link']['url'];
        ?>
        <div class="w-100 m-auto shop-now-right text-center">
            <h1><span class="color-general"><?php echo get_field('banner', 'option')['title'] ?><br/></span></h1>
            <p class="description-shopnow w-75 m-auto"><?php echo get_field('banner', 'option')['description'] ?></p>
            <a class="text-white color-general weight-600"
               href="<?php echo $link ?>"
               title="">
                <div class="btn-shopnow text-uppercase"><?php echo __('Shop Now', 'localFile') ?></div>
            </a>
        </div>
    </div>
</section>
