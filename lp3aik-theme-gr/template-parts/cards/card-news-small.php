<?php
/**
 * Template Part: Card — News Small (sidebar list item)
 * Modernized to match Theme 2 news-card-mini style.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<a href="<?php the_permalink(); ?>" class="news-card-mini">
    <div class="news-card-mini__image">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-thumb-sm')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php else: ?>
            <div class="news-card-mini__placeholder">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="news-card-mini__content">
        <?php if ($cats = get_the_category()): ?>
            <span class="news-badge-accent news-badge-accent--sm"><?php echo esc_html($cats[0]->name); ?></span>
        <?php endif; ?>
        <h4 class="news-card-mini__title"><?php the_title(); ?></h4>
        <div class="news-card-mini__date">
            <i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?>
        </div>
    </div>
</a>
