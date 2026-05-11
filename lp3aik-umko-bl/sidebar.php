<?php if (is_active_sidebar('sidebar-berita')): ?>
<aside id="sidebar" class="lp3aik-sidebar" role="complementary">
    <?php dynamic_sidebar('sidebar-berita'); ?>
</aside>
<?php else: ?>
<aside class="lp3aik-sidebar" role="complementary">

    <div class="widget">
        <h5 class="widget-title">Kategori</h5>
        <ul>
            <?php
            $cats = get_categories(['hide_empty' => false]);
            foreach ($cats as $cat) {
                echo '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <div class="widget">
        <h5 class="widget-title">Berita Terbaru</h5>
        <ul>
            <?php
            $recent = new WP_Query(['posts_per_page' => 5]);
            while ($recent->have_posts()): $recent->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            endwhile; wp_reset_postdata();
            ?>
        </ul>
    </div>
    <div class="widget">
        <h5 class="widget-title">Tautan</h5>
        <ul>
            <li><a href="<?php echo esc_url(home_url('/about/')); ?>">Deskripsi Singkat</a></li>
            <li><a href="<?php echo esc_url(home_url('/vision-mission/')); ?>">Visi dan Misi</a></li>
            <li><a href="<?php echo esc_url(home_url('/organization/')); ?>">Struktur Organisasi</a></li>
            <li><a href="<?php echo esc_url(home_url('/programs/')); ?>">Program</a></li>
            <li><a href="<?php echo esc_url(home_url('/gallery/')); ?>">Galeri</a></li>
            <li><a href="<?php echo esc_url(home_url('/downloads/')); ?>">Unduhan</a></li>
            <li><a href="<?php echo esc_url(home_url('/faq/')); ?>">FAQ</a></li>
            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Kontak</a></li>
        </ul>
    </div>
</aside>
<?php endif; ?>
