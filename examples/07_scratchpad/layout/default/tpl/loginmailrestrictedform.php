<h2>Sign in via gMail</h2>
<form action="<?php echo $this->baseurl . $this->path;?>" method="POST" class="login-form" >

<fieldset>
<label for="email">Email</label>
<input type="text" name="email" value="<?php echo $this->request->email; ?>"/>
</fieldset>

<fieldset>
<label for="password">password</label>
<input type="password" name="password"/>
</fieldset>

<fieldset>
<label for="nickname">Nickname (optional)</label>
<input type="text" name="nickname" value="<?php echo $this->request->nickname; ?>"/>
</fieldset>

<fieldset>
<input type="submit" value="Sign In!" />
<input type="hidden" name="route" value="loginmailrestricted"/>
<input type="hidden" name="nonce" value="<?php echo $this->nonce; ?>"/>

</fieldset>
</form>