<?php
/**
 * Template Part: Card — Program
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$icon_raw = get_post_meta(get_the_ID(), '_program_icon', true) ?: 'fa-book-open';
$icon_class = str_starts_with($icon_raw, 'fa-') ? $icon_raw : 'fa-book-open';
?>
<div class="program-card">
    <div class="program-card__icon">
        <i class="fa-solid <?php echo esc_attr($icon_class); ?>"></i>
    </div>
    <h3><?php the_title(); ?></h3>
    <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 20)); ?></p>
    <?php if ($sasaran = get_post_meta(get_the_ID(), '_program_sasaran', true)): ?>
        <div style="font-size:.8rem;color:var(--green-mid);margin-bottom:.75rem;">
            <i class="fa-solid fa-user fa-sm"></i> <?php echo esc_html($sasaran); ?>
        </div>
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm"><?php _e('Detail Program','lp3aik-umk'); ?></a>
</div>
