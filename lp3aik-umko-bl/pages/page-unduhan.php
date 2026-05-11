<?php
/**
 * Template: Halaman Unduhan
 * Tanpa breadcrumb, filter kategori, daftar file unduhan
 * Path: pages/page-unduhan.php
 */
get_header();
?>

<section class="lp3aik-page-section py-section">
    <div class="container">

        <!-- Page Header -->
        <div class="text-center mb-5 reveal">
            <span class="section-label">Dokumen Resmi</span>
            <h1 class="section-title">Unduhan</h1>
            <p class="text-muted">Unduh dokumen, formulir, dan panduan resmi LP3AIK UM Kotabumi</p>
        </div>

        <!-- Filter Kategori -->
        <?php
        $filter_cats = get_terms( [ 'taxonomy' => 'kategori_unduhan', 'hide_empty' => true ] );
        if ( $filter_cats && ! is_wp_error( $filter_cats ) ) :
        ?>
        <div class="unduhan-filters text-center mb-5 reveal d-flex flex-wrap justify-content-center gap-2">
            <button class="btn btn-outline-primary btn-sm unduhan-filter active" data-filter="all">
                Semua
            </button>
            <?php foreach ( $filter_cats as $cat ) : ?>
            <button class="btn btn-outline-primary btn-sm unduhan-filter"
                    data-filter="<?php echo esc_attr( $cat->slug ); ?>">
                <?php echo esc_html( $cat->name ); ?>
                <span class="badge bg-secondary ms-1"><?php echo esc_html( $cat->count ); ?></span>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Daftar Unduhan -->
        <?php
        $unduhan_query = new WP_Query( [
            'post_type'      => 'lp3aik_unduhan',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order date',
            'order'          => 'ASC',
        ] );
        ?>

        <?php if ( $unduhan_query->have_posts() ) : ?>
        <div class="unduhan-list" id="unduhan-grid">
            <?php while ( $unduhan_query->have_posts() ) : $unduhan_query->the_post();
                $file_url   = esc_url( get_post_meta( get_the_ID(), '_unduhan_file', true ) );
                $file_ext   = $file_url ? strtolower( pathinfo( $file_url, PATHINFO_EXTENSION ) ) : '';
                $file_size  = esc_html( get_post_meta( get_the_ID(), '_unduhan_size', true ) );
                $terms      = get_the_terms( get_the_ID(), 'kategori_unduhan' );
                $cat_slugs  = '';
                $cat_name   = '';
                if ( $terms && ! is_wp_error( $terms ) ) {
                    $cat_slugs = implode( ' ', wp_list_pluck( $terms, 'slug' ) );
                    $cat_name  = $terms[0]->name;
                }
                $icon_map = [
                    'pdf'  => [ 'icon' => 'bi-file-earmark-pdf-fill',  'color' => '#dc2626' ],
                    'doc'  => [ 'icon' => 'bi-file-earmark-word-fill',  'color' => '#2563eb' ],
                    'docx' => [ 'icon' => 'bi-file-earmark-word-fill',  'color' => '#2563eb' ],
                    'xls'  => [ 'icon' => 'bi-file-earmark-excel-fill', 'color' => '#16a34a' ],
                    'xlsx' => [ 'icon' => 'bi-file-earmark-excel-fill', 'color' => '#16a34a' ],
                    'ppt'  => [ 'icon' => 'bi-file-earmark-ppt-fill',   'color' => '#ea580c' ],
                    'pptx' => [ 'icon' => 'bi-file-earmark-ppt-fill',   'color' => '#ea580c' ],
                    'zip'  => [ 'icon' => 'bi-file-earmark-zip-fill',   'color' => '#7c3aed' ],
                ];
                $icon  = $icon_map[ $file_ext ]['icon']  ?? 'bi-file-earmark-fill';
                $color = $icon_map[ $file_ext ]['color'] ?? 'var(--color-primary)';
            ?>
            <div class="lp3aik-unduhan-card reveal unduhan-grid-item"
                 data-categories="<?php echo esc_attr( $cat_slugs ); ?>">
                <div class="unduhan-card-inner">
                    <!-- File Icon/Type -->
                    <div class="unduhan-type-icon" style="background-color:<?php echo esc_attr( $color ); ?>15; color:<?php echo esc_attr( $color ); ?>;">
                        <i class="bi <?php echo esc_attr( $icon ); ?>"></i>
                        <span class="file-ext-badge"><?php echo esc_html( $file_ext ); ?></span>
                    </div>

                    <!-- File Content -->
                    <div class="unduhan-content">
                        <div class="unduhan-header">
                            <h3 class="unduhan-title"><?php the_title(); ?></h3>
                            <?php if ( $cat_name ) : ?>
                            <span class="unduhan-cat-badge">
                                <?php echo esc_html( $cat_name ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ( $desc = get_the_excerpt() ) : ?>
                        <p class="unduhan-description"><?php echo esc_html( $desc ); ?></p>
                        <?php endif; ?>

                        <div class="unduhan-meta-info">
                            <?php if ( $file_size ) : ?>
                            <span class="meta-item"><i class="bi bi-hdd me-1"></i><?php echo esc_html( $file_size ); ?></span>
                            <?php endif; ?>
                            <span class="meta-item">
                                <i class="bi bi-calendar3 me-1"></i>
                                <?php echo esc_html( get_the_date() ); ?>
                            </span>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="unduhan-footer-action">
                        <?php if ( $file_url ) : ?>
                        <a href="<?php echo esc_url( $file_url ); ?>"
                           class="btn-download-modern"
                           download
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="bi bi-download"></i>
                            <span>Unduh</span>
                        </a>
                        <?php else : ?>
                        <span class="btn-download-modern disabled">
                            <i class="bi bi-lock"></i>
                            <span>N/A</span>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else : ?>
        <div class="text-center py-5 reveal">
            <i class="bi bi-folder2-open" style="font-size:3rem;color:var(--color-text-muted);" aria-hidden="true"></i>
            <h3 class="mt-3">Belum ada file unduhan.</h3>
            <p class="text-muted">Dokumen akan segera tersedia.</p>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>