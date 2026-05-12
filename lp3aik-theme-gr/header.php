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

<div id="page">

<?php get_template_part('template-parts/navigation/topbar'); ?>

<!-- SITE HEADER -->
<header class="site-header" id="site-header" role="banner">
    <div class="container">
        <div class="header-inner">

            <!-- Logo -->
            <div class="site-logo-wrap">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <div class="site-logo-icon" aria-hidden="true">
                            <i class="fa-solid fa-mosque"></i>
                        </div>
                        <div class="logo-text-group">
                            <div class="logo-main"><?php bloginfo('name'); ?></div>
                            <div class="logo-sub"><?php _e('Universitas Muhammadiyah Kotabumi', 'lp3aik-umk'); ?></div>
                        </div>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Primary Navigation (desktop) -->
            <nav class="primary-nav-wrap" id="primary-nav-wrap" role="navigation" aria-label="<?php _e('Menu Utama', 'lp3aik-umk'); ?>">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'primary-nav',
                    'container'      => false,
                    'fallback_cb'    => 'lp3aik_default_menu',
                    'walker'         => class_exists('LP3AIK_Nav_Walker') ? new LP3AIK_Nav_Walker() : null,
                ]);
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('kontak'))); ?>"
                   class="btn btn-primary btn-sm header-cta">
                    <?php _e('Hubungi Kami', 'lp3aik-umk'); ?>
                </a>
                <button id="search-toggle" aria-label="<?php _e('Buka pencarian', 'lp3aik-umk'); ?>">
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                </button>
                <!-- Mobile toggle -->
                <button class="nav-toggle" id="nav-toggle" aria-label="<?php _e('Buka menu', 'lp3aik-umk'); ?>" aria-expanded="false" aria-controls="primary-nav-wrap">
                    <i class="fa-solid fa-bars" aria-hidden="true"></i>
                </button>
            </div>

        </div>
    </div>
</header>

<?php get_template_part('template-parts/navigation/search-modal'); ?>

<?php
// Ticker only on front page
if (is_front_page()) {
    get_template_part('template-parts/navigation/ticker');
}
?>
