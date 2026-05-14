<?php
/**
 * Template Part: Tim / Pengurus
 * Refactored to only pull real database content.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$team = new WP_Query([
    'post_type'      => 'lp3aik_tim',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
?>
<section class="section" id="tim">
    <div class="container">
        <?php lp3aik_section_header(
            __('Pengurus Kami','lp3aik-umk'),
            __('Struktur Pengurus LP3AIK','lp3aik-umk'),
            __('Para pengurus yang berdedikasi dalam menjalankan amanah pembinaan AIK.','lp3aik-umk')
        ); ?>

        <?php if ($team->have_posts()): ?>
            <div class="grid-4">
                <?php while ($team->have_posts()): $team->the_post(); ?>
                    <?php get_template_part('template-parts/cards/card', 'team'); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="text-center mt-4">
                <?php $org_url = ($p = get_page_by_path('org-structure')) ? get_permalink($p->ID) : home_url('/org-structure/'); ?>
                <a href="<?php echo esc_url($org_url); ?>" class="btn btn-outline">
                    <?php _e('Lihat Struktur Lengkap','lp3aik-umk'); ?>
                </a>
            </div>
        <?php else: ?>
            <div class="text-center p-4" style="background:var(--color-primary-ghost);border-radius:var(--border-radius);border:1px dashed var(--color-primary-light);">
                <p class="mb-0 text-muted">
                    <i class="fa-solid fa-users-slash me-2"></i><?php _e('Data pengurus belum ditambahkan. Tambahkan data melalui menu Tim di Admin Dashboard.','lp3aik-umk'); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>
