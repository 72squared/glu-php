<?php $currenturl = $this->baseurl . $this->path; ?>

</div>
<div class="global-footer">
<form action="<?php echo $currenturl ?>" method="POST" class="global-search" >
<fieldset>
<input type="text" name="term" value="<?php echo $this->request->term; ?>"/>
<input type="submit" value="Search" />
<input type="hidden" name="route" value="search"/>
</fieldset>
</form>

<?php
if(! $this->user->user_id): 
?>
<ul>
<li><a href="<?php echo $currenturl . '?route=login'; ?>">Sign in</a></li>
<li><a href="<?php echo $currenturl . '?route=register'; ?>">Register</a></li>
</ul>
<?php else : ?>
<div><em> Logged in as: <?php echo $this->user->nickname ?></em> (<a href="<?php echo $currenturl ?>?route=login">log out</a>)</div>
<?php endif; ?>
<?php if( defined('SCRIPT_START_TIME') ): ?>
<em>
page generated in <?php echo  number_format( microtime(TRUE) - SCRIPT_START_TIME, 4); ?> seconds
</em>
<?php endif; ?>
</div>
</body>
</html>
