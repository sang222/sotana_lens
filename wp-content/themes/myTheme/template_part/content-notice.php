<div class="page">
    <div class="notification ">
        <div class="notification__content">
            <h2 class="notification__title text-center"><?php echo __('Add cart success', 'localFile') ?></h2>
            <p class="notification__message text-center">
                <?php echo __("There's a new move in your local theaters !", 'localFile') ?>
            </p>
            <div class="notification__footer text-center">
                <a href="<?php echo wc_get_cart_url(); ?>" class="notification__button -primary"><?php echo __("View cart", 'localFile') ?></a>
<!--                <a href="#" class="notification__button -secondary">Close</a>-->
            </div>
        </div>
    </div>
</div>