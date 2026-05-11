<?php
function lp3aik_enqueue_assets() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Merriweather:wght@400;700&family=Amiri:wght@400;700&display=swap',
        [], null
    );

    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        [], '5.3.3'
    );

    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        [], '1.11.3'
    );

    wp_enqueue_style(
        'lp3aik-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['bootstrap'], '1.0.2'
    );

    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [], '5.3.3', true
    );

    wp_enqueue_script(
        'lp3aik-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['bootstrap', 'jquery'], '1.0.2', true
    );

    wp_localize_script('lp3aik-main', 'lp3aikAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('lp3aik_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'lp3aik_enqueue_assets');

/**
 * Google Analytics: inject gtag.js jika ga_id diisi di Pengaturan LP3AIK
 */
function lp3aik_inject_google_analytics() {
    $ga_id = lp3aik_get_setting('ga_id');
    if ( empty( $ga_id ) ) {
        return;
    }
    $ga_id = sanitize_text_field( $ga_id );
    ?>
    <!-- Google Analytics: LP3AIK -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga_id ); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_js( $ga_id ); ?>');
    </script>
    <?php
}
add_action( 'wp_head', 'lp3aik_inject_google_analytics', 1 );

function lp3aik_enqueue_admin_assets($hook) {
    $allowed_hooks = ['appearance_page_lp3aik-settings', 'post.php', 'post-new.php'];
    if (in_array($hook, $allowed_hooks, true)) {
        wp_enqueue_media();
        wp_enqueue_style(
            'lp3aik-admin',
            get_template_directory_uri() . '/assets/css/admin.css',
            [], '1.0.0'
        );
        wp_enqueue_script(
            'lp3aik-admin',
            get_template_directory_uri() . '/assets/js/admin.js',
            ['jquery'], '1.0.0', true
        );
    }
}
add_action('admin_enqueue_scripts', 'lp3aik_enqueue_admin_assets');
