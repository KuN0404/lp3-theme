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
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    // Editor color palette — uses semantic names matching CSS variables
    add_theme_support('editor-color-palette', [
        ['name' => __('Primary', 'lp3aik-umk'),         'slug' => 'primary',        'color' => '#1a7a3c'],
        ['name' => __('Primary Dark', 'lp3aik-umk'),    'slug' => 'primary-dark',   'color' => '#0a4a1e'],
        ['name' => __('Accent', 'lp3aik-umk'),          'slug' => 'accent',         'color' => '#c8972a'],
        ['name' => __('Accent Light', 'lp3aik-umk'),    'slug' => 'accent-light',   'color' => '#e8b94a'],
        ['name' => __('White', 'lp3aik-umk'),           'slug' => 'white',          'color' => '#ffffff'],
        ['name' => __('Text', 'lp3aik-umk'),            'slug' => 'text',           'color' => '#333333'],
    ]);

    add_theme_support('custom-logo', [
        'height'               => 80,
        'width'                => 200,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => ['site-title', 'site-description'],
        'unlink-homepage-logo' => false,
    ]);

    // Custom image sizes
    add_image_size('lp3aik-card',     800, 500, true);
    add_image_size('lp3aik-gallery',  600, 450, true);
    add_image_size('lp3aik-team',     300, 300, true);
    add_image_size('lp3aik-hero',    1600, 800, true);
    add_image_size('lp3aik-thumb-sm', 200, 160, true);

    // Navigation menu locations
    register_nav_menus([
        'primary'  => __('Primary Menu',    'lp3aik-umk'),
        'footer-1' => __('Footer Menu 1',   'lp3aik-umk'),
        'footer-2' => __('Footer Menu 2',   'lp3aik-umk'),
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
        'name'        => __('Blog Sidebar',    'lp3aik-umk'),
        'id'          => 'sidebar-blog',
        'description' => __('Widgets in the blog/news page sidebar.', 'lp3aik-umk'),
    ]));
    register_sidebar(array_merge($defaults, [
        'name'        => __('Page Sidebar',    'lp3aik-umk'),
        'id'          => 'sidebar-page',
        'description' => __('Widgets in the static page sidebar.', 'lp3aik-umk'),
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Column 1', 'lp3aik-umk'),
        'id'   => 'footer-1',
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Column 2', 'lp3aik-umk'),
        'id'   => 'footer-2',
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Column 3', 'lp3aik-umk'),
        'id'   => 'sidebar-footer-3',
    ]));
});
