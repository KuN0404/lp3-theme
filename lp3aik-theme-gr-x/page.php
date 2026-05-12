<?php
/**
 * Page Template — Fallback
 *
 * Tampilan standar untuk halaman WordPress yang TIDAK memiliki
 * custom page template. Halaman dengan template khusus (profil,
 * berita, kontak, dll.) ditangani langsung oleh template_include
 * filter di inc/helpers/page-templates.php.
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
        <div class="entry-content"
            style="background:var(--white);padding:3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);">
            <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>