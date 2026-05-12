<?php
/**
 * Template Part: Galeri Card (Image Only + Lightbox)
 * Path: template-parts/content-gallery.php
 */
$img_url     = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$img_thumb   = get_the_post_thumbnail_url( get_the_ID(), 'lp3aik-gallery' ) 
               ?: get_the_post_thumbnail_url( get_the_ID(), 'large' ) 
               ?: $img_url;
$title       = get_the_title();
$desc        = get_the_excerpt() ?: '';
?>
<div class="gallery-item-inner shadow-sm"
     data-bs-toggle="modal"
     data-bs-target="#galleryModal"
     data-img="<?php echo esc_attr( $img_url ?: $img_thumb ); ?>"
     data-title="<?php echo esc_attr( $title ); ?>"
     data-desc="<?php echo esc_attr( $desc ); ?>"
     role="button"
     tabindex="0"
     aria-label="Lihat foto: <?php echo esc_attr( $title ); ?>">
    
    <?php if ( $img_thumb ) : ?>
    <img src="<?php echo esc_url( $img_thumb ); ?>"
         alt="<?php echo esc_attr( $title ); ?>"
         class="w-100"
         style="aspect-ratio: 4/3; object-fit: cover; image-rendering: auto;"
         loading="lazy"
         decoding="async">
    <?php else : ?>
    <div class="d-flex align-items-center justify-content-center bg-light w-100" style="aspect-ratio: 4/3;">
        <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
    </div>
    <?php endif; ?>
    
    <div class="gallery-item-overlay" aria-hidden="true">
        <i class="bi bi-zoom-in"></i>
    </div>
</div>