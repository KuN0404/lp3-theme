<?php
/**
 * Template: Single Post (Berita)
 * Overlapping card hero + sidebar kategori & 10 berita terbaru
 * Path: single.php
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
<?php
$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
lp3aik_set_post_views( get_the_ID() );
$fallback_bg   = 'background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));';
$bg_style      = $thumbnail_url
    ? 'background-image: linear-gradient(rgba(0,40,90,0.82),rgba(0,40,90,0.90)), url(' . esc_url( $thumbnail_url ) . '); background-size:cover; background-position:center;'
    : $fallback_bg;
?>

<!-- Hero -->
<section class="program-hero-wrapper position-relative"
         style="<?php echo $bg_style; ?>
                margin-top: -58px;
                padding-top: calc(2.5rem + 58px);
                padding-bottom: 9rem;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 text-white">
                <?php
                $posts_page_id = get_option( 'page_for_posts' );
                $back_link     = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/news/' );
                ?>
                <a href="<?php echo esc_url( $back_link ); ?>" class="btn-back-program mb-4 d-inline-flex align-items-center text-white text-decoration-none" style="opacity:.85;transition:opacity .3s,transform .3s;">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Berita
                </a>
                <div class="mb-3">
                    <?php $cats = get_the_category(); if ( $cats ) : ?>
                    <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
                       class="badge bg-primary text-uppercase px-3 py-2 rounded-pill shadow-sm text-decoration-none"
                       style="font-size:.75rem;letter-spacing:.05em;font-weight:700;">
                        <?php echo esc_html( $cats[0]->name ); ?>
                    </a>
                    <?php endif; ?>
                </div>
                <h1 class="display-5 fw-bold text-white mb-2" style="line-height:1.25;"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>

<!-- Content + Sidebar -->
<section class="program-content-wrapper position-relative" style="margin-top:-6rem;z-index:10;padding-bottom:5rem;">
    <div class="container">
        <div class="row g-4">

            <!-- Main Article -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg" style="border-radius:1rem;overflow:hidden;">
                    <div class="card-body p-4 p-md-5">

                        <!-- Meta Header -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-4 border-bottom gap-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 bg-light rounded-circle overflow-hidden d-flex align-items-center justify-content-center shadow-sm" style="width:48px;height:48px;flex-shrink:0;">
                                    <?php echo get_avatar( get_the_author_meta('ID'), 48, '', '', ['class' => 'img-fluid'] ); ?>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark"><?php echo esc_html( lp3aik_get_author_name() ); ?></h6>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <time datetime="<?php echo esc_attr( get_the_date('c') ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-3 text-muted small">
                                <?php if ( $cats ) : ?>
                                <span><i class="bi bi-folder me-1 text-primary"></i><?php echo esc_html( $cats[0]->name ); ?></span>
                                <?php endif; ?>
                                <span><i class="bi bi-eye me-1 text-primary"></i><?php echo lp3aik_get_post_views( get_the_ID() ); ?></span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="post-content lp3aik-article-content" style="font-size:1.05rem;line-height:1.85;color:#374151;">
                            <?php the_content(); ?>
                        </div>

                        <!-- Tags & Share -->
                        <div class="mt-5 pt-4 border-top">
                            <div class="row align-items-center g-4">
                                <div class="col-md-7">
                                    <?php if ( has_tag() ) : ?>
                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <strong class="text-dark small me-1"><i class="bi bi-tags me-1 text-primary"></i>TAGS:</strong>
                                        <?php
                                        $tags = get_the_tags();
                                        if ($tags) {
                                            foreach ($tags as $tag) {
                                                echo '<a href="' . esc_url( get_tag_link($tag->term_id) ) . '" class="badge bg-light text-muted border text-decoration-none px-2 py-1" style="font-weight:500;">' . esc_html($tag->name) . '</a>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-5">
                                    <div class="d-flex align-items-center justify-content-md-end gap-3">
                                        <strong class="text-dark small me-1">SHARE:</strong>
                                        <?php
                                        $share_url   = urlencode(get_permalink());
                                        $share_title = urlencode(get_the_title());
                                        ?>
                                        <a href="https://wa.me/?text=<?php echo $share_title . '%20' . $share_url; ?>" target="_blank" class="text-success fs-5" title="Share via WhatsApp" style="transition:transform .3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'"><i class="bi bi-whatsapp"></i></a>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" class="text-primary fs-5" title="Share via Facebook" style="transition:transform .3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'"><i class="bi bi-facebook"></i></a>
                                        <a href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&url=<?php echo $share_url; ?>" target="_blank" class="text-dark fs-5" title="Share via X" style="transition:transform .3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'"><i class="bi bi-twitter-x"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Post Navigation -->
                        <nav class="mt-4 pt-4 border-top d-flex justify-content-between gap-3" aria-label="Navigasi artikel">
                            <div class="text-start" style="max-width:48%;">
                                <?php previous_post_link(
                                    '%link',
                                    '<span class="d-block text-muted small mb-1"><i class="bi bi-arrow-left me-1"></i>Sebelumnya</span><span class="fw-semibold">%title</span>'
                                ); ?>
                            </div>
                            <div class="text-end" style="max-width:48%;">
                                <?php next_post_link(
                                    '%link',
                                    '<span class="d-block text-muted small mb-1">Berikutnya<i class="bi bi-arrow-right ms-1"></i></span><span class="fw-semibold">%title</span>'
                                ); ?>
                            </div>
                        </nav>

                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="lp3aik-news-sidebar">

                   <!-- 10 Berita Terbaru -->
                    <?php
                    $latest = new WP_Query( [ 'posts_per_page' => 10, 'post_status' => 'publish' ] );
                    if ( $latest->have_posts() ) : ?>
                    <div class="sidebar-widget">
                        <h5 class="sidebar-widget-title"><i class="bi bi-clock-history"></i> Berita Terbaru</h5>
                        <div class="sidebar-widget-body">
                            <?php while ( $latest->have_posts() ) : $latest->the_post(); ?>
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                <div class="sidebar-post-mini">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'thumbnail', [
                                        'class' => 'sidebar-post-mini-img',
                                        'alt'   => esc_attr( get_the_title() ),
                                    ] ); ?>
                                    <?php else : ?>
                                    <div class="sidebar-post-mini-placeholder">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                    <?php endif; ?>
                                    <div class="sidebar-post-mini-info">
                                        <div class="title"><?php the_title(); ?></div>
                                        <div class="date">
                                            <i class="bi bi-calendar3 me-1"></i><?php echo esc_html( get_the_date() ); ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                
                    <!-- Kategori -->
                    <?php
                    $all_cats = get_categories( [ 'hide_empty' => true ] );
                    if ( $all_cats ) : ?>
                    <div class="sidebar-widget mb-4">
                        <h5 class="sidebar-widget-title"><i class="bi bi-folder2-open"></i> Kategori</h5>
                        <div class="sidebar-widget-body">
                            <ul class="sidebar-cat-list">
                                <?php foreach ( $all_cats as $cat ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                        <span><?php echo esc_html( $cat->name ); ?></span>
                                        <span class="cat-count"><?php echo absint( $cat->count ); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>


                </div>
            </div>

        </div>
    </div>
</section>

<?php endwhile; ?>
<?php get_footer(); ?>