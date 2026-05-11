<?php
function lp3aik_theme_setup() {
    load_theme_textdomain('lp3aik', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ]);

    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    add_image_size('lp3aik-card', 416, 277, true);
    add_image_size('lp3aik-gallery', 600, 400, true);
    add_image_size('lp3aik-hero', 1920, 600, true);

    register_nav_menus([
        'primary' => 'Menu Utama',
        'footer'  => 'Menu Footer',
        'topbar'  => 'Menu Topbar (Opsional)',
    ]);

    register_sidebar([
        'id'            => 'sidebar-berita',
        'name'          => 'Sidebar Berita',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ]);

    register_sidebar([
        'id'            => 'footer-col-1',
        'name'          => 'Footer Kolom 1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ]);

    register_sidebar([
        'id'            => 'footer-col-2',
        'name'          => 'Footer Kolom 2',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ]);

    register_sidebar([
        'id'            => 'footer-col-3',
        'name'          => 'Footer Kolom 3',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ]);
}
add_action('after_setup_theme', 'lp3aik_theme_setup');

function lp3aik_register_all_cpt() {
    if (function_exists('lp3aik_register_cpt_org_structure')) {
        lp3aik_register_cpt_org_structure();
    }
    if (function_exists('lp3aik_register_cpt_program')) {
        lp3aik_register_cpt_program();
    }
    if (function_exists('lp3aik_register_cpt_galeri')) {
        lp3aik_register_cpt_galeri();
    }
    if (function_exists('lp3aik_register_cpt_unduhan')) {
        lp3aik_register_cpt_unduhan();
    }
    if (function_exists('lp3aik_register_taxonomies')) {
        lp3aik_register_taxonomies();
    }
}

function lp3aik_default_menu() {
    $items = [
        ['title' => 'Beranda',           'url' => home_url('/')],
        [
            'title'    => 'Tentang LP3AIK',
            'url'      => '#',
            'children' => [
                ['title' => 'Deskripsi Singkat',    'url' => home_url('/about/')],
                ['title' => 'Visi dan Misi',        'url' => home_url('/vision-mission/')],
                ['title' => 'Struktur Organisasi',  'url' => home_url('/organization/')],
            ],
        ],
        ['title' => 'Program',             'url' => home_url('/programs/')],
        ['title' => 'Berita',              'url' => home_url('/news/')],
        ['title' => 'Galeri',              'url' => home_url('/gallery/')],
        ['title' => 'Unduhan',             'url' => home_url('/downloads/')],
        ['title' => 'FAQ',                 'url' => home_url('/faq/')],
        ['title' => 'Kontak',              'url' => home_url('/contact/')],
    ];

    $icon_map = [
        'Beranda'            => 'bi-house',
        'Tentang LP3AIK'     => 'bi-building',
        'Program'            => 'bi-book',
        'Berita'             => 'bi-newspaper',
        'Galeri'             => 'bi-images',
        'Unduhan'            => 'bi-download',
        'FAQ'                => 'bi-question-circle',
        'Kontak'             => 'bi-envelope',
        'Deskripsi Singkat'   => 'bi-info-circle',
        'Visi dan Misi'       => 'bi-eye',
        'Struktur Organisasi' => 'bi-diagram-3',
    ];

    $current = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    $html = '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
    foreach ($items as $item) {
        $has_children = isset($item['children']);
        $url = $item['url'];
        $item_current = ($url !== '#' && $current === trim(parse_url($url, PHP_URL_PATH), '/'));
        $icon = isset($icon_map[$item['title']]) ? $icon_map[$item['title']] : 'bi-chevron-right';

        if ($has_children) {
            $child_current = false;
            foreach ($item['children'] as $child) {
                if ($current === trim(parse_url($child['url'], PHP_URL_PATH), '/')) {
                    $child_current = true;
                    break;
                }
            }
            $active_class = $child_current ? ' active' : '';
            $html .= '<li class="nav-item dropdown">';
            $html .= '<a class="nav-link dropdown-toggle' . $active_class . '" href="#" data-bs-toggle="dropdown" aria-expanded="false">';
            $html .= '<i class="bi ' . $icon . ' me-1"></i>' . esc_html($item['title']) . '</a>';
            $html .= '<ul class="dropdown-menu shadow border-0" style="border-radius:var(--border-radius-md);">';
            foreach ($item['children'] as $child) {
                $child_icon = isset($icon_map[$child['title']]) ? $icon_map[$child['title']] : 'bi-chevron-right';
                $html .= '<li><a class="dropdown-item py-2" href="' . esc_url($child['url']) . '">';
                $html .= '<i class="bi ' . $child_icon . ' me-2"></i>' . esc_html($child['title']) . '</a></li>';
            }
            $html .= '</ul></li>';
        } else {
            $active_class = $item_current ? ' active' : '';
            $html .= '<li class="nav-item">';
            $html .= '<a class="nav-link' . $active_class . '" href="' . esc_url($url) . '">';
            $html .= '<i class="bi ' . $icon . ' me-1"></i>' . esc_html($item['title']) . '</a>';
            $html .= '</li>';
        }
    }
    $html .= '</ul>';
    return $html;
}

function lp3aik_maybe_flush_rewrites() {
    if (get_option('lp3aik_rewrite_version') !== LP3AIK_VERSION) {
        lp3aik_register_all_cpt();
        flush_rewrite_rules();
        update_option('lp3aik_rewrite_version', LP3AIK_VERSION);
    }
    if (get_option('lp3aik_pages_version') !== LP3AIK_VERSION) {
        lp3aik_install_pages();
    }
}
add_action('init', 'lp3aik_maybe_flush_rewrites', 99);

add_action('after_switch_theme', 'lp3aik_register_all_cpt');
add_action('after_switch_theme', function() {
    lp3aik_register_all_cpt();
    flush_rewrite_rules();
});
