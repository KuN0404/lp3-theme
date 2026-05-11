<?php
get_header();
?>

<?php while (have_posts()) : the_post(); ?>
<?php 
$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
$thumbnail_url = $thumbnail_url ?: get_template_directory_uri() . '/assets/images/default-hero.jpg';
$cats = get_the_terms( get_the_ID(), 'kategori_program' );
?>

<!-- Hero Section -->
<section class="program-hero-wrapper position-relative"
         style="background-image: linear-gradient(rgba(0,40,90,0.85), rgba(0,40,90,0.94)), url('<?php echo esc_url($thumbnail_url); ?>');
                background-size: cover;
                background-position: center;
                margin-top: -58px;
                padding-top: calc(2.5rem + 58px);
                padding-bottom: 9rem;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 text-white">
                <a href="<?php echo get_post_type_archive_link('lp3aik_program'); ?>" class="btn-back-program mb-4 d-inline-flex align-items-center text-white text-decoration-none" style="opacity: 0.85;">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Program
                </a>
                <div class="mb-3 d-flex flex-wrap gap-2">
                    <span class="badge bg-primary text-uppercase px-3 py-2 rounded-pill" style="font-size:.75rem;letter-spacing:.05em;font-weight:700;">Program</span>
                    <?php if ($cats && !is_wp_error($cats)) : ?>
                    <span class="badge bg-accent text-primary-dark text-uppercase px-3 py-2 rounded-pill" style="font-size:.75rem;letter-spacing:.05em;font-weight:700;background:var(--color-accent);color:var(--color-primary-dark);"><?php echo esc_html($cats[0]->name); ?></span>
                    <?php endif; ?>
                </div>
                <h1 class="display-4 fw-bold text-white mb-2" style="line-height: 1.25;"><?php the_title(); ?></h1>
                <p class="text-white-50 mb-0 small"><i class="bi bi-calendar3 me-1"></i><?php echo get_the_date(); ?></p>
            </div>
        </div>
    </div>
</section>


<!-- Content Section -->
<section class="program-content-wrapper position-relative" style="margin-top: -6.5rem; z-index: 10; padding-bottom: 5rem;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card program-content-card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden; background: #fff;">
                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Card Meta Header -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-4 border-bottom gap-3">
                            <div class="d-flex align-items-center">
                                <?php $icon = get_post_meta(get_the_ID(), '_program_icon', true); ?>
                                <?php if ($icon): ?>
                                <div class="program-detail-icon-small me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px; font-size: 1.5rem;">
                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                </div>
                                <?php else: ?>
                                <div class="program-detail-icon-small me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px; font-size: 1.5rem;">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <?php endif; ?>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">LP3AIK UMKO</h6>
                                    <small class="text-muted">Diterbitkan pada <?php echo get_the_date(); ?></small>
                                </div>
                            </div>
                            <div class="program-meta-info text-muted small d-flex flex-wrap gap-3">
                                <?php $durasi = get_post_meta(get_the_ID(), '_program_durasi', true); if ($durasi): ?>
                                <span class="d-flex align-items-center"><i class="bi bi-clock me-1 text-primary"></i> <?php echo esc_html($durasi); ?></span>
                                <?php endif; ?>
                                <?php $target = get_post_meta(get_the_ID(), '_program_target', true); if ($target): ?>
                                <span class="d-flex align-items-center"><i class="bi bi-people me-1 text-primary"></i> <?php echo esc_html($target); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Actual Content -->
                        <div class="post-content lp3aik-article-content" style="font-size: 1.05rem; line-height: 1.8; color: #4a5568;">
                            <?php the_content(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endwhile; ?>

<?php get_footer(); ?>
