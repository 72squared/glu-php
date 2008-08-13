<?php
if( ! $this->lister instanceof Scratchpad_Lister || ! $this->authors instanceof User_Lister) return;
?>
<dl class="scratchpad-list <?php echo $this->class; ?>">
<dt><?php echo $this->title; ?></dt>
<?php
foreach($this->lister as $k=>$pad ):
$author_id = $pad->author;
$author = $this->authors->$author_id;
?>
<dd>
<span class="scratchpad-date"><?php echo date('Y-m-d H:i:s', $pad->created) ?></span>
<a href="<?php echo $this->baseurl .'/'. $pad->entry_id; ?>">[<?php echo $pad->title; ?>]</a>
<span class="scratchpad-author">by <?php echo $author->nickname; ?></span>
</dd>
<?php
endforeach;
?>
</dl>
