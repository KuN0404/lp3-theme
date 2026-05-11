<?php
/*
Template Name: Struktur Organisasi
*/
get_header();
?>

<section class="lp3aik-page-section py-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-label">Organisasi</span>
            <h1 class="page-heading" style="padding-bottom:16px;">Struktur Organisasi</h1>
        </div>

        <?php while (have_posts()) : the_post(); ?>
        <div class="org-diagram text-center mb-5 reveal">
            <?php the_content(); ?>
        </div>
        <?php endwhile; ?>

        <div class="row g-4">
            <?php
            $members = new WP_Query([
                'post_type'      => 'lp3aik_org_structure',
                'posts_per_page' => -1,
                'meta_key'       => '_org_order',
                'orderby'        => 'meta_value_num',
                'order'          => 'ASC',
            ]);
            if ($members->have_posts()) :
                $delay = 1;
                while ($members->have_posts()) : $members->the_post();
                    echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 reveal reveal-delay-' . min($delay, 5) . '">';
                    get_template_part('template-parts/content', 'org');
                    echo '</div>';
                    $delay++;
                endwhile;
                wp_reset_postdata();
            else:
                echo '<div class="col-12 text-center reveal"><p class="text-muted">Belum ada data anggota.</p></div>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
