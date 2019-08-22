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
        <div class="m-auto">
            <div class="owl-carousel owl-theme " id="contact-carousel">
                <?php foreach ($slideBanner['list_image'] as $item_contact): ?>
                    <div class="" style="position: relative; width: auto; height: 555px; background: url(<?php echo $item_contact['image']['url'] ?>) center center no-repeat; background-size: cover">
                        <a href="<?php echo $item_contact['link']['url'] ?>"
                           target="_blank"
                           style="position: absolute; left: 0; top: 0;width: 100%; height: 100%;"
                        >
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>