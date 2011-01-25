<?php
$list = $this->list;
if( ! $list instanceof GLU ) return;
$lister = $list->iterator;
$authors = $list->authors;
$page = $list->page;
$per_page = $list->per_page;
if( ! $lister instanceof Scratchpad_Lister || ! $authors instanceof User_Lister) return;
if( $lister->count() < 1 ) return;
$parser = $this->NEW->markdown_parser(array('relative_url_base'=>$this->selfurl));
?>
<h2>Comments</h2>

<?php foreach( $lister as $pad ): ?>
<?php
$body = $pad->body;
if( ! $pad->entry_id ) continue;
if( ! $pad->dir_id )  continue;
$pos = strlen( $body ) > 500 ? strpos( $body, "\n", 500) : FALSE;
if( $pos ) $body = substr( $body, 0, $pos ) . ' ... ' . "\n\n" . '  > **[read more](/' . $pad->entry_id . ')**';
$author_id = $pad->author;
$author = $authors->$author_id;
?>
<div class="comment"
<?php echo $parser->transform($body); ?>
<?php if( $pad->entry_id ): ?>
<em class="author"><?php echo $author->nickname . ' on ' . date('Y/m/d H:i:s', $pad->created); ?></em>
<?php endif; ?>
</div>
<?php endforeach; ?>
