<?php
$list = $this->list;

if( ! $list instanceof GLU ) return;
$lister = $list->iterator;
$authors = $list->authors;
$matches = $list->matches;
if( ! $lister instanceof Scratchpad_Lister ) return;
if( ! $authors instanceof User_Lister ) return;
$matches = ( $list->matches instanceof GLU ) ? $list->matches : $this->NEW->GLU();

$pagination = $this->instance();
$pagination->url = $list->pagination_url;
$pagination->current = $list->page;
$pagination->max = $list->total_pages;
$pagination->per = $list->per_page;
$pagination->dispatch( $this->dir->VIEW . 'site/pagination');

?>
<dl class="scratchpad-list <?php echo $this->class; ?>">
<dt><?php echo $this->title; ?></dt>
<?php if( $lister->count() < 1 ):?>
<dd><h2>No Results Found</h2></dd>
<?php
else:
foreach($lister as $k=>$pad ):
$author_id = $pad->author;
$author = $authors->$author_id;
?>
<dd>
<span class="scratchpad-date"><?php echo date("M j, Y, g:i A", $pad->created) ?></span>
<a href="<?php echo $this->selfurl .'/'. $pad->entry_id; ?>">[<?php echo $pad->title; ?>]</a>
<span class="scratchpad-author">by <?php echo $author->nickname; ?></span>
<?php if( $matches->$k ): ?>
<span class="scratchpad-matches"><span class="label">matches: </span><em><?php echo intval($matches->$k); ?></em></span>
<?php endif; ?>
</dd>
<?php
endforeach;
endif;
?>
</dl>
