<?php $baseURL = esc_url(get_template_directory_uri()); ?>
<?php
global $tp_option;
$arr_customer_slides = $tp_option['home-customer'];
$title_customer = $tp_option['customer-title'];
?>
<?php if (sizeof($arr_customer_slides) > 0 && $title_customer != null): ?>
    <div class="pro-title wow fadeInDown">
        <div class="fixed-width content-title">
            <span class="text-uppercase"><?php echo $title_customer ?></span>
        </div>
    </div>
<?php endif; ?>
<div class="fixed-width wow fadeInDown" style="margin-top:35px;padding: 15px">
    <div class="owl-carousel owl-theme " id="customer-carousel">
        <?php
        foreach ($arr_customer_slides as $item_customer):
            ?>
            <article class="c-card">
                <header class="c-card__header">
                    <img style="object-fit: contain" width="320" height="200"
                         src="<?php echo get_theme_file_uri() ?>/images/myimage/lazyload.jpg"
                         data-src="<?php echo $item_customer['image'] ?>"
                         class="c-card__image lazyload " alt="Card Image"/>
                </header>
                <div class="c-card__body">
                    <h2 class="c-card__title">
                        <?php echo $item_customer['title'] ?>
                    </h2>
                    <p class="c-card__subtitle">
                        <?php echo $item_customer['url'] ?>
                    </p>

                    <p class="c-card__intro">
                        <?php echo $item_customer['description'] ?>
                    </p>

                </div>
            </article>
        <?php endforeach; ?>


    </div>
</div>
