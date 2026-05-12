<?php
/**
 * Archive Template: Program & Layanan AIK
 *
 * @package lp3aik-umk
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <h1><?php _e('Program & Layanan AIK', 'lp3aik-umk'); ?></h1>
        <p class="breadcrumb-desc"><?php _e('Berbagai program pembinaan Al-Islam dan Kemuhammadiyahan untuk sivitas akademika.', 'lp3aik-umk'); ?></p>
        <div class="breadcrumb"><?php lp3aik_breadcrumb(); ?></div>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if (have_posts()): ?>
        <div class="grid-3">
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('template-parts/cards/card', 'program'); ?>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
        <div class="text-center p-5">
            <div class="empty-state-icon"><i class="fa-solid fa-book-open" aria-hidden="true"></i></div>
            <h3><?php _e('Belum ada program', 'lp3aik-umk'); ?></h3>
            <p class="text-muted"><?php _e('Program AIK belum tersedia. Tambahkan via dashboard WordPress.', 'lp3aik-umk'); ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
