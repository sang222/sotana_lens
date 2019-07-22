<div class="sidebar-filter">
    <div class="panel-group wrap" id="bs-collapse">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#" href="#one">
                        Filter Price
                    </a>
                </h4>
            </div>
            <div id="one" class="panel-collapse">
                <div class="panel-body">
                    <ul class="no-bullets filter-price clearfix">
                        <?php $actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
                        <li class="text-left">
                            <label>
                                <input type="radio"
                                       onchange="<?php if (!isset($_GET['price'])): ?>window.history.replaceState(null, null, '<?php echo $actual_link ?>&price=50')<?php endif; ?>"
                                       name="price-filter" checked="<?php ?>" data-price="0:max" value="50">
                                <span>Tất cả</span>
                            </label>
                        </li>
                        <li class="text-left">
                            <label>
                                <input type="radio"
                                       onchange="<?php if (!isset($_GET['price'])): ?>window.history.replaceState(null, 'price', '<?php echo $actual_link ?>&price=5')<?php endif; ?>"
                                       name="price-filter" data-price="7000" value="5">
                                <span>Nhỏ hơn 50,000₫</span>
                            </label>
                        </li>
                        <li class="text-left">
                            <label>
                                <input type="radio"
                                       onchange="<?php if (!isset($_GET['price'])): ?>window.history.replaceState(null, 'price', '<?php echo $actual_link ?>&price=5')<?php endif; ?>"
                                       name="price-filter" data-price="7000" value="5">
                                <span>Từ 100,000₫ - 100,000₫</span>
                            </label>
                        </li>
                        <li class="text-left">
                            <label>
                                <input type="radio"
                                       onchange="<?php if (!isset($_GET['price'])): ?>window.history.replaceState(null, 'price', '<?php echo $actual_link ?>&price=5')<?php endif; ?>"
                                       name="price-filter" data-price="7000" value="5">
                                <span>Từ 100,000₫ - 300,000₫</span>
                            </label>
                        </li>
                        <li class="text-left">
                            <label>
                                <input type="radio"
                                       onchange="<?php if (!isset($_GET['price'])): ?>window.history.replaceState(null, 'price', '<?php echo $actual_link ?>&price=5')<?php endif; ?>"
                                       name="price-filter" data-price="7000" value="5">
                                <span>Từ 300,000₫ - 500,000₫</span>
                            </label>
                        </li>
                        <li class="text-left">
                            <label>
                                <input type="radio" name="price-filter" data-price="500000:700000"
                                       value="((price:product>=500000)&amp;&amp;(price:product<700000))">
                                <span>Từ 500,000₫ - 700,000₫</span>
                            </label>
                        </li>
                        <li class="text-left">
                            <label>
                                <input type="radio" name="price-filter" data-price="700000:max"
                                       value="((price:product>=700000))">
                                <span>Lớn hơn 700,000₫</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--    end filter price-->
    <!--  Start filter thương hiệu   -->
    <?php
    $term_id = get_term_by('slug', $_GET['cat_name'], 'product_cat')->term_id;
    $term_children = get_term_children($term_id, 'product_cat');
    if (sizeof($term_children) > 0):
        ?>
        <div class="panel-group wrap" id="to-collapse">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#" href="#one">
                            Filter Trademark
                        </a>
                    </h4>
                </div>
                <div id="one" class="panel-collapse">
                    <div class="panel-body">
                        <?php

                        foreach ($term_children as $cate_id): ?>
                            <?php $vendor_arr = explode(',', $_GET['vendor']) ?>
                            <ul class="no-bullets filter-price clearfix">
                                <?php $actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
                                <li class="text-left">
                                    <label>
                                        <input type="checkbox"
                                               name="price-filter" data-price="0:max"
                                            <?php if (in_array(get_term($cate_id)->slug, $vendor_arr)) {
                                                echo 'checked';
                                            } ?>
                                               value="<?php echo get_term($cate_id)->slug ?>">
                                        <span><?php echo get_the_category_by_ID($cate_id) ?></span>
                                    </label>
                                </li>
                            </ul>
                            <?php $dem++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!--  End filter thương hiệu   -->
</div>