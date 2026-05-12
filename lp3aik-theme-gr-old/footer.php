</div><!-- #page -->

<?php get_template_part('template-parts/components/quote-banner'); ?>

<!-- SITE FOOTER -->
<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand -->
                <div class="footer-brand">
                    <div class="site-logo mb-3">
                        <?php if (has_custom_logo()): the_custom_logo(); else: ?>
                            <div class="d-flex align-items-center justify-content-center" style="width:44px;height:44px;background:var(--green-primary);border-radius:50%;font-size:1.3rem;color:var(--white);">
                                <i class="fa-solid fa-mosque"></i>
                            </div>
                        <?php endif; ?>
                        <div class="logo-text-group">
                            <div class="logo-main">LP3AIK</div>
                            <div class="logo-sub">Universitas Muhammadiyah Kotabumi</div>
                        </div>
                    </div>
                    <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_tagline', 'Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan — berkomitmen membangun sivitas akademika yang berkarakter Islami.')); ?></p>

                    <!-- Social -->
                    <div class="footer-social">
                        <?php foreach (lp3aik_social_links() as $social): ?>
                            <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($social['label']); ?>">
                                <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Navigasi -->
                <div class="footer-col">
                    <h4><?php _e('Navigasi', 'lp3aik-umk'); ?></h4>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-1',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-links">';
                            $links = ['/' => 'Beranda', '/profil' => 'Profil', '/program' => 'Program', '/visi-misi' => 'Visi Misi', '/struktur-organisasi' => 'Struktur Organisasi'];
                            foreach ($links as $slug => $name) {
                                echo '<li><a href="' . esc_url(home_url($slug)) . '">' . esc_html($name) . '</a></li>';
                            }
                            echo '</ul>';
                        }
                    ]);
                    ?>
                </div>

                <!-- Program -->
                <div class="footer-col">
                    <h4><?php _e('Program AIK', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_program') ?: home_url('/program')); ?>"><?php _e('Semua Program','lp3aik-umk'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/berita')); ?>"><?php _e('Berita & Pengumuman','lp3aik-umk'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_galeri') ?: home_url('/galeri')); ?>"><?php _e('Galeri Kegiatan','lp3aik-umk'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_unduhan') ?: home_url('/unduhan')); ?>"><?php _e('Unduhan / File','lp3aik-umk'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/kontak')); ?>"><?php _e('Hubungi Kami','lp3aik-umk'); ?></a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="footer-col">
                    <h4><?php _e('Kontak', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <?php if ($addr = lp3aik_opt('lp3aik_address')): ?>
                        <li style="color:rgba(255,255,255,.65);font-size:.85rem;line-height:1.6;margin-bottom:.5rem;">
                            <i class="fa-solid fa-location-dot fa-sm"></i> <?php echo esc_html($addr); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ($email = lp3aik_opt('lp3aik_email','lp3aik@umkotabumi.ac.id')): ?>
                        <li><a href="mailto:<?php echo esc_attr($email); ?>"><i class="fa-solid fa-envelope fa-sm"></i> <?php echo esc_html($email); ?></a></li>
                        <?php endif; ?>
                        <?php if ($phone = lp3aik_opt('lp3aik_phone')): ?>
                        <li><a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>"><i class="fa-solid fa-phone fa-sm"></i> <?php echo esc_html($phone); ?></a></li>
                        <?php endif; ?>
                    </ul>
                    <?php if (is_active_sidebar('footer-1')): ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="container">
        <div class="footer-bottom">
            <span>
                &copy; <?php echo date('Y'); ?>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>.
                <?php _e('Universitas Muhammadiyah Kotabumi. Hak cipta dilindungi.','lp3aik-umk'); ?>
            </span>
            <span>
                <?php _e('Dibuat dengan','lp3aik-umk'); ?> <i class="fa-solid fa-heart" style="color:var(--gold-light);"></i> <?php _e('untuk kemajuan','lp3aik-umk'); ?>
                <a href="https://muhammadiyah.or.id" target="_blank" rel="noopener"><?php _e('Muhammadiyah','lp3aik-umk'); ?></a>
            </span>
        </div>
    </div>
</footer>

<?php get_template_part('template-parts/components/back-to-top'); ?>

<?php wp_footer(); ?>
</body>
</html>
