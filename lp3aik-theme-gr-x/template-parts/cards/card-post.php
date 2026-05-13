<?php
/**
 * Template Part: Card — General Post / News Card
 * Modernized standard post card with top thumbnail, author, date and views counter.
 * Used in Archive, Search, and News templates.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Get view count safely
$views = function_exists('lp3aik_get_post_views') ? lp3aik_get_post_views(get_the_ID()) : '0';
?>
<article class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card__image">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php else: ?>
            <div class="d-flex align-items-center justify-content-center" style="background:var(--color-primary-ghost);width:100%;height:100%;min-height:180px;">
                <i class="fa-solid fa-newspaper" style="color:var(--color-primary-mid);font-size:2.5rem;"></i>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="card__body" style="display: flex; flex-direction: column; flex-grow: 1;">
        <?php if ($cats = get_the_category()): ?>
            <div class="mb-2">
                <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="card__tag"><?php echo esc_html($cats[0]->name); ?></a>
            </div>
        <?php endif; ?>
        
        <h3 class="card__title" style="margin-top: 4px;">
            <a href="<?php the_permalink(); ?>" style="color:var(--color-text);text-decoration:none;font-weight:700;line-height:1.4;"><?php the_title(); ?></a>
        </h3>
        
        <p class="card__excerpt" style="flex-grow: 1; margin-bottom: 1.5rem;">
            <?php echo esc_html(wp_trim_words(get_the_excerpt(), 18, '...')); ?>
        </p>
        
        <div class="card__action-row">
            <a href="<?php the_permalink(); ?>" class="card__read-more">
                <?php _e('Baca Selengkapnya','lp3aik-umk'); ?> <i class="fa-solid fa-arrow-right-long fa-sm" style="margin-left:4px;"></i>
            </a>
            <span class="card__date">
                <i class="fa-regular fa-calendar-days" style="color:var(--color-primary);"></i> <?php echo get_the_date('d M Y'); ?>
            </span>
        </div>
    </div>
    
    <div class="card__footer">
        <div class="card__footer-item">
            <i class="fa-regular fa-circle-user"></i> <span><?php the_author(); ?></span>
        </div>
        <div class="card__footer-item">
            <i class="fa-regular fa-eye"></i> <span><?php echo esc_html($views); ?></span>
        </div>
    </div>
</article>
