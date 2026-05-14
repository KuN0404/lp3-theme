<?php
/**
 * Template Name: Halaman Berita
 *
 * Halaman penuh daftar Berita & Pengumuman.
 * Menggantikan index.php untuk halaman /berita.
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
        <div class="single-wrap">
            <!-- Posts -->
            <main id="main-content">
                <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $posts_query = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 8,
                    'paged'          => $paged,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);
                ?>
                <?php if ($posts_query->have_posts()): ?>
                <div class="grid-2 mb-4">
                    <?php while ($posts_query->have_posts()): $posts_query->the_post(); ?>
                    <?php get_template_part('template-parts/cards/card', 'post'); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- Pagination -->
                <?php lp3aik_pagination($posts_query); ?>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                    <h3><?php _e('Belum ada berita','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);">
                        <?php _e('Belum ada berita atau pengumuman yang dipublikasikan.','lp3aik-umk'); ?>
                    </p>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>