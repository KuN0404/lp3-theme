<?php
/**
 * Template Part: Hero Section (Front Page)
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Hero slides from customizer
$slides = [];
for ($i = 1; $i <= 3; $i++) {
    $slides[] = [
        'eyebrow'  => lp3aik_opt("lp3aik_hero_{$i}_eyebrow",  $i === 1 ? __('Al-Islam & Kemuhammadiyahan', 'lp3aik-umk') : ''),
        'title'    => lp3aik_opt("lp3aik_hero_{$i}_title",    ''),
        'em'       => lp3aik_opt("lp3aik_hero_{$i}_em",       ''),
        'tagline'  => lp3aik_opt("lp3aik_hero_{$i}_tagline",  ''),
        'image'    => lp3aik_opt("lp3aik_hero_{$i}_image",    ''),
    ];
}

// Default slide if no customizer data
if (empty(array_filter(array_column($slides, 'title')))) {
    $slides = [
        [
            'eyebrow' => __('Al-Islam & Kemuhammadiyahan', 'lp3aik-umk'),
            'title'   => __('Membangun Generasi', 'lp3aik-umk'),
            'em'      => __('Islami & Berakhlak', 'lp3aik-umk'),
            'tagline' => __('LP3AIK UM Kotabumi hadir untuk mengintegrasikan nilai Al-Islam dan Kemuhammadiyahan dalam kehidupan akademik.', 'lp3aik-umk'),
            'image'   => '',
        ],
        [
            'eyebrow' => __('Program Unggulan', 'lp3aik-umk'),
            'title'   => __('Program AIK', 'lp3aik-umk'),
            'em'      => __('Terstruktur & Bermakna', 'lp3aik-umk'),
            'tagline' => __('Kami menyelenggarakan berbagai program pembinaan AIK yang komprehensif untuk sivitas akademika.', 'lp3aik-umk'),
            'image'   => '',
        ],
        [
            'eyebrow' => __('Bersama Muhammadiyah', 'lp3aik-umk'),
            'title'   => __('Teguh dalam', 'lp3aik-umk'),
            'em'      => __('Nilai & Pengabdian', 'lp3aik-umk'),
            'tagline' => __('Berkomitmen mencetak civitas akademika yang unggul secara intelektual dan mulia dalam akhlak.', 'lp3aik-umk'),
            'image'   => '',
        ],
    ];
}

$program_url = get_post_type_archive_link('lp3aik_program') ?: home_url('/program/');
$galeri_url  = get_post_type_archive_link('lp3aik_galeri')  ?: home_url('/galeri/');
?>

<section class="hero" id="beranda" aria-label="<?php _e('Banner Utama', 'lp3aik-umk'); ?>">

    <!-- Background Carousel -->
    <div class="hero__carousel" aria-hidden="true">
        <?php foreach ($slides as $i => $slide): ?>
            <div class="hero__slide <?php echo $i === 0 ? 'active' : ''; ?>"
                 <?php if ($slide['image']): ?>
                     style="background-image:url('<?php echo esc_url($slide['image']); ?>')"
                 <?php endif; ?>>
            </div>
        <?php endforeach; ?>
        <div class="hero__overlay"></div>
        <div class="hero__bg-pattern"></div>
    </div>

    <div class="hero__inner">

        <!-- Text Content -->
        <div class="hero__content">

            <div class="hero__arabic" aria-label="<?php _e('Bismillahirrahmanirrahim', 'lp3aik-umk'); ?>">
                بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ
            </div>
            <div class="hero__bismillah-label">
                <?php _e('Dengan nama Allah Yang Maha Pengasih, Maha Penyayang', 'lp3aik-umk'); ?>
            </div>

            <!-- Text Carousel Slides -->
            <div class="hero__text-carousel" role="region" aria-live="polite" aria-label="<?php _e('Konten berganti', 'lp3aik-umk'); ?>">
                <?php foreach ($slides as $i => $slide): ?>
                <div class="hero__text-slide <?php echo $i === 0 ? 'active' : ''; ?>">
                    <div class="hero__eyebrow"><?php echo esc_html($slide['eyebrow']); ?></div>
                    <h1>
                        <?php echo esc_html($slide['title']); ?>
                        <?php if ($slide['em']): ?>
                            <br><em><?php echo esc_html($slide['em']); ?></em>
                        <?php endif; ?>
                    </h1>
                    <p class="hero__tagline"><?php echo esc_html($slide['tagline']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="hero__actions">
                <a href="<?php echo esc_url($program_url); ?>" class="btn btn-accent btn-lg">
                    <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                    <?php _e('Lihat Program', 'lp3aik-umk'); ?>
                </a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('profil')) ?: home_url('/profil/')); ?>" class="btn btn-white btn-lg">
                    <?php _e('Tentang Kami', 'lp3aik-umk'); ?>
                </a>
            </div>

            <div class="hero__indicators" role="tablist" aria-label="<?php _e('Navigasi slide', 'lp3aik-umk'); ?>">
                <?php foreach ($slides as $i => $slide): ?>
                    <button class="hero__dot <?php echo $i === 0 ? 'active' : ''; ?>"
                            role="tab"
                            aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                            aria-label="<?php echo sprintf(__('Slide %d', 'lp3aik-umk'), $i + 1); ?>"
                            data-slide="<?php echo $i; ?>">
                    </button>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Visual Side: Stats + Quick Links -->
        <div class="hero__visual" aria-label="<?php _e('Statistik LP3AIK', 'lp3aik-umk'); ?>">
            <div class="hero__stat-cards">
                <?php
                $stats = [
                    [lp3aik_opt('lp3aik_stat_1_num', '500+'), lp3aik_opt('lp3aik_stat_1_label', __('Mahasiswa Terdidik', 'lp3aik-umk')), 'fa-users'],
                    [lp3aik_opt('lp3aik_stat_2_num', '12'),   lp3aik_opt('lp3aik_stat_2_label', __('Program AIK', 'lp3aik-umk')),       'fa-book-open'],
                    [lp3aik_opt('lp3aik_stat_3_num', '20+'),  lp3aik_opt('lp3aik_stat_3_label', __('Tahun Berdiri', 'lp3aik-umk')),     'fa-landmark'],
                    [lp3aik_opt('lp3aik_stat_4_num', '30+'),  lp3aik_opt('lp3aik_stat_4_label', __('Tenaga Pengajar', 'lp3aik-umk')),   'fa-chalkboard-user'],
                ];
                foreach ($stats as [$num, $label, $icon]):
                ?>
                <div class="hero__stat-card">
                    <div class="hero__stat-icon" aria-hidden="true"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></div>
                    <div class="hero__stat-num" data-counter="<?php echo esc_attr($num); ?>"><?php echo esc_html($num); ?></div>
                    <div class="hero__stat-label"><?php echo esc_html($label); ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="hero__quick-links">
                <?php
                $quick_links = [
                    ['fa-book-open-reader', __('Program',    'lp3aik-umk'), $program_url],
                    ['fa-newspaper',        __('Berita',     'lp3aik-umk'), get_permalink(get_page_by_path('berita')) ?: home_url('/berita/')],
                    ['fa-images',           __('Galeri',     'lp3aik-umk'), $galeri_url],
                    ['fa-download',         __('Unduhan',    'lp3aik-umk'), get_post_type_archive_link('lp3aik_unduhan') ?: home_url('/unduhan/')],
                ];
                foreach ($quick_links as [$icon, $label, $url]):
                ?>
                <a href="<?php echo esc_url($url); ?>" class="hero__quick-link">
                    <span class="icon" aria-hidden="true"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></span>
                    <?php echo esc_html($label); ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
