<?php
/**
 * Template Part: Galeri Cuplikan
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$gallery = new WP_Query([
    'post_type'      => 'lp3aik_galeri',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$placeholder_icons = ['fa-mosque','fa-book-open','fa-graduation-cap','fa-handshake','fa-pen-to-square','fa-moon'];
?>
<section class="section section--alt" id="galeri">
    <div class="container">
        <div class="flex-between mb-4" style="flex-wrap:wrap;gap:1rem;">
            <div>
                <span class="section-eyebrow"><?php _e('Dokumentasi','lp3aik-umk'); ?></span>
                <h2 class="section-title mb-0"><?php _e('Galeri Kegiatan','lp3aik-umk'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_galeri') ?: home_url('/galeri')); ?>" class="btn btn-outline">
                <?php _e('Lihat Semua','lp3aik-umk'); ?>
            </a>
        </div>

        <?php if ($gallery->have_posts()): ?>
        <div class="gallery-masonry" id="homepage-gallery">
            <?php while ($gallery->have_posts()): $gallery->the_post(); ?>
            <div class="gallery-item" data-src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>">
                <?php if (has_post_thumbnail()): ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);aspect-ratio:4/3;font-size:2rem;color:var(--green-mid);">
                        <i class="fa-solid fa-image"></i>
                    </div>
                <?php endif; ?>
                <div class="gallery-item__overlay"><?php the_title(); ?></div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <div class="gallery-masonry">
            <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="gallery-item">
                <div class="d-flex align-items-center justify-content-center" style="background:linear-gradient(135deg,var(--green-pale),var(--green-ghost));font-size:2.5rem;aspect-ratio:<?php echo ($i % 3 === 2) ? '1/1' : '4/3'; ?>;color:var(--green-mid);">
                    <i class="fa-solid <?php echo esc_attr($placeholder_icons[$i]); ?>"></i>
                </div>
                <div class="gallery-item__overlay"><?php printf(__('Kegiatan LP3AIK %d','lp3aik-umk'), $i + 1); ?></div>
            </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
