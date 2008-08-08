<div class="scratchpad-content">
<?php echo $this->body; ?>
</div>
<?php if( $this->entry_id ): ?>
<div class="scratchpad-modified">
<em><?php echo $this->nickname . ' last modified this page on ' . $this->created; ?></em>
</div>
<?php endif; ?>