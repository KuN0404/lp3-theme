<?php
/**
 * Single Template: Galeri Kegiatan
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
                <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()): ?>
                    <div class="entry-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                            alt="<?php the_title_attribute(); ?>"
                            style="width:100%;border-radius:var(--radius-lg);box-shadow:var(--shadow-md);">
                    </div>
                    <?php endif; ?>

                    <div class="entry-meta mb-4 d-flex gap-4 align-items-center flex-wrap"
                        style="color:var(--text-secondary);font-size:0.9rem;border-bottom:1px solid var(--border);padding-bottom:1rem;">
                        <span><i class="fa-regular fa-calendar" style="color:var(--green-primary);"></i> <?php echo get_the_date('d M Y'); ?></span>
                        <?php $albums = get_the_terms(get_the_ID(), 'album_galeri');
                        if ($albums && !is_wp_error($albums)): ?>
                        <span><i class="fa-solid fa-folder-open" style="color:var(--green-primary);"></i> <?php echo esc_html($albums[0]->name); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if (get_the_content()): ?>
                    <div class="entry-content" style="background:var(--white);padding:2rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);margin-bottom:2rem;">
                        <?php the_content(); ?>
                    </div>
                    <?php endif; ?>
                </article>
                <?php endwhile; ?>

                <div class="mt-5">
                    <h3 style="color:var(--green-dark);margin-bottom:1.5rem;">
                        <i class="fa-solid fa-images me-2"></i><?php _e('Galeri Lainnya','lp3aik-umk'); ?>
                    </h3>
                    <?php
                    $related = new WP_Query([
                        'post_type'      => 'lp3aik_galeri',
                        'posts_per_page' => 6,
                        'post__not_in'   => [get_the_ID()],
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ]);
                    if ($related->have_posts()): ?>
                    <div class="gallery-masonry">
                        <?php while ($related->have_posts()): $related->the_post(); ?>
                        <div class="gallery-item" data-src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>">
                            <?php if (has_post_thumbnail()): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);aspect-ratio:4/3;font-size:2rem;color:var(--green-mid);"><i class="fa-solid fa-image"></i></div>
                            <?php endif; ?>
                            <div class="gallery-item__overlay"><?php the_title(); ?></div>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/components/lightbox'); ?>
<?php get_footer(); ?>
