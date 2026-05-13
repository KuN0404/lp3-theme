<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#1a7a3c">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (get_theme_mod('lp3aik_show_topbar', '1')): ?>
<?php get_template_part('template-parts/navigation/topbar'); ?>
<?php endif; ?>

<?php if (get_theme_mod('lp3aik_show_ticker', '1')): ?>
<?php get_template_part('template-parts/navigation/ticker'); ?>
<?php endif; ?>

<?php
// Logo mode: 'compact' = icon + name + slogan | 'wide' = logo image only
$logo_mode   = sanitize_key(get_theme_mod('lp3aik_logo_mode', 'compact'));
$logo_height = max(28, min(70, (int) get_theme_mod('lp3aik_logo_height', '40')));
?>

<!-- SITE HEADER -->
<header class="site-header logo-<?php echo esc_attr($logo_mode); ?>"
        id="site-header"
        style="--logo-height: <?php echo esc_attr($logo_height); ?>px;">
    <div class="header-inner container-fluid px-2 px-lg-5">

        <!-- LOGO -->
        <a class="site-logo-wrap" href="<?php echo esc_url(home_url('/')); ?>"
           aria-label="<?php bloginfo('name'); ?>">
            <?php if (has_custom_logo()): ?>
                <div class="custom-logo-wrapper">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else: ?>
                <div class="site-logo-icon">
                    <i class="fa-solid fa-mosque"></i>
                </div>
            <?php endif; ?>

            <?php if ($logo_mode === 'compact'): ?>
            <div class="logo-text-group">
                <div class="logo-main"><?php bloginfo('name'); ?></div>
                <div class="logo-sub"><?php bloginfo('description'); ?></div>
            </div>
            <?php endif; ?>
        </a>

        <!-- PRIMARY NAVIGATION (Desktop) -->
        <nav class="header-nav d-none d-lg-flex"
             aria-label="<?php esc_attr_e('Menu Utama', 'lp3aik-umk'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'primary-nav',
                'fallback_cb'    => 'lp3aik_default_menu',
                'depth'          => 3,
            ]);
            ?>
        </nav>

        <!-- HEADER ACTIONS -->
        <div class="header-actions">
            <!-- SEARCH BUTTON (always visible) -->
            <button class="header-search-btn" id="search-toggle" type="button"
                    aria-label="<?php esc_attr_e('Cari', 'lp3aik-umk'); ?>"
                    aria-expanded="false" aria-controls="search-modal">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <!-- HAMBURGER — triggers Custom Mobile Drawer -->
            <button class="nav-toggle d-lg-none" type="button"
                    id="btn-open-mobile-drawer"
                    aria-label="<?php esc_attr_e('Buka menu navigasi', 'lp3aik-umk'); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

    </div><!-- .header-inner -->
</header><!-- .site-header -->

<!-- ========== MOBILE FULLSCREEN DRAWER (RIGHT) ========== -->
<div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>
<div class="mobile-drawer" id="mobileDrawer">
    <div class="mobile-drawer-header">
        <div class="d-flex align-items-center gap-2">
            <div class="offcanvas-logo-icon"><i class="fa-solid fa-mosque"></i></div>
            <h5 class="offcanvas-title mb-0">
                <?php bloginfo('name'); ?>
            </h5>
        </div>
        <button type="button" class="mobile-drawer-close" id="btn-close-mobile-drawer"
                aria-label="<?php esc_attr_e('Tutup menu', 'lp3aik-umk'); ?>">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="mobile-drawer-body">
        <nav class="mobile-nav-wrap" aria-label="<?php esc_attr_e('Menu Mobile', 'lp3aik-umk'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'mobile-nav-list',
                'fallback_cb'    => 'lp3aik_default_menu',
                'depth'          => 3,
            ]);
            ?>
        </nav>
    </div>
</div><!-- #mobileDrawer -->

<?php get_template_part('template-parts/navigation/search-modal'); ?>

<div id="page">
