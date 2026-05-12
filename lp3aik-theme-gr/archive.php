<?php
/**
 * Archive Template (Category, Tag, Date, Author)
 *
 * @package lp3aik-umk
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <h1><?php the_archive_title(); ?></h1>
        <?php if (get_the_archive_description()): ?>
        <p class="breadcrumb-desc"><?php the_archive_description(); ?></p>
        <?php endif; ?>
        <div class="breadcrumb"><?php lp3aik_breadcrumb(); ?></div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="single-wrap">
            <main id="main-content">
                <?php if (have_posts()): ?>
                <div class="grid-2 mb-4">
                    <?php while (have_posts()): the_post(); ?>
                        <?php get_template_part('template-parts/cards/card', 'news'); ?>
                    <?php endwhile; ?>
                </div>
                <div class="pagination">
                    <?php echo paginate_links(['type' => 'list', 'prev_text' => '&lsaquo;', 'next_text' => '&rsaquo;']); ?>
                </div>
                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div class="empty-state-icon"><i class="fa-solid fa-inbox" aria-hidden="true"></i></div>
                    <h3><?php _e('Belum ada postingan', 'lp3aik-umk'); ?></h3>
                </div>
                <?php endif; ?>
            </main>
            <aside>
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
                <div class="sidebar-widget">
                    <h4><?php _e('Kategori', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <?php wp_list_categories(['show_count' => true, 'title_li' => '', 'hide_empty' => false]); ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
