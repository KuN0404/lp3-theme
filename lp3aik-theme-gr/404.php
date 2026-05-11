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
            <span class="sep">›</span>
            <span><?php _e('404', 'lp3aik-umk'); ?></span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center" style="max-width:540px;margin:0 auto;padding:3rem 0;">
            <div style="font-size:6rem;color:var(--green-pale);margin-bottom:1rem;line-height:1;">
                <i class="fa-solid fa-compass" style="animation:spin404 4s linear infinite;display:inline-block;"></i>
            </div>
            <h2 style="color:var(--green-dark);margin-bottom:1rem;"><?php _e('Oops! Halaman tidak ditemukan', 'lp3aik-umk'); ?></h2>
            <p style="color:var(--text-secondary);margin-bottom:2rem;">
                <?php _e('Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada. Silakan gunakan navigasi atau pencarian untuk menemukan yang Anda butuhkan.', 'lp3aik-umk'); ?>
            </p>
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-home me-1"></i> <?php _e('Kembali ke Beranda', 'lp3aik-umk'); ?>
                </a>
                <button class="btn btn-outline" onclick="document.getElementById('search-toggle').click();">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> <?php _e('Cari', 'lp3aik-umk'); ?>
                </button>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes spin404 { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>

<?php get_footer(); ?>
