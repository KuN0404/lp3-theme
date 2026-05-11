<?php
/**
 * Template: Halaman Pencarian (Modern)
 * Hero search bar, grid hasil, sidebar
 * Path: search.php
 */
get_header();

$search_q    = get_search_query();
$found_posts = $wp_query->found_posts;
?>

<!-- Search Hero -->
<section class="search-hero">
    <div class="container text-center">
        <?php if ( $search_q ) : ?>
        <p class="text-white-50 mb-2 small text-uppercase fw-bold" style="letter-spacing:.1em;">Hasil Pencarian</p>
        <h1 class="mb-1">"<?php echo esc_html( $search_q ); ?>"</h1>
        <p class="mb-4" style="color:rgba(255,255,255,.7);">
            Ditemukan <strong><?php echo esc_html( $found_posts ); ?></strong> hasil
        </p>
        <?php else : ?>
        <h1 class="mb-3">Cari Konten</h1>
        <?php endif; ?>

        <!-- Search Bar -->
        <form class="lp3aik-search-bar" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <i class="bi bi-search text-muted" style="font-size:1.1rem;flex-shrink:0;"></i>
            <input type="search"
                   name="s"
                   value="<?php echo esc_attr( $search_q ); ?>"
                   placeholder="Cari sesuatu..."
                   aria-label="Kata kunci pencarian">
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>
    </div>
    <div class="archive-wave" aria-hidden="true">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,55 L0,55 Z" class="shape-fill"></path>
        </svg>
    </div>
</section>

<!-- Results Area -->
<section class="py-section" style="padding-top:2.5rem;">
    <div class="container">
        <div class="row g-4">

            <!-- Results Grid -->
            <div class="col-lg-8">
                <?php if ( have_posts() ) : ?>
                <div class="row g-4">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-sm-6 reveal">
                        <?php get_template_part( 'template-parts/content' ); ?>
                    </div>
                    <?php endwhile; ?>
                </div>

                <div class="mt-5 reveal">
                    <?php the_posts_pagination( [
                        'mid_size'  => 2,
                        'prev_text' => '<i class="bi bi-chevron-left"></i> Sebelumnya',
                        'next_text' => 'Berikutnya <i class="bi bi-chevron-right"></i>',
                        'class'     => 'justify-content-center',
                    ] ); ?>
                </div>

                <?php else : ?>
                <div class="text-center py-5 reveal">
                    <i class="bi bi-search text-muted" style="font-size:4rem;opacity:.4;"></i>
                    <h4 class="mt-4 text-muted">Tidak ada hasil ditemukan</h4>
                    <p class="text-muted mb-4">Coba gunakan kata kunci yang berbeda atau lebih umum.</p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-house me-2"></i>Kembali ke Beranda
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="lp3aik-news-sidebar">


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

                    <!-- Berita Terbaru -->
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

                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>