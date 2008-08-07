<?
print "<pre>";
try {
$auth = new Imap_Auth('mail.gaiaonline.com', TRUE);
$auth->authenticate('john', 'designpattern');
} catch( Exception $e ){
    print $e;
}
var_dump($auth);
