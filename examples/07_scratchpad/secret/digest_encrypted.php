<?php
$this->admin = md5('admin:' . $this->realm . ':adminpass');
$this->guest =  md5('guest:' . $this->realm . ':guest');

// this just demonstrates the form the encrypted file would be.
// in a real encrypted password file, you would actually store the 
// hard coded md5 values.