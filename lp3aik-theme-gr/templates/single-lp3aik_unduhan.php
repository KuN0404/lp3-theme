<?php
/**
 * Single Template: Unduhan / File Download
 *
 * @package lp3aik-umk
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb"><?php lp3aik_breadcrumb(); ?></div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php while (have_posts()): the_post();
                    $url    = get_post_meta(get_the_ID(), '_unduhan_url', true);
                    $ukuran = get_post_meta(get_the_ID(), '_unduhan_ukuran', true);
                    $tipe   = get_post_meta(get_the_ID(), '_unduhan_tipe', true) ?: 'PDF';
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div style="background:var(--white);padding:2.5rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);">
                        <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom:1px solid var(--border);">
                            <div style="width:60px;height:60px;background:var(--green-pale);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;color:var(--green-primary);font-size:1.8rem;flex-shrink:0;">
                                <i class="fa-solid fa-file-<?php echo $tipe === 'PDF' ? 'pdf' : ($tipe === 'DOCX' ? 'word' : ($tipe === 'XLSX' ? 'excel' : 'lines')); ?>"></i>
                            </div>
                            <div>
                                <div style="font-weight:700;font-size:1.1rem;"><?php the_title(); ?></div>
                                <div class="d-flex gap-3 mt-1" style="font-size:.85rem;color:var(--text-secondary);">
                                    <span><i class="fa-solid fa-tag fa-sm"></i> <?php echo esc_html($tipe); ?></span>
                                    <?php if ($ukuran): ?>
                                    <span><i class="fa-solid fa-weight-scale fa-sm"></i> <?php echo esc_html($ukuran); ?></span>
                                    <?php endif; ?>
                                    <span><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></span>
                                </div>
                            </div>
                        </div>

                        <?php if (get_the_content()): ?>
                        <div class="entry-content mb-4" style="line-height:1.8;">
                            <?php the_content(); ?>
                        </div>
                        <?php endif; ?>

                        <?php if ($url): ?>
                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-download me-1"></i> <?php _e('Download File','lp3aik-umk'); ?>
                        </a>
                        <?php else: ?>
                        <span class="btn btn-outline btn-lg disabled">
                            <i class="fa-solid fa-ban me-1"></i> <?php _e('File tidak tersedia','lp3aik-umk'); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
