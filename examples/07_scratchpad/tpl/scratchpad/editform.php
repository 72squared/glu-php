<?php
$use_rte = ( $this->session && $this->session->use_rte ) ? TRUE : FALSE;
$body = $this->pad->body;
if( $use_rte ){
    $body = $this->NEW->markdown_parser(array('relative_url_base'=>$this->baseurl))->transform($body); 
}
?>
<form action="<?php echo $this->baseurl . $this->pad->path;?>" method="POST"  class="scratchpad-content">
<fieldset>
<textarea name="body" id="scratchpad_body">
<?php echo $body; ?>
</textarea>
</fieldset>
<fieldset>
<button type="submit">Save</button>
</fieldset>
<input type="hidden" name="route" value="<?php echo $this->route; ?>" />
<input type="hidden" name="nonce" value="<?php echo $this->nonce; ?>" />
<input type="hidden" name="entry_id" value="<?php echo $this->pad->entry_id; ?>" />
</form>
<?php if( ! $use_rte ): ?>
<div class="wmd-preview scratchpad-display"></div>
<script type="text/javascript" src="<?php echo $this->baseurl; ?>/wmd_options.js"></script>
<script type="text/javascript"  src="http://box1.wmd-editor.com/1/wmd.js"></script>

<?php else: ?>

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
new nicEditor({buttonList : ['fontFormat','bold','italic','ol', 'ul', 'hr', 'indent','outdent','link','image', 'xhtml']}).panelInstance('scratchpad_body');
});
//]]>
</script>

<?php endif; ?>