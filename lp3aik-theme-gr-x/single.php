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
                <?php while (have_posts()): the_post(); 
                    // Track the post view
                    lp3aik_set_post_views(get_the_ID());
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <?php if (has_post_thumbnail()): ?>
                    <div class="entry-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;border-radius:var(--border-radius);">
                    </div>
                    <?php endif; ?>
                    
                    <div class="entry-meta mb-4 d-flex gap-4 align-items-center flex-wrap" style="color:var(--color-text-muted);font-size:0.9rem;border-bottom:1px solid var(--color-border);padding-bottom:1rem;">
                        <span><i class="fa-regular fa-calendar" style="color:var(--color-primary);"></i> <?php echo get_the_date('d M Y'); ?></span>
                        <span><i class="fa-regular fa-circle-user" style="color:var(--color-primary);"></i> <?php the_author(); ?></span>
                        <?php if ($cats = get_the_category()): ?>
                            <span><i class="fa-regular fa-folder-open" style="color:var(--color-primary);"></i> <?php echo esc_html($cats[0]->name); ?></span>
                        <?php endif; ?>
                        <span><i class="fa-regular fa-eye" style="color:var(--color-primary);"></i> <?php echo lp3aik_get_post_views(get_the_ID()); ?> <?php _e('dilihat','lp3aik-umk'); ?></span>
                    </div>

                    <div class="entry-content" style="font-size:1.05rem;line-height:1.8;color:var(--color-text);">
                        <?php the_content(); ?>
                    </div>

                    <!-- Smart Tag Feature -->
                    <?php if (has_tag()): ?>
                    <div class="entry-tags mt-5">
                        <span class="tags-label">
                            <i class="fa-solid fa-tags"></i> <?php _e('Tags:', 'lp3aik-umk'); ?>
                        </span>
                        <div class="tag-cloud">
                            <?php 
                            $post_tags = get_the_tags();
                            if ($post_tags) {
                                foreach ($post_tags as $tag) {
                                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Elegant Social Share Feature -->
                    <div class="entry-share mt-4 pt-4">
                        <h5 class="share-title mb-3">
                            <i class="fa-solid fa-share-nodes"></i>
                            <?php _e('Bagikan Berita', 'lp3aik-umk'); ?>
                        </h5>
                        <div class="share-buttons">
                            <?php
                            $share_url   = rawurlencode(get_permalink());
                            $share_title = rawurlencode(get_the_title());
                            ?>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener" class="btn" style="background:#1877f2;color:#fff;">
                                <i class="fa-brands fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://x.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo $share_title; ?>" target="_blank" rel="noopener" class="btn" style="background:#000000;color:#fff;">
                                <i class="fa-brands fa-x-twitter"></i> X
                            </a>
                            <a href="https://www.threads.net/intent/post?text=<?php echo $share_title . '%20' . $share_url; ?>" target="_blank" rel="noopener" class="btn" style="background:#101010;color:#fff;">
                                <i class="fa-brands fa-threads"></i> Threads
                            </a>
                            <a href="https://api.whatsapp.com/send?text=<?php echo $share_title . '%20' . $share_url; ?>" target="_blank" rel="noopener" class="btn" style="background:#25d366;color:#fff;">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>
                            <button onclick="navigator.clipboard.writeText(window.location.href); alert('<?php echo esc_js(__('Link tautan berhasil disalin! Buka Instagram untuk membagikannya ke Story/Bio Anda.','lp3aik-umk')); ?>');" class="btn btn--instagram" style="background:linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);color:#fff;">
                                <i class="fa-brands fa-instagram"></i> Instagram
                            </button>
                            <button onclick="navigator.clipboard.writeText(window.location.href); alert('<?php echo esc_js(__('Link tautan berhasil disalin!','lp3aik-umk')); ?>');" class="btn btn-outline btn--copy">
                                <i class="fa-solid fa-link"></i> <?php _e('Salin Link','lp3aik-umk'); ?>
                            </button>
                        </div>
                    </div>

                    <!-- Smart Adaptive Post Navigation Grid -->
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    $cards = [];

                    if ($prev_post && $next_post) {
                        $cards[] = ['post' => $prev_post, 'label' => __('Berita Sebelumnya', 'lp3aik-umk'), 'dir' => 'prev'];
                        $cards[] = ['post' => $next_post, 'label' => __('Berita Selanjutnya', 'lp3aik-umk'), 'dir' => 'next'];
                    } elseif ($prev_post && !$next_post) {
                        // Newest Post Context
                        $prevs = get_posts([
                            'posts_per_page' => 2,
                            'post__not_in'   => [get_the_ID()],
                            'date_query'     => [['before' => get_post_time('Y-m-d H:i:s', true, get_the_ID())]],
                        ]);
                        if (!empty($prevs[0])) {
                            $cards[] = ['post' => $prevs[0], 'label' => __('Berita Sebelumnya', 'lp3aik-umk'), 'dir' => 'prev'];
                        }
                        if (!empty($prevs[1])) {
                            $cards[] = ['post' => $prevs[1], 'label' => __('Berita Terdahulu', 'lp3aik-umk'), 'dir' => 'prev'];
                        }
                    } elseif (!$prev_post && $next_post) {
                        // Oldest Post Context
                        $nexts = get_posts([
                            'posts_per_page' => 2,
                            'order'          => 'ASC',
                            'post__not_in'   => [get_the_ID()],
                            'date_query'     => [['after' => get_post_time('Y-m-d H:i:s', true, get_the_ID())]],
                        ]);
                        if (!empty($nexts[0])) {
                            $cards[] = ['post' => $nexts[0], 'label' => __('Berita Selanjutnya', 'lp3aik-umk'), 'dir' => 'next'];
                        }
                        if (!empty($nexts[1])) {
                            $cards[] = ['post' => $nexts[1], 'label' => __('Berita Terbaru', 'lp3aik-umk'), 'dir' => 'next'];
                        }
                    }
                    
                    if (!empty($cards)):
                    ?>
                    <div class="post-navigation-container mt-5 pt-4">
                        <div class="post-nav-grid">
                            <?php foreach ($cards as $card): 
                                $c_post = $card['post'];
                                $c_id   = is_object($c_post) ? $c_post->ID : $c_post;
                                $title  = is_object($c_post) ? $c_post->post_title : get_the_title($c_id);
                                $is_next = ($card['dir'] === 'next');
                            ?>
                                <div class="nav-col <?php echo $is_next ? 'nav-col--next' : ''; ?>">
                                    <span class="nav-label">
                                        <?php if (!$is_next) echo '<i class="fa-solid fa-arrow-left" style="margin-right:4px;"></i>'; ?>
                                        <?php echo esc_html($card['label']); ?>
                                        <?php if ($is_next) echo '<i class="fa-solid fa-arrow-right" style="margin-left:4px;"></i>'; ?>
                                    </span>
                                    
                                    <a href="<?php echo get_permalink($c_id); ?>" class="post-nav-card <?php echo $is_next ? 'post-nav-card--next' : ''; ?>">
                                        <?php if (has_post_thumbnail($c_id)): ?>
                                            <div class="nav-thumb">
                                                <?php echo get_the_post_thumbnail($c_id, 'thumbnail'); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="nav-thumb-fallback">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="nav-text">
                                            <h6><?php echo esc_html($title); ?></h6>
                                            <span class="nav-date">
                                                <i class="fa-regular fa-calendar"></i> <?php echo get_the_date('d M Y', $c_id); ?>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                </article>
                <?php endwhile; ?>
            </main>

            <!-- Sidebar -->
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
