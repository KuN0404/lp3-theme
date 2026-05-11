<?php
/**
 * Template Part: CTA Banner (Modern Wave)
 * Path: template-parts/cta-banner.php
 */
$wa_link     = lp3aik_get_setting( 'whatsapp' );
$kontak_page = get_page_by_path( 'contact' );
$kontak_link = $kontak_page ? get_permalink( $kontak_page->ID ) : home_url( '/contact/' );
?>

<section class="lp3aik-cta-section">

    <!-- Wave Top -->
    <div class="cta-wave-top" aria-hidden="true">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,0 L0,0 Z" class="shape-fill"></path>
        </svg>
    </div>

    <div class="container position-relative" style="z-index:2;">
        <div class="reveal">
            <div class="mb-3" aria-hidden="true">
                <i class="bi bi-chat-quote-fill" style="font-size:3rem;color:var(--color-accent);opacity:.8;"></i>
            </div>
            <h2 class="fw-bold mb-3">Punya <span style="color:var(--color-accent);">Pertanyaan?</span></h2>
            <p>Tim kami siap membantu Anda untuk informasi lebih lanjut tentang program dan layanan LP3AIK Universitas Muhammadiyah Kotabumi.</p>
            <div class="cta-btn-group">
                <a href="<?php echo esc_url( $kontak_link ); ?>" class="btn btn-accent btn-lg shadow">
                    <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                </a>
                <?php if ( $wa_link ) : ?>
                <a href="<?php echo esc_url( $wa_link ); ?>"
                   class="btn btn-success btn-lg shadow"
                   target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Wave Bottom -->
    <div class="cta-wave-bottom" aria-hidden="true">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,0 L0,0 Z" class="shape-fill"></path>
        </svg>
    </div>

</section>
