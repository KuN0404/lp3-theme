<?php
/**
 * Template Part: Content Program (Card Modern)
 * Path: template-parts/content-program.php
 */
$featured = get_post_meta( get_the_ID(), '_program_featured', true );
?>
<div class="lp3aik-program-card-modern h-100 w-100">

    <!-- Thumbnail -->
    <a href="<?php the_permalink(); ?>" class="d-block overflow-hidden" style="height:200px;" tabindex="-1">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'lp3aik-medium', [
                'class'   => 'program-card-thumb',
                'alt'     => esc_attr( get_the_title() ),
                'loading' => 'lazy',
            ] ); ?>
        <?php else : ?>
            <div class="program-card-thumb-placeholder">
                <i class="bi bi-journal-richtext"></i>
            </div>
        <?php endif; ?>
    </a>

    <!-- Body -->
    <div class="program-card-body">

        <!-- Meta -->
        <div class="program-card-meta">
            <?php if ( $featured === '1' ) : ?>
                <span class="program-card-badge featured"><i class="bi bi-star-fill me-1"></i>Unggulan</span>
            <?php else : ?>
                <span class="program-card-badge"><i class="bi bi-book me-1"></i>Program</span>
            <?php endif; ?>
        </div>

        <!-- Judul -->
        <h3 class="program-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <!-- Excerpt -->
        <?php if ( has_excerpt() || get_the_content() ) : ?>
        <p class="program-card-excerpt">
            <?php echo esc_html( lp3aik_get_excerpt( get_the_ID(), 15 ) ); ?>
        </p>
        <?php endif; ?>

    </div>

    <!-- Footer -->
    <div class="program-card-footer">
        <span class="text-muted small"><i class="bi bi-building me-1"></i>LP3AIK UMKO</span>
        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm rounded-pill px-3">
            Detail <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

</div>
