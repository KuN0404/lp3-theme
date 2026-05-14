<?php
/**
 * Page Template Registration, Routing & Auto-Create Pages.
 *
 * - Registers custom page templates in WP Admin dropdown.
 * - Routes CPT archives & singles to /templates/ files.
 * - Routes WordPress pages by slug to their template.
 * - Auto-creates required pages on theme activation.
 * - Adjusts CPT archive queries.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// =====================================================================
// CONSTANTS: Mapping slug → template file
// =====================================================================
define('LP3AIK_PAGE_TEMPLATES', [
    'profile'          => 'templates/page-profile.php',
    'vision-mission'   => 'templates/page-vision-mission.php',
    'org-structure'    => 'templates/page-org-structure.php',
    'news'             => 'templates/page-news.php',
    'contact'          => 'templates/page-contact.php',
    'faq'              => 'templates/page-faq.php',
]);

define('LP3AIK_PAGE_TITLES', [
    'profile'          => 'Profil LP3AIK',
    'vision-mission'   => 'Visi & Misi',
    'org-structure'    => 'Struktur Organisasi',
    'news'             => 'Berita & Pengumuman',
    'contact'          => 'Hubungi Kami',
    'faq'              => 'Pertanyaan Umum (FAQ)',
]);

// =====================================================================
// 1) REGISTER PAGE TEMPLATES (wp-admin dropdown)
// =====================================================================
add_filter('theme_page_templates', function (array $templates): array {
    foreach (LP3AIK_PAGE_TEMPLATES as $slug => $file) {
        $templates[$file] = LP3AIK_PAGE_TITLES[$slug] ?? ucfirst($slug);
    }
    return $templates;
});

// =====================================================================
// 2) MASTER TEMPLATE ROUTER — template_include filter
// =====================================================================
add_filter('template_include', function (string $template): string {
    $tpl_dir = get_template_directory() . '/templates/';

    // ── CPT Archives ────────────────────────────────────────
    $cpt_archives = [
        'lp3aik_program' => 'archive-lp3aik_program.php',
        'lp3aik_galeri'  => 'archive-lp3aik_gallery.php',
        'lp3aik_unduhan' => 'archive-lp3aik_downloads.php',
    ];
    foreach ($cpt_archives as $post_type => $file) {
        if (is_post_type_archive($post_type)) {
            $custom = $tpl_dir . $file;
            if (file_exists($custom)) return $custom;
        }
    }

    // ── CPT Singles ─────────────────────────────────────────
    $cpt_singles = [
        'lp3aik_program' => 'single-lp3aik_program.php',
        'lp3aik_galeri'  => 'single-lp3aik_gallery.php',
        'lp3aik_unduhan' => 'single-lp3aik_downloads.php',
    ];
    foreach ($cpt_singles as $post_type => $file) {
        if (is_singular($post_type)) {
            $custom = $tpl_dir . $file;
            if (file_exists($custom)) return $custom;
        }
    }

    // ── WordPress Pages — by slug ───────────────────────────
    if (is_page()) {
        $page_obj = get_queried_object();
        $slug     = $page_obj->post_name ?? '';

        // Check slug-based template mapping
        if (isset(LP3AIK_PAGE_TEMPLATES[$slug])) {
            $custom = get_template_directory() . '/' . LP3AIK_PAGE_TEMPLATES[$slug];
            if (file_exists($custom)) return $custom;
        }

        // Check _wp_page_template meta (set via WP Admin > Page Attributes)
        $meta_template = get_post_meta($page_obj->ID, '_wp_page_template', true);
        if ($meta_template && $meta_template !== 'default') {
            $custom = get_template_directory() . '/' . $meta_template;
            if (file_exists($custom)) return $custom;
        }
    }

    return $template;
}, 99);

// =====================================================================
// 3) AUTO-CREATE PAGES ON THEME ACTIVATION
// =====================================================================
add_action('after_switch_theme', 'lp3aik_create_theme_pages');

/**
 * Create required WordPress pages with correct template meta.
 */
function lp3aik_create_theme_pages(): void {
    foreach (LP3AIK_PAGE_TEMPLATES as $slug => $template_file) {
        $title = LP3AIK_PAGE_TITLES[$slug] ?? ucfirst($slug);

        // Check if page exists by slug
        $existing = get_page_by_path($slug);
        if ($existing) {
            // Ensure template is assigned
            update_post_meta($existing->ID, '_wp_page_template', $template_file);
            continue;
        }

        // Create the page
        $page_id = wp_insert_post([
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ]);

        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', $template_file);
        }
    }

    flush_rewrite_rules();
}

// Run once on first load if pages haven't been created yet
add_action('init', function () {
    if (!get_option('lp3aik_theme_pages_v6')) {
        lp3aik_create_theme_pages();
        update_option('lp3aik_theme_pages_v6', true);
    }
}, 20);

// =====================================================================
// 4) PROPER ARCHIVE TITLES (remove "Archives:" prefix)
// =====================================================================
add_filter('get_the_archive_title', function (string $title): string {
    if (is_post_type_archive('lp3aik_program')) return __('Program & Layanan AIK', 'lp3aik-umk');
    if (is_post_type_archive('lp3aik_galeri'))  return __('Galeri Kegiatan', 'lp3aik-umk');
    if (is_post_type_archive('lp3aik_unduhan')) return __('Unduhan / File', 'lp3aik-umk');
    if (is_category()) return single_cat_title('', false);
    if (is_tag())      return single_tag_title('', false);
    if (is_author())   return get_the_author();
    return $title;
});

// =====================================================================
// 5) ADJUST CPT ARCHIVE QUERIES
// =====================================================================
add_action('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query()) return;

    if (is_post_type_archive('lp3aik_galeri')) {
        $query->set('posts_per_page', -1);
    }
    if (is_post_type_archive('lp3aik_unduhan')) {
        $query->set('posts_per_page', -1);
    }
    if (is_post_type_archive('lp3aik_program')) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }

    if ($query->is_search()) {
        $query->set('post_type', 'post');
    }
});

// =====================================================================
// 6) FLUSH REWRITE ON THEME SWITCH
// =====================================================================
add_action('after_switch_theme', 'flush_rewrite_rules');
add_action('switch_theme', 'flush_rewrite_rules');

// =====================================================================
// 7) PREVENT EMPTY/WHITESPACE SEARCH FROM LISTING ALL POSTS
// =====================================================================
add_filter('posts_search', function (string $search, WP_Query $query): string {
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return $search;
    }

    $search_query = trim(get_query_var('s'));
    if (empty($search_query)) {
        // Force SQL query to immediately return 0 results (1=0 is always false)
        return ' AND 1=0 ';
    }

    return $search;
}, 20, 2);
