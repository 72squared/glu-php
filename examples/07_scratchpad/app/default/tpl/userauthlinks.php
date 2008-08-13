<?php
if( ! $this->user ) return;

if(! $this->user->user_id): 
?>
<ul>
<li><a href="<?php echo $currenturl . '?route=login'; ?>">Sign in</a></li>
<li><a href="<?php echo $currenturl . '?route=register'; ?>">Register</a></li>
</ul>
<?php else : ?>
<div><em> Logged in as: <?php echo $this->user->nickname ?></em> (<a href="<?php echo $currenturl ?>?route=login">log out</a>)</div>
<?php endif; ?>