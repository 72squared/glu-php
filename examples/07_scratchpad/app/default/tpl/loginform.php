<h2>Sign in</h2>
<form action="<?php echo $this->baseurl . $this->path;?>" method="POST" class="login-form" >
<fieldset>
<label for="login">login</label>
<input type="text" name="login" value="<?php echo $this->request->nickname; ?>"/>
</fieldset>
<fieldset>
<label for="password">password</label>
<input type="password" name="password"/>
</fieldset>
<fieldset>
<input type="submit" value="Sign In!" />
<input type="hidden" name="route" value="login"/>
<input type="hidden" name="nonce" value="<?php echo $this->nonce; ?>"/>

</fieldset>
</form>