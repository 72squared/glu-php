<?php
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$header = $this->dispatch(ROOT_DIR . 'load/header');
?>
<html>
<head>
<title><?php echo  $header->title ?> :: GROK Scratchpad</title>
<link rel="stylesheet" href="<?php echo $baseurl . '/theme1/main.css'; ?>" type="text/css" />
</head>
<body>
<h1 class="global-header">
<a href="<?php echo $baseurl .'/'; ?>">GROK Scratchpad</a> :: <?php echo $header->title; ?>
</h1>
<div class="global-content">