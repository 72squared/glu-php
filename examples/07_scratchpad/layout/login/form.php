<?php
$user = $this->dispatch(ROOT_DIR . 'load/user');
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$path = $this->dispatch(ROOT_DIR . 'load/path');
$action = $baseurl . $path;
?>
<h2>Sign in</h2>
<form action="<?php echo $action;?>" method="POST" class="login-form" >
<fieldset>
<label for="login">login</label>
<input type="text" name="login" value="<?php echo $user->nickname; ?>"/>
</fieldset>
<fieldset>
<label for="password">password</label>
<input type="password" name="password"/>
</fieldset>
<fieldset>
<input type="submit" value="Sign In!" />
<input type="hidden" name="action" value="login"/>
</fieldset>
</form>