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
                        <div class="d-flex align-items-center justify-content-center" style="width:100%;height:100%;background:linear-gradient(135deg,var(--green-pale),var(--green-ghost));min-height:350px;">
                            <div class="text-center" style="color:var(--green-primary);">
                                <div style="font-size:5rem;margin-bottom:.5rem;"><i class="fa-solid fa-mosque"></i></div>
                                <div style="font-size:.9rem;font-weight:600;">LP3AIK UM Kotabumi</div>
                            </div>
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
                <p style="color:var(--text-secondary);margin-bottom:1rem;">
                    <?php echo wp_kses_post(lp3aik_opt('lp3aik_about_text',
                        'LP3AIK (Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan) adalah unit lembaga di Universitas Muhammadiyah Kotabumi yang bertugas mengintegrasikan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek kehidupan akademik.'
                    )); ?>
                </p>
                <p style="color:var(--text-secondary);margin-bottom:1.5rem;">
                    <?php echo wp_kses_post(lp3aik_opt('lp3aik_about_text2',
                        'Kami berkomitmen mencetak generasi yang tidak hanya unggul secara intelektual, tetapi juga memiliki akhlak mulia dan semangat Kemuhammadiyahan yang kuat.'
                    )); ?>
                </p>

                <!-- Tab Visi Misi -->
                <div class="about__visi-misi">
                    <div class="visi-misi-tabs">
                        <button class="tab-btn active" data-tab="visi"><?php _e('Visi','lp3aik-umk'); ?></button>
                        <button class="tab-btn" data-tab="misi"><?php _e('Misi','lp3aik-umk'); ?></button>
                        <button class="tab-btn" data-tab="tujuan"><?php _e('Tujuan','lp3aik-umk'); ?></button>
                    </div>
                    <div class="tab-panel active" id="tab-visi">
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_visi', 'Menjadi lembaga terdepan dalam pengkajian, pengembangan, dan pengamalan Al-Islam dan Kemuhammadiyahan di lingkungan Universitas Muhammadiyah Kotabumi guna mewujudkan sivitas akademika yang berakhlak mulia.')); ?></p>
                    </div>
                    <div class="tab-panel" id="tab-misi">
                        <ul class="misi-list">
                            <?php
                            $misi = lp3aik_opt('lp3aik_misi', "Mengintegrasikan nilai AIK ke dalam seluruh program akademik\nMenyelenggarakan program pembinaan AIK secara terstruktur\nMengembangkan kajian Islam yang moderat dan berkemajuan\nMemperkuat pengamalan nilai Kemuhammadiyahan dalam kehidupan kampus\nMembangun kerjasama dengan lembaga AIK Persyarikatan");
                            foreach (explode("\n", trim($misi)) as $item):
                                if (trim($item)):
                            ?>
                            <li><?php echo esc_html(trim($item)); ?></li>
                            <?php endif; endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-panel" id="tab-tujuan">
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_tujuan', 'Terwujudnya sivitas akademika Universitas Muhammadiyah Kotabumi yang memiliki pemahaman, penghayatan, dan pengamalan Al-Islam dan Kemuhammadiyahan secara konsisten dan berkelanjutan.')); ?></p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?php echo esc_url(home_url('/profil')); ?>" class="btn btn-primary">
                        <?php _e('Selengkapnya tentang LP3AIK','lp3aik-umk'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
