<?php
/**
 * Single Post Template (Halaman Baca Berita)
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
            <!-- Konten Utama Berita -->
            <main id="main-content">
                <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <?php if (has_post_thumbnail()): ?>
                    <div class="entry-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;border-radius:var(--radius-lg);">
                    </div>
                    <?php endif; ?>
                    
                    <div class="entry-meta mb-4 d-flex gap-4 align-items-center flex-wrap" style="color:var(--text-secondary);font-size:0.9rem;border-bottom:1px solid var(--border);padding-bottom:1rem;">
                        <span><i class="fa-regular fa-calendar" style="color:var(--green-primary);"></i> <?php echo get_the_date('d M Y'); ?></span>
                        <span><i class="fa-solid fa-user-pen" style="color:var(--green-primary);"></i> <?php the_author(); ?></span>
                        <?php if ($cats = get_the_category()): ?>
                            <span><i class="fa-solid fa-folder-open" style="color:var(--green-primary);"></i> <?php echo esc_html($cats[0]->name); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="entry-content" style="font-size:1.05rem;line-height:1.8;">
                        <?php the_content(); ?>
                    </div>
                    
                </article>
                <?php endwhile; ?>
            </main>

            <!-- Sidebar (Sama dengan Index) -->
            <aside>
                <!-- Recent Posts -->
                <div class="sidebar-widget">
                    <h4><?php _e('Berita Terbaru','lp3aik-umk'); ?></h4>
                    <?php
                    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => [get_the_ID()]]);
                    while ($recent->have_posts()): $recent->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="news-item-small mb-3" style="display:flex;gap:1rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border);">
                        <div class="news-item-small__image" style="width:70px;height:60px;flex-shrink:0;">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'thumbnail')); ?>" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;border-radius:4px;">
                                    <i class="fa-solid fa-newspaper fa-sm" style="color:var(--green-mid);"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="news-item-small__title" style="font-size:0.85rem;font-weight:600;line-height:1.3;margin-bottom:0.25rem;"><?php the_title(); ?></div>
                            <div class="news-item-small__date" style="font-size:0.75rem;color:var(--text-muted);"><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></div>
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
