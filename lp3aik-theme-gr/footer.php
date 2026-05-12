<?php
/**
 * Footer Template
 *
 * @package lp3aik-umk
 */
?>
</div><!-- #page -->

<?php get_template_part('template-parts/components/quote-banner'); ?>

<footer class="site-footer" role="contentinfo">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand -->
                <div class="footer-brand">
                    <div class="site-logo-wrap mb-3">
                        <?php if (has_custom_logo()): ?>
                            <?php the_custom_logo(); ?>
                        <?php else: ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="d-flex align-items-center gap-2">
                                <div class="site-logo-icon" aria-hidden="true">
                                    <i class="fa-solid fa-mosque"></i>
                                </div>
                                <div class="logo-text-group">
                                    <div class="logo-main"><?php bloginfo('name'); ?></div>
                                    <div class="logo-sub"><?php _e('Universitas Muhammadiyah Kotabumi', 'lp3aik-umk'); ?></div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_tagline',
                        __('Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan — berkomitmen membangun sivitas akademika yang berkarakter Islami.', 'lp3aik-umk')
                    )); ?></p>
                    <div class="footer-social">
                        <?php foreach (lp3aik_social_links() as $social): ?>
                            <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer"
                               aria-label="<?php echo esc_attr($social['label']); ?>">
                                <i class="<?php echo esc_attr($social['icon']); ?>" aria-hidden="true"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="footer-col">
                    <h4><?php _e('Navigasi', 'lp3aik-umk'); ?></h4>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-1',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'depth'          => 1,
                        'fallback_cb'    => function (): void {
                            echo '<ul class="footer-links">';
                            $pages = [
                                'profil'               => __('Profil', 'lp3aik-umk'),
                                'visi-misi'            => __('Visi & Misi', 'lp3aik-umk'),
                                'struktur-organisasi'  => __('Struktur Organisasi', 'lp3aik-umk'),
                                'berita'               => __('Berita', 'lp3aik-umk'),
                                'kontak'               => __('Hubungi Kami', 'lp3aik-umk'),
                            ];
                            foreach ($pages as $slug => $label) {
                                $page = get_page_by_path($slug);
                                $url  = $page ? get_permalink($page) : home_url("/{$slug}/");
                                echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
                            }
                            echo '</ul>';
                        },
                    ]);
                    ?>
                </div>

                <!-- Program -->
                <div class="footer-col">
                    <h4><?php _e('Program AIK', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <li>
                            <a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_program') ?: home_url('/program/')); ?>">
                                <?php _e('Semua Program', 'lp3aik-umk'); ?>
                            </a>
                        </li>
                        <?php
                        $programs = get_posts(['post_type' => 'lp3aik_program', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC']);
                        foreach ($programs as $prog):
                        ?>
                        <li><a href="<?php echo esc_url(get_permalink($prog)); ?>"><?php echo esc_html($prog->post_title); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer-col">
                    <h4><?php _e('Kontak', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <?php if ($addr = lp3aik_opt('lp3aik_address')): ?>
                        <li style="color:rgba(255,255,255,.65);font-size:.85rem;line-height:1.6;margin-bottom:.5rem;">
                            <i class="fa-solid fa-location-dot fa-sm" aria-hidden="true"></i>
                            <?php echo esc_html($addr); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ($email = lp3aik_opt('lp3aik_email', 'lp3aik@umkotabumi.ac.id')): ?>
                        <li>
                            <a href="mailto:<?php echo esc_attr($email); ?>">
                                <i class="fa-solid fa-envelope fa-sm" aria-hidden="true"></i>
                                <?php echo esc_html($email); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if ($phone = lp3aik_opt('lp3aik_phone')): ?>
                        <li>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>">
                                <i class="fa-solid fa-phone fa-sm" aria-hidden="true"></i>
                                <?php echo esc_html($phone); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <?php if (is_active_sidebar('footer-1')): ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php endif; ?>
                </div>

            </div><!-- .footer-grid -->
        </div>
    </div>

    <!-- Footer Bottom Bar -->
    <div class="container">
        <div class="footer-bottom">
            <span>
                &copy; <?php echo esc_html(date('Y')); ?>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>.
                <?php _e('Universitas Muhammadiyah Kotabumi.', 'lp3aik-umk'); ?>
            </span>
            <span>
                <?php _e('Dibuat dengan', 'lp3aik-umk'); ?>
                <i class="fa-solid fa-heart" aria-hidden="true" style="color:var(--color-accent-light);"></i>
                <?php _e('untuk kemajuan', 'lp3aik-umk'); ?>
                <a href="https://muhammadiyah.or.id" target="_blank" rel="noopener noreferrer">
                    <?php _e('Muhammadiyah', 'lp3aik-umk'); ?>
                </a>
            </span>
        </div>
    </div>
</footer>

<?php get_template_part('template-parts/components/back-to-top'); ?>

<?php wp_footer(); ?>
</body>
</html>
