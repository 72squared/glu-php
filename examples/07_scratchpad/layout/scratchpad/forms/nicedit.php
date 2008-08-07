<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$baseurl = $this->dispatch( ROOT_DIR . 'load/baseurl');
$parser = new Markdown_Parser;
$body = ( $pad->body ) ? $pad->body : '#Page does not exist yet';
$body = $parser->transform($body);
$body = preg_replace('#<a[\s]+href="([a-z0-9_\-\/\.]+)"#i', '<a href="' . $baseurl . '${1}"', $body);
$body = htmlspecialchars($body);
$iconpath = $baseurl . '/nicedit/icons.gif';
$js_url = $baseurl . '/nicedit/main.js';
$action = '';
?>
<div id="content">
<form action="<?php echo $action;?>" method="POST" >
<fieldset>
<textarea name="scratchpad_body" id="scratchpad_body">
<script language="php"> 
echo $body; ?>
</textarea>
<br/>
</fieldset>
<input type="submit" value="Save" />
<br/>
</form>
</div>
<script type="text/javascript" src="<?php echo $js_url; ?>"></script> 
<script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
new nicEditor({buttonList : ['fontFormat','bold','italic','underline','strikeThrough','ol', 'ul', 'link','image', 'xhtml'], iconsPath: '<?php echo $iconpath; ?>'}).panelInstance('scratchpad_body');
});
//]]>
</script>