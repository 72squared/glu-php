<?php $detail = $this->dispatch(ROOT_DIR . 'load/scratchpad_form'); ?>
<form action="<?php echo $detail->action;?>" method="POST"  class="scratchpad-content">
<textarea name="scratchpad_body" id="scratchpad_body">
<?php echo $detail->body; ?>
</textarea>
<br/>
<input type="submit" value="Save" />
<input type="hidden" name="action" value="edit" />
<input type="hidden" name="nonce" value="<?php echo $detail->nonce; ?>" />
<input type="hidden" name="entry_id" value="<?php echo $detail->entry_id; ?>" />
<br/>
<div class="wmd-preview"></div>
</form>
<script type="text/javascript" src="<?php echo $detail->baseurl; ?>/wmd/options.js"></script>
<script type="text/javascript"  src="http://box1.wmd-editor.com/1/wmd.js"></script>
