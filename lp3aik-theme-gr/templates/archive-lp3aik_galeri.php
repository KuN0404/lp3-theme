<?php
/**
 * Archive Template: Galeri Kegiatan
 *
 * @package lp3aik-umk
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <h1><?php _e('Galeri Kegiatan', 'lp3aik-umk'); ?></h1>
        <div class="breadcrumb"><?php lp3aik_breadcrumb(); ?></div>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if (have_posts()): ?>
        <div class="gallery-masonry">
            <?php while (have_posts()): the_post(); ?>
            <div class="gallery-item" data-title="<?php the_title_attribute(); ?>">
                <?php if (has_post_thumbnail()): ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>"
                         data-full="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>"
                         alt="<?php the_title_attribute(); ?>"
                         loading="lazy">
                <?php endif; ?>
                <div class="gallery-item__overlay">
                    <span><?php the_title(); ?></span>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php echo paginate_links(['type' => 'list', 'prev_text' => '&lsaquo;', 'next_text' => '&rsaquo;']); ?>
        </div>

        <?php else: ?>
        <div class="text-center p-5">
            <div class="empty-state-icon"><i class="fa-solid fa-images" aria-hidden="true"></i></div>
            <h3><?php _e('Belum ada galeri', 'lp3aik-umk'); ?></h3>
            <p class="text-muted"><?php _e('Foto kegiatan belum tersedia. Tambahkan via dashboard WordPress.', 'lp3aik-umk'); ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_template_part('template-parts/components/lightbox'); ?>
<?php get_footer(); ?>
