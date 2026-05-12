<?php
function lp3aik_register_taxonomies() {
    register_taxonomy('kategori_program', 'lp3aik_program', [
        'labels' => [
            'name'              => 'Kategori Program',
            'singular_name'     => 'Kategori Program',
            'search_items'      => 'Cari Kategori',
            'all_items'         => 'Semua Kategori',
            'parent_item'       => 'Kategori Induk',
            'parent_item_colon' => 'Kategori Induk:',
            'edit_item'         => 'Edit Kategori',
            'update_item'       => 'Perbarui Kategori',
            'add_new_item'      => 'Tambah Kategori Baru',
            'new_item_name'     => 'Nama Kategori Baru',
            'menu_name'         => 'Kategori Program',
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'kategori-program'],
    ]);

    register_taxonomy('kategori_galeri', 'lp3aik_galeri', [
        'labels' => [
            'name'              => 'Kategori Galeri',
            'singular_name'     => 'Kategori Galeri',
            'search_items'      => 'Cari Kategori',
            'all_items'         => 'Semua Kategori',
            'parent_item'       => 'Kategori Induk',
            'parent_item_colon' => 'Kategori Induk:',
            'edit_item'         => 'Edit Kategori',
            'update_item'       => 'Perbarui Kategori',
            'add_new_item'      => 'Tambah Kategori Baru',
            'new_item_name'     => 'Nama Kategori Baru',
            'menu_name'         => 'Kategori Galeri',
        ],
        'hierarchical'      => true,
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => false,
        'rewrite'           => false,
    ]);

    register_taxonomy('kategori_unduhan', 'lp3aik_unduhan', [
        'labels' => [
            'name'              => 'Kategori Unduhan',
            'singular_name'     => 'Kategori Unduhan',
            'search_items'      => 'Cari Kategori',
            'all_items'         => 'Semua Kategori',
            'parent_item'       => 'Kategori Induk',
            'parent_item_colon' => 'Kategori Induk:',
            'edit_item'         => 'Edit Kategori',
            'update_item'       => 'Perbarui Kategori',
            'add_new_item'      => 'Tambah Kategori Baru',
            'new_item_name'     => 'Nama Kategori Baru',
            'menu_name'         => 'Kategori Unduhan',
        ],
        'hierarchical'      => true,
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => false,
        'rewrite'           => false,
    ]);
}
add_action('init', 'lp3aik_register_taxonomies');

/**
 * Ubah input Tag (post_tag) bawaan WordPress menjadi Checkbox
 * Mencegah user mengetik tag baru secara sembarangan / salah ketik (typo).
 */
function lp3aik_change_post_tag_to_checkbox() {
    global $wp_taxonomies;
    if (isset($wp_taxonomies['post_tag'])) {
        $wp_taxonomies['post_tag']->hierarchical = true;
    }
}
add_action('init', 'lp3aik_change_post_tag_to_checkbox', 99);
