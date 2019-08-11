<?php $baseURL = esc_url(get_template_directory_uri()); ?>
<?php
global $tp_option;
$arr_customer_slides = $tp_option['home-customer'];
?>
<?php if (sizeof($arr_customer_slides) > 0): ?>
    <div class="pro-title wow fadeInDown">
        <div class="fixed-width content-title">
            <span class="text-uppercase">CUSTOMER COMMENT FOR US</span>
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
                         src="<?php echo $item_customer['image'] ?>"
                         class="c-card__image" alt="Card Image"/>
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
