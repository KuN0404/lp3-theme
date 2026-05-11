<?php
function lp3aik_register_cpt_unduhan() {
    $labels = [
        'name'                  => 'Unduhan',
        'singular_name'         => 'Unduhan',
        'add_new'               => 'Tambah Unduhan',
        'add_new_item'          => 'Tambah Unduhan Baru',
        'edit_item'             => 'Edit Unduhan',
        'new_item'              => 'Unduhan Baru',
        'view_item'             => 'Lihat Unduhan',
        'search_items'          => 'Cari Unduhan',
        'not_found'             => 'Tidak ada unduhan ditemukan',
        'not_found_in_trash'    => 'Tidak ada unduhan di trash',
        'menu_name'             => 'Unduhan',
        'all_items'             => 'Semua Unduhan',
    ];

    $args = [
        'labels'              => $labels,
        'public'              => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_rest'        => false,
        'menu_icon'           => 'dashicons-download',
        'capability_type'     => 'post',
        'supports'            => ['title', 'excerpt'],
        'has_archive'         => false,
        'rewrite'             => false,
        'menu_position'       => 9,
    ];

    register_post_type('lp3aik_unduhan', $args);
}
add_action('init', 'lp3aik_register_cpt_unduhan');
