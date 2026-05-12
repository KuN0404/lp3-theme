<?php
/**
 * Template: Halaman Kontak (CTA)
 * Tanpa breadcrumb, form kontak aman dengan nonce + honeypot
 * Path: pages/page-contact.php
 */
get_header();

$address   = lp3aik_get_setting( 'address' );
$phone     = lp3aik_get_setting( 'phone' );
$email     = lp3aik_get_setting( 'email' );
$maps      = lp3aik_get_setting( 'maps_embed' );
$ig        = lp3aik_get_setting( 'instagram' );
$fb        = lp3aik_get_setting( 'facebook' );
$yt        = lp3aik_get_setting( 'youtube' );
$wa        = lp3aik_get_setting( 'whatsapp' );
?>

<!-- CTA Banner Atas -->
<section class="lp3aik-cta-hero"
         style="background:linear-gradient(135deg,var(--color-primary-dark),var(--color-primary));">
    <div class="cta-pattern-overlay" aria-hidden="true"></div>
    <div class="container text-center position-relative">
        <div class="reveal">
            <span class="section-label text-white-50">Siap Berkolaborasi?</span>
            <h1 class="cta-heading text-white mb-3">Hubungi LP3AIK</h1>
            <p class="text-white-75 mb-4 mx-auto" style="max-width:540px;">
                Kami siap membantu kebutuhan Anda terkait pembinaan Al-Islam dan Kemuhammadiyahan.
                Jangan ragu untuk menghubungi kami.
            </p>
            <?php 
            if ( $wa ) : 
                if (preg_match('/^[0-9+]+$/', $wa)) {
                    $wa = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $wa);
                }
            ?>
            <a href="<?php echo esc_url( $wa ); ?>"
               class="btn btn-accent btn-lg me-2"
               target="_blank" rel="noopener noreferrer">
                <i class="bi bi-whatsapp me-2" aria-hidden="true"></i>Chat WhatsApp
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="archive-wave" aria-hidden="true">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,55 L0,55 Z" class="shape-fill"></path>
        </svg>
    </div>
</section>

