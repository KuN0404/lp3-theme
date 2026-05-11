<?php
/**
 * Template Name: Halaman Struktur Organisasi
 *
 * Halaman penuh Struktur Organisasi / Tim LP3AIK.
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
        <!-- Konten dari WP Editor -->
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if (get_the_content()) : ?>
        <div class="entry-content"
            style="background:var(--white);padding:2rem 3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);margin-bottom:2.5rem;">
            <?php the_content(); ?>
        </div>
        <?php endif; ?>
        <?php endwhile; endif; ?>

        <?php
        $team = new WP_Query([
            'post_type'      => 'lp3aik_tim',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);
        ?>

        <?php if ($team->have_posts()): ?>
        <h3 class="text-center mb-4" style="color:var(--green-dark);">
            <i class="fa-solid fa-users me-2"></i><?php _e('Seluruh Pengurus LP3AIK','lp3aik-umk'); ?>
        </h3>
        <div class="grid-4">
            <?php while ($team->have_posts()): $team->the_post(); ?>
            <?php get_template_part('template-parts/cards/card', 'team'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <div class="text-center p-5">
            <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                <i class="fa-solid fa-users-slash"></i>
            </div>
            <h3><?php _e('Belum ada data pengurus','lp3aik-umk'); ?></h3>
            <p style="color:var(--text-secondary);">
                <?php _e('Silakan tambahkan data tim/pengurus melalui menu "Tim" di dashboard WordPress.','lp3aik-umk'); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>