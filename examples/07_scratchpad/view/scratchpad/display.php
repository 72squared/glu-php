<?php

$body = ( $this->pad->image ) ? '![' . $this->pad->title . '](' . $this->pad->path . '?modified=' . $this->pad->created .')' : $this->pad->body;
if( ! $this->pad->entry_id ) $body = '#directory only';
if( ! $this->pad->dir_id )  $body = '#Page does not exist yet';
?>
<div class="scratchpad-display">
<?php echo $this->NEW->markdown_parser(array('relative_url_base'=>$this->selfurl))->transform($body); ?>
<?php if( $this->pad->entry_id ): ?>
<div class="scratchpad-author">
<?php echo $this->author->nickname . ' last modified on ' . date('Y/m/d H:i:s', $this->pad->created); ?>
</div>
<?php endif; ?>
</div>
<div class="scratchpad-comments">
<?php $this->dispatch($this->dir->VIEW . 'scratchpad/comments'); ?>
</div>