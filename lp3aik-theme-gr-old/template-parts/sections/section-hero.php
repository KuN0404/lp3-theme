<?php
/**
 * Template Part: Hero Section — Carousel / Slider
 *
 * Menampilkan hero slider dengan background gambar yang dapat diganti admin
 * melalui Customizer (LP3AIK Theme Options > Hero Slider).
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$slide_count = (int) lp3aik_opt('lp3aik_hero_slide_count', '3');
$interval    = (int) lp3aik_opt('lp3aik_hero_interval', '6000');
$overlay     = (int) lp3aik_opt('lp3aik_hero_overlay', '55');

// Build slides data
$slides = [];
for ($i = 1; $i <= $slide_count; $i++) {
    $slides[] = [
        'image'    => lp3aik_opt("lp3aik_hero_slide_{$i}_image", ''),
        'title'    => lp3aik_opt("lp3aik_hero_slide_{$i}_title", $i === 1 ? 'Membangun Generasi <em>Islami</em> yang Unggul' : ($i === 2 ? 'Pengkajian <em>Al-Islam</em> & Kemuhammadiyahan' : 'Mengabdi dengan <em>Ilmu</em> & Akhlak')),
        'subtitle' => lp3aik_opt("lp3aik_hero_slide_{$i}_subtitle", $i === 1 ? 'Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan — mendidik dengan nilai, mengabdi dengan ilmu.' : ($i === 2 ? 'Mengintegrasikan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek kehidupan akademik.' : 'Membentuk sivitas akademika yang berakhlak mulia dan bersemangat Kemuhammadiyahan.')),
    ];
}

$stats = [
    [lp3aik_opt('lp3aik_stat_1_num','500+'), lp3aik_opt('lp3aik_stat_1_label','Mahasiswa Terdidik')],
    [lp3aik_opt('lp3aik_stat_2_num','12'),   lp3aik_opt('lp3aik_stat_2_label','Program AIK')],
    [lp3aik_opt('lp3aik_stat_3_num','20+'),  lp3aik_opt('lp3aik_stat_3_label','Tahun Berdiri')],
    [lp3aik_opt('lp3aik_stat_4_num','30+'),  lp3aik_opt('lp3aik_stat_4_label','Tenaga Pengajar')],
];

$quick_links = [
    ['fa-mosque',    __('Profil','lp3aik-umk'),  home_url('/profil')],
    ['fa-list-check',__('Program','lp3aik-umk'), get_post_type_archive_link('lp3aik_program') ?: home_url('/program')],
    ['fa-newspaper', __('Berita','lp3aik-umk'),  home_url('/berita')],
    ['fa-images',    __('Galeri','lp3aik-umk'),  get_post_type_archive_link('lp3aik_galeri') ?: home_url('/galeri')],
];
?>
<section class="hero" id="beranda" data-interval="<?php echo esc_attr($interval); ?>">

    <!-- Carousel Background Slides -->
    <div class="hero__carousel" aria-hidden="true">
        <?php foreach ($slides as $idx => $slide): ?>
        <div class="hero__slide <?php echo $idx === 0 ? 'active' : ''; ?>"
            <?php if ($slide['image']): ?>
            style="background-image: url('<?php echo esc_url($slide['image']); ?>');"
            <?php endif; ?>>
        </div>
        <?php endforeach; ?>
        <div class="hero__overlay" style="opacity: <?php echo esc_attr($overlay / 100); ?>;"></div>
    </div>

    <!-- Decorative Pattern -->
    <div class="hero__bg-pattern" aria-hidden="true"></div>

    <div class="hero__inner container">
        <div class="hero__content">
            <p class="hero__arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <p class="hero__bismillah-label">Bismillahirrahmanirrahim</p>
            <span class="hero__eyebrow">LP3AIK — UM Kotabumi</span>

            <!-- Carousel Text Content -->
            <div class="hero__text-carousel">
                <?php foreach ($slides as $idx => $slide): ?>
                <div class="hero__text-slide <?php echo $idx === 0 ? 'active' : ''; ?>" data-slide="<?php echo $idx; ?>">
                    <h1><?php echo wp_kses_post($slide['title']); ?></h1>
                    <p class="hero__tagline"><?php echo esc_html($slide['subtitle']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="hero__actions">
                <a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_program') ?: home_url('/program')); ?>" class="btn btn-gold btn-lg">
                    <i class="fa-solid fa-layer-group"></i>
                    <?php _e('Lihat Program AIK','lp3aik-umk'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/kontak')); ?>" class="btn btn-white btn-lg">
                    <?php _e('Hubungi Kami','lp3aik-umk'); ?>
                </a>
            </div>

            <!-- Slide Indicators -->
            <?php if (count($slides) > 1): ?>
            <div class="hero__indicators">
                <?php for ($i = 0; $i < count($slides); $i++): ?>
                <button class="hero__dot <?php echo $i === 0 ? 'active' : ''; ?>"
                    data-slide="<?php echo $i; ?>"
                    aria-label="<?php printf(__('Slide %d','lp3aik-umk'), $i + 1); ?>"></button>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="hero__visual">
            <div class="hero__stat-cards">
                <?php foreach ($stats as [$num, $label]): ?>
                <div class="hero__stat-card">
                    <div class="hero__stat-num"><?php echo esc_html($num); ?></div>
                    <div class="hero__stat-label"><?php echo esc_html($label); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="hero__quick-links">
                <?php foreach ($quick_links as [$icon, $label, $url]): ?>
                <a href="<?php echo esc_url($url); ?>" class="hero__quick-link">
                    <div class="icon"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></div>
                    <?php echo esc_html($label); ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
