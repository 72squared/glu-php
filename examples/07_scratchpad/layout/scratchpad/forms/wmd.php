<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$body = ( $pad->body ) ? $pad->body : '#Page does not exist yet';
$body = htmlspecialchars($body);
$action = '';
?>
<form action="<?php echo $action;?>" method="POST"  class="scratchpad-content">
<textarea name="scratchpad_body" id="scratchpad_body">
<?php echo $body; ?>

</textarea>
<br/>
<input type="submit" value="Save" />
<br/>
<div class="wmd-preview"></div>
</form>
<script type="text/javascript" src="<?php echo $baseurl . '/wmd_options.js'; ?>"></script>
<script type="text/javascript"  src="http://box1.wmd-editor.com/1/wmd.js"></script>
