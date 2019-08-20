<?php
function pagination()
{
    if (is_singular())
        return;
    global $wp_query;
    /** Ngừng thực thi nếu có ít hơn hoặc chỉ có 1 bài viết */
    if ($wp_query->max_num_pages <= 1)
        return;
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** Thêm page đang được lựa chọn vào mảng*/
    if ($paged >= 1)
        $links[] = $paged;
    /** Thêm những trang khác xung quanh page được chọn vào mảng */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    /** Hiển thị thẻ đầu tiên \n để xuống dòng code */
    echo '<ul class="pagination">' . "\n";

    /** Hiển thị link về trang trước */
    if (get_previous_posts_link())
        printf('<li>%s</li>' . "\n", get_previous_posts_link(__('Trước', 'localFile')));

    /** Nếu đang ở trang 1 thì nó sẽ hiển thị đoạn này */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf('<li %s><a rel="nofollow" class="page larger" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');
        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /** Hiển thị khi đang ở một trang nào đó đang được lựa chọn */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a rel="nofollow" class="page larger" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** Hiển thị khi đang ở trang cuối cùng */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";
        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a rel="nofollow" class="page larger" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** Hiển thị link về trang sau */
    if (get_next_posts_link())
        printf('<li>%s</li>' . "\n", get_next_posts_link(__('Sau', 'localFile')));
    echo '</ul>' . "\n";
}

?>

