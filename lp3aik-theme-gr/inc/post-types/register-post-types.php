<?php
/**
 * Register Custom Post Types.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('init', function () {

    // ── PROGRAM / LAYANAN ───────────────────────────────────
    register_post_type('lp3aik_program', [
        'labels' => [
            'name'               => __('Program',           'lp3aik-umk'),
            'singular_name'      => __('Program',           'lp3aik-umk'),
            'add_new'            => __('Tambah Program',    'lp3aik-umk'),
            'add_new_item'       => __('Tambah Program Baru','lp3aik-umk'),
            'edit_item'          => __('Edit Program',      'lp3aik-umk'),
            'view_item'          => __('Lihat Program',     'lp3aik-umk'),
            'all_items'          => __('Semua Program',     'lp3aik-umk'),
            'search_items'       => __('Cari Program',      'lp3aik-umk'),
            'menu_name'          => __('Program',           'lp3aik-umk'),
        ],
        'public'             => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-book-alt',
        'menu_position'      => 5,
        'supports'           => ['title','editor','excerpt','thumbnail','custom-fields'],
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'program'],
        'show_in_nav_menus'  => true,
    ]);

    // ── TIM / PENGURUS ──────────────────────────────────────
    register_post_type('lp3aik_tim', [
        'labels' => [
            'name'          => __('Tim / Pengurus',      'lp3aik-umk'),
            'singular_name' => __('Anggota Tim',         'lp3aik-umk'),
            'add_new'       => __('Tambah Anggota',      'lp3aik-umk'),
            'add_new_item'  => __('Tambah Anggota Baru', 'lp3aik-umk'),
            'edit_item'     => __('Edit Anggota',        'lp3aik-umk'),
            'all_items'     => __('Semua Anggota',       'lp3aik-umk'),
            'menu_name'     => __('Tim',                 'lp3aik-umk'),
        ],
        'public'         => true,
        'show_in_rest'   => true,
        'menu_icon'      => 'dashicons-groups',
        'menu_position'  => 6,
        'supports'       => ['title','editor','thumbnail','custom-fields','page-attributes'],
        'has_archive'    => false,
        'rewrite'        => ['slug' => 'tim'],
        'show_in_nav_menus' => false,
    ]);

    // ── GALERI ──────────────────────────────────────────────
    register_post_type('lp3aik_galeri', [
        'labels' => [
            'name'          => __('Galeri',           'lp3aik-umk'),
            'singular_name' => __('Foto Galeri',      'lp3aik-umk'),
            'add_new'       => __('Tambah Foto',      'lp3aik-umk'),
            'add_new_item'  => __('Tambah Foto Baru', 'lp3aik-umk'),
            'edit_item'     => __('Edit Foto',        'lp3aik-umk'),
            'all_items'     => __('Semua Foto',       'lp3aik-umk'),
            'menu_name'     => __('Galeri',           'lp3aik-umk'),
        ],
        'public'         => true,
        'show_in_rest'   => true,
        'menu_icon'      => 'dashicons-format-gallery',
        'menu_position'  => 7,
        'supports'       => ['title','thumbnail','editor','custom-fields'],
        'has_archive'    => true,
        'rewrite'        => ['slug' => 'galeri'],
    ]);

    // ── UNDUHAN / FILE ──────────────────────────────────────
    register_post_type('lp3aik_unduhan', [
        'labels' => [
            'name'          => __('Unduhan',           'lp3aik-umk'),
            'singular_name' => __('File Unduhan',      'lp3aik-umk'),
            'add_new'       => __('Tambah File',       'lp3aik-umk'),
            'add_new_item'  => __('Tambah File Baru',  'lp3aik-umk'),
            'edit_item'     => __('Edit File',         'lp3aik-umk'),
            'all_items'     => __('Semua File',        'lp3aik-umk'),
            'menu_name'     => __('Unduhan',           'lp3aik-umk'),
        ],
        'public'         => true,
        'show_in_rest'   => true,
        'menu_icon'      => 'dashicons-download',
        'menu_position'  => 8,
        'supports'       => ['title','editor','thumbnail','custom-fields'],
        'has_archive'    => true,
        'rewrite'        => ['slug' => 'unduhan'],
    ]);

    // =====================================================================
    // REGISTER TAXONOMIES (KATEGORI KHUSUS)
    // =====================================================================

    // ── KATEGORI GALERI (Album) ─────────────────────────────
    register_taxonomy('album_galeri', ['lp3aik_galeri'], [
        'labels' => [
            'name'          => __('Album Galeri', 'lp3aik-umk'),
            'singular_name' => __('Album', 'lp3aik-umk'),
            'search_items'  => __('Cari Album', 'lp3aik-umk'),
            'all_items'     => __('Semua Album', 'lp3aik-umk'),
            'edit_item'     => __('Edit Album', 'lp3aik-umk'),
            'update_item'   => __('Update Album', 'lp3aik-umk'),
            'add_new_item'  => __('Tambah Album Baru', 'lp3aik-umk'),
            'new_item_name' => __('Nama Album Baru', 'lp3aik-umk'),
            'menu_name'     => __('Album', 'lp3aik-umk'),
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'album'],
        'show_in_rest'      => true,
    ]);

    // ── JABATAN TIM ─────────────────────────────────────────
    register_taxonomy('jabatan_tim', ['lp3aik_tim'], [
        'labels' => [
            'name'          => __('Jabatan', 'lp3aik-umk'),
            'singular_name' => __('Jabatan', 'lp3aik-umk'),
            'search_items'  => __('Cari Jabatan', 'lp3aik-umk'),
            'all_items'     => __('Semua Jabatan', 'lp3aik-umk'),
            'edit_item'     => __('Edit Jabatan', 'lp3aik-umk'),
            'update_item'   => __('Update Jabatan', 'lp3aik-umk'),
            'add_new_item'  => __('Tambah Jabatan Baru', 'lp3aik-umk'),
            'new_item_name' => __('Nama Jabatan Baru', 'lp3aik-umk'),
            'menu_name'     => __('Jabatan', 'lp3aik-umk'),
        ],
        'hierarchical'      => true, // Seperti kategori (bukan tag) agar mudah dipilih via checkbox
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'jabatan'],
        'show_in_rest'      => true,
    ]);

});
