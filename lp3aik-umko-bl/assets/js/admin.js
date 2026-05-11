/**
 * LP3AIK Theme — Admin JavaScript
 */
(function ($) {
    'use strict';

    $(document).ready(function () {
        $('.lp3aik-tab-link').on('click', function (e) {
            e.preventDefault();
            $('.lp3aik-tab-link').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.lp3aik-tab-content').hide();
            $('#' + $(this).data('tab')).show();
        });

        $('.lp3aik-upload-button').off('click').on('click', function (e) {
            e.preventDefault();

            var button = $(this);
            var targetInput = $('#' + button.data('target'));
            var previewWrap = targetInput.closest('.lp3aik-upload-group').find('.lp3aik-preview-wrap');

            var frame = wp.media({
                title: 'Pilih Gambar',
                button: { text: 'Pilih' },
                multiple: false,
            });

            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                if (previewWrap.length) {
                    previewWrap.html('<img src="' + attachment.url + '" class="lp3aik-preview-thumb">');
                }
            });

            frame.open();
        });
    });

})(jQuery);
