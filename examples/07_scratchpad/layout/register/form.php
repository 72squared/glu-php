<?php
$user = $this->dispatch(ROOT_DIR . 'load/user');
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$path = $this->dispatch(ROOT_DIR . 'load/path');
$action = $baseurl . $path;
?>
<h2>Register</h2>
<form action="<?php echo $this->action;?>" method="POST" class="register-form" >
<fieldset>
<label for="nickname">nickname</label>
<input type="text" name="nickname" value="<?php echo $user->nickname; ?>"/>
</fieldset>
<fieldset>
<label for="email">email</label>
<input type="text" name="email"  value="<?php echo $user->email; ?>"/>
</fieldset>
<fieldset>
<label for="password">password</label>
<input type="password" name="password"/>
</fieldset>
<fieldset>
<input type="submit" value="Register!" />
<input type="hidden" name="route" value="register"/>
</fieldset>
</form>
