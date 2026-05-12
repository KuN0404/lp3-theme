<?php
$file     = get_post_meta(get_the_ID(), '_unduhan_file', true);
$tanggal  = get_post_meta(get_the_ID(), '_unduhan_tanggal', true);
$size     = get_post_meta(get_the_ID(), '_unduhan_size', true);
$hit_count = (int) get_post_meta(get_the_ID(), '_unduhan_count', true);
$cats     = get_the_terms(get_the_ID(), 'kategori_unduhan');
$cat_slug = '';
if ($cats && !is_wp_error($cats)) {
    $cat_slug = $cats[0]->slug;
}
?>
<div class="lp3aik-unduhan-item d-flex align-items-center p-3 border rounded mb-3" data-category="<?php echo esc_attr($cat_slug); ?>">
    <div class="unduhan-icon me-3">
        <i class="bi bi-file-earmark-pdf-fill"></i>
    </div>
    <div class="unduhan-info flex-grow-1">
        <h6 class="unduhan-title mb-1"><?php the_title(); ?></h6>
        <div class="unduhan-meta">
            <?php if ($tanggal): ?><span class="me-3"><i class="bi bi-calendar3 me-1"></i><?php echo esc_html(lp3aik_format_date($tanggal)); ?></span><?php endif; ?>
            <?php if ($size): ?><span class="me-3"><i class="bi bi-hdd me-1"></i><?php echo esc_html($size); ?></span><?php endif; ?>
            <span class="me-3"><i class="bi bi-cloud-arrow-down me-1"></i><?php echo number_format($hit_count); ?> x</span>
        </div>
    </div>
    <div class="unduhan-action ms-3">
        <?php if ($file): ?>
        <a href="<?php echo esc_url($file); ?>" class="btn btn-primary btn-sm track-download" data-post-id="<?php the_ID(); ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-download me-1"></i>Unduh</a>
        <?php endif; ?>
    </div>
</div>
