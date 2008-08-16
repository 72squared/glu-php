<form action="<?php echo $this->baseurl . $this->pad->path; ?>" method="POST" >
<input type="hidden" name="route" value="manage" />
<?php foreach( $this->acl as $role=>$actions ): ?>
<fieldset>
<label label-for="<?php echo $role; ?>"><input type="hidden" name="roles[]" value="<?php echo $role; ?>" /><?php echo $role; ?></label>
<input type="text" name="actions[]" value="<?php echo implode(', ', $actions); ?>" />
</fieldset>
<?php endforeach; ?>
<?php for( $i = 0; $i < 3; $i++): ?>
<fieldset>
<label label-for=""><input type="text" name="roles[]" value="" /></label>
<input type="text" name="actions[]" value="" />
</fieldset>
<?php endfor; ?>
<fieldset>
<button type="submit">save changes</button>
</fieldset>
</form>