<?php
function lp3aik_get_setting($key, $default = '') {
    static $settings = null;
    if ($settings === null) {
        $settings = get_option('lp3aik_theme_settings', []);
    }
    return isset($settings[$key]) ? $settings[$key] : $default;
}

function lp3aik_logo_img($context = 'header') {
    if ($context === 'header') {
        $light = lp3aik_get_setting('logo_header_light');
        $dark  = lp3aik_get_setting('logo_header_dark');
        $type  = lp3aik_get_setting('logo_header_type', 'full');

        if (!$light && !$dark) {
            return '';
        }

        if (!$light) $light = $dark;
        if (!$dark) $dark = $light;

        $site_name = esc_attr(get_bloginfo('name'));
        
        $html = '<div class="lp3aik-logo-wrapper d-flex align-items-center gap-2">';
        $html .= '<img src="' . esc_url($light) . '" alt="' . $site_name . '" class="lp3aik-logo logo-light">';
        $html .= '<img src="' . esc_url($dark) . '" alt="' . $site_name . '" class="lp3aik-logo logo-dark">';
        
        if ($type === 'short') {
            $html .= '<span class="lp3aik-logo-text d-none d-md-inline-block">' . esc_html(get_bloginfo('name')) . '</span>';
        }
        $html .= '</div>';
        
        return $html;
    }

    $long   = lp3aik_get_setting('logo_' . $context);
    $short  = lp3aik_get_setting('logo_' . $context . '_short') ?: $long;

    if (!$long && !$short) {
        return '';
    }

    $site_name = esc_attr(get_bloginfo('name'));
    if ($short && $short !== $long) {
        return '<img src="' . esc_url($long) . '" alt="' . $site_name . '" class="logo-long d-none d-xl-inline">' .
               '<img src="' . esc_url($short) . '" alt="' . $site_name . '" class="logo-short d-xl-none">';
    }
    return '<img src="' . esc_url($long) . '" alt="' . $site_name . '" class="lp3aik-logo">';
}

function lp3aik_fallback_logo() {
    return '<div class="d-flex align-items-center gap-2">' .
           '<div class="brand-emblem d-flex align-items-center justify-content-center rounded-circle" style="width:42px;height:42px;background:var(--color-primary);color:var(--color-accent);font-family:var(--font-heading);font-weight:700;font-size:1rem;">LP</div>' .
           '<span class="lp3aik-logo-text">' . esc_html(get_bloginfo('name')) . '</span></div>';
}

function lp3aik_get_hero_slides() {
    $slides = [];
    for ($i = 1; $i <= 5; $i++) {
        $img    = lp3aik_get_setting('hero_slide_' . $i . '_img');
        $title  = lp3aik_get_setting('hero_slide_' . $i . '_title');
        $sub    = lp3aik_get_setting('hero_slide_' . $i . '_sub');
        $btn    = lp3aik_get_setting('hero_slide_' . $i . '_btn');
        $link   = lp3aik_get_setting('hero_slide_' . $i . '_link');

        if (!empty($img)) {
            $slides[] = [
                'img'   => $img,
                'title' => $title,
                'sub'   => $sub,
                'btn'   => $btn ?: 'Selengkapnya',
                'link'  => $link ?: '#',
            ];
        }
    }
    return $slides;
}

function lp3aik_parse_phone($phone) {
    return preg_replace('/[^0-9+]/', '', trim($phone));
}

function lp3aik_format_date($date_string) {
    $timestamp = is_numeric($date_string) ? $date_string : strtotime($date_string);
    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    return date('j', $timestamp) . ' ' . $months[(int)date('n', $timestamp)] . ' ' . date('Y', $timestamp);
}

function lp3aik_get_excerpt($post_id = null, $length = 20) {
    $post = get_post($post_id);
    if (!empty($post->post_excerpt)) {
        return wp_kses_post($post->post_excerpt);
    }
    $excerpt = wp_trim_words(wp_strip_all_tags($post->post_content, true), $length);
    return esc_html($excerpt);
}

function lp3aik_get_short_org_name($jabatan, $unit) {
    $parts = [];
    if ($jabatan) {
        $parts[] = $jabatan;
    }
    if ($unit) {
        $parts[] = $unit;
    }
    return implode(' — ', $parts);
}

