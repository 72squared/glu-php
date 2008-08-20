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
?>
<ul class="scratchpad-nav">
<li><a href="<?php echo $currenturl; ?>">display</a></li>
<li><a href="<?php echo $currenturl; ?>?route=edit">edit</a></li>
<li><a href="<?php echo $currenturl; ?>?route=addcomment">add comment</a></li>
<li><a href="<?php echo $currenturl; ?>?route=history">history</a></li>
<li><a href="<?php echo $currenturl; ?>?route=descendents">related</a></li>
<li><a href="<?php echo $currenturl; ?>?route=changes">changes</a></li>
<li><a href="<?php echo $currenturl; ?>?route=recent">recent</a></li>
<li><a href="<?php echo $currenturl; ?>?route=manage">manage</a></li>
<li><a href="<?php echo ($this->path == '/' ? $this->baseurl . '/index.text' : $currenturl . '.text'); ?>" target="_blank">plain text</a></li>
</ul>
