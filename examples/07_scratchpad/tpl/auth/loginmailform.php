<h2>Sign in via email</h2>
<form action="<?php echo $this->selfurl . $this->path;?>" method="POST" class="login-form" >

<fieldset>
<label for="email">Email</label>
<input type="text" name="email" value="<?php echo $this->request->email; ?>"/>
</fieldset>

<fieldset>
<label for="password">password</label>
<input type="password" name="password"/>
</fieldset>

<fieldset>
<label for="domain">POP Domain</label>
<input type="text" name="domain" value="<?php echo $this->request->domain; ?>"/>
</fieldset>

<fieldset>
<label for="nickname">Nickname ( optional )</label>
<input type="text" name="nickname" value="<?php echo $this->request->nickname; ?>"/>
</fieldset>

<fieldset>
<label for="use_ssl">Use SSL</label>
<input type="checkbox" name="use_ssl" value="1"<?php echo $this->request->use_ssl ?  ' checked' : '';?>/>
</fieldset>

<fieldset>
<input type="radio" name="authtype" value="imap"<?php echo $this->request->authtype == 'pop3' || $this->request->authtype == '' ?  ' checked' : '';?>/>
<label for="pop3">Use POP3</label>


<input type="radio" name="authtype" value="imap"<?php echo $this->request->authtype == 'imap' ?  ' checked' : '';?>/>
<label for="imap">Use IMAP</label>

</fieldset>

<fieldset>
<button type="submit">Sign In</button>
</fieldset>
<input type="hidden" name="route" value="loginmail"/>
<input type="hidden" name="nonce" value="<?php echo $this->nonce; ?>"/>

</form>