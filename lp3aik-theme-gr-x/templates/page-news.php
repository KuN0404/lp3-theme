<?php
/**
 * Template Name: Halaman Berita
 *
 * Halaman penuh daftar Berita & Pengumuman.
 * Menggantikan index.php untuk halaman /berita.
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="single-wrap">
            <!-- Posts -->
            <main id="main-content">
                <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $posts_query = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 8,
                    'paged'          => $paged,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);
                ?>
                <?php if ($posts_query->have_posts()): ?>
                <div class="grid-2 mb-4">
                    <?php while ($posts_query->have_posts()): $posts_query->the_post(); ?>
                    <article class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card__image">
                            <?php if (has_post_thumbnail()): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>"
                                alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center"
                                style="background:var(--green-pale);width:100%;height:100%;font-size:3rem;min-height:180px;">
                                <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
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
                            <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <div class="card__meta">
                                <span><i class="fa-regular fa-calendar fa-sm"></i>
                                    <?php echo get_the_date('d M Y'); ?></span>
                                <span><i class="fa-solid fa-user-pen fa-sm"></i> <?php the_author(); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- Pagination -->
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
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                    <h3><?php _e('Belum ada berita','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);">
                        <?php _e('Belum ada berita atau pengumuman yang dipublikasikan.','lp3aik-umk'); ?>
                    </p>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside>
                <!-- Recent Posts -->
                <div class="sidebar-widget">
                    <h4><?php _e('Berita Terbaru','lp3aik-umk'); ?></h4>
                    <?php
                    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5]);
                    while ($recent->have_posts()): $recent->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="news-item-small mb-3"
                        style="display:flex;gap:1rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border);">
                        <div class="news-item-small__image" style="width:70px;height:60px;flex-shrink:0;">
                            <?php if (has_post_thumbnail()): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'thumbnail')); ?>" alt=""
                                style="width:100%;height:100%;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center"
                                style="background:var(--green-pale);width:100%;height:100%;border-radius:4px;">
                                <i class="fa-solid fa-newspaper fa-sm" style="color:var(--green-mid);"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="news-item-small__title"
                                style="font-size:0.85rem;font-weight:600;line-height:1.3;margin-bottom:0.25rem;">
                                <?php the_title(); ?></div>
                            <div class="news-item-small__date" style="font-size:0.75rem;color:var(--text-muted);"><i
                                    class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></div>
                        </div>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4><?php _e('Kategori','lp3aik-umk'); ?></h4>
                    <ul class="footer-links" style="gap:.4rem;">
                        <?php wp_list_categories(['show_count' => true, 'title_li' => '', 'hide_empty' => false]); ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>