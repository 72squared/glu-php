<?php
$list = $this->list;
if( ! $list instanceof GLU ) return;
$lister = $list->iterator;
$authors = $list->authors;
if( ! $lister instanceof Scratchpad_Lister || ! $authors instanceof User_Lister) return;
echo '<?xml version="1.0" ?>';
?>

<rss version="2.0">
<channel>
<?php $this->dispatch( $this->dir->VIEW . 'scratchpad/xmlfeeditem.php'); ?>



<?php foreach( $lister as $k=>$pad ): ?>
<?php
if( $pad->dir_id == $this->pad->dir_id ) continue;
$author_id = $pad->author;
$author = $authors->$author_id;
$item = $this->NEW->GLU();
$item->server = $this->server;
$item->request = $this->request;
$item->baseurl = $this->selfurl;
$item->pad = $pad;
$item->author = $author;
?>
<item>
<?php $item->dispatch($this->dir->VIEW . 'scratchpad/xmlfeeditem.php'); ?>
</item>

<?php endforeach; ?>
</channel>
</rss>