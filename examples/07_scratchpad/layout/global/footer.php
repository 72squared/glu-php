<?php
$user = $this->dispatch(ROOT_DIR . 'load/user');
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$path = $this->dispatch(ROOT_DIR . 'load/path');
$currenturl = $baseurl . $path;
?>

</div>
<div class="global-footer">
<?php $this->dispatch(ROOT_DIR . 'layout/global/search'); ?>
<ul>
<?php
if(! $user->user_id): 
?>
<li><a href="<?php echo $currenturl . '?action=login'; ?>">Sign in</a></li>
<li><a href="<?php echo $currenturl . '?action=register'; ?>">Register</a></li>
<?php
endif;
?>
<li><a href="<?php echo $baseurl . '/?action=changes'; ?>">Recent Changes</a></li>
</ul>
<?php
if($user->user_id){
    print "<div><em> Logged in as: " . $user->nickname . "</em> (<a href=\"" . $currenturl . '?action=login' . "\">log out</a>)</div>";
}
?>
<?php if( defined('SCRIPT_START_TIME') ): ?>
<em class="global-footer">
page generated in <?php echo  number_format( microtime(TRUE) - SCRIPT_START_TIME, 4); ?> seconds
</em>
<?php endif; ?>
</div>
</body>
</html>
