<?php
/**
 * LP3AIK UM Kotabumi — Functions & Theme Bootstrap.
 *
 * Slim loader that requires all modular include files.
 * Each domain lives in its own file under inc/.
 *
 * @package lp3aik-umk
 * @version 2.0.0
 */

defined('ABSPATH') || exit;

// ── Constants ───────────────────────────────────────────────
define('LP3AIK_VERSION', '2.0.0');
define('LP3AIK_DIR',     get_template_directory());
define('LP3AIK_URI',     get_template_directory_uri());

// ── Modular Includes ────────────────────────────────────────
$lp3aik_includes = [
    'inc/setup/theme-setup.php',
    'inc/enqueue/enqueue-assets.php',
    'inc/helpers/template-helpers.php',
    'inc/helpers/navigation.php',
    'inc/helpers/page-templates.php',
    'inc/post-types/register-post-types.php',
    'inc/post-types/register-taxonomies.php',
    'inc/meta-boxes/program-meta.php',
    'inc/meta-boxes/tim-meta.php',
    'inc/meta-boxes/unduhan-meta.php',
    'inc/customizer/customizer.php',
    'inc/ajax/contact-handler.php',
    'inc/admin/admin-columns.php',
    'inc/security/security.php',
    'inc/optimization/optimization.php',
];

foreach ($lp3aik_includes as $file) {
    $path = LP3AIK_DIR . '/' . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}
