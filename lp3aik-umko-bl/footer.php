</main>

<footer id="site-footer" class="lp3aik-footer">
    <div class="footer-wave">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".15" fill="#C8A951"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".3" fill="#C8A951"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#ffffff"></path>
        </svg>
    </div>
    <div class="footer-main pattern-islamic-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-12 reveal">
                    <div class="footer-brand pe-lg-4">
                        <?php $logo_footer = lp3aik_logo_img('footer'); ?>
                        <?php if ($logo_footer): ?>
                            <div class="footer-logo-wrap mb-3">
                                <?php echo $logo_footer; ?>
                            </div>
                        <?php else: ?>
                            <h4 class="fw-bold text-white mb-2" style="font-family: var(--font-heading); font-size: 1.35rem;">LP3AIK UM Kotabumi</h4>
                        <?php endif; ?>

                        <?php if ($logo_footer_umko = lp3aik_get_setting('logo_footer_umko')): ?>
                            <div class="footer-umko-logo mb-4">
                                <img src="<?php echo esc_url($logo_footer_umko); ?>" alt="UM Kotabumi" style="height: 50px; width: auto; opacity: 0.9;">
                            </div>
                        <?php endif; ?>
                        <p class="text-gold mb-4" style="font-size: 0.95rem; line-height: 1.5;"><?php echo esc_html(lp3aik_get_setting('tagline') ?: 'Lembaga Pembinaan dan Pengembangan Pendidikan Al-Islam dan Kemuhammadiyahan'); ?></p>
                        
                                               <ul class="footer-contact-list mb-4">
                            <?php if ($addr = lp3aik_get_setting('address')): ?>
                            <li>
                                <i class="bi bi-geo-alt"></i>
                                <span><?php echo esc_html($addr); ?></span>
                            </li>
                            <?php endif; ?>
                            
                            <?php if ($email = lp3aik_get_setting('email')): ?>
                            <li>
                                <i class="bi bi-envelope"></i>
                                <span><?php echo esc_html($email); ?></span>
                            </li>
                            <?php endif; ?>
                            
                            <?php if ($phone = lp3aik_get_setting('phone')): ?>
                            <li>
                                <i class="bi bi-telephone"></i>
                                <span><?php echo nl2br(esc_html($phone)); ?></span>
                            </li>
                            <?php endif; ?>
                        </ul>
                        
                        <div class="d-flex gap-3">
                            <?php if ($fb = lp3aik_get_setting('facebook')): ?>
                            <a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="text-white opacity-75 fs-5" style="transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.75'"><i class="bi bi-facebook"></i></a>
                            <?php endif; ?>
                            <?php if ($ig = lp3aik_get_setting('instagram')): ?>
                            <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="text-white opacity-75 fs-5" style="transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.75'"><i class="bi bi-instagram"></i></a>
                            <?php endif; ?>
                            <?php if ($yt = lp3aik_get_setting('youtube')): ?>
                            <a href="<?php echo esc_url($yt); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="text-white opacity-75 fs-5" style="transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.75'"><i class="bi bi-youtube"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 reveal reveal-delay-1">
                    <h5 class="widget-title">Tentang</h5>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/about/')); ?>">Deskripsi Singkat</a></li>
                        <li><a href="<?php echo esc_url(home_url('/vision-mission/')); ?>">Visi dan Misi</a></li>
                        <li><a href="<?php echo esc_url(home_url('/organization/')); ?>">Struktur Organisasi</a></li>
                        <li><a href="<?php echo esc_url(home_url('/programs/')); ?>">Program</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 reveal reveal-delay-2">
                    <h5 class="widget-title">Lainnya</h5>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/news/')); ?>">Berita</a></li>
                        <li><a href="<?php echo esc_url(home_url('/gallery/')); ?>">Galeri</a></li>
                        <li><a href="<?php echo esc_url(home_url('/downloads/')); ?>">Unduhan</a></li>
                        <li><a href="<?php echo esc_url(home_url('/faq/')); ?>">FAQ</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 reveal reveal-delay-3">
                    <?php
                    $maps_embed = lp3aik_get_setting('maps_embed');
                    $maps_src   = $maps_embed ?: 'https://maps.google.com/maps?q=Universitas%20Muhammadiyah%20Kotabumi&t=&z=15&ie=UTF8&iwloc=&output=embed';
                    ?>
                    <div class="footer-map-embed rounded overflow-hidden shadow-sm mt-3" style="height: 250px; width: 100%;">
                        <iframe src="<?php echo esc_url($maps_src); ?>" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container text-center">
            <?php $footer_text = lp3aik_get_setting('footer_text'); ?>
            <p class="footer-copy"><?php echo $footer_text ? esc_html($footer_text) : '&copy; ' . esc_html(date('Y')) . ' ' . get_bloginfo('name') . ' — Universitas Muhammadiyah Kotabumi. All rights reserved.'; ?></p>
        </div>
    </div>
</footer>

<button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
    <i class="bi bi-chevron-up"></i>
</button>

<?php get_template_part('template-parts/floating-translate'); ?>

<?php wp_footer(); ?>
</body>
</html>
