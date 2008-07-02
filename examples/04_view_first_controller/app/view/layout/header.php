<html>
<head>
<title><?php echo  $this->title ? $this->title : 'Welcome'; ?> :: Grok App</title>
</head>
<body>
<div id="header">
 <h1>GROK VIEW-FIRST DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?php echo $this->instance(array('view'=>'index') )->dispatch(dir::layout . 'selfurl.php'); ?>">Home</a></li>
   <li><a href="<?php echo $this->instance(array('view'=>'helloworld') )->dispatch(dir::layout . 'selfurl.php'); ?>">Hello World</a></li>
   <li><a href="<?php echo $this->instance(array('view'=>'intro'))->dispatch(dir::layout . 'selfurl.php' ); ?>">Introduction</a></li>
  </ul>
 </div>
</div>
<div id="content">
