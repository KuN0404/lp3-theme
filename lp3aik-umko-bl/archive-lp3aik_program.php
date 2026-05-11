<?php
/**
 * Template: Arsip Program LP3AIK
 * Hero search bar, filter kategori modern, grid program
 * Path: archive-lp3aik_program.php
 */
get_header();

// Get search query
$search_q = get_search_query();
?>

<!-- Archive Hero -->
<section class="lp3aik-archive-hero">
    <div class="container text-center">
        <span class="d-inline-block text-uppercase fw-bold mb-3" style="color:rgba(255,255,255,.65);letter-spacing:.12em;font-size:.8rem;">Kegiatan Lembaga</span>
        <h1 class="mb-2">Program LP3AIK</h1>
        <p class="mb-4">Berbagai program pembinaan dan pengembangan Al-Islam dan Kemuhammadiyahan</p>

        <!-- Search Bar -->
        <form class="lp3aik-search-bar mb-0" role="search" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'lp3aik_program' ) ); ?>">
            <i class="bi bi-search text-muted" style="font-size:1.1rem;flex-shrink:0;"></i>
            <input type="text"
                   name="s"
                   value="<?php echo esc_attr( get_query_var('s') ); ?>"
                   placeholder="Cari program..."
                   aria-label="Cari program">
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>
    </div>

    <!-- Wave Bottom -->
    <div class="archive-wave" aria-hidden="true">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,55 L0,55 Z" class="shape-fill"></path>
        </svg>
    </div>
</section>

<!-- Filter & Grid -->
<section class="py-section" style="padding-top:2.5rem;">
    <div class="container">

        <!-- Filter Kategori -->
        <?php
        $filter_cats = get_terms( [ 'taxonomy' => 'kategori_program', 'hide_empty' => true ] );
        if ( $filter_cats && ! is_wp_error( $filter_cats ) ) : ?>
        <div class="lp3aik-filter-bar reveal mb-5">
            <button class="filter-btn program-filter active" data-filter="all">Semua</button>
            <?php foreach ( $filter_cats as $cat ) : ?>
            <button class="filter-btn program-filter" data-filter="<?php echo esc_attr( $cat->slug ); ?>">
                <?php echo esc_html( $cat->name ); ?>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Grid -->
        <div class="row g-4 program-grid align-items-stretch">
            <?php
            if ( have_posts() ) :
                $delay = 1;
                while ( have_posts() ) : the_post();
                    $cats      = get_the_terms( get_the_ID(), 'kategori_program' );
                    $cat_slugs = '';
                    if ( $cats && ! is_wp_error( $cats ) ) {
                        $cat_slugs = implode( ' ', wp_list_pluck( $cats, 'slug' ) );
                    }
                    echo '<div class="col-md-6 col-lg-4 d-flex reveal reveal-delay-' . esc_attr( min( $delay, 5 ) ) . ' program-grid-item" data-categories="' . esc_attr( $cat_slugs ) . '">';
                    get_template_part( 'template-parts/content', 'program' );
                    echo '</div>';
                    $delay++;
                endwhile;
            else :
                ?>
                <div class="col-12 text-center py-5 reveal">
                    <i class="bi bi-journal-x text-muted" style="font-size:4rem;"></i>
                    <h4 class="mt-3 text-muted">Program tidak ditemukan</h4>
                    <p class="text-muted">Coba kata kunci lain atau lihat semua program.</p>
                </div>
                <?php
            endif;
            ?>
        </div>

        <!-- Pagination -->
        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <div class="mt-5 reveal">
            <?php the_posts_pagination( [
                'mid_size'  => 2,
                'prev_text' => '<i class="bi bi-chevron-left"></i> Sebelumnya',
                'next_text' => 'Berikutnya <i class="bi bi-chevron-right"></i>',
                'class'     => 'justify-content-center',
            ] ); ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>