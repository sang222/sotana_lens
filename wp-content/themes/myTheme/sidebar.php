<?php 
    $baseURL = esc_url(get_template_directory_uri())
?>
<div class="pro-title-breadcrumb">
    <h4 style="margin: 0 0 20px">Bài viết mới nhất</h4>
    <?php
        $args = array(
            'post_type'	 => 'news',
            'post_status'	 => 'publish',
            'posts_per_page' => 5
        );
        $query = new WP_Query( $args );
        if( $query -> have_posts()) : while ($query -> have_posts()) : $query->the_post();
        $feature_image_id = get_post_thumbnail_id(get_the_ID());
        $feature_image_meta = wp_get_attachment_image_src($feature_image_id, 'full');
    ?>
        <article class="blog-posts clearfix">
            <a href="<?php echo get_the_permalink() ?>" style="display: table;margin-right: 15px;"><img src="<?php echo $feature_image_meta[0] ?>"></a>
            <div class="blog-content pull-left">
                <a class="title" href="<?php echo get_the_permalink() ?>"><?php echo the_title() ?></a>
                <div class="date-post"><i class="fa fa-calendar"></i> 
                    <?php echo get_the_date('M') ?> <?php echo get_the_date('d') ?>, <?php echo get_the_date('Y') ?>
                </div>
            </div>
        </article>
    <?php endwhile;endif; wp_reset_postdata();?>
</div>