<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>

<aside id="secondary" class="widget-area">
    <!-- Widget 1: Pencarian -->
    <div class="sidebar-widget sidebar-widget--search">
        <h4><?php _e('Cari Berita', 'lp3aik-umk'); ?></h4>
        <form role="search" method="get" class="search-form-sidebar" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="input-group">
                <input type="search" class="form-control search-input-sidebar" placeholder="<?php esc_attr_e('Ketik kata kunci...', 'lp3aik-umk'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                <button type="submit" class="btn-search-sidebar" aria-label="Cari">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Widget 2: Berita Terbaru (10 items) -->
    <div class="sidebar-widget sidebar-widget--recent">
        <h4><?php _e('Berita Terbaru', 'lp3aik-umk'); ?></h4>
        <div class="news-list-recent">
            <?php
            $current_id = get_the_ID();
            $recent_args = [
                'post_type'      => 'post',
                'posts_per_page' => 10,
                'post_status'    => 'publish',
            ];
            if (is_single() && $current_id) {
                $recent_args['post__not_in'] = [$current_id];
            }
            $recent_query = new WP_Query($recent_args);
            
            if ($recent_query->have_posts()):
                while ($recent_query->have_posts()): $recent_query->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="news-recent-item">
                    <div class="news-recent-item__thumb">
                        <?php if (has_post_thumbnail()): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'thumbnail')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php else: ?>
                            <div class="news-recent-item__fallback">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="news-recent-item__content">
                        <h5 class="news-recent-item__title"><?php the_title(); ?></h5>
                        <span class="news-recent-item__date">
                            <i class="fa-regular fa-calendar"></i> <?php echo get_the_date('d M Y'); ?>
                        </span>
                    </div>
                </a>
                <?php 
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p class="text-muted small">' . __('Belum ada berita terbaru.', 'lp3aik-umk') . '</p>';
            endif;
            ?>
        </div>
    </div>

    <!-- Widget 3: Kategori -->
    <div class="sidebar-widget sidebar-widget--categories">
        <h4><?php _e('Kategori Berita', 'lp3aik-umk'); ?></h4>
        <ul class="sidebar-cat-list">
            <?php
            $categories = get_categories([
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => false
            ]);
            
            foreach ($categories as $category):
                $is_active = is_category($category->term_id) ? 'current-cat' : '';
                ?>
                <li class="cat-item <?php echo esc_attr($is_active); ?>">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                        <span class="cat-name"><?php echo esc_html($category->name); ?></span>
                        <span class="cat-count-badge"><?php echo esc_html($category->count); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>
