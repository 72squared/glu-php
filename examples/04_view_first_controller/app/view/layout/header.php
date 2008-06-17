<html>
<head>
<title><?= $input->title ? $input->title : 'Welcome'; ?> :: Grok App</title>
</head>
<body>
<div id="header">
 <h1>GROK VIEW-FIRST DEMO</h1>
 <div id="nav">
  <ul>
   <li><a href="<?=self::dispatch( dir::layout . 'selfurl.php', array('view'=>'index') ); ?>">Home</a></li>
   <li><a href="<?=self::dispatch( dir::layout . 'selfurl.php', array('view'=>'helloworld') ); ?>">Hello World</a></li>
   <li><a href="<?=self::dispatch( dir::layout . 'selfurl.php', array('view'=>'intro') ); ?>">Introduction</a></li>
  </ul>
 </div>
</div>
<div id="content">
