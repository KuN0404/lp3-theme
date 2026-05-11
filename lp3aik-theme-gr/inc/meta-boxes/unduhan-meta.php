<?php
/**
 * Meta Box: Unduhan / File Download.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('add_meta_boxes', function () {
    add_meta_box('lp3aik_unduhan_meta', __('File Unduhan','lp3aik-umk'), 'lp3aik_unduhan_meta_cb', 'lp3aik_unduhan', 'normal', 'high');
});

// Enqueue media script
add_action('admin_enqueue_scripts', function($hook) {
    global $post_type;
    if ($post_type === 'lp3aik_unduhan' && in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_media();
    }
});

function lp3aik_unduhan_meta_cb(WP_Post $post): void {
    wp_nonce_field('lp3aik_unduhan_meta', 'lp3aik_unduhan_nonce');
    $url    = get_post_meta($post->ID, '_unduhan_url',    true);
    $ukuran = get_post_meta($post->ID, '_unduhan_ukuran', true);
    $tipe   = get_post_meta($post->ID, '_unduhan_tipe',   true);
    ?>
    <table class="form-table">
        <tr>
            <th><?php _e('Pilih / Upload File','lp3aik-umk'); ?></th>
            <td>
                <input type="url" id="_unduhan_url" name="_unduhan_url" value="<?php echo esc_attr($url); ?>" class="large-text" placeholder="https://..." style="margin-bottom:8px;">
                <button type="button" class="button" id="lp3aik_upload_file_btn"><?php _e('Pilih File dari Media', 'lp3aik-umk'); ?></button>
                <p class="description"><?php _e('Klik tombol di atas untuk mengunggah file (PDF, Word, dll), atau masukkan link eksternal (Google Drive, dll).', 'lp3aik-umk'); ?></p>
            </td>
        </tr>
        <tr><th><?php _e('Ukuran File','lp3aik-umk'); ?></th><td><input name="_unduhan_ukuran" value="<?php echo esc_attr($ukuran); ?>" class="regular-text" placeholder="2.4 MB"></td></tr>
        <tr><th><?php _e('Tipe File','lp3aik-umk'); ?></th>
            <td><select name="_unduhan_tipe">
                <?php foreach(['PDF','DOCX','XLSX','PPT','ZIP','Lainnya'] as $t): ?>
                    <option value="<?php echo $t; ?>" <?php selected($tipe,$t); ?>><?php echo $t; ?></option>
                <?php endforeach; ?>
            </select></td></tr>
    </table>
    
    <script>
    jQuery(document).ready(function($){
        var mediaUploader;
        $('#lp3aik_upload_file_btn').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Pilih File Unduhan',
                button: { text: 'Gunakan File Ini' },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#_unduhan_url').val(attachment.url);
            });
            mediaUploader.open();
        });
    });
    </script>
    <?php
}

add_action('save_post_lp3aik_unduhan', function (int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['lp3aik_unduhan_nonce']) || !wp_verify_nonce($_POST['lp3aik_unduhan_nonce'], 'lp3aik_unduhan_meta')) return;

    if (isset($_POST['_unduhan_url']))    update_post_meta($post_id, '_unduhan_url', esc_url_raw($_POST['_unduhan_url']));
    if (isset($_POST['_unduhan_ukuran'])) update_post_meta($post_id, '_unduhan_ukuran', sanitize_text_field($_POST['_unduhan_ukuran']));
    if (isset($_POST['_unduhan_tipe']))   update_post_meta($post_id, '_unduhan_tipe', sanitize_text_field($_POST['_unduhan_tipe']));
});
