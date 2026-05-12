<?php
/**
 * Archive Template: Unduhan / File
 *
 * @package lp3aik-umk
 */

get_header();

// Map file type to FA icon
function lp3aik_file_icon(string $type): string {
    return match(strtoupper($type)) {
        'PDF'  => 'fa-file-pdf',
        'DOCX',
        'DOC'  => 'fa-file-word',
        'XLSX',
        'XLS'  => 'fa-file-excel',
        'PPTX',
        'PPT'  => 'fa-file-powerpoint',
        'ZIP'  => 'fa-file-zipper',
        default => 'fa-file-lines',
    };
}
?>

<div class="page-hero">
    <div class="container">
        <h1><?php _e('Unduhan / File', 'lp3aik-umk'); ?></h1>
        <div class="breadcrumb"><?php lp3aik_breadcrumb(); ?></div>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if (have_posts()): ?>
        <div class="unduhan-table-wrap">
            <table class="unduhan-table">
                <thead>
                    <tr>
                        <th><?php _e('Nama File', 'lp3aik-umk'); ?></th>
                        <th><?php _e('Tipe', 'lp3aik-umk'); ?></th>
                        <th><?php _e('Ukuran', 'lp3aik-umk'); ?></th>
                        <th><?php _e('Tanggal', 'lp3aik-umk'); ?></th>
                        <th><?php _e('Aksi', 'lp3aik-umk'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while (have_posts()): the_post();
                        $url    = get_post_meta(get_the_ID(), '_unduhan_url', true);
                        $ukuran = get_post_meta(get_the_ID(), '_unduhan_ukuran', true);
                        $tipe   = get_post_meta(get_the_ID(), '_unduhan_tipe', true) ?: 'PDF';
                    ?>
                    <tr>
                        <td>
                            <div class="unduhan-title">
                                <div class="unduhan-icon">
                                    <i class="fa-solid <?php echo esc_attr(lp3aik_file_icon($tipe)); ?>" aria-hidden="true"></i>
                                </div>
                                <span><?php the_title(); ?></span>
                            </div>
                        </td>
                        <td><span class="badge badge-primary"><?php echo esc_html($tipe); ?></span></td>
                        <td class="text-muted"><?php echo esc_html($ukuran ?: '—'); ?></td>
                        <td class="text-muted">
                            <i class="fa-regular fa-calendar fa-sm" aria-hidden="true"></i>
                            <?php echo get_the_date('d M Y'); ?>
                        </td>
                        <td>
                            <?php if ($url): ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-download" aria-hidden="true"></i>
                                <?php _e('Unduh', 'lp3aik-umk'); ?>
                            </a>
                            <?php else: ?>
                            <span class="btn btn-outline btn-sm disabled" aria-disabled="true">
                                <i class="fa-solid fa-ban" aria-hidden="true"></i>
                                <?php _e('Tidak tersedia', 'lp3aik-umk'); ?>
                            </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination mt-4">
            <?php echo paginate_links(['type' => 'list', 'prev_text' => '&lsaquo;', 'next_text' => '&rsaquo;']); ?>
        </div>

        <?php else: ?>
        <div class="text-center p-5">
            <div class="empty-state-icon"><i class="fa-solid fa-folder-open" aria-hidden="true"></i></div>
            <h3><?php _e('Belum ada file unduhan', 'lp3aik-umk'); ?></h3>
            <p class="text-muted"><?php _e('Tambahkan file unduhan melalui menu "Unduhan" di dashboard WordPress.', 'lp3aik-umk'); ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
