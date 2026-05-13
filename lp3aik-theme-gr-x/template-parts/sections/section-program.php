<?php
/**
 * Template Part: Section Program Unggulan
 * Shows prioritized programs on homepage.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Query prioritized programs
$programs = new WP_Query([
    'post_type'      => 'lp3aik_program',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'meta_query'     => [
        [
            'key'     => '_program_prioritas',
            'value'   => 'yes',
            'compare' => '=',
        ]
    ]
]);

// Fallback: If no priorities chosen, display the latest 4 programs
if (!$programs->have_posts()) {
    $programs = new WP_Query([
        'post_type'      => 'lp3aik_program',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
    ]);
}
?>
<section class="section section--alt" id="program-unggulan">
    <div class="container">
        <?php lp3aik_section_header(
            __('Layanan Kami','lp3aik-umk'),
            __('Program & Layanan AIK','lp3aik-umk'),
            __('Berbagai program pembinaan keislaman dan kemuhammadiyahan yang kami selenggarakan.','lp3aik-umk')
        ); ?>

        <?php if ($programs->have_posts()): ?>
            <div class="grid-4">
                <?php while ($programs->have_posts()): $programs->the_post(); ?>
                    <?php get_template_part('template-parts/cards/card', 'program'); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            
            <div class="text-center mt-5">
                <?php $prog_url = get_post_type_archive_link('lp3aik_program') ?: home_url('/program/'); ?>
                <a href="<?php echo esc_url($prog_url); ?>" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-layer-group" style="margin-right:6px;"></i>
                    <?php _e('Lihat Seluruh Program','lp3aik-umk'); ?>
                </a>
            </div>
        <?php else: ?>
            <div class="text-center p-4" style="background:var(--color-white);border-radius:var(--border-radius-lg);border:1px dashed var(--color-border);">
                <p class="mb-0 text-muted">
                    <i class="fa-solid fa-book-bookmark me-2"></i><?php _e('Belum ada data program untuk ditampilkan.','lp3aik-umk'); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>
