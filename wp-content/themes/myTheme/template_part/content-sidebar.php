<div class="sidebar-filter" style="margin-bottom: 30px">
    <div class="text-transform text-left font-weight-bold "
         style="padding-bottom: 20px;border-bottom:1px solid #dfdfdf">
        <div class="font-weight-600 text-uppercase top-filter"><i
                    class="fa fa-filter"></i> <?php echo __('Filter Search', 'localFile') ?></div>
    </div>
    <?php
    $term = get_queried_object();
    $children = get_terms($term->taxonomy, array(
        'parent' => $term->term_id,
        'hide_empty' => false
    ));
    ?>
    <?php if (sizeof($children) > 0): ?>
        <div class="filter-list" id="bs-collapse">
            <h5 class="text-left text-uppercase"><i class="fa fa-bars"></i> <?php echo __('Category', 'localFile') ?>
                <span
                        class="float-right icon-right"><i class="fa fa-angle-right"></i></h5>
            <div style="margin-left: 20px">
                <ul class="no-bullets filter-price clearfix">
                    <?php foreach ($children as $child):
                        ?>
                        <li class="text-left text-uppercase" style="margin-left: 5px">
                            <i style="margin-right:15px;" class="weight-600"> - </i> <a
                                    href="<?php echo get_category_link($child->term_id) ?>"><?php echo $child->name; ?></a>
                        </li>
                        <?php
                        $children1 = get_terms($term->taxonomy, array(
                            'parent' => $child->term_id,
                            'hide_empty' => false
                        ));
                        if (sizeof($children1) > 0):
                            ?>
                            <ul>
                                <?php foreach ($children1 as $child1): ?>
                                    <li class="text-left text-uppercase" style="margin-left: 5px">
                                        <i style="margin-right:15px;" class="weight-600"> - </i> <a
                                                href="<?php echo get_category_link($child1->term_id) ?>"><?php echo $child1->name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <hr/>
    <?php endif; ?>

    <div class="filter-list" id="bs-collapse">
        <h5 class="text-left text-uppercase"><i class="fa fa-tags"></i> <?php echo __('Filter by price', 'localFile') ?>
            <span
                    class="float-right icon-right"><i class="fa fa-angle-right"></i></span></h5>
        <div style="margin-left: 20px" class="content-down">
            <ul class="no-bullets filter-price clearfix">
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test1"
                               name="price-filter"
                            <?php if (!isset($_GET['price']) && empty($_GET['price']) || $_GET['price'] == '0:500000000') echo 'checked'; ?>
                               data-price="0:500000000"
                               value="0:500000000">
                        <label for="test1"><?php echo __('Tất cả', 'localFile') ?></label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test2"
                               data-price="<?php echo $_GET['price'] ?>"
                            <?php if (isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == '0:50000') echo 'checked' ?>
                               name="price-filter" value="0:50000">
                        <label for="test2"><?php echo __('Nhỏ hơn 50,000₫', 'localFile') ?></label>
                    </p>

                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test3"
                            <?php if (isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == '50000:100000') echo 'checked'; ?>
                               name="price-filter" data-price="7000" value="50000:100000">
                        <label for="test3"><?php echo __('Từ 50,000₫ - 100,000₫', 'localFile') ?></label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test4"
                            <?php if (isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == '100000:300000') echo 'checked'; ?>
                               name="price-filter" data-price="100000:300000" value="100000:300000">
                        <label for="test4"><?php echo __('Từ 100,000₫ - 300,000₫', 'localFile') ?></label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test5"
                            <?php if (isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == '300000:500000') echo 'checked'; ?>
                               name="price-filter" data-price="300000:500000" value="300000:500000">
                        <label for="test5"><?php echo __('Từ 300,000₫ - 500,000₫', 'localFile') ?></label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test6"
                            <?php if (isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == '500000:700000') echo 'checked'; ?>
                               name="price-filter" data-price="500000:700000" value="500000:700000">
                        <label for="test6"><?php echo __('Từ 500,000₫ - 700,000₫', 'localFile') ?></label>
                    </p>
                </li>
                <li class="text-left">
                    <p>
                        <input type="radio"
                               id="test7"
                            <?php if (isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == '700000:500000000') echo 'checked'; ?>
                               name="price-filter" data-price="700000:500000000" value="700000:500000000">
                        <label for="test7"><?php echo __('Lớn hơn 700,000₫', 'localFile') ?></label>
                    </p>
                </li>
            </ul>
        </div>
        <hr/>
    </div>
    <!--    end filter price-->
    <!--  Start filter thương hiệu   -->
    <?php
    //    $term_id = get_term_by('slug', 'trademark', 'product_cat')->term_id;
    $cateID = get_query_var('my_var');
    $args = array(
        'post_type' => array('product', 'product_variation'),
        'ignore_sticky_posts' => 1,
        'post_status' => 'publish',
        'tax_query' => array(

            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                'terms' => $cateID,
                'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
            ),
            array(
                'taxonomy' => 'product_visibility',
                'field' => 'slug',
                'terms' => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                'operator' => 'NOT IN'
            )


        ),
    );
    $trademark = array();
    $loop = new WP_Query($args);
    while ($loop->have_posts()) :
        $loop->the_post();
        global $product;
        $terms = get_the_terms($product->get_id(), 'product_cat');
        //                    var_dump($terms);
        foreach ($terms as $category) {
            if ($category->parent == 49 && !in_array($category, $trademark)) {
                array_push($trademark, $category);
            }
//                        var_dump(get_category($category->term_id));
        }
    endwhile;
    if (sizeof($trademark) > 0):
    ?>
    <div class="filter-list" id="bs-collapse">
        <h5 class="text-left text-uppercase"><i
                    class="fa fa-tags"></i> <?php echo __('Filter by trademark', 'localFile') ?><span
                    class="float-right icon-right"><i class="fa fa-angle-right"></i></h5>
        <div style="margin-left: 20px">
            <ul class="no-bullets filter-price clearfix">
                <?php
                $dem = 1;
                foreach ($trademark as $term): ?>

                    <?php $vendor_arr = explode(',', $_GET['vendor']) ?>
                    <?php $actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
                    <li class="text-left checkbox">
                        <span>
                            <input type="checkbox"
                                   id="check-<?php echo $dem ?>"
                                   name="trademark-filter" data-price="0:max"
                                <?php if (in_array($term->slug, $vendor_arr)) {
                                    echo 'checked';
                                } ?>
                                   value="<?php echo $term->slug ?>">
                            <label for="check-<?php echo $dem ?>"><?php echo get_the_category_by_ID($term->term_id) ?></label>
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