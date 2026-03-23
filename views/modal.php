<button type="button" class="<?php echo esc_attr($param['button_class']); ?>" data-bs-toggle="modal" data-bs-target="#m<?php echo esc_attr($modalid); ?>">
  <?php echo esc_html($param['label']); ?>
</button>

<div class="modal fade" id="m<?php echo esc_attr($modalid); ?>" tabindex="-1" aria-labelledby="<?php echo ! empty($param['title']) ? esc_attr($titleid) : ''; ?>" aria-hidden="true">
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
        <?php echo do_shortcode($content); ?>
      </div>
    </div>
  </div>
</div>