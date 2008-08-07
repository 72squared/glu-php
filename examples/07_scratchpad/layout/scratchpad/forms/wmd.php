<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$body = ( $pad->body ) ? $pad->body : '#Page does not exist yet';
$body = htmlspecialchars($body);
$action = $baseurl . $pad->path;
$nonce = $this->dispatch( ROOT_DIR . 'load/nonce')->create();

?>
<form action="<?php echo $action;?>" method="POST"  class="scratchpad-content">
<textarea name="scratchpad_body" id="scratchpad_body">
<?php echo $body; ?>

</textarea>
<br/>
<input type="submit" value="Save" />
<input type="hidden" name="action" value="edit" />
<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
<input type="hidden" name="entry_id" value="<?php echo $pad->entry_id; ?>" />
<br/>
<div class="wmd-preview"></div>
</form>
<script type="text/javascript" src="<?php echo $baseurl . '/wmd/options.js'; ?>"></script>
<script type="text/javascript"  src="http://box1.wmd-editor.com/1/wmd.js"></script>
