<?php
/**
 * Template Part: Card — Team Member
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<div class="team-card">
    <div class="team-card__avatar">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-team')); ?>" alt="<?php the_title_attribute(); ?>">
        <?php else: ?>
            <div class="d-flex align-items-center justify-content-center" style="width:100%;height:100%;background:var(--green-pale);font-size:2.5rem;">
                <i class="fa-solid fa-user" style="color:var(--green-mid);"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="team-card__name"><?php the_title(); ?></div>
    <div class="team-card__position"><?php echo esc_html(get_post_meta(get_the_ID(), '_tim_jabatan', true)); ?></div>
    <?php if ($unit = get_post_meta(get_the_ID(), '_tim_unit', true)): ?>
        <div class="team-card__dept"><?php echo esc_html($unit); ?></div>
    <?php endif; ?>
    <?php if ($nip = get_post_meta(get_the_ID(), '_tim_nip', true)): ?>
        <div class="team-card__nip"><?php _e('NIP/NIDN:', 'lp3aik-umk'); ?> <?php echo esc_html($nip); ?></div>
    <?php endif; ?>
</div>
