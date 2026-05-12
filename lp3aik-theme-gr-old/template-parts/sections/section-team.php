<?php
/**
 * Template Part: Tim / Pengurus
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$team = new WP_Query([
    'post_type'      => 'lp3aik_tim',
    'posts_per_page' => 8,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

$demo_tim = [
    ['Ketua LP3AIK',               'Dr. H. Ahmad, M.Ag'],
    ['Sekretaris',                  'Drs. Mahmud, M.Pd'],
    ['Bendahara',                   'Hj. Siti Aminah, S.E'],
    ['Koordinator Bid. Akademik',   'Ustadz Ridwan, M.Ag'],
];
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
            <a href="<?php echo esc_url(home_url('/struktur-organisasi')); ?>" class="btn btn-outline">
                <?php _e('Lihat Struktur Lengkap','lp3aik-umk'); ?>
            </a>
        </div>
        <?php else: ?>
        <div class="grid-4">
            <?php foreach ($demo_tim as [$jabatan, $nama]): ?>
            <div class="team-card">
                <div class="team-card__avatar">
                    <div class="d-flex align-items-center justify-content-center" style="width:100%;height:100%;background:var(--green-pale);font-size:2.5rem;">
                        <i class="fa-solid fa-user" style="color:var(--green-mid);"></i>
                    </div>
                </div>
                <div class="team-card__name"><?php echo esc_html($nama); ?></div>
                <div class="team-card__position"><?php echo esc_html($jabatan); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
