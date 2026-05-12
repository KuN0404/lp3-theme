<?php
/**
 * Theme Setup — add_theme_support, register_nav_menus, image sizes, widgets.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('after_setup_theme', function (): void {

    load_theme_textdomain('lp3aik-umk', LP3AIK_DIR . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ]);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');

    // ── Navigation Menus ────────────────────────────────────
    register_nav_menus([
        'primary'  => __('Menu Utama (Header)', 'lp3aik-umk'),
        'footer-1' => __('Menu Footer — Navigasi', 'lp3aik-umk'),
        'footer-2' => __('Menu Footer — Program', 'lp3aik-umk'),
    ]);

    // ── Image Sizes ─────────────────────────────────────────
    add_image_size('lp3aik-hero',    1920, 900,  true);
    add_image_size('lp3aik-card',    800,  500,  true);
    add_image_size('lp3aik-thumb',   400,  250,  true);
    add_image_size('lp3aik-thumb-sm', 160, 120, true);
    add_image_size('lp3aik-team',    300,  300,  true);
    add_image_size('lp3aik-gallery', 900,  700,  false);
});

// ── Register Sidebars / Widget Areas ─────────────────────────
add_action('widgets_init', function (): void {
    $sidebars = [
        [
            'name'          => __('Sidebar Blog', 'lp3aik-umk'),
            'id'            => 'blog-sidebar',
            'description'   => __('Widget area sidebar halaman berita/blog.', 'lp3aik-umk'),
        ],
        [
            'name'          => __('Footer — Kontak Tambahan', 'lp3aik-umk'),
            'id'            => 'footer-1',
            'description'   => __('Widget tambahan di kolom kontak footer.', 'lp3aik-umk'),
        ],
    ];

    foreach ($sidebars as $args) {
        register_sidebar(array_merge([
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ], $args));
    }
});

// ── Custom Image Size Names in Media Library ──────────────────
add_filter('image_size_names_choose', function (array $sizes): array {
    return array_merge($sizes, [
        'lp3aik-hero'     => __('Hero (1920×900)', 'lp3aik-umk'),
        'lp3aik-card'     => __('Card (800×500)', 'lp3aik-umk'),
        'lp3aik-thumb'    => __('Thumbnail (400×250)', 'lp3aik-umk'),
        'lp3aik-team'     => __('Tim (300×300)', 'lp3aik-umk'),
        'lp3aik-gallery'  => __('Galeri (900×700)', 'lp3aik-umk'),
    ]);
});
