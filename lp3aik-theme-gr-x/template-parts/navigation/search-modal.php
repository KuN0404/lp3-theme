<?php
/**
 * Template Part: Search Modal
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<div class="search-modal" id="search-modal" role="dialog"
     aria-modal="true"
     aria-label="<?php esc_attr_e('Pencarian', 'lp3aik-umk'); ?>">
    <div class="search-modal__box">
        <div class="search-modal__header">
            <h3 class="search-modal__title"><?php esc_html_e('Cari di LP3AIK', 'lp3aik-umk'); ?></h3>
            <button class="search-modal__close" id="search-close" aria-label="<?php esc_attr_e('Tutup pencarian', 'lp3aik-umk'); ?>">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <?php get_search_form(); ?>
    </div>
</div>
