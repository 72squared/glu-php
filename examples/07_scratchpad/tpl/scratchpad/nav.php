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
