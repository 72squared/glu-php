<?php
$pad = $this->pad;
$author = $this->author;
if( ! $pad instanceof Scratchpad ) return;
if( ! $author instanceof User ) return;
$baseurl = 'http://' . $this->server->SERVER_NAME . $this->baseurl;
$body = $pad->body;
if( ! $pad->entry_id ) $body = '#directory only';
if( ! $pad->dir_id )  $body = '#Page does not exist yet';
$pos = strlen( $body ) > 100 ? strpos( $body, "\n", 100) : FALSE;
if( $pos ) $body = trim( substr( $body, 0, $pos )) . ' ... ';
$body = strip_tags( $body );
$body = filter_var($body, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

?>

<title><?php echo $this->pad->title; ?></title>
<description><?php echo $body; ?></description>
<author><?php echo $author->email . '(' . $author->nickname . ')'; ?></author>
<link><?php echo $baseurl . $pad->path; ?></link>
