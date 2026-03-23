<button type="button" class="<?php echo esc_attr($param['button_class']); ?>" data-bs-toggle="modal" data-bs-target="#m<?php echo esc_attr($param['modalid']); ?>">
    <?php echo esc_html($param['label']); ?>
</button>

<div class="modal fade" id="m<?php echo esc_attr($param['modalid']); ?>" tabindex="-1" aria-labelledby="<?php echo ! empty($param['title']) ? esc_attr($titleid) : ''; ?>" aria-hidden="true">
    <div class="modal-dialog <?php echo esc_attr($param['modal_width']); ?>">
        <div class="modal-content">
            <div class="modal-header mf-modal-header">
                <?php if (! empty($param['title'])) : ?>
                    <h4 class="modal-title mf-modal-title" id="<?php echo esc_attr($titleid); ?>"><?php echo esc_html($param['title']); ?></h4>
                <?php endif; ?>
                <button type="button" class="<?php echo esc_attr($param['close_class']); ?>" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="screen-reader-text">Close</span>
                </button>
            </div>
            <div class="modal-body mf-modal-body">
                <iframe src="" loading="lazy" title="<?php echo esc_attr($param['title']); ?>"></iframe>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(function($) {
        var $modal = $('#m<?php echo esc_js($param['modalid']); ?>');
        var iframeUrl = '<?php echo esc_js($param['url']); ?>';

        $modal.on('shown.bs.modal', function() {
            $(this).find('iframe').attr('src', iframeUrl);
        });

        $modal.on('hidden.bs.modal', function() {
            $(this).find('iframe').attr('src', '');
        });
    });
</script>