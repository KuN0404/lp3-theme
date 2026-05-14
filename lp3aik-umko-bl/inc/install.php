<?php
register_activation_hook(__FILE__, '__return_true');

function lp3aik_install_pages() {
    if (get_option('lp3aik_pages_version') === LP3AIK_VERSION) {
        return;
    }

    $pages = [
        [
            'title'    => 'Deskripsi Singkat',
            'slug'     => 'about',
            'template' => 'pages/page-description.php',
            'content'  => '<p>LP3AIK (Lembaga Pembinaan dan Pengembangan Pendidikan Al-Islam dan Kemuhammadiyahan) adalah satuan kerja di lingkungan Universitas Muhammadiyah Kotabumi yang bertanggung jawab atas pembinaan, pengembangan, dan pengkajian nilai-nilai Al-Islam serta internalisasi nilai-nilai Kemuhammadiyahan di seluruh civitas akademika.</p><p>Lembaga ini mengkoordinasi mata kuliah wajib AIK (Al-Islam &amp; Kemuhammadiyahan) di semua program studi, menyelenggarakan pelatihan, seminar, dan kegiatan keagamaan kampus, serta menjamin mutu nilai-nilai islami dalam tata kelola dan budaya kampus.</p>',
        ],
        [
            'title'    => 'Visi dan Misi',
            'slug'     => 'vision-mission',
            'template' => 'pages/page-vision-mission.php',
            'content'  => '<h3>Visi</h3><p>Menjadi lembaga unggulan dalam pembinaan dan pengembangan pendidikan Al-Islam dan Kemuhammadiyahan yang melahirkan civitas akademika berakhlak mulia, berkemajuan, dan berdaya saing global.</p><h3>Misi</h3><ol><li>Menyelenggarakan pembinaan Al-Islam dan Kemuhammadiyahan secara terpadu dan berkelanjutan bagi seluruh civitas akademika.</li><li>Mengembangkan kurikulum dan bahan ajar AIK yang relevan dengan perkembangan zaman.</li><li>Meningkatkan kualitas tenaga pengajar AIK melalui pelatihan dan sertifikasi.</li><li>Menyelenggarakan kegiatan keagamaan dan sosial kemasyarakatan sebagai wujud pengamalan nilai-nilai Islam.</li><li>Menjalin kerjasama dengan berbagai pihak dalam pengembangan pendidikan Al-Islam dan Kemuhammadiyahan.</li></ol>',
        ],
        [
            'title'    => 'Struktur Organisasi',
            'slug'     => 'organization',
            'template' => 'pages/page-org-structure.php',
            'content'  => '',
        ],
        [
            'title'    => 'Galeri',
            'slug'     => 'gallery',
            'template' => 'pages/page-gallery.php',
            'content'  => '',
        ],
        [
            'title'    => 'Unduhan',
            'slug'     => 'downloads',
            'template' => 'pages/page-downloads.php',
            'content'  => '',
        ],
        [
            'title'    => 'FAQ',
            'slug'     => 'faq',
            'template' => 'pages/page-faq.php',
            'content'  => '',
        ],
        [
            'title'    => 'Kontak',
            'slug'     => 'contact',
            'template' => 'pages/page-contact.php',
            'content'  => '',
        ],
    ];

    foreach ($pages as $page) {
        $existing = get_page_by_path($page['slug']);
        if (!$existing) {
            $page_id = wp_insert_post([
                'post_title'     => $page['title'],
                'post_name'      => $page['slug'],
                'post_content'   => $page['content'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ]);
            if ($page_id && !empty($page['template'])) {
                update_post_meta($page_id, '_wp_page_template', $page['template']);
            }
        } elseif (!empty($page['template'])) {
            $current_template = get_post_meta($existing->ID, '_wp_page_template', true);
            if ($current_template !== $page['template']) {
                update_post_meta($existing->ID, '_wp_page_template', $page['template']);
            }
        }
    }

    $front_page = get_page_by_path('home');
    if (!$front_page) {
        $front_id = wp_insert_post([
            'post_title'     => 'Beranda',
            'post_name'      => 'home',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
        ]);
        update_post_meta($front_id, '_wp_page_template', 'front-page.php');
    } else {
        $front_id = $front_page->ID;
        update_post_meta($front_id, '_wp_page_template', 'front-page.php');
    }

    $blog_page = get_page_by_path('news');
    if (!$blog_page) {
        $blog_id = wp_insert_post([
            'post_title'     => 'Berita',
            'post_name'      => 'news',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
        ]);
    } else {
        $blog_id = $blog_page->ID;
    }

    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_id);
    update_option('page_for_posts', $blog_id);

    delete_option('lp3aik_pages_installed');
    update_option('lp3aik_pages_version', LP3AIK_VERSION);
    flush_rewrite_rules();
    update_option('lp3aik_rewrite_version', LP3AIK_VERSION);
}
add_action('after_switch_theme', 'lp3aik_install_pages');

function lp3aik_reset_install_on_switch() {
    delete_option('lp3aik_pages_version');
    delete_option('lp3aik_pages_installed');
}
add_action('switch_theme', 'lp3aik_reset_install_on_switch');
