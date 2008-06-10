
<html>
<header>
<title><?= $input->title ? $input->title : 'Welcome'; ?> :: Grok App</title>
</header>
<body>
<div id="header">
 <h1>GROK VIEW-FIRST DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=$this->dispatch('selfurl', array('view'=>'index') ); ?>">Home</a></li>
   <li><a href="<?=$this->dispatch('selfurl', array('view'=>'helloworld') ); ?>">Hello World</a></li>
   <li><a href="<?=$this->dispatch('selfurl', array('view'=>'intro') ); ?>">Introduction</a></li>
  <ul>
 </div>
</div>
<div id="content">
