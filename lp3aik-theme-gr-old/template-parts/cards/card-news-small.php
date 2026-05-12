<?php
/**
 * Template Part: Card — News Small (sidebar list item)
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<a href="<?php the_permalink(); ?>" class="news-item-small">
    <div class="news-item-small__image">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-thumb-sm')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php else: ?>
            <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;">
                <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
            </div>
        <?php endif; ?>
    </div>
    <div>
        <div class="news-item-small__title"><?php the_title(); ?></div>
        <div class="news-item-small__date"><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></div>
    </div>
</a>
