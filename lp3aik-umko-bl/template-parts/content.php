<?php
/**
 * Template Part: Content (Card Berita Modern)
 * Path: template-parts/content.php
 */
$post_cats = get_the_category();
?>
<div class="lp3aik-news-card h-100">

    <!-- Thumbnail -->
    <a href="<?php the_permalink(); ?>" class="d-block" tabindex="-1">
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="news-card-img-wrap">
            <?php the_post_thumbnail( 'lp3aik-medium', [
                'class'   => 'news-card-thumb',
                'alt'     => esc_attr( get_the_title() ),
                'loading' => 'lazy',
            ] ); ?>
        </div>
        <?php else : ?>
        <div class="news-card-img-placeholder">
            <i class="bi bi-newspaper" aria-hidden="true"></i>
        </div>
        <?php endif; ?>
    </a>

    <!-- Body -->
    <div class="news-card-body">
        <?php if ( $post_cats ) : ?>
        <a href="<?php echo esc_url( get_category_link( $post_cats[0]->term_id ) ); ?>" class="news-card-cat">
            <?php echo esc_html( $post_cats[0]->name ); ?>
        </a>
        <?php endif; ?>

        <h3 class="news-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="news-card-excerpt">
            <?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 16 ) ); ?>
        </p>
    </div>

    <!-- Footer -->
    <div class="news-card-footer">
        <span class="d-flex align-items-center gap-1">
            <i class="bi bi-person-circle"></i>
            <?php echo esc_html( lp3aik_get_author_name() ); ?>
        </span>
        <span class="d-flex align-items-center gap-1 ms-auto">
            <i class="bi bi-eye"></i>
            <?php echo lp3aik_get_post_views_count( get_the_ID() ); ?>
        </span>
    </div>

</div>