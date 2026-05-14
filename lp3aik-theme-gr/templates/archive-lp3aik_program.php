<?php
/**
 * Archive Template: Program / Layanan AIK
 *
 * Menampilkan daftar penuh semua Program AIK.
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
        <div class="grid-3">
            <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('template-parts/cards/card', 'program'); ?>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <?php lp3aik_pagination(); ?>

        <?php else: ?>
            <div class="text-center p-5" style="background:var(--color-primary-ghost);border-radius:var(--border-radius-lg);border:1px dashed var(--color-primary-light);">
                <div style="font-size:3rem;margin-bottom:1rem;color:var(--color-primary-mid);">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <h3><?php _e('Belum Ada Program Terdaftar','lp3aik-umk'); ?></h3>
                <p style="color:var(--color-text-muted);max-width:500px;margin:0 auto;">
                    <?php _e('Data program layanan AIK sedang dipersiapkan atau belum ditambahkan oleh admin.','lp3aik-umk'); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
