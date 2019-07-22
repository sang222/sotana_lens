<?php
function cpt_slide()
{
    $label = array('name' => 'Các slide',
        'singular_name' => 'slide',
        'add_new' => 'Thêm slide',
        'add_new_item' => 'Thêm slide mới',
        'edit_item' => 'Sửa slide',
        'new_item' => 'slide mới',
        'view_item' => 'Xem slide',
        'view_items' => 'Xem tất cả slide',
        'search_items' => 'Tìm kiếm slide',
        'not_found' => 'Không có slide',
        'not_found_in_trash' => 'Không có slide nào trong thùng rác',
        'all_items' => 'Tất cả slide',
        'insert_into_item' => 'Thêm phương tiện',
        'uploaded_to_this_item' => 'Tải lên phương tiện',
        'featured_image' => 'Ảnh slide',
        'set_featured_image' => 'Thêm hình ảnh slide',
        'remove_featured_image' => 'Xóa hình ảnh slide',
        'use_featured_image' => 'Sử dụng hình ảnh slide',
        'menu_name' => 'slide custom',
        'name_admin_bar' => 'slide');

    $support = array('title',
        'editor',
        'excerpt',
        'author',
        'thumbnail',
        'custom-fields');


    $arrs = array(
        'labels' => $label,
        'description' => 'Mô tả về loại post này',
        'supports' => $support,
        'taxonomies' => array('nav_menu', 'nav_menu_item'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-view-site',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post');
    register_post_type('show-slide', $arrs);
}

add_action('init', 'cpt_slide');
function slide_meta_box()
{
    add_meta_box('slides', 'Thông tin slide', 'form_slides', 'show-slide');
}

add_action('add_meta_boxes', 'slide_meta_box');

function form_slides($post)
{
    $text1_slide = get_post_meta($post->ID, '_text1_slide', true);
    $text2_slide = get_post_meta($post->ID, '_text2_slide', true);
    $text3_slide = get_post_meta($post->ID, '_text3_slide', true);
    $text4_slide = get_post_meta($post->ID, '_text4_slide', true);
    echo '<div id="postcustomstuff"><table id="list-table">
         <thead>
         <tr>
         <th class="left">Tên</th>
         <th>Giá trị</th>
         </tr>
         </thead>
         
         <tbody id="the-list" data-wp-lists="list:meta">
         <tr>
         <td class="left">
         <label for="text1_slide">Dòng mô tả: </label>
         </td>
         <td>
         <input type="text" id="text1_slide" name="text1_slide" value="' . esc_attr($text1_slide) . '" />
         </td>
         </tr>
         
         <tr>
         <td class="left">
         <label for="text2_slide">Đoạn mô tả ngắn: </label>
         </td>
         <td>
         <textarea id="text2_slide" name="text2_slide" rows="2" cols="25">' . esc_attr($text2_slide) . '</textarea>
         </td>
         </tr>
         
         <tr>
         <td class="left">
         <label for="text3_slide">Tên nút bấm: </label>
         </td>
         <td>
         <input type="text" id="text3_slide" name="text3_slide" value="' . esc_attr($text3_slide) . '" />
         </td>
         </tr>
         
         <tr>
         <td class="left">
         <label for="text4_slide">Liên kết: </label>
         </td>
         <td>
         <input type="text" id="text4_slide" name="text4_slide" value="' . esc_attr($text4_slide) . '" />
         </td>
         </tr>
         
         
         </tbody>
        </table></div>';

}

function form_slides_save($post_id)
{
    $text1_slide = sanitize_text_field($_POST['text1_slide']);
    update_post_meta($post_id, '_text1_slide', $text1_slide);

    $text2_slide = sanitize_text_field($_POST['text2_slide']);
    update_post_meta($post_id, '_text2_slide', $text2_slide);

    $text3_slide = sanitize_text_field($_POST['text3_slide']);
    update_post_meta($post_id, '_text3_slide', $text3_slide);

    $text4_slide = sanitize_text_field($_POST['text4_slide']);
    update_post_meta($post_id, '_text4_slide', $text4_slide);

}

add_action('save_post', 'form_slides_save');