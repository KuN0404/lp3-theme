<?php
function lp3aik_customizer_register($wp_customize) {
    $wp_customize->add_section('lp3aik_theme_options', [
        'title'    => 'Pengaturan LP3AIK',
        'priority' => 30,
    ]);

    $settings = [
        'logo_header_light' => ['label' => 'Logo Terang (Light)',      'type' => 'image'],
        'logo_header_dark'  => ['label' => 'Logo Gelap (Dark)',        'type' => 'image'],
        'logo_header_type'  => [
            'label'   => 'Tipe Logo Navbar',
            'type'    => 'select',
            'choices' => [
                'full'  => 'Logo Full (Hanya Gambar)',
                'short' => 'Logo Pendek (Gambar + Nama Situs)',
            ]
        ],
        'logo_footer_umko'  => ['label' => 'Logo UMKO — Footer',     'type' => 'image'],
        'hero_interval'     => ['label' => 'Interval Carousel (ms)', 'type' => 'text'],
        'tagline'           => ['label' => 'Tagline/Slogan',         'type' => 'text'],
        'phone'             => ['label' => 'Nomor Telepon',          'type' => 'textarea'],
        'email'             => ['label' => 'Email',                  'type' => 'text'],
        'address'           => ['label' => 'Alamat',                 'type' => 'textarea'],
        'maps_embed'        => ['label' => 'Google Maps Embed URL',  'type' => 'textarea'],
        'instagram'         => ['label' => 'Link Instagram',         'type' => 'text'],
        'facebook'          => ['label' => 'Link Facebook',          'type' => 'text'],
        'youtube'           => ['label' => 'Link YouTube',           'type' => 'text'],
        'whatsapp'          => ['label' => 'Nomor WhatsApp/HP',      'type' => 'text'],
        'footer_text'       => ['label' => 'Teks Footer',            'type' => 'textarea'],
        'about_image'       => ['label' => 'Gambar Section Tentang', 'type' => 'image'],
        'ga_id'             => ['label' => 'Google Analytics ID',    'type' => 'text'],
        'google_verification' => ['label' => 'Google Site Verification', 'type' => 'text'],
    ];

    foreach ($settings as $id => $config) {
        $wp_customize->add_setting("lp3aik_theme_settings[$id]", [
            'type'              => 'option',
            'default'           => '',
            'sanitize_callback' => $config['type'] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);

        if ($config['type'] === 'image') {
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "lp3aik_$id", [
                'label'    => $config['label'],
                'section'  => 'lp3aik_theme_options',
                'settings' => "lp3aik_theme_settings[$id]",
            ]));
        } elseif ($config['type'] === 'select') {
            $wp_customize->add_control("lp3aik_$id", [
                'label'    => $config['label'],
                'section'  => 'lp3aik_theme_options',
                'settings' => "lp3aik_theme_settings[$id]",
                'type'     => 'select',
                'choices'  => $config['choices'],
            ]);
        } elseif ($config['type'] === 'number') {
            $wp_customize->add_control("lp3aik_$id", [
                'label'    => $config['label'],
                'section'  => 'lp3aik_theme_options',
                'settings' => "lp3aik_theme_settings[$id]",
                'type'     => 'number',
            ]);
        } elseif ($config['type'] === 'textarea') {
            $wp_customize->add_control("lp3aik_$id", [
                'label'    => $config['label'],
                'section'  => 'lp3aik_theme_options',
                'settings' => "lp3aik_theme_settings[$id]",
                'type'     => 'textarea',
            ]);
        } else {
            $wp_customize->add_control("lp3aik_$id", [
                'label'    => $config['label'],
                'section'  => 'lp3aik_theme_options',
                'settings' => "lp3aik_theme_settings[$id]",
                'type'     => $config['type'],
            ]);
        }
    }

    // === NEW SECTION: STATS IN CUSTOMIZER ===
    $wp_customize->add_section('lp3aik_stats_options', [
        'title'    => 'Statistik Beranda',
        'priority' => 32,
        'description' => 'Sesuaikan 4 kotak angka statistik yang tampil di halaman depan.'
    ]);

    for ($i = 1; $i <= 4; $i++) {
        $stats_fields = [
            "stat_{$i}_icon"  => ['label' => "Statistik {$i}: Ikon Bootstrap (misal: bi-people)", 'type' => 'text'],
            "stat_{$i}_count" => ['label' => "Statistik {$i}: Angka/Nominal", 'type' => 'text'],
            "stat_{$i}_label" => ['label' => "Statistik {$i}: Nama Kartu", 'type' => 'text'],
        ];

        foreach ($stats_fields as $id => $config) {
            $wp_customize->add_setting("lp3aik_theme_settings[$id]", [
                'type'              => 'option',
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ]);

            $wp_customize->add_control("lp3aik_$id", [
                'label'    => $config['label'],
                'section'  => 'lp3aik_stats_options',
                'settings' => "lp3aik_theme_settings[$id]",
                'type'     => $config['type'],
            ]);
        }
    }
}
add_action('customize_register', 'lp3aik_customizer_register');
