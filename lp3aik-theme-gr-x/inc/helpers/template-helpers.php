<?php
/**
 * Template Helper Functions.
 *
 * Reusable helper functions for templates.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

/**
 * Get theme mod with a convenient wrapper.
 */
function lp3aik_opt(string $key, string $default = ''): string {
    return get_theme_mod($key, $default);
}

/**
 * Render section header (eyebrow + title + subtitle).
 */
function lp3aik_section_header(string $eyebrow, string $title, string $subtitle = '', bool $center = true): void {
    if ($center) echo '<div class="text-center">';
    echo '<span class="section-eyebrow">' . esc_html($eyebrow) . '</span>';
    echo '<h2 class="section-title">' . wp_kses_post($title) . '</h2>';
    if ($subtitle) echo '<p class="section-subtitle">' . esc_html($subtitle) . '</p>';
    if ($center) echo '</div>';
}

/**
 * Get post thumbnail URL with fallback.
 */
function lp3aik_thumb(int $post_id, string $size = 'lp3aik-card', string $fallback = ''): string {
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }
    return $fallback ?: LP3AIK_URI . '/assets/img/placeholder.jpg';
}

/**
 * Breadcrumb generator.
 */
function lp3aik_breadcrumb(): void {
    if (is_front_page()) return;

    $crumbs = ['<a href="' . home_url() . '">' . esc_html__('Beranda', 'lp3aik-umk') . '</a>'];

    if (is_singular()) {
        $post_type = get_post_type();

        // CPT single: add archive link as parent
        if ($post_type && !in_array($post_type, ['post', 'page'])) {
            $pt_obj = get_post_type_object($post_type);
            if ($pt_obj && $pt_obj->has_archive) {
                $archive_url = get_post_type_archive_link($post_type);
                $crumbs[] = '<a href="' . esc_url($archive_url) . '">' . esc_html($pt_obj->labels->name) . '</a>';
            }
        } elseif ($post_type === 'post') {
            // Regular post: add category
            if ($cat = get_the_category()) {
                $crumbs[] = '<a href="' . get_category_link($cat[0]->term_id) . '">' . esc_html($cat[0]->name) . '</a>';
            }
        }

        $crumbs[] = '<span>' . esc_html(get_the_title()) . '</span>';
    } elseif (is_post_type_archive()) {
        $crumbs[] = '<span>' . post_type_archive_title('', false) . '</span>';
    } elseif (is_category()) {
        $crumbs[] = '<span>' . single_cat_title('', false) . '</span>';
    } elseif (is_tag()) {
        $crumbs[] = '<span>' . single_tag_title('', false) . '</span>';
    } elseif (is_page()) {
        global $post;
        if ($post->post_parent) {
            $crumbs[] = '<a href="' . get_permalink($post->post_parent) . '">' . esc_html(get_the_title($post->post_parent)) . '</a>';
        }
        $crumbs[] = '<span>' . esc_html(get_the_title()) . '</span>';
    } elseif (is_search()) {
        $crumbs[] = '<span>' . sprintf(esc_html__('Pencarian: "%s"', 'lp3aik-umk'), esc_html(get_search_query())) . '</span>';
    } elseif (is_archive()) {
        $crumbs[] = '<span>' . get_the_archive_title() . '</span>';
    }

    echo implode('<span class="sep">›</span>', $crumbs);
}

/**
 * Social links array (filtered for non-empty URLs).
 */
function lp3aik_social_links(): array {
    return array_filter([
        'facebook'  => ['url' => lp3aik_opt('lp3aik_facebook'), 'icon' => 'fa-brands fa-facebook-f', 'label' => 'Facebook'],
        'instagram' => ['url' => lp3aik_opt('lp3aik_instagram'), 'icon' => 'fa-brands fa-instagram',  'label' => 'Instagram'],
        'youtube'   => ['url' => lp3aik_opt('lp3aik_youtube'),   'icon' => 'fa-brands fa-youtube',    'label' => 'YouTube'],
    ], fn($s) => !empty($s['url']));
}

/**
 * Render a Font Awesome icon. Falls back gracefully for old emoji data.
 */
function lp3aik_icon(string $icon_class, string $fallback_emoji = ''): string {
    if (str_starts_with($icon_class, 'fa-')) {
        return '<i class="fa-solid ' . esc_attr($icon_class) . '"></i>';
    }
    // Legacy emoji fallback
    if ($icon_class) {
        return '<i class="fa-solid fa-book-open"></i>';
    }
    return $fallback_emoji ? '<i class="fa-solid fa-book-open"></i>' : '';
}
