<?php
/**
 * Template Name: Hubungi Kami
 *
 * @package lp3aik-umk
 */

get_header();

$email   = lp3aik_opt('lp3aik_email',   'lp3aik@umkotabumi.ac.id');
$phone   = lp3aik_opt('lp3aik_phone',   '');
$address = lp3aik_opt('lp3aik_address', '');
$maps    = lp3aik_opt('lp3aik_maps_embed', '');
?>

<div class="page-hero">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb"><?php lp3aik_breadcrumb(); ?></div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="contact-grid">

            <!-- Contact Info -->
            <div class="contact-info">
                <span class="section-eyebrow"><?php _e('Kontak', 'lp3aik-umk'); ?></span>
                <h2 class="section-title"><?php _e('Hubungi Kami', 'lp3aik-umk'); ?></h2>
                <p class="text-muted mb-4">
                    <?php _e('Kami siap membantu dan menjawab pertanyaan Anda. Silakan hubungi kami melalui informasi berikut atau gunakan formulir kontak.', 'lp3aik-umk'); ?>
                </p>

                <div class="d-flex flex-column gap-3 mb-4">

                    <?php if ($address): ?>
                    <div class="contact-card">
                        <div class="contact-card__icon">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        </div>
                        <div>
                            <div class="contact-card__label"><?php _e('Alamat', 'lp3aik-umk'); ?></div>
                            <div class="contact-card__value"><?php echo wp_kses_post($address); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($email): ?>
                    <div class="contact-card">
                        <div class="contact-card__icon">
                            <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                        </div>
                        <div>
                            <div class="contact-card__label"><?php _e('Email', 'lp3aik-umk'); ?></div>
                            <div class="contact-card__value">
                                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($phone): ?>
                    <div class="contact-card">
                        <div class="contact-card__icon">
                            <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        </div>
                        <div>
                            <div class="contact-card__label"><?php _e('Telepon / WA', 'lp3aik-umk'); ?></div>
                            <div class="contact-card__value">
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

                <!-- Social Links -->
                <?php $socials = lp3aik_social_links(); ?>
                <?php if ($socials): ?>
                <div class="mt-2">
                    <p class="fw-semibold mb-2"><?php _e('Ikuti Kami', 'lp3aik-umk'); ?></p>
                    <div class="d-flex gap-2">
                        <?php foreach ($socials as $social): ?>
                        <a href="<?php echo esc_url($social['url']); ?>"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="<?php echo esc_attr($social['label']); ?>"
                           class="btn btn-outline btn-sm">
                            <i class="<?php echo esc_attr($social['icon']); ?>" aria-hidden="true"></i>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Maps embed -->
                <?php if ($maps): ?>
                <div class="contact-map mt-4">
                    <?php echo wp_kses($maps, ['iframe' => ['src' => true, 'width' => true, 'height' => true, 'style' => true, 'allowfullscreen' => true, 'loading' => true, 'referrerpolicy' => true, 'title' => true]]); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrap">
                <div class="contact-form-card">
                    <h3><?php _e('Kirim Pesan', 'lp3aik-umk'); ?></h3>
                    <p class="text-muted mb-4"><?php _e('Isi formulir berikut dan kami akan merespons secepatnya.', 'lp3aik-umk'); ?></p>

                    <div id="contact-response" role="alert" aria-live="polite"></div>

                    <div id="contact-form">
                        <div class="form-row mb-3">
                            <div class="form-group mb-0">
                                <label class="form-label" for="contact-name"><?php _e('Nama Lengkap', 'lp3aik-umk'); ?> <span aria-hidden="true">*</span></label>
                                <input type="text" id="contact-name" name="contact_name" class="form-control"
                                       placeholder="<?php _e('Nama Anda', 'lp3aik-umk'); ?>" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="form-label" for="contact-email"><?php _e('Alamat Email', 'lp3aik-umk'); ?> <span aria-hidden="true">*</span></label>
                                <input type="email" id="contact-email" name="contact_email" class="form-control"
                                       placeholder="email@contoh.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact-subject"><?php _e('Subjek', 'lp3aik-umk'); ?></label>
                            <input type="text" id="contact-subject" name="contact_subject" class="form-control"
                                   placeholder="<?php _e('Perihal pesan', 'lp3aik-umk'); ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact-message"><?php _e('Pesan', 'lp3aik-umk'); ?> <span aria-hidden="true">*</span></label>
                            <textarea id="contact-message" name="contact_message" class="form-control"
                                      placeholder="<?php _e('Tulis pesan Anda...', 'lp3aik-umk'); ?>" required></textarea>
                        </div>
                        <?php wp_nonce_field('lp3aik_contact', 'contact_nonce'); ?>
                        <button type="button" id="contact-submit" class="btn btn-primary btn-lg w-100">
                            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                            <?php _e('Kirim Pesan', 'lp3aik-umk'); ?>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
