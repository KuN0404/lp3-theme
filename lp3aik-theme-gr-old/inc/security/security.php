<?php
/**
 * Security Hardening.
 *
 * Nonce helpers, header hardening, spam protection utilities.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Remove WordPress version from head for security
remove_action('wp_head', 'wp_generator');

// Disable XML-RPC if not needed
add_filter('xmlrpc_enabled', '__return_false');

// Remove unnecessary header info
add_action('init', function () {
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
});

// Add security headers
add_action('send_headers', function () {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
});
