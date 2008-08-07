<?php
if( ! $this->lister instanceof Scratchpad_Lister ) return;
if( ! ( $baseurl = $this->baseurl ) ) $baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$authors = new Scratchpad_Authors( $this->lister );
$title = ( $this->title ) ? $this->title : 'scratchpad listing';
?>
<dl class="scratchpad-list <?php echo $this->class; ?>">
<dt><?php echo $title; ?></dt>
<?php
foreach($this->lister as $k=>$pad ):
$author_id = $pad->author;
$author = $authors->$author_id;
$title = ucwords(trim(str_replace('_', ' ', str_replace('-', ' ', str_replace('/', ' ', $pad->path )))));
if( ! $title ) $title = 'home';
?>
<dd>
<span class="scratchpad-date"><?php echo date('Y-m-d H:i:s', $pad->created) ?></span>
<a href="<?php echo $baseurl . $pad->path . '?entry_id=' . $pad->entry_id; ?>">[<?php echo $title; ?>]</a>
<span class="scratchpad-author">by <?php echo $author->nickname; ?></span>
</dd>
<?php
endforeach;
?>
</dl>
