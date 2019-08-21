<div class="sliderHome owl-carousel owl-theme">
    <?php
        global $tp_option;
        $arrs = $tp_option['top-slides'];
        $index = 0;
        $items = get_field('slide_main', 'option');
        foreach($items as $arr) :
            if(strlen($arr['youtube_link']) == 0) :
    ?>
        <div class="sliderHome-item item" style="background: url('<?php echo $arr['background']['url'] ?>') center center no-repeat; background-size: cover;">
            <h5><?php echo $arr['title'] ?></h5>
            <p><?php echo $arr['description'] ?></p>
        </div>
    <?php else: ?>
        <div class="sliderHome-item videoWrapper item-video" style="padding: 0">
            <a href="<?php echo $arr['youtube_link'] ?>" class="owl-video youtubeLink" data-index="<?php echo $index ?>"></a>
            <div class="sliderHome-content">
                <h5><?php echo $arr['title'] ?></h5>
                <p><?php echo $arr['description'] ?></p>
            </div>
        </div>
    <?php $index++;endif;endforeach;  ?>
</div>