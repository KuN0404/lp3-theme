<?php
get_header();
?>

<section class="lp3aik-404 py-section text-center pattern-islamic-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 reveal">
                <div class="error-icon mb-4">
                    <i class="bi bi-emoji-frown" style="font-size:5rem;color:var(--color-primary);"></i>
                </div>
                <h1 class="display-1 fw-bold mb-3 text-gradient">404</h1>
                <h2 class="mb-4" style="font-family:var(--font-heading);">Halaman Tidak Ditemukan</h2>
                <p class="mb-4 text-muted">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg"><i class="bi bi-house-fill me-2"></i>Kembali ke Beranda</a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline-primary btn-lg">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
