<?php
$exclude = array('user_id', 'passhash', 'created', 'modified');
?>
<form method="POST" action="<?php echo $this->baseurl; ?>/?route=manageuser">
<input type="hidden" name="id" value="<?php echo $this->manageuser->user_id; ?>"/>

<?php foreach( $this->manageuser as $k=>$v): ?>
<?php if( in_array($k, $exclude) ) continue; ?>
<fieldset>
<label><?php echo $k; ?></label>
<input type=text" name="attr[<?php echo $k; ?>]" value="<?php echo htmlspecialchars($v);?>"/>
</fieldset>
<?php endforeach;?>
<fieldset>

<fieldset>
<label><input type=text" name="__k" value=""/></label>
<input type=text" name="__v" value=""/>
</fieldset>

<fieldset>

<button type="submit">Save Changes"</button>
</fieldset>
</form>