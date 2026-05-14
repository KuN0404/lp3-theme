<?php
/**
 * Template Part: About / Profil Singkat
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<section class="section" id="profil">
    <div class="container">
        <div class="about-grid">
            <div class="about__image-wrap">
                <div class="about__image-main">
                    <?php $about_img = get_theme_mod('lp3aik_about_image'); ?>
                    <?php if ($about_img): ?>
                        <img src="<?php echo esc_url($about_img); ?>" alt="<?php _e('Gedung LP3AIK UM Kotabumi','lp3aik-umk'); ?>" loading="lazy">
                    <?php else: ?>
                        <div class="about__image-placeholder">
                            <i class="fa-solid fa-mosque"></i>
                            <span>LP3AIK UM Kotabumi</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="about__badge-float">
                    <div class="num"><?php echo esc_html(lp3aik_opt('lp3aik_stat_3_num','20+')); ?></div>
                    <div class="label"><?php _e('Tahun<br>Berdiri','lp3aik-umk'); ?></div>
                </div>
            </div>

            <div class="about__content">
                <span class="section-eyebrow"><?php _e('Tentang Kami','lp3aik-umk'); ?></span>
                <h2 class="section-title"><?php _e('LP3AIK UM Kotabumi','lp3aik-umk'); ?></h2>
                <p class="text-muted-color mb-3">
                    <?php echo wp_kses_post(lp3aik_opt('lp3aik_about_text',
                        'LP3AIK (Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan) adalah unit lembaga di Universitas Muhammadiyah Kotabumi yang bertugas mengintegrasikan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek kehidupan akademik.'
                    )); ?>
                </p>
                <p class="text-muted-color mb-4">
                    <?php echo wp_kses_post(lp3aik_opt('lp3aik_about_text2',
                        'Kami berkomitmen mencetak generasi yang tidak hanya unggul secara intelektual, tetapi juga memiliki akhlak mulia dan semangat Kemuhammadiyahan yang kuat.'
                    )); ?>
                </p>

                <!-- Tab Visi Misi -->
                <div class="about__visi-misi">
                    <?php get_template_part('template-parts/components/vision-mission-tabs'); ?>
                </div>

                <?php if (!is_page('profile') && !is_page_template('templates/page-profile.php')): ?>
                <div class="mt-4">
                    <?php $profile_url = ($p = get_page_by_path('profile')) ? get_permalink($p->ID) : home_url('/profile/'); ?>
                    <a href="<?php echo esc_url($profile_url); ?>" class="btn btn-primary">
                        <?php _e('Selengkapnya tentang LP3AIK','lp3aik-umk'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
