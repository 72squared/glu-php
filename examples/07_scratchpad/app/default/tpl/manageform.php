<form action="<?php echo $this->baseurl . $this->pad->path; ?>" method="POST" >
<input type="hidden" name="route" value="manage" />
<?php foreach( $this->acl->roles() as $role ): ?>
<fieldset>
<label label-for="<?php echo $role; ?>"><input type="text" name="roles[]" value="<?php echo $role; ?>" /></label>
<input type="text" name="actions[]" value="<?php echo ( is_array($this->acl->$role ) ? implode(', ', $this->acl->$role) : ''); ?>" />
</fieldset>
<?php endforeach; ?>
<fieldset>
<label label-for=""><input type="text" name="roles[]" value="" /></label>
<input type="text" name="actions[]" value="" />
</fieldset>
<fieldset>
<button type="submit">save changes</button>
</fieldset>
</form>