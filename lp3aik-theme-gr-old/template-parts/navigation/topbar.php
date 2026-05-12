<?php
/**
 * Template Part: Topbar
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$email = lp3aik_opt('lp3aik_email', 'lp3aik@umkotabumi.ac.id');
$phone = lp3aik_opt('lp3aik_phone', '');
?>
<div class="topbar">
    <div class="container">
        <div class="topbar__inner">
            <div class="topbar__left">
                <span class="topbar__item">
                    <i class="fa-solid fa-envelope fa-sm"></i>
                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                </span>
                <?php if ($phone): ?>
                <span class="topbar__item">
                    <i class="fa-solid fa-phone fa-sm"></i>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                </span>
                <?php endif; ?>
            </div>
            <div class="topbar__right">
                <span class="topbar__item"><i class="fa-solid fa-mosque fa-sm"></i> LP3AIK - Universitas Muhammadiyah Kotabumi</span>
                <?php $socials = lp3aik_social_links(); ?>
                <?php if ($socials): ?>
                <span class="topbar__item" style="gap:.5rem;">
                    <?php foreach ($socials as $social): ?>
                        <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($social['label']); ?>">
                            <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                        </a>
                    <?php endforeach; ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
