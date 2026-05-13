<?php
/**
 * Register Custom Taxonomies.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('init', function () {

    register_taxonomy('kategori_program', ['lp3aik_program'], [
        'label'        => __('Kategori Program', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'kategori-program'],
    ]);


    register_taxonomy('album_galeri', ['lp3aik_galeri'], [
        'label'        => __('Album', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'album'],
    ]);

    register_taxonomy('jenis_unduhan', ['lp3aik_unduhan'], [
        'labels'       => [
            'name'          => __('Kategori File', 'lp3aik-umk'),
            'singular_name' => __('Kategori File', 'lp3aik-umk'),
            'menu_name'     => __('Kategori File', 'lp3aik-umk'),
            'all_items'     => __('Semua Kategori', 'lp3aik-umk'),
            'edit_item'     => __('Edit Kategori', 'lp3aik-umk'),
            'view_item'     => __('Lihat Kategori', 'lp3aik-umk'),
            'update_item'   => __('Perbarui Kategori', 'lp3aik-umk'),
            'add_new_item'  => __('Tambah Kategori Baru', 'lp3aik-umk'),
            'new_item_name' => __('Nama Kategori Baru', 'lp3aik-umk'),
        ],
        'hierarchical' => true,
        'show_in_rest' => false, // Keep classic metabox in sidebar for clean alignment!
        'rewrite'      => ['slug' => 'kategori-file'],
    ]);
});
