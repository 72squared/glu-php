<html>
<head>
<title><?php echo  $this->title ? $this->title : 'Welcome'; ?> :: GLU App</title>
<link rel="stylesheet" href="<?php echo $this->instance(array('route'=>'style'))->dispatch( dir::util . 'selfurl.php'); ?>" type="text/css" />
</head>
<body>
<div id="header">
 <h1>GLU Front-End Controller MVC DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?php echo $this->instance(array('route'=>'index'))->dispatch( dir::util . 'selfurl.php'); ?>">Home</a></li>
   <li><a href="<?php echo $this->instance(array('route'=>'helloworld'))->dispatch(dir::util . 'selfurl.php'); ?>">Hello World</a></li>
   <li><a href="<?php echo $this->instance(array('route'=>'intro'))->dispatch( dir::util . 'selfurl.php'); ?>">Introduction</a></li>
   <li><a href="<?php echo $this->instance(array('route'=>'ajaxdemo'))->dispatch( dir::util . 'selfurl.php'); ?>">Ajax Demo</a></li>
  <ul>
 </div>
</div>
<div id="content">
