<?php
    get_header();
    // Template Name: Contact
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
    <div class="row" style="margin: 20px 0">
        <div class="col-md-4 col-infomation">
            <div class="box box-addr">
                <p>Địa chỉ công ty</p>
                <span>R4-64 Mỹ Toàn 2, Phường Tân Phong, Quận 7, TP. HCM, Vietnam</span>
            </div>
            <div class="box box-phone">
                <p>Điện thoại</p>
                <a href="tel: 02854125427">(028) 5412.5427</a>
            </div>
            <div class="box box-email">
                <p>Email</p>
                <a href="mailto: gentleromeos@gmail.com">gentleromeos@gmail.com</a>
            </div>
        </div>
        <div class="col-md-4">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4661.798627950085!2d106.70450610536882!3d10.727560487621984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f93c156889b%3A0xd270685b86f6df00!2zUjQsIDY0IE7hu5lpIEtodSBN4bu5IFRvw6BuIDIsIFTDom4gUGhvbmcsIFF14bqtbiA3LCBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1564678141607!5m2!1sen!2s"
                width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-md-4 colum-form">
            <h4>Liên hệ với chúng tôi</h4>
            <?php echo do_shortcode('[contact-form-7 id="243" title="Contact form"]') ?>
        </div>
    </div>
</div>
<?php get_footer() ?>