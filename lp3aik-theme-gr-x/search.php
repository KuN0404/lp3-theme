<?php
/**
 * Search Results Template
 *
 * Menampilkan hasil pencarian sesuai tema LP3AIK.
 * Mengikuti WordPress Template Hierarchy: search.php
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php printf(__('Hasil Pencarian: "%s"', 'lp3aik-umk'), esc_html(get_search_query())); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="single-wrap">
            <!-- Search Results -->
            <main id="main-content">
                <?php if (have_posts()): ?>
                <p class="mb-4" style="color:var(--text-secondary);">
                    <?php printf(
                        _n('Ditemukan %d hasil', 'Ditemukan %d hasil', $wp_query->found_posts, 'lp3aik-umk'),
                        $wp_query->found_posts
                    ); ?>
                </p>
                <div class="grid-2 mb-4">
                    <?php while (have_posts()): the_post(); ?>
                    <article class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card__image">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;font-size:3rem;min-height:180px;">
                                    <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card__body">
                            <?php
                            $post_type = get_post_type();
                            $pt_obj    = get_post_type_object($post_type);
                            if ($pt_obj && $post_type !== 'post'):
                            ?>
                            <div class="card__tag"><?php echo esc_html($pt_obj->labels->singular_name); ?></div>
                            <?php elseif ($cats = get_the_category()): ?>
                            <div class="card__tag"><?php echo esc_html($cats[0]->name); ?></div>
                            <?php endif; ?>
                            <h2 class="card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <div class="card__meta">
                                <span><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    echo paginate_links([
                        'type'      => 'list',
                        'prev_text' => '&lsaquo;',
                        'next_text' => '&rsaquo;',
                    ]);
                    ?>
                </div>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);"><i class="fa-solid fa-search"></i></div>
                    <h3><?php _e('Tidak ada hasil ditemukan','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);"><?php _e('Coba kata kunci lain atau kembali ke beranda.','lp3aik-umk'); ?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary mt-3">
                        <i class="fa-solid fa-home me-1"></i> <?php _e('Kembali ke Beranda','lp3aik-umk'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside>
                <?php get_template_part('template-parts/sidebar/sidebar', 'search'); ?>
                <div class="sidebar-widget">
                    <h4><?php _e('Cari Lagi','lp3aik-umk'); ?></h4>
                    <?php get_search_form(); ?>
                </div>
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
