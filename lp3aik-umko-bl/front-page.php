<?php
/**
 * Template: Beranda (Front Page)
 * Hero Carousel = 5 Berita Terbaru, auto-slide Bootstrap 5
 * Path: front-page.php
 */
get_header();

// --- Hero Carousel: 5 berita terbaru ---
$interval = absint( lp3aik_get_setting( 'hero_interval', '6000' ) );
$interval = $interval > 0 ? $interval : 6000;

$hero_posts = new WP_Query( [
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'ignore_sticky_posts' => true,
] );
?>

<section id="hero" class="lp3aik-hero-carousel" aria-label="Berita Terbaru - Carousel Beranda">
<?php if ( $hero_posts->have_posts() ) : ?>
    <div id="heroCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="<?php echo esc_attr( $interval ); ?>"
         data-bs-touch="true">

        <!-- Indicators -->
        <div class="carousel-indicators">
            <?php
            $idx = 0;
            $hero_posts->rewind_posts();
            while ( $hero_posts->have_posts() ) :
                $hero_posts->the_post();
            ?>
            <button type="button"
                    data-bs-target="#heroCarousel"
                    data-bs-slide-to="<?php echo esc_attr( $idx ); ?>"
                    class="<?php echo $idx === 0 ? 'active' : ''; ?>"
                    aria-current="<?php echo $idx === 0 ? 'true' : 'false'; ?>"
                    aria-label="Slide <?php echo esc_attr( $idx + 1 ); ?>: <?php echo esc_attr( get_the_title() ); ?>">
            </button>
            <?php $idx++; endwhile; wp_reset_postdata(); ?>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            <?php
            $idx = 0;
            $hero_posts->rewind_posts();
            while ( $hero_posts->have_posts() ) :
                $hero_posts->the_post();
                $thumb_url  = has_post_thumbnail()
                    ? get_the_post_thumbnail_url( get_the_ID(), 'lp3aik-hero' )
                    : '';
                $cats       = get_the_category();
                $cat_name   = $cats ? $cats[0]->name : '';
                $excerpt    = lp3aik_get_excerpt( get_the_ID(), 20 );
            ?>
            <div class="carousel-item <?php echo $idx === 0 ? 'active' : ''; ?>"
                 data-bs-interval="<?php echo esc_attr( $interval ); ?>">

                <?php if ( $thumb_url ) : ?>
                <img src="<?php echo esc_url( $thumb_url ); ?>"
                     class="hero-carousel-img"
                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                     loading="<?php echo $idx === 0 ? 'eager' : 'lazy'; ?>">
                <?php else : ?>
                <div class="hero-carousel-img hero-carousel-img--placeholder"></div>
                <?php endif; ?>

                <div class="hero-overlay-dark" aria-hidden="true"></div>
                <div class="hero-pattern-overlay" aria-hidden="true"></div>

                <div class="container hero-content-wrap">
                    <div class="hero-content-inner">
                        <span class="hero-bismillah" aria-hidden="true">بسم الله الرحمن الرحيم</span>
                        <?php if ( $cat_name ) : ?>
                        <span class="hero-slide-category"><?php echo esc_html( $cat_name ); ?></span>
                        <?php endif; ?>
                        <h2 class="hero-carousel-title"><?php the_title(); ?></h2>
                        <p class="hero-carousel-excerpt"><?php echo esc_html( $excerpt ); ?></p>
                        <div class="hero-carousel-buttons">
                            <a href="<?php the_permalink(); ?>"
                               class="btn btn-accent btn-lg">
                                Baca Selengkapnya <i class="bi bi-chevron-right ms-1" aria-hidden="true"></i>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>"
                               class="btn-underline">
                                Lihat Semua Berita <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $idx++; endwhile; wp_reset_postdata(); ?>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sebelumnya</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Berikutnya</span>
        </button>
    </div>

