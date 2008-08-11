<form action="<?php echo $this->action;?>" method="POST"  class="scratchpad-content">
<textarea name="body" id="scratchpad_body">
<?php echo $this->body; ?>
</textarea>
<br/>
<input type="submit" value="Save" />
<input type="hidden" name="route" value="edit" />
<input type="hidden" name="nonce" value="<?php echo $this->nonce; ?>" />
<input type="hidden" name="entry_id" value="<?php echo $this->entry_id; ?>" />
<input type="hidden" name="acl" value="main" />
<br/>
<div class="wmd-preview"></div>
</form>
<script type="text/javascript" src="<?php echo $this->baseurl; ?>/wmd_options.js"></script>
<script type="text/javascript"  src="http://box1.wmd-editor.com/1/wmd.js"></script>