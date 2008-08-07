<?
$author = $this->dispatch(ROOT_DIR . 'load/author');
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$nickname = ( $author->nickname ) ? $author->nickname : 'Anonymous'; 
$baseurl = $this->dispatch( ROOT_DIR . 'load/baseurl');
$parser = new Markdown_Parser;
$body = ( $pad->body ) ? $pad->body : '#Page does not exist yet';
$body = $parser->transform($body);
$body = preg_replace('#<a[\s]+href="([a-z0-9_\-\/\.]+)"#i', '<a href="' . $baseurl . '${1}"', $body);
$modified = $pad->created ? 'last modified this page on ' . date('Y-m-d H:i:s', $pad->created) : '';
?>
<div class="scratchpad-content">
<?php echo $body; ?>
</div>
<div class="scratchpad-modified">
<em><?php echo $nickname; </script> <script language="php"> echo $modified; ?></em>
</div>
