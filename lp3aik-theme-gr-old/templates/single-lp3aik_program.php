<?php
/**
 * Single Template: Program / Layanan AIK
 *
 * Menampilkan detail satu Program AIK.
 * Mengikuti WordPress Template Hierarchy: single-{post_type}.php
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
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
                            style="width:100%;border-radius:var(--radius-lg);">
                    </div>
                    <?php endif; ?>

                    <?php
                    $icon_class = get_post_meta(get_the_ID(), '_program_icon', true);
                    $sasaran    = get_post_meta(get_the_ID(), '_program_sasaran', true);
                    ?>

                    <?php if ($sasaran): ?>
                    <div class="mb-4 d-flex align-items-center gap-2"
                        style="color:var(--green-primary);font-size:0.9rem;">
                        <i class="fa-solid fa-users"></i>
                        <span><strong><?php _e('Sasaran:','lp3aik-umk'); ?></strong> <?php echo esc_html($sasaran); ?></span>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content"
                        style="background:var(--white);padding:3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);font-size:1.05rem;line-height:1.8;">
                        <?php the_content(); ?>
                    </div>

                    <!-- Navigasi Program Lain -->
                    <div class="mt-5">
                        <h3 style="color:var(--green-dark);margin-bottom:1.5rem;">
                            <i class="fa-solid fa-layer-group me-2"></i><?php _e('Program Lainnya','lp3aik-umk'); ?>
                        </h3>
                        <?php
                        $related = new WP_Query([
                            'post_type'      => 'lp3aik_program',
                            'posts_per_page' => 3,
                            'post__not_in'   => [get_the_ID()],
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ]);
                        if ($related->have_posts()):
                        ?>
                        <div class="grid-3">
                            <?php while ($related->have_posts()): $related->the_post(); ?>
                            <?php get_template_part('template-parts/cards/card', 'program'); ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
