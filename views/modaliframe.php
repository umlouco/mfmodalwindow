<button type="button" class="<?php echo esc_attr($param['button_class']); ?>" data-mfmodal-open="#m<?php echo esc_attr($param['modalid']); ?>" aria-controls="m<?php echo esc_attr($param['modalid']); ?>" aria-haspopup="dialog">
    <?php echo esc_html($param['label']); ?>
</button>

<div class="modal fade" id="m<?php echo esc_attr($param['modalid']); ?>" data-mfmodal-root tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="<?php echo ! empty($param['title']) ? esc_attr($titleid) : ''; ?>" aria-hidden="true">
    <div class="modal-dialog <?php echo esc_attr($param['modal_width']); ?>" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php if (! empty($param['title'])) : ?>
                    <h5 class="modal-title" id="<?php echo esc_attr($titleid); ?>"><?php echo esc_html($param['title']); ?></h5>
                <?php endif; ?>
                <?php if ($param['close_class'] === 'btn-close') : ?>
                    <button type="button" class="btn-close" data-mfmodal-close aria-label="Close"></button>
                <?php else : ?>
                    <button type="button" class="<?php echo esc_attr($param['close_class']); ?>" data-mfmodal-close aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="screen-reader-text">Close</span>
                    </button>
                <?php endif; ?>
            </div>
            <div class="modal-body">
                <iframe src="" loading="lazy" data-mfmodal-iframe-url="<?php echo esc_url($param['url']); ?>" title="<?php echo esc_attr($param['title']); ?>"></iframe>
            </div>
        </div>
    </div>
</div>