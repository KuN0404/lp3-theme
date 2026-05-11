<?php
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});

add_action('template_redirect', function() {
    if (is_author()) {
        wp_redirect(home_url());
        exit;
    }
});

add_filter('upload_mimes', function($mimes) {
    $allowed = [
        'jpg|jpeg|jpe' => 'image/jpeg',
        'png'          => 'image/png',
        'gif'          => 'image/gif',
        'webp'         => 'image/webp',
        'pdf'          => 'application/pdf',
        'doc|docx'     => 'application/msword',
        'xls|xlsx'     => 'application/vnd.ms-excel',
    ];
    return $allowed;
});

add_filter('login_errors', function() {
    return 'Login gagal. Silakan coba lagi.';
});

add_action('wp_head', function() {
    $ga_id = lp3aik_get_setting('ga_id');
    if (!empty($ga_id)) {
        echo "<!-- Google Analytics -->\n";
        echo "<script async src=\"https://www.googletagmanager.com/gtag/js?id=" . esc_attr($ga_id) . "\"></script>\n";
        echo "<script>\n";
        echo "  window.dataLayer = window.dataLayer || [];\n";
        echo "  function gtag(){dataLayer.push(arguments);}\n";
        echo "  gtag('js', new Date());\n";
        echo "  gtag('config', '" . esc_attr($ga_id) . "');\n";
        echo "</script>\n";
    }
});
