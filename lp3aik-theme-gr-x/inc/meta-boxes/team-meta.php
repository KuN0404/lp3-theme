<?php
/**
 * Meta Box: Tim / Pengurus Detail.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('add_meta_boxes', function () {
    add_meta_box('lp3aik_tim_meta', __('Detail Anggota Tim','lp3aik-umk'), 'lp3aik_tim_meta_cb', 'lp3aik_tim', 'normal', 'high');
});

function lp3aik_tim_meta_cb(WP_Post $post): void {
    wp_nonce_field('lp3aik_tim_meta', 'lp3aik_tim_nonce');
    $nidn    = get_post_meta($post->ID, '_tim_nidn',    true);
    $email   = get_post_meta($post->ID, '_tim_email',   true);
    $prodi   = get_post_meta($post->ID, '_tim_prodi',   true);
    ?>
    <p><em><?php _e('Catatan: Untuk mengatur Jabatan (Ketua, Anggota, dll), silakan gunakan kotak <strong>Jabatan</strong> di sebelah kanan layar.', 'lp3aik-umk'); ?></em></p>
    <table class="form-table">
        <tr><th><?php _e('NIDN/NIM','lp3aik-umk'); ?></th><td><input name="_tim_nidn" value="<?php echo esc_attr($nidn); ?>" class="regular-text"></td></tr>
        <tr><th><?php _e('Program Studi','lp3aik-umk'); ?></th><td><input name="_tim_prodi" value="<?php echo esc_attr($prodi); ?>" class="regular-text"></td></tr>
        <tr><th><?php _e('Email','lp3aik-umk'); ?></th><td><input name="_tim_email" value="<?php echo esc_attr($email); ?>" type="email" class="regular-text"></td></tr>
    </table>
    <?php
}

add_action('save_post_lp3aik_tim', function (int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['lp3aik_tim_nonce']) || !wp_verify_nonce($_POST['lp3aik_tim_nonce'], 'lp3aik_tim_meta')) return;

    foreach (['_tim_nidn', '_tim_prodi'] as $key) {
        if (isset($_POST[$key])) update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
    }
    if (isset($_POST['_tim_email'])) {
        update_post_meta($post_id, '_tim_email', sanitize_email($_POST['_tim_email']));
    }
});
