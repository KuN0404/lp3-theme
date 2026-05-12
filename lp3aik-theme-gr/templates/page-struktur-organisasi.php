<?php
/**
 * Template Name: Struktur Organisasi
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
        <div class="text-center mb-5">
            <span class="section-eyebrow"><?php _e('Organisasi', 'lp3aik-umk'); ?></span>
            <h2 class="section-title"><?php _e('Struktur Pengurus LP3AIK', 'lp3aik-umk'); ?></h2>
            <p class="section-subtitle">
                <?php _e('Susunan pengurus dan tenaga ahli yang mendedikasikan diri untuk kemajuan Al-Islam dan Kemuhammadiyahan.', 'lp3aik-umk'); ?>
            </p>
        </div>

        <?php
        // Group by jabatan taxonomy or meta
        $team = new WP_Query([
            'post_type'      => 'lp3aik_tim',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);

        if ($team->have_posts()):
        ?>
        <div class="grid-4">
            <?php while ($team->have_posts()): $team->the_post(); ?>
                <?php get_template_part('template-parts/cards/card', 'team'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <div class="text-center p-5">
            <div class="empty-state-icon"><i class="fa-solid fa-people-group" aria-hidden="true"></i></div>
            <h3><?php _e('Data pengurus belum tersedia', 'lp3aik-umk'); ?></h3>
            <p class="text-muted"><?php _e('Tambahkan data tim melalui menu "Tim" di dashboard WordPress.', 'lp3aik-umk'); ?></p>
        </div>
        <?php endif; ?>

        <?php
        // Org chart image from customizer
        $org_chart = lp3aik_opt('lp3aik_org_chart_image');
        if ($org_chart):
        ?>
        <div class="mt-6 text-center">
            <h3 class="mb-4"><?php _e('Bagan Struktur Organisasi', 'lp3aik-umk'); ?></h3>
            <img src="<?php echo esc_url($org_chart); ?>"
                 alt="<?php _e('Bagan Struktur Organisasi LP3AIK', 'lp3aik-umk'); ?>"
                 style="max-width:100%;border-radius:var(--border-radius-lg);box-shadow:var(--shadow-md);">
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
