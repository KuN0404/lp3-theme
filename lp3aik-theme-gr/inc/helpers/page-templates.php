<?php
/**
 * Page Template Registration, Routing & Auto-Create Pages.
 *
 * Menangani semua routing template di luar WordPress Template Hierarchy standar:
 * - CPT archives & singles dari folder /templates/
 * - Page templates by slug (profil, berita, kontak, dll.)
 * - Auto-create halaman WordPress saat theme diaktifkan
 * - Virtual page fallback jika halaman belum ada di database
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// =====================================================================
// CONSTANTS: Mapping slug → template file
// =====================================================================
define('LP3AIK_PAGE_TEMPLATES', [
    'profil'                => 'templates/page-profil.php',
    'visi-misi'             => 'templates/page-visi-misi.php',
    'struktur-organisasi'   => 'templates/page-struktur-organisasi.php',
    'berita'                => 'templates/page-berita.php',
    'kontak'                => 'templates/page-kontak.php',
]);

define('LP3AIK_PAGE_TITLES', [
    'profil'                => 'Profil LP3AIK',
    'visi-misi'             => 'Visi & Misi',
    'struktur-organisasi'   => 'Struktur Organisasi',
    'berita'                => 'Berita & Pengumuman',
    'kontak'                => 'Hubungi Kami',
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
//    Handles ALL custom routing: CPT archives, CPT singles, page slugs.
// =====================================================================
add_filter('template_include', function (string $template): string {
    $tpl_dir = get_template_directory() . '/templates/';

    // ── CPT Archives ────────────────────────────────────────
    $cpt_archives = [
        'lp3aik_program' => 'archive-lp3aik_program.php',
        'lp3aik_galeri'  => 'archive-lp3aik_galeri.php',
        'lp3aik_unduhan' => 'archive-lp3aik_unduhan.php',
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
        'lp3aik_galeri'  => 'single-lp3aik_galeri.php',
        'lp3aik_unduhan' => 'single-lp3aik_unduhan.php',
    ];
    foreach ($cpt_singles as $post_type => $file) {
        if (is_singular($post_type)) {
            $custom = $tpl_dir . $file;
            if (file_exists($custom)) return $custom;
        }
    }

    // ── WordPress Pages — by slug ───────────────────────────
    // If WordPress found a page, route to its template
    if (is_page()) {
        $page_obj = get_queried_object();
        $slug = $page_obj->post_name ?? '';

        if (isset(LP3AIK_PAGE_TEMPLATES[$slug])) {
            $custom = get_template_directory() . '/' . LP3AIK_PAGE_TEMPLATES[$slug];
            if (file_exists($custom)) return $custom;
        }

        // Also check _wp_page_template meta
        $meta_template = get_post_meta($page_obj->ID, '_wp_page_template', true);
        if ($meta_template && $meta_template !== 'default') {
            $custom = get_template_directory() . '/' . $meta_template;
            if (file_exists($custom)) return $custom;
        }
    }

    // ── Virtual Page Fallback — when pages don't exist in DB ──
    // If WordPress returned 404 but the URL matches a known slug,
    // load the template anyway and set proper headers.
    if (is_404()) {
        $request_path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
        // Remove any WordPress subdirectory prefix
        $home_path = trim(parse_url(home_url(), PHP_URL_PATH) ?? '', '/');
        if ($home_path && strpos($request_path, $home_path) === 0) {
            $request_path = trim(substr($request_path, strlen($home_path)), '/');
        }
        $slug = sanitize_title($request_path);

        if (isset(LP3AIK_PAGE_TEMPLATES[$slug])) {
            $custom = get_template_directory() . '/' . LP3AIK_PAGE_TEMPLATES[$slug];
            if (file_exists($custom)) {
                // Override 404 status
                global $wp_query;
                status_header(200);
                $wp_query->is_404 = false;
                $wp_query->is_page = true;

                // Create a virtual post object for the_title() etc.
                $virtual_post = new stdClass();
                $virtual_post->ID = 0;
                $virtual_post->post_title = LP3AIK_PAGE_TITLES[$slug] ?? ucfirst($slug);
                $virtual_post->post_name = $slug;
                $virtual_post->post_content = '';
                $virtual_post->post_excerpt = '';
                $virtual_post->post_status = 'publish';
                $virtual_post->post_type = 'page';
                $virtual_post->post_date = current_time('mysql');
                $virtual_post->post_author = 1;
                $virtual_post->comment_status = 'closed';
                $virtual_post->ping_status = 'closed';
                $virtual_post->filter = 'raw';

                $wp_query->posts = [new WP_Post($virtual_post)];
                $wp_query->post_count = 1;
                $wp_query->found_posts = 1;
                $wp_query->post = $wp_query->posts[0];

                $GLOBALS['post'] = $wp_query->post;
                setup_postdata($GLOBALS['post']);

                return $custom;
            }
        }
    }

    return $template;
}, 99); // Priority 99 to run after other filters

// =====================================================================
// 3) AUTO-CREATE PAGES ON THEME ACTIVATION
// =====================================================================
add_action('after_switch_theme', 'lp3aik_create_theme_pages');

/**
 * Create required WordPress pages with correct template meta.
 * Also runs once on first load via init hook.
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

// Run once on first load if pages haven't been created yet or to force URL cleanup
add_action('init', function () {
    if (!get_option('lp3aik_theme_pages_v4')) {
        // 1. Force permalink structure to absolutely clean Post Name
        global $wp_rewrite;
        update_option('permalink_structure', '/%postname%/');
        $wp_rewrite->set_permalink_structure('/%postname%/');
        
        // 2. Create pages
        lp3aik_create_theme_pages();
        
        // 3. Flush rewrite rules immediately
        flush_rewrite_rules(true); // pass true to also recreate .htaccess
        
        update_option('lp3aik_theme_pages_v4', true);
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
});

// =====================================================================
// 6) CATEGORY & TAXONOMY: Use slug-based permalinks
// =====================================================================
add_filter('category_link', function (string $link, int $cat_id): string {
    $category = get_category($cat_id);
    if ($category && !is_wp_error($category)) {
        return home_url('/category/' . $category->slug . '/');
    }
    return $link;
}, 10, 2);

add_filter('tag_link', function (string $link, int $tag_id): string {
    $tag = get_tag($tag_id);
    if ($tag && !is_wp_error($tag)) {
        return home_url('/tag/' . $tag->slug . '/');
    }
    return $link;
}, 10, 2);

// =====================================================================
// 7) FLUSH REWRITE ON THEME SWITCH
// =====================================================================
add_action('after_switch_theme', 'flush_rewrite_rules');
add_action('switch_theme', 'flush_rewrite_rules');

// End of file
