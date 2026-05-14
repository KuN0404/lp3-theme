<?php
/**
 * Template untuk Form Pencarian (Search Form)
 *
 * @package lp3aik-umk
 */
?>
<form role="search" method="get" class="search-form d-flex gap-2 w-100" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" class="form-control" placeholder="<?php _e('Ketik kata kunci pencarian...', 'lp3aik-umk'); ?>" value="<?php echo get_search_query(); ?>" name="s" required>
    <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1.25rem;">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</form>