<?php else : ?>
    <!-- Fallback: hero statis jika belum ada berita -->
    <div class="lp3aik-hero-static">
        <div class="hero-deco hero-deco-1" aria-hidden="true"></div>
        <div class="hero-deco hero-deco-2" aria-hidden="true"></div>
        <div class="hero-deco hero-deco-3" aria-hidden="true"></div>
        <div class="container hero-content-wrap">
            <div class="hero-content-inner reveal">
                <span class="hero-bismillah" aria-hidden="true">بسم الله الرحمن الرحيم</span>
                <h1 class="hero-carousel-title">
                    <span class="highlight">LP3AIK</span><br>
                    <?php bloginfo( 'name' ); ?>
                </h1>
                <p class="hero-carousel-excerpt">
                    Lembaga Pembinaan dan Pengembangan Pendidikan Al-Islam dan Kemuhammadiyahan —
                    Universitas Muhammadiyah Kotabumi
                </p>
                <div class="hero-carousel-buttons">
                    <a href="#program-unggulan" class="btn btn-accent btn-lg">
                        Program Kami <i class="bi bi-chevron-right ms-1" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-underline">
                        Hubungi Kami <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</section>

<!-- Quick Links -->
<div class="container">
    <div class="quick-links-row row g-3 justify-content-center">
        <?php
        $quick_links = [
            [ 'href' => '/programs/',  'icon' => 'bi-book',      'label' => 'Program AIK' ],
            [ 'href' => '/news/',      'icon' => 'bi-newspaper', 'label' => 'Berita Terbaru' ],
            [ 'href' => '/downloads/', 'icon' => 'bi-download',  'label' => 'Unduhan' ],
            [ 'href' => '/contact/',   'icon' => 'bi-telephone', 'label' => 'Hubungi Kami' ],
        ];
        foreach ( $quick_links as $ql ) : ?>
        <div class="col-6 col-md-3">
            <a href="<?php echo esc_url( home_url( $ql['href'] ) ); ?>" class="text-decoration-none">
                <div class="quick-link-card text-center">
                    <div class="quick-link-icon" aria-hidden="true"><i class="bi <?php echo esc_attr( $ql['icon'] ); ?>"></i></div>
                    <h6 class="fw-bold mb-0"><?php echo esc_html( $ql['label'] ); ?></h6>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Tentang LP3AIK -->
<section class="lp3aik-about-short py-section section-pattern-dots">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 text-center reveal-left">
                <div class="about-image-wrapper">
                    <div class="about-decorative-box" aria-hidden="true"></div>
                    <?php 
                    $about_img = lp3aik_get_setting('about_image');
                    $about_img_src = $about_img ?: get_template_directory_uri() . '/assets/images/logo.png';
                    ?>
                    <img src="<?php echo esc_url( $about_img_src ); ?>"
                         alt="LP3AIK UM Kotabumi"
                         class="img-fluid"
                         loading="lazy"
                         onerror="this.style.display='none'">
                </div>
            </div>
            <div class="col-lg-7 reveal-right">
                <h2 class="section-title-bar">TENTANG LP3AIK</h2>
                <p class="section-text mb-3">
                    LP3AIK adalah lembaga di lingkungan Universitas Muhammadiyah Kotabumi yang bertanggung jawab
                    atas pembinaan, pengembangan, dan pengkajian nilai-nilai Al-Islam serta internalisasi
                    nilai-nilai Kemuhammadiyahan di seluruh civitas akademika.
                </p>
                <p class="section-text">
                    Lembaga ini mengkoordinasi mata kuliah wajib AIK, menyelenggarakan pelatihan, seminar,
                    dan kegiatan keagamaan kampus, serta menjamin mutu nilai-nilai islami dalam tata kelola dan
                    budaya kampus.
                </p>
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-outline-primary mt-2">
                    Selengkapnya <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistik -->
