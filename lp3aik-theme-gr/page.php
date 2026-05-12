<?php
/**
 * Default Page Template
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
            <div class="col-lg-9">
                <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()): ?>
                    <div class="single-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                             alt="<?php the_title_attribute(); ?>" loading="lazy">
                    </div>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
