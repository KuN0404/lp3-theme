<?php
/**
 * Template: Halaman Blog / Berita (Modern)
 * Hero search bar, filter kategori, grid + sidebar
 * Path: home.php
 */
get_header();
?>

<!-- Archive Hero -->
<section class="lp3aik-archive-hero">
    <div class="container text-center">
        <span class="d-inline-block text-uppercase fw-bold mb-3" style="color:rgba(255,255,255,.65);letter-spacing:.12em;font-size:.8rem;">Informasi Terkini</span>
        <h1 class="mb-2">Berita &amp; Informasi</h1>
        <p class="mb-4">Informasi terbaru seputar kegiatan dan program LP3AIK Universitas Muhammadiyah Kotabumi</p>

        <!-- Search Bar -->
        <form class="lp3aik-search-bar" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <i class="bi bi-search text-muted" style="font-size:1.1rem;flex-shrink:0;"></i>
            <input type="search"
                   name="s"
                   value="<?php echo esc_attr( get_search_query() ); ?>"
                   placeholder="Cari berita..."
                   aria-label="Cari berita">
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>
    </div>
    <div class="archive-wave" aria-hidden="true">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,55 L0,55 Z" class="shape-fill"></path>
        </svg>
    </div>
</section>

<!-- Content Area -->
<section class="py-section" style="padding-top:2.5rem;">
    <div class="container">
        <div class="row g-4">

            <!-- Main Grid -->
            <div class="col-lg-8">

                <?php
                $all_cats = get_categories( [ 'hide_empty' => true ] );
                ?>

                <?php if ( have_posts() ) : ?>
                <div class="row g-4">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-sm-6 reveal">
                        <?php get_template_part( 'template-parts/content' ); ?>
                    </div>
                    <?php endwhile; ?>
                </div>

                <div class="mt-5 reveal">
                    <?php lp3aik_pagination(); ?>
                </div>

                <?php else : ?>
                <div class="text-center py-5 reveal">
                    <i class="bi bi-journal-x text-muted" style="font-size:4rem;"></i>
                    <h4 class="mt-3 text-muted">Belum ada berita</h4>
                    <p class="text-muted">Nantikan konten terbaru dari kami.</p>
                </div>
                <?php endif; ?>

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
                    <?php if ( $all_cats ) : ?>
                    <div class="sidebar-widget mb-4">
                        <h5 class="sidebar-widget-title"><i class="bi bi-folder2-open"></i> Kategori</h5>
                        <div class="sidebar-widget-body">
                            <ul class="sidebar-cat-list">
                                <?php foreach ( $all_cats as $cat ) : 
                                    $is_active = is_category( $cat->term_id );
                                ?>
                                <li>
                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                                       class="<?php echo $is_active ? 'active' : ''; ?>">
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

<?php get_footer(); ?>