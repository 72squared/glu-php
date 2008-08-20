<html>
<head>
<title><?php echo  $this->title ?> :: GROK Scratchpad</title>
<link rel="stylesheet" href="<?php echo $this->baseurl . '/main.css'; ?>" type="text/css" />
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

<?php $this->dispatch($this->DIR_TPL . 'scratchpad/nav'); ?>
<div class="global-content">
