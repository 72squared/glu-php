<?php
$actions = array('read', 'write', 'manage');
?>
<form action="<?php echo $this->baseurl . $this->pad->path; ?>" method="POST" >
<input type="hidden" name="route" value="manage" />
<?php foreach( $this->acl->roles() as $i=>$role ): ?>
<fieldset>
<input type="text" name="roles[<?php echo $i; ?>]" value="<?php echo $role; ?>" />
</fieldset>
<fieldset  class="checks">
<?php foreach( $actions as $action): ?>
<input type="checkbox" name="actions[<?php echo $i; ?>][<?php echo $action; ?>]" value="1" <?php echo is_array( $this->acl->$role ) && in_array($action, $this->acl->$role) ? ' checked' : ''; ?>/><label><?php echo $action; ?></label>
<?php endforeach; ?>
</fieldset>
<?php endforeach; ?>
<fieldset>
<input type="text" name="roles[<?php echo ++$i; ?>]" value="" />
</fieldset>
<fieldset class="checks">
<?php foreach( $actions as $action): ?>
<input type="checkbox" name="actions[<?php echo $i; ?>][<?php echo $action; ?>]" value="1" /><label><?php echo $action; ?></label>
<?php endforeach; ?>
</fieldset>
<fieldset>
<button type="submit">save changes</button>
</fieldset>
</form>