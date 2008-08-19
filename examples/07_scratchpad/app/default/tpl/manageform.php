<?php
$actions = array('read', 'write', 'comment');
$i=0;
$paths = array();
foreach( $this->permission_lister as $role=>$p ){
    foreach( $p->keys() as $path ) $paths[$path] = 1;
}
unset( $paths[ $this->pad->path ] );
$paths = array_keys( $paths );
?>
<dl>
<?php if( count( $paths ) > 0 ): ?>
<dt>Other Permission Areas</dt>
<?php foreach($paths as $path ): ?>
<dd><a href="<?php echo $this->baseurl . $path;?>?route=manage"><?php echo $this->pad->pathToName($path); ?></a></dd>
<?php endforeach; ?>
</dl>
<?php endif; ?>

<form action="<?php echo $this->baseurl . $this->pad->path; ?>" method="POST" >
<input type="hidden" name="route" value="manage" />

<?php foreach( $this->permission_lister as $role=>$p ): ?>
<?php $i++; ?>
<fieldset>
<input type="text" name="roles[<?php echo $i; ?>]" value="<?php echo $role; ?>" />
</fieldset>

<fieldset  class="checks">
<?php foreach( $actions as $action): ?>
<input type="checkbox" name="actions[<?php echo $i; ?>][<?php echo $action; ?>]" value="1" <?php echo is_array( $p->{$this->path} ) && in_array($action, $p->{$this->path}) ? ' checked' : ''; ?>/><label><?php echo $action; ?></label>
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