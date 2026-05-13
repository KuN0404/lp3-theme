<?php
/**
 * Search Results Template
 *
 * Menampilkan hasil pencarian sesuai tema LP3AIK.
 * Mengikuti WordPress Template Hierarchy: search.php
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php printf(__('Hasil Pencarian: "%s"', 'lp3aik-umk'), esc_html(get_search_query())); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="single-wrap">
            <!-- Search Results -->
            <main id="main-content">
                <?php if (have_posts()): ?>
                <p class="mb-4" style="color:var(--text-secondary);">
                    <?php printf(
                        _n('Ditemukan %d hasil', 'Ditemukan %d hasil', $wp_query->found_posts, 'lp3aik-umk'),
                        $wp_query->found_posts
                    ); ?>
                </p>
                <div class="grid-2 mb-4">
                    <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('template-parts/cards/card', 'post'); ?>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php lp3aik_pagination(); ?>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);"><i class="fa-solid fa-search"></i></div>
                    <h3><?php _e('Tidak ada hasil ditemukan','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);"><?php _e('Coba kata kunci lain atau kembali ke beranda.','lp3aik-umk'); ?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary mt-3">
                        <i class="fa-solid fa-home me-1"></i> <?php _e('Kembali ke Beranda','lp3aik-umk'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
