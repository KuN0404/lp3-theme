<?php
/**
 * Template Part: Statistik / Capaian
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$stat_items = [
    [lp3aik_opt('lp3aik_stat_1_num','500+'), lp3aik_opt('lp3aik_stat_1_label','Mahasiswa Terdidik'),  'fa-graduation-cap'],
    [lp3aik_opt('lp3aik_stat_2_num','12'),   lp3aik_opt('lp3aik_stat_2_label','Program AIK'),        'fa-book-open'],
    [lp3aik_opt('lp3aik_stat_3_num','20+'),  lp3aik_opt('lp3aik_stat_3_label','Tahun Berdiri'),      'fa-building-columns'],
    [lp3aik_opt('lp3aik_stat_4_num','30+'),  lp3aik_opt('lp3aik_stat_4_label','Tenaga Pengajar'),    'fa-chalkboard-user'],
];
?>
<section class="section section--dark mb-5" id="statistik">
    <div class="container">
        <div class="text-center mb-4">
            <span class="section-eyebrow" style="background:rgba(200,151,42,.2);color:var(--gold-light);">
                <?php _e('Capaian Kami','lp3aik-umk'); ?>
            </span>
            <h2 class="section-title"><?php _e('LP3AIK dalam Angka','lp3aik-umk'); ?></h2>
        </div>
        <div class="stats-grid">
            <?php foreach ($stat_items as [$num, $label, $icon]): ?>
            <div class="stat-block">
                <div style="font-size:2rem;margin-bottom:.5rem;"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></div>
                <div class="stat-block__num"><?php echo esc_html($num); ?></div>
                <div class="stat-block__label"><?php echo esc_html($label); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
