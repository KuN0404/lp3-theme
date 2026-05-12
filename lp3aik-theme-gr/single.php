<?php
/**
 * Single Post Template
 *
 * @package lp3aik-umk
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb"><?php lp3aik_breadcrumb(); ?></div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="single-wrap">
            <main id="main-content">
                <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>

                    <?php if (has_post_thumbnail()): ?>
                    <div class="single-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                             alt="<?php the_title_attribute(); ?>"
                             loading="eager">
                    </div>
                    <?php endif; ?>

                    <div class="single-meta mb-4">
                        <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo get_the_date('d M Y'); ?></span>
                        <span><i class="fa-solid fa-user-pen" aria-hidden="true"></i> <?php the_author(); ?></span>
                        <?php if ($cats = get_the_category()): ?>
                        <span><i class="fa-solid fa-tag" aria-hidden="true"></i>
                            <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>">
                                <?php echo esc_html($cats[0]->name); ?>
                            </a>
                        </span>
                        <?php endif; ?>
                        <span><i class="fa-regular fa-clock" aria-hidden="true"></i> <?php echo esc_html(lp3aik_reading_time()); ?> <?php _e('baca', 'lp3aik-umk'); ?></span>
                    </div>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php wp_link_pages(); ?>

                    <?php
                    $tags = get_the_tags();
                    if ($tags):
                    ?>
                    <div class="post-tags mt-4">
                        <strong><?php _e('Tag:', 'lp3aik-umk'); ?></strong>
                        <?php foreach ($tags as $tag): ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge badge-primary">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                </article>

                <!-- Post Navigation -->
                <div class="post-navigation mt-4">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    ?>
                    <div class="post-nav-grid">
                        <?php if ($prev): ?>
                        <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="post-nav-link post-nav-link--prev">
                            <span class="post-nav-dir"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> <?php _e('Sebelumnya', 'lp3aik-umk'); ?></span>
                            <span class="post-nav-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                        </a>
                        <?php endif; ?>
                        <?php if ($next): ?>
                        <a href="<?php echo esc_url(get_permalink($next)); ?>" class="post-nav-link post-nav-link--next">
                            <span class="post-nav-dir"><?php _e('Berikutnya', 'lp3aik-umk'); ?> <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
                            <span class="post-nav-title"><?php echo esc_html(get_the_title($next)); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                // Comments
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>

                <?php endwhile; ?>
            </main>

            <aside>
                <div class="sidebar-widget">
                    <h4><?php _e('Berita Terbaru', 'lp3aik-umk'); ?></h4>
                    <?php
                    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => [get_the_ID()]]);
                    while ($recent->have_posts()): $recent->the_post();
                        get_template_part('template-parts/cards/card', 'news-small');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="sidebar-widget">
                    <h4><?php _e('Kategori', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <?php wp_list_categories(['show_count' => true, 'title_li' => '', 'hide_empty' => false]); ?>
                    </ul>
                </div>
                <?php if (is_active_sidebar('blog-sidebar')): ?>
                    <?php dynamic_sidebar('blog-sidebar'); ?>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
