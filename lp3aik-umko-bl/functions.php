<?php
define('LP3AIK_VERSION', '1.0.1');
define('LP3AIK_DIR', get_template_directory());
define('LP3AIK_URI', get_template_directory_uri());

require_once LP3AIK_DIR . '/inc/setup.php';
require_once LP3AIK_DIR . '/inc/enqueue.php';
require_once LP3AIK_DIR . '/inc/security.php';
require_once LP3AIK_DIR . '/inc/install.php';
require_once LP3AIK_DIR . '/inc/helpers.php';
require_once LP3AIK_DIR . '/inc/cpt-org-structure.php';
require_once LP3AIK_DIR . '/inc/cpt-program.php';
require_once LP3AIK_DIR . '/inc/cpt-galeri.php';
require_once LP3AIK_DIR . '/inc/cpt-unduhan.php';
require_once LP3AIK_DIR . '/inc/nav-walker.php';
require_once LP3AIK_DIR . '/inc/taxonomies.php';
require_once LP3AIK_DIR . '/inc/meta-boxes.php';
require_once LP3AIK_DIR . '/inc/customizer.php';
require_once LP3AIK_DIR . '/admin/settings-page.php';
