<?php
/**
 * Archive Template: Galeri Kegiatan
 *
 * Menampilkan daftar penuh semua foto Galeri Kegiatan.
 * Mengikuti WordPress Template Hierarchy: archive-{post_type}.php
 *
 * @package lp3aik-umk
 */

get_header();
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

<section class="section section--alt">
    <div class="container">
        <?php if (have_posts()): ?>
        <div class="gallery-masonry" id="full-gallery">
            <?php while (have_posts()): the_post(); ?>
            <div class="gallery-item"
                data-src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>">
                <?php if (has_post_thumbnail()): ?>
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>"
                    alt="<?php the_title_attribute(); ?>" loading="lazy">
                <?php else: ?>
                <div class="d-flex align-items-center justify-content-center"
                    style="background:var(--green-pale);aspect-ratio:4/3;font-size:2rem;color:var(--green-mid);">
                    <i class="fa-solid fa-image"></i>
                </div>
                <?php endif; ?>
                <div class="gallery-item__overlay"><?php the_title(); ?></div>
            </div>
            <?php endwhile; ?>
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

        <?php else: ?>
        <div class="text-center p-5">
            <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                <i class="fa-solid fa-images"></i>
            </div>
            <h3><?php _e('Belum ada galeri','lp3aik-umk'); ?></h3>
            <p style="color:var(--text-secondary);">
                <?php _e('Belum ada foto kegiatan yang ditambahkan. Silakan tambahkan melalui menu "Galeri" di dashboard WordPress.','lp3aik-umk'); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_template_part('template-parts/components/lightbox'); ?>
<?php get_footer(); ?>
