<?php
/**
 * Template Name: Halaman Profil
 *
 * Halaman penuh untuk Profil LP3AIK, Visi Misi, Statistik, dan Tim.
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

<?php
get_template_part('template-parts/sections/section', 'about');
get_template_part('template-parts/sections/section', 'stats');
?>

<?php get_footer(); ?>