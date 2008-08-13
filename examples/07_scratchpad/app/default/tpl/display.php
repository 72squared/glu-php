<?php

$body = $this->pad->body;
if( ! $this->pad->entry_id ) $body = '#directory only';
if( ! $this->pad->dir_id )  $body = '#Page does not exist yet';
?>
<div class="scratchpad-content">
<?php echo $this->Markdown_Parser(array('relative_url_base'=>$this->baseurl))->transform($body); ?>
</div>
<?php if( $this->pad->entry_id ): ?>
<div class="scratchpad-modified">
<em><?php echo $this->author->nickname . ' last modified on ' . date('Y/m/d H:i:s', $this->pad->created); ?></em>
</div>
<?php endif; ?>