function lp3aik_handle_contact_form() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'lp3aik_nonce')) {
        wp_send_json_error(['message' => 'Keamanan tidak valid. Silakan muat ulang halaman.']);
    }

    $honeypot = isset($_POST['honeypot']) ? sanitize_text_field(wp_unslash($_POST['honeypot'])) : '';
    if (!empty($honeypot)) {
        wp_send_json_success(['message' => 'Pesan berhasil dikirim.']);
    }

    $name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $email   = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $subject = isset($_POST['subject']) ? sanitize_text_field(wp_unslash($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_send_json_error(['message' => 'Semua kolom wajib diisi.']);
    }

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Alamat email tidak valid.']);
    }

    $to = lp3aik_get_setting('email') ?: get_option('admin_email');

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email,
    ];

    $email_body = '<h3>Pesan dari Website LP3AIK</h3>';
    $email_body .= '<p><strong>Nama:</strong> ' . esc_html($name) . '</p>';
    $email_body .= '<p><strong>Email:</strong> ' . esc_html($email) . '</p>';
    $email_body .= '<p><strong>Subjek:</strong> ' . esc_html($subject) . '</p>';
    $email_body .= '<p><strong>Pesan:</strong></p>';
    $email_body .= '<p>' . nl2br(esc_html($message)) . '</p>';
    $email_body .= '<hr><p><small>Dikirim dari website LP3AIK UM Kotabumi</small></p>';

    $sent = wp_mail($to, '[LP3AIK] ' . $subject, $email_body, $headers);

    if ($sent) {
        wp_send_json_success(['message' => 'Pesan berhasil dikirim. Kami akan menghubungi Anda segera.']);
    } else {
        wp_send_json_error(['message' => 'Gagal mengirim pesan. Silakan coba lagi nanti.']);
    }
}
add_action('wp_ajax_lp3aik_contact_form', 'lp3aik_handle_contact_form');
add_action('wp_ajax_nopriv_lp3aik_contact_form', 'lp3aik_handle_contact_form');

function lp3aik_breadcrumb() {
    if (is_front_page()) {
        return;
    }
    $items = [];
    $items[] = ['url' => home_url('/'), 'title' => 'Beranda'];
    if (is_singular('lp3aik_program')) {
        $items[] = ['url' => get_post_type_archive_link('lp3aik_program'), 'title' => 'Program'];
    } elseif (is_post_type_archive('lp3aik_program')) {
        $items[] = ['url' => '', 'title' => 'Program'];
    } elseif (is_singular('post')) {
        $cat = get_the_category();
        if ($cat) {
            $items[] = ['url' => get_category_link($cat[0]->term_id), 'title' => $cat[0]->name];
        }
    } elseif (is_category()) {
        $items[] = ['url' => '', 'title' => single_cat_title('', false)];
    } elseif (is_author()) {
        $author = get_queried_object();
        $first_name = get_the_author_meta('first_name', $author->ID);
        $last_name  = get_the_author_meta('last_name', $author->ID);
        $full_name  = trim($first_name . ' ' . $last_name);
        $items[] = ['url' => '', 'title' => !empty($full_name) ? $full_name : $author->display_name];
    } elseif (is_archive()) {
        $items[] = ['url' => '', 'title' => get_the_archive_title()];
    } elseif (is_search()) {
        $items[] = ['url' => '', 'title' => 'Hasil Pencarian: ' . get_search_query()];
    } elseif (is_404()) {
        $items[] = ['url' => '', 'title' => 'Halaman Tidak Ditemukan'];
    } elseif (is_page()) {
        $ancestors = get_post_ancestors(get_the_ID());
        foreach (array_reverse($ancestors) as $ancestor) {
            $items[] = ['url' => get_permalink($ancestor), 'title' => get_the_title($ancestor)];
        }
        $items[] = ['url' => '', 'title' => get_the_title()];
    } elseif (is_single()) {
        $items[] = ['url' => '', 'title' => get_the_title()];
    }
    return lp3aik_render_breadcrumb($items);
}

function lp3aik_render_breadcrumb($items) {
    if (empty($items)) {
        return '';
    }
    $last = count($items) - 1;
    $html = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
    foreach ($items as $i => $item) {
        if ($i === $last || empty($item['url'])) {
            $html .= '<li class="breadcrumb-item active" aria-current="page">' . esc_html($item['title']) . '</li>';
        } else {
            $html .= '<li class="breadcrumb-item"><a href="' . esc_url($item['url']) . '">' . esc_html($item['title']) . '</a></li>';
        }
    }
    $html .= '</ol></nav>';
    return $html;
}

/**
 * Filter pencarian: Jangan sertakan tipe post 'page' agar halaman statis (seperti about-us) tidak muncul di hasil pencarian.
 */
function lp3aik_search_filter($query) {
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        // Jika post_type sudah di-set secara spesifik (misal dari form di sidebar berita), biarkan.
        // Jika belum (pencarian global), batasi hanya pada post (Berita) dan lp3aik_program.
        if (!isset($_GET['post_type']) || empty($_GET['post_type'])) {
            $query->set('post_type', ['post', 'lp3aik_program']);
        }
    }
    return $query;
}
add_action('pre_get_posts', 'lp3aik_search_filter');

/**
 * Post Views Helper
 */
function lp3aik_set_post_views($postID) {
    $count_key = 'lp3aik_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function lp3aik_get_post_views($postID) {
    $count_key = 'lp3aik_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 Dilihat";
    }
    return $count . ' Dilihat';
}

function lp3aik_get_post_views_count($postID) {
    $count_key = 'lp3aik_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        return 0;
    }
    return (int)$count;
}

/**
 * Get Author Full Name (First + Last) or fallback to display name
 */
function lp3aik_get_author_name($post_id = null) {
    $author_id = $post_id ? get_post_field('post_author', $post_id) : get_the_author_meta('ID');
    $first_name = get_the_author_meta('first_name', $author_id);
    $last_name  = get_the_author_meta('last_name', $author_id);
    $full_name  = trim($first_name . ' ' . $last_name);
    return !empty($full_name) ? $full_name : get_the_author_meta('display_name', $author_id);
}
