<?php 
    get_header();
    $baseURL = esc_url(get_template_directory_uri())
?>
<div class="container">
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="fixed-width">
                <div class="pro-title-breadcrumb text-center">
                    <h4><?php echo the_title() ?></h4>
                </div>
                <div class="text-center">
                    <nav class="woocommerce-breadcrumb">
                        <a href="<?php echo get_site_url() ?>">Home</a>&nbsp;&#47;&nbsp;<?php echo the_title() ?></nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 50px 0">
        <div class="col-md-8" style="padding: 0">
            <div class="row">
                <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 10;
                    $args = array(
                        'post_type'	 => 'news',
                        'posts_per_page' => $paged,
                        'post_status' => 'publish'
                    );
                    $query = new WP_Query( $args );
                    if( $query -> have_posts()) : while ($query -> have_posts()) : $query->the_post();
                    $feature_image_id = get_post_thumbnail_id(get_the_ID());
                    $feature_image_meta = wp_get_attachment_image_src($feature_image_id, 'full');
                    $short_description = get_field('short_description')
                ?>
                <!-- Item -->
                <article class="blog-posts">
                    <div class="content-post clearfix">
                        <div class="img-post col-md-4">
                            <a href="<?php echo get_the_permalink() ?>" class="hover-animated"><img src="<?php echo $feature_image_meta[0] ?>"></a>
                        </div>
                        <div class="detail-post col-md-8">
                            <h4 style="margin-top: 0"><a href="<?php echo get_the_permalink() ?>"><?php echo the_title() ?></a></h4>
                            <div class="meta-post d-flex justify-content-between align-items-center">
                                <div class="date-post"><i class="fa fa-calendar"></i> 
                                    <?php echo get_the_date('M') ?> <?php echo get_the_date('d') ?>, <?php echo get_the_date('Y') ?>
                                </div>
                            </div>
                            <div class="post-cmt">
                                <p class="post-description">
                                    <?php echo $short_description ?>
                                </p>
                            </div>
                            <div class="reading-next">
                                <a href="<?php echo get_the_permalink() ?>" class="linkTo">Continue Reading <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </article>
                <!-- End Item -->
                <?php endwhile;endif; wp_reset_postdata();?>
            </div>
            <!-- Pagination -->
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
            <!-- End Pagination -->
        </div>
        <div class="col-md-4 sidebar-blog fixed-top">
            <?php get_sidebar() ?>
        </div>
    </div>
</div>
<?php get_footer() ?>