<div class="breadcrumbs">
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