<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();
global $post;
?>
    <div class="breadcrumb-colect prefix">
        <div class="fixed-width content-breadcrum">
            <div class="pro-title-breadcrumb text-center">
                <h2 style="color: #fff"><?php echo get_the_title() ?></h2>

            </div>
            <nav class="woocommerce-breadcrumb" style="text-align: center">
                                    <a href="<?php echo get_site_url() ?>"><?php echo __('Home', 'localFile') ?></a>&nbsp;&#47;&nbsp;<?php echo the_title() ?>
                                </nav>
            <br/>
            <br/>
        </div>
    </div>
    <div class="fixed-width wow fadeInDown" style="padding: 0 15px">

        <?php while (have_posts()) : the_post(); ?>
            <?php if ($post->post_parent > 0 || $post->ID !== 27 || $post->ID !== 26 || $post->ID > 100) { ?>
                <div class="row" style="margin: 50px 0">
                    <div class="col-md-8" style="padding: 0">
                        <div class="col-detail" style="padding-bottom: 30px">
                            <h4><?php echo the_title() ?></h4>
                            <div class="date-post"><i class="fa fa-calendar"></i>&nbsp;
                                <?php echo get_the_date('M') ?> <?php echo get_the_date('d') ?>
                                , <?php echo get_the_date('Y') ?>
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
            <?php } else { ?>
                <?php the_content(); ?>
            <?php } ?>
        <?php endwhile; ?>
    </div>

<?php get_footer(); ?>