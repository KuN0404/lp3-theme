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

<?php get_template_part('template-parts/navigation/topbar'); ?>

<?php get_template_part('template-parts/navigation/ticker'); ?>

<!-- SITE HEADER -->
<header class="site-header" id="site-header">
    <div class="header-inner container">

        <!-- LOGO -->
        <div class="site-logo-wrap" style="display:flex;align-items:center;gap:0.85rem;flex-shrink:0;">
            <?php if (has_custom_logo()): ?>
                <div class="custom-logo-wrapper" style="max-height:56px;display:flex;align-items:center;">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else: ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>" style="text-decoration:none;">
                    <div class="d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:var(--green-primary);border-radius:50%;font-size:1.5rem;color:var(--white);">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                </a>
            <?php endif; ?>
            
            <div class="logo-text-group">
                <div class="logo-main site-title"><a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--green-dark);text-decoration:none;"><?php bloginfo('name'); ?></a></div>
                <div class="logo-sub site-description"><?php bloginfo('description'); ?></div>
            </div>
        </div>

        <!-- NAVIGATION -->
        <div id="mobile-menu-drawer" class="mobile-menu-drawer">
            <nav aria-label="<?php _e('Menu Utama','lp3aik-umk'); ?>">
                <?php
                wp_nav_menu([
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'menu_class'      => 'primary-nav',
                    'fallback_cb'     => 'lp3aik_default_menu',
                    'depth'           => 3,
                ]);
                ?>
            </nav>
            <div class="mobile-drawer-footer d-md-none mt-4 border-top pt-4" style="padding: 0 1.5rem;">
                <button class="btn btn-outline w-100 d-flex align-items-center justify-content-center gap-2" aria-label="<?php _e('Cari','lp3aik-umk'); ?>" onclick="document.getElementById('nav-toggle').click(); setTimeout(function(){ document.getElementById('search-toggle').click(); }, 300);">
                    <i class="fa-solid fa-magnifying-glass"></i> <?php _e('Pencarian','lp3aik-umk'); ?>
                </button>
            </div>
        </div>

        <!-- HEADER ACTIONS -->
        <div class="header-actions" style="display:flex;align-items:center;gap:0.75rem;">
            <!-- SEARCH BUTTON (Desktop only) -->
            <button class="btn btn-outline btn-sm d-none d-md-flex align-items-center justify-content-center" id="search-toggle" aria-label="<?php _e('Cari','lp3aik-umk'); ?>" style="flex-shrink:0;padding:0.4rem 0.6rem;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="sr-only"><?php _e('Cari','lp3aik-umk'); ?></span>
            </button>

            <!-- HAMBURGER -->
            <button class="nav-toggle" id="nav-toggle" aria-controls="primary-nav" aria-expanded="false" aria-label="<?php _e('Buka menu','lp3aik-umk'); ?>" style="flex-shrink:0;">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div>
</header>

<?php get_template_part('template-parts/navigation/search-modal'); ?>

<div id="page">
