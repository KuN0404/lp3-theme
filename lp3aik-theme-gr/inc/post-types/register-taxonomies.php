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

    register_taxonomy('jabatan', ['lp3aik_tim'], [
        'label'        => __('Jabatan', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'jabatan'],
    ]);

    register_taxonomy('album_galeri', ['lp3aik_galeri'], [
        'label'        => __('Album', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'album'],
    ]);

    register_taxonomy('jenis_unduhan', ['lp3aik_unduhan'], [
        'label'        => __('Jenis File', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'jenis-unduhan'],
    ]);
});