<!-- Konten Utama: Form + Info -->
<section class="lp3aik-page-section py-section">
    <div class="container">
        <div class="row g-5">

            <!-- Form Kontak -->
            <div class="col-lg-7 reveal-left">
                <div class="contact-form-wrapper">
                    <h2 class="section-title-bar mb-4">Kirim Pesan</h2>

                    <!-- Alert hasil form -->
                    <div id="contact-form-result" class="alert d-none mb-4" role="alert" aria-live="polite"></div>

                    <form id="lp3aik-contact-form"
                          class="lp3aik-contact-form"
                          novalidate
                          autocomplete="off">
                        <?php wp_nonce_field( 'lp3aik_nonce', 'nonce' ); ?>

                        <!-- Honeypot-->
                        <div style="display:none;" aria-hidden="true">
                            <label for="lp3aik_hp">Jangan isi kolom ini</label>
                            <input type="text" id="lp3aik_hp" name="honeypot" value="" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="contact-name" class="form-label">
                                    Nama Lengkap <span class="text-danger" aria-hidden="true">*</span>
                                </label>
                                <input type="text"
                                       id="contact-name"
                                       name="name"
                                       class="form-control"
                                       placeholder="Masukkan nama Anda"
                                       required
                                       maxlength="100"
                                       autocomplete="name">
                                <div class="invalid-feedback">Nama wajib diisi.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="contact-email" class="form-label">
                                    Alamat Email <span class="text-danger" aria-hidden="true">*</span>
                                </label>
                                <input type="email"
                                       id="contact-email"
                                       name="email"
                                       class="form-control"
                                       placeholder="contoh@email.com"
                                       required
                                       maxlength="100"
                                       autocomplete="email">
                                <div class="invalid-feedback">Email valid wajib diisi.</div>
                            </div>
                            <div class="col-12">
                                <label for="contact-subject" class="form-label">
                                    Subjek <span class="text-danger" aria-hidden="true">*</span>
                                </label>
                                <input type="text"
                                       id="contact-subject"
                                       name="subject"
                                       class="form-control"
                                       placeholder="Topik pesan Anda"
                                       required
                                       maxlength="200">
                                <div class="invalid-feedback">Subjek wajib diisi.</div>
                            </div>
                            <div class="col-12">
                                <label for="contact-message" class="form-label">
                                    Pesan <span class="text-danger" aria-hidden="true">*</span>
                                </label>
                                <textarea id="contact-message"
                                          name="message"
                                          class="form-control"
                                          rows="5"
                                          placeholder="Tuliskan pesan Anda di sini..."
                                          required
                                          maxlength="2000"></textarea>
                                <div class="invalid-feedback">Pesan wajib diisi.</div>
                            </div>
                            
                            <!-- VERIFIKASI CAPTCHA -->
                            <?php $unique_token = wp_generate_password(16, false); ?>
                            <div class="col-12 mb-2">
                                <div class="p-3 bg-light rounded-3 border">
                                    <label class="form-label fw-bold mb-2">Verifikasi Keamanan <span class="text-danger">*</span></label>
                                    <div class="input-group overflow-hidden shadow-sm" style="border-radius: 0.5rem;">
                                        <div class="bg-white border-end d-flex align-items-center justify-content-center" style="width: 120px; min-height: 46px; flex-shrink: 0;">
                                            <img id="captcha-img" 
                                                 src="<?php echo esc_url(admin_url('admin-ajax.php?action=lp3aik_get_captcha&cap_token=' . $unique_token)); ?>" 
                                                 alt="Captcha Image"
                                                 title="Klik gambar untuk muat ulang"
                                                 aria-label="Captcha Image"
                                                 class="w-100 h-100" 
                                                 style="object-fit: cover; cursor: pointer; font-size: 0; color: transparent;">
                                        </div>
                                        <input type="text" 
                                               name="captcha_input" 
                                               id="captcha_input"
                                               class="form-control border-0 ps-3 py-2" 
                                               placeholder="KETIK KODE DI GAMBAR" 
                                               required 
                                               maxlength="5" 
                                               autocomplete="off"
                                               style="text-transform: uppercase; font-weight: 600; letter-spacing: 2px; background-color: #fff; font-size: 1rem;">
                                        <input type="hidden" name="captcha_token" id="captcha_token" value="<?php echo esc_attr($unique_token); ?>">
                                    </div>
                                    <div class="form-text mt-2" style="font-size:0.8rem;">Masukkan 5 digit huruf/angka acak dari gambar di atas.</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit"
                                        id="contact-submit"
                                        class="btn btn-primary btn-lg w-100">
                                    <span class="btn-text">
                                        <i class="bi bi-send me-2" aria-hidden="true"></i>Kirim Pesan
                                    </span>
                                    <span class="btn-loading d-none">
                                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                        Mengirim...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Kontak -->
            <div class="col-lg-5 reveal-right">
                <div class="contact-info p-4 mb-4">
                    <h2 class="section-title-bar mb-4">Informasi Kontak</h2>

                    <ul class="contact-details list-unstyled mb-0">
                        <?php if ( $address ) : ?>
                        <li>
                            <div class="d-flex gap-3 align-items-start">
                                <div class="contact-icon flex-shrink-0">
                                    <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <strong class="d-block small mb-1" style="color:var(--color-text-primary);">Alamat</strong>
                                    <span class="text-muted"><?php echo nl2br( esc_html( $address ) ); ?></span>
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>

                        <?php if ( $phone ) : ?>
                        <li>
                            <div class="d-flex gap-3 align-items-center">
                                <div class="contact-icon flex-shrink-0">
                                    <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <strong class="d-block small mb-1" style="color:var(--color-text-primary);">Telepon</strong>
                                    <a href="tel:<?php echo esc_attr( lp3aik_parse_phone( $phone ) ); ?>"
                                       class="text-decoration-none text-muted">
                                        <?php echo esc_html( $phone ); ?>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>

                        <?php if ( $email ) : ?>
                        <li>
                            <div class="d-flex gap-3 align-items-center">
                                <div class="contact-icon flex-shrink-0">
                                    <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <strong class="d-block small mb-1" style="color:var(--color-text-primary);">Email</strong>
                                    <a href="mailto:<?php echo esc_attr( sanitize_email( $email ) ); ?>"
                                       class="text-decoration-none text-muted">
                                        <?php echo esc_html( $email ); ?>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Sosial Media -->
                <?php if ( $ig || $fb || $yt || $wa ) : ?>
                <div class="contact-info p-4">
                    <h2 class="section-title-bar mb-4">
                        <i class="bi bi-share-fill me-2" aria-hidden="true"></i>Media Sosial
                    </h2>
                    <div class="d-flex gap-2 flex-wrap">
                        <?php if ( $ig ) : ?>
                        <a href="<?php echo esc_url( $ig ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="social-btn-lg"
                           style="background:#E1306C;"
                           aria-label="Instagram LP3AIK">
                            <i class="bi bi-instagram" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline">Instagram</span>
                        </a>
                        <?php endif; ?>
                        <?php if ( $fb ) : ?>
                        <a href="<?php echo esc_url( $fb ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="social-btn-lg"
                           style="background:#1877F2;"
                           aria-label="Facebook LP3AIK">
                            <i class="bi bi-facebook" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline">Facebook</span>
                        </a>
                        <?php endif; ?>
                        <?php if ( $yt ) : ?>
                        <a href="<?php echo esc_url( $yt ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="social-btn-lg"
                           style="background:#FF0000;"
                           aria-label="YouTube LP3AIK">
                            <i class="bi bi-youtube" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline">YouTube</span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Google Maps -->
        <?php if ( $maps ) : ?>
        <div class="mt-5 reveal">
            <h2 class="section-title-bar mb-4">Lokasi Kami</h2>
            <div class="map-wrapper ratio ratio-21x9">
                <iframe src="<?php echo esc_url( $maps ); ?>"
                        title="Lokasi LP3AIK UM Kotabumi"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        style="border:0;">
                </iframe>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>