<?php
/**
 * Admin Column Customizations.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Tim columns
add_filter('manage_lp3aik_tim_posts_columns', function (array $cols): array {
    return array_merge(['cb' => $cols['cb'], 'title' => $cols['title']], [
        'jabatan' => __('Jabatan', 'lp3aik-umk'),
        'nidn'    => __('NIDN',    'lp3aik-umk'),
        'email'   => __('Email',   'lp3aik-umk'),
        'order'   => __('Urutan',  'lp3aik-umk'),
    ], ['date' => $cols['date']]);
});

add_action('manage_lp3aik_tim_posts_custom_column', function (string $col, int $id): void {
    match($col) {
        'jabatan' => print esc_html(get_post_meta($id, '_tim_jabatan', true)),
        'nidn'    => print esc_html(get_post_meta($id, '_tim_nidn', true)),
        'email'   => print '<a href="mailto:' . esc_attr(get_post_meta($id, '_tim_email', true)) . '">' . esc_html(get_post_meta($id, '_tim_email', true)) . '</a>',
        'order'   => print esc_html(get_post_field('menu_order', $id)),
        default   => '',
    };
}, 10, 2);
