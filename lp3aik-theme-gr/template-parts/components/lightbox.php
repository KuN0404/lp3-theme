<?php
/**
 * Template Part: Lightbox Overlay
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<div class="lightbox" id="lightbox" role="dialog" aria-label="<?php _e('Tampilan gambar besar', 'lp3aik-umk'); ?>">
    <button class="lightbox__close" id="lightbox-close" aria-label="<?php _e('Tutup', 'lp3aik-umk'); ?>">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <img src="" alt="" id="lightbox-img">
    <div class="lightbox__caption" id="lightbox-caption">
        <h4 class="lightbox__title" id="lightbox-title"></h4>
        <p class="lightbox__desc" id="lightbox-desc"></p>
    </div>
</div>
