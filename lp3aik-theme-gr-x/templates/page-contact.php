<?php
/**
 * Template Name: Contact Page
 *
 * Contact / Hubungi Kami page with modern card UI.
 *
 * @package lp3aik-umk
 */

get_header();

$email = lp3aik_opt('lp3aik_email', 'lp3aik@umkotabumi.ac.id');
$phone = lp3aik_opt('lp3aik_phone', '');
$addr  = lp3aik_opt('lp3aik_address', 'Jl. Hasan Kepala Ratu No. 1052, Sindangsari, Kotabumi, Lampung Utara, Provinsi Lampung, 34517.');

$program_url = get_post_type_archive_link('lp3aik_program') ?: home_url('/program/');

$fb = lp3aik_opt('lp3aik_facebook', '');
$ig = lp3aik_opt('lp3aik_instagram', '');
$yt = lp3aik_opt('lp3aik_youtube', '');
?>

<!-- Page Hero -->
<div class="page-hero text-center">
    <div class="container">
        <div class="page-hero__icon">
            <i class="fa-solid fa-headset"></i>
        </div>
        <h1><?php the_title(); ?></h1>
        <p class="page-hero__subtitle">
            <?php esc_html_e('Kami siap membantu Anda jika memiliki kendala dalam proses layanan, konsultasi, maupun pendaftaran program AIK.', 'lp3aik-umk'); ?>
        </p>
    </div>
</div>

<section class="section section--alt">
    <div class="container">
        <div class="row g-4">

            <!-- LEFT: Contact Information -->
            <div class="col-lg-7">
                <div class="contact-info-card">
                    <h3 class="contact-info-card__title">
                        <?php esc_html_e('Informasi Kontak', 'lp3aik-umk'); ?>
                    </h3>

                    <?php if ($email): ?>
                    <div class="contact-info-row">
                        <div class="contact-info-row__icon contact-info-row__icon--primary">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <div class="contact-info-row__label"><?php esc_html_e('EMAIL', 'lp3aik-umk'); ?></div>
                            <div class="contact-info-row__value">
                                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($phone): 
                        $phones = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $phone))));
                        if (!empty($phones)):
                    ?>
                    <div class="contact-info-row">
                        <div class="contact-info-row__icon contact-info-row__icon--primary">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <div class="contact-info-row__label"><?php esc_html_e('TELEPON', 'lp3aik-umk'); ?></div>
                            <div class="contact-info-row__value">
                                <?php foreach ($phones as $idx => $item): 
                                    if (empty($item)) continue;
                                    $item_tel = preg_replace('/[^+0-9]/', '', $item);
                                ?>
                                <div class="<?php echo $idx > 0 ? 'mt-1' : ''; ?>">
                                    <a href="tel:<?php echo esc_attr($item_tel); ?>">
                                        <?php echo esc_html($item); ?>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; endif; ?>

                    <?php if ($addr): ?>
                    <div class="contact-info-row">
                        <div class="contact-info-row__icon contact-info-row__icon--accent">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div class="contact-info-row__label"><?php esc_html_e('ALAMAT', 'lp3aik-umk'); ?></div>
                            <div class="contact-info-row__value"><?php echo esc_html($addr); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Social Media -->
                    <h5 class="contact-social__title"><?php esc_html_e('Media Sosial', 'lp3aik-umk'); ?></h5>
                    <div class="contact-social__links">
                        <?php if ($fb): ?>
                        <a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener"
                           class="contact-social__btn contact-social__btn--fb">
                            <i class="fa-brands fa-facebook me-1"></i> Facebook
                        </a>
                        <?php endif; ?>
                        <?php if ($ig): ?>
                        <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener"
                           class="contact-social__btn contact-social__btn--ig">
                            <i class="fa-brands fa-instagram me-1"></i> Instagram
                        </a>
                        <?php endif; ?>
                        <?php if ($yt): ?>
                        <a href="<?php echo esc_url($yt); ?>" target="_blank" rel="noopener"
                           class="contact-social__btn contact-social__btn--yt">
                            <i class="fa-brands fa-youtube me-1"></i> YouTube
                        </a>
                        <?php endif; ?>
                        <?php if (!$fb && !$ig && !$yt): ?>
                        <p class="contact-social__empty">
                            <em><?php esc_html_e('Media sosial belum diatur di Customizer.', 'lp3aik-umk'); ?></em>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Service Cards -->
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4">

                    <!-- Card: Office Hours -->
                    <div class="service-card">
                        <div class="service-card__header">
                            <div class="service-card__icon service-card__icon--accent">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <h4 class="service-card__title"><?php esc_html_e('Jam Layanan', 'lp3aik-umk'); ?></h4>
                        </div>
                        <div class="service-hours">
                            <div class="service-hours__row">
                                <span class="service-hours__day"><?php esc_html_e('Senin – Kamis', 'lp3aik-umk'); ?></span>
                                <span class="service-hours__time text-primary-color">08:00 – 16:00 WIB</span>
                            </div>
                            <div class="service-hours__row">
                                <span class="service-hours__day"><?php esc_html_e('Jumat', 'lp3aik-umk'); ?></span>
                                <span class="service-hours__time text-primary-color">08:00 – 11:30 WIB</span>
                            </div>
                            <div class="service-hours__row">
                                <span class="service-hours__day"><?php esc_html_e('Sabtu – Minggu', 'lp3aik-umk'); ?></span>
                                <span class="service-hours__time" style="color:#ef4444;"><?php esc_html_e('Libur', 'lp3aik-umk'); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Online Service -->
                    <div class="service-card service-card--subtle">
                        <div class="service-card__header">
                            <div class="service-card__icon service-card__icon--primary">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div>
                                <h5 class="service-card__title"><?php esc_html_e('Layanan Online 24/7', 'lp3aik-umk'); ?></h5>
                                <p class="service-card__desc">
                                    <?php esc_html_e('Pendaftaran online dan pengunggahan dokumen dapat dilakukan kapan saja melalui portal ini.', 'lp3aik-umk'); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Program Link -->
                    <div class="service-card">
                        <div class="service-card__header">
                            <div class="service-card__icon service-card__icon--accent">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="service-card__title"><?php esc_html_e('Program Kami', 'lp3aik-umk'); ?></h5>
                                <p class="service-card__desc"><?php esc_html_e('Lihat program AIK yang tersedia', 'lp3aik-umk'); ?></p>
                            </div>
                            <a href="<?php echo esc_url($program_url); ?>" class="btn btn-outline btn-sm">
                                <?php esc_html_e('Lihat', 'lp3aik-umk'); ?>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Full-Width Maps spanning evenly beneath columns and above the quotes -->
        <div class="row mt-4 pt-2">
            <div class="col-12">
                <div class="contact-map-card">
                    <?php 
                    $map_url = lp3aik_opt('lp3aik_gmaps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15902.808450333752!2d104.88050064999999!3d-4.8211231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e38a8cb47225a21%3A0xd2e026f22c44746f!2sUniversitas%20Muhammadiyah%20Kotabumi!5e0!3m2!1sid!2sid!4v1778603675791!5m2!1sid!2sid');
                    if (strpos($map_url, '<iframe') !== false) {
                        preg_match('/src="([^"]+)"/', $map_url, $matches);
                        $map_url = $matches[1] ?? $map_url;
                    }
                    ?>
                    <div class="map-wrapper" style="border-radius: var(--border-radius-lg); overflow: hidden; box-shadow: var(--shadow-md); border: 1px solid var(--color-border); background: var(--color-white); line-height: 0;">
                         <iframe src="<?php echo esc_url($map_url); ?>" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>