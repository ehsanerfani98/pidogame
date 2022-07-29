<?php
	
function extra_fields_plswb()
{

    $labels = array(
        'name'                  => _x('فیلدهای اضافه', 'فیلد General Name', 'text_domain'),
        'singular_name'         => _x('فیلد', 'فیلد Singular Name', 'text_domain'),
        'menu_name'             => __('فیلدها', 'text_domain'),
        'name_admin_bar'        => __('فیلد', 'text_domain'),
        'archives'              => __('بایگانی فیلد ها', 'text_domain'),
        'all_items'             => __('همه فیلد ها', 'text_domain'),
        'add_new_item'          => __('ایجاد فیلد جدید', 'text_domain'),
        'add_new'               => __('ایجاد فیلد جدید', 'text_domain'),
        'new_item'              => __('فیلد جدید', 'text_domain'),
        'edit_item'             => __('ویرایش فیلد', 'text_domain'),
        'update_item'           => __('بروزرسانی فیلد', 'text_domain'),
        'view_item'             => __('نمایش فیلد', 'text_domain'),
        'view_items'            => __('نمایش فیلد ها', 'text_domain'),
        'search_items'          => __('جستجو فیلد', 'text_domain'),
        'not_found'             => __('یافت نشد', 'text_domain'),
        'not_found_in_trash'    => __('در زباله دان یافت نشد', 'text_domain'),
        'insert_into_item'      => __('اضافه کردن به فیلد', 'text_domain'),
        'uploaded_to_this_item' => __('این فیلد بارگذاری شد', 'text_domain'),
        'items_list'            => __('لیست فیلد ها', 'text_domain'),
        'items_list_navigation' => __('لیست مسیریابی فیلد ها', 'text_domain'),
        'filter_items_list'     => __('فیلتر لیست فیلد ها', 'text_domain'),
    );
    $args = array(
        'label'                 => __('فیلد', 'text_domain'),
        'description'           => __('فیلدهای اضافه برای محصولات', 'text_domain'),
        'labels'                => $labels,
        'supports'              => ['title'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('extra_fields_plswb', $args);
}
add_action('init', 'extra_fields_plswb', 0);
