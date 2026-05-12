<?php
/**
 * Template Name: Halaman Kontak
 *
 * Halaman penuh Kontak / Hubungi Kami dengan UI Card modern.
 *
 * @package lp3aik-umk
 */

get_header();

// Ambil data opsi
$email = lp3aik_opt('lp3aik_email', 'lp3aik@umkotabumi.ac.id');
$addr  = lp3aik_opt('lp3aik_address', 'Jl. Hasan Kepala Ratu No. 1052, Sindangsari, Kotabumi, Lampung Utara, Provinsi Lampung, 34517.');
?>

<!-- Page Hero -->
<div class="page-hero" style="display: flex; align-items: center; text-align: center;">
    <div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;background:rgba(255,255,255,.15);border-radius:50%;margin-bottom:1.5rem;color:var(--white);font-size:1.8rem;">
            <i class="fa-solid fa-headset"></i>
        </div>
        <h1 style="margin-bottom:0.5rem;font-size:2.5rem;font-weight:700;"><?php the_title(); ?></h1>
        <p style="color:rgba(255,255,255,.8);max-width:550px;font-size:1.1rem;margin:0 auto;">
            <?php _e('Kami siap membantu Anda jika memiliki kendala dalam proses layanan, konsultasi, maupun pendaftaran program AIK.', 'lp3aik-umk'); ?>
        </p>
    </div>
</div>

<section class="section" style="background:#f8f9fa;">
    <div class="container">
        <div class="row g-4">
            
            <!-- KOLOM KIRI: Informasi Kontak -->
            <div class="col-lg-7">
                <div style="background:var(--white);padding:2.5rem;border-radius:1rem;border:1px solid #eaeaea;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);height:100%;">
                    <h3 style="color:var(--green-dark);margin-bottom:2rem;font-size:1.4rem;font-weight:700;">
                        <?php _e('Informasi Kontak','lp3aik-umk'); ?>
                    </h3>

                    <!-- Email -->
                    <?php if ($email): ?>
                    <div class="d-flex gap-4 mb-4 pb-4" style="border-bottom:1px solid #f3f4f6;">
                        <div style="width:48px;height:48px;background:var(--green-pale);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--green-primary);font-size:1.25rem;flex-shrink:0;">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.75rem;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><?php _e('EMAIL','lp3aik-umk'); ?></div>
                            <div style="font-weight:500;color:#1f2937;font-size:1rem;"><?php echo esc_html($email); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Alamat -->
                    <?php if ($addr): ?>
                    <div class="d-flex gap-4 mb-5 pb-4" style="border-bottom:1px solid #f3f4f6;">
                        <div style="width:48px;height:48px;background:rgba(200, 151, 42, 0.1);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--gold-primary);font-size:1.25rem;flex-shrink:0;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.75rem;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><?php _e('ALAMAT','lp3aik-umk'); ?></div>
                            <div style="font-weight:500;color:#1f2937;font-size:0.95rem;line-height:1.6;"><?php echo esc_html($addr); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Media Sosial -->
                    <h5 style="font-size:0.95rem;font-weight:700;color:#4b5563;margin-bottom:1rem;"><?php _e('Media Sosial','lp3aik-umk'); ?></h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <?php 
                        // Jika ada link tersimpan di theme options, gunakan itu. Kosongkan jika tidak ada.
                        $fb = lp3aik_opt('lp3aik_facebook', '');
                        $ig = lp3aik_opt('lp3aik_instagram', '');
                        $yt = lp3aik_opt('lp3aik_youtube', '');
                        ?>
                        
                        <?php if (!empty($fb)): ?>
                        <a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener" class="btn" style="background:#1877F2;color:white;border-radius:50rem;font-size:0.85rem;font-weight:600;padding:0.5rem 1.25rem;border:none;">
                            <i class="fa-brands fa-facebook me-1"></i> Facebook
                        </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($ig)): ?>
                        <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener" class="btn" style="background:linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);color:white;border-radius:50rem;font-size:0.85rem;font-weight:600;padding:0.5rem 1.25rem;border:none;">
                            <i class="fa-brands fa-instagram me-1"></i> Instagram
                        </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($yt)): ?>
                        <a href="<?php echo esc_url($yt); ?>" target="_blank" rel="noopener" class="btn" style="background:#FF0000;color:white;border-radius:50rem;font-size:0.85rem;font-weight:600;padding:0.5rem 1.25rem;border:none;">
                            <i class="fa-brands fa-youtube me-1"></i> YouTube
                        </a>
                        <?php endif; ?>
                        
                        <?php if (empty($fb) && empty($ig) && empty($yt)): ?>
                        <div style="font-size:0.85rem;color:#9ca3af;">
                            <em><?php _e('Media sosial belum diatur di Customizer.','lp3aik-umk'); ?></em>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: Cards Layanan -->
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4">
                    
                    <!-- Card 1: Jam Layanan -->
                    <div style="background:var(--white);padding:2rem;border-radius:1rem;border:1px solid #eaeaea;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width:36px;height:36px;background:rgba(200, 151, 42, 0.1);color:var(--gold-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <h4 style="margin:0;font-size:1.1rem;font-weight:700;color:var(--green-dark);"><?php _e('Jam Layanan', 'lp3aik-umk'); ?></h4>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3" style="border-bottom:1px solid #f3f4f6;">
                            <span style="font-weight:600;font-size:0.9rem;color:#4b5563;">Senin – Kamis</span>
                            <span style="color:var(--green-primary);font-weight:700;font-size:0.9rem;">08:00 – 16:00 WIB</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3" style="border-bottom:1px solid #f3f4f6;">
                            <span style="font-weight:600;font-size:0.9rem;color:#4b5563;">Jumat</span>
                            <span style="color:var(--green-primary);font-weight:700;font-size:0.9rem;">08:00 – 11:30 WIB</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="font-weight:600;font-size:0.9rem;color:#4b5563;">Sabtu – Minggu</span>
                            <span style="color:#ef4444;font-weight:700;font-size:0.9rem;">Libur</span>
                        </div>
                    </div>

                    <!-- Card 2: Layanan Online -->
                    <div style="background:var(--green-pale);padding:1.5rem 1.5rem;border-radius:1rem;border:1px solid rgba(10, 74, 30, 0.1);">
                        <div class="d-flex align-items-start gap-3">
                            <div style="width:40px;height:40px;background:rgba(10, 74, 30, 0.1);color:var(--green-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div>
                                <h5 style="margin:0 0 0.25rem 0;font-size:1rem;font-weight:700;color:var(--green-dark);">Layanan Online 24/7</h5>
                                <p style="margin:0;font-size:0.85rem;color:var(--green-primary);line-height:1.5;">Pendaftaran online dan pengunggahan dokumen dapat dilakukan kapan saja melalui portal ini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Program Kami -->
                    <div style="background:var(--white);padding:1.5rem;border-radius:1rem;border:1px solid #eaeaea;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:40px;height:40px;background:rgba(200, 151, 42, 0.1);color:var(--gold-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                            <div style="flex-grow:1;">
                                <h5 style="margin:0 0 0.25rem 0;font-size:1rem;font-weight:700;color:var(--green-dark);">Program Kami</h5>
                                <p style="margin:0;font-size:0.85rem;color:#6b7280;">Lihat program AIK yang tersedia</p>
                            </div>
                            <div>
                                <a href="<?php echo esc_url(home_url('/program')); ?>" class="btn" style="border:1px solid var(--green-primary);color:var(--green-primary);border-radius:50rem;font-size:0.85rem;font-weight:600;padding:0.4rem 1.25rem;background:transparent;">
                                    Program Kami
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>