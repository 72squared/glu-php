<?php
$list = $this->list;
if( ! $list instanceof Grok ) return;
$lister = $list->iterator;
$authors = $list->authors;
$page = $list->page;
$per_page = $list->per_page;
if( ! $lister instanceof Scratchpad_Lister || ! $authors instanceof User_Lister) return;
?>
<div class="scratchpad-comments">
<h2>Comments</h2>

<?php foreach( $lister as $pad ): ?>
<?php

$body = $pad->body;
if( ! $pad->entry_id ) continue;
if( ! $pad->dir_id )  continue;
$pos = strlen( $body ) > 500 ? strpos( $body, "\n", 500) : FALSE;
if( $pos ) $body = substr( $body, 0, $pos ) . ' ... [read more](/' . $pad->entry_id . ')';
$author_id = $pad->author;
$author = $authors->$author_id;
?>
<HR/>
<?php echo $this->NEW->markdown_parser(array('relative_url_base'=>$this->baseurl))->transform($body); ?>
<?php if( $pad->entry_id ): ?>
<em><?php echo $author->nickname . ' on ' . date('Y/m/d H:i:s', $pad->created); ?></em>
<?php endif; ?>
<?php endforeach; ?>
</div>
