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
                <div class="table-responsive"
                    style="background:var(--white);border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
                    <table class="table table-borderless mb-0">
                        <thead style="background:var(--green-primary);color:var(--white);">
                            <tr>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Nama File','lp3aik-umk'); ?></th>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Tipe','lp3aik-umk'); ?></th>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Ukuran','lp3aik-umk'); ?></th>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Tanggal','lp3aik-umk'); ?></th>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Aksi','lp3aik-umk'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while (have_posts()): the_post();
                                $url    = get_post_meta(get_the_ID(), '_unduhan_url', true);
                                $ukuran = get_post_meta(get_the_ID(), '_unduhan_ukuran', true);
                                $tipe   = get_post_meta(get_the_ID(), '_unduhan_tipe', true) ?: 'PDF';
                                $icon   = $tipe_icons[$tipe] ?? 'fa-file';
                            ?>
                            <tr style="border-bottom:1px solid var(--border);transition:background .15s;"
                                onmouseover="this.style.background='var(--green-ghost)'"
                                onmouseout="this.style.background='transparent'">
                                <td style="padding:1rem 1.5rem;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div
                                            style="width:40px;height:40px;background:var(--green-pale);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--green-primary);font-size:1.2rem;flex-shrink:0;">
                                            <i class="fa-solid <?php echo esc_attr($icon); ?>"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight:600;font-size:0.95rem;"><?php the_title(); ?></div>
                                            <?php if (get_the_excerpt()): ?>
                                            <div style="font-size:0.8rem;color:var(--text-secondary);">
                                                <?php echo get_the_excerpt(); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:1rem 1.5rem;">
                                    <span class="badge"
                                        style="background:var(--green-pale);color:var(--green-primary);font-weight:500;">
                                        <?php echo esc_html($tipe); ?>
                                    </span>
                                </td>
                                <td style="padding:1rem 1.5rem;color:var(--text-secondary);font-size:0.9rem;">
                                    <?php echo esc_html($ukuran ?: '-'); ?>
                                </td>
                                <td style="padding:1rem 1.5rem;color:var(--text-secondary);font-size:0.85rem;">
                                    <i class="fa-regular fa-calendar fa-sm me-1"></i>
                                    <?php echo get_the_date('d M Y'); ?>
                                </td>
                                <td style="padding:1rem 1.5rem;">
                                    <?php if ($url): ?>
                                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-download"></i> <?php _e('Unduh','lp3aik-umk'); ?>
                                    </a>
                                    <?php else: ?>
                                    <span class="btn btn-outline btn-sm disabled">
                                        <i class="fa-solid fa-ban"></i> <?php _e('Tidak tersedia','lp3aik-umk'); ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination mt-4">
                    <?php
                    echo paginate_links([
                        'type'      => 'list',
                        'prev_text' => '&lsaquo;',
                        'next_text' => '&rsaquo;',
                    ]);
                    ?>
                </div>
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
