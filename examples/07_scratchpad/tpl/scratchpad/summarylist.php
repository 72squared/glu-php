<?php
$list = $this->list;
if( ! $list instanceof Grok ) return;
$lister = $list->iterator;
$authors = $list->authors;
$page = $list->page;
$per_page = $list->per_page;
if( ! $lister instanceof Scratchpad_Lister || ! $authors instanceof User_Lister) return;
?>


<?php foreach( $lister as $pad ): ?>
<?php

$body = $pad->body;
if( ! $pad->entry_id ) $body = '#directory only';
if( ! $pad->dir_id )  $body = '#Page does not exist yet';
$pos = strlen( $body ) > 1000 ? strpos( $body, "\n", 1000) : FALSE;
if( $pos ) $body = substr( $body, 0, $pos ) . ' ... [read more](' . $pad->path . ')';
$author_id = $pad->author;
$author = $authors->$author_id;
?>
<HR/>
<?php echo $this->NEW->markdown_parser(array('relative_url_base'=>$this->baseurl))->transform($body); ?>
<?php if( $pad->entry_id ): ?>
<em><?php echo $author->nickname . ' last modified on ' . date('Y/m/d H:i:s', $pad->created); ?></em>
<?php endif; ?>
<?php endforeach; ?>