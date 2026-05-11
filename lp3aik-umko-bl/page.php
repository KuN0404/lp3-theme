<?php
/**
 * Template: Page (Statis)
 * Path: page.php
 */
get_header();

while ( have_posts() ) : the_post();
?>

<!-- Hero -->
<section class="lp3aik-archive-hero" style="padding-bottom: 7rem; background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary)); position: relative; overflow: hidden; margin-top: -58px; padding-top: calc(2.5rem + 58px);">
    <div class="container text-center text-white" style="position: relative; z-index: 2;">
        <h1 class="display-5 fw-bold mb-3"><?php the_title(); ?></h1>
        <div class="d-flex align-items-center justify-content-center gap-3 small opacity-75">
            <span class="d-flex align-items-center gap-1">
                <i class="bi bi-person-circle"></i>
                <?php echo esc_html( lp3aik_get_author_name() ); ?>
            </span>
            <span class="d-flex align-items-center gap-1">
                <i class="bi bi-calendar3"></i>
                <?php echo esc_html( get_the_date() ); ?>
            </span>
        </div>
    </div>
    <div class="archive-wave" style="position: absolute; bottom: -1px; left: 0; width: 100%; line-height: 0;">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none" style="display: block; width: 100%; height: 55px;">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,55 L0,55 Z" class="shape-fill" style="fill: var(--color-background);"></path>
        </svg>
    </div>
</section>

<!-- Content -->
<section class="py-section" style="margin-top: -4rem; position: relative; z-index: 10; padding-bottom: 5rem;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg" style="border-radius: 1rem; overflow: hidden;">
                    <div class="card-body p-4 p-md-5">
                        <div class="lp3aik-article-content" style="font-size: 1.05rem; line-height: 1.85; color: #374151;">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
endwhile;

get_footer();
