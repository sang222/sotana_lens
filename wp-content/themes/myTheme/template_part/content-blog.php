<?php $baseURL = esc_url(get_template_directory_uri()); ?>
<div class="pro-title wow fadeInDown">
    <div class="fixed-width content-title">
        <span>BLOG US</span>
    </div>

</div>
<section class="blog-posts wow fadeInDown" style="padding: 0 15px">
    <div class="d-flex flex-wrap fixed-width owl-carousel owl-theme" id="carousel-blog">
        <?php
            $args = array(
                'post_type'	 => 'news',
                'post_status'	 => 'publish',
                'posts_per_page' => -1
            );
            $query = new WP_Query( $args );
            if( $query -> have_posts()) : while ($query -> have_posts()) : $query->the_post();
            $feature_image_id = get_post_thumbnail_id(get_the_ID());
            $feature_image_meta = wp_get_attachment_image_src($feature_image_id, 'full');
            $short_description = get_field('short_description')
        ?>
            <div class="content-post">
                <div class="img-post">
                    <a class="hover-animated" href="<?php echo get_the_permalink() ?>"><img src="<?php echo $feature_image_meta[0] ?>"></a>
                </div>
                <div class="detail-post">
                    <h4><a href="<?php echo get_the_permalink() ?>"><?php echo the_title() ?></a></h4>
                    <div class="date-post"><i class="fa fa-calendar"></i> 
                        <?php echo get_the_date('M') ?> <?php echo get_the_date('d') ?>, <?php echo get_the_date('Y') ?>
                    </div>
                    <div class="post-cmt" style="padding-top: 10px">
                        <p class="post-description">
                            <?php echo $short_description ?>
                        </p>
                    </div>
                    <div class="reading-next">
                        <a href="<?php echo get_the_permalink() ?>" style="color: #ed030e">Continue Reading <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        <?php endwhile;endif; wp_reset_postdata();?>
    </div>
</section>