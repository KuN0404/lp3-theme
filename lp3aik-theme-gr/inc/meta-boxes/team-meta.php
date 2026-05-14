<?php
/**
 * Meta Box: Tim / Pengurus Detail.
 * Refactored to match Theme 2 structure & inputs EXACTLY.
 * 
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('add_meta_boxes', 'lp3aik_add_tim_meta_box');
function lp3aik_add_tim_meta_box() {
    add_meta_box(
        'lp3aik_tim_meta', 
        '<span class="dashicons dashicons-businessperson" style="margin-right:6px;"></span> ' . __('Detail Anggota Tim','lp3aik-umk'), 
        'lp3aik_tim_meta_cb', 
        'lp3aik_tim', 
        'normal', 
        'high'
    );
}

function lp3aik_tim_meta_cb(WP_Post $post): void {
    wp_nonce_field('lp3aik_tim_meta_save', 'lp3aik_tim_nonce');
    
    // Retrieve values
    $jabatan = get_post_meta($post->ID, '_tim_jabatan', true);
    $unit    = get_post_meta($post->ID, '_tim_unit',    true);
    $nip     = get_post_meta($post->ID, '_tim_nip',     true);
    $order   = $post->menu_order; // Get native menu_order value
    ?>
    <div class="lp3aik-metabox-wrap" style="padding: 10px 0;">
        <p class="lp3aik-meta-hint" style="margin-bottom: 20px; background: #f0f6fa; padding: 12px; border-left: 4px solid #007cba; border-radius: 3px;">
            <span class="dashicons dashicons-info" style="color: #007cba; vertical-align: middle; margin-right: 4px;"></span>
            <strong><?php _e('Info:','lp3aik-umk'); ?></strong> <?php _e('Isi data detail anggota struktur organisasi. Foto diatur melalui kotak <strong>Featured Image</strong> di sidebar kanan layar.', 'lp3aik-umk'); ?>
        </p>
        
        <table class="form-table lp3aik-meta-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="_tim_jabatan"><?php _e('Jabatan','lp3aik-umk'); ?> <span class="required" style="color: #d63638;">*</span></label>
                    </th>
                    <td>
                        <input type="text" id="_tim_jabatan" name="_tim_jabatan" value="<?php echo esc_attr($jabatan); ?>" class="regular-text" placeholder="<?php _e('Contoh: Ketua LP3AIK','lp3aik-umk'); ?>" required>
                        <p class="description"><?php _e('Jabatan resmi dalam struktur organisasi.','lp3aik-umk'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="_tim_unit"><?php _e('Unit / Divisi','lp3aik-umk'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="_tim_unit" name="_tim_unit" value="<?php echo esc_attr($unit); ?>" class="regular-text" placeholder="<?php _e('Contoh: Divisi Pengkajian','lp3aik-umk'); ?>">
                        <p class="description"><?php _e('Unit atau divisi tempat bertugas.','lp3aik-umk'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="_tim_nip"><?php _e('NIP / NIDN','lp3aik-umk'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="_tim_nip" name="_tim_nip" value="<?php echo esc_attr($nip); ?>" class="regular-text" placeholder="<?php _e('Nomor Induk Pegawai/Dosen','lp3aik-umk'); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="_tim_order"><?php _e('Urutan Tampil','lp3aik-umk'); ?></label>
                    </th>
                    <td>
                        <input type="number" id="_tim_order" name="_tim_order" value="<?php echo esc_attr($order); ?>" class="small-text" min="0" max="999" step="1">
                        <p class="description"><?php _e('Angka lebih kecil tampil lebih dulu (0 = pertama).','lp3aik-umk'); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

add_action('save_post_lp3aik_tim', 'lp3aik_save_tim_meta_handler');
function lp3aik_save_tim_meta_handler(int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['lp3aik_tim_nonce']) || !wp_verify_nonce($_POST['lp3aik_tim_nonce'], 'lp3aik_tim_meta_save')) return;

    // Standard meta saving
    $fields = [
        '_tim_jabatan' => 'sanitize_text_field',
        '_tim_unit'    => 'sanitize_text_field',
        '_tim_nip'     => 'sanitize_text_field',
    ];

    foreach ($fields as $key => $sanitizer) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, $sanitizer($_POST[$key]));
        }
    }

    // Update Native post menu_order
    if (isset($_POST['_tim_order'])) {
        $order = absint($_POST['_tim_order']);
        
        // Avoid infinite loop when using wp_update_post
        remove_action('save_post_lp3aik_tim', 'lp3aik_save_tim_meta_handler');
        
        wp_update_post([
            'ID'         => $post_id,
            'menu_order' => $order
        ]);
        
        add_action('save_post_lp3aik_tim', 'lp3aik_save_tim_meta_handler');
    }
}
