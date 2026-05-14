</main>

<footer id="site-footer" class="lp3aik-footer">
    <div class="footer-wave">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 V65 C300,110 800,10 1200,65 V0 Z" opacity=".15" fill="#C8A951"></path>
            <path d="M0,0 V45 C300,90 800,-10 1200,45 V0 Z" opacity=".3" fill="#C8A951"></path>
            <path d="M0,0 V25 C300,70 800,-30 1200,25 V0 Z" fill="#ffffff"></path>
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
