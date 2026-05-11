<?php
$jabatan = get_post_meta(get_the_ID(), '_org_jabatan', true);
$unit    = get_post_meta(get_the_ID(), '_org_unit', true);
$nip     = get_post_meta(get_the_ID(), '_org_nip', true);
?>
<div class="org-card text-center">
    <div class="org-photo">
        <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded-circle', 'alt' => get_the_title()]); ?>
        <?php else: ?>
        <div class="org-photo-placeholder rounded-circle">
            <i class="bi bi-person-fill"></i>
        </div>
        <?php endif; ?>
    </div>
    <h5 class="org-name"><?php the_title(); ?></h5>
    <?php if ($jabatan): ?><p class="org-jabatan"><?php echo esc_html($jabatan); ?></p><?php endif; ?>
    <?php if ($unit): ?><p class="org-unit"><?php echo esc_html($unit); ?></p><?php endif; ?>
    <?php if ($nip): ?><p class="org-nip">NIP: <?php echo esc_html($nip); ?></p><?php endif; ?>
</div>
