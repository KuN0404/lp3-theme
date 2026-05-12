<?php
/**
 * Template Name: Berita & Pengumuman
 *
 * @package lp3aik-umk
 */

get_header();

$paged       = max(1, get_query_var('paged'));
$category    = get_query_var('cat') ?: 0;
$posts_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'cat'            => $category ?: null,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
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

            <!-- Posts grid -->
            <main id="main-content">
                <?php if ($posts_query->have_posts()): ?>
                <div class="grid-2 mb-4">
                    <?php while ($posts_query->have_posts()): $posts_query->the_post(); ?>
                    <article class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card__image">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>"
                                     alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                                <div class="card__image-placeholder">
                                    <i class="fa-solid fa-newspaper" aria-hidden="true"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card__body">
                            <?php if ($cats = get_the_category()): ?>
                                <div class="card__tag"><?php echo esc_html($cats[0]->name); ?></div>
                            <?php endif; ?>
                            <h2 class="card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <div class="card__meta">
                                <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo get_the_date('d M Y'); ?></span>
                                <span><i class="fa-solid fa-user-pen" aria-hidden="true"></i> <?php the_author(); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <div class="pagination">
                    <?php
                    echo paginate_links([
                        'total'     => $posts_query->max_num_pages,
                        'type'      => 'list',
                        'prev_text' => '&lsaquo;',
                        'next_text' => '&rsaquo;',
                    ]);
                    ?>
                </div>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div class="empty-state-icon"><i class="fa-solid fa-inbox" aria-hidden="true"></i></div>
                    <h3><?php _e('Belum ada berita', 'lp3aik-umk'); ?></h3>
                    <p class="text-muted"><?php _e('Belum ada berita atau pengumuman yang dipublikasikan.', 'lp3aik-umk'); ?></p>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside>
                <!-- Search -->
                <div class="sidebar-widget">
                    <h4><?php _e('Cari', 'lp3aik-umk'); ?></h4>
                    <?php get_search_form(); ?>
                </div>

                <!-- Recent Posts -->
                <div class="sidebar-widget">
                    <h4><?php _e('Berita Terbaru', 'lp3aik-umk'); ?></h4>
                    <?php
                    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5]);
                    while ($recent->have_posts()): $recent->the_post();
                        get_template_part('template-parts/cards/card', 'news-small');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4><?php _e('Kategori', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <?php
                        wp_list_categories([
                            'show_count' => true,
                            'title_li'   => '',
                            'hide_empty' => false,
                        ]);
                        ?>
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
