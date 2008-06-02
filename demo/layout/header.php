
<html>
<header>
<title><?= $input->title ? $input->title : 'Welcome'; ?> :: Grok App</title>
<link rel="stylesheet" href="<?=$this->dispatch('format/selfurl', array('view'=>'style') ); ?>" type="text/css" />
</header>
<body>
<div id="header">
 <h1>GROK DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=$this->dispatch('format/selfurl', array('view'=>'index') ); ?>">Home</a></li>
   <li><a href="<?=$this->dispatch('format/selfurl', array('view'=>'helloworld') ); ?>">Hello World</a></li>
   <li><a href="<?=$this->dispatch('format/selfurl', array('view'=>'intro') ); ?>">Introduction</a></li>
   <li><a href="<?=$this->dispatch('format/selfurl', array('view'=>'image_test') ); ?>">Image Test</a></li>
   <li><a href="<?=$this->dispatch('format/selfurl', array('view'=>'sqlite_test') ); ?>">SQLite Test</a></li>
   <li><a href="<?=$this->dispatch('format/selfurl', array('view'=>'mysql_test') ); ?>">MySQL Test</a></li>
  <ul>
 </div>
</div>
<div id="content">
