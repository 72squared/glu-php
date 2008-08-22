<?php
$keywords = 'scratchpad, wiki, cms, content management';
if( $this->pad ){
    $words = $this->NEW->keyword_counter($this->pad->body . ' ' . $keywords, array('disable_soundex'=>1, 'disable_stemmer'=>1));
    $words->rsort();
    $keywords = implode(', ', array_slice($words->keys(), 0, 8));
}
?>
<html>
<head>
<title><?php echo  $this->title ?> :: GROK Scratchpad</title>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php echo $this->title; ?>" href="<?php echo $this->baseurl . $this->path;?>?route=xmlfeed" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/static/main.css" type="text/css" />
<link href="<?php echo $this->baseurl; ?>/favicon.ico" rel="icon" type="image/x-icon" />
</head>
<body>
<form action="<?php echo $this->baseurl . '/'; ?>" method="POST" class="global-search" >
<input type="hidden" name="route" value="search"/>
<fieldset>
<input type="text" name="term" value="<?php echo $this->request->term; ?>"/>
<button type="submit">Search</button>
</fieldset>
</form>
<h1 class="global-header">
<a href="<?php echo $this->baseurl .'/'; ?>">GROK Scratchpad</a> :: <?php echo $this->title; ?>
</h1>

<?php $this->dispatch($this->dir->TPL . 'scratchpad/nav'); ?>
<div class="global-content">
