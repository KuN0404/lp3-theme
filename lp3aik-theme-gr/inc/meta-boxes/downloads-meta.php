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
                <button type="button" class="button button-secondary" id="lp3aik_upload_file_btn">
                    <span class="dashicons dashicons-upload" style="margin-top:3px; margin-right:3px;"></span>
                    <?php _e('Pilih File dari Media', 'lp3aik-umk'); ?>
                </button>
                <p class="description"><?php _e('Klik tombol di atas untuk mengunggah file, atau masukkan link eksternal.', 'lp3aik-umk'); ?></p>
            </td>
        </tr>
        <tr>
            <th><?php _e('Ukuran File','lp3aik-umk'); ?></th>
            <td>
                <input name="_unduhan_ukuran" id="_unduhan_ukuran" value="<?php echo esc_attr($ukuran); ?>" class="regular-text" placeholder="2.4 MB">
                <p class="description"><?php _e('Terisi otomatis jika Anda memilih file dari Media Library.', 'lp3aik-umk'); ?></p>
            </td>
        </tr>
        <tr>
            <th><?php _e('Tipe File','lp3aik-umk'); ?></th>
            <td>
                <select name="_unduhan_tipe" id="_unduhan_tipe">
                    <?php foreach(['PDF','DOCX','XLSX','PPT','ZIP','Lainnya'] as $t): ?>
                        <option value="<?php echo $t; ?>" <?php selected($tipe,$t); ?>><?php echo $t; ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="description"><?php _e('Terdeteksi otomatis dari ekstensi file.', 'lp3aik-umk'); ?></p>
            </td>
        </tr>
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
                title: '<?php esc_js(_e("Pilih File Unduhan", "lp3aik-umk")); ?>',
                button: { text: '<?php esc_js(_e("Gunakan File Ini", "lp3aik-umk")); ?>' },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#_unduhan_url').val(attachment.url);
                
                // ── FITUR CERDAS: Cek & Isi Ukuran File Otomatis ────────────────────
                if (attachment.filesizeHumanReadable) {
                    $('#_unduhan_ukuran').val(attachment.filesizeHumanReadable);
                } else if (attachment.filesizeInBytes) {
                    var kb = attachment.filesizeInBytes / 1024;
                    var formatted = (kb >= 1024) ? (kb / 1024).toFixed(1) + ' MB' : Math.round(kb) + ' KB';
                    $('#_unduhan_ukuran').val(formatted);
                }
                
                // ── FITUR CERDAS: Deteksi & Pilih Tipe Otomatis ──────────────────────
                var ext = attachment.url.split('.').pop().toUpperCase();
                var knownTypes = ['PDF', 'DOCX', 'XLSX', 'PPT', 'ZIP'];
                if (knownTypes.indexOf(ext) !== -1) {
                    $('#_unduhan_tipe').val(ext);
                } else if (ext === 'DOC') {
                    $('#_unduhan_tipe').val('DOCX');
                } else if (ext === 'XLS') {
                    $('#_unduhan_tipe').val('XLSX');
                } else {
                    $('#_unduhan_tipe').val('Lainnya');
                }
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
