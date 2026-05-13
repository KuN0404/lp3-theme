<?php
/**
 * Single Template: Program / Layanan AIK
 *
 * Menampilkan detail satu Program AIK.
 * Mengikuti WordPress Template Hierarchy: single-{post_type}.php
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php if (has_post_thumbnail()): ?>
                    <div class="entry-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                            alt="<?php the_title_attribute(); ?>"
                            style="width:100%;border-radius:var(--radius-lg);">
                    </div>
                    <?php endif; ?>

                    <?php
                    $icon_class = get_post_meta(get_the_ID(), '_program_icon', true);
                    $sasaran    = get_post_meta(get_the_ID(), '_program_sasaran', true);
                    ?>

                    <?php if ($sasaran): ?>
                    <div class="mb-4 d-flex align-items-center gap-2"
                        style="color:var(--green-primary);font-size:0.9rem;">
                        <i class="fa-solid fa-users"></i>
                        <span><strong><?php _e('Sasaran:','lp3aik-umk'); ?></strong> <?php echo esc_html($sasaran); ?></span>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content"
                        style="background:var(--white);padding:3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);font-size:1.05rem;line-height:1.8;">
                        <?php the_content(); ?>
                    </div>

                    <!-- Elegant Social Share Feature -->
                    <div class="entry-share mt-4 pt-4">
                        <h5 class="share-title mb-3">
                            <i class="fa-solid fa-share-nodes"></i>
                            <?php _e('Bagikan Program', 'lp3aik-umk'); ?>
                        </h5>
                        <div class="share-buttons">
                            <?php
                            $share_url   = rawurlencode(get_permalink());
                            $share_title = rawurlencode(get_the_title());
                            ?>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener" class="btn" style="background:#1877f2;color:#fff;">
                                <i class="fa-brands fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://x.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo $share_title; ?>" target="_blank" rel="noopener" class="btn" style="background:#000000;color:#fff;">
                                <i class="fa-brands fa-x-twitter"></i> X
                            </a>
                            <a href="https://www.threads.net/intent/post?text=<?php echo $share_title . '%20' . $share_url; ?>" target="_blank" rel="noopener" class="btn" style="background:#101010;color:#fff;">
                                <i class="fa-brands fa-threads"></i> Threads
                            </a>
                            <a href="https://api.whatsapp.com/send?text=<?php echo $share_title . '%20' . $share_url; ?>" target="_blank" rel="noopener" class="btn" style="background:#25d366;color:#fff;">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>
                            <button onclick="navigator.clipboard.writeText(window.location.href); alert('<?php echo esc_js(__('Link tautan berhasil disalin! Buka Instagram untuk membagikannya ke Story/Bio Anda.','lp3aik-umk')); ?>');" class="btn btn--instagram" style="background:linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);color:#fff;">
                                <i class="fa-brands fa-instagram"></i> Instagram
                            </button>
                            <button onclick="navigator.clipboard.writeText(window.location.href); alert('<?php echo esc_js(__('Link tautan berhasil disalin!','lp3aik-umk')); ?>');" class="btn btn-outline btn--copy">
                                <i class="fa-solid fa-link"></i> <?php _e('Salin Link','lp3aik-umk'); ?>
                            </button>
                        </div>
                    </div>

                    <!-- Navigasi Program Lain -->
                    <div class="mt-5">
                        <h3 style="color:var(--green-dark);margin-bottom:1.5rem;">
                            <i class="fa-solid fa-layer-group me-2"></i><?php _e('Program Lainnya','lp3aik-umk'); ?>
                        </h3>
                        <?php
                        $related = new WP_Query([
                            'post_type'      => 'lp3aik_program',
                            'posts_per_page' => 3,
                            'post__not_in'   => [get_the_ID()],
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ]);
                        if ($related->have_posts()):
                        ?>
                        <div class="grid-3">
                            <?php while ($related->have_posts()): $related->the_post(); ?>
                            <?php get_template_part('template-parts/cards/card', 'program'); ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
