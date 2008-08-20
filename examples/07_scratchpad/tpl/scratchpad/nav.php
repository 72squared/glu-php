<?php if( ! $this->pad instanceof Scratchpad ) return; ?>
<div class="scratchpad-breadcrumbs">
<?
$paths = $this->pad->extractPaths();
$last = array_pop($paths);
while( $path = array_shift( $paths ) ):
$name = $this->pad->pathToName(substr($path, strrpos($path, '/')));
?>
<a href="<?php echo $this->baseurl . $path; ?>"><?php echo $name; ?></a> &gt; 
<?php endwhile; ?>
<?php
if( $last) : 
$name = $this->pad->pathToName(substr($last, strrpos($last, '/')));
?>
<?php echo $name;?>
<?php endif; ?>

</div>
<?php
$currenturl = $this->baseurl . $this->path;
$map = array( 
'display'=>'display',
'edit'=>'edit',
'addcomment'=>'add comment',
'history'=>'history',
'descendents'=>'descendents',
'changes'=>'changes',
'recent'=>'recent',
'manage'=>'manage',
);
?>
<ul class="scratchpad-nav">
<?php 
foreach( $map as $route=>$txt ): 
if( $this->permission instanceof Permission) {
    $action = $this->permission_map->{ $route };
    if( ! $action ) $action = 'read';
    if( ! $this->permission->verify( $action, $this->pad->path ) ) continue;
}
?>
<li><a href="<?php echo $currenturl; ?>?route=<?php echo $route; ?>"><?php echo $txt;?></a></li>
<?php endforeach; ?>
<?php if( $this->permission instanceof Permission && $this->permission->verify('read', $this->pad->path )): ?>
<li><a href="<?php echo ($this->path == '/' ? $this->baseurl . '/index.text' : $currenturl . '.text'); ?>" target="_blank">plain text</a></li>
<?php endif; ?>
</ul>
