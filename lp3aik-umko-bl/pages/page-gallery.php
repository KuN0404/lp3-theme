<?php
/**
 * Template: Halaman Galeri (Modern Masonry Grid)
 * Path: pages/page-gallery.php
 */
get_header();
?>

<!-- Archive Hero -->
<section class="lp3aik-archive-hero">
    <div class="container text-center">
        <span class="d-inline-block text-uppercase fw-bold mb-3" style="color:rgba(255,255,255,.65);letter-spacing:.12em;font-size:.8rem;">Dokumentasi</span>
        <h1 class="mb-2">Galeri LP3AIK</h1>
        <p>Dokumentasi kegiatan dan momen berharga LP3AIK UM Kotabumi</p>
    </div>
    <div class="archive-wave" aria-hidden="true">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,55 L0,55 Z" class="shape-fill"></path>
        </svg>
    </div>
</section>

<section class="py-section" style="padding-top:2.5rem;">
    <div class="container">

        <!-- Filter Kategori -->
        <?php
        $filter_terms = get_terms( [ 'taxonomy' => 'kategori_galeri', 'hide_empty' => true ] );
        if ( $filter_terms && ! is_wp_error( $filter_terms ) ) : ?>
        <div class="lp3aik-filter-bar reveal">
            <button class="filter-btn gallery-filter active" data-filter="all">Semua</button>
            <?php foreach ( $filter_terms as $term ) : ?>
            <button class="filter-btn gallery-filter" data-filter="<?php echo esc_attr( $term->slug ); ?>">
                <?php echo esc_html( $term->name ); ?>
                <span class="cat-count-badge"><?php echo absint( $term->count ); ?></span>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Masonry Gallery Grid -->
        <?php
        $gallery_query = new WP_Query( [
            'post_type'      => 'lp3aik_galeri',
            'posts_per_page' => 32,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ] );
        ?>

        <?php if ( $gallery_query->have_posts() ) : ?>

        <div class="gallery-grid-modern" id="galleryGrid">
            <?php
            while ( $gallery_query->have_posts() ) :
                $gallery_query->the_post();
                $img_url   = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                $img_thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: $img_url;
                $title     = get_the_title();
                $desc      = get_the_excerpt() ?: '';
                $terms     = get_the_terms( get_the_ID(), 'kategori_galeri' );
                $cat_slugs = '';
                if ( $terms && ! is_wp_error( $terms ) ) {
                    $cat_slugs = implode( ' ', wp_list_pluck( $terms, 'slug' ) );
                }
                ?>
                <div class="gallery-item gallery-grid-item" data-categories="<?php echo esc_attr( $cat_slugs ); ?>">
                    <div class="gallery-item-inner"
                         data-bs-toggle="modal"
                         data-bs-target="#galleryModal"
                         data-img="<?php echo esc_attr( $img_url ?: $img_thumb ); ?>"
                         data-title="<?php echo esc_attr( $title ); ?>"
                         data-desc="<?php echo esc_attr( $desc ); ?>"
                         role="button"
                         tabindex="0"
                         aria-label="Lihat foto: <?php echo esc_attr( $title ); ?>">
                        <?php if ( $img_thumb ) : ?>
                        <img src="<?php echo esc_url( $img_thumb ); ?>"
                             alt="<?php echo esc_attr( $title ); ?>"
                             style="width:100%; aspect-ratio:4/3; object-fit:cover; display:block;"
                             loading="lazy"
                             decoding="async">
                        <?php else : ?>
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height:160px;">
                            <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
                        </div>
                        <?php endif; ?>
                        <div class="gallery-item-overlay" aria-hidden="true">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else : ?>
        <div class="text-center py-5 reveal">
            <i class="bi bi-images text-muted" style="font-size:4rem;"></i>
            <h4 class="mt-3 text-muted">Belum ada foto galeri</h4>
            <p class="text-muted">Foto akan segera ditambahkan.</p>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="background:#111;">
            <div class="modal-header border-0 pb-1" style="background:#111;">
                <h2 class="modal-title h5 text-white" id="galleryModalLabel"></h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center pt-1 pb-4 px-4" style="background:#111;">
                <img src="" alt="" id="galleryModalImg" class="img-fluid rounded-3"
                     style="max-height:75vh;object-fit:contain;">
                <p id="galleryModalDesc" class="mt-3 text-white-50 small mb-0"></p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>