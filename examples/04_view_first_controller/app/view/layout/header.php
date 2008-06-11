
<html>
<head>
<title><?= $this->title ? $this->title : 'Welcome'; ?> :: Grok App</title>
</head>
<body>
<div id="header">
 <h1>GROK VIEW-FIRST DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=$this->instance(array('view'=>'index') )->dispatch('selfurl.php'); ?>">Home</a></li>
   <li><a href="<?=$this->instance(array('view'=>'helloworld') )->dispatch('selfurl.php'); ?>">Hello World</a></li>
   <li><a href="<?=$this->instance(array('view'=>'intro'))->dispatch('selfurl.php' ); ?>">Introduction</a></li>
  </ul>
 </div>
</div>
<div id="content">
