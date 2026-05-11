<?php
/**
 * Template Part: Card — News (large featured)
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<article class="card">
    <div class="card__image">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php else: ?>
            <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;font-size:3rem;min-height:200px;">
                <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="card__body">
        <div class="card__tag"><?php _e('Berita Utama','lp3aik-umk'); ?></div>
        <h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
        <div class="card__meta">
            <span><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></span>
            <?php if ($cat = get_the_category()): ?>
                <span><i class="fa-solid fa-tag fa-sm"></i> <?php echo esc_html($cat[0]->name); ?></span>
            <?php endif; ?>
        </div>
    </div>
</article>
