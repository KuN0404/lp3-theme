<?php
/**
 * Template Part: Card — News (large featured)
 * Modernized to match Theme 2 asymmetrical layout with overlay style.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<a href="<?php the_permalink(); ?>" class="news-card-featured">
    <div class="news-card-featured__img-wrap">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php else: ?>
            <div class="news-card-featured__placeholder">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        <?php endif; ?>
        <div class="news-card-featured__overlay"></div>
    </div>
    
    <div class="news-card-featured__body">
        <div class="news-card-featured__meta-top">
            <?php if ($cats = get_the_category()): ?>
                <span class="news-badge-accent"><?php echo esc_html($cats[0]->name); ?></span>
            <?php endif; ?>
            <span class="news-card-featured__date">
                <i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?>
            </span>
        </div>
        <h3 class="news-card-featured__title"><?php the_title(); ?></h3>
        <p class="news-card-featured__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
    </div>
</a>
