<?php
$phone      = lp3aik_get_setting('phone');
$email      = lp3aik_get_setting('email');
$ig         = lp3aik_get_setting('instagram');
$fb         = lp3aik_get_setting('facebook');
$yt         = lp3aik_get_setting('youtube');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="lp3aik-header">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php $logo_header = lp3aik_logo_img('header'); ?>
                <?php if ($logo_header): ?>
                <?php echo $logo_header; ?>
                <?php else: ?>
                <?php echo lp3aik_fallback_logo(); ?>
                <?php endif; ?>
            </a>

            <!-- Mobile: hamburger only (search removed on mobile) -->
            <div class="d-flex align-items-center ms-auto d-lg-none">
                <button class="navbar-toggler" type="button"
                    id="btn-open-mobile-drawer"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Desktop: collapse menu -->
            <div class="collapse navbar-collapse" id="navbar-primary">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu([
                        'theme_location'  => 'primary',
                        'depth'           => 3,
                        'container'       => false,
                        'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
                        'fallback_cb'     => false,
                        'walker'          => new LP3AIK_Nav_Walker(),
                    ]);
                } else {
                    echo lp3aik_default_menu();
                }
                ?>
                <div class="d-flex align-items-center gap-2 ms-lg-3 d-none d-lg-flex">
                    <button class="btn-nav-search" type="button" id="btn-search-nav" aria-label="Cari">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>



    <!-- ========== MOBILE FULLSCREEN DRAWER (RIGHT) ========== -->
    <div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>
    <div class="mobile-drawer" id="mobileDrawer">

        <div class="mobile-drawer-body">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location'  => 'primary',
                    'depth'           => 3,
                    'container'       => false,
                    'menu_class'      => 'mobile-nav-list',
                    'fallback_cb'     => false,
                    'walker'          => new LP3AIK_Nav_Walker(),
                ]);
            } else {
                echo lp3aik_default_menu();
            }
            ?>
        </div>
    </div>
</header>

<!-- ========== FULLSCREEN SEARCH OVERLAY (body-level — bebas dari stacking context header) ========== -->
<div class="search-overlay" id="searchOverlay" aria-hidden="true" role="dialog" aria-label="Search">
    <div class="search-overlay-inner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-overlay-form">
                        <div class="search-overlay-input-wrap">
                            <span class="search-overlay-icon"><i class="bi bi-search"></i></span>
                            <input type="search" name="s" class="search-overlay-input" placeholder="Search news, programs, documents...">
                            <button class="btn-close-search" type="button" id="btn-close-search" aria-label="Tutup">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<main id="site-main" class="lp3aik-main">
