<?php
/**
 * Page Template Registration, Routing & Auto-Create Pages.
 *
 * - Registers custom page templates in WP admin dropdown.
 * - Routes CPT archives + singles to /templates/ folder.
 * - Routes WP pages to slug-matching templates.
 * - Auto-creates required pages on theme activation.
 *
 * NO permalink structure override — WP manages permalinks natively.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// ── Slug → Template mapping ───────────────────────────────────
const LP3AIK_PAGE_TEMPLATES = [
    'profil'                => 'templates/page-profil.php',
    'visi-misi'             => 'templates/page-visi-misi.php',
    'struktur-organisasi'   => 'templates/page-struktur-organisasi.php',
    'berita'                => 'templates/page-berita.php',
    'kontak'                => 'templates/page-kontak.php',
];

const LP3AIK_PAGE_TITLES = [
    'profil'                => 'Profil LP3AIK',
    'visi-misi'             => 'Visi & Misi',
    'struktur-organisasi'   => 'Struktur Organisasi',
    'berita'                => 'Berita & Pengumuman',
    'kontak'                => 'Hubungi Kami',
];

// ── 1) Register templates in WP admin Page Attributes ────────
add_filter('theme_page_templates', function (array $templates): array {
    foreach (LP3AIK_PAGE_TEMPLATES as $slug => $file) {
        $templates[$file] = LP3AIK_PAGE_TITLES[$slug] ?? ucfirst($slug);
    }
    return $templates;
});

// ── 2) Master Template Router ─────────────────────────────────
add_filter('template_include', function (string $template): string {
    $tpl_dir = get_template_directory() . '/templates/';

    // CPT Archives
    $cpt_archives = [
        'lp3aik_program'  => 'archive-lp3aik_program.php',
        'lp3aik_galeri'   => 'archive-lp3aik_galeri.php',
        'lp3aik_unduhan'  => 'archive-lp3aik_unduhan.php',
    ];
    foreach ($cpt_archives as $post_type => $file) {
        if (is_post_type_archive($post_type)) {
            $custom = $tpl_dir . $file;
            if (file_exists($custom)) return $custom;
        }
    }

    // CPT Singles
    $cpt_singles = [
        'lp3aik_program'  => 'single-lp3aik_program.php',
        'lp3aik_galeri'   => 'single-lp3aik_galeri.php',
        'lp3aik_unduhan'  => 'single-lp3aik_unduhan.php',
    ];
    foreach ($cpt_singles as $post_type => $file) {
        if (is_singular($post_type)) {
            $custom = $tpl_dir . $file;
            if (file_exists($custom)) return $custom;
        }
    }

    // WP Pages — match by slug
    if (is_page()) {
        $page_obj = get_queried_object();
        $slug     = $page_obj->post_name ?? '';

        // Check _wp_page_template meta first (set via WP admin or auto-create)
        $meta_tpl = get_post_meta($page_obj->ID, '_wp_page_template', true);
        if ($meta_tpl && $meta_tpl !== 'default') {
            $custom = get_template_directory() . '/' . $meta_tpl;
            if (file_exists($custom)) return $custom;
        }

        // Fallback: slug-based matching
        if (isset(LP3AIK_PAGE_TEMPLATES[$slug])) {
            $custom = get_template_directory() . '/' . LP3AIK_PAGE_TEMPLATES[$slug];
            if (file_exists($custom)) return $custom;
        }
    }

    return $template;
}, 99);

// ── 3) Auto-Create Pages on Theme Activation ─────────────────
add_action('after_switch_theme', 'lp3aik_create_theme_pages');
add_action('init', function (): void {
    if (! get_option('lp3aik_pages_created_v3')) {
        lp3aik_create_theme_pages();
        update_option('lp3aik_pages_created_v3', true);
    }
}, 20);

function lp3aik_create_theme_pages(): void {
    foreach (LP3AIK_PAGE_TEMPLATES as $slug => $template_file) {
        $title    = LP3AIK_PAGE_TITLES[$slug] ?? ucfirst(str_replace('-', ' ', $slug));
        $existing = get_page_by_path($slug);

        if ($existing) {
            // Ensure template meta is assigned
            if (get_post_meta($existing->ID, '_wp_page_template', true) !== $template_file) {
                update_post_meta($existing->ID, '_wp_page_template', $template_file);
            }
            continue;
        }

        $page_id = wp_insert_post([
            'post_title'     => $title,
            'post_name'      => $slug,
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_content'   => '',
            'comment_status' => 'closed',
        ]);

        if ($page_id && ! is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', $template_file);
        }
    }

    flush_rewrite_rules();
}

// ── 4) Clean Archive Titles ───────────────────────────────────
add_filter('get_the_archive_title', function (string $title): string {
    if (is_post_type_archive('lp3aik_program'))  return __('Program & Layanan AIK', 'lp3aik-umk');
    if (is_post_type_archive('lp3aik_galeri'))   return __('Galeri Kegiatan', 'lp3aik-umk');
    if (is_post_type_archive('lp3aik_unduhan'))  return __('Unduhan / File', 'lp3aik-umk');
    if (is_category()) return single_cat_title('', false);
    if (is_tag())      return single_tag_title('', false);
    if (is_author())   return get_the_author();
    return $title;
});

// ── 5) Adjust CPT Archive Queries ────────────────────────────
add_action('pre_get_posts', function (WP_Query $query): void {
    if (is_admin() || ! $query->is_main_query()) return;

    if (is_post_type_archive('lp3aik_galeri')) {
        $query->set('posts_per_page', 12);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }

    if (is_post_type_archive('lp3aik_program')) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }

    if (is_post_type_archive('lp3aik_unduhan')) {
        $query->set('posts_per_page', 20);
    }
});
