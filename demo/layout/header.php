
<html>
<header>
<title><?= $input->title ? $input->title : 'Welcome'; ?> :: Grok App</title>
<link rel="stylesheet" href="<?=$this->dispatch('format/controller_url', array('controller'=>'style') ); ?>" type="text/css" />
</header>
<body>
<div id="header">
 <h1>GROK DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=$this->dispatch('format/controller_url', array('controller'=>'index') ); ?>">Home</a></li>
   <li><a href="<?=$this->dispatch('format/controller_url', array('controller'=>'helloworld') ); ?>">Hello World</a></li>
   <li><a href="<?=$this->dispatch('format/controller_url', array('controller'=>'intro') ); ?>">Introduction</a></li>
   <li><a href="<?=$this->dispatch('format/controller_url', array('controller'=>'image_test') ); ?>">Image Test</a></li>
   <li><a href="<?=$this->dispatch('format/controller_url', array('controller'=>'sqlite_test') ); ?>">SQLite Test</a></li>
   <li><a href="<?=$this->dispatch('format/controller_url', array('controller'=>'mysql_test') ); ?>">MySQL Test</a></li>
  <ul>
 </div>
</div>
<div id="content">
