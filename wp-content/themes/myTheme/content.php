<section class="product-best-sales" style=" min-height: 300px; ">
    <!--Slider-->
    <?php get_template_part('template_part/content', 'slider'); ?>
    <!-- Best sale-->

    <?php get_template_part('template_part/product/product', 'bestsale'); ?>
    <!-- shop now-->
    <?php get_template_part('template_part/content', 'shopnow') ?>
    <!-- Content category   -->
    <?php get_template_part('template_part/content', 'category') ?>
    <!--Sản phẩm nổi bật-->
    <?php get_template_part('template_part/product', 'noibat') ?>

    <!-- More Blog   -->
    <?php get_template_part('template_part/content', 'blog') ?>
    <!-- cart Modal-->
    <?php get_template_part('template_part/content', 'cartmodal') ?>
</section>