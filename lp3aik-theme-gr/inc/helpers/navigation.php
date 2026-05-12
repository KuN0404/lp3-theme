<?php
/**
 * Navigation Helpers.
 *
 * Fallback menu rendered when no menu is assigned via Appearance > Menus.
 * Uses WP native functions for URLs — no hardcoded permalink overrides.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

/**
 * Fallback primary navigation.
 * Called via 'fallback_cb' in wp_nav_menu().
 */
function lp3aik_default_menu(): void {
    // Resolve CPT archive URLs via WP native function
    $program_url = get_post_type_archive_link('lp3aik_program') ?: home_url('/program/');
    $galeri_url  = get_post_type_archive_link('lp3aik_galeri')  ?: home_url('/galeri/');
    $unduhan_url = get_post_type_archive_link('lp3aik_unduhan') ?: home_url('/unduhan/');

    $current_id = get_queried_object_id();
    $is_front   = is_front_page();

    /**
     * Helper: check if current page matches a slug.
     */
    $is_page_slug = static function (string $slug) use ($current_id): bool {
        $page = get_page_by_path($slug);
        return $page && $page->ID === $current_id;
    };
    ?>
    <ul class="primary-nav">

        <li class="<?php echo $is_front ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php _e('Beranda', 'lp3aik-umk'); ?>
            </a>
        </li>

        <li class="menu-item-has-children <?php echo ($is_page_slug('profil') || $is_page_slug('visi-misi') || $is_page_slug('struktur-organisasi')) ? 'current-menu-ancestor' : ''; ?>">
            <a href="#">
                <?php _e('Tentang Kami', 'lp3aik-umk'); ?>
                <i class="fa-solid fa-chevron-down fa-2xs ms-1" aria-hidden="true"></i>
            </a>
            <ul class="sub-menu">
                <li class="<?php echo $is_page_slug('profil') ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('profil')) ?: home_url('/profil/')); ?>">
                        <?php _e('Profil', 'lp3aik-umk'); ?>
                    </a>
                </li>
                <li class="<?php echo $is_page_slug('visi-misi') ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('visi-misi')) ?: home_url('/visi-misi/')); ?>">
                        <?php _e('Visi &amp; Misi', 'lp3aik-umk'); ?>
                    </a>
                </li>
                <li class="<?php echo $is_page_slug('struktur-organisasi') ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('struktur-organisasi')) ?: home_url('/struktur-organisasi/')); ?>">
                        <?php _e('Struktur Organisasi', 'lp3aik-umk'); ?>
                    </a>
                </li>
            </ul>
        </li>

        <li class="<?php echo is_post_type_archive('lp3aik_program') ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url($program_url); ?>">
                <?php _e('Program', 'lp3aik-umk'); ?>
            </a>
        </li>

        <li class="menu-item-has-children <?php echo (is_post_type_archive('lp3aik_galeri') || is_post_type_archive('lp3aik_unduhan') || $is_page_slug('berita')) ? 'current-menu-ancestor' : ''; ?>">
            <a href="#">
                <?php _e('Informasi', 'lp3aik-umk'); ?>
                <i class="fa-solid fa-chevron-down fa-2xs ms-1" aria-hidden="true"></i>
            </a>
            <ul class="sub-menu">
                <li class="<?php echo $is_page_slug('berita') ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('berita')) ?: home_url('/berita/')); ?>">
                        <?php _e('Berita &amp; Pengumuman', 'lp3aik-umk'); ?>
                    </a>
                </li>
                <li class="<?php echo is_post_type_archive('lp3aik_galeri') ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url($galeri_url); ?>">
                        <?php _e('Galeri Kegiatan', 'lp3aik-umk'); ?>
                    </a>
                </li>
                <li class="<?php echo is_post_type_archive('lp3aik_unduhan') ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url($unduhan_url); ?>">
                        <?php _e('Unduhan / File', 'lp3aik-umk'); ?>
                    </a>
                </li>
            </ul>
        </li>

        <li class="<?php echo $is_page_slug('kontak') ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('kontak')) ?: home_url('/kontak/')); ?>">
                <?php _e('Hubungi Kami', 'lp3aik-umk'); ?>
            </a>
        </li>

    </ul>
    <?php
}
