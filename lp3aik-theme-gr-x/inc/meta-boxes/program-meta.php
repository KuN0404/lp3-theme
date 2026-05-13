<?php
/**
 * Meta Box: Program Detail.
 * Refactored to support single Priority status with max 4 items limit.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('add_meta_boxes', 'lp3aik_add_program_meta_box');
function lp3aik_add_program_meta_box() {
    add_meta_box(
        'lp3aik_program_meta',
        '<span class="dashicons dashicons-star-filled" style="color:#f0b849;margin-right:6px;"></span> ' . __('Pengaturan Tampilan Program', 'lp3aik-umk'),
        'lp3aik_program_meta_cb',
        'lp3aik_program',
        'normal',
        'high'
    );
}

function lp3aik_program_meta_cb(WP_Post $post): void {
    wp_nonce_field('lp3aik_program_meta_save', 'lp3aik_program_nonce');

    $prioritas = get_post_meta($post->ID, '_program_prioritas', true);
    ?>
    <div class="lp3aik-metabox-wrap" style="padding: 10px 0;">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row" style="width: 200px; vertical-align: top; padding: 20px 0;">
                        <label for="_program_prioritas"><strong><?php _e('Prioritas Beranda', 'lp3aik-umk'); ?></strong></label>
                    </th>
                    <td>
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" id="_program_prioritas" name="_program_prioritas" value="yes" <?php checked($prioritas, 'yes'); ?> style="margin-right: 10px; transform: scale(1.2);">
                            <span><?php _e('Tampilkan Program ini di Beranda Utama', 'lp3aik-umk'); ?></span>
                        </label>
                        <p class="description" style="margin-top: 8px; color: #646970;">
                            <span class="dashicons dashicons-info-outline" style="font-size: 16px; width: 16px; height: 16px; vertical-align: text-bottom; color: #72777c;"></span>
                            <?php _e('Centang jika ingin menampilkan program ini sebagai Program Unggulan di halaman depan. <strong>Maksimal 4 program</strong>.', 'lp3aik-umk'); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

add_action('save_post_lp3aik_program', 'lp3aik_save_program_meta_handler');
function lp3aik_save_program_meta_handler(int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['lp3aik_program_nonce']) || !wp_verify_nonce($_POST['lp3aik_program_nonce'], 'lp3aik_program_meta_save')) return;

    if (isset($_POST['_program_prioritas']) && $_POST['_program_prioritas'] === 'yes') {
        // Count how many OTHER posts are prioritized
        $priorities = get_posts([
            'post_type'      => 'lp3aik_program',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'exclude'        => [$post_id],
            'meta_query'     => [
                [
                    'key'     => '_program_prioritas',
                    'value'   => 'yes',
                    'compare' => '='
                ]
            ]
        ]);

        if (count($priorities) >= 4) {
            // Deny save, clear it out
            delete_post_meta($post_id, '_program_prioritas');
            
            // Store temporary transient for error warning notice
            set_transient("lp3aik_program_notice_{$post_id}", 'error_max_4', 60);
        } else {
            // Under limit, we can save!
            update_post_meta($post_id, '_program_prioritas', 'yes');
        }
    } else {
        delete_post_meta($post_id, '_program_prioritas');
    }
}

// Render the warning notice to the admin if they went over cap
add_action('admin_notices', function() {
    global $pagenow, $post;
    if ($pagenow === 'post.php' && isset($_GET['post']) && $post && $post->post_type === 'lp3aik_program') {
        $notice = get_transient("lp3aik_program_notice_{$post->ID}");
        if ($notice === 'error_max_4') {
            ?>
            <div class="notice notice-warning is-dismissible" style="border-left-color:#f0b849;">
                <p>
                    <span class="dashicons dashicons-warning" style="color:#d63638;vertical-align:middle;margin-right:5px;"></span>
                    <strong><?php _e('Gagal Memprioritaskan:', 'lp3aik-umk'); ?></strong> 
                    <?php _e('Maksimal hanya diperbolehkan menceklis 4 program di beranda. Silakan hapus status prioritas program lain terlebih dahulu.', 'lp3aik-umk'); ?>
                </p>
            </div>
            <?php
            delete_transient("lp3aik_program_notice_{$post->ID}");
        }
    }
});
