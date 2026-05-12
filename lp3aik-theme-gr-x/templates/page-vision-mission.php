<?php
/**
 * Template Name: Halaman Visi Misi
 *
 * Halaman penuh Visi, Misi, dan Tujuan LP3AIK.
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
            <div class="col-lg-10">
                <!-- Konten dari WP Editor -->
                <div class="entry-content"
                    style="background:var(--white);padding:3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);margin-bottom:2rem;">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>

                    <!-- Automated Tujuan Section (Synchronized from Theme Options) -->
                    <div class="mt-5 pt-4" style="border-top: 1px dashed var(--color-border);">
                        <h3 style="color:var(--color-primary); font-weight:700; margin-bottom:1rem;"><?php _e('Tujuan','lp3aik-umk'); ?></h3>
                        <div style="color:var(--color-text-muted); line-height:1.7;">
                            <?php echo wp_kses_post(lp3aik_opt('lp3aik_tujuan', 'Terwujudnya sivitas akademika Universitas Muhammadiyah Kotabumi yang memiliki pemahaman, penghayatan, dan pengamalan Al-Islam dan Kemuhammadiyahan secara konsisten dan berkelanjutan.')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>