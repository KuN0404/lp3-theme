<?php
/**
 * Blog / Archive Template
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title(__('Tag: ','lp3aik-umk'));
            } elseif (is_search()) {
                printf(__('Hasil pencarian: "%s"','lp3aik-umk'), esc_html(get_search_query()));
            } elseif (is_archive()) {
                the_archive_title();
            } else {
                _e('Berita & Pengumuman','lp3aik-umk');
            }
        ?></h1>
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
                <?php if (have_posts()): ?>
                <div class="grid-2 mb-4">
                    <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('template-parts/cards/card', 'post'); ?>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php lp3aik_pagination(); ?>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);"><i class="fa-solid fa-inbox"></i></div>
                    <h3><?php _e('Belum ada postingan','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);"><?php _e('Postingan atau berita tidak ditemukan.','lp3aik-umk'); ?></p>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
