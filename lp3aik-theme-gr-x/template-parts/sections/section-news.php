<?php
/**
 * Template Part: Berita Terbaru
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$posts = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>
<section class="section" id="berita">
    <div class="container">
        <div class="flex-between mb-4 gap-3 flex-wrap">
            <div>
                <span class="section-eyebrow"><?php _e('Info Terbaru','lp3aik-umk'); ?></span>
                <h2 class="section-title mb-0"><?php _e('Berita & Pengumuman','lp3aik-umk'); ?></h2>
            </div>
            <?php $news_url = ($p = get_page_by_path('news')) ? get_permalink($p->ID) : home_url('/news/'); ?>
            <a href="<?php echo esc_url($news_url); ?>" class="btn btn-outline">
                <?php _e('Semua Berita','lp3aik-umk'); ?>
            </a>
        </div>

        <div class="news-featured">
            <?php if ($posts->have_posts()): $posts->the_post(); ?>
                <?php get_template_part('template-parts/cards/card', 'news'); ?>
            <?php endif; ?>

            <div class="news-list">
                <?php while ($posts->have_posts()): $posts->the_post(); ?>
                    <?php get_template_part('template-parts/cards/card-news', 'small'); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
