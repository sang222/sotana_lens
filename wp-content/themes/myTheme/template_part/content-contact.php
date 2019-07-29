<div class="pro-title">
    <div class="fixed-width content-title">
        <span class="text-uppercase">Contact  FOR US</span>
    </div>
</div>
<div class="containter-fluid" style="margin: 30px 0px; padding:30px 15px">
    <div style="max-width: 1500px" class="m-auto">
        <div class="owl-carousel owl-theme " id="contact-carousel">
            <?php global $tp_option;
            $arr_contact_slides = $tp_option['home-slides'];
            foreach ($arr_contact_slides as $item_contact):

                ?>
                <div>
                    <a href="<?php echo $item_contact['url'] ?>"
                       title="<?php echo $item_contact['title'] ?>"
                       target="_blank"
                    >
                        <img src="<?php echo $item_contact['image'] ?>">
                    </a>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>