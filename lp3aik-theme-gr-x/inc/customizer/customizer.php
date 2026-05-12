<?php
/**
 * Customizer: Theme Options Panel.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {

    // Panel: LP3AIK
    $wp_customize->add_panel('lp3aik_panel', [
        'title'    => __('LP3AIK Theme Options', 'lp3aik-umk'),
        'priority' => 10,
    ]);

    // ── Section: Header & Logo ──────────────────────────────
    $wp_customize->add_section('lp3aik_header', [
        'title'       => __('Header & Logo', 'lp3aik-umk'),
        'panel'       => 'lp3aik_panel',
        'priority'    => 1,
        'description' => __('Atur tampilan logo dan header navigasi.', 'lp3aik-umk'),
    ]);

    // Logo mode: compact (image + name + slogan) or wide (image only)
    $wp_customize->add_setting('lp3aik_logo_mode', [
        'default'           => 'compact',
        'sanitize_callback' => 'sanitize_key',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('lp3aik_logo_mode', [
        'label'       => __('Mode Logo', 'lp3aik-umk'),
        'description' => __('<b>Compact</b>: Ikon/gambar + nama situs + slogan.<br><b>Wide</b>: Gambar logo saja (cocok untuk logo horizontal panjang).', 'lp3aik-umk'),
        'section'     => 'lp3aik_header',
        'type'        => 'select',
        'choices'     => [
            'compact' => __('Compact — Ikon + Nama + Slogan', 'lp3aik-umk'),
            'wide'    => __('Wide — Gambar Logo Saja', 'lp3aik-umk'),
        ],
    ]);

    // Logo max height (in px)
    $wp_customize->add_setting('lp3aik_logo_height', [
        'default'           => '40',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage', // live preview
    ]);
    $wp_customize->add_control('lp3aik_logo_height', [
        'label'       => __('Tinggi Logo (px)', 'lp3aik-umk'),
        'description' => __('Ukuran tinggi gambar logo di navbar. Default: 40px.', 'lp3aik-umk'),
        'section'     => 'lp3aik_header',
        'type'        => 'range',
        'input_attrs' => ['min' => 28, 'max' => 70, 'step' => 2],
    ]);

    // Show/hide topbar
    $wp_customize->add_setting('lp3aik_show_topbar', [
        'default'           => '1',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('lp3aik_show_topbar', [
        'label'   => __('Tampilkan Topbar (Info Kontak)', 'lp3aik-umk'),
        'section' => 'lp3aik_header',
        'type'    => 'checkbox',
    ]);

    // Show/hide ticker
    $wp_customize->add_setting('lp3aik_show_ticker', [
        'default'           => '1',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('lp3aik_show_ticker', [
        'label'   => __('Tampilkan Running Text (Ticker)', 'lp3aik-umk'),
        'section' => 'lp3aik_header',
        'type'    => 'checkbox',
    ]);

    // ── Section: Identitas Lembaga ──────────────────────────
    $wp_customize->add_section('lp3aik_identity', [
        'title'    => __('Identitas Lembaga', 'lp3aik-umk'),
        'panel'    => 'lp3aik_panel',
    ]);

    $identity_fields = [
        'lp3aik_tagline'       => ['Tagline/Slogan',           'Membangun Generasi Islami dan Berkemuhammadiyahan'],
        'lp3aik_email'         => ['Email LP3AIK',             'lp3aik@umkotabumi.ac.id'],
        'lp3aik_phone'         => ['Telepon',                  '+62 ...'],
        'lp3aik_whatsapp'      => ['WhatsApp',                 '+62 ...'],
        'lp3aik_address'       => ['Alamat',                   'Jl. ...'],
        'lp3aik_facebook'      => ['URL Facebook',             ''],
        'lp3aik_instagram'     => ['URL Instagram',            ''],
        'lp3aik_youtube'       => ['URL YouTube',              ''],
        'lp3aik_gmaps_embed'   => ['Google Maps Embed Code',   '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15902.808450333752!2d104.88050064999999!3d-4.8211231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e38a8cb47225a21%3A0xd2e026f22c44746f!2sUniversitas%20Muhammadiyah%20Kotabumi!5e0!3m2!1sid!2sid!4v1778603675791!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'],
        'lp3aik_ticker'        => ['Running Text (pisahkan dgn |)', 'Selamat datang di LP3AIK UM Kotabumi | Pendaftaran program terbuka'],
    ];

    foreach ($identity_fields as $id => [$label, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh']);
        $wp_customize->add_control($id, ['label' => __($label,'lp3aik-umk'), 'section' => 'lp3aik_identity', 'type' => 'text']);
    }

    // ── Section: Hero Slider / Carousel ─────────────────────
    $wp_customize->add_section('lp3aik_hero', [
        'title'       => __('Hero Slider (Beranda)', 'lp3aik-umk'),
        'panel'       => 'lp3aik_panel',
        'description' => __('Kelola slider/carousel pada bagian hero di beranda. Maksimal 5 slide.', 'lp3aik-umk'),
    ]);

    // Jumlah slide aktif
    $wp_customize->add_setting('lp3aik_hero_slide_count', [
        'default'           => '3',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('lp3aik_hero_slide_count', [
        'label'   => __('Jumlah Slide Aktif', 'lp3aik-umk'),
        'section' => 'lp3aik_hero',
        'type'    => 'select',
        'choices' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'],
    ]);

    // Auto-play interval
    $wp_customize->add_setting('lp3aik_hero_interval', [
        'default'           => '6000',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('lp3aik_hero_interval', [
        'label'       => __('Interval Auto-play (ms)', 'lp3aik-umk'),
        'description' => __('Durasi setiap slide dalam milidetik. Default: 6000 (6 detik)', 'lp3aik-umk'),
        'section'     => 'lp3aik_hero',
        'type'        => 'number',
        'input_attrs' => ['min' => 2000, 'max' => 15000, 'step' => 500],
    ]);

    // Overlay opacity
    $wp_customize->add_setting('lp3aik_hero_overlay', [
        'default'           => '55',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('lp3aik_hero_overlay', [
        'label'       => __('Overlay Gelap (%)', 'lp3aik-umk'),
        'description' => __('Tingkat kegelapan overlay di atas gambar. 0 = tanpa overlay, 100 = hitam penuh.', 'lp3aik-umk'),
        'section'     => 'lp3aik_hero',
        'type'        => 'range',
        'input_attrs' => ['min' => 0, 'max' => 100, 'step' => 5],
    ]);

    // Per-slide settings (5 slides max)
    for ($i = 1; $i <= 5; $i++) {
        // Separator
        $wp_customize->add_setting("lp3aik_hero_sep_{$i}", ['sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "lp3aik_hero_sep_{$i}", [
            'label'   => sprintf(__('── Slide %d ──', 'lp3aik-umk'), $i),
            'section' => 'lp3aik_hero',
            'type'    => 'hidden',
        ]));

        // Background image
        $wp_customize->add_setting("lp3aik_hero_slide_{$i}_image", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "lp3aik_hero_slide_{$i}_image", [
            'label'   => sprintf(__('Slide %d — Gambar Background', 'lp3aik-umk'), $i),
            'section' => 'lp3aik_hero',
        ]));

        // Title
        $defaults_title = [
            1 => 'Membangun Generasi <em>Islami</em> yang Unggul',
            2 => 'Pengkajian <em>Al-Islam</em> & Kemuhammadiyahan',
            3 => 'Mengabdi dengan <em>Ilmu</em> & Akhlak',
            4 => 'Program Pembinaan <em>AIK</em> Terstruktur',
            5 => 'Bersama Membangun <em>Kampus Islami</em>',
        ];
        $wp_customize->add_setting("lp3aik_hero_slide_{$i}_title", [
            'default'           => $defaults_title[$i] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control("lp3aik_hero_slide_{$i}_title", [
            'label'   => sprintf(__('Slide %d — Judul', 'lp3aik-umk'), $i),
            'section' => 'lp3aik_hero',
            'type'    => 'text',
        ]);

        // Subtitle
        $defaults_sub = [
            1 => 'Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan — mendidik dengan nilai, mengabdi dengan ilmu.',
            2 => 'Mengintegrasikan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek kehidupan akademik.',
            3 => 'Membentuk sivitas akademika yang berakhlak mulia dan bersemangat Kemuhammadiyahan.',
            4 => 'Program terstruktur untuk seluruh mahasiswa, dosen, dan tenaga kependidikan.',
            5 => 'Universitas Muhammadiyah Kotabumi — kampus yang berlandaskan nilai-nilai Islam.',
        ];
        $wp_customize->add_setting("lp3aik_hero_slide_{$i}_subtitle", [
            'default'           => $defaults_sub[$i] ?? '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("lp3aik_hero_slide_{$i}_subtitle", [
            'label'   => sprintf(__('Slide %d — Subjudul', 'lp3aik-umk'), $i),
            'section' => 'lp3aik_hero',
            'type'    => 'textarea',
        ]);
    }

    // ── Section: Statistik ──────────────────────────────────
    $wp_customize->add_section('lp3aik_stats', [
        'title' => __('Statistik / Capaian', 'lp3aik-umk'),
        'panel' => 'lp3aik_panel',
    ]);

    $stat_fields = [
        'lp3aik_stat_1_num'   => ['Statistik 1 — Angka',  '500+'],
        'lp3aik_stat_1_label' => ['Statistik 1 — Label',  'Mahasiswa Terdidik'],
        'lp3aik_stat_2_num'   => ['Statistik 2 — Angka',  '12'],
        'lp3aik_stat_2_label' => ['Statistik 2 — Label',  'Program AIK'],
        'lp3aik_stat_3_num'   => ['Statistik 3 — Angka',  '20+'],
        'lp3aik_stat_3_label' => ['Statistik 3 — Label',  'Tahun Berdiri'],
        'lp3aik_stat_4_num'   => ['Statistik 4 — Angka',  '30+'],
        'lp3aik_stat_4_label' => ['Statistik 4 — Label',  'Tenaga Pengajar'],
    ];

    foreach ($stat_fields as $id => [$label, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh']);
        $wp_customize->add_control($id, ['label' => __($label,'lp3aik-umk'), 'section' => 'lp3aik_stats', 'type' => 'text']);
    }

    // ── Section: Profil / About ─────────────────────────────
    $wp_customize->add_section('lp3aik_about', [
        'title' => __('Profil / Tentang Kami', 'lp3aik-umk'),
        'panel' => 'lp3aik_panel',
    ]);

    // About image
    $wp_customize->add_setting('lp3aik_about_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'lp3aik_about_image', [
        'label'   => __('Gambar Profil', 'lp3aik-umk'),
        'section' => 'lp3aik_about',
    ]));

    $about_fields = [
        'lp3aik_about_text'  => ['Deskripsi Profil (paragraf 1)', 'LP3AIK (Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan) adalah unit lembaga di Universitas Muhammadiyah Kotabumi.'],
        'lp3aik_about_text2' => ['Deskripsi Profil (paragraf 2)', 'Kami berkomitmen mencetak generasi yang unggul secara intelektual dan berakhlak mulia.'],
        'lp3aik_visi'        => ['Visi', 'Menjadi lembaga terdepan dalam pengkajian, pengembangan, dan pengamalan Al-Islam dan Kemuhammadiyahan.'],
        'lp3aik_misi'        => ['Misi (pisahkan baris baru)', "Mengintegrasikan nilai AIK ke dalam seluruh program akademik\nMenyelenggarakan program pembinaan AIK secara terstruktur"],
        'lp3aik_tujuan'      => ['Tujuan', 'Terwujudnya sivitas akademika yang memiliki pemahaman dan pengamalan Al-Islam dan Kemuhammadiyahan.'],
    ];

    foreach ($about_fields as $id => [$label, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh']);
        $wp_customize->add_control($id, ['label' => __($label,'lp3aik-umk'), 'section' => 'lp3aik_about', 'type' => 'textarea']);
    }
});
