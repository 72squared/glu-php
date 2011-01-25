<?php 
$this->pad->image = 1;
?>
<form action="<?php echo $this->selfurl . $this->pad->path;?>" method="POST"  class="scratchpad-content" enctype="multipart/form-data">
<fieldset>
<input type="file" name="body" id="scratchpad_body">
</fieldset>
<fieldset>
<button type="submit">Save</button>
</fieldset>
<input type="hidden" name="route" value="<?php echo $this->route; ?>" />
<input type="hidden" name="nonce" value="<?php echo $this->nonce; ?>" />
<input type="hidden" name="entry_id" value="<?php echo $this->pad->entry_id; ?>" />
</form>

<?php $this->dispatch($this->dir->VIEW . 'scratchpad/display'); ?>