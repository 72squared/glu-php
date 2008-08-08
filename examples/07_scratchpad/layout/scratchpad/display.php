<?php $details = $this->dispatch(ROOT_DIR . 'load/scratchpad_display'); ?>
<div class="scratchpad-content">
<?php echo $details->body; ?>
</div>
<?php if( $details->entry_id ): ?>
<div class="scratchpad-modified">
<em><?php echo $details->nickname . ' last modified this page on ' . $details->created; ?></em>
</div>
<?php endif; ?>