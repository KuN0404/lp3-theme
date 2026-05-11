<?php
function lp3aik_register_cpt_galeri() {
    $labels = [
        'name'                  => 'Galeri',
        'singular_name'         => 'Foto',
        'add_new'               => 'Tambah Foto',
        'add_new_item'          => 'Tambah Foto Baru',
        'edit_item'             => 'Edit Foto',
        'new_item'              => 'Foto Baru',
        'view_item'             => 'Lihat Foto',
        'search_items'          => 'Cari Foto',
        'not_found'             => 'Tidak ada foto ditemukan',
        'not_found_in_trash'    => 'Tidak ada foto di trash',
        'menu_name'             => 'Galeri',
        'all_items'             => 'Semua Foto',
    ];

    $args = [
        'labels'              => $labels,
        'public'              => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_rest'        => false,
        'menu_icon'           => 'dashicons-format-gallery',
        'capability_type'     => 'post',
        'supports'            => ['title', 'thumbnail'],
        'has_archive'         => false,
        'rewrite'             => false,
        'menu_position'       => 8,
    ];

    register_post_type('lp3aik_galeri', $args);
}
add_action('init', 'lp3aik_register_cpt_galeri');
