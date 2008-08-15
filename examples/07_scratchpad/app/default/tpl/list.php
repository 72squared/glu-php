<?php
$list = $this->list;

if( ! $list instanceof Grok ) return;
$lister = $list->iterator;
$authors = $list->authors;
$matches = $list->matches;
$page = $list->page;
$per_page = $list->per_page;
if( ! $lister instanceof Scratchpad_Lister ) return;
if( ! $authors instanceof User_Lister ) return;
$matches = ( $list->matches instanceof Grok ) ? $list->matches : $this->Grok();
?>
<dl class="scratchpad-list <?php echo $this->class; ?>">
<dt><?php echo $this->title; ?></dt>
<?php
foreach($lister as $k=>$pad ):
$author_id = $pad->author;
$author = $authors->$author_id;
?>
<dd>
<span class="scratchpad-date"><?php echo date('Y-m-d H:i:s', $pad->created) ?></span>
<a href="<?php echo $this->baseurl .'/'. $pad->entry_id; ?>">[<?php echo $pad->title; ?>]</a>
<span class="scratchpad-author">by <?php echo $author->nickname; ?></span>
<?php if( $matches->$k ): ?>
<span class="scratchpad-matches"><span class="label">matches: </span><em><?php echo intval($matches->$k); ?></em></span>
<?php endif; ?>
</dd>
<?php
endforeach;
?>
</dl>
