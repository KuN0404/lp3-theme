<?php
/**
 * Admin Column Customizations.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// ── Team (lp3aik_tim) custom columns ────────────────────────
add_filter('manage_lp3aik_tim_posts_columns', function (array $cols): array {
    return array_merge(
        ['cb' => $cols['cb'], 'title' => $cols['title']],
        [
            'jabatan' => __('Position',  'lp3aik-umk'),
            'nidn'    => __('NIDN/NIM',  'lp3aik-umk'),
            'email'   => __('Email',     'lp3aik-umk'),
            'order'   => __('Order',     'lp3aik-umk'),
        ],
        ['date' => $cols['date']]
    );
});

add_action('manage_lp3aik_tim_posts_custom_column', function (string $col, int $id): void {
    match ($col) {
        'jabatan' => print esc_html(get_post_meta($id, '_tim_jabatan', true)),
        'nidn'    => print esc_html(get_post_meta($id, '_tim_nidn', true)),
        'email'   => print (
            ($email = get_post_meta($id, '_tim_email', true))
                ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>'
                : '—'
        ),
        'order'   => print esc_html(get_post_field('menu_order', $id)),
        default   => '',
    };
}, 10, 2);
