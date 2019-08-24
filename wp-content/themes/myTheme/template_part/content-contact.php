<?php
$slideBanner = get_field('slide_banner', 'option');
?>
<?php if (sizeof($slideBanner) > 0 && $slideBanner != null): ?>
    <div class="pro-title wow fadeInDown">
        <div class="fixed-width content-title">
            <span class="text-uppercase"><?php echo $slideBanner['title'] ?></span>
        </div>
    </div>
    <div class="wow fadeInDown" style="padding: 0 15px">
        <div style="max-width: 1500px" class="m-auto">
            <div class="owl-carousel owl-theme " id="contact-carousel">
                <?php foreach ($slideBanner['list_image'] as $item_contact): ?>
                    <div class="itemBanner" style="background: url(<?php echo $item_contact['image']['url'] ?>) center center no-repeat; background-size: cover">
                        <a href="<?php echo $item_contact['link']['url'] ?>" target="_blank" class="itemBanner-link"></a>
                        <div class="hover-item">
                            <div class="hover-content">
                                <h3><?php echo $item_contact['title'] ?></h3>
                                <p><?php echo $item_contact['sub_title'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>