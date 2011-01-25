<form action="<?php echo $this->selfurl . $this->pad->path;?>" method="POST"  class="scratchpad-content">
<fieldset>
<textarea name="body" id="scratchpad_body">
<?php echo $this->comment->body; ?>
</textarea>
</fieldset>

<fieldset>
<button type="submit">Save</button>
</fieldset>
<input type="hidden" name="route" value="<?php echo $this->route; ?>" />
<input type="hidden" name="nonce" value="<?php echo $this->nonce; ?>" />
<div class="wmd-preview"></div>
</form>
<script type="text/javascript" src="<?php echo $this->selfurl; ?>/wmd_options.js"></script>
<script type="text/javascript"  src="http://box1.wmd-editor.com/1/wmd.js"></script>
