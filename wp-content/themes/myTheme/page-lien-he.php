<?php
    get_header();
    // Template Name: Contact
?>
<div class="breadcrumb-colect prefix" style="margin-bottom: 20px">
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
<div class="container">
    <div class="row" style="margin: 20px 0">
        <div class="col-md-4 col-infomation">
            <div class="box box-addr">
                <p><?php echo __('Địa chỉ công ty', 'localFile') ?></p>
                <span><?php echo get_field('thong_tin', 'option')['addr'] ?></span>
            </div>
            <div class="box box-phone">
                <p><?php echo __('Điện thoại', 'localFile') ?></p>
                <a href="tel: <?php echo get_field('thong_tin', 'option')['phone'] ?>"><?php echo get_field('thong_tin', 'option')['phone'] ?></a>
            </div>
            <div class="box box-email">
                <p><?php echo __('Email', 'localFile') ?></p>
                <a href="mailto: <?php echo get_field('thong_tin', 'option')['email'] ?>"><?php echo get_field('thong_tin', 'option')['email'] ?></a>
            </div>
        </div>
        <div class="col-md-4">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4661.798627950085!2d106.70450610536882!3d10.727560487621984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f93c156889b%3A0xd270685b86f6df00!2zUjQsIDY0IE7hu5lpIEtodSBN4bu5IFRvw6BuIDIsIFTDom4gUGhvbmcsIFF14bqtbiA3LCBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1564678141607!5m2!1sen!2s"
                width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-md-4 colum-form">
            <h4><?php echo __('Liên hệ với chúng tôi', 'localFile') ?></h4>
            <?php echo do_shortcode('[contact-form-7 id="243" title="Contact form"]') ?>
        </div>
    </div>
</div>
<?php get_footer() ?>