<div class="sidebar-filter" style="margin-bottom: 30px">
    <div class="text-transform text-left font-weight-bold " style="margin-bottom: 20px">
        <div class="font-weight-600"><i class="fa fa-filter"></i> Bộ lọc tìm kiếm</div>
    </div>
    <hr/>
    <div class="filter-list" id="bs-collapse">
        <h5 class="text-left"><i class="fa fa-tags"></i> Filter by price</h5>
        <div style="margin-left: 20px">
            <ul class="no-bullets filter-price clearfix">
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test1"
                               onchange="<?php if (!isset($_GET['price'])): ?>//window.history.replaceState(null, null, '<?php echo $actual_link ?>//&price=0:500000000')<?php endif; ?>"
                               name="price-filter" checked="<?php ?>" data-price="0:500000000"
                               value="0:500000000">
                        <label for="test1">Tất cả</label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test2"
                               onchange="<?php if (!isset($_GET['price'])): ?>//window.history.replaceState(null, 'price', '<?php echo $actual_link ?>//&price=0:5')<?php endif; ?>"
                               name="price-filter" data-price="0:5" value="0:5">
                        <label for="test2">Nhỏ hơn 50,000₫</label>
                    </p>

                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test3"
                               onchange="<?php if (!isset($_GET['price'])): ?>//window.history.replaceState(null, 'price', '<?php echo $actual_link ?>//&price=0:5')<?php endif; ?>"
                               name="price-filter" data-price="7000" value="50000:100000">
                        <label for="test3">Từ 50,000₫ - 100,000₫</label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test4"
                               onchange="<?php if (!isset($_GET['price'])): ?>//window.history.replaceState(null, 'price', '<?php echo $actual_link ?>//&price=0:5')<?php endif; ?>"
                               name="price-filter" data-price="100000:300000" value="100000:300000">
                        <label for="test4">Từ 100,000₫ - 300,000₫</label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test5"
                               onchange="<?php if (!isset($_GET['price'])): ?>//window.history.replaceState(null, 'price', '<?php echo $actual_link ?>//&price=0:5')<?php endif; ?>"
                               name="price-filter" data-price="300000:500000" value="300000:500000">
                        <label for="test5">Từ 300,000₫ - 500,000₫</label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test6"
                               onchange="<?php if (!isset($_GET['price'])): ?>//window.history.replaceState(null, 'price', '<?php echo $actual_link ?>//&price=0:5')<?php endif; ?>"
                               name="price-filter" data-price="500000:700000" value="500000:700000">
                        <label for="test6">Từ 500,000₫ - 700,000₫</label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test7"
                               onchange="<?php if (!isset($_GET['price'])): ?>//window.history.replaceState(null, 'price', '<?php echo $actual_link ?>//&price=0:5')<?php endif; ?>"
                               name="price-filter" data-price="700000:500000000" value="700000:500000000">
                        <label for="test7">Lớn hơn 700,000₫</label>
                    </p>
                </li>
            </ul>
        </div>
        <hr/>
    </div>
    <!--    end filter price-->
    <!--  Start filter thương hiệu   -->
    <?php
    $term_id = get_term_by('slug', 'trademark', 'product_cat')->term_id;
    $term_children = get_term_children($term_id, 'product_cat');
    if (sizeof($term_children) > 0):
    ?>
    <div class="filter-list" id="bs-collapse">
        <h5 class="text-left"><i class="fa fa-tags"></i> Filter by trademark</h5>
        <div style="margin-left: 20px">
            <ul class="no-bullets filter-price clearfix">
                <?php
                $dem=1;
                foreach ($term_children as $cate_id): ?>

                    <?php $vendor_arr = explode(',', $_GET['vendor']) ?>
                    <?php $actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
                    <li class="text-left checkbox">
                        <span>
                            <input type="checkbox"
                                   id="check-<?php echo $dem ?>"
                                   name="trademark-filter" data-price="0:max"
                                <?php if (in_array(get_term($cate_id)->slug, $vendor_arr)) {
                                    echo 'checked';
                                } ?>
                                   value="<?php echo get_term($cate_id)->slug ?>">
                            <label for="check-<?php echo $dem ?>"><?php echo get_the_category_by_ID($cate_id) ?></label>
                        </span>

                    </li>
                    <?php $dem++; endforeach; ?>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
<!--  End filter thương hiệu   -->
</div>