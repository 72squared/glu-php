<?
// setup the timezone
$timezone = $input->timezone;
if( ! $timezone ) $timezone = 'GMT';
date_default_timezone_set($timezone);

// setup the time to be used
$now = $input->now;
if( ! $now ) $now = time();

// pick the date format
$format = $input->format;
if( ! $format ) $format = 'Y/m/d H:i:s e';
?>
The time is: <?= date($format, $now); ?>
