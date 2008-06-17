<html>
<head>
<title><?= $input->title ? $input->title : 'Welcome'; ?> :: Grok App</title>
<link rel="stylesheet" href="<?=self::dispatch(dir::util . 'selfurl.php', array('route'=>'style')); ?>" type="text/css" />
</head>
<body>
<div id="header">
 <h1>GROK Front-End Controller MVC DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=self::dispatch(dir::util . 'selfurl.php', array('route'=>'index')); ?>">Home</a></li>
   <li><a href="<?=self::dispatch(dir::util . 'selfurl.php', array('route'=>'helloworld')); ?>">Hello World</a></li>
   <li><a href="<?=self::dispatch(dir::util . 'selfurl.php', array('route'=>'intro')); ?>">Introduction</a></li>
   <li><a href="<?=self::dispatch(dir::util . 'selfurl.php', array('route'=>'ajaxdemo')); ?>">Ajax Demo</a></li>
  <ul>
 </div>
</div>
<div id="content">
