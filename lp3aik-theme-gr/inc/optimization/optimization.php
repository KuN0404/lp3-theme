<?php
/**
 * Optimization & Miscellaneous.
 *
 * Excerpt settings, template redirects, rewrite flush.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Excerpt length & more
add_filter('excerpt_length', fn() => 20);
add_filter('excerpt_more',   fn() => '...');

// Template redirect for CPT archives
add_filter('template_include', function (string $template): string {
    $map = [
        'lp3aik_galeri'  => 'templates/archive-galeri.php',
        'lp3aik_program' => 'templates/archive-program.php',
        'lp3aik_unduhan' => 'templates/archive-unduhan.php',
    ];

    foreach ($map as $post_type => $tpl) {
        if (is_post_type_archive($post_type)) {
            $located = locate_template($tpl);
            return $located ?: $template;
        }
    }

    return $template;
});

// Flush rewrite on theme activation
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});
