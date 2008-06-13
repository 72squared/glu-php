<?
$util_dir = dirname(dirname(dirname(dirname(__FILE__) ) ) ) . '/util';

?>
<script src="<?=$this->instance( array('route'=>'ajaxdemo', 'script'=>1) )->dispatch($util_dir . '/selfurl.php'); ?>" type="text/javascript"></script> 
