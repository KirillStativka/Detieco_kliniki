<?php
add_action('init', 'post_types');
function post_types() {
    //kliniki
    $labels = array(
        'name' => __('Клиники', 'base'),
        'singular_name' => __('Клиники', 'base'),
        'add_new' => __('Добавить клинику', 'base'),
        'add_new_item' => __('Добавить новую клинику', 'base'),
        'edit_item' => __('Редактировать клинику', 'base'),
        'new_item' => __('Новая клиника', 'base'),
        'view_item' => __('Посмотреть клинику', 'base'),
        'search_items' => __('Найти клинику', 'base'),
        'not_found' => __( 'Клиник не найдено', 'base'),
        'not_found_in_trash' => __('В корзине клиник не найдено', 'base'),
        'parent_item_colon' => '',__('', 'base'),
        'menu_name' => __('Клиники', 'base'),
        );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'menu_icon' => 'dashicons-shield',
        'hierarchical' => false,
        'menu_position' =>10,
        'supports' => array('title','editor','author','thumbnail','excerpt','comments')
        );
    register_post_type('kliniki', $args);

    unset($labels);
    unset($args);


    //Countries kliniki
    $labels = array(
        'name' => __('Страны', 'base'),
        'singular_name' => __('Страна (клиники)', 'base'),
        'add_new' => __('Добавить страну', 'base'),
        'add_new_item' => __('Добавить новую страну', 'base'),
        'all_items'  => __('Страны', 'base'),
        'edit_item' => __('Редактировать страну', 'base'),
        'new_item' => __('Новая страна', 'base'),
        'view_item' => __('Посмотреть страну', 'base'),
        'search_items' => __('Найти страну', 'base'),
        'not_found' => __( 'Страна не найдена', 'base'),
        'not_found_in_trash' => __('В корзине стран не найдено', 'base'),
        'parent_item_colon' => __('Parent country', 'base'),
        'menu_name' => __('Локации', 'base'),
        );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=kliniki',
        'query_var' => true,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'menu_icon' => 'dashicons-shield',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'comments', 'custom-fields')
        );
    register_post_type('countries_kliniki', $args);

    unset($labels);
    unset($args);



    //Cities kliniki
    $labels = array(
        'name' => __('Города', 'base'),
        'singular_name' => __('Город (клиники)', 'base'),
        'add_new' => __('Добавить город', 'base'),
        'add_new_item' => __('Добавить новый город', 'base'),
        'all_items'  => __('Города', 'base'),
        'edit_item' => __('Редактировать город', 'base'),
        'new_item' => __('Новый город', 'base'),
        'view_item' => __('Посмотреть город', 'base'),
        'search_items' => __('Найти город', 'base'),
        'not_found' => __( 'Город не найден', 'base'),
        'not_found_in_trash' => __('В корзине городов не найдено', 'base'),
        'parent_item_colon' => __('Parent city', 'base'),
       // 'menu_name' => __('Локации', 'base'),
        );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=kliniki',
        'query_var' => true,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'menu_icon' => 'dashicons-admin-site',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','editor', 'thumbnail', 'comments', 'custom-fields')
        );
    register_post_type('cities_kliniki', $args);

    unset($labels);
    unset($args);

    
}