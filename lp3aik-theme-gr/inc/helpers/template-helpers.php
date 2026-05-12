<?php
/**
 * Template Helper Functions.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

/**
 * Get theme option from customizer with fallback.
 */
function lp3aik_opt(string $key, string $default = ''): string {
    $val = get_theme_mod($key, $default);
    return $val !== '' ? $val : $default;
}

/**
 * Build social links array from customizer settings.
 *
 * @return array<int, array{url: string, icon: string, label: string}>
 */
function lp3aik_social_links(): array {
    $links = [];
    $networks = [
        'facebook'  => ['icon' => 'fa-brands fa-facebook-f',  'label' => 'Facebook'],
        'instagram' => ['icon' => 'fa-brands fa-instagram',    'label' => 'Instagram'],
        'youtube'   => ['icon' => 'fa-brands fa-youtube',      'label' => 'YouTube'],
        'twitter'   => ['icon' => 'fa-brands fa-x-twitter',    'label' => 'X / Twitter'],
        'whatsapp'  => ['icon' => 'fa-brands fa-whatsapp',     'label' => 'WhatsApp'],
    ];

    foreach ($networks as $key => $meta) {
        $url = lp3aik_opt("lp3aik_{$key}");
        if ($url) {
            $links[] = [
                'url'   => $url,
                'icon'  => $meta['icon'],
                'label' => $meta['label'],
            ];
        }
    }
    return $links;
}

/**
 * Output breadcrumb trail.
 */
function lp3aik_breadcrumb(): void {
    $sep = '<span class="sep" aria-hidden="true">›</span>';
    echo '<a href="' . esc_url(home_url('/')) . '">' . __('Beranda', 'lp3aik-umk') . '</a>';

    if (is_single() || is_page()) {
        echo $sep;
        if (is_single() && ($cats = get_the_category())) {
            echo '<a href="' . esc_url(get_category_link($cats[0]->term_id)) . '">'
                . esc_html($cats[0]->name) . '</a>' . $sep;
        }
        echo '<span>' . get_the_title() . '</span>';
    } elseif (is_category()) {
        echo $sep . '<span>' . single_cat_title('', false) . '</span>';
    } elseif (is_tag()) {
        echo $sep . '<span>' . single_tag_title('', false) . '</span>';
    } elseif (is_post_type_archive()) {
        echo $sep . '<span>' . post_type_archive_title('', false) . '</span>';
    } elseif (is_archive()) {
        echo $sep . '<span>' . get_the_archive_title() . '</span>';
    } elseif (is_search()) {
        echo $sep . '<span>' . sprintf(__('Hasil: "%s"', 'lp3aik-umk'), get_search_query()) . '</span>';
    } elseif (is_404()) {
        echo $sep . '<span>404</span>';
    }
}

/**
 * Render placeholder image block (no thumbnail fallback).
 *
 * @param string $icon  FA icon class e.g. 'fa-newspaper'
 * @param string $extra Additional inline classes
 */
function lp3aik_placeholder(string $icon = 'fa-image', string $extra = ''): void {
    echo '<div class="card__image-placeholder ' . esc_attr($extra) . '">';
    echo '<i class="fa-solid ' . esc_attr($icon) . '"></i>';
    echo '</div>';
}

/**
 * Get post reading time estimate (words / 200 wpm).
 */
function lp3aik_reading_time(): string {
    $word_count  = str_word_count(strip_tags(get_the_content()));
    $minutes     = (int) ceil($word_count / 200);
    return sprintf(_n('%d menit', '%d menit', $minutes, 'lp3aik-umk'), $minutes);
}
