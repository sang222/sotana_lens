<?php /*
Template Name: Order
*/ ?>
<?php if (is_user_logged_in()) { ?>
    <?php get_header() ?>
    <?php
    $current_user = wp_get_current_user();
    if (0 == $current_user->ID) return;

// GET USER ORDERS (COMPLETED + PROCESSING)
    $customer_orders = get_posts(array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'meta_value' => $current_user->ID,
        'post_type' => wc_get_order_types(),
        'post_status' => array_keys(wc_get_is_paid_statuses()),
    ));
//print_r($customer_orders);

    ?>
    <div class="fixed-width" id="account">
        <h1 class="text-uppercase title-h1">Tài khoản của bạn</h1>
        <hr/>
        <div class="row">

            <div class="col-lg-8 col-sm-8 col-xs-12">
                <h2 class="title-h4 text-uppercase">Lịch sử giao dịch</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Ngày</th>
                        <th>Tình trang thanh toán</th>
                        <th>Tổng</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php
                    foreach ($customer_orders as $customer_order) :?>
                        <?php
                        $order_id = $customer_order->ID;
                        $order = wc_get_order($order_id);
//            var_dump($order);
                        ?>
                        <tr>
                            <td><?php echo $customer_order->post_date ?></td>
                            <td><?php echo $customer_order->post_status ?></td>
                            <td><?php echo $order->get_total(); ?></td>
                            <td>3</td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="col-lg-4 col-sm-4 col-xs-12">
                <h2 class="title-h4 text-uppercase">Thông tin tài khoản</h2>
                <!--                --><?php //var_dump(wp_get_current_user()) ?>
                <p><strong>Tài khoản: </strong> <?php echo wp_get_current_user()->user_login ?></p>
                <p><strong>Email: </strong> <?php echo wp_get_current_user()->user_email ?></p>
            </div>
        </div>
    </div>
    <?php get_footer() ?>
<?php } else {
    header('Location:' . home_url() . '/dang-nhap');
}
?>