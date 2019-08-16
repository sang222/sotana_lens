<?php
get_header();
global $post;
?>
    <div class=" breadcrumb-colect-blog prefix">
        <div class="content-breadcrum">
            <div class="pro-title-breadcrumb text-center">
                <h4><?php echo the_title() ?></h4>
            </div>
            <div class="text-center">
                <nav class="woocommerce-breadcrumb">
                    <a href="<?php echo get_site_url() ?>">Home</a>&nbsp;&#47;&nbsp;<a
                            href="<?php echo get_permalink(206) ?>">Blog</a>&nbsp;&#47;&nbsp;<?php echo the_title() ?>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin: 30px 0">
            <div class="col-md-8 " style="padding: 0">
                <div class="col-detail">
                    <h4><?php echo the_title() ?></h4>
                    <div class="date-post"><i class="fa fa-calendar"></i>&nbsp;
                        <?php echo get_the_date('M') ?> <?php echo get_the_date('d') ?>, <?php echo get_the_date('Y') ?>
                    </div>
                    <div class="full-content">
                        <?php echo $post->post_content ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 sidebar-blog fixed-top">
                <?php get_sidebar() ?>
            </div>
        </div>
        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-12">
                <h4>Bài viết liên quan</h4>
                <div class="d-flex flex-wrap fixed-width owl-carousel owl-theme" id="carousel-blog">
                    <?php
                    $args = array(
                        'post_type' => 'news',
                        'post_status' => 'publish',
                        'orderby' => 'rand',
                        'posts_per_page' => 6,
                        'post__not_in' => array(get_the_ID()),
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                        $feature_image_id = get_post_thumbnail_id(get_the_ID());
                        $feature_image_meta = wp_get_attachment_image_src($feature_image_id, 'full');
                        $short_description = get_field('short_description')
                        ?>
                        <div class="content-post">
                            <div class="img-post">
                                <a class="hover-animated" href="<?php echo get_the_permalink() ?>"><img
                                            src="<?php echo $feature_image_meta[0] ?>"></a>
                            </div>
                            <div class="detail-post">
                                <h4><a href="<?php echo get_the_permalink() ?>"><?php echo the_title() ?></a></h4>
                                <div class="date-post"><i class="fa fa-calendar"></i>
                                    <?php echo get_the_date('M') ?> <?php echo get_the_date('d') ?>
                                    , <?php echo get_the_date('Y') ?>
                                </div>
                                <div class="post-cmt" style="padding-top: 10px">
                                    <p class="post-description">
                                        <?php echo $short_description ?>
                                    </p>
                                </div>
                                <div class="reading-next">
                                    <a href="<?php echo get_the_permalink() ?>" style="color: #ed030e">Continue Reading
                                        <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;endif;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>