<?php
/**
 * 404 Template — Halaman Tidak Ditemukan
 *
 * @package lp3aik-umk
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <h1><?php _e('Halaman Tidak Ditemukan', 'lp3aik-umk'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Beranda', 'lp3aik-umk'); ?></a>
            <span class="sep" aria-hidden="true">›</span>
            <span>404</span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="error-404-wrap">
            <div class="error-404-icon">
                <i class="fa-solid fa-compass" aria-hidden="true"></i>
            </div>
            <h2><?php _e('Oops! Halaman tidak ditemukan', 'lp3aik-umk'); ?></h2>
            <p>
                <?php _e('Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada. Silakan gunakan navigasi atau pencarian untuk menemukan yang Anda butuhkan.', 'lp3aik-umk'); ?>
            </p>
            <div class="error-404-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-house" aria-hidden="true"></i>
                    <?php _e('Kembali ke Beranda', 'lp3aik-umk'); ?>
                </a>
                <button class="btn btn-outline" id="open-search-404">
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    <?php _e('Cari Halaman', 'lp3aik-umk'); ?>
                </button>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
