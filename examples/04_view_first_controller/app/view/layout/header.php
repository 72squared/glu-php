<?
//find the current dir
$cwd = dirname(__FILE__);
?>
<html>
<head>
<title><?= $this->title ? $this->title : 'Welcome'; ?> :: Grok App</title>
</head>
<body>
<div id="header">
 <h1>GROK VIEW-FIRST DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=$this->instance(array('view'=>'index') )->dispatch($cwd . '/selfurl.php'); ?>">Home</a></li>
   <li><a href="<?=$this->instance(array('view'=>'helloworld') )->dispatch($cwd . '/selfurl.php'); ?>">Hello World</a></li>
   <li><a href="<?=$this->instance(array('view'=>'intro'))->dispatch($cwd . '/selfurl.php' ); ?>">Introduction</a></li>
  </ul>
 </div>
</div>
<div id="content">
