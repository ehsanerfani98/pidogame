<?php

if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group(array(
        'key' => 'group_62dc2b1759693',
        'title' => 'فیلدهای اضافه',
        'fields' => array(
            array(
                'key' => 'field_62dc3ab6f3e81',
                'label' => 'فیلد ها',
                'name' => 'plswb_fields',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => 'field_62dc344c0ecaa',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_62dc344c0ecaa',
                        'label' => 'عنوان',
                        'name' => 'title_field',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => 'برای این فیلد یک عنوان وارد کنید.',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_62dc372c2c923',
                        'label' => 'متن راهنما',
                        'name' => 'help_field',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => 'برای این فیلد یک متن راهنما وارد کنید.',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_62dc34be1e1f8',
                        'label' => 'نوع فیلد',
                        'name' => 'type_field',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'text' => 'متنی',
                            'email' => 'ایمیل',
                            'password' => 'رمز عبور',
                            'number' => 'عدد',
                            'textarea' => 'توضیحات متنی',
                            'checkbox' => 'تیک زدنی',
                            'select' => 'انتخابی',
                        ),
                        'default_value' => false,
                        'allow_null' => 1,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_62dd65bdc4d5c',
                        'label' => 'الزامی',
                        'name' => 'required_field',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_62dc381692b8d',
                        'label' => 'قیمت',
                        'name' => 'price_field',
                        'type' => 'number',
                        'instructions' => 'چنانچه مقدار این فیلد به قیمت محصول اضافه می شود ، یک مبلغ برای آن وارد کنید.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_62dc38c229c5b',
                        'label' => 'مقدار فیلد انتخابی',
                        'name' => 'values_select_field',
                        'type' => 'text',
                        'instructions' => 'چنانچه نوع فیلد را از نوع انتخابی انتخاب کرده اید ، مقدار هر گزینه رو با # جدا کنید.
    مثال : گوگل#فیسبوک#اینستاگرام',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_62dc2b29e72cf',
                        'label' => 'محصولات شامل :',
                        'name' => 'show_in_products',
                        'type' => 'post_object',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array(
                            0 => 'product_variation',
                        ),
                        'taxonomy' => '',
                        'allow_null' => 0,
                        'multiple' => 1,
                        'return_format' => 'object',
                        'ui' => 1,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'extra_fields_plswb',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));


// acf_add_local_field_group(array(
//     'key' => 'group_62dc2b1759695',
//     'title' => 'قوانین نمایش',
//     'fields' => array(
//         array(
//             'key' => 'field_62dc2b29e72cf',
//             'label' => 'محصولات شامل :',
//             'name' => 'show_in_products',
//             'type' => 'post_object',
//             'instructions' => '',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'post_type' => array(
//                 0 => 'product_variation',
//             ),
//             'taxonomy' => '',
//             'allow_null' => 0,
//             'multiple' => 1,
//             'return_format' => 'object',
//             'ui' => 1,
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post_type',
//                 'operator' => '==',
//                 'value' => 'extra_fields_plswb',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'normal',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => '',
//     'active' => true,
//     'description' => '',
//     'show_in_rest' => 0,
// ));

endif;







// post type
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
