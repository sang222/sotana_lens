<?php 
    $baseURL = esc_url(get_template_directory_uri());
    $field = get_field('banner', 'option');
    $link = $field['link']['url'];
?>
<section class="shop-now-container" style="background: url(<?php echo $field['background']['url'] ?>) center center no-repeat">
    <div class="shop-now d-flex justify-content-center m-auto" style="max-width: 1500px">
        <div class="w-100 m-auto shop-now-right text-center">
            <h1><span class="color-general"><?php echo $field['title'] ?><br/></span></h1>
            <p class="description-shopnow w-75 m-auto"><?php echo $field['description'] ?></p>
            <a class="text-white color-general weight-600"
               href="<?php echo $link ?>"
               title="">
                <div class="btn-shopnow text-uppercase"><?php echo __('Shop Now', 'localFile') ?></div>
            </a>
        </div>
    </div>
</section>
