<?php
function lp3aik_register_cpt_program() {
    $labels = [
        'name'                  => 'Program',
        'singular_name'         => 'Program',
        'add_new'               => 'Tambah Program',
        'add_new_item'          => 'Tambah Program Baru',
        'edit_item'             => 'Edit Program',
        'new_item'              => 'Program Baru',
        'view_item'             => 'Lihat Program',
        'search_items'          => 'Cari Program',
        'not_found'             => 'Tidak ada program ditemukan',
        'not_found_in_trash'    => 'Tidak ada program di trash',
        'menu_name'             => 'Program',
        'all_items'             => 'Semua Program',
    ];

    $args = [
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-welcome-learn-more',
        'capability_type'     => 'post',
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt'],
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'programs'],
        'menu_position'       => 6,
    ];

    register_post_type('lp3aik_program', $args);
}
add_action('init', 'lp3aik_register_cpt_program');
