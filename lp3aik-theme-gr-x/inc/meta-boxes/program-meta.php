<?php
/**
 * Meta Box: Program Detail.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('add_meta_boxes', function () {
    add_meta_box(
        'lp3aik_program_meta',
        __('Detail Program', 'lp3aik-umk'),
        'lp3aik_program_meta_cb',
        'lp3aik_program',
        'normal',
        'high'
    );
});

/**
 * Render program meta box fields.
 */
function lp3aik_program_meta_cb(WP_Post $post): void {
    wp_nonce_field('lp3aik_program_meta', 'lp3aik_program_nonce');

    $icon    = get_post_meta($post->ID, '_program_icon',       true);
    $durasi  = get_post_meta($post->ID, '_program_durasi',     true);
    $sasaran = get_post_meta($post->ID, '_program_sasaran',    true);
    $link    = get_post_meta($post->ID, '_program_link_daftar', true);
    ?>
    <table class="form-table">
        <tr>
            <th><?php _e('Ikon (Font Awesome class)', 'lp3aik-umk'); ?></th>
            <td><input name="_program_icon" value="<?php echo esc_attr($icon); ?>" class="regular-text" placeholder="fa-book-open"></td>
        </tr>
        <tr>
            <th><?php _e('Durasi', 'lp3aik-umk'); ?></th>
            <td><input name="_program_durasi" value="<?php echo esc_attr($durasi); ?>" class="regular-text" placeholder="1 Semester"></td>
        </tr>
        <tr>
            <th><?php _e('Sasaran Peserta', 'lp3aik-umk'); ?></th>
            <td><input name="_program_sasaran" value="<?php echo esc_attr($sasaran); ?>" class="regular-text" placeholder="Mahasiswa baru, dosen ..."></td>
        </tr>
        <tr>
            <th><?php _e('Link Pendaftaran', 'lp3aik-umk'); ?></th>
            <td><input name="_program_link_daftar" value="<?php echo esc_attr($link); ?>" type="url" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

/**
 * Save program meta data with proper nonce verification.
 */
add_action('save_post_lp3aik_program', function (int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['lp3aik_program_nonce']) || !wp_verify_nonce($_POST['lp3aik_program_nonce'], 'lp3aik_program_meta')) return;

    $fields = ['_program_icon', '_program_durasi', '_program_sasaran'];
    foreach ($fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
        }
    }

    // URL field gets esc_url_raw
    if (isset($_POST['_program_link_daftar'])) {
        update_post_meta($post_id, '_program_link_daftar', esc_url_raw($_POST['_program_link_daftar']));
    }
});
