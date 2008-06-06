
<html>
<header>
<title><?= $input->title ? $input->title : 'Welcome'; ?> :: Grok App</title>
<link rel="stylesheet" href="<?=$this->dispatch('util/selfurl', array('route'=>'style') ); ?>" type="text/css" />
</header>
<body>
<div id="header">
 <h1>GROK Front-End Controller MVC DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=$this->dispatch('util/selfurl', array('route'=>'index') ); ?>">Home</a></li>
   <li><a href="<?=$this->dispatch('util/selfurl', array('route'=>'helloworld') ); ?>">Hello World</a></li>
   <li><a href="<?=$this->dispatch('util/selfurl', array('route'=>'intro') ); ?>">Introduction</a></li>
  <ul>
 </div>
</div>
<div id="content">
