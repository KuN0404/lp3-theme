</div><!-- #page -->

<?php get_template_part('template-parts/components/quote-banner'); ?>

<!-- SITE FOOTER -->
<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand & Contact -->
                <div class="footer-brand">
                    <div class="site-logo mb-3 d-flex align-items-center gap-2">
                        <div class="logo-text-group">
                            <div class="logo-main"><?php bloginfo('name'); ?></div>
                            <div class="logo-sub"><?php bloginfo('description'); ?></div>
                        </div>
                    </div>
                    <p class="mb-4"><?php echo wp_kses_post(lp3aik_opt('lp3aik_tagline', __('Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan — berkomitmen membangun sivitas akademika yang berkarakter Islami.', 'lp3aik-umk'))); ?></p>

                    <!-- Moved Contact Info -->
                    <div class="footer-contact-info mb-4">
                        <?php if ($addr = lp3aik_opt('lp3aik_address')): ?>
                        <div class="footer-contact-item d-flex align-items-start gap-2 mb-2">
                            <i class="fa-solid fa-location-dot fa-sm mt-1 text-accent"></i>
                            <span><?php echo esc_html($addr); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($email = lp3aik_opt('lp3aik_email', 'lp3aik@umkotabumi.ac.id')): ?>
                        <div class="footer-contact-item d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-envelope fa-sm text-accent"></i>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($phone = lp3aik_opt('lp3aik_phone')): ?>
                        <div class="footer-contact-item d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-phone fa-sm text-accent"></i>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Social Links -->
                    <div class="footer-social">
                        <?php foreach (lp3aik_social_links() as $social): ?>
                            <a href="<?php echo esc_url($social['url']); ?>"
                               target="_blank" rel="noopener"
                               aria-label="<?php echo esc_attr($social['label']); ?>">
                                <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="footer-col">
                    <h4><?php esc_html_e('Navigasi', 'lp3aik-umk'); ?></h4>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-1',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'fallback_cb'    => function () {
                            $pages = [
                                'profile'        => __('Profil', 'lp3aik-umk'),
                                'vision-mission' => __('Visi & Misi', 'lp3aik-umk'),
                                'org-structure'  => __('Struktur Organisasi', 'lp3aik-umk'),
                                'news'           => __('Berita', 'lp3aik-umk'),
                                'contact'        => __('Hubungi Kami', 'lp3aik-umk'),
                            ];
                            echo '<ul class="footer-links">';
                            echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Beranda', 'lp3aik-umk') . '</a></li>';
                            foreach ($pages as $slug => $name) {
                                $page = get_page_by_path($slug);
                                $url  = $page ? get_permalink($page->ID) : home_url('/' . $slug . '/');
                                $url  = esc_url($url);
                                echo "<li><a href='{$url}'>" . esc_html($name) . "</a></li>";
                            }
                            echo '</ul>';
                        },
                    ]);
                    ?>
                </div>

                <!-- Program AIK -->
                <div class="footer-col">
                    <h4><?php esc_html_e('Program AIK', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <li>
                            <a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_program') ?: home_url('/program/')); ?>">
                                <?php esc_html_e('Semua Program', 'lp3aik-umk'); ?>
                            </a>
                        </li>
                        <li>
                            <?php
                            $news_page = get_page_by_path('news');
                            $news_url  = $news_page ? get_permalink($news_page->ID) : home_url('/news/');
                            ?>
                            <a href="<?php echo esc_url($news_url); ?>">
                                <?php esc_html_e('Berita & Pengumuman', 'lp3aik-umk'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_galeri') ?: home_url('/galeri/')); ?>">
                                <?php esc_html_e('Galeri Kegiatan', 'lp3aik-umk'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_unduhan') ?: home_url('/unduhan/')); ?>">
                                <?php esc_html_e('Unduhan / File', 'lp3aik-umk'); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Google Maps -->
                <div class="footer-col">
                    <div class="footer-map-container">
                        <?php 
                        $default_map = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15902.808450333752!2d104.88050064999999!3d-4.8211231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e38a8cb47225a21%3A0xd2e026f22c44746f!2sUniversitas%20Muhammadiyah%20Kotabumi!5e0!3m2!1sid!2sid!4v1778603675791!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                        $gmaps_code  = lp3aik_opt('lp3aik_gmaps_embed', $default_map);
                        echo $gmaps_code; 
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="container">
        <div class="footer-bottom">
            <span>
                &copy; <?php echo esc_html(date('Y')); ?>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>.
                <?php esc_html_e('Universitas Muhammadiyah Kotabumi. All rights reserved.', 'lp3aik-umk'); ?>
            </span>
            <span>
                <?php esc_html_e('Made with', 'lp3aik-umk'); ?>
                <i class="fa-solid fa-heart" style="color:var(--color-accent-light);"></i>
                <?php esc_html_e('for', 'lp3aik-umk'); ?>
                <a href="https://muhammadiyah.or.id" target="_blank" rel="noopener">
                    <?php esc_html_e('Muhammadiyah', 'lp3aik-umk'); ?>
                </a>
            </span>
        </div>
    </div>
</footer>

<?php get_template_part('template-parts/components/back-to-top'); ?>

<?php wp_footer(); ?>
</body>
</html>
