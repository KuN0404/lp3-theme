<?php
/**
 * Template Part: Card — Program
 * Refactored to use Featured Images instead of Font Awesome icons.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<div class="program-card">
    <div class="program-card__image">
        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('medium_large', ['class' => 'program-img']); ?>
        <?php else: ?>
            <div class="program-card__placeholder">
                <i class="fa-solid fa-book-open"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="program-card__body">
        <h3 class="program-card__title"><?php the_title(); ?></h3>
        <div class="program-card__excerpt">
            <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 18)); ?></p>
        </div>
        <div class="program-card__action">
            <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">
                <?php _e('Detail Program','lp3aik-umk'); ?> 
                <i class="fa-solid fa-arrow-right-long" style="font-size:0.8em;margin-left:4px;"></i>
            </a>
        </div>
    </div>
</div>
