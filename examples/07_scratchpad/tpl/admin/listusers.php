<?php
$list = $this->list;

if( ! $list instanceof Grok ) return;
$lister = $list->iterator;
$matches = $list->matches;
if( ! $lister instanceof User_Lister ) return;
$matches = ( $list->matches instanceof Grok ) ? $list->matches : $this->NEW->Grok();

$pagination = $this->instance();
$pagination->url = $this->baseurl . '/?route=' . $this->route . '&page=#PAGE#';
$pagination->current = $list->page;
$pagination->max = $list->total_pages;
$pagination->per = $list->per_page;
$pagination->dispatch( dirname(__FILE__) . '/pagination');

?>
<dl class="scratchpad-list <?php echo $this->class; ?>">
<dt><?php echo $this->title; ?></dt>
<?php if( $list->iterator->count() < 1 ):?>
<dd><h2>No Results Found</h2></dd>
<?php
else:
foreach($lister as $k=>$user ):
?>
<dd>
<a href="<?php echo $this->baseurl .'/?route=manageuser&id=' . $k; ?>" class="scratchpad-author"><?php echo $user->nickname; ?></a>
<?php if( $matches->$k ): ?>
<span class="scratchpad-matches"><span class="label">matches: </span><em><?php echo intval($matches->$k); ?></em></span>
<?php endif; ?>
</dd>
<?php
endforeach;
endif;
?>
</dl>
