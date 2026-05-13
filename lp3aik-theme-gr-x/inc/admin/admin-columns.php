<?php
/**
 * Admin Column Customizations.
 * Refactored to support custom Jabatan meta and include avatar column from Theme 2.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// ── Team (lp3aik_tim) custom columns ────────────────────────
add_filter('manage_lp3aik_tim_posts_columns', function (array $cols): array {
    return array_merge(
        ['cb' => $cols['cb']],
        [
            'avatar'  => __('Foto',       'lp3aik-umk'),
            'title'   => $cols['title'],
            'jabatan' => __('Jabatan',    'lp3aik-umk'),
            'unit'    => __('Unit/Divisi','lp3aik-umk'),
            'nip'     => __('NIP/NIDN',   'lp3aik-umk'),
            'order'   => __('Urutan',     'lp3aik-umk'),
        ],
        ['date' => $cols['date']]
    );
});

add_action('manage_lp3aik_tim_posts_custom_column', function (string $col, int $id): void {
    switch ($col) {
        case 'avatar':
            $thumb = get_the_post_thumbnail($id, [45, 45]);
            if ($thumb) {
                echo '<div style="width:45px;height:45px;overflow:hidden;border-radius:50%;border:1px solid #ddd;">' . $thumb . '</div>';
            } else {
                echo '<span class="dashicons dashicons-admin-users" style="font-size:2rem;color:#ccc;height:45px;width:45px;display:flex;align-items:center;justify-content:center;"></span>';
            }
            break;
            
        case 'jabatan':
            echo esc_html(get_post_meta($id, '_tim_jabatan', true) ?: '—');
            break;
            
        case 'unit':
            echo esc_html(get_post_meta($id, '_tim_unit', true) ?: '—');
            break;
            
        case 'nip':
            echo esc_html(get_post_meta($id, '_tim_nip', true) ?: '—');
            break;
            
        case 'order':
            echo esc_html(get_post_field('menu_order', $id) ?: '0');
            break;
    }
}, 10, 2);

// Sortable order column
add_filter('manage_edit-lp3aik_tim_sortable_columns', function(array $cols): array {
    $cols['order'] = 'menu_order';
    return $cols;
});

// ── Program (lp3aik_program) custom columns ─────────────────────
add_filter('manage_lp3aik_program_posts_columns', function (array $cols): array {
    return array_merge(
        ['cb' => $cols['cb']],
        [
            'prog_thumb' => __('Foto / Banner',  'lp3aik-umk'),
            'title'      => $cols['title'],
            'prioritas'  => __('Prioritas',     'lp3aik-umk'),
            'kategori'   => __('Kategori',      'lp3aik-umk'),
        ],
        ['date' => $cols['date']]
    );
});

add_action('manage_lp3aik_program_posts_custom_column', function (string $col, int $id): void {
    switch ($col) {
        case 'prog_thumb':
            $thumb = get_the_post_thumbnail($id, [70, 45]);
            if ($thumb) {
                echo '<div style="border-radius:4px;border:1px solid #ddd;overflow:hidden;width:70px;height:45px;display:flex;align-items:center;justify-content:center;background:#f9f9f9;">' . $thumb . '</div>';
            } else {
                echo '<div style="background:#eee;border:1px dashed #ccc;width:70px;height:45px;border-radius:4px;display:flex;align-items:center;justify-content:center;"><span class="dashicons dashicons-format-image" style="color:#aaa;"></span></div>';
            }
            break;
            
        case 'prioritas':
            $is_prio = get_post_meta($id, '_program_prioritas', true) === 'yes';
            if ($is_prio) {
                echo '<span class="dashicons dashicons-star-filled" style="color:#f0b849;font-size:20px;width:20px;height:20px;vertical-align:middle;" title="' . esc_attr__('Diprioritaskan di Beranda Utama','lp3aik-umk') . '"></span> <strong style="color:#d58800;font-size:12px;">' . __('YA','lp3aik-umk') . '</strong>';
            } else {
                echo '<span style="color:#ccc;font-size:12px;">' . __('Tidak','lp3aik-umk') . '</span>';
            }
            break;

        case 'kategori':
            $terms = get_the_terms($id, 'kategori_program');
            if ($terms && !is_wp_error($terms)) {
                $out = array_map(fn($t) => $t->name, $terms);
                echo esc_html(implode(', ', $out));
            } else {
                echo '<span style="color:#bbb;">—</span>';
            }
            break;
    }
}, 10, 2);
