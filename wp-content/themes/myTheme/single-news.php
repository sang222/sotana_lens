<?php 
    get_header();
    global $post;
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
                        <a href="<?php echo get_site_url() ?>">Home</a>&nbsp;&#47;&nbsp;<a href="<?php echo get_permalink(206) ?>">Blog</a>&nbsp;&#47;&nbsp;<?php echo the_title() ?></nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 50px 0">
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
</div>
<?php get_footer() ?>