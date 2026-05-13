<?php
/**
 * Archive Template: Unduhan / File Download
 *
 * Menampilkan daftar penuh semua file Unduhan.
 * Mengikuti WordPress Template Hierarchy: archive-{post_type}.php
 *
 * @package lp3aik-umk
 */

get_header();

$tipe_icons = [
    'PDF'      => 'fa-file-pdf',
    'DOCX'     => 'fa-file-word',
    'XLSX'     => 'fa-file-excel',
    'PPT'      => 'fa-file-powerpoint',
    'ZIP'      => 'fa-file-zipper',
    'Lainnya'  => 'fa-file',
];
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php post_type_archive_title(); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if (have_posts()): ?>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="unduhan-table-wrap">
                    <table class="unduhan-table">
                        <thead>
                            <tr>
                                <th scope="col"><?php _e('Nama File','lp3aik-umk'); ?></th>
                                <th scope="col"><?php _e('Tipe','lp3aik-umk'); ?></th>
                                <th scope="col"><?php _e('Ukuran','lp3aik-umk'); ?></th>
                                <th scope="col"><?php _e('Tanggal','lp3aik-umk'); ?></th>
                                <th scope="col" style="text-align:center;"><?php _e('Aksi','lp3aik-umk'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while (have_posts()): the_post();
                                $url    = get_post_meta(get_the_ID(), '_unduhan_url', true);
                                $ukuran = get_post_meta(get_the_ID(), '_unduhan_ukuran', true);
                                $tipe   = get_post_meta(get_the_ID(), '_unduhan_tipe', true) ?: 'PDF';
                                $tipe_lower = strtolower($tipe);
                                
                                // Assign dynamic styles based on extensions
                                $icon_class = $tipe_icons[$tipe] ?? 'fa-file';
                                $theme_class = in_array($tipe_lower, ['pdf', 'docx', 'xlsx', 'ppt', 'zip']) ? $tipe_lower : 'default';
                                
                                // PREMIUM UX: Auto calculate file size if not entered in metabox but points to local media file!
                                if (empty($ukuran) && !empty($url)) {
                                    $attachment_id = attachment_url_to_postid($url);
                                    if ($attachment_id) {
                                        $file_path = get_attached_file($attachment_id);
                                        if (file_exists($file_path)) {
                                            $bytes = filesize($file_path);
                                            $ukuran = size_format($bytes, 1);
                                        }
                                    }
                                }
                            ?>
                            <tr>
                                <td>
                                    <div class="unduhan-title">
                                        <div class="unduhan-icon unduhan-icon--<?php echo esc_attr($theme_class); ?>">
                                            <i class="fa-solid <?php echo esc_attr($icon_class); ?>"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight:700; color:var(--color-primary-dark); font-size:0.95rem;"><?php the_title(); ?></div>
                                            <?php if (get_the_excerpt()): ?>
                                                <div style="font-size:0.82rem; color:var(--color-text-muted); margin-top:0.25rem;">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 12); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-file-type badge-file-type--<?php echo esc_attr($theme_class); ?>">
                                        <?php echo esc_html($tipe); ?>
                                    </span>
                                </td>
                                <td>
                                    <strong style="color:var(--color-text-dark);"><?php echo esc_html($ukuran ?: '-'); ?></strong>
                                </td>
                                <td>
                                    <span style="color:var(--color-text-muted); font-size:0.85rem;">
                                        <i class="fa-regular fa-calendar fa-sm me-1"></i>
                                        <?php echo get_the_date('d M Y'); ?>
                                    </span>
                                </td>
                                <td style="text-align:center;">
                                    <?php if ($url): ?>
                                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="download-status-btn download-status-btn--ready">
                                            <i class="fa-solid fa-download"></i> <?php _e('Unduh','lp3aik-umk'); ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="download-status-btn download-status-btn--empty" title="<?php esc_attr_e('File belum tersedia diunggah', 'lp3aik-umk'); ?>">
                                            <i class="fa-solid fa-lock"></i> <?php _e('Belum Tersedia','lp3aik-umk'); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php lp3aik_pagination(); ?>
            </div>
        </div>
        <?php else: ?>
        <div class="text-center p-5">
            <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h3><?php _e('Belum ada file unduhan','lp3aik-umk'); ?></h3>
            <p style="color:var(--text-secondary);">
                <?php _e('Belum ada file yang tersedia untuk diunduh. Silakan tambahkan melalui menu "Unduhan" di dashboard WordPress.','lp3aik-umk'); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
