<div class="sliderHome owl-carousel owl-theme">
    <?php
        global $tp_option;
        $arrs = $tp_option['top-slides'];
        foreach($arrs as $arr) :
            if(strlen($arr['url']) == 0) :
    ?>
        <div class="sliderHome-item item" style="background: url('<?php echo $arr['image'] ?>') center center no-repeat; background-size: cover;">
            <h5><?php echo $arr['title'] ?></h5>
            <p><?php echo $arr['description'] ?></p>
        </div>
    <?php else : ?>
        <div class="sliderHome-item videoWrapper item-video" style="padding: 0">
            <a href="<?php echo $arr['url'] ?>" class="owl-video youtubeLink"></a>
            <div class="sliderHome-content">
                <h5><?php echo $arr['title'] ?></h5>
                <p><?php echo $arr['description'] ?></p>
            </div>
        </div>
    <?php endif;endforeach; ?>
</div>