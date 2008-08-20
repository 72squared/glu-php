<?php
$body = $this->pad->body;
if( ! $this->pad->entry_id ) $body = '#directory only';
if( ! $this->pad->dir_id )  $body = '#Page does not exist yet';
?>
<?php echo $this->Markdown_Parser(array('relative_url_base'=>$this->baseurl))->transform($body); ?>
<?php if( $this->pad->entry_id ): ?>
<em><?php echo $this->author->nickname . ' last modified on ' . date('Y/m/d H:i:s', $this->pad->created); ?></em>
<?php endif; ?>
<?php $this->dispatch($this->DIR_TPL . 'scratchpad/comments'); ?>