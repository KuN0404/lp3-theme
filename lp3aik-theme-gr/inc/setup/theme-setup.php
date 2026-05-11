<?php
/**
 * Theme Setup — after_setup_theme hooks.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('after_setup_theme', function () {

    load_theme_textdomain('lp3aik-umk', LP3AIK_DIR . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-color-palette', [
        ['name' => __('Hijau Utama','lp3aik-umk'),   'slug' => 'green-primary', 'color' => '#1a7a3c'],
        ['name' => __('Hijau Gelap','lp3aik-umk'),   'slug' => 'green-dark',    'color' => '#0a4a1e'],
        ['name' => __('Emas','lp3aik-umk'),           'slug' => 'gold',          'color' => '#c8972a'],
        ['name' => __('Putih','lp3aik-umk'),          'slug' => 'white',         'color' => '#ffffff'],
    ]);

    add_theme_support('custom-logo', [
        'height'               => 80,
        'width'                => 200,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => ['site-title','site-description'],
        'unlink-homepage-logo' => false,
    ]);

    // Custom image sizes
    add_image_size('lp3aik-card',      800,  500, true);
    add_image_size('lp3aik-gallery',   600,  450, true);
    add_image_size('lp3aik-team',      300,  300, true);
    add_image_size('lp3aik-hero',      1600, 800, true);
    add_image_size('lp3aik-thumb-sm',  200,  160, true);

    // Navigation menus
    register_nav_menus([
        'primary'  => __('Menu Utama',    'lp3aik-umk'),
        'footer-1' => __('Menu Footer 1', 'lp3aik-umk'),
        'footer-2' => __('Menu Footer 2', 'lp3aik-umk'),
    ]);
});

// ============================================================
// WIDGETS / SIDEBARS
// ============================================================
add_action('widgets_init', function () {
    $defaults = [
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ];

    register_sidebar(array_merge($defaults, [
        'name' => __('Sidebar Blog',       'lp3aik-umk'),
        'id'   => 'sidebar-blog',
        'description' => __('Widget di sidebar halaman blog/berita.', 'lp3aik-umk'),
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Sidebar Halaman',    'lp3aik-umk'),
        'id'   => 'sidebar-page',
        'description' => __('Widget di sidebar halaman statis.', 'lp3aik-umk'),
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Kolom 1',     'lp3aik-umk'),
        'id'   => 'footer-1',
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Kolom 2',     'lp3aik-umk'),
        'id'   => 'footer-2',
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Kolom 3',     'lp3aik-umk'),
        'id'   => 'sidebar-footer-3',
    ]));
});
