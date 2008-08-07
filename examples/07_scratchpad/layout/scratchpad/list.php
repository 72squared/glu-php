<?php
if( ! $this->lister instanceof Scratchpad_Lister ) return;
if( $this->lister->count() < 1 ) return;
if( ! ( $baseurl = $this->baseurl ) ) $baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$authors = new Scratchpad_Authors( $this->lister );

?>
<ul class="scratchpad-list <?php echo $this->class; ?>">
<?php
foreach($this->lister as $k=>$pad ):
$author_id = $pad->author;
$author = $authors->$author_id;
$title = ucwords(trim(str_replace('_', ' ', str_replace('-', ' ', str_replace('/', ' ', $pad->path )))));
if( ! $title ) $title = 'home';
?>
<li>
<span class="scratchpad-date"><?php echo date('Y-m-d H:i:s', $pad->created) ?></span>
<a href="<?php echo $baseurl . $pad->path . '?entry_id=' . $pad->entry_id; ?>">[<?php echo $title; ?>]</a>
<span class="scratchpad-author">by <?php echo $author->nickname; ?></span>
</li>
<?php
endforeach;
?>
</ul>
