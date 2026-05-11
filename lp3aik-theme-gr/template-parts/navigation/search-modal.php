<?php
/**
 * Template Part: Search Modal
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<div class="search-modal" id="search-modal" role="dialog" aria-label="<?php _e('Pencarian', 'lp3aik-umk'); ?>">
    <div class="search-modal__box">
        <h3 class="mb-3" style="font-size:1.1rem;"><?php _e('Cari di LP3AIK', 'lp3aik-umk'); ?></h3>
        <?php get_search_form(); ?>
    </div>
</div>
