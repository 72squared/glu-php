
<html>
<header>
<title><?= $this->title ? $this->title : 'Welcome'; ?> :: Grok App</title>
<link rel="stylesheet" href="<?=$this->instance(array('route'=>'style'))->dispatch('../util/selfurl.php'); ?>" type="text/css" />
</header>
<body>
<div id="header">
 <h1>GROK Front-End Controller MVC DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=$this->instance(array('route'=>'index'))->dispatch('../util/selfurl.php'); ?>">Home</a></li>
   <li><a href="<?=$this->instance(array('route'=>'helloworld'))->dispatch('../util/selfurl.php'); ?>">Hello World</a></li>
   <li><a href="<?=$this->instance(array('route'=>'intro'))->dispatch('../util/selfurl.php'); ?>">Introduction</a></li>
   <li><a href="<?=$this->instance(array('route'=>'ajaxdemo'))->dispatch('../util/selfurl.php'); ?>">Ajax Demo</a></li>
  <ul>
 </div>
</div>
<div id="content">
