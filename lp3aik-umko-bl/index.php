<?php
get_header();
get_template_part('template-parts/breadcrumb');
?>

<section class="lp3aik-page-section py-section">
    <div class="container">
        <div class="row">
            <div class="<?php echo is_active_sidebar('sidebar-berita') ? 'col-lg-8' : 'col-12'; ?>">

                <?php if (have_posts()) : ?>
                <div class="row g-4">
                    <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-6">
                        <?php get_template_part('template-parts/content'); ?>
                    </div>
                    <?php endwhile; ?>
                </div>
                <div class="mt-4">
                    <?php the_posts_pagination([
                        'mid_size'  => 2,
                        'prev_text' => '<i class="bi bi-chevron-left"></i> Sebelumnya',
                        'next_text' => 'Berikutnya <i class="bi bi-chevron-right"></i>',
                        'class'     => 'justify-content-center',
                    ]); ?>
                </div>
                <?php else: ?>
                <div class="text-center py-5">
                    <h3>Belum ada konten.</h3>
                </div>
                <?php endif; ?>
            </div>
            <?php if (is_active_sidebar('sidebar-berita')): ?>
            <div class="col-lg-4 mt-5 mt-lg-0">
                <?php get_sidebar(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
