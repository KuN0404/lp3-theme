<?php
/**
 * Enqueue Scripts & Styles.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {

    // ── CDN: Bootstrap 5.3 ──────────────────────────────────
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], '5.3.3', true);

    // ── CDN: Font Awesome 6.5 ───────────────────────────────
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', [], '6.5.2');

    // ── Google Fonts ────────────────────────────────────────
    wp_enqueue_style('lp3aik-fonts', 'https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap', [], null);

    // ── WordPress-required style.css ────────────────────────
    wp_enqueue_style('lp3aik-style', get_stylesheet_uri(), ['bootstrap', 'fontawesome', 'lp3aik-fonts'], LP3AIK_VERSION);

    // ── Modular app.css ─────────────────────────────────────
    wp_enqueue_style('lp3aik-app', LP3AIK_URI . '/assets/css/app.css', ['lp3aik-style'], LP3AIK_VERSION);

    // ── JS Modules (loaded before app.js) ───────────────────
    $js_modules = [
        'sticky-header',
        'mobile-menu',
        'tabs',
        'hero-carousel',
        'gallery-lightbox',
        'contact-form',
        'back-to-top',
        'search-modal',
        'counter-animation',
        'scroll-animations',
    ];

    foreach ($js_modules as $module) {
        wp_enqueue_script(
            "lp3aik-{$module}",
            LP3AIK_URI . "/assets/js/modules/{$module}.js",
            ['bootstrap-js'],
            LP3AIK_VERSION,
            true
        );
    }

    // ── Main app.js (init, loaded last) ─────────────────────
    wp_enqueue_script('lp3aik-main', LP3AIK_URI . '/assets/js/app.js', array_map(fn($m) => "lp3aik-{$m}", $js_modules), LP3AIK_VERSION, true);

    // ── Localize script data ────────────────────────────────
    wp_localize_script('lp3aik-main', 'lp3aikData', [
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('lp3aik_nonce'),
        'siteUrl'  => get_site_url(),
        'themeUri' => LP3AIK_URI,
    ]);

    // ── Comment reply ───────────────────────────────────────
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});
