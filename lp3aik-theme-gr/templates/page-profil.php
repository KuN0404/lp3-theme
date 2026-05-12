<?php
/**
 * Template Name: Profil LP3AIK
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

<!-- PROFIL SECTION -->
<section class="section">
    <div class="container">
        <div class="about-grid">

            <!-- Image -->
            <div class="about__image-wrap">
                <div class="about__image-main">
                    <?php $about_img = lp3aik_opt('lp3aik_about_image'); ?>
                    <?php if ($about_img): ?>
                        <img src="<?php echo esc_url($about_img); ?>"
                             alt="<?php _e('Gedung LP3AIK UM Kotabumi', 'lp3aik-umk'); ?>"
                             loading="lazy">
                    <?php else: ?>
                        <div class="about__image-placeholder">
                            <i class="fa-solid fa-mosque" aria-hidden="true"></i>
                            <span><?php _e('LP3AIK UM Kotabumi', 'lp3aik-umk'); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="about__badge-float">
                    <div class="num"><?php echo esc_html(lp3aik_opt('lp3aik_stat_3_num', '20+')); ?></div>
                    <div class="label"><?php _e('Tahun Berdiri', 'lp3aik-umk'); ?></div>
                </div>
            </div>

            <!-- Content -->
            <div class="about__content">
                <span class="section-eyebrow"><?php _e('Tentang Kami', 'lp3aik-umk'); ?></span>
                <h2 class="section-title"><?php _e('LP3AIK UM Kotabumi', 'lp3aik-umk'); ?></h2>
                <p class="text-muted mb-3">
                    <?php echo wp_kses_post(lp3aik_opt('lp3aik_about_text',
                        __('LP3AIK (Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan) adalah unit lembaga di Universitas Muhammadiyah Kotabumi yang bertugas mengintegrasikan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek kehidupan akademik.', 'lp3aik-umk')
                    )); ?>
                </p>
                <p class="text-muted mb-4">
                    <?php echo wp_kses_post(lp3aik_opt('lp3aik_about_text2',
                        __('Kami berkomitmen mencetak generasi yang tidak hanya unggul secara intelektual, tetapi juga memiliki akhlak mulia dan semangat Kemuhammadiyahan yang kuat.', 'lp3aik-umk')
                    )); ?>
                </p>

                <!-- Visi Misi Tabs -->
                <div class="about__visi-misi">
                    <div class="visi-misi-tabs" role="tablist">
                        <button class="tab-btn active" data-tab="visi" role="tab" aria-selected="true"><?php _e('Visi', 'lp3aik-umk'); ?></button>
                        <button class="tab-btn" data-tab="misi" role="tab" aria-selected="false"><?php _e('Misi', 'lp3aik-umk'); ?></button>
                        <button class="tab-btn" data-tab="tujuan" role="tab" aria-selected="false"><?php _e('Tujuan', 'lp3aik-umk'); ?></button>
                    </div>
                    <div class="tab-panel active" id="tab-visi" role="tabpanel">
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_visi',
                            __('Menjadi lembaga terdepan dalam pengkajian, pengembangan, dan pengamalan Al-Islam dan Kemuhammadiyahan di lingkungan Universitas Muhammadiyah Kotabumi guna mewujudkan sivitas akademika yang berakhlak mulia.', 'lp3aik-umk')
                        )); ?></p>
                    </div>
                    <div class="tab-panel" id="tab-misi" role="tabpanel">
                        <ul class="misi-list">
                            <?php
                            $misi_raw = lp3aik_opt('lp3aik_misi', "Mengintegrasikan nilai AIK ke dalam seluruh program akademik\nMenyelenggarakan program pembinaan AIK secara terstruktur\nMembangun kerjasama dengan lembaga AIK Muhammadiyah\nMeningkatkan kualitas SDM pembina AIK");
                            foreach (explode("\n", $misi_raw) as $line):
                                $line = trim($line);
                                if ($line): ?>
                                <li><?php echo esc_html($line); ?></li>
                            <?php endif; endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-panel" id="tab-tujuan" role="tabpanel">
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_tujuan',
                            __('Terwujudnya sivitas akademika yang memiliki pemahaman dan pengamalan Al-Islam dan Kemuhammadiyahan dalam kehidupan sehari-hari.', 'lp3aik-umk')
                        )); ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- STATS BANNER -->
<section class="section--dark section">
    <div class="container">
        <div class="stats-grid">
            <?php
            $stats = [
                [lp3aik_opt('lp3aik_stat_1_num', '500+'), lp3aik_opt('lp3aik_stat_1_label', __('Mahasiswa Terdidik', 'lp3aik-umk'))],
                [lp3aik_opt('lp3aik_stat_2_num', '12'),   lp3aik_opt('lp3aik_stat_2_label', __('Program AIK', 'lp3aik-umk'))],
                [lp3aik_opt('lp3aik_stat_3_num', '20+'),  lp3aik_opt('lp3aik_stat_3_label', __('Tahun Berdiri', 'lp3aik-umk'))],
                [lp3aik_opt('lp3aik_stat_4_num', '30+'),  lp3aik_opt('lp3aik_stat_4_label', __('Tenaga Pengajar', 'lp3aik-umk'))],
            ];
            foreach ($stats as [$num, $label]):
            ?>
            <div class="stat-block">
                <div class="stat-block__num" data-counter="<?php echo esc_attr($num); ?>"><?php echo esc_html($num); ?></div>
                <div class="stat-block__label"><?php echo esc_html($label); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- TIM / PENGURUS -->
<section class="section section--alt">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow"><?php _e('Sumber Daya Manusia', 'lp3aik-umk'); ?></span>
            <h2 class="section-title"><?php _e('Pengurus LP3AIK', 'lp3aik-umk'); ?></h2>
        </div>

        <?php
        $team = new WP_Query(['post_type' => 'lp3aik_tim', 'posts_per_page' => 12, 'orderby' => 'menu_order', 'order' => 'ASC']);
        if ($team->have_posts()):
        ?>
        <div class="grid-4">
            <?php while ($team->have_posts()): $team->the_post(); ?>
                <?php get_template_part('template-parts/cards/card', 'team'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