<section class="lp3aik-stats py-section bg-surface">
    <div class="container">
        <div class="section-header text-center mb-5 reveal">
            <span class="section-label">Statistik</span>
            <h2 class="section-title">Kami Dalam Angka</h2>
        </div>
        <div class="stats-grid">
            <?php
            $defaults = [
                1 => [ 'icon' => 'bi-people-fill',           'count' => 500, 'label' => 'Mahasiswa Aktif' ],
                2 => [ 'icon' => 'bi-journal-bookmark-fill', 'count' => 15,  'label' => 'Program' ],
                3 => [ 'icon' => 'bi-building',              'count' => 10,  'label' => 'Tahun Berdiri' ],
                4 => [ 'icon' => 'bi-person-workspace',      'count' => 50,  'label' => 'Dosen Pengajar' ],
            ];
            $stats = [];
            for ($i = 1; $i <= 4; $i++) {
                $saved_icon  = lp3aik_get_setting("stat_{$i}_icon");
                $saved_count = lp3aik_get_setting("stat_{$i}_count");
                $saved_label = lp3aik_get_setting("stat_{$i}_label");
                $stats[] = [
                    'icon'  => !empty($saved_icon)  ? $saved_icon  : $defaults[$i]['icon'],
                    'count' => !empty($saved_count) ? $saved_count : $defaults[$i]['count'],
                    'label' => !empty($saved_label) ? $saved_label : $defaults[$i]['label']
                ];
            }
            foreach ( $stats as $delay => $s ) : ?>
            <div class="stat-card reveal reveal-delay-<?php echo esc_attr( $delay + 1 ); ?>">
                <div class="stat-icon" aria-hidden="true"><i class="bi <?php echo esc_attr( $s['icon'] ); ?>"></i></div>
                <div class="stat-number" data-count="<?php echo esc_attr( $s['count'] ); ?>" aria-label="<?php echo esc_attr( $s['count'] ); ?>">0</div>
                <div class="stat-label"><?php echo esc_html( $s['label'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Mengapa LP3AIK -->
<section class="why-us-section py-section">
    <div class="container">
        <div class="why-us-header text-center mb-5 reveal">
            <h2 class="why-us-title">Mengapa LP3AIK?</h2>
            <p class="text-white-50">Komitmen kami dalam membangun generasi islami yang akademis dan berakhlak mulia</p>
        </div>
        <div class="why-us-grid reveal">
            <?php
            $reasons = [
                'Pembinaan nilai-nilai Al-Islam secara terpadu dan berkelanjutan',
                'Internalisasi ideologi dan nilai-nilai Kemuhammadiyahan',
                'Koordinasi mata kuliah AIK di seluruh program studi',
                'Pelatihan dan seminar keagamaan berkualitas',
                'Penjaminan mutu nilai-nilai islami dalam tata kelola kampus',
                'Membangun generasi islami, akademis, dan berakhlak mulia',
            ];
            foreach ( $reasons as $i => $reason ) : ?>
            <div class="why-us-item">
                <div class="why-us-number" aria-hidden="true"><?php echo esc_html( $i + 1 ); ?></div>
                <div class="why-us-text"><?php echo esc_html( $reason ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Program Unggulan -->
<section id="program-unggulan" class="programs-section py-section">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-5 reveal flex-wrap gap-2">
            <h2 class="section-title-bar mb-0">PROGRAM UNGGULAN</h2>
            <a href="<?php echo esc_url( home_url( '/programs/' ) ); ?>"
               class="btn btn-outline-primary btn-sm rounded-pill px-4">
                Lihat Semua <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
        </div>
        <div class="row g-4 justify-content-center align-items-stretch">
            <?php
            $programs = new WP_Query( [
                'post_type'      => 'lp3aik_program',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
                'meta_query'     => [
                    [
                        'key'     => '_program_featured',
                        'value'   => '1',
                        'compare' => '=',
                    ],
                ],
            ] );
            // Fallback: jika tidak ada yang featured, tampilkan 3 program terbaru
            if ( ! $programs->have_posts() ) :
                $programs = new WP_Query( [
                    'post_type'      => 'lp3aik_program',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                ] );
            endif;
            if ( $programs->have_posts() ) :
                $delay = 1;
                while ( $programs->have_posts() ) : $programs->the_post();
                    echo '<div class="col-md-6 col-lg-4 d-flex reveal reveal-delay-' . esc_attr( $delay ) . '">';
                    get_template_part( 'template-parts/content', 'program' );
                    echo '</div>';
                    $delay++;
                endwhile;
                wp_reset_postdata();
            else :
                echo '<div class="col-12 text-center reveal"><p class="text-muted">Belum ada program.</p></div>';
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Berita Terbaru (grid bawah hero, terpisah dari carousel) -->
<section class="lp3aik-latest-news py-section bg-surface">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4 reveal flex-wrap gap-2">
            <h2 class="section-title-bar mb-0">BERITA TERBARU</h2>
            <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>"
               class="btn btn-outline-primary btn-sm rounded-pill px-4">
                Lihat Semua <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
        </div>
        <div class="row g-4">
            <?php
            $news = new WP_Query( [ 'posts_per_page' => 5, 'post_status' => 'publish' ] );
            if ( $news->have_posts() ) :
                // Card besar - post pertama
                $news->the_post();
                ?>
                <div class="col-lg-8 reveal">
                    <a href="<?php the_permalink(); ?>" class="text-decoration-none d-block h-100">
                        <div class="news-card-featured h-100">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'lp3aik-hero', [
                                'alt'   => esc_attr( get_the_title() ),
                                'style' => 'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;',
                                'loading' => 'lazy',
                            ] ); ?>
                            <?php endif; ?>
                            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.85),rgba(0,0,0,.1));" aria-hidden="true"></div>
                            <div class="news-card-featured-body">
                                <?php $cats = get_the_category(); if ( $cats ) : ?>
                                <span class="news-category-badge"><?php echo esc_html( $cats[0]->name ); ?></span>
                                <?php endif; ?>
                                <span class="text-white-50 ms-2">
                                    <i class="bi bi-calendar3 me-1" aria-hidden="true"></i>
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                </span>
                                <h3 class="news-card-featured-title"><?php the_title(); ?></h3>
                                <p class="news-card-featured-excerpt">
                                    <?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 20 ) ); ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Mini cards -->
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-3 h-100">
                    <?php
                    $count = 0;
                    while ( $news->have_posts() && $count < 4 ) :
                        $news->the_post();
                        $count++;
                    ?>
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none reveal">
                            <div class="news-card-mini d-flex gap-3 align-items-start">
                                <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'thumbnail', [
                                    'class'   => 'news-card-mini-img',
                                    'alt'     => esc_attr( get_the_title() ),
                                    'loading' => 'lazy',
                                ] ); ?>
                                <?php else : ?>
                                <div class="news-card-mini-img bg-light d-flex align-items-center justify-content-center flex-shrink-0">
                                    <i class="bi bi-newspaper text-muted" aria-hidden="true"></i>
                                </div>
                                <?php endif; ?>
                                <div class="flex-grow-1 min-w-0">
                                    <?php $cats = get_the_category(); if ( $cats ) : ?>
                                    <span class="news-category-badge"><?php echo esc_html( $cats[0]->name ); ?></span>
                                    <?php endif; ?>
                                    <h6 class="news-card-mini-title"><?php the_title(); ?></h6>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1" aria-hidden="true"></i>
                                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                    </small>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php
            else :
                echo '<div class="col-12 text-center reveal"><p class="text-muted">Belum ada berita.</p></div>';
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Galeri Terbaru -->
<section class="lp3aik-latest-gallery py-section">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4 reveal flex-wrap gap-2">
            <h2 class="section-title-bar mb-0">GALERI TERBARU</h2>
            <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"
               class="btn btn-outline-primary btn-sm rounded-pill px-4">
                Lihat Semua <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
        </div>
        <div class="row g-3">
            <?php
            $gallery = new WP_Query( [
                'post_type'      => 'lp3aik_galeri',
                'posts_per_page' => 5,
                'post_status'    => 'publish',
            ] );
            if ( $gallery->have_posts() ) :
                $delay = 1;
                while ( $gallery->have_posts() ) : $gallery->the_post();
                    // 2 item pertama (baris atas) tampil lebih besar, 3 item sisanya (baris bawah) tampil lebih kecil
                    $col_class = ($delay <= 2) ? 'col-md-6' : 'col-md-4';
                    echo '<div class="' . $col_class . ' reveal reveal-delay-' . esc_attr( min( $delay, 5 ) ) . '">';
                    get_template_part( 'template-parts/content', 'galeri' );
                    echo '</div>';
                    $delay++;
                endwhile;
                wp_reset_postdata();
            else :
                echo '<div class="col-12 text-center reveal"><p class="text-muted">Belum ada foto galeri.</p></div>';
            endif;
            ?>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="position-relative">
    <div class="divider-wave-top" aria-hidden="true">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="var(--color-primary-dark)"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="var(--color-primary-dark)"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#fff"></path>
        </svg>
    </div>
    <?php get_template_part( 'template-parts/cta-banner' ); ?>
</section>

<!-- Lightbox Modal Galeri -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h2 class="modal-title h5" id="galleryModalLabel"></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center pt-2">
                <img src="" alt="" id="galleryModalImg" class="img-fluid rounded">
                <p id="galleryModalDesc" class="mt-3 text-muted small"></p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>