<h2>Register</h2>
<form action="<?php echo $this->baseurl . $this->path;?>" method="POST" class="register-form" >
<fieldset>
<label for="nickname">nickname</label>
<input type="text" name="nickname" value="<?php echo $this->request->nickname; ?>"/>
</fieldset>
<fieldset>
<label for="email">email</label>
<input type="text" name="email"  value="<?php echo $this->request->email; ?>"/>
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
