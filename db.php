<?php
// Provide error and warning messages.
// Some of the functionality in this coursework relies upon undefined parameters to functions. E_NOTICE has been truncated from error reporting to prevent annoying messages from appearing.
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');
// Settings used to connect to the database:
$db_host = 'localhost';
$db_user = 'psyhsh';
$db_pass = '';
$db_name = 'psyhsh';
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_errno) echo "Could not connect to database.";
?>