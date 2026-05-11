<?php
function lp3aik_register_cpt_org_structure() {
    $labels = [
        'name'                  => 'Struktur Organisasi',
        'singular_name'         => 'Anggota',
        'add_new'               => 'Tambah Anggota',
        'add_new_item'          => 'Tambah Anggota Baru',
        'edit_item'             => 'Edit Anggota',
        'new_item'              => 'Anggota Baru',
        'view_item'             => 'Lihat Anggota',
        'search_items'          => 'Cari Anggota',
        'not_found'             => 'Tidak ada anggota ditemukan',
        'not_found_in_trash'    => 'Tidak ada anggota di trash',
        'menu_name'             => 'Struktur Organisasi',
    ];

    $args = [
        'labels'              => $labels,
        'public'              => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_rest'        => false,
        'menu_icon'           => 'dashicons-groups',
        'capability_type'     => 'post',
        'supports'            => ['title', 'thumbnail'],
        'has_archive'         => false,
        'rewrite'             => false,
    ];

    register_post_type('lp3aik_org_structure', $args);
}
add_action('init', 'lp3aik_register_cpt_org_structure');
