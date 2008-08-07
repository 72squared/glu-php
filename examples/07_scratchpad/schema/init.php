<?php
print "<pre>";
print "\nSTARTING CLEANUP ...";
$dir = ROOT_DIR . 'db' . DIRECTORY_SEPARATOR;
$fp = opendir( $dir );

while( $file = readdir( $fp ) ){
    if( substr( $file, 0, 1) == '.' ) continue;
    if( substr( $file, -3) != '.db') continue;
    $file = $dir. $file;
    print "\ncleaning up: $file";
    file_put_contents( $file, '');
}

print "\nCLEANUP DONE\n\nINITIALIZING...\n";
$fp = opendir( ROOT_DIR . 'schema' . DIRECTORY_SEPARATOR );
while( $file = readdir( $fp ) ){
    if( substr( $file, 0, 1) == '.' ) continue;
    if( substr( $file, -4) != '.sql') continue;
    $dbfile = $dir  . substr($file, 0, -4) . '.db';
    print "\n\ncreating database: " . $dbfile;
    $db = new PDO('sqlite2:' . $dbfile);
    $queries = explode(";\n", file_get_contents( ROOT_DIR . 'schema' . DIRECTORY_SEPARATOR . $file) );
    print "\nsending queries ...";
    foreach( $queries as $query ){
        $query = trim( $query, "\n;\r\n " );
        if( ! $query ) continue;
        print "\n" . $query . ';';
        $rs = $db->query($query );
    }
    // changing permissions.
    chmod($dbfile, 0666);
    print "\n";
}


print "\nDONE!\n";
print "</pre>";

// EOF